<?php
class ControllerJobMessage extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('job/message');
		$this->load->model('job/message');
		//submit email
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
	
			$this->session->data['success'] = $this->language->get('text_success');

		}
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
			if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']     	  = $this->language->get('heading_title');
		$data['entry_email']      	  = $this->language->get('entry_email');
		$data['entry_description']    = $this->language->get('entry_description');
		$data['button_save']          = $this->language->get('button_save');
		$data['column_left']   		  = $this->load->controller('common/column_left');
		$data['column_right']         = $this->load->controller('common/column_right');
		$data['content_top']          = $this->load->controller('common/content_top');
		$data['content_bottom']       = $this->load->controller('common/content_bottom');
		$data['footer']               = $this->load->controller('common/footer');
		$data['header']              = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('job/message.tpl', $data));
	}
	
	
	
		
	public function emailmessagesend(){
		$this->load->language('job/message');
		$this->load->model('job/message');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_job_message->addMessage($this->request->post);
			$json['success'] = $this->language->get('text_success');
		}	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}
	
	
	
	
}