<?php
class ControllerJobEmploy extends Controller {
		private $error = array();
	public function index() {
		$this->load->language('job/employ');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/employ');
		
		$this->getList();
	}

	public function add() {
		$this->load->language('job/employ');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/employ');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		    
			$this->model_job_employ->addEmploy($this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['sort'])) {
			 	$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
			 	$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])) {
			 	$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getForm();
	}
	
	public function approve(){
		$this->load->language('job/employ');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/employ');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['employ_id'])){
			$approves[] = $this->request->get['employ_id'];
		}
		if ($approves && $this->validateApprove()){
			foreach($approves as $employ_id){
				$this->model_job_employ->approve($employ_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['sort'])){
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])){
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	}

	public function disapprove(){
		$this->load->language('job/employ');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/employ');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['employ_id'])){
			$approves[] = $this->request->get['employ_id'];
		}
		if ($approves){
			foreach($approves as $employ_id){
				$this->model_job_employ->disApprove($employ_id);
			}
			$this->session->data['success'] = $this->language->get('text_success');
			$url = '';
			if (isset($this->request->get['sort'])){
				$url .= '&sort=' . $this->request->get['sort'];
			}
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
			if (isset($this->request->get['page'])){
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList(); 
	}
	
	public function edit(){
		$this->load->language('job/employ');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/employ');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_job_employ->editEmploy($this->request->get['employ_id'],$this->request->post);
			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
			$this->response->redirect($this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getForm();
	}

	public function delete() {
	
		$this->load->language('job/employ');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/employ');
        
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			foreach ($this->request->post['selected'] as $employ_id)
			{
				$this->model_job_employ->deleteEmploy($employ_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			$this->response->redirect($this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true));
		}
    	$this->getList();
	}

	public function getList() {
		if (isset($this->request->get['filter_fullname'])) {
			$filter_fullname = $this->request->get['filter_fullname'];
		} else {
			$filter_fullname = false;
		}

		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = false;
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fullname';
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

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['filter_fullname'])) {
			$url .= '&filter_fullname=' . $this->request->get['filter_fullname'];
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_home'),
		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('heading_title'),
		'href' => $this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('job/employ/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/employ/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['employs'] = array();

		$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
		'filter_fullname'     => $filter_fullname,
		'filter_email'      => $filter_email,
		'start' => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit' => $this->config->get('config_limit_admin')
		);
		
		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$this->load->model('tool/image');
		$this->load->model('localisation/stock_status');
		$employ_total = $this->model_job_employ->getTotalEmployss($filter_data);
		
		$results=$this->model_job_employ->getEmploys($filter_data);
		
		if(isset($results)) {
		foreach($results as $result)
			{
				if (is_file(DIR_IMAGE . $result['image'])) {
					$image = $this->model_tool_image->resize($result['image'], 40, 40);
				} else {
					$image = $this->model_tool_image->resize('no_image.png', 40, 40);
				}
				
				if (!$result['approved']) {
					$approve = $this->url->link('job/employ/approve', 'token=' . $this->session->data['token'] . '&employ_id=' . $result['employ_id']);
				} else {
			  		$approve = '';
				}

				if ($result['approved']) {
					$disapproved = $this->url->link('job/employ/disapprove', 'token=' . $this->session->data['token'] . '&employ_id=' . $result['employ_id']);
				} else {
					$disapproved = '';
				}
				
				if ($result['gender']) {
					$gender = $this->language->get('text_male');
				} else {
					$gender = $this->language->get('text_female');
				}
				$country_info=$this->model_localisation_country->getCountry ($result['country_id']);
				if(isset($country_info['name'])){
					$country=$country_info['name'];         
				} else {
					$country='';
				}
				$zone_info = $this->model_localisation_zone->getZone($result['zone_id']);
				if(isset($zone_info['name'])){
					$zone=$zone_info['name'];         
				} else {
					$zone='';
				}
				$data['employs'][]=array(
				'employ_id'     =>$result['employ_id'],
				'fullname'      =>$result['fullname'],
				'email'         =>$result['email'],
				'address'       =>$result['address'],
				'country'       =>$country,
				'zone'          =>$zone,
				'image'       	=>$image,
				'approve'       =>$approve,
				'disapproved'	=> $disapproved,
				'edit'       	=> $this->url->link('job/employ/edit', 'token=' . $this->session->data['token'] .'&employ_id=' . $result['employ_id'] . $url, true)
				);
			}
		}
		$data['heading_title']          = $this->language->get('heading_title');
		$data['text_list']           	= $this->language->get('text_list');
		$data['text_no_results'] 		= $this->language->get('text_no_results');
		$data['text_confirm']			= $this->language->get('text_confirm');
		$data['text_male']				= $this->language->get('Male');
		$data['text_female'] 			= $this->language->get('Female');
		$data['text_none'] 				= $this->language->get('text_none');
		$data['text_confirm']           = $this->language->get('text_confirm');

		$data['column_image']			= $this->language->get('column_image');
		$data['column_fullname']		= $this->language->get('column_fullname');
		$data['column_email']			= $this->language->get('column_email');
		$data['column_address']			= $this->language->get('column_address');
		$data['column_country']			= $this->language->get('column_country');
		$data['column_zone']			= $this->language->get('column_zone');
		$data['column_action']			= $this->language->get('column_action');
		$data['column_approve']			= $this->language->get('column_approve');

		$data['button_remove']          = $this->language->get('button_remove');
		$data['button_edit']            = $this->language->get('button_edit');
		$data['button_approve']         = $this->language->get('button_approve');
		$data['button_desapprove']      = $this->language->get('button_desapprove');
		$data['button_add']             = $this->language->get('button_add');
		$data['button_filter']          = $this->language->get('button_filter');
		$data['button_delete']          = $this->language->get('button_delete');
		$data['token']                  = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		 } else {
			$data['error_warning'] = '';
		 }
		$data['sort']                = $sort;
		$data['order']               = $order;
		$data['filter_fullname']     = $filter_fullname;
		$data['filter_email']        = $filter_email;
		 /// session
				
		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['packages']=array();

		$data['sort']=$sort;
		$data['order']=$order;
    	$data['filter_fullname']=$filter_fullname;
		$data['pagination']='';
		$data['results']='';

		$data['add']=$this->url->link('job/employ/add','&token='.$this->session->data['token'].$url,true);
		$data['delete']=$this->url->link('job/employ/delete','&token='.$this->session->data['token'].$url,true);

		if (!isset($this->request->get['employ_id'])) {
			$data['action'] = $this->url->link('job/employ/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/employ/edit', 'token=' . $this->session->data['token'] . '&employ_id=' . $this->request->get['employ_id'] . $url, true);
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
						
		$data['sort_image']  	= $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=image' . $url, true);
		$data['sort_fullname']  = $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=fullname' . $url, true);
		$data['sort_email']  	= $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
		$data['sort_address']  	= $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=address' . $url, true);
		$data['sort_country_id']= $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=country_id' . $url, true);
		$data['sort_zone_id']  	= $this->url->link('job/employ', 'token=' . $this->session->data['token'] . '&sort=zone_id' . $url, true);
			
		$url = '';
		
		///// pagination //////  
			$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
	
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['filter_fullname'])) {
			$url .= '&filter_fullname=' . $this->request->get['filter_fullname'];
		}
		
		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}
        
		$pagination = new Pagination();
		$pagination->total  = $employ_total;
		$pagination->page   = $page;
		$pagination->limit  = $this->config->get('config_limit_admin');
		$pagination->url    = $this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($employ_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($employ_total - $this->config->get('config_limit_admin'))) ? $employ_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $employ_total, ceil($employ_total / $this->config->get('config_limit_admin')));
	 	
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/employ_list', $data));
	}
                
	protected function getForm() {
		$data['heading_title']          = $this->language->get('heading_title');
		$data['text_form']              = !isset($this->request->get['information_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_default']           = $this->language->get('text_default');
		$data['text_select']            = $this->language->get('text_select');
		$data['text_male']              = $this->language->get('Male');
		$data['text_female']            = $this->language->get('Female');
		$data['text_partime']           = $this->language->get('text_partime');
		$data['text_fultime']           = $this->language->get('text_fultime');
		$data['text_none']              = $this->language->get('text_none');
		$data['text_disable']           = $this->language->get('text_disable');
		$data['text_enable']            = $this->language->get('text_enable');
		$data['text_upload'] = $this->language->get('text_upload');

		$data['lable_fullname']         = $this->language->get('lable_fullname');
		$data['lable_email']            = $this->language->get('lable_email');
		$data['lable_password']			= $this->language->get('lable_password');
		$data['lable_confirm_password'] = $this->language->get('lable_confirm_password');
		$data['lable_gender']           = $this->language->get('lable_gender');
		$data['lable_jobtype']          = $this->language->get('lable_jobtype');
		$data['lable_jobcategoty']      = $this->language->get('lable_jobcategoty');
		$data['lable_aboutself']        = $this->language->get('lable_aboutself');
		$data['lable_birth_date']       = $this->language->get('lable_birth_date');
		$data['lable_address']          = $this->language->get('lable_address');
		$data['lable_image']            = $this->language->get('lable_image');
		$data['lable_country']          = $this->language->get('lable_country');
		$data['lable_state']            = $this->language->get('lable_state');
		$data['lable_city']   			= $this->language->get('lable_city');
		$data['lable_pincode']			= $this->language->get('lable_pincode');
		$data['lable_mobile_phone']     = $this->language->get('lable_mobile_phone');
		$data['lable_home_phone']       = $this->language->get('lable_home_phone');
		$data['lable_experience']       = $this->language->get('lable_experience');
		$data['lable_profissional']     = $this->language->get('lable_profissional');
		$data['lable_start_date']       = $this->language->get('lable_start_date');
		$data['lable_skill_name']       = $this->language->get('lable_skill_name');
		$data['lable_additional']       = $this->language->get('lable_additional');
		$data['lable_end_date']       	= $this->language->get('lable_end_date');
		$data['lable_skill']       		= $this->language->get('lable_skill');
		$data['lable_status']			= $this->language->get('lable_status');
		$data['lable_education']        = $this->language->get('lable_education');
		$data['lable_degree']           = $this->language->get('lable_degree');
		$data['lable_collage']          = $this->language->get('lable_collage');
		$data['lable_passed']          	= $this->language->get('lable_passed');
		$data['lable_percentage']       = $this->language->get('lable_percentage');
		$data['lable_button']       	= $this->language->get('lable_button');

		$data['entry_cv']         		= $this->language->get('entry_cv');
		$data['entry_fullname']         = $this->language->get('entry_fullname');
		$data['entry_email']            = $this->language->get('entry_email');
		$data['entry_password']			= $this->language->get('entry_password');
		$data['entry_confirm_password'] = $this->language->get('entry_confirm_password');
		$data['entry_gender']           = $this->language->get('entry_gender');
		$data['entry_jobtype']          = $this->language->get('entry_jobtype');
		$data['entry_jobcategoty']      = $this->language->get('entry_jobcategoty');
		$data['entry_aboutself']        = $this->language->get('entry_aboutself');
		$data['entry_birth_date']       = $this->language->get('entry_birth_date');
		$data['entry_address']          = $this->language->get('entry_address');
		$data['entry_image']            = $this->language->get('entry_image');
		$data['entry_country']          = $this->language->get('entry_country');
		$data['entry_state']            = $this->language->get('entry_state');
		$data['entry_city']   			= $this->language->get('entry_city');
		$data['entry_pincode']			= $this->language->get('entry_pincode');
		$data['entry_mobile_phone']     = $this->language->get('entry_mobile_phone');
		$data['entry_home_phone']       = $this->language->get('entry_home_phone');
		$data['entry_experience']       = $this->language->get('entry_experience');
		$data['entry_profissional']     = $this->language->get('entry_profissional');
		$data['entry_additional']       = $this->language->get('entry_additional');
		$data['entry_status']			= $this->language->get('entry_status');
		$data['entry_education']        = $this->language->get('entry_education');
		$data['entry_degree']           = $this->language->get('entry_degree');
		$data['entry_collage']          = $this->language->get('entry_collage');
		$data['entry_passed']          	= $this->language->get('entry_passed');
		$data['entry_percentage']       = $this->language->get('entry_percentage');
		$data['entry_button']       	= $this->language->get('entry_button');
		$data['entry_achievement']      = $this->language->get('entry_achievement');
		$data['entry_interest']         = $this->language->get('entry_interest');
		$data['entry_career']           = $this->language->get('entry_career');
	
	 	
		$data['button_save']            = $this->language->get('button_save');
		$data['button_add']             = $this->language->get('button_add');
		$data['button_remove']          = $this->language->get('button_remove');
		$data['button_cancel']          = $this->language->get('button_cancel');
		$data['button_upload']          = $this->language->get('button_upload');

		
	   if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
				///  language //////
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries($data);
			
		$this->load->model('localisation/stock_status');
		$data['stock_status'] = $this->model_localisation_stock_status->getStockStatuses($data);
			
		$this->load->model('localisation/zone');        
		$data['zone'] = $this->model_localisation_zone->getZones($data);
		
         ////   validateForm  ///// 
		 
		if(isset($this->error['experience'])) {
			$data['error_experience'] = $this->error['experience'];
		} 	else {
			$data['error_experience'] = '';
		}
	 
		if(isset($this->error['profissional'])) {
			$data['error_profissional'] = $this->error['profissional'];
		} 	else {
			$data['error_profissional'] = '';
		}
	 
	 	if(isset($this->error['fullname'])) {
			$data['error_fullname'] = $this->error['fullname'];
		} 	else {
			$data['error_fullname'] = '';
		}
		
		if(isset($this->error['email'])) {
		 	$data['error_email'] = $this->error['email'];
		}else {
			$data['error_email'] = '';
		}
		
		if (isset($this->error['password'])) {
			$data['error_password'] = $this->error['password'];
		} else {
			$data['error_password'] = '';
		}
		
		if(isset($this->error['confirm_password'])) {
		 	$data['error_confirm_password'] = $this->error['confirm_password'];
		} else {
			$data['error_confirm_password'] = '';
		}
		
		if(isset($this->error['gender'])) {
		 	$data['error_gender'] = $this->error['gender'];
		} else{
			$data['error_gender'] = '';
		}
		
		if(isset($this->error['date_of_birth'])) {
		 	$data['error_date_of_birth'] = $this->error['date_of_birth'];
		} else {
			$data['error_date_of_birth'] = '';
		}
		
		if(isset($this->error['address'])) {
		 	$data['error_address'] = $this->error['address'];
		} else {
			$data['error_address'] = '';
		}
		
		if(isset($this->error['country_id'])) {
		 	$data['error_country'] = $this->error['country_id'];
		} else {
			$data['error_country'] = '';
		}
		
		if(isset($this->error['city'])) {
		 	$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}
		
		if(isset($this->error['pincode'])) {
		 	$data['error_pincode'] = $this->error['pincode'];
		} else {
			$data['error_pincode'] = '';
		}
		
		if(isset($this->error['mobile_phone'])) {
		 	$data['error_mobile_phone'] = $this->error['mobile_phone'];
		} else {
			$data['error_mobile_phone'] = '';
		}
		
		if(isset($this->error['home_phone'])) {
		 	$data['error_home_phone'] = $this->error['home_phone'];
		} else {
			$data['error_home_phone'] = '';
		}

		$url = '';
       
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('text_home'),
		'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
		'text' => $this->language->get('heading_title'),
		'href' => $this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['employ_id'])) {
			$data['action'] = $this->url->link('job/employ/add', 'token=' . $this->session->data['token'] . $url, true);
        }else {
			$data['action'] = $this->url->link('job/employ/edit', 'token=' . $this->session->data['token'] . '&employ_id=' . $this->request->get['employ_id'] . $url, true);
		}
		$data['cancel'] = $this->url->link('job/employ', 'token=' . $this->session->data['token'] . $url, true);
			/////edit qouery /////

		if (isset($this->request->get['employ_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$employ_info = $this->model_job_employ->getEmploy($this->request->get['employ_id']);
		}
		$data['token'] = $this->session->data['token'];
			//////// edit form /////////
		 	if(isset($this->request->post['interest'])){
			 	$data['interest']=$this->request->post['interest'];
			} else if(isset($employ_info['interest'])){
		  	 	$data['interest']=$employ_info['interest'];
			} else {
			 	$data['interest']='';
			}
	 
	 		if(isset($this->request->post['career'])){
			 	$data['career']=$this->request->post['career'];
			} else if(isset($employ_info['career'])){
		  	 	$data['career']=$employ_info['career'];
			} else {
			 	$data['career']='';
			}

			if(isset($this->request->post['status'])){
			 	$data['status']=$this->request->post['status'];
			} else if(isset($employ_info['status'])){
		  	 	$data['status']=$employ_info['status'];
			} else {
			 	$data['status']='';
			}
	 
	 		if(isset($this->request->post['achievement'])){
			 	$data['achievement']=$this->request->post['achievement'];
			} else if(isset($employ_info['achievement'])){
		  	 	$data['achievement']=$employ_info['achievement'];
			} else {
			 	$data['achievement']='';
			}
	 
	 		if(isset($this->request->post['experience'])){
			 	$data['experience']=$this->request->post['experience'];
			} else if(isset($employ_info['experience'])){
		  	 	$data['experience']=$employ_info['experience'];
			} else {
			 	$data['experience']='';
			}
	 
	 		if(isset($this->request->post['profissional'])){
			 	$data['profissional']=$this->request->post['profissional'];
			} else if(isset($employ_info['profissional'])){
		  	 	$data['profissional']=$employ_info['profissional'];
			} else {
			 	$data['profissional']='';
			}
	 
	 		if(isset($this->request->post['fullname'])){
			 	$data['fullname']=$this->request->post['fullname'];
			} else if(isset($employ_info['fullname'])){
		  	 	$data['fullname']=$employ_info['fullname'];
			} else {
			 	$data['fullname']='';
			}
		
			if(isset($this->request->post['email'])){
			 	$data['email']=$this->request->post['email'];
			} else if(isset($employ_info['email'])){
			 	$data['email']=$employ_info['email'];
			} else {
			 	$data['email']='';
			}
			
			if(isset($this->request->post['date_of_birth'])){
			 	$data['date_of_birth']=$this->request->post['date_of_birth'];
			} else if(isset($employ_info['date_of_birth'])){
			 	$data['date_of_birth']=$employ_info['date_of_birth'];
			} else {
			 	$data['date_of_birth']='';
			}

			if (isset($this->request->post['filename'])) {
				$data['filename'] = $this->request->post['filename'];
			} elseif (!empty($employ_info)) {
				$data['filename'] = $employ_info['resumelist'];
			} else {
				$data['filename'] = '';
			}

			//print_r($data['filename']);die();
			
			if(isset($this->request->post['address'])){
			 	$data['address']=$this->request->post['address'];
			} elseif(isset($employ_info['address'])){
			 	$data['address']=$employ_info['address'];
			} else {
			 	$data['address']='';
			}

			if(isset($this->request->post['jobtype_id'])){
			 	$data['jobtype_id']=$this->request->post['jobtype_id'];
			} elseif(isset($employ_info['jobtype_id'])){
			 	$data['jobtype_id']=$employ_info['jobtype_id'];
			} else {
			 	$data['jobtype_id']='';
			}

			if(isset($this->request->post['about_self'])){
			 	$data['about_self']=$this->request->post['about_self'];
			} elseif(isset($employ_info['about_self'])){
			 	$data['about_self']=$employ_info['about_self'];
			} else {
			 	$data['about_self']='';
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
			
			if(isset($this->request->post['city'])){
			 	$data['city']=$this->request->post['city'];
			} elseif(isset($employ_info['city'])){
			 	$data['city']=$employ_info['city'];
			} else {
			 	$data['city']='';
			}
			
			if(isset($this->request->post['pincode'])){
			 	$data['pincode']=$this->request->post['pincode'];
			} elseif(isset($employ_info['pincode'])){
			 	$data['pincode']=$employ_info['pincode'];
			} else {
		  		$data['pincode']='';
			}
			
			if(isset($this->request->post['mobile_phone'])){
		  		$data['mobile_phone']=$this->request->post['mobile_phone'];
			} elseif(isset($employ_info['mobile_phone'])){
		  		$data['mobile_phone']=$employ_info['mobile_phone'];
			} else {
		  		$data['mobile_phone']='';
			}
			
			if(isset($this->request->post['home_phone'])){
				$data['home_phone']=$this->request->post['home_phone'];
			} elseif(isset($employ_info['home_phone'])){
				$data['home_phone']=$employ_info['home_phone'];
			} else {
				$data['home_phone']='';
			}
			
			if(isset($this->request->post['gender'])){
				$data['gender']=$this->request->post['gender'];
			} else if(isset($employ_info['gender'])){
				$data['gender']=$employ_info['gender'];
			} else {
				$data['gender']='';
			}
		
			if(isset($this->request->post['country_id'])){
				$data['country_id']=$this->request->post['country_id'];
			} else if(isset($employ_info['country_id'])){
				$data['country_id']=$employ_info['country_id'];
			} else {
				$data['country_id']='';
			}
			
			if(isset($this->request->post['stock_status_id'])){
				$data['stock_status_id']=$this->request->post['stock_status_id'];
			} else if(isset($employ_info['stock_status_id'])){
				$data['stock_status_id']=$employ_info['stock_status_id'];
			} else {
				$data['stock_status_id']='';
			}
			
			if(isset($this->request->post['password'])){
				$data['password']=$this->request->post['password'];
			} elseif(isset($employ_info['password'])){
				$data['password']=$employ_info['password'];
			} else {
				$data['password']='';
			}
			
			if(isset($this->request->post['zone_id'])){
				$data['zone_id']=$this->request->post['zone_id'];
			} else if(isset($employ_info['zone_id'])){
				$data['zone_id']=$employ_info['zone_id'];
			} else {
				$data['zone_id']='';
			}
	 
	 		if(isset($this->request->post['image'])){
				$data['image']=$this->request->post['image'];
			} else if(isset($employ_info['image'])){
				$data['image']=$employ_info['image'];
			} else {
				$data['image']='';
			}
	 		
	 		$this->load->model('tool/image');
			if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
				$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
			} elseif (!empty($employ_info) && is_file(DIR_IMAGE . $employ_info['image'])) {
				$data['thumb'] = $this->model_tool_image->resize($employ_info['image'], 100, 100);
			} else {
				$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			}
			$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
	 		
	 		$data['education_rowss'] = array();
			if (isset($this->request->post['education_row'])) {
				$education_rowss = $this->request->post['educationrow'];
			} elseif (isset($this->request->get['employ_id'])) {
				$education_rowss = $this->model_job_employ->getEducations($this->request->get['employ_id']);
				//print_r($education_rowss);die();
			} else {
				$education_rowss = array();
			}
		
			$data['education_rowss'] = array();
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
//skill multi fields (plus plus) start 21-09-2018 @vikas pal//	
			$data['skill_rowss'] = array();
			if (isset($this->request->post['skill_row'])) {
				$skill_rowss = $this->request->post['skillrow'];
			} elseif (isset($this->request->get['employ_id'])) {
				$skill_rowss = $this->model_job_employ->getSkills($this->request->get['employ_id']);
			} else {
				$skill_rowss = array();
			}
		
			$data['skill_rowss'] = array();
			foreach ($skill_rowss as $key => $value) {
			  foreach ($value as $skillrow) {
					 $data['skill_rowss'][$key][] = array(
					 'name'       => $skillrow['name'],
					 'start_date'    => $skillrow['start_date'],
					 'end_date'   => $skillrow['end_date']
					 );
				}
			}
//skill multi fields (plus plus) end 21-09-2018 @vikas pal//	
			
			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}
	 		
			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}
	 		
			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}
    
			$data['header'] = $this->load->controller('common/header');
			$data['column_left'] = $this->load->controller('common/column_left');
			$data['footer'] = $this->load->controller('common/footer');
		  	$this->response->setOutput($this->load->view('job/employ', $data));
	}
	
