<?php
class ModelJobResume extends Model {
	public function addResume($data) {
		$sql="INSERT INTO " . DB_PREFIX . "resume set jobtype_id='".(int)$data['jobtype_id']."',customer='".$this->db->escape($data['customer'])."',
		resume='".$this->db->escape($data['resume'])."',status='".(int)$data['status']."', date_added=now()";
		$this->db->query($sql);
	}   
	
	public function showResume($resume_id) {
		$sql = "select * from " . DB_PREFIX ."resume  where resume_id='".$resume_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}

	public function editResume($data){ 
		$sql = "update " .DB_PREFIX . "resume SET jobtype_id='".(int)$data['jobtype_id']."',customer='".$this->db->escape($data['customer'])."',resume='".$this->db->escape($data['resume'])."',
		status='".(int)$data['status']."', date_modified=now()where resume_id='".(int)$data['resume_id']."'"; 
		$query = $this->db->query($sql);		
	}	
}
?>