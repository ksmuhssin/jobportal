<?php
class ModelCreateJobCreateJob extends Model {

	
	public function addJob($data) {
		$sql="INSERT INTO " . DB_PREFIX . "job set location='".$this->db->escape($data['location'])."',category_id='".$this->db->escape($data['category_id'])."',url='".$this->db->escape($data['url'])."',banner='".$this->db->escape($data['banner'])."',salary='".$this->db->escape($data['salary'])."',company_id='".$this->db->escape($data['comp_id'])."',status='".$this->db->escape($data['job_status'])."',jobtype_id='".$this->db->escape($data['jobtype_id'])."',
			date_added=now()";
		$this->db->query($sql);
		$job_id = $this->db->getLastId();

		if(isset($data['job_desc'])) {
			foreach ($data['job_desc'] as $language_id => $value) {
				$this->db->query("INSERT INTO " .DB_PREFIX . "job_description SET job_id='".(int)$job_id."',language_id = '" . (int)$language_id ."',title='".$this->db->escape($value['title'])."',meta_title='".$this->db->escape($value['meta_title'])."',description='".$this->db->escape($value['description'])."',tag='".$this->db->escape($value['tag'])."',experience='".$this->db->escape($value['experience'])."'");
			}//print_r($data['job_desc']);die();
		}
	}

//edit
	public function editJob($job_id, $data) {
		$this->db->query("UPDATE " . DB_PREFIX . "job set location='".$this->db->escape($data['location'])."',category_id='".$this->db->escape($data['category_id'])."',status='".$this->db->escape($data['job_status'])."',company_id='".$this->db->escape($data['comp_id'])."',url='".$this->db->escape($data['url'])."',banner='".$this->db->escape($data['banner'])."',salary='".$this->db->escape($data['salary'])."',jobtype_id='".$this->db->escape($data['jobtype_id'])."',date_modified=now() WHERE job_id = '" . (int)$job_id . "'");

		$this->db->query("DELETE FROM " . DB_PREFIX . "job_description WHERE job_id = '" . (int)$job_id . "'");
		if(isset($data['job_desc'])) {
			foreach ($data['job_desc'] as $language_id => $value) {
				$this->db->query("INSERT INTO " .DB_PREFIX . "job_description SET job_id='".(int)$job_id."',language_id = '" . (int)$language_id ."',title='".$this->db->escape($value['title'])."',meta_title='".$this->db->escape($value['meta_title'])."',description='".$this->db->escape($value['description'])."',tag='".$this->db->escape($value['tag'])."',experience='".$this->db->escape($value['experience'])."'");
			}
		}
	}

	
	public function getJob($job_id) {
		$sql = "SELECT * FROM " . DB_PREFIX . "job where job_id='".$job_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function getJobDescriptions($job_id) {
		$store_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."job_description WHERE job_id = '" . (int)$job_id . "'");
		foreach ($query->rows as $result) {
			$store_descriptio_data[$result['language_id']] = array(
				'title'=> $result['title'],
				'description'=> $result['description'],
				'tag'=> $result['tag'],
				'experience'=> $result['experience'],
				'meta_title'=> $result['meta_title'],
			);
	 	}

		return $store_descriptio_data;
	}
		
	public function getJobs($data) {
		$sql = "SELECT * FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) WHERE jd.language_id = '" . (int)$this->config->get('config_language_id') . "' and j.job_id<>0";
		//$sql = "SELECT * FROM " . DB_PREFIX . "job where job_id<>0";
		$sort_data = array(
			'j.job_id',
			'jd.title',
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY j.job_id";
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
	public function getTotalJobs($data) {
		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "job j LEFT JOIN " . DB_PREFIX . "job_description jd ON (j.job_id = jd.job_id) WHERE jd.language_id = '" . (int)$this->config->get('config_language_id') . "' and j.job_id<>0";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}

	public function deleteJob($job_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "job WHERE job_id = '" . (int)$job_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "job_description WHERE job_id = '" . (int)$job_id . "'");
		$this->cache->delete('job');
	}

	
}
