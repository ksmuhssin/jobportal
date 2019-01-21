<?php
class ControllerResumeViewresume extends Controller {
	private $error = array();

	public function index() {
		
		$this->load->language('resume/viewresume');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('job/resume');
		$this->load->model('account/customer');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$resume_id = $this->model_job_resume->editresume($this->request->post);

			$this->customer->login($this->request->post['email'], $this->request->post['password']);

			unset($this->session->data['guest']);

			$this->response->redirect($this->url->link('account/success'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('resume/viewresume', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('resume/login', '', true));
		$data['text_your_details']   = $this->language->get('text_your_details');
		$data['text_your_address']   = $this->language->get('text_your_address');
		$data['text_your_password']  = $this->language->get('text_your_password');
		$data['text_newsletter']     = $this->language->get('text_newsletter');
		$data['text_yes']            = $this->language->get('text_yes');
		$data['text_no']             = $this->language->get('text_no');
		$data['text_select']         = $this->language->get('text_select');
		$data['text_none']           = $this->language->get('text_none');
		$data['text_loading']        = $this->language->get('text_loading');
		$data['text_enable']         = $this->language->get('text_enable');
		$data['text_disable']        = $this->language->get('text_disable');
		$data['text_full_time']      = $this->language->get('text_full_time');
		$data['text_part_time']      = $this->language->get('text_part_time');

		$data['entry_jobtype']       = $this->language->get('entry_jobtype');
		$data['entry_customer']      = $this->language->get('entry_customer');
		$data['entry_status']        = $this->language->get('entry_status');
		$data['entry_image']         = $this->language->get('entry_image');
		$data['entry_resume']        = $this->language->get('entry_resume');
		$data['button_continue']     = $this->language->get('button_continue');
		$data['button_upload']       = $this->language->get('button_upload');
		
		
		$resume_info=$this->model_job_resume->showResume(17);
		
		//$data['resume_id']	    =$this->resume->getId();
		$data['jobtype_id']	    =$resume_info['jobtype_id'];
		$data['customer']	    =$resume_info['customer'];
		$data['resume']	        =$resume_info['resume'];
		$data['status']	        =$resume_info['status'];
		
		// GET IMAGE
		$this->load->model('tool/image');
		
		if(!empty($resume_info['resume']))
			{
			$data['thumb'] = $this->model_tool_image->resize($resume_info['resume'],45,45);
			}
			else{
				$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);
			}
		
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		$data['action'] = $this->url->link('resume/viewresume', '', true);

		if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} 
		if (isset($this->request->post['jobtype_id'])) {
			$data['jobtype_id'] = $this->request->post['jobtype_id'];
		} 
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} 

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('resume/viewresume', $data));
	}
	
}