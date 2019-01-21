<?php
class ControllerCompanyJobsdetail extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('company/jobsdetail');
		$this->load->model('job/job');
			$this->load->model('tool/image');
		$data['breadcrumbs'] = array();
		
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$jobcompanyinfos=$this->model_job_job->getJobCompany($this->request->get['job_id']);

		if (is_file(DIR_IMAGE . $jobcompanyinfos['banner'])) {
			$data['banner']= $this->model_tool_image->resize($jobcompanyinfos['banner'], 360, 285);
		} else {
			$data['banner']= $this->model_tool_image->resize('no_image.png', 360, 285);
		}

		
		if($jobcompanyinfos['jobtype_id']==1){
		 $data['type']= "Part Time";
		} else {
			$data['type']="Full Time";
		}
		$data['date_added']	= $jobcompanyinfos['date_added'];
		$data['title']		= $jobcompanyinfos['title'];
		$data['experience']	= $jobcompanyinfos['experience'];
		$data['salary']		= $jobcompanyinfos['salary'];
		$data['location']	= $jobcompanyinfos['location'];
		$data['description']= $jobcompanyinfos['description'];


		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']      = $this->language->get('heading_title');
		$data['entry_firstname']    = $this->language->get('entry_firstname');
		$data['entry_lastname']     = $this->language->get('entry_lastname');
		$data['entry_email']      	= $this->language->get('entry_email');
		$data['entry_add_cv']      	= $this->language->get('entry_add_cv');
		$data['entry_choose_file']  = $this->language->get('entry_choose_file');
		$data['entry_location']     = $this->language->get('entry_location');
		$data['entry_salary']       = $this->language->get('entry_salary');
		$data['entry_posted']       = $this->language->get('entry_posted');
		$data['entry_job_ds']       = $this->language->get('entry_job_ds');
		$data['entry_it']           = $this->language->get('entry_it');
		$data['entry_it_d_Manager'] = $this->language->get('entry_it_d_Manager');
		$data['entry_experience']   = $this->language->get('entry_experience');
		$data['button_view_more']   = $this->language->get('button_view_more');
		$data['button_apply_now']   = $this->language->get('button_apply_now');
		$data['button_apply_this']  = $this->language->get('button_apply_this');

		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('company/jobsdetail', $data));
	}
	 
}