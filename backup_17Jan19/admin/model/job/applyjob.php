<?php
class ModelJobApplyjob extends Model {
	

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
			'cv',
			'date_added',
			'job_id'
		
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
			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}
		$query = $this->db->query($sql);		
		return $query->rows;
	}


	public function getjobcompanytotal($data) {
	  $sql="SELECT COUNT(*) AS total FROM " . DB_PREFIX . "apply_job where job_id<>0";
		
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

	public function geJobs($job_id) {
		$sql = "select * from " . DB_PREFIX . "job j left join " . DB_PREFIX . "job_description jd on j.job_id=jd.job_id where j.job_id='".$job_id."' ";

		$query = $this->db->query($sql);		
		return $query->row;
	}





  }
?>