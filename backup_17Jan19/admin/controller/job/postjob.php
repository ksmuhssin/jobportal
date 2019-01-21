<?php
class ControllerJobPostJob extends Controller{
 private $error = array();
	public function index() {
		$this->load->language('job/postjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/postjob');
		$this->getList();
	}
	public function add(){
		$this->load->language('job/postjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/postjob');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_job_postjob->addPostJob($this->request->post);
			
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		$this->response->redirect($this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true));

		}
		$this->getform();
	}
	public function edit(){
        
		$this->load->language('job/postjob');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/postjob');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
			$this->model_job_postjob->editPostJob($this->request->get['job_id'],$this->request->post);
			//print_r($this->request->post);die();
			$this->session->data['success'] = $this->language->get('text_success');
            
		$url = '';
            
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
            
		$this->response->redirect($this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true));
		}
    
		$this->getForm();
	}
	public function getList()
		{
		if (isset($this->request->get['filter_title'])) {
			$filter_title = $this->request->get['filter_title'];
		} else {
			$filter_title = false;
		}
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = false;
		}
		if (isset($this->request->get['filter_country'])) {
			$filter_country = $this->request->get['filter_country'];
		} else {
			$filter_country = false;
		}
		if (isset($this->request->get['filter_zone'])) {
			$filter_zone = $this->request->get['filter_zone'];
		} else {
			$filter_zone = false;
		}
		if (isset($this->request->get['filter_jobtype'])) {
			$filter_jobtype = $this->request->get['filter_jobtype'];
		} else {
			$filter_jobtype = false;
		}
		if (isset($this->request->get['filter_category'])) {
			$filter_category = $this->request->get['filter_category'];
		} else {
			$filter_category = false;
		}
		if (isset($this->request->get['filter_company'])) {
			$filter_company = $this->request->get['filter_company'];
		} else {
			$filter_company = false;
		}
		if (isset($this->request->get['filter_meta_title'])) {
			$filter_meta_title = $this->request->get['filter_meta_title'];
		} else {
			$filter_meta_title = false;
		}
		if (isset($this->request->get['filter_city'])) {
			$filter_city = $this->request->get['filter_city'];
		} else {
			$filter_city = false;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'od.title';
		}
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
        
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		if (isset($this->request->get['filter_stauts'])) {
			$url .= '&filter_stauts=' . $this->request->get['filter_stauts'];
		}
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];
		}
		if (isset($this->request->get['filter_country'])) {
			$url .= '&filter_country=' . $this->request->get['filter_country'];
		}
		if (isset($this->request->get['filter_jobtype'])) {
			$url .= '&filter_jobtype=' . $this->request->get['filter_jobtype'];
		}
		if (isset($this->request->get['filter_category'])) {
			$url .= '&filter_category=' . $this->request->get['filter_category'];
		}
		if (isset($this->request->get['filter_company'])) {
			$url .= '&filter_company=' . $this->request->get['filter_company'];
		}
		if (isset($this->request->get['filter_title'])) {
			$url .= '&filter_title=' . $this->request->get['filter_title'];  
		}
		if (isset($this->request->get['filter_meta_title'])) {
			$url .= '&filter_meta_title=' . $this->request->get['filter_meta_title'];  
		}
		if (isset($this->request->get['filter_zone'])) {
			$url .= '&filter_zone=' . $this->request->get['filter_zone'];  
		}
		if (isset($this->request->get['filter_city'])) {
			$url .= '&filter_city=' . $this->request->get['filter_city'];  
		}
		
		$url = '';
		$data['postjobs']=array();
		$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
		'filter_title'      => $filter_title,
		'filter_meta_title' => $filter_meta_title,
		'filter_city'       => $filter_city,
		'filter_country'    => $filter_country,
		'filter_zone'       => $filter_zone,
		'filter_jobtype'    => $filter_jobtype,
		'filter_category'   => $filter_category,
		'filter_company'    => $filter_company,
		'start'             => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit'             => $this->config->get('config_limit_admin')
		);
		
		$this->load->model('job/jobtype');
		$data['jobtypes'] =$this->model_job_jobtype->getJobtypes($data);
		$postjob_total = $this->model_job_postjob->getTotalPostJobs($filter_data);
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('job/jobtype');
		$this->load->model('job/company');
		
		$results=$this->model_job_postjob->getPostJobs($filter_data);
		foreach($results as $result)
		{
		 $country_info=$this->model_localisation_country->getCountry ($result['country_id']);
		 if(isset($country_info['name']))
			{
			 $country=$country_info['name'];         
			}
			else
			{
				$country='';
			}
			$zone_info = $this->model_localisation_zone->getZone($result['zone_id']);
			if(isset($zone_info['name']))
			{
			 $zone=$zone_info['name'];         
			}
			else
			{
				$zone='';
			}
			$company_info = $this->model_job_company->getCompany($result['company_id']);
			if(isset($company_info['full_name']))
			{
			 $company=$company_info['full_name'];         
			}
			else
			{
				$company='';
			}
			
			if($result['jobtype_id']==1)
			{
				$type= "Part Time";
			} else {
				$type="Full Time";
			}
			
			$data['postjobs'][]=array(
			'job_id'    =>$result['job_id'],
			'jobtype_id'=>$result['jobtype_id'],
			'meta_title'=>$result['meta_title'],
			'title'     =>$result['title'],
			'city'      =>$result['city'],
			'country'   =>$country,
			'company'   =>$company,
			'zone'      =>$zone,
			'type'      =>$type,
			'edit'=> $this->url->link('job/postjob/edit', 'token=' . $this->session->data['token'] . '&job_id=' .$result['job_id'] . $url, true));
		}		
		
		$url = '';
        
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['filter_title']      = $filter_title;
		$data['filter_country']    = $filter_country;
		$data['filter_zone']       = $filter_zone;
		$data['filter_jobtype']    = $filter_jobtype;
		$data['filter_category']   = $filter_category;
		$data['filter_company']    = $filter_company;
		$data['filter_city']       = $filter_city;
		$data['filter_meta_title'] = $filter_meta_title;

		$data['sort_title']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=od.orgtype_name' . $url, true);
		
		$data['sort_country'] = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=p.country' . $url, true);
		
		$data['sort_meta_title']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=od.meta_title' . $url, true);
		
		$data['sort_zone']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=p.zone' . $url, true);
		
		$data['sort_company']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=p.company' . $url, true);
		
		$data['sort_city']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=p.city' . $url, true);
		
		$data['sort_jobtype_id']  = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . '&sort=p.jobtype_id' . $url, true);

		$data['heading_title']           = $this->language->get('heading_title');
		$data['text_select']             = $this->language->get('text_select');
		$data['text_form']               = $this->language->get('text_form');
		$data['text_full_time']          = $this->language->get('text_full_time');
		$data['text_part_time']          = $this->language->get('text_part_time');
		$data['text_list']               = $this->language->get('text_list');
		$data['text_enable']             = $this->language->get('enable');
		$data['text_disable']            = $this->language->get('disable');
		$data['text_no_results']         = $this->language->get('text_no_results');
		$data['text_confirm']            = $this->language->get('text_confirm');
		$data['token']                   = $this->session->data['token'];
		$data['text_none'] 				 = $this->language->get('text_none');  

		$data['column_titlename']        = $this->language->get('column_titlename');
		$data['column_country']          = $this->language->get('column_country');
		$data['column_zone']             = $this->language->get('column_zone');
		$data['column_companys']         = $this->language->get('column_companys');
		$data['column_meta_title']       = $this->language->get('column_meta_title');
		$data['column_city']             = $this->language->get('column_city');
		$data['column_jobtype_id']       = $this->language->get('column_jobtype_id');
		$data['column_action']           = $this->language->get('column_action');
		
		$data['filters_title']          = $this->language->get('filters_title');
		$data['filters_country']        = $this->language->get('filters_country');
		$data['filters_zone']           = $this->language->get('filters_zone');
		$data['filters_meta_title']     = $this->language->get('filters_meta_title');
		$data['filters_company']        = $this->language->get('filters_company');
		$data['filters_city']           = $this->language->get('filters_city');
			
		$data['button_add']              = $this->language->get('button_add');
		$data['button_cancle']           = $this->language->get('button_cancle');
		$data['button_delete']           = $this->language->get('button_delete');
		$data['button_edit']             = $this->language->get('button_edit');
		$data['button_view']             = $this->language->get('button_view');
		$data['button_filter']           = $this->language->get('button_filter');

		
        
            //// variable define
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		
		$data['breadcrumbs'] = array();
        
		$url = '';
        
		$data['breadcrumbs'] = array();
        
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true)
		);
			////////select for list///////
		$data['results'] = '';
        
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

		unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		
		if (!isset($this->request->get['job_id'])) {
			$data['action'] = $this->url->link('job/postjob/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/postjob/edit', 'token=' . $this->session->	data['token'] . '&job_id=' . $this->request->get['job_id'] . $url, true);
		}
		
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
			//action button
			
		 $data['add']    = $this->url->link('job/postjob/add', '&token=' . $this->session->data['token'] . $url, true);
		 
		 $data['delete'] = $this->url->link('job/postjob/delete', '&token=' . $this->session->data['token'] . $url, true);
      
		if (!isset($this->request->get['job_id'])) {
	  	$data['action'] = $this->url->link('job/postjob/add', 'token=' . $this->session->data['token'] . $url, true);
		
		} else {
		$data['action'] = $this->url->link('job/postjob/edit', 'token=' . $this->session->data['token'] . '&job_id=' . $this->request->get['job_id'] . $url, true);
		}
		$data['add']    = $this->url->link('job/postjob/add', 'token=' . $this->session->data['token'] . $url, true);
		
		$data['delete'] = $this->url->link('job/postjob/delete', 'token=' . $this->session->data['token'] . $url, true);
		    /////pagination
		$url = '';
		
		if (isset($this->request->get['sort'])) {
		$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
		$url .= '&order=' . $this->request->get['order'];
		}
		
		$pagination        = new Pagination();
		$pagination->total = $postjob_total;
		$pagination->page  = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url   = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
        
		$data['results'] = sprintf($this->language->get('text_pagination'), ($postjob_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($postjob_total - $this->config->get('config_limit_admin'))) ? $postjob_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $postjob_total, ceil($postjob_total / $this->config->get('config_limit_admin')));
        
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/postjob_list', $data));
	}
	public function getform(){
		$data['heading_title']              = $this->language->get('heading_title');
		$data['text_form']                  = $this->language->get('text_form');
		$data['text_full_time']             = $this->language->get('text_full_time');
		$data['text_part_time']             = $this->language->get('text_part_time');
		$data['text_form']                  = $this->language->get('text_form');
		$data['text_select']                = $this->language->get('text_select');
		$data['text_list']                  = $this->language->get('text_list');
		$data['text_enable']                = $this->language->get('enable');
		$data['text_none'] 					= $this->language->get('text_none');	
		$data['text_disable']               = $this->language->get('disable');

		$data['tab_general']                = $this->language->get('tab_general');
		$data['tab_data']                   = $this->language->get('tab_data');
		$data['tab_question']               = $this->language->get('Question');

		$data['lable_title_name']           = $this->language->get('lable_title_name');
		$data['lable_description']          = $this->language->get('lable_description');
		$data['lable_meta_title']           = $this->language->get('lable_meta_title');
		$data['lable_meta_description']     = $this->language->get('lable_meta_description');
		$data['lable_meta_keyword']         = $this->language->get('lable_meta_keyword');
		$data['lable_SEO_keyword']          = $this->language->get('lable_SEO_keyword');
		$data['lable_tags']                 = $this->language->get('lable_tags');
		$data['lable_experience']           = $this->language->get('lable_experience');
		$data['lable_salary']               = $this->language->get('lable_salary');
		$data['lable_url']                  = $this->language->get('lable_url');
		$data['lable_country']              = $this->language->get('lable_country');
		$data['lable_zone']                 = $this->language->get('lable_zone');
		$data['lable_city']                 = $this->language->get('lable_city');
		$data['lable_location']             = $this->language->get('lable_location');
		$data['lable_category']             = $this->language->get('lable_category');
		$data['lable_jobtype']              = $this->language->get('lable_jobtype');
		$data['lable_company']              = $this->language->get('lable_company');
		$data['lable_status']               = $this->language->get('lable_status');
		$data['lable_question']             = $this->language->get('lable_question');

		$data['entry_title_name']           = $this->language->get('entry_title_name');
		$data['entry_description']          = $this->language->get('entry_description');
		$data['entry_meta_title']           = $this->language->get('entry_meta_title');
		$data['entry_meta_description']     = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword']         = $this->language->get('entry_meta_keyword');
		$data['entry_SEO_keyword']          = $this->language->get('entry_SEO_keyword');
		$data['entry_tags']                 = $this->language->get('entry_tags');
		$data['entry_experience']           = $this->language->get('entry_experience');
		$data['entry_salary']               = $this->language->get('entry_salary');
		$data['entry_url']                  = $this->language->get('entry_url');
		$data['entry_country']              = $this->language->get('entry_country');
		$data['entry_zone']                 = $this->language->get('entry_zone');
		$data['entry_city']                 = $this->language->get('entry_city');
		$data['entry_location']             = $this->language->get('entry_location');
		$data['entry_category']             = $this->language->get('entry_category');
		$data['entry_jobtype']              = $this->language->get('entry_jobtype');
		$data['entry_company']              = $this->language->get('entry_company');
		$data['entry_status']               = $this->language->get('entry_status');
		$data['entry_question']             = $this->language->get('entry_question');
		
		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
		$data['button_save']                = $this->language->get('button_save');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_cancel']              = $this->language->get('button_cancel');
      
		$data['breadcrumbs'] = array();
        
		$url = '';
        
		$data['breadcrumbs'] = array();
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_home'),
				'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
			);
			
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
			
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
		} else {
			$data['error_title'] = '';
		}
		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = '';
		}
		
		if (isset($this->error['variation_desriptions'])) {
			$data['error_variation_desriptions'] = $this->error['variation_desriptions'];
		} else {
			$data['error_variation_desriptions'] = '';
		}
		
		if (isset($this->error['sort_order'])) {
			$data['error_sort_order'] = $this->error['sort_order'];
		} else {
			$data['error_sort_order'] = '';
		}
			
		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('heading_title'),
		'href' => $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true)
		);
		if (!isset($this->request->get['job_id'])) {

		 $data['action'] = $this->url->link('job/postjob/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
 
		 $data['action'] = $this->url->link('job/postjob/edit', 'token=' . $this->session->data['token'] . '&job_id=' . $this->request->get['job_id'] . $url, true);
		}
		$data['cancel'] = $this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true);
			// Language //
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/country');
		$data['countrys'] = $this->model_localisation_country->getCountries($data);
		
		$this->load->model('localisation/zone');
		$data['zone'] = $this->model_localisation_zone->getZones($data);
		
		$this->load->model('catalog/category');
		$data['category'] =$this->model_catalog_category->getCategories($data);
		
			
			// Edit Form //
		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$postjob_info = $this->model_job_postjob->getPostJobs($this->request->get['job_id']);
		}
		
		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$jobpost_info = $this->model_job_postjob->getPostJobselect($this->request->get['job_id']);
		}
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['selected'])) {
		 $data['selected'] = (array) $this->request->post['selected'];
		} else {
	  	$data['selected'] = array();
		}
		
		if (isset($this->request->post['question_type'])) {
			$data['question_type'] = $this->request->post['question_type'];
		}elseif (isset($this->request->get['job_id'])) {
			$data['question_type'] = $this->model_job_postjob->getPostjobQuestionType($this->request->get['job_id']);
		} else {
			$data['question_type'] = array(0);
		}
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (isset($jobpost_info['city'])) {
			$data['city'] = $jobpost_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (isset($jobpost_info['location'])) {
			$data['location'] = $jobpost_info['location'];
		} else {
			$data['location'] = '';
		}
		
		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = $this->request->post['country_id'];
		} elseif (!empty($jobpost_info)) {
		  $data['country_id'] = $jobpost_info['country_id'];
		} else {	
			$data['country_id'] = '';
		}
		
		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = $this->request->post['zone_id'];
		} elseif (!empty($jobpost_info)) {
		  $data['zone_id'] = $jobpost_info['zone_id'];
		} else {	
			$data['zone_id'] = '';
		}	
		
		if (isset($this->request->post['jobtype_id'])) {
			$data['jobtype_id'] = $this->request->post['jobtype_id'];
		} elseif (!empty($jobpost_info)) {
		  $data['jobtype_id'] = $jobpost_info['jobtype_id'];
		} else {	
			$data['jobtype_id'] = '';
		}	
		
		if (isset($this->request->post['status'])) {
		$data['status'] = $this->request->post['status'];
		} elseif (!empty($jobpost_info)) {
		$data['status'] = $jobpost_info['status'];
		} else {
		$data['status'] = true;
		}

		if (isset($this->request->post['company_id'])) {
			$data['company_id'] = $this->request->post['company_id'];
		} elseif (isset($postjob_info['company_id'])) {
			$data['company_id'] = $postjob_info['company_id'];
		} else {
			$data['company_id'] = '';
		}	

		
		
		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
		$postjobs_infos = $this->model_job_postjob->getPostjobcategory($this->request->get['job_id']);
		}
		$data['token'] = $this->session->data['token'];
		// Edit //
		/// category ///
	
		if (isset($this->request->post['category_id']))
		{
			$category_ids = $this->request->post['category_id'];
		} 
		elseif (!empty($postjobs_infos))
		{
			$category_ids = $this->model_job_postjob->getCategorybyid($this->request->get['job_id']);
		} 
		else
		{
			$category_ids = array();
		}
		
		$data['categories']=array();
		$this->load->model('catalog/category');
		if(!empty($category_ids))
		{
			foreach($category_ids as $category_id)
			{
				$category_info=$this->model_catalog_category->getCategory($category_id);
				
				if(!empty($category_info['path']))
				 {
					$category=$category_info['path'].' > '.$category_info['name'];
				 }
				else
				 {
					$category=$category_info['name'];
				 }
				$data['categories'][]=array(
				'category_id'=>$category_id,
				'name'=>$category,
				);
			}
			 
		}
		
		// company 
		if (isset($this->request->post['company_id'])) {
			$data['company_id'] = $this->request->post['company_id'];
		}elseif (isset($jobpost_info['company_id'])){
			$data['company_id'] = $jobpost_info['company_id'];
		}else {
			$data['company_id'] = '';		
		}
		
		if(!empty($data['company_id'])){	
			$this->load->model('job/company');
			$companys_info=$this->model_job_company->getCompany($data['company_id']);
			$data['company_name']=$companys_info['full_name'];
		} else {
			$data['company_name']='';
		}
		
		if (isset($this->request->post['variation_desription'])) {
			$data['variation_desription'] = $this->request->post['variation_desription'];
		} elseif (isset($jobpost_info)) {
			$data['variation_desription'] = $this->model_job_postjob->getPostJobDescriptions($this->request->get['job_id']);
		} else {
			$data['variation_desription'] = array();
		}
		
		$this->load->model('tool/image');
		if (isset($this->request->post['banner_image'])) {
			$postjob_variation = $this->request->post['banner_image'];
		} elseif (isset($this->request->get['banner_id'])) {
			$postjob_variation = $this->model_job_postjob->getPostjobquestion($this->request->get['job_id']);
		} else {
			$postjob_variation = array();
		}
		$data['postjob_variation'] = array();
		foreach ($postjob_variation as $key => $value) {
			foreach ($value as $postjob_view) {
		   
				$data['postjob_variation'][$key][] = array(
				'question'      => $postjob_view['question']
				);
			}
		}
	  
		$data['header']       = $this->load->controller('common/header');
		$data['column_left']  = $this->load->controller('common/column_left');
		$data['footer']       = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/postjob_form', $data));
	}
	public function validateForm(){
		if (!$this->user->hasPermission('modify', 'job/postjob')) {
		$this->error['warning'] = $this->language->get('error_permission');
		}
		foreach ($this->request->post['variation_desription'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64))  {
			$this->error['title'][$language_id] = $this->language->get('error_title');
			} 
			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)) {
			$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			} 
		}
    return !$this->error;
	}
	protected function validateDelete(){
		if (!$this->user->hasPermission('modify', 'job/postjob')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	public function delete() {
		$this->load->language('job/postjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/postjob');
		//change delete//
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
		foreach ($this->request->post['selected'] as $job_id) {
			
		$this->model_job_postjob->deletPostJobs($job_id);
		}
		$this->session->data['success'] = $this->language->get('text_success');

		$url = '';

		if (isset($this->request->get['sort'])) {
		$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
		$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['page'])) {
		$url .= '&page=' . $this->request->get['page'];
		}
		$this->response->redirect($this->url->link('job/postjob', 'token=' . $this->session->data['token'] . $url, true));
		}
			$this->getList();
		}
}