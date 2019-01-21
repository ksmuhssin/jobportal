<?php
	class ControllerCompanyCandidateprofile extends Controller {
	private $error = array();
		public function index() {		
		$this->load->language('company/candidateprofile');
				$this->load->model('tool/image');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		$this->load->model('job/employ');
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('employ/editemploy', '', true)
		);
		$data['heading_title'] 		 = $this->language->get('heading_title');
		$data['text_account_already']= sprintf($this->language->get('text_account_already'), $this->url->link('employ/login', '', true));
		$data['text_your_details']   = $this->language->get('text_your_details');
		$data['text_sort'] 			 = $this->language->get('text_sort');
		$data['text_limit'] 		 = $this->language->get('text_limit');
		$data['text_your_address']   = $this->language->get('text_your_address');
		$data['text_your_password']  = $this->language->get('text_your_password');
		$data['text_newsletter']     = $this->language->get('text_newsletter');
		$data['text_yes']            = $this->language->get('text_yes');
		$data['text_no']             = $this->language->get('text_no');
		$data['text_select']         = $this->language->get('text_select');
		$data['text_none']           = $this->language->get('text_none');
		$data['text_loading']        = $this->language->get('text_loading');
		$data['text_male']           = $this->language->get('text_male');
		$data['text_female']         = $this->language->get('text_female');
		$data['text_message']         = $this->language->get('text_message');
		$data['text_company']         = $this->language->get('text_company');
		$data['text_contact']         = $this->language->get('text_contact');
		$data['text_email']         = $this->language->get('text_email');
		$data['text_sendmsg']         = $this->language->get('text_sendmsg');
		$data['entry_fullname']      = $this->language->get('entry_fullname');
		$data['entry_email']         = $this->language->get('entry_email');
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
		$data['entry_profissional']  = $this->language->get('entry_profissional');
		$data['entry_experience']    = $this->language->get('entry_experience');
		$data['entry_education']     = $this->language->get('entry_education');
		$data['entry_degree']        = $this->language->get('entry_degree');
		$data['entry_collage']       = $this->language->get('entry_collage');
		$data['entry_passed']        = $this->language->get('entry_passed');
		$data['entry_percentage']    = $this->language->get('entry_percentage');
		$data['entry_my_information']= $this->language->get('entry_my_information');
		$data['entry_achievement']   = $this->language->get('entry_achievement');
		$data['entry_career']        = $this->language->get('entry_career');
		$data['entry_interest']      = $this->language->get('entry_interest');
		$data['button_contact'] 	 = $this->language->get('button_contact');
		$data['button_download'] 	 = $this->language->get('button_download');
		$data['button_upload'] 		 = $this->language->get('button_upload');
		
		if (isset($this->request->get['employ_id'])) {
		$employid = $this->request->get['employ_id'];
		} else {
		$employid = '';
		}
	
		$employ_info=$this->model_job_employ->getemploy($employid);

		   if(empty($employ_info['fullname'])){
			$this->response->redirect($this->url->link('company/jobsubmitlist'));

		}

		
		if(isset($employ_info)){
		if ($employ_info['gender']) {
			$gender = $this->language->get('text_male');
		} else {
			$gender = $this->language->get('text_female');
		}	
			
		$data['employ_id']	    =$this->employ->getId();
		$data['employid']	    =$employid;
		$data['fullname']	    =$employ_info['fullname'];
		$data['email']	        =$employ_info['email'];
		$data['gender']	        =$gender;
		$data['date_of_birth']	=$employ_info['date_of_birth'];
		$data['address']	    =$employ_info['address'];
		$data['city']	        =$employ_info['city'];
		$data['pincode']	    =$employ_info['pincode'];
		$data['country_id']	    =$employ_info['country_id'];
		$data['zone_id']	    =$employ_info['zone_id'];
		$data['mobile_phone']	=$employ_info['mobile_phone'];
		$data['home_phone']	    =$employ_info['home_phone'];
		$data['profissional']	=$employ_info['profissional'];
		$data['experience']	    =$employ_info['experience'];
		$data['interest']	    =$employ_info['interest'];
		$data['career']	        =$employ_info['career'];
		$data['achievement']	=$employ_info['achievement'];
		$data['resumecv']		    ='image/'.$employ_info['resumelist'];
	
		}
		if(!empty($employ_info['image'])){
			$data['thumb'] = $this->model_tool_image->resize($employ_info['image'],370,281);
		}else{
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',370,281);
		}


		$education_info=$this->model_job_employ->getShowEducationsingale($this->request->get['employ_id']);
			
		if(isset($education_info))	{
			foreach($education_info as $education_infos){
				$data['educations'][] = array(
					'employ_id'		=>  $this->employ->getId(),	
					'degree'		=>  $education_infos['degree'],	
					'collage'		=>  $education_infos['collage'],	
					'passed_year'	=>  $education_infos['passed_year'],	
					'percentage'	=>  $education_infos['percentage'],	
				);
			}
		}
			
		// get zone name and country name
		
		$this->load->model('localisation/country'); 
		$this->load->model('localisation/zone'); 
			
		$getZone 	= $this->model_localisation_zone->getZone($employ_info['zone_id']);
		$getCountry = $this->model_localisation_country->getCountry($employ_info['country_id']);
			
		$data['zone']		=	$getZone['name'];
		$data['country']	=	$getCountry['name'];	
			
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header']	 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('company/candidateprofile', $data));
		}

		public function serviceviewemail() {
			$this->load->language('company/candidateprofile');
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('job/applyjob');
			$json = array();
			
			if(empty($this->request->post['name'])) {
				$json['error']['name']= $this->language->get('error_name');
			}
			
			if(empty($this->request->post['companyemail'])) {
				$json['error']['companyemail']= $this->language->get('error_companyemail');
			}

			if(empty($this->request->post['phone'])) {
				$json['error']['phone']= $this->language->get('error_phone');
			}

			if(empty($json['error'])){
			
			$candidate_id=$this->model_job_applyjob->sendemail($this->request->post);
			
			$candidateinfo=$this->model_job_applyjob->getcandidate($candidate_id);
			
			if(isset($candidateinfo['name'])){
			  $name= $candidateinfo['name'];
			}
			if(isset($candidateinfo['phone'])){
     			 $phoneno= $candidateinfo['phone'];
			}

			$this->load->model('job/employ');
			$employ_info = $this->model_job_employ->getemploy($candidateinfo['employ_id']);
			if(isset($employ_info['email'])){
			   $email= $employ_info['email'];
			}
			$to = $email;
			$subject = 'You Send message in compeny';
			$body = 'Compeny Name Message Email '.$name. ' '.$phoneno;
			$headers = 'From: <bablumultimedia31@gmail.com>' . "\r\n";
			mail($to,$subject,$body,$headers);
	    	$json['success'] = $this->language->get('text_success');
	    }
	}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}
	


	}