<?php
class ModelCatalogTmdMegaheader extends Model {
	
	public function getmaxrow() {
	
		$sql = "select max(row) AS rows from ".DB_PREFIX."megaheader order by row DESC";
	
		$query = $this->db->query($sql);
		return $query->row['rows'];
	
	}
	public function getmegaheaders() {
	
		//// new changes ///
		$sql = "select * from ".DB_PREFIX."megaheader m left join  ".DB_PREFIX."megaheader_description md on(m.megaheader_id=md.megaheader_id) and md.language_id = '" . (int)$this->config->get('config_language_id') . "'  LEFT JOIN " . DB_PREFIX . "meagaheader_to_store m2s ON (m.megaheader_id = m2s.megaheader_id)  where  m.status=1 and m2s.store_id = '" . (int)$this->config->get('config_store_id') . "'   order by m.sort_order";
	
		$query = $this->db->query($sql);
		
		return $query->rows;
		//// new changes ///
	
	}
	
	public function getmegacustomlinks($megaheader_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_custom_type  m left join  ".DB_PREFIX."megaheader_ctype_desc md on(m.megaheader_cname_id	=md.megaheader_cname_id	)  WHERE m.megaheader_id = '" . (int)$megaheader_id . "'  and  md.language_id = '" . (int)$this->config->get('config_language_id') . "' group by  md.megaheader_cname_id   ORDER BY sort_order ASC");

		return $query->rows;
	}
	public function getmegaheadereditoer($megaheader_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "megaheader_cuscode_desc  WHERE megaheader_id = '" . (int)$megaheader_id . "'  and  language_id = '" . (int)$this->config->get('config_language_id') . "'");
		return $query->row;
	}
	
	
	
	
	
}