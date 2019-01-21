<?php
class ControllerExtensionModuleSlideshow extends Controller {
	public function index($setting) {
		static $module = 0;		

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		$data['text_no_results']   = $this->language->get('text_no_results');
		$data['text_registerfind']   = $this->language->get('text_registerfind');

		$data['text_select']   = $this->language->get('text_select');

		if (isset($this->request->get['job_filter'])) {
		 	$job_filter = $this->request->get['job_filter'];
		} else {
		 	$job_filter = false;
		}

		if (isset($this->request->get['filter_search'])) {
		 $filter_search = $this->request->get['filter_search'];
		} else {
		 $filter_search = null;
		}
		if (isset($this->request->get['keyword_search'])) {
		 $keyword_search = $this->request->get['keyword_search'];
		} else {
		 $keyword_search = null;
		}

		if (isset($this->request->get['filter_location'])) {
		 $filter_location = $this->request->get['filter_location'];
		} else {
		 $filter_location = null;
		}

     	$url = '';
	
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_added';
		}
		
		

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		
		if (isset($this->request->get['job_filter'])) {
			$url .= '&job_filter=' . $this->request->get['job_filter'];
		}

		if (isset($this->request->get['filter_location'])) {
			$url .= '&filter_location=' . $this->request->get['filter_location'];
		}

		if (isset($this->request->get['filter_search'])) {
			$url .= '&filter_search=' . $this->request->get['filter_search'];
		}

		if (isset($this->request->get['keyword_search'])) {
			$url .= '&keyword_search=' . $this->request->get['keyword_search'];
		}

		

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		  $this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getJobCategories($data);


		$data['sort']     = $sort;
		$data['order']     = $order;
		$data['job_filter'] = $job_filter;
		$data['filter_search'] = $filter_search;
		$data['filter_location'] = $filter_location;
		$data['keyword_search'] = $keyword_search;

		if(isset($this->request->post['category_id'])){
		$data['category_id']=$this->request->post['category_id'];
		}else{
		$data['category_id']='';
		}

		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
					'title' => $result['title'],
					'link'  => $result['link'],
					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
			}
		}

		$data['module'] = $module++;

        $searchlayout = $this->config->get('jobportal_search');
							
        if($searchlayout=='search1'){
           return $this->load->view('extension/module/slideshow', $data);
		} elseif($searchlayout=='search2'){
          return $this->load->view('extension/module/slideshow1', $data);	
		}
          

		return $this->load->view('extension/module/slideshow', $data);
	}
}
