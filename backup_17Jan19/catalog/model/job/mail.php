<?php
class ModelJobMail extends Model {
		/* Signup*/
	public  function getMailInfo($companytype){
		
		$query=$this->db->query("select * from " . DB_PREFIX . "mail vm LEFT JOIN " . DB_PREFIX . "mail_language vml on(vm.mail_id=vml.mail_id) where vm.companytype='" .$companytype."'and vml.language_id = '" . (int)$this->config->get('config_language_id') . "'");
		// echo "select * from " . DB_PREFIX . "vendor_mail vm LEFT JOIN " . DB_PREFIX . "vendor_mail_language vml on(vm.mail_id=vml.mail_id) where vm.mail_id='" .$mail_id."'and vml.language_id = '" . (int)$this->config->get('config_language_id') . "'";
		//die();
		return $query->row;
		
	}
	
	/* Signup End*/
}
