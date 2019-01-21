<?php
class ControllerJobJobsetting extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('job/jobsetting');

		$this->load->model('setting/setting');

		$this->document->setTitle($this->language->get('heading_title'));

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('jobsetting', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('job/jobsetting', 'token=' . $this->session->data['token'] , true));
		}

		$data['heading_title'] 			= $this->language->get('heading_title');
		$data['text_edit'] 				= $this->language->get('text_edit');
		$data['text_auto'] 				= $this->language->get('text_auto');
		$data['text_waiting'] 			= $this->language->get('text_waiting');

		$data['lable_company'] 			= $this->language->get('lable_company');
		$data['lable_employ'] 			= $this->language->get('lable_employ');
		$data['lable_submitjob'] 		= $this->language->get('lable_submitjob');

		$data['entry_company'] 			= $this->language->get('entry_company');
		$data['entry_employ'] 			= $this->language->get('entry_employ');
		$data['entry_submitjob'] 		= $this->language->get('entry_submitjob');

		$data['button_save'] 			= $this->language->get('button_save');
		$data['button_cancel'] 			= $this->language->get('button_cancel');
		$data['button_remove'] 			= $this->language->get('button_remove');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/jobsetting', 'token=' . $this->session->data['token'], true)
		);

		$data['action'] = $this->url->link('job/jobsetting', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('job/jobsetting', 'token=' . $this->session->data['token'], true);

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['jobsetting_company_register'])) {
			$data['jobsetting_company_register'] = $this->request->post['jobsetting_company_register'];
		} else {
			$data['jobsetting_company_register'] = $this->config->get('jobsetting_company_register');
		}

		if (isset($this->request->post['jobsetting_employ_register'])) {
			$data['jobsetting_employ_register'] = $this->request->post['jobsetting_employ_register'];
		} else {
			$data['jobsetting_employ_register'] = $this->config->get('jobsetting_employ_register');
		}

		if (isset($this->request->post['jobsetting_submitjob_register'])) {
			$data['jobsetting_submitjob_register'] = $this->request->post['jobsetting_submitjob_register'];
		} else {
			$data['jobsetting_submitjob_register'] = $this->config->get('jobsetting_submitjob_register');
		}
				
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/jobsetting', $data));
	}
}
