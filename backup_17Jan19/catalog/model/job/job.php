<?php
class ModelJobJob extends Model {
	public function addJob($data) {	
		$status= 1;
		$adminstatus = $this->config->get('jobsetting_submitjob_register');
		if(!empty($adminstatus)) {
			$status = 1;
		} else {
			$status =0;
		}
		$sql = "INSERT INTO " .DB_PREFIX . "job SET salary='".$this->db->escape($data['salary'])."',status='".(int)$status."',company_id='".$this->company->getId()."',location     ='".$this->db->escape($data['location'])."',jobtype_id='".$this->db->escape($data['jobtype_id'])."',banner='".$this->db->escape($data['banner'])."',category_id  ='".(int)$data['category_id']."',url='".$this->db->escape($data['url'])."',date_added=now()";	
        $this->db->query($sql);
		
		$job_id=$this->db->getLastId();
			foreach ($data['submit_job'] as $language_id => $value){
			$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "job_description SET job_id ='" . (int) $job_id . "',language_id = '" . (int) $language_id . "',title = '" . $this->db->escape($value['title']) . "',description='" . $this->db->escape($value['description']) . "',meta_title='" . $this->db->escape($value['meta_title']) . "',experience='" . $this->db->escape($value['experience']) . "',tag='" . $this->db->escape($value['tag']) ."'");

		}

		$postjob = $this->config->get('config_email');
				
		$this->load->model('job/mail');
		$companytype ='admin_submitjob_mail';
		$mailinfo = $this->model_job_mail->getMailInfo($companytype);

		if(isset($mailinfo['status'])){
			$find = array(
			   									
			);
			$replace = array(
				
			);

		

			$find = array(

			);
			$replace = array(

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

			$mail->setTo($postjob);
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setHtml(html_entity_decode($message));
			$mail->send();
		}

	}

	public function getSubmitjobDescription($job_id){
		$submit_job_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "job_description WHERE job_id = '" . (int) $job_id . "'");
		foreach ($query->rows as $result){
			$submit_job_data[$result['language_id']] = array(

				'title'         => $result['title'],
				'description'   => $result['description'],
				'meta_title'    => $result['meta_title'],
				'experience'    => $result['experience'],
				'tag'           => $result['tag']
			);
		}

