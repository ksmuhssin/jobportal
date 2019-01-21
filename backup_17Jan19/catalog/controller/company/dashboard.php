<?php
class ControllerCompanyDashboard extends Controller {
	private $error = array();
	public function index() {
		
		if (!$this->company->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}

		$this->load->language('company/dashboard');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		$this->load->model('job/company');
		$this->load->model('tool/image');
		$this->company->getId();


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('company/dashboard', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_account_already'] 		= sprintf($this->language->get('text_account_already'), $this->url->link('company/login', '', true));
		$data['text_your_details'] 			= $this->language->get('text_your_details');
		$data['text_your_address'] 			= $this->language->get('text_your_address');
		$data['text_your_password'] 		= $this->language->get('text_your_password');
		$data['text_newsletter'] 			= $this->language->get('text_newsletter');
		$data['text_yes'] 					= $this->language->get('text_yes');
		$data['text_no'] 					= $this->language->get('text_no');
		$data['text_select'] 				= $this->language->get('text_select');
		$data['text_none'] 					= $this->language->get('text_none');
		$data['text_loading'] 				= $this->language->get('text_loading');
		$data['text_company_detail'] 		= $this->language->get('text_company_detail');
		$data['label_customer_group'] 		= $this->language->get('label_customer_group');
		$data['label_full_name'] 			= $this->language->get('label_full_name');
		$data['label_lastname'] 			= $this->language->get('label_lastname');
		$data['label_companyname'] 			= $this->language->get('label_companyname');
		$data['label_cell_phone'] 			= $this->language->get('label_cell_phone');
		$data['label_company_description'] 	= $this->language->get('label_company_description');
		$data['label_no_employees'] 		= $this->language->get('label_no_employees');
		$data['label_company_website'] 		= $this->language->get('label_company_website');
		$data['label_email'] 				= $this->language->get('label_email');
		$data['label_landline_phone'] 		= $this->language->get('label_landline_phone');
		$data['label_fax'] 					= $this->language->get('label_fax');
		$data['label_company'] 				= $this->language->get('label_company');
		$data['label_company_image'] 		= $this->language->get('label_company_image');
		$data['label_address'] 				= $this->language->get('label_address');
		$data['label_address_2'] 			= $this->language->get('label_address_2');
		$data['label_pincode'] 				= $this->language->get('label_pincode');
		$data['label_city'] 				= $this->language->get('label_city');
		$data['label_country'] 				= $this->language->get('label_country');
		$data['label_zone'] 				= $this->language->get('label_zone');
		$data['label_newsletter'] 			= $this->language->get('label_newsletter');
		$data['label_password'] 			= $this->language->get('label_password');
		$data['label_confirm'] 				= $this->language->get('label_confirm');
		
		
		
		$data['entry_customer_group'] 		= $this->language->get('entry_customer_group');
		$data['entry_full_name'] 			= $this->language->get('entry_full_name');
		$data['entry_lastname'] 			= $this->language->get('entry_lastname');
		$data['entry_companyname'] 			= $this->language->get('entry_companyname');
		$data['entry_cell_phone'] 			= $this->language->get('entry_cell_phone');
		$data['entry_company_description'] 	= $this->language->get('entry_company_description');
		$data['entry_no_employees'] 		= $this->language->get('entry_no_employees');
		$data['entry_company_website'] 		= $this->language->get('entry_company_website');
		$data['entry_email'] 				= $this->language->get('entry_email');
		$data['entry_landline_phone'] 		= $this->language->get('entry_landline_phone');
		$data['entry_fax'] 					= $this->language->get('entry_fax');
		$data['entry_company'] 				= $this->language->get('entry_company');
		$data['entry_company_image'] 		= $this->language->get('entry_company_image');
		$data['entry_address'] 				= $this->language->get('entry_address');
		$data['entry_address_2'] 			= $this->language->get('entry_address_2');
		$data['entry_pincode'] 				= $this->language->get('entry_pincode');
		$data['entry_city'] 				= $this->language->get('entry_city');
		$data['entry_country'] 				= $this->language->get('entry_country');
		$data['entry_zone'] 				= $this->language->get('entry_zone');
		$data['entry_newsletter'] 			= $this->language->get('entry_newsletter');
		$data['entry_password'] 			= $this->language->get('entry_password');
		$data['entry_confirm'] 				= $this->language->get('entry_confirm');
		$data['button_continue'] 			= $this->language->get('button_continue');
		$data['button_upload'] 				= $this->language->get('button_upload');
		
		
		
		$data['button_continue'] 			= $this->language->get('button_continue');
		$data['button_upload'] 				= $this->language->get('button_upload');
		
		$company_info = $this->model_job_company->showCompany($this->company->getId());
		
		$data['company_id'] 			=  $this->company->getId();
		$data['full_name'] 				=  $company_info['full_name'];
		$data['company_name'] 			=  $company_info['company_name'];
		$data['email'] 					=  $company_info['email'];
		$data['landline_phone']			=  $company_info['landline_phone'];
		$data['cell_phone'] 			=  $company_info['cell_phone'];
		$data['address'] 				=  $company_info['address'];
		$data['city'] 					=  $company_info['city'];
		$data['pincode'] 				=  $company_info['pincode'];
		$data['company_website'] 		=  $company_info['company_website'];
		$data['company_logo'] 			=  $company_info['company_logo'];
		$data['company_description'] 	=  $company_info['company_description'];
		$data['no_employees'] 			=  $company_info['no_employees'];

		if(!empty($company_info['company_logo'])){
			$data['thumb'] = $this->model_tool_image->resize($company_info['company_logo'],45,45);
		}else{
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);
		}
		
		$this->load->model('localisation/country'); 
		$this->load->model('localisation/zone'); 

		$getZone = $this->model_localisation_zone->getZone($company_info['zone_id']);
		$getCountry = $this->model_localisation_country->getCountry($company_info['country_id']);

		if(isset($getZone['name'])){
		$data['zone']=$getZone['name'];         
		} else {
		$data['zone']='';
		}
		if(isset($getCountry['name'])){
		$data['country']=$getCountry['name'];         
		} else {
		$data['country']='';
		}

		// Captcha
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
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}

		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('company/dashboard', $data));
	}	
}