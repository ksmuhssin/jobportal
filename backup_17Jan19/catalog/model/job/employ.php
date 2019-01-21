<?php
class Modeljobemploy extends Model {
	public function addfirsttable($data){
		$sql="INSERT INTO " . DB_PREFIX . "employ set fullname='".$this->db->escape($data['fullname'])."',image='".$this->db->escape($data['image'])."',
		email='".$this->db->escape($data['email'])."',resumelist='".$this->db->escape($data['resumelist'])."',salt = '" . $this->db->escape($salt = token(9)) . "',
		password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',date_of_birth='".$this->db->escape($data['date_of_birth'])."',
		address='".$this->db->escape($data['address'])."',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',city='".$this->db->escape($data['city'])."',
		pincode='".$this->db->escape($data['pincode'])."',mobile_phone='".$this->db->escape($data['mobile_phone'])."',home_phone='".$this->db->escape($data['home_phone'])."',
		profissional='".$this->db->escape($data['profissional'])."',experience='".$this->db->escape($data['experience'])."',interest='".$this->db->escape($data['interest'])."',
		about_self='".$this->db->escape($data['about_self'])."',
        jobtype_id='".(int)$data['jobtype_id']."',
        category_id='".(int)$data['category_id']."',


		career='".$this->db->escape($data['career'])."',achievement='".$this->db->escape($data['achievement'])."',gender='".(int)$data['gender']."',
		status=1,approved=1,date_added=now()";
		$this->db->query($sql);
		$employ_id=$this->db->getLastId();
		if (isset($data['education_rows'])) {
			foreach ($data['education_rows'] as $language_id => $value) {
				foreach ($value as $education_row) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "employ_education SET 
					employ_id = '" . (int)$employ_id . "', 
					language_id = '" .(int)$language_id . "',
					degree='".$education_row['degree']."',
					collage='".$education_row['collage']."',
					percentage='".$education_row['percentage']."',
					passed_year='".$education_row['passed_year']."'");
				}
			}
		}

		$this->load->model('job/mail');
		$companytype ='employ_signup_email';
		$mailinfo = $this->model_job_mail->getMailInfo($companytype);

			//print_r($mailinfo);die();

