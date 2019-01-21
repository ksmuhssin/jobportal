<?php
	class ControllerEmployListEmploy extends Controller {
	private $error = array();
		public function index() {
		$this->load->language('employ/listemploy');

      if (isset($this->request->get['job_filter'])) {
		 	$job_filter = $this->request->get['job_filter'];
		} else {
		 	$job_filter = false;
		}

		if (isset($this->request->get['filter_status'])) {
		 $filter_status = $this->request->get['filter_status'];
		} else {
		 $filter_status = null;
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

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$this->load->model('job/employ');
		$this->load->model('tool/image');

         $data['employinfos']=array(); 


         $filter_data = array(
			'job_filter'  => $job_filter,
			'filter_status'  => $filter_status,
			'sort'         => $sort,
			'order'        => $order,
			'start'        => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'        => $this->config->get('config_limit_admin')
		);



        $employ_total = $this->model_job_employ->getjobemploytotal($filter_data);

		$employ_infos=$this->model_job_employ->getEmploys($filter_data);



        foreach ($employ_infos as $employinfo) {

		if(isset($employinfo['image'])){
		$thumb = $this->model_tool_image->resize($employinfo['image'],360,280);
		}else{
		$thumb = $this->model_tool_image->resize('placeholder.png',360,280);
		}
		if(isset($employinfo['about_self'])){
		   $description = html_entity_decode($employinfo['about_self'],100);
		}

        $data['employinfos'][]=array(
            'fullname'      => $employinfo['fullname'],
            'employ_id'     => $employinfo['employ_id'],
            'address'       => $employinfo['address'],
             'profissional' => $employinfo['profissional'],
            'image'         => $thumb,
            'description'   => $description,
            'href'          => $this->url->link('employ/employprofile&employ_id=' .$employinfo['employ_id']),
            'quickemploy'  => $this->url->link('employ/quickemploy&employ_id=' .$employinfo['employ_id'])
      
          	);
      }


		$pagination = new Pagination();
		$pagination->total = $employ_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('employ/listemploy','&page={page}', true);

		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($employ_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($employ_total - $this->config->get('config_limit_admin'))) ? $employ_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $employ_total, ceil($employ_total / $this->config->get('config_limit_admin')));



		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['job_filter'] = $job_filter;
		$data['filter_status'] = $filter_status;

		$url = '';
		
		if (isset($this->request->get['job_filter'])) {
			$url .= '&job_filter=' . $this->request->get['job_filter'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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
        
        if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} else {
			$data['category_id'] = '';
		}   

		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_no_results'] = $this->language->get('No Results');
		$data['text_limit'] = $this->language->get('text_limit');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_sort'] = $this->language->get('text_sort');

		$data['text_parttime']	     = $this->language->get('text_parttime');
		$data['text_fulltime']	     = $this->language->get('text_fulltime');
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

       $this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getJobCategories($data);

		$categorieslists=$this->model_catalog_category->getJobCategories($data);
         $categories=(array_slice($categorieslists, 2,5));
		foreach ($categories as $categorieslists) {
           $data['categorieslists'][]=array(
           	'category_id'=>$categorieslists['category_id'],
           	'name'      =>$categorieslists['name'],
           	  'href'          => $this->url->link('employ/listemploy', 'job_filter=' . $categorieslists['category_id'])
           	);
		
		}




		
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('employ/listemploy', $data));
		}
	}
