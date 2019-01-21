<?php
class ModelJobApplyjob extends Model {
	public function addapply($data) {
		$sql="INSERT INTO " . DB_PREFIX . "apply_job set 
		job_id='".(int)$data['job_id']."',employ_id='".$this->employ->getId()."',firstname='".$this->db->escape($data['firstname'])."',lastname='".$this->db->escape($data['lastname'])."',email='".$this->db->escape($data['email'])."',cv='".$this->db->escape($data['cv'])."',information='".$this->db->escape($data['information'])."',
		date_added=now()";
		$this->db->query($sql);

		$this->load->model('job/mail');
		$companytype ='apply_Job_email';
		$mailinfo = $this->model_job_mail->getMailInfo($companytype);
		$companyinfos= $this->model_job_applyjob->getappyjobjob($data['job_id']);
         ///employ
		$getemployinfo= $this->model_job_applyjob->getemploy($companyinfos['employ_id']);
     	$companyinfo= $this->model_job_applyjob->geJobs($companyinfos['job_id']);

	    ///companyemail
    	$geJobsinfo= $this->model_job_applyjob->getcompanyjob($companyinfo['company_id']);

		if(isset($mailinfo['status'])){
			$find = array(
				'{fullname}',
				'{employemail}',	
				'{profissional}',											
				'{loginlink}'										
			);

			if(isset($geJobsinfo['email'])){
			 $companyemail=	$geJobsinfo['email'];
			}else{
			 $companyemail='';
			} 

			if(isset($getemployinfo['profissional'])){
			 $profissional=	$getemployinfo['profissional'];
			}else{
			 $profissional='';
			} 

			if(isset($getemployinfo['fullname'])){
			 $fullname=	$getemployinfo['fullname'];
			}else{
			 $fullname='';
			} 
			if(isset($getemployinfo['email'])){
			 $employemail=$getemployinfo['email'];
			}else{
			 $employemail='';
			}

			$replace = array(
				'full_name'      => $fullname,
				'employemail' 	 => $employemail,
				'profissional'   => $profissional,
				'loginlink'       => $this->url->link('employ/login', '', 'SSL') . "\n\n"
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

			$mail->setTo($companyemail);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();


	
	}




	} 


	public function sendemail($data) {
		$sql="INSERT INTO " . DB_PREFIX . "candidate_email set employ_id='".(int)$data['employ_id']."',name='".$this->db->escape($data['name'])."',message='".$this->db->escape($data['message'])."',companyemail='".$this->db->escape($data['companyemail'])."',phone='".$this->db->escape($data['phone'])."',
		date_added=now()";
		$this->db->query($sql);
		$candidate_id=$this->db->getLastId();
		return $candidate_id;
	} 


	public function getcandidate($candidate_id) {
	   $sql = "select * from " . DB_PREFIX . "candidate_email where candidate_id='".$candidate_id."'";
	   $query = $this->db->query($sql);		
		return $query->row;
	}





	public function getapplys($data) {
		$sql = "select * from " . DB_PREFIX . "apply_job where job_id<>0";

		if(!empty($data['job_id']))
		{
	  	 $sql .=" and job_id='".$data['job_id']."'";
	  	}

		$sort_data = array( 
			'firstname',
		
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){
			$sql .= " ORDER BY " . $data['sort'];
		}else{
			$sql .= " ORDER BY firstname";}
		if (isset($data['order']) && ($data['order'] == 'DESC')) {
		$sql .= " ASC";
		}else {
			$sql .= " DESC";
		}
		if (isset($data['start']) || isset($data['limit'])){
		if ($data['start'] < 0){
			$data['start'] = 0;
		}
		if ($data['limit'] < 1){
			$data['limit'] = 20;
		}
			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}
		$query = $this->db->query($sql);		
		return $query->rows;
	}


	public function getjobcompanytotal($data) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "apply_job where job_id<>0";

		if(!empty($data['job_id']))
		{
	  	$sql .=" and job_id='".$data['job_id']."'";
	  	}

		$query=$this->db->query($sql);
		return $query->row['total'];
	}

	public function getsumbitjobtotal($job_id) {
	  $sql="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "apply_job where job_id='".$job_id."'";
		
	$query=$this->db->query($sql);
		return $query->row['total'];
	}

	public function deleteappleyjob($ap_id){		
	  $this->db->query("delete from " . DB_PREFIX . "apply_job where ap_id ='".$ap_id."'");
	}


	public function getempleyjob($data) {
	   $sql = "select * from " . DB_PREFIX . "apply_job where employ_id='".$this->employ->getId()."'";
      
	   $query = $this->db->query($sql);		
		return $query->rows;
	}


	public function getcompanyjob($company_id) {
	   $sql = "select * from " . DB_PREFIX . "company where company_id='".$company_id."'";
	   $query = $this->db->query($sql);		
		return $query->row;
	}

	public function getappyjob($employ_id) {
	   $sql = "select * from " . DB_PREFIX . "apply_job where employ_id='".$this->employ->getId()."'";
	   $query = $this->db->query($sql);		
		return $query->row;
	}

	public function getappyjobjob($job_id) {
	   $sql = "select * from " . DB_PREFIX . "apply_job where job_id='".$job_id."'";
	   $query = $this->db->query($sql);		
		return $query->row;
	}

	public function getemploy($employ_id){
		$sql="select * from " . DB_PREFIX . "employ where employ_id='".$employ_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}



	public function geJobs($job_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id='".$job_id."' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$query = $this->db->query($sql);		
		return $query->row;
	}





  }
?>