<?php
class ControllerEmployLogout extends Controller {
	public function index() {
		if ($this->employ->isLogged()) {
			$this->employ->logout();
			$this->response->redirect($this->url->link('employ/logout', '', true));
		}

		$this->load->language('employ/success');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

	
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_logout'),
			'href' => $this->url->link('employ/logout', '', true)
		);

		$data['text_success'] = $this->language->get('text_success');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_accountlogout'] = $this->language->get('text_accountlogout');

		$data['text_message'] = $this->language->get('text_message');

		$data['button_continue'] = $this->language->get('button_continue');
		$data['text_success'] = $this->language->get('text_success');
		$data['text_logout'] = $this->language->get('text_logout');

		$data['continue'] = $this->url->link('common/home');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('employ/logout', $data));
	}
}
