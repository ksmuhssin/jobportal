<?php
class ModelJobJobtype extends Model {
	public function addJobtype ($data){ 
		$sql="INSERT INTO " . DB_PREFIX . "jobtype set status='".(int)$data['status']."', date_added=now()";
		$this->db->query($sql);
		$jobtype_id=$this->db->getLastId(); 
		foreach ($data['variation_desription'] as $language_id => $value){
			$this->db->query("INSERT INTO " .DB_PREFIX . "jobtype_description SET 
			jobtype_id ='" . (int)$jobtype_id . "',language_id = '" . (int)$language_id . "',jobtype = '" . $this->db->escape($value['jobtype'])."',meta_title='". $this->db->escape($value['meta_title'])."',description='". $this->db->escape($value['description'])."',seo_keyword='". $this->db->escape($value['seo_keyword'])."',meta_description='". $this->db->escape($value['meta_description'])."',meta_keyword='". $this->db->escape($value['meta_keyword'])."'"); 
		}
		return $jobtype_id;
	}
	public function editJobtype($jobtype_id,$data) {
		$sql="update " . DB_PREFIX . "jobtype set
		status='".(int)$data['status']."',date_modified=now() where jobtype_id='".$jobtype_id."'";
		$this->db->query($sql);
		$this->db->query("delete from " . DB_PREFIX . "jobtype_description where  jobtype_id = '" . (int)$jobtype_id . "'");
		foreach ($data['variation_desription'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . 
			"jobtype_description SET jobtype_id = '" . (int)$jobtype_id . "',
			language_id = '" . (int)$language_id . "',jobtype = '" . $this->db->escape($value['jobtype']) . "',seo_keyword = '" . $this->db->escape($value['seo_keyword']) . "',description = '" . $this->db->escape($value['description']) . "',meta_description = '" . $this->db->escape($value['meta_description']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "',meta_title  = '" . $this->db->escape($value['meta_title']) . "'");
		}
	}	
	public function deleteJobtype($jobtype_id){		
		$sql="delete  from " . DB_PREFIX . "jobtype where jobtype_id='".$jobtype_id."'";
		$query=$this->db->query($sql);
	}
	public function getJobtype($jobtype_id){
		$sql="select * from " . DB_PREFIX . "jobtype where jobtype_id='".$jobtype_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}
 
	public function getJobDescription($jobtype_id){
		$sql="select * from " . DB_PREFIX . "jobtype_description where jobtype_id='".$jobtype_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}
 
	public function getJobtypes($data){
		$sql="select * from " . DB_PREFIX . "jobtype p left join " . DB_PREFIX . "jobtype_description od on p.jobtype_id=od.jobtype_id where od.language_id='".$this->config->get('config_language_id')."'";
		$sort_data = array(
			'od.jobtype',
			'od.meta_description',
			'p.status'
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.jobtype";
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
	public function getJobtypess($jobtype_id){
		$sql="select * from " . DB_PREFIX . "jobtype j left join " . DB_PREFIX . "jobtype_description od on j.jobtype_id=od.jobtype_id where od.language_id='".$this->config->get('config_language_id')."' and j.jobtype_id = '" . (int)$jobtype_id . "'";	
		$query = $this->db->query($sql);
		return $query->row;
	}
 
	public function getJobtypeDescriptions($jobtype_id) {
		$variation_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."jobtype_description WHERE jobtype_id = '" . (int)$jobtype_id . "'");
		foreach ($query->rows as $result) {
			$variation_descriptio_data[$result['language_id']] = array(
				'jobtype'            => $result['jobtype'],
				'meta_title'         => $result['meta_title'],
				'seo_keyword'        => $result['seo_keyword'],
				'description'        => $result['description'],
				'meta_description'   => $result['meta_description'],
				'meta_keyword'       => $result['meta_keyword'],
			);
		}
		return $variation_descriptio_data;
	}			
 				
	public function getTotalJobtypes() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "jobtype");
		return $query->row['total'];
	}	
}