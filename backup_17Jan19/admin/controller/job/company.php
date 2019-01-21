<?php 
class ControllerJobCompany extends Controller{
	private $error = array();
	public function index(){
		$this->load->language('job/company');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/company');
		
		$this->getList();
	}
	public function add(){
		$this->load->language('job/company');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/company');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validatecompany()) {

			$this->model_job_company->addCompany($this->request->post);

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
			$this->response->redirect($this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getcompany();
	}
	public function edit(){
		$this->load->language('job/company');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/company');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validatecompany()) {
			$this->model_job_company->editCompany($this->request->get['company_id'],$this->request->post);
		
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
			$this->response->redirect($this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getcompany();  
	}
	public function approve(){
		$this->load->language('job/company');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/company');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['company_id'])){
			$approves[] = $this->request->get['company_id'];
		}
		if ($approves && $this->validateApprove()){
			foreach($approves as $company_id){
				$this->model_job_company->approve($company_id);
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
			$this->response->redirect($this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
		 
	}

	public function disapprove(){
		$this->load->language('job/company');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/company');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['company_id'])){
			$approves[] = $this->request->get['company_id'];
		}
		if ($approves){
			foreach($approves as $company_id){
				$this->model_job_company->disApprove($company_id);
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
			$this->response->redirect($this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList(); 

	 }
 
	public function getList(){
		if (isset($this->request->get['filter_full_name'])) {
		 	$filter_full_name = $this->request->get['filter_full_name'];
		} else {
		 	$filter_full_name = '';
		}
				
		if (isset($this->request->get['filter_email'])) {
			$filter_email = $this->request->get['filter_email'];
		} else {
			$filter_email = '';
		}		
		

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

		$url = '';

		if (isset($this->request->get['filter_full_name'])) {
			$url .= '&filter_full_name=' . $this->request->get['filter_full_name'];
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
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


		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('job/company/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/company/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['company'] = array();

		$filter_data = array(
			'filter_full_name'    => $filter_full_name,
			'filter_email' 		  => $filter_email,	
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		
		$company_total = $this->model_job_company->getTotalCompanys($filter_data);

		//print_r($company_total);die();

		$this->load->model('localisation/country');
		$this->load->model('localisation/zone');
		$results=$this->model_job_company->getCompanys($filter_data);	
			foreach($results as $result)
			{
				if (!$result['approved']) {
					$approve = $this->url->link('job/company/approve', 'token=' . $this->session->data['token'] . '&company_id=' . $result['company_id'] . $url, true);
				} else {
			  		$approve = '';
				}

				if ($result['approved']) {
					$disapproved = $this->url->link('job/company/disapprove', 'token=' . $this->session->data['token'] . '&company_id=' . $result['company_id'] . $url, true);
				} else {
					$disapproved = '';
				}

				$country_info=$this->model_localisation_country->getCountry($result['country_id']);
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

				$this->load->model('catalog/category');
				$category_info= $this->model_catalog_category->getJobCategory($result['category_id']);
               
                if(isset($category_info['name'])){
					$company_name=$category_info['name'];         
				} else {
					$company_name='';
				}

				$data['company'][]=array(
				'company_id'      =>$result['company_id'],
				'full_name'       =>$result['full_name'],
				'company_name'    =>$company_name,
				'email'           =>$result['email'],
				'country'         =>$country,
				'approve'         =>$approve,
				'disapproved'	  => $disapproved,
				'zone'            =>$zone,
				'company_website' =>$result['company_website'],
				'edit'            => $this->url->link('job/company/edit', 'token=' . $this->session->data['token'] . '&company_id=' .$result['company_id'] . $url, true));
				
			}	
	

		$data['heading_title']  		 = $this->language->get('heading_title');
		$data['text_select']             = $this->language->get('text_select');
		$data['text_form']      		 = $this->language->get('text_form');
		$data['text_list']      		 = $this->language->get('text_list');
		$data['text_none'] 				 = $this->language->get('text_none');
		$data['text_enable']             = $this->language->get('Enable');
		$data['text_disable']            = $this->language->get('Disable');
		$data['text_no_results'] 		 = $this->language->get('text_no_results');
		$data['text_confirm']  			 = $this->language->get('text_confirm');

		$data['filterlb_fullname'] 	     = $this->language->get('filterlb_fullname');
		$data['filterlb_email'] 	     = $this->language->get('filterlb_email');

		$data['column_full_name'] 	     = $this->language->get('column_full_name');
		$data['column_company_name']     = $this->language->get('column_company_name');
		$data['column_country']        	 = $this->language->get('column_country');
		$data['column_zone'] 	         = $this->language->get('column_zone');
		$data['column_email']    	   	 = $this->language->get('column_email');
		$data['column_action']  		 = $this->language->get('column_action');
		$data['column_approve']  		 = $this->language->get('column_approve');

		$data['button_add']              = $this->language->get('button_add');
		$data['button_cancle']           = $this->language->get('button_cancle');
		$data['button_delete']           = $this->language->get('button_delete');
		$data['button_edit']             = $this->language->get('button_edit');
		$data['button_view']             = $this->language->get('button_view');
		$data['button_approve']          = $this->language->get('button_approve');
		$data['button_filter'] 			 = $this->language->get('button_filter');
		$data['button_desapprove'] 		 = $this->language->get('button_desapprove');

		$data['token']         			 = $this->session->data['token'];

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}


		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		unset($this->session->data['success']);
		} else {
			$data['success'] = '';  
		}
       
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true)
		);

       	$url='';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		if (isset($this->request->get['filter_full_name'])) {
			$url .= '&filter_full_name=' . $this->request->get['filter_full_name'];
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}


		$data['sort_full_name']    	= $this->url->link('job/company', 'token=' . $this->session->data['token'] . '&sort=full_name' . $url, true);
		$data['sort_company_name']  = $this->url->link('job/company', 'token=' . $this->session->data['token'] . '&sort=company_name' . $url, true);
		$data['sort_country'] 		= $this->url->link('job/company', 'token=' . $this->session->data['token'] . '&sort=country' . $url, true);
		$data['sort_email']  		= $this->url->link('job/company', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
		$data['sort_zone'] 			= $this->url->link('job/company', 'token=' . $this->session->data['token'] . '&sort=zone' . $url, true);
         
        $url='';

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		
		if (isset($this->request->get['filter_full_name'])) {
			$url .= '&filter_full_name=' . $this->request->get['filter_full_name'];
		}

		if (isset($this->request->get['filter_email'])) {
			$url .= '&filter_email=' . $this->request->get['filter_email'];
		}

		$pagination = new Pagination();
		$pagination->total = $company_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/company', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($company_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($company_total - $this->config->get('config_limit_admin'))) ? $company_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $company_total, ceil($company_total / $this->config->get('config_limit_admin')));


		$data['sort'] 	= $sort;
		$data['order'] 	= $order;
		$data['filter_full_name']    = $filter_full_name;
		$data['filter_email'] 		 = $filter_email;
				
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/company_list', $data));
	}
	public function getcompany(){
		$data['heading_title']              = $this->language->get('heading_title');

		$data['text_loading']               = $this->language->get('text_loading');
		$data['text_select']                = $this->language->get('text_select');
		$data['text_form']                  = $this->language->get('text_form');
		$data['text_none']                  = $this->language->get('text_none');
		$data['text_list']                  = $this->language->get('text_list');
		$data['text_default']               = $this->language->get('text_default');
		$data['text_map']         			= $this->language->get('text_map');

		$data['lable_full_name']            = $this->language->get('lable_full_name');
		$data['lable_company_name']         = $this->language->get('lable_company_name');
		$data['lable_email']                = $this->language->get('lable_email');
		$data['lable_password']    		    = $this->language->get('lable_password');
		$data['lable_confirm_password']     = $this->language->get('lable_confirm_password');
		$data['lable_landline_phone']       = $this->language->get('lable_landline_phone');
		$data['lable_cell_phone']           = $this->language->get('lable_cell_phone');
		$data['lable_address']              = $this->language->get('lable_address');
		$data['lable_country']              = $this->language->get('lable_country');
		$data['lable_state']                = $this->language->get('lable_state');
		$data['lable_city']                 = $this->language->get('lable_city');
		$data['lable_pincode']              = $this->language->get('lable_pincode');
		$data['lable_longitude']         	= $this->language->get('lable_longitude');
		$data['lable_latitude']         	= $this->language->get('lable_latitude');
		$data['lable_officeopen']         	= $this->language->get('lable_officeopen');
		$data['lable_officeclose']         	= $this->language->get('lable_officeclose');
		$data['lable_company_website']      = $this->language->get('lable_company_website');
		$data['lable_no_of_employees']      = $this->language->get('lable_no_of_employees');
		$data['lable_company_descri']       = $this->language->get('lable_company_descri');
		$data['lable_company_image']        = $this->language->get('lable_company_image');
				
		$data['entry_full_name']            = $this->language->get('entry_full_name');
		$data['entry_company_name']         = $this->language->get('entry_company_name');
		$data['entry_email']                = $this->language->get('entry_email');
		$data['entry_password']    		    = $this->language->get('entry_password');
		$data['entry_confirm_password']     = $this->language->get('entry_confirm_password');
		$data['entry_landline_phone']       = $this->language->get('entry_landline_phone');
		$data['entry_cell_phone']           = $this->language->get('entry_cell_phone');
		$data['entry_address']              = $this->language->get('entry_address');
		$data['entry_country']              = $this->language->get('entry_country');
		$data['entry_state']                = $this->language->get('entry_state');
		$data['entry_city']                 = $this->language->get('entry_city');
		$data['entry_pincode']              = $this->language->get('entry_pincode');
		$data['entry_longitude']         	= $this->language->get('entry_longitude');
		$data['entry_latitude']         	= $this->language->get('entry_latitude');
		$data['entry_officeopen']         	= $this->language->get('entry_officeopen');
		$data['entry_officeclose']         	= $this->language->get('entry_officeclose');
		$data['entry_company_website']      = $this->language->get('entry_company_website');
		$data['entry_no_of_employees']      = $this->language->get('entry_no_of_employees');
		$data['entry_company_descri']       = $this->language->get('entry_company_descri');
		$data['entry_company_image']        = $this->language->get('entry_company_image');
		
		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
	
		$data['button_save']                = $this->language->get('button_save');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_cancel']              = $this->language->get('button_cancel');
		$data['button_upload']              = $this->language->get('button_upload');
		$data['token']         			    = $this->session->data['token'];

		$data['breadcrumbs'] = array();
		
		$url = '';

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else {
			$data['success'] = ''; 
		}

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['company_id'])) {
			$data['action'] = $this->url->link('job/company/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/company/edit', 'token=' . $this->session->data['token'] . '&company_id=' . $this->request->get['company_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['company_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$company_info = $this->model_job_company->getCompany($this->request->get['company_id']);	
		}
		          ///  language  ///
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
	
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries($data);
				
		$this->load->model('localisation/zone');
		$data['zone'] = $this->model_localisation_zone->getZones($data);
	
		$this->load->model('job/industry');
		$data['industry'] = $this->model_job_industry->getIndustry($data);
		
		$this->load->model('job/orgtype');
		$data['orgtype'] = $this->model_job_orgtype->getOrgtypes($data);
		
		$this->load->model('tool/image');
		$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);
		
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}		 
		/// validate 
		if (isset($this->error['variation_desriptions'])) {
			$data['error_variation_desriptions'] = $this->error['variation_desriptions'];
		} else {
		 	$data['error_variation_desriptions'] = '';  
		}
		
		if (isset($this->error['full_name'])) {
		 	$data['error_full_name'] = $this->error['full_name'];
		} else {
		 	$data['error_full_name'] = '';
		}
			
		if (isset($this->error['email'])) {
		 	$data['error_email'] = $this->error['email'];
		} else {
		 	$data['error_email'] = '';
		}
		
		if (isset($this->error['password'])) {
		 	$data['error_password'] = $this->error['password'];
		} else {
		 	$data['error_password'] = '';
		}
		
		if (isset($this->error['confirm_password'])) {
		 	$data['error_confirm_password'] = $this->error['confirm_password'];
		} else {
		 	$data['error_confirm_password'] = '';
		}
		
		if (isset($this->error['industry'])) {
			$data['error_industry'] = $this->error['industry'];
		} else {
			$data['error_industry'] = '';
		}
		
		if (isset($this->error['org_type'])) {
		 	$data['error_org_type'] = $this->error['org_type'];
		} else {
		 	$data['error_org_type'] = '';
		}
		
		if (isset($this->error['landline_phone'])) {
		 	$data['error_landline_phone'] = $this->error['landline_phone'];
		} else {
		 	$data['error_landline_phone'] = '';
		}

		if (isset($this->error['cell_phone'])) {
		 	$data['error_cell_phone'] = $this->error['cell_phone'];
		} else {
		 	$data['error_cell_phone'] = '';
		}
		
		if (isset($this->error['address'])) {
		 	$data['error_address'] = $this->error['address'];
		} else {
		 	$data['error_address'] = '';
		}

		if (isset($this->error['country'])) {
		 	$data['error_country'] = $this->error['country'];
		} else {
		 	$data['error_country'] = '';
		}
		
		if (isset($this->error['city'])) {
		 	$data['error_city'] = $this->error['city'];
		} else {
		 	$data['error_city'] = '';
		}
		
		if (isset($this->error['pincode'])) {
		 	$data['error_pincode'] = $this->error['pincode'];
		} else {
		 	$data['error_pincode'] = '';
		}
		
		if(isset($this->error['company_website'])) {
		 	$data['error_company_website'] = $this->error['company_website'];
		} else {
		 	$data['error_company_website'] = '';
		}
		
		if(isset($this->error['no_of_employees'])) {
		 	$data['error_no_of_employees'] = $this->error['no_of_employees'];
		} else {
		 	$data['error_no_of_employees'] = '';
		}
		
		if(isset($this->error['company_description'])) {
			$data['error_company_description'] = $this->error['company_description'];
		} else {
			$data['error_company_description'] = '';
		}
		
		if (isset($this->error['company_logo'])) {
			$data['error_company_logo'] = $this->error['company_logo'];
		} else {
			$data['error_company_logo'] = '';
		}
		
		$data['token'] = $this->session->data['token'];
				
		if (isset($this->request->get['company_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')){
			$company_info = $this->model_job_company->getCompany($this->request->get['company_id']);
		}
		
		if (isset($this->request->post['full_name'])) {
			$data['full_name'] = $this->request->post['full_name'];
		} elseif (isset($company_info['full_name'])) {
			$data['full_name'] = $company_info['full_name'];
		} else {
			$data['full_name'] = '';
		}
		
		if (isset($this->request->post['company_name'])) {
			$data['company_name'] = $this->request->post['company_name'];
		} elseif (isset($company_info['company_name'])) {
			$data['company_name'] = $company_info['company_name'];
		} else {
			$data['company_name'] = '';
		}
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		} elseif (isset($company_info['email'])) {
			$data['email'] = $company_info['email'];
		} else {
			$data['email'] = '';
		}

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (isset($company_info['category_id'])) {
			$data['category_id'] = $company_info['category_id'];
		} else {
			$data['category_id'] = '';
		}

		$this->load->model('catalog/category');

		if(!empty($data['category_id'])) {
			$cat_name = $this->model_catalog_category->getJobCategory($data['category_id']);
			$data['cat_name'] = $cat_name['name'];
		} else {
			$data['cat_name'] = '';
		}

		if (isset($this->request->post['officeclose'])) {
			$data['officeclose'] = $this->request->post['officeclose'];
		} elseif (isset($company_info['officeclose'])) {
			$data['officeclose'] = $company_info['officeclose'];
		} else {
			$data['officeclose'] = '';
		}

		if (isset($this->request->post['officeopen'])) {
			$data['officeopen'] = $this->request->post['officeopen'];
		} elseif (isset($company_info['officeopen'])) {
			$data['officeopen'] = $company_info['officeopen'];
		} else {
			$data['officeopen'] = '';
		}

        if (isset($this->request->post['longitude'])) {
			$data['longitude'] = $this->request->post['longitude'];
		} elseif (isset($company_info['longitude'])) {
			$data['longitude'] = $company_info['longitude'];
		} else {
			$data['longitude'] = '';
		}

		if (isset($this->request->post['latitude'])) {
			$data['latitude'] = $this->request->post['latitude'];
		} elseif (isset($company_info['latitude'])) {
			$data['latitude'] = $company_info['latitude'];
		} else {
			$data['latitude'] = '';
		}
		
		if (isset($this->request->post['password'])) {
			$data['password'] = $this->request->post['password'];
		} elseif (!empty($company_info)) {
			$data['password'] = $company_info['password'];
		} else {
			$data['password'] = '';
		}
		
		if (isset($this->request->post['confirm_password'])) {
			$data['confirm_password'] = $this->request->post['confirm_password'];
		} elseif (isset($company_info['confirm_password'])) {
			$data['confirm_password'] = $company_info['confirm_password'];
		} else {
			$data['confirm_password'] = '';
		}
		
		if (isset($this->request->post['landline_phone'])) {
			$data['landline_phone'] = $this->request->post['landline_phone'];
		} elseif (isset($company_info['landline_phone'])) {
			$data['landline_phone'] = $company_info['landline_phone'];
		} else {
			$data['landline_phone'] = '';
		}
		
		if (isset($this->request->post['cell_phone'])) {
			$data['cell_phone'] = $this->request->post['cell_phone'];
		} elseif (isset($company_info['cell_phone'])) {
			$data['cell_phone'] = $company_info['cell_phone'];
		} else {
			$data['cell_phone'] = '';
		}
		
		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		} elseif (isset($company_info['address'])) {
			$data['address'] = $company_info['address'];
		} else {
			$data['address'] = '';
		}

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} elseif (isset($company_info['city'])) {
			$data['city'] = $company_info['city'];
		} else {
			$data['city'] = '';
		}
		
		if (isset($this->request->post['pincode'])) {
			$data['pincode'] = $this->request->post['pincode'];
		} elseif (isset($company_info['pincode'])) {
			$data['pincode'] = $company_info['pincode'];
		} else {
			$data['pincode'] = '';
		}

		if (isset($this->request->post['company_website'])) {
			$data['company_website'] = $this->request->post['company_website'];
		} elseif (isset($company_info['company_website'])) {
			$data['company_website'] = $company_info['company_website'];
		} else {
			$data['company_website'] = '';
		}
		
		if (isset($this->request->post['company_description'])) {
			$data['company_description'] = $this->request->post['company_description'];
		} elseif (isset($company_info['company_description'])) {
			$data['company_description'] = $company_info['company_description'];
		} else {
			$data['company_description'] = '';
		}

		if (isset($this->request->post['no_employees'])) {
			$data['no_employees'] = $this->request->post['no_employees'];
		} elseif (isset($company_info['no_employees'])) {
			$data['no_employees'] = $company_info['no_employees'];
		} else {
			$data['no_employees'] = '';
		}

		if (isset($this->request->post['company_logo'])) {
			$data['company_logo'] = $this->request->post['company_logo'];
		} elseif (isset($company_info['company_logo'])) {
			$data['company_logo'] = $company_info['company_logo'];
		} else {
			$data['company_logo'] = '';
		}
	 
	 	$this->load->model('tool/image');

		if (isset($this->request->post['company_logo']) && is_file(DIR_IMAGE . $this->request->post['company_logo'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['company_logo'], 100, 100);
		} elseif (!empty($company_info) && $company_info['company_logo'] && is_file(DIR_IMAGE . $company_info['company_logo'])) {
			$data['thumb'] = $this->model_tool_image->resize($company_info['company_logo'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if(isset($this->request->post['company_id'])){
			$data['company_id']=$this->request->post['company_id'];
		} else if(isset($company_info['company_id'])){
			$data['company_id']=$company_info['company_id'];
		} else {
			$data['company_id']='';
		}

		if(isset($this->request->post['country_id'])){
			$data['country_id']=$this->request->post['country_id'];
		} else if(isset($company_info['country_id'])){
			$data['country_id']=$company_info['country_id'];
		} else {
			$data['country_id']='';
		}
		
		if(isset($this->request->post['industry_id'])){
			$data['industry_id']=$this->request->post['industry_id'];
		}else if(isset($company_info['industry_id'])){
			$data['industry_id']=$company_info['industry_id'];
		} else {
			$data['industry_id']='';
		}
		
		if(isset($this->request->post['orgtype_id'])){
			$data['orgtype_id']=$this->request->post['orgtype_id'];
		} else if(isset($company_info['orgtype_id'])){
			$data['orgtype_id']=$company_info['orgtype_id'];
		} else {
			$data['orgtype_id']='';
		}
		
		if(isset($this->request->post['zone_id'])){
			$data['zone_id']=$this->request->post['zone_id'];
		} else if(isset($company_info['zone_id'])){
			$data['zone_id']=$company_info['zone_id'];
		} else {
			$data['zone_id']='';
		}

		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/company', $data));  
	} 
	public function validatecompany(){
		if (!$this->user->hasPermission('modify','job/company')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('job/company');

		if ((utf8_strlen($this->request->post['full_name'])< 3)||(utf8_strlen($this->request->post['full_name']) > 255)) {
			$this->error['full_name']= $this->language->get('error_full_name');
		}

		$email_info = $this->model_job_company->getCompanyByEmail($this->request->post['email']);

		if (!isset($this->request->get['company_id'])) {
			if ($email_info) {
				$this->error['warning'] = $this->language->get('error_email_match');
			}
		} else {
			if ($email_info && ($this->request->get['company_id'] != $email_info['company_id'])) {
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
			$this->error['confirm_password'] = $this->language->get('error_confirm');
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

		if ((utf8_strlen($this->request->post['cell_phone'])< 3)||(utf8_strlen($this->request->post['cell_phone']) > 255)) {
			$this->error['cell_phone']= $this->language->get('error_cell_phone');
		}

		if ((utf8_strlen($this->request->post['landline_phone'])< 3)||(utf8_strlen($this->request->post['landline_phone']) > 255)) {
			$this->error['landline_phone']= $this->language->get('error_landline_phone');
		}

		if ((utf8_strlen($this->request->post['company_website'])< 3)||(utf8_strlen($this->request->post['company_website']) > 255)) {
			$this->error['company_website']= $this->language->get('error_company_website');
		}

		
		return !$this->error;
	}	
	protected function validateDelete(){
		if (!$this->user->hasPermission('modify', 'job/company')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	public function delete() {
		$this->load->language('job/company');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/company');
		
		//change delete//
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $company_id) {
				$this->model_job_company->deleteComapny($company_id);
			}
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

			$this->response->redirect($this->url->link('job/company', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	}
	protected function validateApprove(){
		if (!$this->user->hasPermission('modify', 'job/company')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	    return !$this->error;
	}
		
	public function autocomplete(){
		
		if (isset($this->request->get['filter_full_name'])) {
			$filter_full_name = $this->request->get['filter_full_name'];
		} else {
			$filter_full_name = false;
		}
		
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
		$this->load->model('job/company');
			
		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'filter_full_name' => $filter_full_name,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
		$results=$this->model_job_company->getCompanys($filter_data);

		foreach ($results as $result) {
			$json[] = array(
				'company_id'  => $result['company_id'],
				'full_name'   => strip_tags(html_entity_decode($result['full_name'], ENT_QUOTES, 'UTF-8'))
			);
		}
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['full_name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function getcompaney(){
		$json[]=array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->load->model('localisation/country');
			$country='';
			if(isset($this->request->post['country_id'])){
				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
				$country=$country_info['name'];
			}
			$this->load->model('localisation/zone');
			$zone='';
			if(isset($this->request->post['zone_id'])){
				$zone_info = $this->model_localisation_zone->getZone($this->request->post['zone_id']);
				$zone=$country_info['name'];
			}
			
			$city='';
			if(isset($this->request->post['city']))
			{
			$city=$this->request->post['city'];
			}

			$pincode='';
			  if(isset($this->request->post['pincode']))
			{
			  $pincode=$this->request->post['pincode'];
			}

		   $address=$pincode.''.$city .''. $zone .' '. $country;
			 $address = str_replace(" ", "+", $address);
			 $url = "http://maps.google.com/maps/api/geocode/json?sensor=false&address=$address";
			 $response = file_get_contents($url);
			 $json1 = json_decode($response,TRUE); //generate array object from the response from the web
			if(isset($json1['results'][0]['geometry']['location']['lat'])){
				$json['lat']=$json1['results'][0]['geometry']['location']['lat'];
				$json['lng']=$json1['results'][0]['geometry']['location']['lng'];
				$json['success']='Address Not Found';
			}else{
				$json['error']='Address Not Found';
			}
		}	
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	
	}

	public function country() {

		$json = array();



		$this->load->model('localisation/country');



		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);



		if ($country_info) {

			$this->load->model('localisation/zone');



			$json = array(

				'country_id'        => $country_info['country_id'],

				'name'              => $country_info['name'],

				'iso_code_2'        => $country_info['iso_code_2'],

				'iso_code_3'        => $country_info['iso_code_3'],

				'address_format'    => $country_info['address_format'],

				'postcode_required' => $country_info['postcode_required'],

				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),

				'status'            => $country_info['status']

			);

		}



		$this->response->addHeader('Content-Type: application/json');

		$this->response->setOutput(json_encode($json));

	}



}

?>