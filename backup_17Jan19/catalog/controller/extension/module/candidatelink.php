<?php
class ControllerExtensionModuleCandidatelink extends Controller {
	public function index() {
		$this->load->language('extension/module/candidatelink');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_forgotten'] = $this->language->get('text_forgotten');
		$data['text_profile'] = $this->language->get('text_profile');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_password'] = $this->language->get('text_password');
		$data['text_address'] = $this->language->get('text_address');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_reward'] = $this->language->get('text_reward');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_recurring'] = $this->language->get('text_recurring');

		$data['logged'] = $this->employ->isLogged();
		$data['register'] = $this->url->link('employ/register', '', true);
		$data['login'] = $this->url->link('employ/login', '', true);
		$data['logout'] = $this->url->link('employ/logout', '', true);
		$data['forgotten'] = $this->url->link('employ/forgotten', '', true);
		$data['employprofile'] = $this->url->link('employ/employprofile');
		$data['order'] = $this->url->link('employ/postjobs', '', true);
		$data['viewemploy'] = $this->url->link('employ/viewemploy', '', true);

		return $this->load->view('extension/module/candidatelink', $data);
	}
}