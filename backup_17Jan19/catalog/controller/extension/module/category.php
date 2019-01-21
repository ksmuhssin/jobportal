<?php
class ControllerExtensionModuleCategory extends Controller {
	public function index() {
		$this->load->language('extension/module/category');

		$data['heading_title'] = $this->language->get('heading_title');

		if (isset($this->request->get['path'])) {
			$parts = explode('_', (string)$this->request->get['path']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['category_id'] = $parts[0];
		} else {
			$data['category_id'] = 0;
		}

		$this->load->model('catalog/category');

		
        
        $this->load->model('tool/image');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getJobCategoriess(0);

		foreach ($categories as $category) {

			$filter_data = array(
				'filter_category_id'  => $category['category_id']
			);

			$data['categories'][] = array(
				'category_id' => $category['category_id'],
				'name'        => $category['name'],
                'thumb'       => $this->model_tool_image->resize($category['image'],$this->config->get($this->config->get('config_theme') . '_image_category_width'), $this->config->get($this->config->get('config_theme') . '_image_category_height')),
				'href'        => $this->url->link('job/category', 'category_id=' . $category['category_id'])
			);
		}
        
        $categorylayout = $this->config->get('jobportal_jobcategory');
							
        if($categorylayout=='jobcategory1'){
           return $this->load->view('extension/module/category', $data);
		} elseif($categorylayout=='jobcategory2'){
          return $this->load->view('extension/module/category1', $data);	
		}

		return $this->load->view('extension/module/category', $data);
	}
}