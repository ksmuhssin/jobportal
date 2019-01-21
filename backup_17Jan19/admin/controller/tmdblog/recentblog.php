<?php
class ControllerTmdBlogRecentblog extends Controller {
	public function index() {
		$this->load->language('tmdblog/recentblog');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_no_results'] = $this->language->get('text_no_results');
		
		$data['column_sr_no']  = $this->language->get('column_sr_no');
		$data['column_post']   = $this->language->get('column_post');
		$data['column_author'] = $this->language->get('column_author');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');
		$data['button_view']   = $this->language->get('button_view');
		$data['column_totalcoment']   = $this->language->get('column_totalcoment');

		$data['token'] = $this->session->data['token'];

		
		$url='';
		$this->load->model('tmdblog/blog');
		$data['recentblogs'] = array();
		
		
		$results = $this->model_tmdblog_blog->getRecentBlogs();
		
		foreach ($results as $result) {
			
			$total=$this->model_tmdblog_blog->gettotalcomment($result['blog_id']);
			
			$data['recentblogs'][] = array(				
			'blog_id' => $result['blog_id'],
			'name'   => $result['name'],
			'author' => '',
			'total'  => $total,
			'status' => $result['status'],
			'href' => $this->url->link('tmdblog/blog', 'token=' . $this->session->data['token'] . '&blog_id=' . $result['blog_id'] . $url, 'SSL'),
		);
		}

		return $this->load->view('tmdblog/recentblog', $data);
	}
}
