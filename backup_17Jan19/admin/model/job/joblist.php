<?php
class ModelJobJoblist extends Model {

	public function deleteList($job_id){
		$sql="delete  from " . DB_PREFIX . "job where job_id='".$job_id."'";
		$query=$this->db->query($sql);
		$sql="delete  from " . DB_PREFIX . "job_description where job_id='".$job_id."'";
		$query=$this->db->query($sql);
	}
	
	public function getCompany($company_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "company WHERE company_id='".$company_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getJoblist($job_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) WHERE j.job_id='".$job_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function approve($job_id){
		$this->db->query("UPDATE " . DB_PREFIX . "job SET status = '1' WHERE job_id = '" . (int)$job_id . "'");
	}

	public function disApprove($job_id){
		$this->db->query("UPDATE " . DB_PREFIX . "job SET status = '0' WHERE job_id = '" . (int)$job_id . "'");
	}

	public function getLists($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) WHERE j.job_id<>0";

		if (isset($data['filter_company_id'])){
		 	$sql .=" and company_id like '".$this->db->escape($data['filter_company_id'])."%'";
		}
		if (isset($data['filter_experience'])){
		 	$sql .=" and jd.experience like '".$this->db->escape($data['filter_experience'])."%'";
		}

		$sort_data = array(
			
			'location',
			'experience',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY location";
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

	public function getTotalList($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) WHERE j.job_id<>0";

		if (isset($data['filter_company_id'])){
		 	$sql .=" and company_id like '".$this->db->escape($data['filter_company_id'])."%'";
		}

		if (isset($data['filter_experience'])){
		 	$sql .=" and jd.experience like '".$this->db->escape($data['filter_experience'])."%'";
		}
		

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
}
