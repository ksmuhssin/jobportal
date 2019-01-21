<?php

class ControllerJobJobdetail extends Controller {

	private $error = array();

	public function index() {

		$this->load->language('job/jobdetail');

		$this->load->model('localisation/zone');

		$this->load->model('job/job');

		$this->load->model('tool/image');

		$this->load->model('job/applyjob');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_job_applyjob->addapply($this->request->post);

			$data['applyjob']=$this->language->get('text_applyjob');

		}

		if (isset($this->error['warning'])) {

			$data['error_warning'] = $this->error['warning'];

		} else {

			$data['error_warning'] = '';

		}

		if (isset($this->error['firstname'])) {

			$data['error_firstname'] = $this->error['firstname'];

		} else {

			$data['error_firstname'] = '';

		}



		if (isset($this->error['lastname'])) {

			$data['error_lastname'] = $this->error['lastname'];

		} else {

			$data['error_lastname'] = '';

		}



		if (isset($this->request->post['thumb'])) {

		 $data['thumb'] = $this->request->post['thumb'];

		} else {

		 $data['thumb'] = '';

		}

		if (isset($this->request->post['firstname'])) {

		 $data['firstname'] = $this->request->post['firstname'];

		} else {

		 $data['firstname'] = '';

		}

		if (isset($this->request->post['lastname'])) {

		 $data['lastname'] = $this->request->post['lastname'];

		} else {

		 $data['lastname'] = '';

		}
		if (isset($this->request->post['email'])) {

		 $data['email'] = $this->request->post['email'];

		} else {

		 $data['email'] = '';

		}

		if (isset($this->request->post['cv'])) {

		 $data['cv'] = $this->request->post['cv'];

		} else {

		 $data['cv'] = '';

		}
		if (isset($this->error['email'])) {

			$data['error_email'] = $this->error['email'];

		} else {

			$data['error_email'] = '';

		}

		if (isset($this->error['cv'])) {

			$data['error_cv'] = $this->error['cv'];

		} else {

			$data['error_cv'] = '';

		}

if(empty($this->request->get['job_id'])){

		$this->response->redirect($this->url->link('job/joblist'));
  }		
        $data['action']= $this->url->link('job/jobsdetail');

			///



		if (isset($this->request->get['job_id'])) {

			$job_id = $this->request->get['job_id'];

		} else {

			$job_id = '';

		}

		$data['Logged']=$this->employ->getId();

		$data['companylogged']=$this->company->getId();



