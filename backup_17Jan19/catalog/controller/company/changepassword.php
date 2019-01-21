<?php
class ControllerCompanychangepassword extends Controller {
	private $error = array();
	public function index() {
		if(!$this->company->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->load->language('company/changepassword');
		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
       $this->load->model('job/company');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			 $this->model_job_company->editPassword($this->company->getId(),$this->request->post);
			 $this->response->redirect($this->url->link('company/dashboard'));	
		}


		$data['heading_title'] 			= $this->language->get('heading_title');
		$data['text_account_already'] 	= sprintf($this->language->get('text_account_already'), $this->url->link('company/login', '', true));
		$data['text_your_details'] 		= $this->language->get('text_your_details');
		$data['text_your_address']	 	= $this->language->get('text_your_address');
		$data['text_your_password'] 	= $this->language->get('text_your_password');
		$data['text_newsletter'] 		= $this->language->get('text_newsletter');
		$data['text_yes'] 				= $this->language->get('text_yes');
		$data['text_no'] 				= $this->language->get('text_no');
		$data['text_select'] 			= $this->language->get('text_select');
		$data['text_none'] 				= $this->language->get('text_none');
		$data['text_loading'] 			= $this->language->get('text_loading');
		$data['text_company_detail'] 	= $this->language->get('text_company_detail');
		$data['label_password'] 		= $this->language->get('label_password');
		$data['label_oldpassword'] 		= $this->language->get('label_oldpassword');
		$data['label_confirm'] 			= $this->language->get('label_confirm');
		
		$data['entry_password'] 		= $this->language->get('entry_password');
		$data['entry_oldpassword'] 		= $this->language->get('entry_oldpassword');
		$data['entry_confirm'] 			= $this->language->get('entry_confirm');
		
		
		$data['button_continue'] 		= $this->language->get('button_continue');
		$data['button_upload'] 			= $this->language->get('button_upload');
		
		$data['company_id'] = $this->company->getId();

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['oldpassword'])) {
			$data['error_oldpassword'] = $this->error['oldpassword'];
		} else {
			$data['error_oldpassword'] = '';
		}

		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}

		if (isset($this->error['confirm'])) {
			$data['error_confirm'] = $this->error['confirm'];
		} else {
			$data['error_confirm'] = '';
		}

		$data['action'] = $this->url->link('company/changepassword', '', true);

		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		if (isset($this->request->post['oldpassword'])) {
			$data['oldpassword'] = $this->request->post['oldpassword'];
		} else {
			$data['oldpassword'] = '';
		}
		
		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
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
		
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('company/changepassword', $data));
	}

	private function validate() {	
		
		// Old password match validation
		
		if (!$this->model_job_company->verifyPassword($this->request->post)) {
			$this->error['warning'] = $this->language->get('error_not_match');
		}
		
		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm'] != $this->request->post['password']) {
			$this->error['confirm'] = $this->language->get('error_confirm');
		}
		
		return !$this->error;
	}
}