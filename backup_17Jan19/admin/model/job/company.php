<?php
class ModelJobCompany extends Model {
	public function addCompany($data)
	{ 	
		if($this->config->get('jobsetting_company_register')==1){
			$approved=1;
		}else{
			$approved=0;
		}
		$sql="INSERT INTO " .DB_PREFIX . "company SET
			category_id='".(int)$data['category_id']."',
			country_id='".(int)$data['country_id']."',
			zone_id='".(int)$data['zone_id']."',
			full_name='".$this->db->escape($data['full_name'])."',
			longitude='".$this->db->escape($data['longitude'])."',
			latitude='".$this->db->escape($data['latitude'])."',
			email='".$this->db->escape($data['email'])."',
			salt = '" . $this->db->escape($salt = token(9)) . "',
			password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',
			landline_phone='".$this->db->escape($data['landline_phone'])."',
			cell_phone='".$this->db->escape($data['cell_phone'])."',
			address='".$this->db->escape($data['address'])."',
			city='".$this->db->escape($data['city'])."',
			pincode='".$this->db->escape($data['pincode'])."',
			officeopen='".$this->db->escape($data['officeopen'])."',
			officeclose='".$this->db->escape($data['officeclose'])."',
			company_website='".$this->db->escape($data['company_website'])."',
			no_employees='".$this->db->escape($data['no_employees'])."',
			company_description='".$this->db->escape($data['company_description'])."', 
			company_logo='".$this->db->escape($data['company_logo'])."',
			approved         = '".$approved."',
			status=1,
			date_added=now()"; 
		$this->db->query($sql);
	}
	public function editCompany($company_id,$data){
		$sql="update  " . DB_PREFIX . "company set
			category_id='".(int)$data['category_id']."',
			country_id='".(int)$data['country_id']."',
			zone_id='".(int)$data['zone_id']."',
			full_name='".$data['full_name']."',
			email='".$data['email']."',
			officeopen='".$this->db->escape($data['officeopen'])."',
			officeclose='".$this->db->escape($data['officeclose'])."',
			address='".$data['address']."',
			longitude='".$this->db->escape($data['longitude'])."',latitude='".$this->db->escape($data['latitude'])."',landline_phone='".$data['landline_phone']."',pincode='".$data['pincode']."',company_website='".$data['company_website']."',company_logo='".$data['company_logo']."',no_employees='".$data['no_employees']."',company_description='".$this->db->escape($data['company_description'])."',cell_phone='".$data['cell_phone']."',address='".$data['address']."',city='".$data['city']."',date_modified=now() where company_id='".$company_id."'";				
		if ($data['password']) {
			$this->db->query("UPDATE `" . DB_PREFIX . "company` SET 
			salt = '" . $this->db->escape($salt = token(9)) . "',
			password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "' WHERE company_id = '" . (int)$company_id . "'");
		}
	 
	 $this->db->query($sql);
	}
	public function deleteComapny($company_id)
	{
		$sql="delete  from " . DB_PREFIX . "company where company_id='".$company_id."'";
		$query=$this->db->query($sql);		
	}
	public function getCompany($company_id)
	{
		$sql="select * from " . DB_PREFIX . "company where company_id='".$company_id."'";
		$query=$this->db->query($sql);
		
		return $query->row;
	}

	public function getCompanys($data){
		$sql="select * from " . DB_PREFIX . "company where company_id<>0";
		
		if (isset($data['filter_full_name']))
		{
			$sql .=" and full_name like '".$this->db->escape($data['filter_full_name'])."%'";
		}
		
		if (isset($data['filter_email']))
		{
			$sql .=" and email like '".$this->db->escape($data['filter_email'])."%'";
		}
		
		$sort_data = array(
		'full_name',
		'company_name',
		'country_id',
		'zone_id'
		);
			
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		 $sql .= " ORDER BY " . $data['sort'];
		} else {
		 $sql .= " ORDER BY full_name";
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
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query=$this->db->query($sql);
		return $query->rows;
	}
	
	public function approve($company_id){
		$this->db->query("UPDATE " . DB_PREFIX . "company SET approved = '1' WHERE company_id = '" . (int)$company_id . "'");
	
         $this->load->model('job/mail');
		$companytype = 'company_approve_mail';
		$mailinfo = $this->model_job_mail->getMailInfo($companytype);

        
		$company_info = $this->model_job_company->getCompany($company_id);
           
		if(isset($mailinfo['status'])){
			$find = array(
				'{firstname}',
				'{email}',		
				'{loginlink}'										
			);

			if(isset($company_info['full_name'])){
			  $firstname=$company_info['full_name'];
			}else{
			  $firstname='';
			}

			if(isset($company_info['email'])){
			  $emaillist=$company_info['email'];
			}else{
			  $emaillist='';
			}

			$replace = array(
			 	'firstname'  => $firstname,
				 'email' 	 => $emaillist,
				 'loginlink'  => $this->url->link('company/login', '', 'SSL') . "\n\n"
			);

		    $subject = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['subject']))));
			$message = str_replace(array("\r\n", "\r", "\n"), '', preg_replace(array("/\s\s+/", "/\r\r+/", "/\n\n+/"), '', trim(str_replace($find, $replace, $mailinfo['message']))));
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($emaillist);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		}

	}
	public function disApprove($company_id){
		$this->db->query("UPDATE " . DB_PREFIX . "company SET approved = '0' WHERE company_id = '" . (int)$company_id . "'");
	}

	public function getTotalCompanysByEmail($email) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

		return $query->row['total'];
	}
	
	public function getTotalCompanys($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company where company_id<>0";
		if (isset($data['filter_full_name']))
		{
			$sql .=" and full_name like '".$this->db->escape($data['filter_full_name'])."%'";
		}
		if (isset($data['filter_company_name']))
		{
			$sql .=" and company_name like '".$this->db->escape($data['filter_company_name'])."%'";
		}
		if (isset($data['filter_email']))
		{
			$sql .=" and email like '".$this->db->escape($data['filter_email'])."%'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function getCompanyByEmail($email) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");
		return $query->row;
	}
}								
?>