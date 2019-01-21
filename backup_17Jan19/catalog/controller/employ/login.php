<?php
class ControllerEmployLogin extends Controller {
	private $error = array();

	public function index() {
		if ($this->employ->isLogged()) {
			$this->response->redirect($this->url->link('employ/dashboard', '', true));
		}
		$this->load->model('job/employ');
		$this->load->language('employ/login');
		$this->document->setTitle($this->language->get('heading_title'));
		
	
		$data['heading_title'] = $this->language->get('heading_title');
		
		
		$data['text_new_customer'] = $this->language->get('text_new_customer');
		$data['text_donot'] = $this->language->get('text_donot');
		$data['text_remember'] = $this->language->get('text_remember');
		$data['text_register'] = $this->language->get('text_register');
		$data['text_register_account'] = $this->language->get('text_register_account');
		$data['text_returning_customer'] = $this->language->get('text_returning_customer');
		$data['text_i_am_returning_customer'] = $this->language->get('text_i_am_returning_customer');
		$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['text_registercom'] = $this->language->get('text_registercom');

		$data['tab_employee'] = $this->language->get('tab_employee');
		$data['tab_company'] = $this->language->get('tab_company');
		
		
		$data['label_email'] = $this->language->get('label_email');
		$data['label_password'] = $this->language->get('label_password');
        
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_password'] = $this->language->get('entry_password');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['button_login'] = $this->language->get('button_login');

		if (isset($this->session->data['error'])) {
			$data['error_warning'] = $this->session->data['error'];

			unset($this->session->data['error']);
		} elseif (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		$data['register'] = $this->url->link('employ/register', '', true);
		$data['forgotten'] = $this->url->link('employ/forgotten', '', true);
		$data['companyforget'] = $this->url->link('company/forgotten', '', true);

		$data['employragister'] = $this->url->link('employ/register', '', true);
		$data['compnaragister'] = $this->url->link('company/register', '', true);
      
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} else {
			$data['email'] = '';
		}
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} else {
			$data['password'] = '';
		}

		 // Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}
		//print_r($data['captcha']);die();

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('employ/login', $data));
	}


	public function validate() {
		$this->load->model('job/employ');
			$employ_info = $this->model_job_employ->getEmployByEmail($this->request->post['email']);
		if ($employ_info && !$employ_info['approved']) {
			$this->error['warning'] = $this->language->get('error_approved');
		}

		if (!$this->error) {
			if (!$this->employ->login($this->request->post['email'], $this->request->post['password'])) {
				$this->error['warning'] = $this->language->get('error_login');
						
			}
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}

		return !$this->error;
	}


	 public function loginfunction() {
	 	$this->load->language('employ/login');
		$json=array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('job/employ');
				$employ_info = $this->model_job_employ->getEmployByEmail($this->request->post['email']);
			if ($employ_info && !$employ_info['approved']) {
				$json['warning'] = $this->language->get('error_approved');
			}
			if (!$json) {
			if (!$this->employ->login($this->request->post['email'], $this->request->post['password'])) {
			  $json['warning'] = $this->language->get('error_login');
			}else{
				  $json['loginlink']=$this->url->link('employ/dashboard', '', true);
			}
			}

		}


		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	 }

	  public function companyfunction() {
	 		$this->load->language('employ/login');
		$json=array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
		$this->load->model('job/company');
		$company_info = $this->model_job_company->getcompanyrByEmail($this->request->post['email']);
		if ($company_info && !$company_info['approved']) {
			$json['comwarning']= $this->language->get('error_approved');
		}

		if (!$json) {
			if (!$this->company->login($this->request->post['email'], $this->request->post['password'])) {
				$json['comwarning'] = $this->language->get('error_login');
			}else{

				$json['complink']=$this->url->link('company/dashboard', '', true);


			}
		}
		
	}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	 }


}