//cv file upload function start 21-09-2018 @vikas pal//	
	public function upload() {
		$this->load->language('job/employ');

		$json = array();

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));
            
				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
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
		}

		if (!$json) {
			$targetDir = DIR_IMAGE.'pdf/';
			$file = $filename . '.' . token(32);
			$location = $targetDir.$file;
			$location1 = 'pdf/'.$file;
			move_uploaded_file($this->request->files['file']['tmp_name'],$location);
			$json['filename'] = $file;
			$json['mask'] = $location1;
			$json['success'] = $this->language->get('text_upload');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
//cv file upload function end 21-09-2018 @vikas pal//	

	protected function validateForm() {
		
		if (!$this->user->hasPermission('modify','job/employ')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['experience'])< 3)||(utf8_strlen($this->request->post['experience']) > 255)) {
			$this->error['experience']= $this->language->get('error_experience');
		}
		
		if ((utf8_strlen($this->request->post['profissional'])< 3)||(utf8_strlen($this->request->post['profissional']) > 255)) {
			$this->error['profissional']= $this->language->get('error_profissional');
		}
		
		if ((utf8_strlen($this->request->post['fullname'])< 3)||(utf8_strlen($this->request->post['fullname']) > 255)) {
			$this->error['fullname']= $this->language->get('error_fullname');
		}
		
		$email_info = $this->model_job_employ->getEmployByEmail($this->request->post['email']);

		if (!isset($this->request->get['employ_id'])) {
			if ($email_info) {
				$this->error['warning'] = $this->language->get('error_email_match');
			}
		} else {
			if ($email_info && ($this->request->get['employ_id'] != $email_info['employ_id'])) {
				$this->error['warning'] = $this->language->get('error_email_match');
			}
		}

		if ((utf8_strlen($this->request->post['email']) > 96) || !filter_var($this->request->post['email'], FILTER_VALIDATE_EMAIL)) {
			$this->error['email'] = $this->language->get('error_email');
		}		

		if ((utf8_strlen($this->request->post['password']) < 4) || (utf8_strlen($this->request->post['password']) > 20)) {
			$this->error['password'] = $this->language->get('error_password');
		}

		if ($this->request->post['confirm_password'] != $this->request->post['password']) {
			$this->error['confirm_password'] = $this->language->get('error_confirm_password');
		}

		if ((utf8_strlen($this->request->post['date_of_birth'])< 3)||(utf8_strlen($this->request->post['date_of_birth']) > 255)) {
			 $this->error['date_of_birth']= $this->language->get('error_date_of_birth');
		}
		
		if ((utf8_strlen($this->request->post['address'])< 3)||(utf8_strlen($this->request->post['address']) > 255)) {
		 	$this->error['address']= $this->language->get('error_address');
		}
		
		if ((utf8_strlen($this->request->post['city'])< 3)||(utf8_strlen($this->request->post['city']) > 255)) {
	    	$this->error['city']= $this->language->get('error_city');
		}
		
		if ((utf8_strlen($this->request->post['pincode'])< 3)||(utf8_strlen($this->request->post['pincode']) > 255)) {
	    	$this->error['pincode']= $this->language->get('error_pincode');
		}
		
		if ((utf8_strlen($this->request->post['mobile_phone'])< 3)||(utf8_strlen($this->request->post['mobile_phone']) > 255)) {
	    	$this->error['mobile_phone']= $this->language->get('error_mobile_phone');
		}
		
		if ((utf8_strlen($this->request->post['home_phone'])< 3)||(utf8_strlen($this->request->post['home_phone']) > 255)) {
	    	$this->error['home_phone']= $this->language->get('error_home_phone');
		}	
		return !$this->error;
	}
	
	protected function validateApprove(){
		if (!$this->user->hasPermission('modify', 'job/employ')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	    return !$this->error;
	}
        	
 	protected function validateDelete() {
	  if (!$this->user->hasPermission('modify', 'job/employ')) {
	  	$this->error['warning'] = $this->language->get('error_permission');
	  }
	  	return !$this->error;
 	}
	
 	public function autocomplete() {
			
    $this->load->model('job/employ');
		
	  if (isset($this->request->get['filter_name'])) {
			
		if (isset($this->request->get['sort'])) {
		 $sort = $this->request->get['sort'];
		} else {
			$sort = 'name';
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
			
		$filter_data = array(
		'filter_name'=> $this->request->get['filter_name'],
		'order' => $order,
		'start' => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit' => $this->config->get('config_limit_admin')
		);
		
		$results=$this->model_job_employ->getEmploys($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'employ_id' => $result['employ_id'],
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

	public function autocompletecategory() {
		$json = array();
		if (isset($this->request->get['filter_name'])) {
			$this->load->model('catalog/category');
		
			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);
			$results = $this->model_catalog_category->getJobCategories($filter_data);
			
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
?>