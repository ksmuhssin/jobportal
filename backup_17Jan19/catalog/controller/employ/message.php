<?php
class ControllerEmployMessage extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('employ/message');
		$this->load->model('job/message');
		if (!$this->employ->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
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
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']     	  = $this->language->get('heading_title');
		$data['entry_email']      	  = $this->language->get('entry_email');
		$data['entry_description']    = $this->language->get('entry_description');
		$data['button_save']          = $this->language->get('button_save');
		$data['employ_id']         	 = $this->language->get('employ_id');
		$data['column_left']   		  = $this->load->controller('common/column_left');
		$data['column_right']         = $this->load->controller('common/column_right');
		$data['content_top']          = $this->load->controller('common/content_top');
		$data['content_bottom']       = $this->load->controller('common/content_bottom');
		$data['footer']               = $this->load->controller('common/footer');
		$data['header']              = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('employ/message.tpl', $data));
	}

	public function view(){
		$this->load->language('employ/message');
		$this->load->model('job/message');
		if (isset($this->request->get['filter_name'])){
			$filter_name = $this->request->get['filter_name'];
		}else{
			$filter_name = false;
		}
		if (isset($this->request->get['sort'])){
			$sort = $this->request->get['sort'];} 
		else{
			$sort = 'email';
		}
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		}else {
			$order = 'ASC';
		}
		if (isset($this->request->get['page'])){
			$page = $this->request->get['page'];
		}else {
			$page = 1;
		}
		$url = '';
		if (isset($this->request->get['sort'])){
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])){
			$url .= '&order='.$this->request->get['order'];
		}
		if (isset($this->request->get['page'])){
			$url .= '&page='.$this->request->get['page'];
		}
		$data['heading_title']  	= $this->language->get('heading_title');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['entry_email']      	= $this->language->get('entry_email');
		$data['entry_description']  = $this->language->get('entry_description');
		$data['button_save']        = $this->language->get('button_save');
		$data['column_message']     = $this->language->get('column_message');
		$data['column_email']       = $this->language->get('column_email');
		$data['employ_id']         	= $this->language->get('employ_id');
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
		if (isset($this->request->post['selected'])){
			$data['selected'] = (array) $this->request->post['selected'];
		}else{
			$data['selected'] = array();
		}
		if (isset($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
		unset($this->session->data['success']);
		}else{
			$data['success'] = '';
		}
		$filter_data = array(
			'sort'  => $sort,
			'filter_name' => $filter_name,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		//result show
		$messagestotal=$this->model_job_message->Messagestotal($filter_data);
		
		$messages=$this->model_job_message->Messages($filter_data);
		foreach($messages as $message){
			$data['messages'][]=array(
				'email'=>$message['email'],
				'message'=>$message['message'],
			);	
		}
	//pagination
		$pagination		 			= new Pagination();
		$pagination 				= new Pagination();
		$pagination->total	 		= $messagestotal;
		$pagination->page 			= $page;
		$pagination->limit 			= $this->config->get('config_limit_admin');
		$pagination->url 			= $this->url->link('employ/message', '&page={page}');
		$data['pagination'] 		= $pagination->render();
		$data['results'] 			= sprintf($this->language->get('text_pagination'), ($messagestotal) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($messagestotal - $this->config->get('config_limit_admin'))) ? $messagestotal : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $messagestotal, ceil($messagestotal / $this->config->get('config_limit_admin')));
		$data['sort_message']  		= $this->url->link('employ/message/view','&sort=message'.$url , true);
		$data['sort_email']   		= $this->url->link('employ/message/view','&sort=email'.$url , true);
		$data['sort'] 				= $sort;
		$data['order'] 				= $order;
		if ($order == 'ASC'){
			$url .= '&order=DESC';
		}else{
			$url .= '&order=ASC';
		}
		if (isset($this->request->get['page'])){
			$url .= '&page=' . $this->request->get['page'];
		}
		$data['column_left']   		= $this->load->controller('common/column_left');
		$data['column_right']       = $this->load->controller('common/column_right');
		$data['content_top']        = $this->load->controller('common/content_top');
		$data['content_bottom']     = $this->load->controller('common/content_bottom');
		$data['footer']             = $this->load->controller('common/footer');
		$data['header']             = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('employ/viewmessage.tpl', $data));
	}
	public function emailmessagesend(){
		$this->load->language('employ/message');
		$this->load->model('job/message');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_job_message->addMessage($this->request->post);
			$json['success'] = $this->language->get('text_success');
		}	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}

}