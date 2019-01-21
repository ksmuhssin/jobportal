<?php
class ModelJobMessage extends Model {
	public function addMessage($data){ 
		$sql="INSERT INTO " . DB_PREFIX . "message set email = '" . $this->db->escape($data['email'])."',message = '" . $this->db->escape($data['message'])."',employ_id ='" .$this->employ->getId(). "', date_added=now()";
		$this->db->query($sql);
	}
		
	public function Messages($data){
		$sql = "select * from " . DB_PREFIX . "message where message_id<>0 and employ_id ='" .$this->employ->getId(). "'";
		$sort_data = array(
				'email',
				'message',
			
		);
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY email";
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
		
	public function Messagestotal($data){
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "message where employ_id ='" .$this->employ->getId(). "'");
		return $query->row['total'];

	}

}