<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink($this->config->get('config_url'), 'canonical');
		}
		
		//xml
		$data['column_slider'] = $this->load->controller('common/column_slider');
		$data['column_feature'] = $this->load->controller('common/column_feature');
		$data['column_testi'] = $this->load->controller('common/column_testi');
		$data['column_candi'] = $this->load->controller('common/column_candi');
		$data['column_blog'] = $this->load->controller('common/column_blog');
		$data['blog_right'] = $this->load->controller('common/blog_right');
		//xml
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('common/home', $data));
	}
}