		 $data['empolylinksd']=$this->url->link('employ/register');

	

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),

			'href' => $this->url->link('common/home')

		);

        

        $data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('job/jobdetail&job_id='.$this->request->get['job_id'].'')

		);

		$this->document->setTitle($this->language->get('heading_title'));

		$data['heading_title']      = $this->language->get('heading_title');

		$data['entry_firstname']    = $this->language->get('entry_firstname');

		$data['entry_lastname']     = $this->language->get('entry_lastname');

		$data['entry_email']      	= $this->language->get('entry_email');

		$data['entry_add_cv']      	= $this->language->get('entry_add_cv');

		$data['entry_choose_file']  = $this->language->get('entry_choose_file');

		$data['entry_location']     = $this->language->get('entry_location');

		$data['entry_salary']       = $this->language->get('entry_salary');

		$data['entry_posted']       = $this->language->get('entry_posted');

		$data['entry_job_ds']       = $this->language->get('entry_job_ds');

		$data['entry_it']           = $this->language->get('entry_it');

		$data['entry_it_d_Manager'] = $this->language->get('entry_it_d_Manager');

		$data['entry_experience']   = $this->language->get('entry_experience');

		$data['button_view_more']   = $this->language->get('button_view_more');

		$data['button_apply_now']   = $this->language->get('button_apply_now');

		$data['button_apply_this']  = $this->language->get('button_apply_this');

		$data['button_upload']  = $this->language->get('button_upload');

		$data['text_loading']  = $this->language->get('text_loading');

		$data['text_smjobs']  = $this->language->get('text_smjobs');



		$this->load->language('company/jobsdetail');

		$this->load->model('job/job');

		$this->load->model('tool/image');

		$jobcompanyinfos=$this->model_job_job->getJobCompany($this->request->get['job_id']);
       if(empty($jobcompanyinfos['job_id'])){

		$this->response->redirect($this->url->link('job/joblist'));
  }


	





		$data['jobid']=$this->request->get['job_id'];

        
	

        if (is_file(DIR_IMAGE . $jobcompanyinfos['banner'])) {

		$data['banner']= $this->model_tool_image->resize($jobcompanyinfos['banner'], 360, 300);

		} else {

		$data['banner']= $this->model_tool_image->resize('no_image.png', 360, 300);

		}

		

		

		$job_info = $this->model_job_job->getJob($job_id);

		if(isset($job_info['jobtype_id']) && $job_info['jobtype_id']==1){
			$type= "Part Time";
		} else {
			$type="Full Time";
		}

		

		if (!empty($job_info['banner'])) {

			$banner = $this->model_tool_image->resize($job_info['banner'], 370,293);

		} else {

			$banner = $this->model_tool_image->resize('placeholder.png',370,293);

		}

		$data['type']         	= $type;
		$data['banner']       	= $banner;

		if(isset($job_info['title'])) {
			$data['title']	= $job_info['title'];
		}

		if(isset($job_info['job_id'])) {
			$data['job_id'] = $job_info['job_id'];
		}

		if(isset($job_info['salary'])) {
			$data['salary']	= $job_info['salary'];
		}

		if(isset($job_info['location'])) {
			$data['location']= $job_info['location'];
		}

		if(isset($job_info['experience'])) {
			$data['experience']  = $job_info['experience'];
		}

		if(isset($job_info['description'])) {
			$data['description']= html_entity_decode($job_info['description']);	
		}

		if(isset($job_info['date_added'])) {		
			$data['date_added'] = $this->timeAgo($job_info['date_added']);
		}

		$data['similarsjobinfos']=array();
		$similarsjobinfos=$this->model_job_job->getJobsimlerjob($job_info['category_id']);

	    foreach ($similarsjobinfos as $similarsjobinfo) {

			$job_info = $this->model_job_job->getJob($similarsjobinfo['job_id']);

			if(isset($job_info['jobtype_id']) && $job_info['jobtype_id']==1){
				$type= "Part Time";
			} else {
				$type="Full Time";
			}
		
			if (!empty($similarsjobinfo['banner'])) {
				$banner = $this->model_tool_image->resize($similarsjobinfo['banner'], 370,293);
			} else {
				$banner = $this->model_tool_image->resize('placeholder.png',370,293);

			}

			if(isset($similarsjobinfo['description'])){
              $description= substr(html_entity_decode($similarsjobinfo['description']), 0, 100);
            }else{
              $description='';
            }

    		$data['similarsjobinfos'][]=array(
				'title'    => $similarsjobinfo['title'],	
				'job_id'    => $similarsjobinfo['job_id'],	
				'zone'      => $similarsjobinfo['location'],	
				'description'=> $description,	
				'banner'    => $banner,	
				'type'      => $type,	
				'href'      => $this->url->link('job/jobdetail', 'job_id=' . $similarsjobinfo['job_id']),
				'quick'     => $this->url->link('job/quick', 'job_id=' . $similarsjobinfo['job_id']),
				'view'      => $this->url->link('job/jobdetail', 'job_id=' . $similarsjobinfo['job_id'])

		 	);
		}

		$data['column_left']    = $this->load->controller('common/column_left');
		$data['column_right']   = $this->load->controller('common/column_right');
		$data['content_top']    = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer']         = $this->load->controller('common/footer');
		$data['header']         = $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('job/jobdetail', $data));

	}

	public function upload(){

		$this->load->language('tool/upload');

		$json = array();

		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {

			// Sanitize the filename

			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));

			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 6400)) {

				$json['error'] = $this->language->get('error_filename');

			}
			// Allowed file extension types

			$allowed = array();

			$extension_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_ext_allowed'));

 

			$filetypes = explode("\n", $extension_allowed);



			foreach ($filetypes as $filetype) {

				$allowed[] = trim($filetype);

			}

			if (!in_array(strtolower(substr(strrchr($filename, '.'), 1)), $allowed)) {

				$json['error'] = $this->language->get('error_filetype');

			}

			// Allowed file mime types

	    	$allowed = array();

			$mime_allowed = preg_replace('~\r?\n~', "\n", $this->config->get('config_file_mime_allowed'));

			$filetypes = explode("\n", $mime_allowed);



			foreach ($filetypes as $filetype) {

				$allowed[] = trim($filetype);

			}

			if (!in_array($this->request->files['file']['type'], $allowed)) {

				$json['error'] = $this->language->get('error_filetype');
			}

			// Check to see if any PHP files are trying to be uploaded

			$content = file_get_contents($this->request->files['file']['tmp_name']);

			if (preg_match('/\<\?php/i', $content)) {

				$json['error'] = $this->language->get('error_filetype');

			}

			// Return any upload error

			if ($this->request->files['file']['error'] != UPLOAD_ERR_OK) {

				$json['error'] = $this->language->get('error_upload_' . $this->request->files['file']['error']);

			}

		} else {

			$json['error'] = $this->language->get('error_upload');

		}

		if (!$json) {

			$targetDir = DIR_IMAGE.'catalog/';

			$file = $filename;

			$location = $targetDir.$file;

			$location1 = 'catalog/'.$file;

			move_uploaded_file($this->request->files['file']['tmp_name'], $location);

			$json['location1'] =$location1;

			$json['success'] = $this->language->get('text_upload');

		}

		$this->response->addHeader('Content-Type: application/json');

		$this->response->setOutput(json_encode($json));

	}

	private function validate() {

		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {

		$this->error['warning'] = $this->language->get('error_firstname');

		}

		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {

		$this->error['warning'] = $this->language->get('error_lastname');

		}

		if ((utf8_strlen(trim($this->request->post['email'])) < 1) || (utf8_strlen(trim($this->request->post['email'])) > 32)) {

		$this->error['warning'] = $this->language->get('error_email');

		}

		if ((utf8_strlen(trim($this->request->post['cv'])) < 1) || (utf8_strlen(trim($this->request->post['cv'])) > 32)) {

		$this->error['warning'] = $this->language->get('error_cv');

		}

		return !$this->error;

	}
	
	function timeAgo($time_ago){

		$time_ago      = strtotime($time_ago);

		$cur_time      = time();

		$time_elapsed  = $cur_time - $time_ago;

		$seconds       = $time_elapsed ;

		$minutes   	   = round($time_elapsed / 60);

		$hours    	   = round($time_elapsed / 3600);

		$days          = round($time_elapsed / 86400);

		$weeks         = round($time_elapsed / 604800);

		$months        = round($time_elapsed / 2600640);

		$years         = round($time_elapsed / 31207680);

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