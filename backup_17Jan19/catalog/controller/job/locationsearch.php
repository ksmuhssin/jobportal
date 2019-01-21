<?php
class ControllerJobLocationSearch extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('job/locationsearch');
		$this->load->model('localisation/zone');
		$this->load->model('job/job');
		$this->load->model('tool/image');

			
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
        
        $data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/locationsearch')
		);
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title']       = $this->language->get('heading_title');
		$data['button_view_more']    = $this->language->get('button_view_more');
		$data['button_apply_now']    = $this->language->get('button_apply_now');
		$data['button_apply_this']   = $this->language->get('button_apply_this');
		$data['text_no_results']   	 = $this->language->get('text_no_results');
		$data['text_findjob']        = $this->language->get('text_findjob');

		$data['entry_city']   = $this->language->get('entry_city');

		$data['text_select']   = $this->language->get('text_select');
	
		
		if (isset($this->request->get['job_filter'])) {
		 	$job_filter = $this->request->get['job_filter'];
		} else {
		 	$job_filter = false;
		}

		if (isset($this->request->get['filter_country_id'])) {
		 	$filter_country_id = $this->request->get['filter_country_id'];
		} else {
		 	$filter_country_id = false;
		}

		if (isset($this->request->get['filter_location'])) {
		 $filter_location = $this->request->get['filter_location'];
		} else {
		 $filter_location = null;
		}

     	$url = '';
	
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'date_added';
		}
		
		

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';
		
		if (isset($this->request->get['job_filter'])) {
			$url .= '&job_filter=' . $this->request->get['job_filter'];
		}

		if (isset($this->request->get['filter_country_id'])) {
			$url .= '&filter_country_id=' . $this->request->get['filter_country_id'];
		}

		if (isset($this->request->get['filter_location'])) {
			$url .= '&filter_location=' . $this->request->get['filter_location'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$filter_data = array(
			'job_filter'       => $job_filter,
			'filter_country_id'=> $filter_country_id,
			'filter_location'  => $filter_location,
			'sort'             => $sort,
			'order'            => $order,
			'start'            => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'            => $this->config->get('config_limit_admin')
		);
		
		$data['jobtotalresult'] = $this->model_job_job->getjobTotals($filter_data);
		$job_total = $this->model_job_job->getjobTotals($filter_data);
		$results = $this->model_job_job->geJobs($filter_data);
		//print_r($results);die();
		if ($results) {
			foreach ($results as $result) {
				if (is_file(DIR_IMAGE . $result['banner'])) {
					$banner = $this->model_tool_image->resize($result['banner'], 262, 200);
				} else {
					$banner = $this->model_tool_image->resize('no_image.png', 262, 200);
				}
				
				if($result['jobtype_id']==1){
					$type= "Part Time";
				} else {
					$type="Full Time";
				}

				if(isset($result['description'])){
				   $description = substr($result['description'], 0, 80);
				}
			
				$data['jobs'][] = array(
					'job_id'  		=> $result['job_id'],
					'type'       	=> $type,
					'zone'       	=> $result['location'],
					'banner'       	=> $banner,
					'title'        	=> $result['title'],					
					'salary'        => $result['salary'],					
					'description'   => $description,					
					'date_added'    =>$this->timeAgo($result['date_added']),
					'href'          => $this->url->link('job/jobdetail', 'job_id=' . $result['job_id']),
					'view'        	=> $this->url->link('job/jobdetail', 'job_id=' . $result['job_id']),
					'quick'         => $this->url->link('job/quick', 'job_id=' . $result['job_id']),
					'apply'       	=> $this->url->link('job/jobdetail', 'job_id=' . $result['job_id'])
				);
			}

		}

		$pagination = new Pagination();
		$pagination->total = $job_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/locationsearch', '&page={page}');
		$data['pagination'] = $pagination->render();
		$data['results']  = sprintf($this->language->get('text_pagination'), ($job_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($job_total - $this->config->get('config_limit_admin'))) ? $job_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $job_total, ceil($job_total / $this->config->get('config_limit_admin')));
		$data['sort']     = $sort;
		$data['order']     = $order;
		$data['job_filter'] = $job_filter;
		$data['filter_country_id'] = $filter_country_id;
		$data['filter_location'] = $filter_location;
		
		$this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getJobCategories($data);

		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();	
		
		$data['column_left']    = $this->load->controller('common/column_left');
		$data['column_right']   = $this->load->controller('common/column_right');
		$data['content_top']    = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer']         = $this->load->controller('common/footer');
		$data['header']         = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('job/locationsearch', $data));
	}

	function timeAgo($time_ago){
		$time_ago      = strtotime($time_ago);
		$cur_time      = time();
		$time_elapsed  = $cur_time - $time_ago;
		$seconds    = $time_elapsed ;
		$minutes    = round($time_elapsed / 60);
		$hours      = round($time_elapsed / 3600);
		$days       = round($time_elapsed / 86400);
		$weeks      = round($time_elapsed / 604800);
		$months     = round($time_elapsed / 2600640);
		$years      = round($time_elapsed / 31207680);
		// Seconds
		if($seconds <= 60){
			return "just now";
		}
		//Minutes
		else if($minutes <=60){
			if($minutes==1){
				return "one minute ago";
			} else {
				return "$minutes minutes ago";
			}
		}
		//Hours
		else if($hours <=24){
			if($hours==1){
				return "an hour ago";
			} else {
				return "$hours hrs ago";
			}
		}
		//Days
		else if($days <= 7){
			if($days==1){
				return "yesterday";
			} else {
				return "$days days ago";
			}
		}
		//Weeks
		else if($weeks <= 4.3){
			if($weeks==1){
				return "a week ago";
			} else {
				return "$weeks weeks ago";
			}
		}
		//Months
		else if($months <=12){
			if($months==1){
				return "a month ago";
			} else {
				return "$months months ago";
			}
		}
		//Years
		else{
			if($years==1){
				return "one year ago";
			} else {
				return "$years years ago";
			}
		}
	}
}
