<?php
class ControllerCommonColumnLeft extends Controller {
	public function index() {
		if (isset($this->request->get['token']) && isset($this->session->data['token']) && ($this->request->get['token'] == $this->session->data['token'])) {
			$this->load->language('common/column_left');
	
			$this->load->model('user/user');
	
			$this->load->model('tool/image');
	
			$user_info = $this->model_user_user->getUser($this->user->getId());
	
			if ($user_info) {
				$data['firstname'] = $user_info['firstname'];
				$data['lastname'] = $user_info['lastname'];
	
				$data['user_group'] = $user_info['user_group'];
	
				if (is_file(DIR_IMAGE . $user_info['image'])) {
					$data['image'] = $this->model_tool_image->resize($user_info['image'], 45, 45);
				} else {
					$data['image'] = '';
				}
			} else {
				$data['firstname'] = '';
				$data['lastname'] = '';
				$data['user_group'] = '';
				$data['image'] = '';
			}			
		  	$data['menus'][] = array(
				'id'       => 'menu-dashboard',
				'icon'	   => 'fa-dashboard',
				'name'	   => $this->language->get('text_dashboard'),
				'href'     => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true),
				'children' => array()
			);
///// 
			
			
		
///////		
			$company = array();
			
			$company[] = array(
				'name'	   => $this->language->get('text_companyprofile'),
				'href'     => $this->url->link('job/company', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);	
            
            $company[] = array(
				'name'	   => $this->language->get('text_jobtype'),
				'href'     => $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);
					
			if ($company) {					
			$data['menus'][] = array(
				'id'       => 'menu-job',
				'icon'	   => 'fa-building', 
				'name'	   => $this->language->get('text_company'),
				'href'     => '',
				'children' => $company
			);		
		 }
            
        $employee = array();	
			
			$employee[] = array(
				'name'	   => $this->language->get('text_employlist'),
				'href'     => $this->url->link('job/employ', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);				
					
		if ($employee) {					
			$data['menus'][] = array(
				'id'       => 'menu-employee',
				'icon'	   => 'fa-user', 
				'name'	   => $this->language->get('text_employ'),
				'href'     => '',
				'children' => $employee
			);		
		 }
	      		
		// job //
		$job = array();
			
			$job[] = array(
				'name'	   => $this->language->get('text_category'),
				'href'     => $this->url->link('job/category', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);	
			
					
			if ($job) {					
			$data['menus'][] = array(
				'id'       => 'menu-job',
				'icon'	   => 'fa-tags', 
				'name'	   => $this->language->get('text_job'),
				'href'     => '',
				'children' => $job
			);		
		 }	
			
		/* Mega Header */						
		$megaheader = array();
            
        if ($this->user->hasPermission('access', 'common/theme')) {		
			$megaheader[] = array(
				'name'	   => $this->language->get('text_themecontrol'),
				'href'     => $this->url->link('common/theme', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);					
		}

		if ($this->user->hasPermission('access', 'job/jobsetting')) {	
			$megaheader[] = array(
				'name'	   => $this->language->get('text_jobsetting'),
				'href'     => $this->url->link('job/jobsetting', 'token=' . $this->session->data['token'], true),
				'children' => array()		
			);
		}
		
		if ($this->user->hasPermission('access', 'megaheader/megaheader')) {		
		$megaheader[] = array(
		'name'	   => $this->language->get('text_megaheader'),
		'href'     => $this->url->link('megaheader/megaheader', 'token=' . $this->session->data['token'], true),
		'children' => array()		
		);					
		}
            
        if ($this->user->hasPermission('access', 'tmdblog/blogdashboard')) {		
				$megaheader[] = array(
					'name'	   => $this->language->get('text_blogdashboard'),
					'href'     => $this->url->link('tmdblog/blogdashboard', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);					
			}
        
            
           if ($this->user->hasPermission('access', 'catalog/testimonial')) {
				$megaheader[] = array(
					'name'	   => $this->language->get('text_testimonial'),
					'href'     => $this->url->link('catalog/testimonial', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
            
            if ($this->user->hasPermission('access', 'catalog/information')) {
				$megaheader[] = array(
					'name'	   => $this->language->get('text_information'),
					'href'     => $this->url->link('catalog/information', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
					
		if ($megaheader) {					
		$data['menus'][] = array(
		'id'       => 'menu-megaheader',
		'icon'	   => 'fa fa-bars', 
		'name'	   => $this->language->get('text_extramenus'),
		'href'     => '',
		'children' => $megaheader
		);		
		}
			
			/* Mega Header */
			
			// Extension
			$extension = array();
	
		
			
			if ($this->user->hasPermission('access', 'extension/extension')) {		
				$extension[] = array(
					'name'	   => $this->language->get('text_extension'),
					'href'     => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], true),
					'children' => array()
				);
			}
					
		
			
		
					
			if ($extension) {					
				$data['menus'][] = array(
					'id'       => 'menu-extension',
					'icon'	   => 'fa-puzzle-piece', 
					'name'	   => $this->language->get('text_extension'),
					'href'     => '',
					'children' => $extension
				);		
			}
			
			// Design
			$design = array();
			
			if ($this->user->hasPermission('access', 'design/layout')) {
				$design[] = array(
					'name'	   => $this->language->get('text_layout'),
					'href'     => $this->url->link('design/layout', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
		
			if ($this->user->hasPermission('access', 'design/banner')) {
				$design[] = array(
					'name'	   => $this->language->get('text_banner'),
					'href'     => $this->url->link('design/banner', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
			
			if ($design) {
				$data['menus'][] = array(
					'id'       => 'menu-design',
					'icon'	   => 'fa-television', 
					'name'	   => $this->language->get('text_design'),
					'href'     => '',
					'children' => $design
				);	
			}
			
			// System
			$system = array();
			
			if ($this->user->hasPermission('access', 'setting/setting')) {
				$system[] = array(
					'name'	   => $this->language->get('text_setting'),
					'href'     => $this->url->link('setting/store', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
		
			// Users
			$user = array();
			
			if ($this->user->hasPermission('access', 'user/user')) {
				$user[] = array(
					'name'	   => $this->language->get('text_users'),
					'href'     => $this->url->link('user/user', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
			if ($this->user->hasPermission('access', 'user/user_permission')) {	
				$user[] = array(
					'name'	   => $this->language->get('text_user_group'),
					'href'     => $this->url->link('user/user_permission', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);	
			}
			
		
			
			if ($user) {
				$system[] = array(
					'name'	   => $this->language->get('text_users'),
					'href'     => '',
					'children' => $user		
				);
			}
			
			// Localisation
			$localisation = array();

			if ($this->user->hasPermission('access', 'localisation/language')) {
				$localisation[] = array(
					'name'	   => $this->language->get('text_language'),
					'href'     => $this->url->link('localisation/language', 'token=' . $this->session->data['token'], true),
					'children' => array()		
				);
			}
		
			
			if ($localisation) {																
				$system[] = array(
					'name'	   => $this->language->get('text_localisation'),
					'href'     => '',
					'children' => $localisation	
				);
			}
		
			// Localisation
			
			
			if ($system) {
				$data['menus'][] = array(
					'id'       => 'menu-system',
					'icon'	   => 'fa-cog', 
					'name'	   => $this->language->get('text_system'),
					'href'     => '',
					'children' => $system
				);
			}
			
		
			
			// Report Products			
		
			
		
			// Report
			
		
			return $this->load->view('common/column_left', $data);
		}
	}
}