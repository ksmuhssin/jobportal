	<?php
	class ControllerJobPostjob extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('job/postjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		$this->load->model('job/postjob');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_job_postjob->addPostJob($this->request->post);
			$this->response->redirect($this->url->link('job/postjob/view'));
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
			$this->response->redirect($this->url->link('job/postjob_form',$url, true));
		}
		
		
		
		$this->load->model('localisation/country');
		$data['countrys'] = $this->model_localisation_country->getCountries($data);
		$this->load->model('localisation/country');
		$data['nationality'] = $this->model_localisation_country->getCountries($data);
		$this->load->model('localisation/zone');        
		$data['zone'] = $this->model_localisation_zone->getZonesByCountryId($data);
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_job'),
			'href' => $this->url->link('job/job', '', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_Postjob'),
			'href' => $this->url->link('job/postjob', '', true)
		);
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']              = $this->language->get('heading_title');
		$data['text_form']                  = !isset($this->request->get['information_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_account_already']       = sprintf($this->language->get('text_account_already'), $this->url->link('account/login', '', true));
		$data['text_your_details']          = $this->language->get('text_your_details');
		$data['text_your_address']          = $this->language->get('text_your_address');
		$data['text_your_password']         = $this->language->get('text_your_password');
		$data['text_newsletter']            = $this->language->get('text_newsletter');
		$data['text_select']                = $this->language->get('text_select');
		$data['text_none']                  = $this->language->get('text_none');
		$data['text_loading']               = $this->language->get('text_loading');
		$data['text_default']               = $this->language->get('text_default');
		$data['text_male']                  = $this->language->get('Male');
		$data['text_female']                = $this->language->get('Female');
		$data['entry_title']                = $this->language->get('entry_title');
		$data['entry_image']                = $this->language->get('entry_image');
		$data['entry_description']          = $this->language->get('entry_description');
		$data['entry_title_name']           = $this->language->get('entry_title_name');
		$data['entry_tags']                 = $this->language->get('entry_tags');
		$data['entry_status']               = $this->language->get('entry_status');
		$data['entry_meta_title']           = $this->language->get('entry_meta_title');
		$data['entry_meta_description']     = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword']         = $this->language->get('entry_meta_keyword');
		$data['entry_SEO_keyword']          = $this->language->get('entry_SEO_keyword');
		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
		$data['entry_parent']               = $this->language->get('entry_parent');
		$data['entry_products']             = $this->language->get('entry_products');
		$data['entry_image']                = $this->language->get('entry_image');
		$data['entry_country']              = $this->language->get('entry_country');
		$data['entry_price']                = $this->language->get('entry_price');
		$data['entry_question']             = $this->language->get('entry_question');
		$data['entry_company']              = $this->language->get('entry_company');
		$data['entry_zone']                 = $this->language->get('entry_zone');
		$data['entry_city']                 = $this->language->get('entry_city');
		$data['entry_category']             = $this->language->get('entry_category');
		$data['entry_jobtype']              = $this->language->get('entry_jobtype');
		$data['entry_Description_property'] = $this->language->get('entry_Description_property');
		$data['tab_general']                = $this->language->get('General');
		$data['button_continue']            = $this->language->get('button_continue');
		$data['tab_data']                   = $this->language->get('Data');
		$data['tab_rate']                   = $this->language->get('Rate/Price');
		$data['tab_question']               = $this->language->get('Question');
		$data['entry_nationality']          = $this->language->get('entry_nationality');
		$data['entry_mobile_phone']         = $this->language->get('entry_mobile_phone');
		$data['entry_home_phone']           = $this->language->get('entry_home_phone');
		$data['entry_gender']               = $this->language->get('entry_gender');
		$data['entry_birth_date']           = $this->language->get('entry_birth_date');
		$data['entry_email']                = $this->language->get('entry_email');
		$data['entry_password']			    = $this->language->get('entry_password');
		$data['entry_status']				= $this->language->get('entry_status');
		$data['entry_fullname']             = $this->language->get('entry_fullname');
		$data['entry_url']                  = $this->language->get('entry_url');
		$data['entry_confirm_password']     = $this->language->get('entry_confirm_password');
		$data['entry_address']              = $this->language->get('entry_address');
		$data['entry_state']                = $this->language->get('entry_state');
		$data['entry_city']   				= $this->language->get('entry_city');
		$data['entry_pincode']			    = $this->language->get('entry_pincode');
		$data['entry_country']              = $this->language->get('entry_country');
		$data['entry_customer_group']       = $this->language->get('entry_customer_group');
		$data['button_save']                = $this->language->get('button_save');
		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_cancel']              = $this->language->get('button_cancel');
		$data['button_continue']            = $this->language->get('button_continue');
		$data['button_upload']              = $this->language->get('button_upload');
		$data['text_enable']                = $this->language->get('Enable');
		$data['text_disable']               = $this->language->get('Disable');
		$data['text_full_time']         	= $this->language->get('text_full_time');
		$data['text_part_time']          	= $this->language->get('text_part_time');
		$data['button_cancel']          	= $this->language->get('button_cancel');
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
		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}
		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}
		$data['customer_groups'] = array();
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		}else {
			$data['text_agree'] = '';
		}
		if ($this->config->get('config_account_id')) {
		$this->load->model('catalog/information');
		$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}
		$url='';
     	$data['cancel']    = $this->url->link('job/postjob/view',$url, true);
		if(isset($this->request->post['title'])){
			$data['title']=$this->request->post['title'];
		}else{
			$data['title']='';
		}
		if(isset($this->request->post['email'])){
			$data['email']=$this->request->post['email'];
		}else{
			$data['email']='';
		}

		if(isset($this->request->post['country_id'])){
			$data['country_id']=$this->request->post['country_id'];
		}else{
			$data['country_id']='';
		}

		if(isset($this->request->post['zone_id'])){
			$data['zone_id']=$this->request->post['zone_id'];
		}else{
			$data['zone_id']='';
		}
		if(isset($this->request->post['jobtype_id'])){
			$data['jobtype_id']=$this->request->post['jobtype_id'];
		}else{
			$data['jobtype_id']='';
		}
		if(isset($this->request->post['category_id'])){
			$data['category_id']=$this->request->post['category_id'];
		}else{
			$data['category_id']='';
		}
		if(isset($this->request->post['jobtype_id'])){
			$data['jobtype_id']=$this->request->post['jobtype_id'];
		}else{
			$data['jobtype_id']='';
		}
		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (isset($postjob_info['city'])) {
			$data['city'] = $postjob_info['city'];
		} else {
			$data['city'] = '';
		}
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($postjob_info['status'])) {
		$data['status'] = $postjob_info['status'];
		} else {
			$data['status'] = '';
		}
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (isset($postjob_info['status'])) {
			$data['status'] = $postjob_info['status'];
		} else {
			$data['status'] = '';
		}
		if(!empty($data['company_id'])){	
			$this->load->model('job/company');
		$companys_info=$this->model_job_company->getCompany($data['company_id']);
			$data['company_name']=$companys_info['full_name'];
		}else{
			$data['company_name']='';
		}
		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')){
			$postjob_info = $this->model_job_postjob->getPostJobs($this->request->get['job_id']);
		}

		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$jobpost_info = $this->model_job_postjob->getPostJobselect
			($this->request->get['job_id']);
		}
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
		if (isset($this->request->post['category_id']))	{
			$category_ids = $this->request->post['category_id'];
		}elseif (!empty($postjobs_infos)){
			$category_ids = $this->model_job_postjob->getCategorybyid($this->request->get['job_id']);
		} else{
			$category_ids = array();
		}
	
		$data['categories']=array();
		$this->load->model('job/category');
		if(!empty($category_ids)){
		foreach($category_ids as $category_id){
			$category_info=$this->model_job_category->getCategory($category_id);
			///subcategory//
			if(!empty($category_info['path'])){
				$category=$category_info['path'].' > '.$category_info['name'];
			}else{
				$category=$category_info['name'];
			}
			///subcategory//
			$data['categories'][]=array(
				'category_id'=>$category_id,
				'name'=>$category, );
			}
		}
		// company 
		if (isset($this->request->post['company_id'])){
			$data['company_id'] = $this->request->post['company_id'];
		}elseif (isset($jobpost_info['company_id'])) {
			$data['company_id'] = $jobpost_info['company_id'];
		}else {
			$data['company_id'] = '';		
		}
		if(!empty($data['company_id'])){	
			$this->load->model('job/company');
			$companys_info=$this->model_job_company->getCompany($data['company_id']);
			$data['company_name']=$companys_info['full_name'];
		}else{
			$data['company_name']='';
		}
		
		if (isset($this->request->post['variation_desription'])){
			$data['variation_desription'] = $this->request->post['variation_desription'];
		} elseif (isset($jobpost_info)) {
			$data['variation_desription'] = $this->model_job_postjob->getPostJobDescriptions($this->request->get['job_id']);
		} else {
			$data['variation_desription'] = array();
		}
		
		$this->load->model('tool/image');
		if (isset($this->request->post['banner_image'])){
			$postjob_variation = $this->request->post['banner_image'];
		} elseif (isset($this->request->get['banner_id'])){
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
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('job/postjob_form', $data));
	}

	public function view(){
		$this->load->language('job/postjob');
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
			'sort'              => $sort,
			'order'				=> $order,
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
		$this->load->model('job/postjob');
		$data['jobtypes'] =$this->model_job_jobtype->getJobtypes($data);
		$postjob_total = $this->model_job_postjob->getTotalPostJobs($filter_data);
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('job/jobtype');
		$this->load->model('job/company');
		$results=$this->model_job_postjob->getPostJobs($filter_data);
		foreach($results as $result){
			$country_info=$this->model_localisation_country->getCountry ($result['country_id']);
			if(isset($country_info['name'])){
				$country=$country_info['name'];         
			}else{
				$country='';
			}
			$zone_info = $this->model_localisation_zone->getZone($result['zone_id']);
			if(isset($zone_info['name'])){
				$zone=$zone_info['name'];         
			}else{
				$zone='';
			}
			$company_info = $this->model_job_company->getCompany($result['company_id']);
			if(isset($company_info['full_name'])){
				$company=$company_info['full_name'];         
			}else{
				$company='';
			}
			if($result['jobtype_id']==1){
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
				'edit'=> $this->url->link('job/postjob/edit','&job_id=' .$result['job_id'] . $url, true)
			);
		}		
		$url = '';
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['filter_title']			= $filter_title;
		$data['filter_country']    		= $filter_country;
		$data['filter_zone']       		= $filter_zone;
		$data['filter_jobtype']			= $filter_jobtype;
		$data['filter_category']		= $filter_category;
		$data['filter_company']    		= $filter_company;
		$data['filter_city']       		= $filter_city;
		$data['filter_meta_title'] 		= $filter_meta_title;
		$data['sort_title']  			= $this->url->link('job/postjob/view',$url, true);
		$data['sort_country'] 			= $this->url->link('job/postjob/view',$url, true);
		$data['sort_meta_title']  		= $this->url->link('job/postjob/view',$url, true);
		$data['sort_zone']  			= $this->url->link('job/postjob/view',$url, true);
		$data['sort_company'] 			= $this->url->link('job/postjob/view',$url, true);
		$data['sort_city']  			= $this->url->link('job/postjob/view',$url, true);
		$data['sort_jobtype_id'] 		= $this->url->link('job/postjob/view',$url, true);

		$data['heading_title']           = $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['text_select']             = $this->language->get('text_select');
		$data['text_form']               = $this->language->get('text_form');
		$data['text_full_time']          = $this->language->get('text_full_time');
		$data['text_part_time']          = $this->language->get('text_part_time');
		$data['text_list']               = $this->language->get('text_list');
		$data['column_jobtype_id']       = $this->language->get('column_jobtype_id');
		$data['column_title']            = $this->language->get('column_title');
		$data['column_title']            = $this->language->get('column_title');
		$data['column_meta_title']       = $this->language->get('column_meta_title');
		$data['column_companys']         = $this->language->get('column_companys');
		$data['column_zone']             = $this->language->get('column_zone');
		$data['column_city']             = $this->language->get('column_city');
		$data['column_category']         = $this->language->get('column_category');
		$data['column_jobtype']          = $this->language->get('column_jobtype');
		$data['column_titlename']        = $this->language->get('column_titlename');
		$data['column_country']          = $this->language->get('column_country');
		$data['column_product']          = $this->language->get('column_product');
		$data['column_orgtype_name']     = $this->language->get('column_orgtype_name');
		$data['column_sort_order']       = $this->language->get('column_sort_order');
		$data['entry_property']          = $this->language->get('entry_property');
		$data['column_action']           = $this->language->get('column_action');
		$data['column_image']            = $this->language->get('column_image');
		$data['button_add']              = $this->language->get('button_add');
		$data['button_cancle']           = $this->language->get('button_cancle');
		$data['button_delete']           = $this->language->get('button_delete');
		$data['button_']                 = $this->language->get('button_delete');
		$data['button_edit']             = $this->language->get('button_edit');
		$data['button_view']             = $this->language->get('button_view');
		$data['column_description']      = $this->language->get('column_description');
		$data['column_price']            = $this->language->get('column_price');
		$data['column_company']          = $this->language->get('column_company');
		$data['column_category']         = $this->language->get('column_category');
		$data['column_sort_order']       = $this->language->get('column_sort_order');
		$data['text_enable']             = $this->language->get('enable');
		$data['text_disable']            = $this->language->get('disable');
		$data['text_no_results']         = $this->language->get('text_no_results');
		$data['text_confirm']            = $this->language->get('text_confirm');
		$data['button_filter']           = $this->language->get('button_filter');
		$data['text_none'] 				       = $this->language->get('text_none');  
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
			'href' => $this->url->link('common/dashboard',true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/postjob',$url, true)
		);
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
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
			//action button
		$data['add']    = $this->url->link('job/postjob',$url, true);
		$data['delete'] = $this->url->link('job/postjob/delete',$url, true);
   
		$url = '';
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		 /////pagination
		$pagination      		= new Pagination();
		$pagination->total		= $postjob_total;
		$pagination->page  		= $page;
		$pagination->limit 		= $this->config->get('config_limit_admin');
		$pagination->url  		= $this->url->link('job/postjob','&page={page}', true);
		$data['pagination'] 	= $pagination->render();
		$data['results'] 		= sprintf($this->language->get('text_pagination'), ($postjob_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($postjob_total - $this->config->get('config_limit_admin'))) ? $postjob_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $postjob_total, ceil($postjob_total / $this->config->get('config_limit_admin')));
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right']	= $this->load->controller('common/column_right');
		$data['content_top']	= $this->load->controller('common/content_top');
		$data['content_bottom']	= $this->load->controller('common/content_bottom');
		$data['footer']			= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('job/postjob_list', $data));
	}
		
	public function edit(){
		$this->load->language('job/postjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/postjob');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_job_postjob->editPostJob($this->request->get['job_id'],$this->request->post);
			$this->response->redirect($this->url->link('job/postjob/view'));
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
				$this->response->redirect($this->url->link('job/postjob/view'));
		}
		$this->index();
	}
		
	public function validateForm(){
		foreach ($this->request->post['variation_desription'] as $language_id => $value) {
			if ((utf8_strlen($value['title']) < 3) || (utf8_strlen($value['title']) > 64)) {
				$this->error['title'][$language_id] = $this->language->get('error_title');
			} 
			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			} 
		}
		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}
		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}
		return !$this->error;
	}
	
	public function delete() {
		$this->load->language('job/postjob');
		$this->load->model('job/postjob');
		//change delete//
		if (isset($this->request->post['selected'])) {
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
			$this->response->redirect($this->url->link('job/postjob/view'));
		}
		$this->view();
	}
	public function autocomplete(){
		if (isset($this->request->get['filter_full_name'])) {
			$filter_full_name = $this->request->get['filter_full_name'];
		} else {
			$filter_full_name = false;
		}
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = false;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'full_name';
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
		$this->load->model('job/company');
		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'filter_full_name' => $filter_full_name,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		$this->load->model('job/company');
		$results=$this->model_job_company->getCompanys($filter_data);
		foreach ($results as $result) {
			$json[] = array(
				'company_id'  => $result['company_id'],
				'full_name'   => strip_tags(html_entity_decode($result['full_name'], ENT_QUOTES, 'UTF-8'))
			);
		}
		$sort_order = array();
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['full_name'];
		}
		array_multisort($sort_order, SORT_ASC, $json);
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}