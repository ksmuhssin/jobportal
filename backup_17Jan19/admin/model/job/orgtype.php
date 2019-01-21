<?php
class ModelJobOrgtype extends Model {
	public function addOrgtype($data){ 
		 $sql="INSERT INTO " . DB_PREFIX . "orgtype set
			image='".$data['image']."',status='".(int)$data['status']."', date_added=now()";
		$this->db->query($sql);
		   
		$orgtype_id=$this->db->getLastId(); 
		foreach ($data['variation_desription'] as $language_id => $value){
			$this->db->query("INSERT INTO " .DB_PREFIX . "orgtype_description SET orgtype_id ='" . (int)$orgtype_id . "', language_id = '" . (int)$language_id . "', orgtype_name = '" . $this->db->escape($value['orgtype_name'])."',meta_title='". $this->db->escape($value['meta_title'])."',meta_description='". $this->db->escape($value['meta_description'])."',description = '" . $this->db->escape($value['description'])."',seo_keyword='". $this->db->escape($value['seo_keyword'])."',meta_keyword='". $this->db->escape($value['meta_keyword'])."'"); 
		}
		
		return $orgtype_id;
	}
	
	public function editOrgtype($orgtype_id,$data) {
		$sql="update " . DB_PREFIX . "orgtype set
		status='".(int)$data['status']."',
		image='".$data['image']."',
		date_modified=now() where orgtype_id='".$orgtype_id."'";
		$this->db->query($sql);
		$this->db->query("delete from " . DB_PREFIX . "orgtype_description where  orgtype_id = '" . (int)$orgtype_id . "'");
		foreach ($data['variation_desription'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "orgtype_description SET orgtype_id = '" . (int)$orgtype_id . "', language_id = '" . (int)$language_id . "', orgtype_name = '" . $this->db->escape($value['orgtype_name']) . "',seo_keyword='". $this->db->escape($value['seo_keyword'])."',
			meta_title  = '" . $this->db->escape($value['meta_title']) . "'");
		}
	}
	
	public function deleteOrgtype($orgtype_id){
		$sql="delete  from " . DB_PREFIX . "orgtype where orgtype_id='".$orgtype_id."'";
		$sql="delete  from " . DB_PREFIX . "orgtype_description where orgtype_id='".$orgtype_id."'";
		
		$query=$this->db->query($sql);
	}
	
	public function getOrgtypes($data){
		$sql="select * from " . DB_PREFIX . "orgtype p left join " . DB_PREFIX . "orgtype_description od on p.orgtype_id=od.orgtype_id where od.language_id='".$this->config->get('config_language_id')."'";
	
		$sort_data = array(
		'od.orgtype_name',
		'p.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.orgtype_name";
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
 public function getOrgtype($orgtype_id){
		$sql="select * from " . DB_PREFIX . "orgtype where orgtype_id='".$orgtype_id."'";
		$query=$this->db->query($sql);
		return $query->row;
}
 public function getOrgtypevariationDescriptions($orgtype_id) {
		$variation_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."orgtype_description WHERE orgtype_id = '" . (int)$orgtype_id . "'");
		foreach ($query->rows as $result) {
		$variation_descriptio_data[$result['language_id']] = array(
		'orgtype_name'       => $result['orgtype_name'],
		'meta_title'         => $result['meta_title'],
		'meta_description'   => $result['meta_description'],
		'seo_keyword'   		 => $result['seo_keyword'],
		'meta_keyword'       => $result['meta_keyword'],
		);
		}
		return $variation_descriptio_data;
 }			
 public function getTotalOrgtypes($data) {
		//$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "orgtype");
		$sql="select COUNT(*) AS total from " . DB_PREFIX . "orgtype p left join " . DB_PREFIX . "orgtype_description od on p.orgtype_id=od.orgtype_id where od.language_id='".$this->config->get('config_language_id')."'";
		$query = $this->db->query($sql);
		return $query->row['total'];
	}	
}