		return $submit_job_data;

	}


	public function editJob($job_id,$data) {	
		$sql = "update " .DB_PREFIX . "job SET salary='".$this->db->escape($data['salary'])."',status='1',company_id='".$this->company->getId()."',location='".$this->db->escape($data['location'])."',jobtype_id='".$this->db->escape($data['jobtype_id'])."',banner='".$this->db->escape($data['banner'])."',category_id  ='".(int)$data['category_id']."',url='".$this->db->escape($data['url'])."',date_added=now() where job_id='".$job_id."'"; 		
		$this->db->query($sql);
		
		$this->db->query("delete from " . DB_PREFIX . "job_description where  job_id = '" . (int) $job_id . "'");
		
			foreach ($data['submit_job'] as $language_id => $value){
			$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "job_description SET job_id ='" . (int) $job_id . "',language_id = '" . (int) $language_id . "',title = '" . $this->db->escape($value['title']) . "',description='" . $this->db->escape($value['description']) . "',meta_title='" . $this->db->escape($value['meta_title']) . "',experience='" . $this->db->escape($value['experience']) . "',tag='" . $this->db->escape($value['tag']) ."'");
         }
	

	}
	

	public function getJob($job_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id='".$job_id."'";
		$query = $this->db->query($sql);		
		return $query->row;
	}

	public function getJobCompany($job_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id='".$job_id."'and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		$query = $this->db->query($sql);		
		return $query->row;
	}

	public function getJobsimlerjob($category_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.category_id ='".$category_id ."'and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'ORDER BY date_added DESC LIMIT 4";
		$query = $this->db->query($sql);		
		return $query->rows;
	}


	public function getCompanyJobs($data) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id";

		if(isset($data['company_id'])){
		    $sql .=" where j.company_id='".$data['company_id']."' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}
	
		$sort_data = array( 
			'company_id',
		
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){
			$sql .= " ORDER BY " . $data['sort'];
		}else{
			$sql .= " ORDER BY company_id";}
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



	public function geJobs($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) LEFT JOIN " . DB_PREFIX . "company c ON (j.company_id = c.company_id)  WHERE j.job_id<>0 and j.status='1' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		
		if (!empty($data['filter_status'])) {
			$sql .= " AND j.jobtype_id='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['filter_location'])) {
			$sql .= " AND j.location='" . $this->db->escape($data['filter_location']) . "'";
		}

		if (!empty($data['filter_country_id'])) {
			$sql .= " AND c.country_id='" . $this->db->escape($data['filter_country_id']) . "'";
		}

		if (isset($data['filter_search'])){
			$sql .=" AND jd.title like '".$this->db->escape($data['filter_search'])."%'";
		}

		if (isset($data['keyword_search'])){
			$sql .=" AND jd.title like '".$this->db->escape($data['keyword_search'])."%'";
		}

		if (!empty($data['job_filter'])) {
			$sql .= " AND j.category_id='" . $this->db->escape($data['job_filter']) . "'";
		}
		
		$sort_data = array( 
			'jd.job_id',
		
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)){
			$sql .= " ORDER BY " . $data['sort'];
		}else{
			$sql .= " ORDER BY jd.job_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		}else {
			$sql .= " ASC";
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


	public function getjobTotals($data) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id<>0 and j.status='1' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
	    
		if (!empty($data['filter_status'])) {
			$sql .= " AND j.jobtype_id='" . $this->db->escape($data['filter_status']) . "'";
		}

		if (!empty($data['job_filter'])) {
			$sql .= " AND j.category_id='" . $this->db->escape($data['job_filter']) . "'";
		}

		if (!empty($data['filter_location'])) {
			$sql .= " AND j.location='" . $this->db->escape($data['filter_location']) . "'";
		}

		if (!empty($data['filter_country_id'])) {
			$sql .= " AND j.country_id='" . $this->db->escape($data['filter_country_id']) . "'";
		}

		if (isset($data['filter_search'])){
			$sql .=" AND jd.title like '".$this->db->escape($data['filter_search'])."%'";
		}

		if (isset($data['keyword_search'])){
			$sql .=" AND jd.title like '".$this->db->escape($data['keyword_search'])."%'";
		}

		$query=$this->db->query($sql);
		return $query->row['total'];
	}

	public function getJobs($company_id){
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.company_id='".$company_id."'";
		$query = $this->db->query($sql);		
		return $query->rows;
	}
	
	public function getJobss($data){
		$sql="select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where jd.language_id='".$this->config->get('config_language_id')."'";
		
		$query = $this->db->query($sql);
		return $query->rows;	
	}
	
	
	public function getJobsByCategory($data) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id";
		if(!empty($data['category_id'])){
			$sql .=" where j.category_id='".$data['category_id']."' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}
		if(isset($data['filter_status'])){
			$sql .=" and j.jobtype_id='".$data['filter_status']."'";
		}
		$query = $this->db->query($sql);		
		return $query->rows;
	}

	public function getTotals($data) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id";
		if(isset($data['company_id'])){
			$sql .=" where j.company_id='".$data['company_id']."' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}
		if(isset($data['filter_status'])){
			$sql .=" and j.jobtype_id='".$data['filter_status']."'";
		}
		$query=$this->db->query($sql);
		return $query->row['total'];
	}

	public function getTotalssub($data) {
		$sql="select COUNT(*) AS total FROM " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id<>0";
		if(!empty($data['category_id'])){
			$sql .=" and j.category_id='".$data['category_id']."' and jd.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		}
		if(isset($data['filter_status'])){
			$sql .=" and j.jobtype_id='".$data['filter_status']."'";
		}
		$query=$this->db->query($sql);
		return $query->row['total'];
	}


	public function deleteJob($job_id){
		$sql = "delete from " . DB_PREFIX . "job  where job_id='".$job_id."'";
		$this->db->query($sql);
		$sql = "delete from " . DB_PREFIX . "job_description  where job_id='".$job_id."'";	
		$query = $this->db->query($sql);
	}
	
	//get job by limit
	public function getJobbylimit($limit) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.status='1' order by  j.job_id DESC limit 0,".$limit;	
		$query = $this->db->query($sql);		
		return $query->rows;
	}
	
	
}	
	?>