<?php
	class ModelJobPostJob extends Model {
	public function addPostJob($data){ 
	$sql="INSERT INTO " . DB_PREFIX . "job set country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',company_id='".(int)$data['company_id']."',
	city='".$data['city']."',location='".$data['location']."',status='".(int)$data['status']."',jobtype_id='".(int)$data['jobtype_id']."',date_added=now()";
	$this->db->query($sql);
	$job_id=$this->db->getLastId(); 
	foreach ($data['variation_desription'] as $language_id => $value){
		$this->db->query("INSERT INTO " .DB_PREFIX . "job_description SET job_id ='" . (int)$job_id . "',language_id = '" . (int)$language_id . "',	title = '" . $this->db->escape($value['title'])."',
		experience = '" . $this->db->escape($value['experience'])."',salary = '" . $this->db->escape($value['salary'])."',url = '" . $this->db->escape($value['url'])."',
		meta_title='". $this->db->escape($value['meta_title'])."',description='". $this->db->escape($value['description'])."',meta_description='". $this->db->escape($value['meta_description'])."',
		meta_keyword='". $this->db->escape($value['meta_keyword'])."',seo_keyword='". $this->db->escape($value['seo_keyword'])."',tag='". $this->db->escape($value['tag'])."'"); 
	}
	if (isset($data['question_type'])){
		foreach ($data['question_type'] as $question_tab){
			$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "job_question SET job_id = '" . (int) $job_id . "',question = '" . $this->db->escape($question_tab['question']) . "'");
		}
	}	
	if (isset($data['category_id'])){
		foreach ($data['category_id'] as $category_id){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "postjob_to_category SET job_id = '" . (int) $job_id . "',category_id='" .(int) $category_id . "'");
		}
	}	
	return $job_id;
 }
	
	public function editPostJob($job_id,$data) {
		$sql="update " . DB_PREFIX . "job set	country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',company_id='" . (int) $data['company_id'] . "',
		city='" . $data['city'] . "',location='" . $data['location'] . "',status='".(int)$data['status']."',jobtype_id='".(int)$data['jobtype_id']."',date_modified=now() where job_id='".$job_id."'";
		$this->db->query($sql);
		$this->db->query("delete from " . DB_PREFIX . "job_description where  job_id = '" . (int)$job_id . "'");
		foreach ($data['variation_desription'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "job_description SET job_id = '" . (int)$job_id . "',language_id = '" . (int)$language_id . "',title = '" . $this->db->escape($value['title']) ."',
			experience = '" . $this->db->escape($value['experience']) ."',salary = '" . $this->db->escape($value['salary'])."',	url = '" . $this->db->escape($value['url'])."',
			meta_description = '" . $this->db->escape($value['meta_description']) . "',description='". $this->db->escape($value['description'])."',	meta_title  = '" .$this->db->escape($value['meta_title']) . "',
			meta_keyword='". $this->db->escape($value['meta_keyword'])."',seo_keyword='". $this->db->escape($value['seo_keyword'])."',tag='". $this->db->escape($value['tag'])."'");
		}
		$this->db->query("delete from " . DB_PREFIX . "job_question where  job_id = '" . (int) $job_id . "'");
		if (isset($data['question_type'])){
			foreach ($data['question_type'] as $question_type){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "job_question SET job_id = '" . (int) $job_id . "',question = '" . $this->db->escape($question_type['question']) . "'");
			}
		}
		$this->db->query("delete from " . DB_PREFIX . "postjob_to_category where  $job_id = '" . (int) $job_id . "'");

	if (isset($data['category_id'])){
		foreach ($data['category_id'] as $category_id){
				$sql = $this->db->query("INSERT INTO " . DB_PREFIX . "postjob_to_category SET job_id = '" . (int) $job_id . "',category_id='" . $category_id . "'");

		}
	}
		
		
	}
		
		
	public function getPostjobquestion($job_id){
		$sql = "select * from " . DB_PREFIX . "job_question where job_id='" . $job_id . "'";$query = $this->db->query($sql);
		return $query->rows;
	}	
	public function getPostjobcategory($job_id){
		$sql = "select * from " . DB_PREFIX . "postjob_to_category where job_id='" . $job_id . "'";
		$query = $this->db->query($sql);
		return $query->rows;
	}	
	public function getCategorybyid($job_id){
		$category_id = array();
		$sql   = "select * from " . DB_PREFIX . "postjob_to_category where job_id='" . $job_id . "'";$query = $this->db->query($sql);
		foreach ($query->rows as $result){
			$category_id[] = $result['category_id'];
		}
		return $category_id;
	}
		
	public function getPostjobQuestionType($job_id) {
		$question_type_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "job_question WHERE job_id = '" . (int)$job_id . "'");
		foreach ($query->rows as $result) {
			$question_type_data[] = array(
				'question'         => $result['question']
			);
		}
		return $question_type_data;
	}
		
	public function getPostJobs($data){
		$sql="select * from " . DB_PREFIX . "job p left join " . DB_PREFIX . "job_description od on p.job_id=od.job_id where od.language_id='".$this->config->get('config_language_id')."'";
		if (isset($data['filter_title'])){
			$sql .=" and od.title like '".$this->db->escape($data['filter_title'])."%'";
		}
	
		if (isset($data['filter_country'])){
			$sql .=" and p.country_id like '".$this->db->escape($data['filter_country'])."%'";
		}
		if (isset($data['filter_meta_title'])){
			$sql .=" and od.meta_title like '".$this->db->escape($data['filter_meta_title'])."%'";
		}
		if (isset($data['filter_zone'])){
			$sql .=" and p.zone_id like '".$this->db->escape($data['filter_zone'])."%'";
		}
		if (isset($data['filter_city'])){
			$sql .=" and p.city like '".$this->db->escape($data['filter_city'])."%'";
		}
		if (isset($data['filter_jobtype'])){
			$sql .=" and p.jobtype_id like '".$this->db->escape($data['filter_jobtype'])."%'";
		}
		
		if (isset($data['filter_company'])){
			$sql .=" and p.company_id like '".$this->db->escape($data['filter_company'])."%'";
		}
		$sort_data = array(
				'od.title',
				'p.country_id',
				'p.zone_id',
				'p.city',
				'od.meta_title'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.title";
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
		$query = $this->db->query($sql);
		return $query->rows;
	}
		
	public function getPostJobselect($job_id){
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id='".$job_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}
	public function getPostJobDescriptions($job_id) {
		$variation_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."job_description WHERE job_id = '" . (int)$job_id . "'");
		foreach ($query->rows as $result) {
			$variation_descriptio_data[$result['language_id']] = array(
				'url'=> $result['url'],
				'tag'=> $result['tag'],
				'title'=> $result['title'],
				'salary'=> $result['salary'],
				'experience'=> $result['experience'],
				'meta_title'=> $result['meta_title'],
				'seo_keyword'=> $result['seo_keyword'],
				'description'=> $result['description'],
				'meta_keyword'=> $result['meta_keyword'],
				'meta_description'=> $result['meta_description'],
			);
		}
		return $variation_descriptio_data;
	}	
		
	public function deletPostJobs($job_id) {
		$sql = "delete from " . DB_PREFIX . "job  where job_id='".$job_id."'";
		$this->db->query($sql);
		$sql = "delete from " . DB_PREFIX . "job_description  where job_id='".$job_id."'";	
		$query = $this->db->query($sql);
	}
		
	public function getTotalPostJobs($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.job_id) AS total FROM " . DB_PREFIX . "job p LEFT JOIN " . DB_PREFIX . "job_description od ON (p.job_id = od.job_id)";
		$sql .= " WHERE od.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		if (isset($data['filter_title'])){
			$sql .=" and od.title like '".$this->db->escape($data['filter_title'])."%'";
		}
		if (isset($data['filter_country'])){
			$sql .=" and p.country_id like '".$this->db->escape($data['filter_country'])."%'";
		}
		if (isset($data['filter_meta_title'])){
			$sql .=" and od.meta_title like '".$this->db->escape($data['filter_meta_title'])."%'";
		}
		if (isset($data['filter_zone'])){
			$sql .=" and p.zone_id like '".$this->db->escape($data['filter_zone'])."%'";
		}
		if (isset($data['filter_city'])){
			$sql .=" and p.city like '".$this->db->escape($data['filter_city'])."%'";
		}
		if (isset($data['filter_jobtype'])){
			$sql .=" and p.jobtype_id like '".$this->db->escape($data['filter_jobtype'])."%'";
		}
		if (isset($data['filter_company'])){
			$sql .=" and p.company_id like '".$this->db->escape($data['filter_company'])."%'";
		}
		$query = $this->db->query($sql);
		return $query->row['total'];
	}
}