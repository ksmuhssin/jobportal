<?php
class ControllerExtensionModuleCandidatehome extends Controller {
	public function index($setting) {
		$this->language->load('extension/module/candidatehome');
		
		/* Layout */
		
		
		
		$this->load->model('design/layout');
		$layout_id = 0;

		if ($route == 'information/information' && isset($this->request->get['information_id'])) {
			$this->load->model('catalog/information');

			$layout_id = $this->model_catalog_information->getInformationLayoutId($this->request->get['information_id']);
		}

		if (!$layout_id) {
			$layout_id = $this->model_design_layout->getLayout($route);
		}

		if (!$layout_id) {
			$layout_id = $this->config->get('config_layout_id');
		}
        ///OUR LATEST CANDIDATES start getEmploys

	    $this->load->model('job/employ');
        $data['employs_infos']=array();

        $employs_infos = $this->model_job_employ->getEmploys(array());  

        foreach ($employs_infos as $employs_info){
	        if(isset($employs_info['image'])){
			 $image = $this->model_tool_image->resize($employs_info['image'], $setting['width'], $setting['height']);
			}else{
			 $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
			}
        	$data['employs_infos'][]=array(
        	'fullname'     =>$employs_info['fullname'],
        	'employ_id'    =>$employs_info['employ_id'],
        	'image'        =>$image,
        	'href'         => $this->url->link('employ/employprofile&employ_id=' .$employs_info['employ_id']),
        	'profissional' =>$employs_info['profissional']
        	);
         	
         } 
    
        ///OUR LATEST CANDIDATES


		$this->load->model('extension/module');
		$data['modules'] = array();
		$data['contentbottom'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_bottom');
		$data['columntop'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_top');
		$data['columnleft'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_left');
		$data['columnright'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_right');
		
		/* Layout */
		
		return $this->load->view('extension/module/candidatehome', $data);
	}
}
?>
