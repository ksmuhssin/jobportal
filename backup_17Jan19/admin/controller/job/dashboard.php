<?php
class ControllerjobDashboard extends Controller {
	public function index() {
		$this->load->language('job/dashboard');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/employ');
		$this->load->model('job/postjob');
		$this->load->model('job/orgtype');
		$this->load->model('job/company');
		$this->load->model('job/industry');
		$this->load->model('job/jobtype');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('job/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['totaljob']		= $this->model_job_employ->getTotalEmployss($data);
		$data['totalpostjob']	= $this->model_job_postjob->getTotalPostJobs($data);
		$data['totalOrgttype']	= $this->model_job_orgtype->getTotalOrgtypes($data);
		$data['totalcompany']	= $this->model_job_company->getTotalCompanys($data);
		$data['totalindustry']	= $this->model_job_industry->getIndustrytotal($data);
		$data['totaljobtype']	= $this->model_job_jobtype->getTotalJobtypes($data);

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/dashboard', $data));
	}
}