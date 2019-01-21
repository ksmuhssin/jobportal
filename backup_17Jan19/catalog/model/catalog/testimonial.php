<?php
class ModelCatalogTestimonial extends Model {
	public function addtestimonial($data){
	$query = $this->db->query("INSERT INTO " . DB_PREFIX . "testimonial set name = '".$data['name']."'  , country = '".$data['country']."', enquiry = '".$data['enquiry']."', image = '".$data['image']."', rating = '" . (int)$data['rating'] . "', date = now()");
	}
	
	public function gettestimonial($data = array()){
	$query = $this->db->query("Select * FROM " . DB_PREFIX . "testimonial WHERE status = 1 LIMIT  " . (int)$data['start'] . "," . (int)$data['limit']."");
	
	return $query-> rows;
	
	}
	
	public function getTestimonials($data = array()){
	$sql = "Select * FROM " . DB_PREFIX . "testimonial";
	$query = $this->db->query($sql);
	return $query-> rows;
	
	}
}
?>
