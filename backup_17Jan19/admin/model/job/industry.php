<?php
class ModelJobIndustry extends Model {
	public function addIndustry($data){ 
		$sql="INSERT INTO " . DB_PREFIX . "industry set
		image='".$data['image']."',status='".(int)$data['status']."', date_added=now()";
		$this->db->query($sql);
		   
		$industry_id=$this->db->getLastId(); 
		
		foreach ($data['variation_desription'] as $language_id => $value) {
			$this->db->query("INSERT INTO " .DB_PREFIX . "industry_description SET 	industry_id ='" . (int)$industry_id . "', language_id = '" . (int)$language_id ."', industry_name = '" . $this->db->escape($value['industry_name'])."',meta_title = '" . $this->db->escape($value['meta_title'])."',meta_keyword = '" . $this->db->escape($value['meta_keyword']).
			"',description = '" . $this->db->escape($value['description']).
			"',seo_keyword = '" . $this->db->escape($value['seo_keyword']).
			"',meta_description = '" . $this->db->escape($value['meta_description'])."'"); 
		}
		return $industry_id;					
	}
	public function editIndustry($industry_id,$data){
		$sql="update " .DB_PREFIX . "industry set
		image='".$data['image']."',status='".(int)$data['status']."',date_modified=now() where industry_id='".$industry_id."'";
		$this->db->query($sql);

		$this->db->query("delete from " . DB_PREFIX . "industry_description where  industry_id = '" . (int)$industry_id . "'");
		
		foreach ($data['variation_desription'] as $language_id => $value) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "industry_description SET industry_id = '" . (int)$industry_id . "',language_id = '" . (int)$language_id . "', industry_name = '" . $this->db->escape($value['industry_name']) . "',meta_title = '" . $this->db->escape($value['meta_title']) . "',meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "',
		meta_description = '" . $this->db->escape($value['meta_description']) . "',
		seo_keyword = '" . $this->db->escape($value['seo_keyword']) . "',
		description  = '" .$this->db->escape($value['description']) . "'");
		}
	}
	public function deleteIndustry($industry_id){
		$sql="delete  from " . DB_PREFIX . "industry where industry_id='".$industry_id."'";
		$query=$this->db->query($sql);	
		$sql="delete  from " . DB_PREFIX . "industry_description where industry_id='".$industry_id."'";
		$query=$this->db->query($sql);	
	}	
	public function getIndustry($data){
		$sql="select * from " . DB_PREFIX . "industry p left join " . DB_PREFIX . "industry_description pvd on p.industry_id=pvd.industry_id where pvd.language_id='".$this->config->get('config_language_id')."'";

		$sort_data = array(
		 'pvd.industry_name',
		 'p.status'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
		 $sql .= " ORDER BY " . $data['sort'];
		} else {
		 $sql .= " ORDER BY pvd.industry_name";
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
	public function getindustryvariation($industry_id){
		$sql="select * from " . DB_PREFIX . "industry where  industry_id='".	  $industry_id."'";
		$query=$this->db->query($sql);
		return $query->row;
	}
	public function getIndustryDescriptions($industry_id){
		$variation_descriptio_data = array();
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX ."industry_description WHERE industry_id = '" . (int)$industry_id . "'");
		 foreach ($query->rows as $result) {
			$variation_descriptio_data[$result['language_id']] = array(
			'industry_name'        => $result['industry_name'],
			'meta_title'           => $result['meta_title'],
			'meta_keyword'         => $result['meta_keyword'],
			'meta_description'     => $result['meta_description'],
			'seo_keyword'          => $result['seo_keyword'],
			'description'          => $result['description'],
			);
		}
		return $variation_descriptio_data;
	}	
	public function getIndustrytotal($data){
		$sql="select count(*) as total from " .DB_PREFIX . "industry p left join " . DB_PREFIX . "industry_description pvd on p.industry_id=pvd.industry_id where pvd.language_id='".$this->config->get('config_language_id')."'";
			
		$query=$this->db->query($sql);
		return $query->row['total'];
	}	
}