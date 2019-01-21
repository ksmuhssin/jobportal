<?php
	class Modeljobcompany extends Model {
	public function addcompany($data){ 
		$this->db->query("INSERT INTO " .DB_PREFIX . "company SET country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',
		no_employees='".(int)$data['no_employees']."',full_name='".$this->db->escape($data['full_name'])."',
		category_id='".$this->db->escape($data['category_id'])."',email='".$this->db->escape($data['email'])."',salt = '" . $this->db->escape($salt = token(9)) . "',
		password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',landline_phone='".$this->db->escape($data['landline_phone'])."',cell_phone='".$this->db->escape($data['cell_phone'])."',address='".$this->db->escape($data['address'])."',
		city='".$this->db->escape($data['city'])."',pincode='".$this->db->escape($data['pincode'])."',officeopen='".$this->db->escape($data['officeopen'])."',officeclose='".$this->db->escape($data['officeclose'])."',longitude='".$this->db->escape($data['longitude'])."',latitude='".$this->db->escape($data['latitude'])."',company_website='".$this->db->escape($data['company_website'])."',company_logo='".$this->db->escape($data['company_logo'])."',company_description='".$this->db->escape($data['company_description'])."',status=1,date_added=now()"); 
       
        $this->load->model('job/mail');
		$companytype ='company_signup_email';
		$mailinfo = $this->model_job_mail->getMailInfo($companytype);

		///print_r($mailinfo);die();

		if(isset($mailinfo['status'])){
			$find = array(
			   '{full_name}',
				'{email}',	
				'{cell_phone}',											
				'{loginlink}'										
			);
			$replace = array(
				'full_name'  => $data['full_name'],
				'email' 	 => $data['email'],
				'cell_phone'      => $data['cell_phone'],
				'loginlink'  => $this->url->link('company/login', '', 'SSL') . "\n\n"
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
	
	public function showCompany($company_id) {
		$sql = "select * from " . DB_PREFIX ."company  where company_id='".$company_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getcompanyrByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row;
	}
	
	public function editCompany($company_id,$data){ 
		$sql = "update " .DB_PREFIX . "company SET country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',no_employees='".(int)$data['no_employees']."',
		full_name='".$this->db->escape($data['full_name'])."',category_id='".$this->db->escape($data['category_id'])."',				
		landline_phone='".$this->db->escape($data['landline_phone'])."',cell_phone='".$this->db->escape($data['cell_phone'])."',address='".$this->db->escape($data['address'])."',
		city='".$this->db->escape($data['city'])."',pincode='".$this->db->escape($data['pincode'])."',company_website='".$this->db->escape($data['company_website'])."',
		officeopen='".$this->db->escape($data['officeopen'])."',officeclose='".$this->db->escape($data['officeclose'])."',
		company_logo='".$this->db->escape($data['company_logo'])."',company_description='".$this->db->escape($data['company_description'])."',longitude='".$this->db->escape($data['longitude'])."',latitude='".$this->db->escape($data['latitude'])."',date_added=now() 
		where company_id='".(int)$this->company->getId()."'"; 
		$query = $this->db->query($sql);
 	}

 	public function editPassword($company_id,$data){
		$sql = "update " .DB_PREFIX . "company SET salt = '" . $this->db->escape($salt = token(9)) . "',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',date_modified=now() WHERE company_id = '" . $this->company->getId() ."'";
		$query = $this->db->query($sql);
		/*if(isset($data['password'])){
			$sql = "update " .DB_PREFIX . "company SET salt = '" . $this->db->escape($salt = token(9)) . "',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "'  WHERE company_id = '" . $data['company_id'] ."'";
			$query = $this->db->query($sql);
		} */
	}	


 	public function getjobTotals($company_id) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.company_id='".$company_id."'";
		$query=$this->db->query($sql);
		return $query->row['total'];
	}


	public function getCompanyJobs($company_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.company_id='".$company_id."' ";
		$query = $this->db->query($sql);		
		return $query->rows;
	}


	
	public function verifyPassword($data){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company WHERE company_id = '" . $data['company_id'] . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($data['oldpassword']) . "'))))) OR password = '" . $this->db->escape(md5($data['oldpassword'])) . "')");
		return $query->row['total'];

	}


	public function getjobcompany($data = array()) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "company where company_id<>0 and approved=1";

		if (isset($data['filter_full_name'])){
			$sql .=" and full_name like '".$this->db->escape($data['filter_full_name'])."%'";
		}
		
		if (isset($data['filter_country'])){
			$sql .=" and country_id like '".$this->db->escape($data['filter_country'])."%'";
		}
		if (isset($data['filter_zone'])){
			$sql .=" and zone_id like '".$this->db->escape($data['filter_zone'])."%'";
		}

        if (isset($data['category_id'])){
			$sql .=" and category_id like '".$this->db->escape($data['category_id'])."%'";
		}
		$query=$this->db->query($sql);
		return $query->row['total'];
	}


	
	public function getCompany($company_id){
		$sql="select * from " . DB_PREFIX . "company where company_id='".$company_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getCompanys($data = array()){
		$sql="select * from " . DB_PREFIX . "company where company_id<>0 and approved=1";
		if (isset($data['filter_full_name'])){
			$sql .=" and full_name like '".$this->db->escape($data['filter_full_name'])."%'";
		}
		
		if (isset($data['filter_country'])){
			$sql .=" and country_id like '".$this->db->escape($data['filter_country'])."%'";
		}
		if (isset($data['filter_zone'])){
			$sql .=" and zone_id like '".$this->db->escape($data['filter_zone'])."%'";
		}

        if (isset($data['category_id'])){
			$sql .=" and category_id like '".$this->db->escape($data['category_id'])."%'";
		}


		$sort_data = array(
			'full_name',
			'country_id',
			'zone_id'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY full_name";
		}
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}
		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}
			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query=$this->db->query($sql);
		return $query->rows;
	}
	
	public function getInsert($data){
		
		$sql="INSERT INTO " .DB_PREFIX . "membership SET
			company_id='".$this->company->getId()."',card_number='".$this->db->escape($data['card_number'])."',expiry_month='".$this->db->escape($data['expiry_month'])."',expiry_year='".$this->db->escape($data['expiry_year'])."',cv_code='".$this->db->escape($data['cv_code'])."',date_added=now()"; 
		$this->db->query($sql);
	}


	public function getTotalCompanysByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}

	
	
	public function getmembers($data){
		$sql="INSERT INTO " .DB_PREFIX . "premimum_membership SET
			company_id='".$this->company->getId()."',card_number='".$this->db->escape($data['card_number'])."',expiry_month='".$this->db->escape($data['expiry_month'])."',expiry_year='".$this->db->escape($data['expiry_year'])."',cv_code='".$this->db->escape($data['cv_code'])."',date_added=now()"; 
		$this->db->query($sql);
	}
}	
?>