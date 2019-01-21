<?php
class ControllerJobCategory extends Controller {
	public function index() {
		$this->load->language('job/category');

		$this->load->model('job/job');
		$this->load->model('catalog/category');
		$this->load->model('localisation/zone');

		$this->load->model('tool/image');

		
		if (isset($this->request->get['category_id'])) {
			$category_id = $this->request->get['category_id'];
		} else {
			$category_id = '';
		}

		if (isset($this->request->get['filter_status'])) {
		 $filter_status = $this->request->get['filter_status'];
		} else {
		 $filter_status = null;
		}		
		
		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

	

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_compare']      = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
		$data['text_refine']       = $this->language->get('text_refine');
		$data['text_empty']        = $this->language->get('text_empty');
		$data['text_quantity']     = $this->language->get('text_quantity');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_model']        = $this->language->get('text_model');
		$data['text_price']        = $this->language->get('text_price');
		$data['text_tax']          = $this->language->get('text_tax');
		$data['text_points']       = $this->language->get('text_points');
		$data['text_sort']         = $this->language->get('text_sort');
		$data['text_limit']        = $this->language->get('text_limit');
		$data['entry_category']    = $this->language->get('entry_category');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_no_results'] = $this->language->get('text_no_results');

		$data['text_parttime']	     = $this->language->get('text_parttime');
		$data['text_fulltime']	     = $this->language->get('text_fulltime');
		$this->document->setTitle($this->language->get('heading_title'));

		$data['button_cart']       = $this->language->get('button_cart');
		$data['button_wishlist']   = $this->language->get('button_wishlist');
		$data['button_compare']    = $this->language->get('button_compare');
		$data['button_continue']   = $this->language->get('button_continue');
		$data['button_list']       = $this->language->get('button_list');
		$data['button_grid']       = $this->language->get('button_grid');
		$data['button_search']     = $this->language->get('button_search');
		$data['button_view_more']  = $this->language->get('button_view_more');
		$data['button_apply_now']  = $this->language->get('button_apply_now');
	
			//GET CATEGORIES
		$data['categories'] = $this->model_catalog_category->getJobCategories(array());
       $url='';
		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}
			$filter_data =  array(
				
			'category_id' => $category_id,
			'filter_status' => $filter_status,
			'sort'         => $sort,
			'order'        => $order,
			'start'        => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'        => $this->config->get('config_limit_admin')

			);
			$job_total = $this->model_job_job->getTotalssub($filter_data);
			$jobs_info = $this->model_job_job->getJobsByCategory($filter_data);
			// GET JOBS		
		
		foreach($jobs_info as $jobs_infos)
			{
			
				if (!empty($jobs_infos['banner'])) {
					$banner = $this->model_tool_image->resize($jobs_infos['banner'], 278,220);
				} else {
					$banner = $this->model_tool_image->resize('placeholder.png',278,220);
				}

				if(isset($jobs_infos['jobtype_id']) && $jobs_infos['jobtype_id']==1){
					$type= "Part Time";
				} else {
					$type="Full Time";
				}

		
				$data['jobs_info'][] = array(
					'job_id'      => $jobs_infos['job_id'],
					'title'       => $jobs_infos['title'],
					'location'    => $jobs_infos['location'],
					'type'        => $type,
					'description'  => $jobs_infos['description'],
					'salary'       => $jobs_infos['salary'],
					'experience'   => $jobs_infos['experience'],
					'banner'       => $banner,
					'view'        => $this->url->link('job/jobdetail','&job_id='.$jobs_infos['job_id']),
					'date_added'  => $this->timeAgo($jobs_infos['date_added']),
				);
			} 

			$pagination = new Pagination();
		$pagination->total = $job_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/joblist',$url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($job_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($job_total - $this->config->get('config_limit_admin'))) ? $job_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $job_total, ceil($job_total / $this->config->get('config_limit_admin')));
	

		$data['category_id'] = $category_id;
		$data['filter_status'] = $filter_status;
		$data['continue']        = $this->url->link('common/home');
		$data['column_left']     = $this->load->controller('common/column_left');
		$data['column_right']    = $this->load->controller('common/column_right');
		$data['content_top']     = $this->load->controller('common/content_top');
		$data['content_bottom']  = $this->load->controller('common/content_bottom');
		$data['footer']          = $this->load->controller('common/footer');
		$data['header']          = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('job/category', $data));
		
	} 
	function timeAgo($time_ago)
		{
			$time_ago       = strtotime($time_ago);
			$cur_time       = time();
			$time_elapsed   = $cur_time - $time_ago;
			$seconds    = $time_elapsed ;
			$minutes    = round($time_elapsed / 60 );
			$hours      = round($time_elapsed / 3600);
			$days       = round($time_elapsed / 86400 );
			$weeks      = round($time_elapsed / 604800);
			$months     = round($time_elapsed / 2600640 );
			$years      = round($time_elapsed / 31207680 );
			// Seconds
			if($seconds <= 60){
				return "just now";
			}
			//Minutes
			else if($minutes <=60){
				if($minutes==1){
					return "one minute ago";
				}
				else{
					return "$minutes minutes ago";
				}
			}
			//Hours
			else if($hours <=24){
				if($hours==1){
					return "an hour ago";
				}else{
					return "$hours hrs ago";
				}
			}
			//Days
			else if($days <= 7){
				if($days==1){
					return "yesterday";
				}else{
					return "$days days ago";
				}
			}
			//Weeks
			else if($weeks <= 4.3){
				if($weeks==1){
					return "a week ago";
				}else{
					return "$weeks weeks ago";
				}
			}
			//Months
			else if($months <=12){
				if($months==1){
					return "a month ago";
				}else{
					return "$months months ago";
				}
			}
			//Years
			else{
				if($years==1){
					return "one year ago";
				}else{
					return "$years years ago";
				}
			}
		}
	
	
	public function autocomplete() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('job/category');
			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_job_category->getCategories($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'category_id' => $result['category_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}
		$sort_order = array();
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}
