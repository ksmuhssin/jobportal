<?php
class ControllerExtensionModuletestimonial extends Controller {
	public function index($setting) {
		if(!empty($setting)) {
		$this->language->load('extension/module/testimonial');
		
		$this->load->model('catalog/testimonial');
		
		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');
		
		$this->load->model('tool/image');
		
		$data['testimonial'] = array();
		
		$data = array(
			'start' => 0,
			'limit' => $setting['limit']
		);
		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_view'] = $this->language->get('text_view');
		$data['text_addtesti'] = $this->language->get('text_addtesti');
		
		$data['button_cart'] = $this->language->get('button_cart');
		/*new code*/
		$data['headingcolor']= $setting['testi_headingcolor'];
		$data['namecolor']= $setting['testi_namecolor'];
		$data['descolor']= $setting['testi_descolor'];
		$data['btnbg']= $setting['testi_btnbg'];
		$data['btnbghov']= $setting['testi_btnbghov'];
		$data['btncolor']= $setting['testi_btncolor'];
		$data['btnhovcolor']= $setting['testi_btnhovcolor'];
		$data['contentbg']= $setting['testi_contentbg'];
		$data['nextprev']= $setting['testi_nextprev'];
		$data['nextprevbg']= $setting['testi_nextprev_bg'];
		
		$this->load->model('tool/image');
		
		if ($setting['image']) {
		$data['bgimage'] = $this->model_tool_image->resize($setting['image'], $setting['testi_bgwidth'],$setting['testi_bgheight']);
		} else {
		$data['bgimage'] = '';
		}
		/*new code*/
		
		$data['testlink'] = $this->url->link('information/testimonial_list','',true);
		$data['addlink'] = $this->url->link('information/testimonial','',true);
		
		/* Layout */
		
		if (isset($this->request->get['route'])) {
			$route = (string)$this->request->get['route'];
		} else {
			$route = 'common/home';
		}
		
		
		$this->load->model('design/layout');
		$layout_id = 0;

		if ($route == 'product/category' && isset($this->request->get['path'])) {
			$this->load->model('catalog/category');

			$path = explode('_', (string)$this->request->get['path']);

			$layout_id = $this->model_catalog_category->getCategoryLayoutId(end($path));
		}

		if ($route == 'product/product' && isset($this->request->get['product_id'])) {
			$this->load->model('catalog/product');

			$layout_id = $this->model_catalog_product->getProductLayoutId($this->request->get['product_id']);
		}

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

		$this->load->model('extension/module');

		$data['modules'] = array();

		$data['contentbottom'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_bottom');
		$data['columntop'] = $this->model_design_layout->getLayoutModules($layout_id, 'content_top');
		$data['columnleft'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_left');
		$data['columnright'] = $this->model_design_layout->getLayoutModules($layout_id, 'column_right');
		

		/* Layout */

		$results = $this->model_catalog_testimonial->gettestimonial($data);
		foreach ($results as $result) {
			
			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], 99, 99);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 99, 99);
			}
			if ($result['image']) {
				$bigimage = $this->model_tool_image->resize($result['image'], 500, 500);
			} else {
				$bigimage = $this->model_tool_image->resize('placeholder.png', 500, 500);
			}
			
			$data['testimonial'][] = array(
				'testimonial_id' => $result['testimonial_id'],
				'name'    	 => $result['name'],
				'image'    	 => $image,
				'bigimage'    	 => $bigimage,
				'country'    => $result['country'],
				'enquiry'	 => utf8_substr(strip_tags(html_entity_decode($result['enquiry'], ENT_QUOTES, 'UTF-8')), 0, 150) . '..',
				'date'	 =>  $result['date'],
				'rating'    =>$result['rating']
			);
		}
            
        $testilayout = $this->config->get('jobportal_testimonial');
							
        if($testilayout=='testimonial1'){
           return $this->load->view('extension/module/testimonial', $data);
		} elseif($testilayout=='testimonial2'){
          return $this->load->view('extension/module/testimonial1', $data);	
		}
		
		
		return $this->load->view('extension/module/testimonial', $data);
		
		}
	}
}
?>
