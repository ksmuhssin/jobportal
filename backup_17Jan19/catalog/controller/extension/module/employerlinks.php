<?php
class ControllerExtensionModuleEmployerlinks extends Controller {
	public function index() {
		$this->load->language('extension/module/employerlinks');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_dashboard'] = $this->language->get('text_dashboard');
		$data['text_submitjobs'] = $this->language->get('text_submitjobs');
		$data['text_submitjob'] = $this->language->get('text_submitjob');
		$data['text_applyjob'] = $this->language->get('text_applyjob');

		$data['logged'] = $this->company->isLogged();
		$data['register'] = $this->url->link('company/register', '', true);
		$data['login'] = $this->url->link('employ/login', '', true);
		$data['logout'] = $this->url->link('company/logout', '', true);
		$data['forgotten'] = $this->url->link('company/forgotten', '', true);
		$data['account'] = $this->url->link('company/dashboard', '', true);
		$data['edit'] = $this->url->link('company/editcompany', '', true);
		$data['password'] = $this->url->link('company/changepassword', '', true);
		$data['submitjobs'] = $this->url->link('company/jobsubmitlist', '', true);



		return $this->load->view('extension/module/employerlinks', $data);
	}
}