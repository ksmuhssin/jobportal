<?php 
class ControllerEmployEditemploy extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('employ/editemploy');
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (!$this->employ->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		$this->load->model('job/employ');
		
		$this->load->model('tool/image');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_job_employ->editemploy($this->request->post);
			$this->response->redirect($this->url->link('employ//updatesuccess'));
		}

		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('breadcrumbs_login'),
			'href' => $this->url->link('employ/dashboard', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('breadcrumbs_register'),
			'href' => $this->url->link('employ/editemploy', '', true)
		);
		$data['heading_title']		 = $this->language->get('heading_title');
		



		$data['text_account_already']= sprintf($this->language->get('text_account_already'), $this->url->link('employ/login', '', true));
		




		$data['text_your_details']   = $this->language->get('text_your_details');
		$data['heading_your_details']   = $this->language->get('heading_your_details');
		

		$data['tab_profile']     = $this->language->get('tab_profile');
		$data['tab_apply']       = $this->language->get('tab_apply');
		$data['tab_postjob']     = $this->language->get('tab_postjob');
		$data['tab_change']      = $this->language->get('tab_change');
		$data['tab_logout']      = $this->language->get('tab_logout');

		$data['text_your_address']   = $this->language->get('text_your_address');
		$data['text_your_password']  = $this->language->get('text_your_password');
		$data['text_newsletter']     = $this->language->get('text_newsletter');
		$data['text_yes']            = $this->language->get('text_yes');
		$data['text_no']             = $this->language->get('text_no');
		$data['text_select']         = $this->language->get('text_select');
		$data['text_none']           = $this->language->get('text_none');
		$data['text_loading']        = $this->language->get('text_loading');
		$data['text_male']           = $this->language->get('text_male');

		$data['label_fullname']      = $this->language->get('label_fullname');
		$data['label_gender']        = $this->language->get('label_gender');
		$data['label_birth_date']    = $this->language->get('label_birth_date');
		$data['label_employ']        = $this->language->get('label_employ');
		$data['label_address']       = $this->language->get('label_address');
		$data['label_mobile']        = $this->language->get('label_mobile');
		$data['label_home_phone']    = $this->language->get('label_home_phone');
		$data['label_pincode']       = $this->language->get('label_pincode');
		$data['label_city']          = $this->language->get('label_city');
		$data['label_country']       = $this->language->get('label_country');
		$data['label_zone']          = $this->language->get('label_zone');
		$data['label_newsletter']    = $this->language->get('label_newsletter');
		$data['label_profissional']  = $this->language->get('label_profissional');
		$data['label_experience']    = $this->language->get('label_experience');
		$data['label_additional']    = $this->language->get('label_additional');
		$data['label_education']     = $this->language->get('label_education');
		$data['label_degree']        = $this->language->get('label_degree');
		$data['label_collage']       = $this->language->get('label_collage');
		$data['label_passed']        = $this->language->get('label_passed');
		$data['label_percentage']    = $this->language->get('label_percentage');
		$data['label_interest']      = $this->language->get('label_interest');
		$data['label_career']        = $this->language->get('label_career');
		$data['label_achievement']   = $this->language->get('label_achievement');
		$data['label_button'] 	     = $this->language->get('label_button');
		$data['label_image'] 		 = $this->language->get('label_image');
        $data['label_resume'] 		 = $this->language->get('label_resume');
		$data['label_about'] 		 = $this->language->get('label_about');
		$data['label_jobtype'] 		 = $this->language->get('label_jobtype');
		$data['label_partime'] 		 = $this->language->get('label_partime');
		$data['label_fultime'] 		 = $this->language->get('label_fultime');
		$data['label_jobcategory'] 		 = $this->language->get('label_jobcategory');
		$data['text_your_address'] 		 = $this->language->get('text_your_address');





		$data['text_female']         = $this->language->get('text_female');
		
		$data['entry_fullname']      = $this->language->get('entry_fullname');
		$data['entry_gender']        = $this->language->get('entry_gender');
		$data['entry_birth_date']    = $this->language->get('entry_birth_date');
		$data['entry_employ']        = $this->language->get('entry_employ');
		$data['entry_address']       = $this->language->get('entry_address');
		$data['entry_mobile']        = $this->language->get('entry_mobile');
		$data['entry_home_phone']    = $this->language->get('entry_home_phone');
		$data['entry_pincode']       = $this->language->get('entry_pincode');
		$data['entry_city']          = $this->language->get('entry_city');
		$data['entry_country']       = $this->language->get('entry_country');
		$data['entry_zone']          = $this->language->get('entry_zone');
		$data['entry_newsletter']    = $this->language->get('entry_newsletter');
		$data['entry_profissional']  = $this->language->get('entry_profissional');
		$data['entry_experience']    = $this->language->get('entry_experience');
		$data['entry_additional']    = $this->language->get('entry_additional');
		$data['entry_education']     = $this->language->get('entry_education');
		$data['entry_degree']        = $this->language->get('entry_degree');
		$data['entry_collage']       = $this->language->get('entry_collage');
		$data['entry_passed']        = $this->language->get('entry_passed');
		$data['entry_percentage']    = $this->language->get('entry_percentage');
		$data['entry_interest']      = $this->language->get('entry_interest');
		$data['entry_career']        = $this->language->get('entry_career');
		$data['entry_achievement']   = $this->language->get('entry_achievement');
		$data['entry_button'] 	     = $this->language->get('entry_button');
		$data['button_remove'] 	     = $this->language->get('button_remove');
		$data['button_add'] 	     = $this->language->get('button_add');
		$data['button_continue'] 	 = $this->language->get('button_continue');
		$data['button_upload'] 		 = $this->language->get('button_upload');
		$data['entry_image'] 		 = $this->language->get('entry_image');
		$data['entry_resume'] 		 = $this->language->get('entry_resume');
		$data['entry_about'] 		 = $this->language->get('entry_about');
	     $data['entry_jobtype'] 		 = $this->language->get('entry_jobtype');
		$data['text_select'] 		 = $this->language->get('text_select');
		$data['entry_partime'] 		 = $this->language->get('entry_partime');
		$data['entry_fultime'] 		 = $this->language->get('entry_fultime');
		$data['entry_jobcategory'] 		 = $this->language->get('entry_jobcategory');
        $data['button_continueupdate'] 		 = $this->language->get('UPDATE');
        $data['text_profile']        = $this->language->get('text_profile');
        $data['text_apply']          = $this->language->get('text_apply');
        $data['text_postjob']        = $this->language->get('text_postjob');
        $data['text_change']         = $this->language->get('text_change');

		$employ_info                 =$this->model_job_employ->getemploy($this->employ->getId());
		$data['employ_id']	         =$this->employ->getId();
	
		if(isset($employ_info)){
			$data['fullname']	    	=$employ_info['fullname'];
			$data['gender']	       		=$employ_info['gender'];
			$data['date_of_birth']		=$employ_info['date_of_birth'];
			$data['address']	   		=$employ_info['address'];
			$data['city']	       		=$employ_info['city'];
			$data['pincode']	   		=$employ_info['pincode'];
			$data['country_id']	   		=$employ_info['country_id'];
			$data['zone_id']	   		=$employ_info['zone_id'];
			$data['jobtype_id']	   		=$employ_info['jobtype_id'];
			$data['mobile_phone']		=$employ_info['mobile_phone'];
			$data['home_phone']	    	=$employ_info['home_phone'];
			$data['profissional']		=$employ_info['profissional'];
			$data['experience']	   		=$employ_info['experience'];
			$data['interest']	   		=$employ_info['interest'];
			$data['career']	        	=$employ_info['career'];
			$data['achievement']		=$employ_info['achievement'];
			$data['resumelist']		    =$employ_info['resumelist'];
			$data['image']		        =$employ_info['image'];
			$data['about_self']		        =$employ_info['about_self'];
			//$data['resume']	        =$employ_info['resume'];
	}


	if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (isset($employ_info['category_id'])) {
			$data['category_id'] = $employ_info['category_id'];
		} else {
			$data['category_id'] = '';
		}

		$this->load->model('catalog/category');

		if(!empty($data['category_id'])) {
			$cat_name = $this->model_catalog_category->getJobCategory($data['category_id']);
			$data['cat_name'] = $cat_name['name'];
		}
		else{
			$data['cat_name'] = '';
		}


		if(!empty($employ_info['image'])){
			$data['thumb'] = $this->model_tool_image->resize($employ_info['image'],135,135);
		}else{
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',135,135);
		}

		if(!empty($employ_info['resumelist'])){
			$data['cvthumb'] = $this->model_tool_image->resize($employ_info['resumelist'],135,135);
		}else{
			$data['cvthumb'] = $this->model_tool_image->resize('placeholder.png',135,135);
		}
      
      	////$data['cvthumb'] = $this->model_tool_image->resize('placeholder.png',45,45);



		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->error['fullname'])) {
			$data['error_fullname'] = $this->error['fullname'];
		} else {
			$data['error_fullname'] = '';
		}
	
		if (isset($this->error['jobtype_id'])) {
			$data['error_jobtype_id'] = $this->error['jobtype_id'];
		} else {
			$data['error_jobtype_id'] = '';
		}


		if (isset($this->error['jobcategory'])) {
			$data['error_jobcategory'] = $this->error['jobcategory'];
		} else {
			$data['error_jobcategory'] = '';
		}

		if (isset($this->error['mobile_phone'])) {
			$data['error_mobile_phone'] = $this->error['mobile_phone'];
		} else {
			$data['error_mobile_phone'] = '';
		}
		if (isset($this->error['home_phone'])) {
			$data['error_home_phone'] = $this->error['home_phone'];
		} else {
			$data['error_home_phone'] = '';
		}
		if (isset($this->error['profissional'])) {
			$data['error_profissional'] = $this->error['profissional'];
		} else {
			$data['error_profissional'] = '';
		}
		
		if (isset($this->error['experience'])) {
			$data['error_experience'] = $this->error['experience'];
		} else {
			$data['error_experience'] = '';
		}
		
		if (isset($this->error['interest'])) {
			$data['error_interest'] = $this->error['interest'];
		} else {
			$data['error_interest'] = '';
		}
		
		if (isset($this->error['address'])) {
			$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = '';
		}

		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}
		if (isset($this->error['date_of_birth'])) {
			$data['error_date_of_birth'] = $this->error['date_of_birth'];
		} else {
			$data['error_date_of_birth'] = '';
		}
		if (isset($this->error['pincode'])) {
			$data['error_pincode'] = $this->error['pincode'];
		} else {
			$data['error_pincode'] = '';
		}
		if (isset($this->error['gender'])) {
			$data['error_gender'] = $this->error['gender'];
		} else {
			$data['error_gender'] = '';
		}
		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}
		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}
		

		$data['action'] = $this->url->link('employ/editemploy', '', true);

		if (isset($this->request->post['fullname'])) {
			$data['fullname'] = $this->request->post['fullname'];
		} 

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} 

		
		if (isset($this->request->post['gender'])) {
			$data['gender'] = $this->request->post['gender'];
		}
		
		if (isset($this->request->post['date_of_birth'])) {
			$data['date_of_birth'] = $this->request->post['date_of_birth'];
		}
		
		if (isset($this->request->post['mobile_phone'])) {
			$data['mobile_phone'] = $this->request->post['mobile_phone'];
		}
		
		
		if (isset($this->request->post['home_phone'])) {
			$data['home_phone'] = $this->request->post['home_phone'];
		}
		
		if (isset($this->request->post['profissional'])) {
			$data['profissional'] = $this->request->post['profissional'];
		} 
		
		if (isset($this->request->post['experience'])) {
			$data['experience'] = $this->request->post['experience'];
		} 
		
		if (isset($this->request->post['interest'])) {
			$data['interest'] = $this->request->post['interest'];
		} 
		
		if (isset($this->request->post['career'])) {
			$data['career'] = $this->request->post['career'];
		} 
		
		if (isset($this->request->post['achievement'])) {
			$data['achievement'] = $this->request->post['achievement'];
		} 

		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		}
		
		if (isset($this->request->post['pincode'])) {
			$data['pincode'] = $this->request->post['pincode'];
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} 

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = (int)$this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} 

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = (int)$this->request->post['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} 

		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();

		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
				
			$data['education_rowss'] = array();
			if (isset($this->request->post['education_row'])) {
			$education_rowss = $this->request->post['educationrow'];
		} elseif ($this->employ->getId()) {
			$education_rowss = $this->model_job_employ->getEducations($this->employ->getId());
		} else {
			$education_rowss = array();
		}
		$data['education_rowss'] = array();
		if(!empty($education_rowss)){
		foreach ($education_rowss as $key => $value) {
		  foreach ($value as $educationrow) {
				 $data['education_rowss'][$key][] = array(
				 'degree'        => $educationrow['degree'],
				 'collage'       => $educationrow['collage'],
				 'percentage'    => $educationrow['percentage'],
				 'passed_year'   => $educationrow['passed_year']
				 );
			}
		}
		}
		
		
		
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');

			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));

			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}
        
        $data['edashboard'] = $this->url->link('employ/dashboard', '', true);
        $data['appliedjob'] = $this->url->link('employ/appliedjob', '', true);
        $data['editemploy'] = $this->url->link('employ/editemploy', '', true);
        $data['changepassword'] = $this->url->link('employ/changepassword', '', true);
        $data['logout'] = $this->url->link('employ/logout', '', true);
        $data['text_logout']         = $this->language->get('text_logout');

		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('employ/editemploy', $data));
	}
	private function validate() {
		if ((utf8_strlen(trim($this->request->post['experience'])) < 1) || (utf8_strlen(trim($this->request->post['experience'])) > 128)) {
			$this->error['experience'] = $this->language->get('error_experience');
		}
		if ((utf8_strlen(trim($this->request->post['profissional'])) < 1) || (utf8_strlen(trim($this->request->post['profissional'])) > 128)) {
			$this->error['profissional'] = $this->language->get('error_profissional');
		}
		if ((utf8_strlen(trim($this->request->post['interest'])) < 1) || (utf8_strlen(trim($this->request->post['interest'])) > 128)) {
			$this->error['interest'] = $this->language->get('error_interest');
		}
		if ((utf8_strlen(trim($this->request->post['fullname'])) < 1) || (utf8_strlen(trim($this->request->post['fullname'])) > 128)) {
			$this->error['fullname'] = $this->language->get('error_fullname');
		}
	
		if ((utf8_strlen(trim($this->request->post['address'])) < 3) || (utf8_strlen(trim($this->request->post['address'])) > 128)) {
			$this->error['address'] = $this->language->get('error_address');
		}
		if ((utf8_strlen($this->request->post['date_of_birth'])< 3)||(utf8_strlen($this->request->post['date_of_birth']) > 128)) {
		 	$this->error['date_of_birth']= $this->language->get('error_date_of_birth');
		}
		if ((utf8_strlen(trim($this->request->post['mobile_phone'])) < 3) || (utf8_strlen(trim($this->request->post['mobile_phone'])) > 128)) {
			$this->error['mobile_phone'] = $this->language->get('error_mobile_phone');
		}
		if ((utf8_strlen(trim($this->request->post['pincode'])) < 3) || (utf8_strlen(trim($this->request->post['pincode'])) > 128)) {
			$this->error['pincode'] = $this->language->get('error_pincode');
		}
		if ((utf8_strlen(trim($this->request->post['home_phone'])) < 3) || (utf8_strlen(trim($this->request->post['home_phone'])) > 128)) {
			$this->error['home_phone'] = $this->language->get('error_home_phone');
		}
		if ((utf8_strlen(trim($this->request->post['gender'])) == "")) {
			$this->error['gender'] = $this->language->get('error_gender');
		}


		if ((utf8_strlen(trim($this->request->post['jobtype_id'])) == "")) {
			$this->error['jobtype_id'] = $this->language->get('error_jobtype_id');
		}
		if ((utf8_strlen(trim($this->request->post['jobcategory'])) == "")) {
			$this->error['jobcategory'] = $this->language->get('error_jobcategory');
		}
		
		
		if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
			$this->error['city'] = $this->language->get('error_city');
		}

		$this->load->model('localisation/country');

		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		
		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}

		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}	
		return !$this->error;
	}
	
	public function upload(){
		$this->load->language('tool/upload');
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
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
	
	
	
}