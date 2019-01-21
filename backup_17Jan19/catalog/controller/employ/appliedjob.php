<?php
class ControllerEmployAppliedJob extends Controller {
	public function index() {
		if (!$this->employ->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->load->language('employ/appliedjob');
		$this->document->setTitle($this->language->get('heading_title'));
		$data['breadcrumbs'] = array();
			$this->load->model('job/job');
			$this->load->model('job/employ');
			$this->load->model('tool/image');
			$this->load->model('job/applyjob');

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
        
        $data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('employ/appliedjob')
		);

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


		$filter_data = array(
			'employ_id'    => $this->employ->getId(),
			'sort'         => $sort,
			'order'        => $order,
			'start'        => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'        => $this->config->get('config_limit_admin')
		);

       

	
		$applied_infos= $this->model_job_applyjob->getempleyjob($this->employ->getId());

		foreach ($applied_infos as $applied_info) {
            
            $appliedresult= $this->model_job_applyjob->geJobs($applied_info['job_id']);
        	
			if (!empty($appliedresult['banner'])) {
				$banner = $this->model_tool_image->resize($appliedresult['banner'], 262, 200);
			} else {
				$banner = $this->model_tool_image->resize('no_image.png', 262, 200);
			}

			if(isset($appliedresult['jobtype_id']) && $appliedresult['jobtype_id']==1){
				$type= "Part Time";
			} else {
				$type="Full Time";
			}

			if(isset($appliedresult['description'])){
			   $description = substr($appliedresult['description'], 0, 80);
			} else {
				$description = '';
			}

			if(isset($appliedresult['location'])){
              $zone=$appliedresult['location'];
			} else {
				$zone= '';
			}

			if(isset($appliedresult['title'])){
              $title=$appliedresult['title'];
			} else {
				$title ='';
			}

			if(isset($appliedresult['salary'])){
              $salary=$appliedresult['salary'];
			} else {
				$salary= '';
			}

			if(isset($appliedresult['date_added'])){
              $date_added=$this->timeAgo($appliedresult['date_added']);
			} else {
				$date_added='';
			}

			if(isset($appliedresult['job_id'])){
              $view = $this->url->link('job/jobdetail', 'job_id=' . $appliedresult['job_id']);
			} else {
				$view ='';
			}

			$data['applied_infos'][]=array(
			'banner'   =>$banner,
			'job_id'   =>$applied_info['job_id'],
			'type'     =>$type,
			'description'=>$description,
			'zone'=>$zone,
			'salary'=>$salary,
			'date_added'=>$date_added,
			'title'=>$title,
			'view'=>$view,
			'quick'         => $this->url->link('job/quick', 'job_id=' . $applied_info['job_id'])
			);

      

		}

		
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_postjob'] = $this->language->get('text_postjob');
        $data['text_profile']        = $this->language->get('text_profile');
        $data['text_apply']          = $this->language->get('text_apply');
        $data['text_postjob']        = $this->language->get('text_postjob');
        $data['text_change']         = $this->language->get('text_change');
        $data['button_viewmore']         = $this->language->get('button_viewmore');
        $data['text_logout']         = $this->language->get('text_logout');
        
        $data['edashboard'] = $this->url->link('employ/dashboard', '', true);
        $data['appliedjob'] = $this->url->link('employ/appliedjob', '', true);
        $data['editemploy'] = $this->url->link('employ/editemploy', '', true);
        $data['changepassword'] = $this->url->link('employ/changepassword', '', true);
        $data['logout'] = $this->url->link('employ/logout', '', true);
        
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('employ/appliedjob', $data));
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
