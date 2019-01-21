<?php
	class ModelJobMembership extends Model {
	public function addcompany($data){ 
		$this->db->query("INSERT INTO " .DB_PREFIX . "company SET country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',
		no_employees='".(int)$data['no_employees']."',full_name='".$this->db->escape($data['full_name'])."',
		company_name='".$this->db->escape($data['company_name'])."',email='".$this->db->escape($data['email'])."',salt = '" . $this->db->escape($salt = token(9)) . "',
		password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "',landline_phone='".$this->db->escape($data['landline_phone'])."',cell_phone='".$this->db->escape($data['cell_phone'])."',address='".$this->db->escape($data['address'])."',
		city='".$this->db->escape($data['city'])."',pincode='".$this->db->escape($data['pincode'])."',company_website='".$this->db->escape($data['company_website'])."',company_logo='".$this->db->escape($data['company_logo'])."',company_description='".$this->db->escape($data['company_description'])."',status=1,approved=1,date_added=now()"); 
	}
	public function showCompany($company_id) {
		$sql = "select * from " . DB_PREFIX ."company  where company_id='".$company_id."'";
		$query = $this->db->query($sql);
		return $query->row;
	}
	public function editCompany($data){ 	
		if(!empty($data['password'])){
			$sql = "update " .DB_PREFIX . "company SET salt = '" . $this->db->escape($salt = token(9)) . "',password = '" . $this->db->escape(sha1($salt . sha1($salt . sha1($data['password'])))) . "'  WHERE company_id = '" . $data['company_id'] ."'";
			$query = $this->db->query($sql);
		} else {
			$sql = "update " .DB_PREFIX . "company SET country_id='".(int)$data['country_id']."',zone_id='".(int)$data['zone_id']."',no_employees='".(int)$data['no_employees']."',
			full_name='".$this->db->escape($data['full_name'])."',company_name='".$this->db->escape($data['company_name'])."',email='".$this->db->escape($data['email'])."',					
			landline_phone='".$this->db->escape($data['landline_phone'])."',cell_phone='".$this->db->escape($data['cell_phone'])."',address='".$this->db->escape($data['address'])."',
			city='".$this->db->escape($data['city'])."',pincode='".$this->db->escape($data['pincode'])."',company_website='".$this->db->escape($data['company_website'])."',
			company_logo='".$this->db->escape($data['company_logo'])."',company_description='".$this->db->escape($data['company_description'])."',date_added=now() 
			where company_id='".(int)$data['company_id']."'"; 
			$query = $this->db->query($sql);
		}
 	}	
	public function verifyPassword($data){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "company WHERE company_id = '" . $data['company_id'] . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($data['oldpassword']) . "'))))) OR password = '" . $this->db->escape(md5($data['oldpassword'])) . "')");
		return $query->row['total'];

	}
	public function getCompany($company_id){
		$sql="select * from " . DB_PREFIX . "company where company_id='".$company_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}

	public function getCompanys($data = array()){
		$sql="select * from " . DB_PREFIX . "company where company_id<>0";
		if (isset($data['filter_full_name'])){
			$sql .=" and full_name like '".$this->db->escape($data['filter_full_name'])."%'";
		}
		if (isset($data['filter_company_name'])){
			$sql .=" and company_name like '".$this->db->escape($data['filter_company_name'])."%'";
		}
		if (isset($data['filter_country'])){
			$sql .=" and country_id like '".$this->db->escape($data['filter_country'])."%'";
		}
		if (isset($data['filter_zone'])){
			$sql .=" and zone_id like '".$this->db->escape($data['filter_zone'])."%'";
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
		}
		$query=$this->db->query($sql);
		return $query->rows;
	}
}	
?>