		if(isset($mailinfo['status'])){
			$find = array(
			   '{fullname}',
				'{email}',	
				'{mobile_phone}',											
				'{profissional}',											
				'{loginlink}'										
			);
			$replace = array(
				'fullname'  => $data['fullname'],
				'email' 	 => $data['email'],
				'mobile_phone'      => $data['mobile_phone'],
				'profissional'      => $data['profissional'],
				'loginlink'  => $this->url->link('employ/login', '', 'SSL') . "\n\n"
			);


	     	$subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			
		//echo "<pre>";
			//print_r($message);die();

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($data['email']);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();


	
	}
		
	}
	public function getemploy($employ_id){
		$sql="select * from " . DB_PREFIX . "employ where employ_id='".$employ_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getEmploys($data = array()){
		$sql="select * from " . DB_PREFIX . "employ where employ_id<>0";
		
		 if (isset($data['employ_id'])){
			$sql .=" and employ_id like '".$this->db->escape($data['employ_id'])."%'";
		}

		if (!empty($data['filter_status'])) {
		$sql .= " AND jobtype_id='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['job_filter'])) {
		$sql .= " AND category_id='" . $this->db->escape($data['job_filter']) . "'";
		}


		$sort_data = array(
			'employ_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY employ_id";
		}
		if (isset($data['order']) && ($data['order'] == 'ASC')) {
			$sql .= " ASC";
		} else {
			$sql .= " DESC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}
		$query=$this->db->query($sql);
		return $query->rows;
	}

	public function getEmployslatest($data = array()){
		$sql="select * from " . DB_PREFIX . "employ where employ_id<>0 ORDER BY date_added DESC LIMIT 4";
		$query=$this->db->query($sql);
		return $query->rows;
	}


	public function editemploy($data) { 
		if(!empty($data['password'])){
			$sql = "update " .DB_PREFIX . "employ SET salt = '" . $this->db->escape($salt = token(9)) . "',
			password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "'  WHERE employ_id = '" . $data['employ_id'] ."'";
			$query = $this->db->query($sql);
		} else {
			$sql = "update " .DB_PREFIX . "employ SET fullname='".$this->db->escape($data['fullname'])."',image='".$this->db->escape($data['image'])."',resumelist='".$this->db->escape($data['resumelist'])."',date_of_birth='".$this->db->escape($data['date_of_birth'])."',
			address='".$this->db->escape($data['address'])."',country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',
			city='".$this->db->escape($data['city'])."',pincode='".$this->db->escape($data['pincode'])."',mobile_phone='".$this->db->escape($data['mobile_phone'])."',
			home_phone='".$this->db->escape($data['home_phone'])."',profissional='".$this->db->escape($data['profissional'])."',experience='".$this->db->escape($data['experience'])."',
			interest='".$this->db->escape($data['interest'])."',about_self='".$this->db->escape($data['about_self'])."',career='".$this->db->escape($data['career'])."',achievement='".$this->db->escape($data['achievement'])."',
			gender='".(int)$data['gender']."',jobtype_id='".(int)$data['jobtype_id']."',category_id='".(int)$data['category_id']."',date_modified=now() where employ_id='".$this->employ->getId()."'";
			$this->db->query("DELETE FROM " . DB_PREFIX . "employ_education WHERE employ_id = '" . $this->employ->getId() . "'");
			if (isset($data['education_rows'])) {
				foreach ($data['education_rows'] as $language_id => $value) {
					foreach ($value as $education_row) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "employ_education SET 
						employ_id = '" . $this->employ->getId() . "', 
						language_id = '" .(int)$language_id . "',
						degree='".$education_row['degree']."',
						collage='".$education_row['collage']."',
						percentage='".$education_row['percentage']."',
						passed_year='".$education_row['passed_year']."'");
					}
				}
			}
			$query = $this->db->query($sql);	
		}
	}
	public function getEducations($employ_id) {
		$education_row_data = array();
		$shipping_row_data='';
		$education_row_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ_education WHERE employ_id = '" . (int)$this->employ->getId() . "'");
			foreach ($education_row_query->rows as $education_row) {
				$shipping_row_data[$education_row['language_id']][] = array(
					'degree'     => $education_row['degree'],
					'collage'    => $education_row['collage'],
					'percentage' => $education_row['percentage'],
					'passed_year' => $education_row['passed_year']
				);
			}
		return $shipping_row_data;
	}
	public function getEducation ($employ_id){
		$sql="select * from " . DB_PREFIX . "employ_education where employ_id='".$this->employ->getId()."'";
		$query=$this->db->query($sql);
		return $query->rows;
	}
	public function getShowEducation($data){
		$sql="select * from " . DB_PREFIX . "employ_education where employ_id='".$this->employ->getId()."'";
		$query=$this->db->query($sql);
		return $query->rows;
	
	}


	public function getShowEducationsingale($employ_id){
		$sql="select * from " . DB_PREFIX . "employ_education where employ_id='".$employ_id."'";
		$query=$this->db->query($sql);
		return $query->rows;
	
	}

	public function getTotalemploysByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "employ WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}

	public function getemployrByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}





	public function getEmployByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		return $query->row;
	}
	public function verifyPassword($data){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "employ WHERE employ_id = '" . $data['employ_id'] . "'AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($data['oldpassword']) . "'))))) OR password = '" . $this->db->escape(md5($data['oldpassword'])) . "')");
		return $query->row['total'];
	}	


	public function getjobemploytotal($data = array()) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "employ where employ_id<>0";

		if (!empty($data['filter_status'])) {
		$sql .= " AND jobtype_id='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['job_filter'])) {
		$sql .= " AND category_id='" . $this->db->escape($data['job_filter']) . "'";
		}

		$query=$this->db->query($sql);
		return $query->row['total'];
	}
}
?>