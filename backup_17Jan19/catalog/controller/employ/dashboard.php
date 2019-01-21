<?php
class ControllerEmployDashboard extends Controller {
	private $error = array();

	public function index() {
		
		if (!$this->employ->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->load->language('employ/dashboard');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');
		
		$this->load->model('job/employ');
		$this->load->model('tool/image');
		
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('employ/dashboard', '', true)
		);
		
		$data['heading_title'] 		     = $this->language->get('heading_title');
		$data['text_account_already']    = sprintf($this->language->get('text_account_already'), $this->url->link('employ/login', '', true));
		$data['text_your_details']       = $this->language->get('text_your_details');
		$data['text_your_address']       = $this->language->get('text_your_address');
		$data['text_your_password']      = $this->language->get('text_your_password');
		$data['text_newsletter']         = $this->language->get('text_newsletter');
		$data['text_yes']                = $this->language->get('text_yes');
		$data['text_no']                 = $this->language->get('text_no');
		$data['text_select']             = $this->language->get('text_select');
		$data['text_none']               = $this->language->get('text_none');
		$data['text_loading']            = $this->language->get('text_loading');
		$data['text_male']               = $this->language->get('text_male');
		$data['text_female']             = $this->language->get('text_female');
		$data['text_profile']            = $this->language->get('text_profile');
		$data['text_apply']              = $this->language->get('text_apply');
		$data['text_postjob']            = $this->language->get('text_postjob');
		$data['text_change']             = $this->language->get('text_change');
		$data['dashboard_fullname']      = $this->language->get('dashboard_fullname');
		$data['dashboard_email']         = $this->language->get('dashboard_email');
		$data['dashboard_gender']        = $this->language->get('dashboard_gender');
		$data['dashboard_birth_date']    = $this->language->get('dashboard_birth_date');
		$data['dashboard_employ']        = $this->language->get('dashboard_employ');
		$data['dashboard_address']       = $this->language->get('dashboard_address');
		$data['dashboard_mobile']        = $this->language->get('dashboard_mobile');
		$data['dashboard_home_phone']    = $this->language->get('dashboard_home_phone');
		$data['dashboard_pincode']       = $this->language->get('dashboard_pincode');
		$data['dashboard_city']          = $this->language->get('dashboard_city');
		$data['dashboard_country']       = $this->language->get('dashboard_country');
		$data['dashboard_location']      = $this->language->get('dashboard_location');
		$data['dashboard_zone']          = $this->language->get('dashboard_zone');
		$data['dashboard_experience']    = $this->language->get('dashboard_experience');
		$data['dashboard_education']     = $this->language->get('dashboard_education');
		$data['dashboard_degree']        = $this->language->get('dashboard_degree');
		$data['dashboard_collage']       = $this->language->get('dashboard_collage');
		$data['dashboard_passed']        = $this->language->get('dashboard_passed');
		$data['dashboard_percentage']    = $this->language->get('dashboard_percentage');
		

		$data['dashboard_profissional']  = $this->language->get('dashboard_profissional');
		
		$data['dashboard_my_information']= $this->language->get('dashboard_my_information');
		
		$data['dashboard_newsletter']    = $this->language->get('dashboard_newsletter');

		

		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_download'] = $this->language->get('button_download');
		$data['text_logout'] = $this->language->get('text_logout');
		
		$employ_info=$this->model_job_employ->getemploy($this->employ->getId());
		if ($employ_info['gender']) {
			$gender = $this->language->get('text_male');
		} else {
			$gender = $this->language->get('text_female');
		}

        $employ_info=$this->model_job_employ->getemploy($this->employ->getId());
		
		if(!empty($employ_info['image'])){
			$data['thumb'] = $this->model_tool_image->resize($employ_info['image'],370,281);
		}else{
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',370,281);
		}
		
		$data['employ_id']	    =$this->employ->getId();
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
		$data['experience']	    =$employ_info['experience'];
		$data['profissional']	=$employ_info['profissional'];
		$data['interest']		=$employ_info['interest'];
		$data['career']			=$employ_info['career'];
		$data['achievement']	=$employ_info['achievement'];

		 if(!empty($employ_info['resumelist'])){
              $data['resumecv'] ='image/'.$employ_info['resumelist'];
         }
		$education_info=$this->model_job_employ->getShowEducation($data);
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
		
		$getZone = $this->model_localisation_zone->getZone($employ_info['zone_id']);
		$getCountry = $this->model_localisation_country->getCountry($employ_info['country_id']);
		
		if(isset($getZone['name'])){
		$data['zone']=$getZone['name'];         
		} else {
		$data['zone']='';
		}
		if(isset($getCountry['name'])){
		$data['country']=$getCountry['name'];         
		} else {
		$data['country']='';
		}		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
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
		$this->response->setOutput($this->load->view('employ/dashboard', $data));
	}
}	