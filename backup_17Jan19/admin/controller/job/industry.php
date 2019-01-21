 <?php
class ControllerJobIndustry extends Controller{
	private $error = array();
	public function index(){
		$this->load->language('job/industry');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/industry');
		
		$this->getList();
	}
	public function add(){
		$this->load->language('job/industry');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/industry');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateindustry()) {

			$this->model_job_industry->addIndustry($this->request->post);

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
			$this->response->redirect($this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getindustry();
	}
	public function edit(){
		$this->load->language('job/industry');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/industry');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateindustry()) {

			$this->model_job_industry->editIndustry($this->request->get['industry_id'],$this->request->post);

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
            
			$this->response->redirect($this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getindustry();  
	}
	public function getList(){
				 
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pvd.industry_name';
		}
	 
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.status';
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
				
		$url = '';
		$data['industry']=array();
		$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
			
		'start' => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit' => $this->config->get('config_limit_admin')
		);
		$industry_total=$this->model_job_industry->getIndustrytotal($filter_data);
		$results=$this->model_job_industry->getIndustry($filter_data);

	 	///images
		$this->load->model('tool/image');
		$data['industry']=array();
		foreach($results as $result)
		{
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$data['industry'][]=array(
			'industry_id'  =>$result['industry_id'],
			'industry_name'=>$result['industry_name'],
			'seo_keyword'  =>$result['seo_keyword'],
			'image'        =>$image,
			'status'       => ($result['status'] ? $this->language->get('text_enable') : $this->language->get('text_disable')),
			'edit'=> $this->url->link('job/industry/edit', 'token=' . $this->session->data['token'] . '&industry_id=' .$result['industry_id'] . $url, true));
		}		
		$url = '';
        
		if ($order == 'ASC') {
		 	$url .= '&order=DESC';
		} else {
		 	$url .= '&order=ASC';
		}
        
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['sort_industry_name'] = $this->url->link('job/industry', 'token=' . $this->session->data['token'] . '&sort=pvd.industry_name' . $url, true);
		$data['sort_status']  		= $this->url->link('job/industry', 'token=' . $this->session->data['token'] . '&sort=p.statuts' . $url, true);
		$data['sort_seo_keyword']  	= $this->url->link('job/industry', 'token=' . $this->session->data['token'] . '&sort=pvd.seo_keyword' . $url, true);

		$data['heading_title']         = $this->language->get('heading_title');
		$data['text_form']             = $this->language->get('text_form');
		$data['text_select']           = $this->language->get('text_select');
		$data['text_list']             = $this->language->get('text_list');
		$data['text_no_results'] 	   = $this->language->get('text_no_results');
		$data['text_confirm'] 		   = $this->language->get('text_confirm');
		$data['text_enable']           = $this->language->get('Enable');
		$data['text_disable']          = $this->language->get('Disable');

		$data['column_image']  		   = $this->language->get('column_image');
		$data['column_industry_name']  = $this->language->get('column_industry_name');
		$data['column_seo_keyword']    = $this->language->get('column_seo_keyword');
		$data['column_status']         = $this->language->get('column_status');
		$data['column_action']  	   = $this->language->get('column_action');
		
		$data['button_add']            = $this->language->get('button_add');
		$data['button_cancle']         = $this->language->get('button_cancle');
		$data['button_delete']         = $this->language->get('button_delete');
		$data['button_edit']           = $this->language->get('button_edit');
		
		$data['button_filter']		   = $this->language->get('button_filter');
		$data['token']         		   = $this->session->data['token'];
        
       
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
        
		$data['breadcrumbs'] = array();

		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);
        
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true)
		);
		////////select for list///////
		$data['results'] = '';

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
		if (!isset($this->request->get['industry_id'])) {
			$data['action'] = $this->url->link('job/industry/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/industry/edit', 'token=' . $this->session->data['token'] . '&industry_id=' . $this->request->get['industry_id'] . $url, true);
		}
		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}
		//action button
		$data['add']    = $this->url->link('job/industry/add', '&token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/industry/delete', '&token=' . $this->session->data['token'] . $url, true);

		if (!isset($this->request->get['industry_id'])) {
			$data['action'] = $this->url->link('job/industry/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/industry/edit', 'token=' . $this->session->data['token'] . '&industry_id=' . $this->request->get['industry_id'] . $url, true);
		}
		$data['add']    = $this->url->link('job/industry/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/industry/delete', 'token=' . $this->session->data['token'] . $url, true);
		        
		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
        
		$pagination = new Pagination();
		$pagination->total = $industry_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($industry_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($industry_total - $this->config->get('config_limit_admin'))) ? $industry_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $industry_total, ceil($industry_total / $this->config->get('config_limit_admin')));
        
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/industry_list', $data));
	}
	public function getindustry(){
        
		$data['heading_title']          = $this->language->get('heading_title');
		$data['text_form']              = $this->language->get('text_form');
		$data['text_select']            = $this->language->get('text_select');
		$data['text_list']              = $this->language->get('text_list');
		$data['text_default']           = $this->language->get('text_default');
		$data['text_enable']            = $this->language->get('Enable');
		$data['text_disable']           = $this->language->get('Disable');

		$data['tab_general']            = $this->language->get('tab_general');
		$data['tab_data']               = $this->language->get('tab_data');

		$data['lable_industry_name']    = $this->language->get('lable_industry_name');
		$data['lable_description']      = $this->language->get('lable_description');
		$data['lable_meta_title']       = $this->language->get('lable_meta_title');
		$data['lable_meta_keyword']     = $this->language->get('lable_meta_keyword');
		$data['lable_meta_description'] = $this->language->get('lable_meta_description');
		$data['lable_seo_keyword']      = $this->language->get('lable_seo_keyword');
		$data['lable_status']           = $this->language->get('lable_status');
		$data['lable_image']            = $this->language->get('lable_image');

		$data['entry_industry_name']    = $this->language->get('entry_industry_name');
		$data['entry_description']      = $this->language->get('entry_description');
		$data['entry_meta_title']       = $this->language->get('entry_meta_title');
		$data['entry_meta_keyword']     = $this->language->get('entry_meta_keyword');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_seo_keyword']      = $this->language->get('entry_seo_keyword');
		$data['entry_status']           = $this->language->get('entry_status');
		$data['entry_image']            = $this->language->get('entry_image');
				
		$data['button_remove']          = $this->language->get('button_remove');
		$data['button_add']             = $this->language->get('button_add');
		$data['button_save']            = $this->language->get('button_save');
		$data['button_delete']          = $this->language->get('button_delete');
		$data['button_cancel']          = $this->language->get('button_cancel');

		$data['breadcrumbs'] = array();

		$url = '';

		$data['breadcrumbs'] = array();

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
		'href' => $this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true)
		);
		if (!isset($this->request->get['industry_id'])) {	
			$data['action'] = $this->url->link('job/industry/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/industry/edit', 'token=' . $this->session->data['token'] . '&industry_id=' . $this->request->get['industry_id'] . $url, true);
		}
        
		$data['cancel'] = $this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true);

		
		///language
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array) $this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}		

		///edit 

		if (isset($this->error['industry name'])) {
		 	$data['error_industry_name'] = $this->error['industry name'];
		} else {
		 	$data['error_industry_name'] = '';
		}
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = '';
		}
	  
		if (isset($this->error['variation_desriptions'])) {
			$data['error_variation_desriptions'] = $this->error['variation_desriptions'];
		} else {
			$data['error_variation_desriptions'] = '';

		}
		if (isset($this->error['image'])) {
			$data['error_image'] = $this->error['image'];
		} else {
			$data['error_image'] = '';
		}
		if (isset($this->error['industry_name'])) {
			$data['error_industry_name'] = $this->error['industry_name'];
		} else {
			$data['error_industry_name'] = '';
		}
	 
		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = '';
		}
	 
		if (isset($this->error['meta_description'])) {
			$data['error_meta_description'] = $this->error['meta_description'];
		} else {
			$data['error_meta_description'] = '';
		}
	 
		if (isset($this->error['meta_keyword'])) {
			$data['error_meta_keyword'] = $this->error['meta_keyword'];
		} else {
			$data['error_meta_keyword'] = '';
		}
	 
		if (isset($this->error['status'])) {
			$data['error_status'] = $this->error['status'];
		} else {
			$data['error_status'] = '';
		}
	 
		if (isset($this->error['propertyDes'])) {
			$data['error_propertyDes'] = $this->error['propertyDes'];
		} else {
			$data['error_propertyDes'] = '';
		}
	 
		if (isset($this->error['Enabledproducts'])) {
			$data['error_Enabledproducts'] = $this->error['Enabledproducts'];
		} else {
			$data['error_Enabledproducts'] = '';
		}

		if (isset($this->request->get['industry_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$industry_info = $this->model_job_industry->getindustryvariation($this->request->get['industry_id']);
		}
		
		$data['token'] = $this->session->data['token'];

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		}elseif (isset($industry_info['image'])) {
			$data['image'] = $industry_info['image'];
		}else {
			$data['image'] = '';
		}

		///images          
		$this->load->model('tool/image');
		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
		 	$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($industry_info) && is_file(DIR_IMAGE . $industry_info['image'])) {
			 $data['thumb'] = $this->model_tool_image->resize($industry_info['image'], 100, 100);
		} else {
		 	$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
				
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
							
		if (isset($this->request->post['industry_name'])) {
			$data['industry_name'] = $this->request->post['industry_name'];
		}elseif (isset($industry_info['industry_name'])) {
			$data['industry_name'] = $industry_info['industry_name'];
		}else {
			$data['industry_name'] = '';
		}

		if (isset($this->request->post['meta_title'])) {
			$data['meta_title'] = $this->request->post['meta_title'];
		}elseif (isset($industry_info['meta_title'])) {
			$data['meta_title'] = $industry_info['meta_title'];
		}else {
			$data['meta_title'] = '';
		}
		if (isset($this->request->post['meta_description'])) {
			$data['meta_description'] = $this->request->post['meta_description'];
		}elseif (isset($industry_info['meta_description'])) {
			$data['meta_description'] = $industry_info['meta_description'];
		}else {
			$data['meta_description'] = '';
		}
		if (isset($this->request->post['meta_keyword'])) {
			$data['meta_keyword'] = $this->request->post['meta_keyword'];
		}elseif (isset($industry_info['meta_keyword'])) {
			$data['meta_keyword'] = $industry_info['meta_keyword'];
		}else {
			$data['meta_keyword'] = '';
		}
		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		}elseif (isset($industry_info['description'])) {
			$data['description'] = $industry_info['description'];
		}else {
			$data['description'] = '';
		}
		
		if (isset($this->request->post['status']))
		{
			$data['status'] = $this->request->post['status'];
		} 
		elseif (!empty($industry_info)) 
		{
			$data['status'] = $industry_info['status'];
		} 
		else 
		{
			$data['status'] = true;
		}
		if (isset($this->request->post['seo_keyword'])) {
			$data['seo_keyword'] = $this->request->post['seo_keyword'];
		}elseif (isset($industry_info['seo_keyword'])) {
			$data['seo_keyword'] = $industry_info['seo_keyword'];
		}else {
			$data['seo_keyword'] = '';
		}
		if (isset($this->request->post['variation_desription'])) {
			$data['variation_desription'] = $this->request->post['variation_desription'];
		}elseif (isset($industry_info)) {
			$data['variation_desription'] = $this->model_job_industry->getIndustryDescriptions($this->request->get['industry_id']);
		}else {
			$data['variation_desription'] = array();
		}
			
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/industry', $data));  
	}
	public function validateindustry(){
		if (!$this->user->hasPermission('modify', 'job/industry')) {
		$this->error['warning'] = $this->language->get('error_permission');
		}
		foreach ($this->request->post['variation_desription'] as $language_id => $value) 
		{     
			if ((utf8_strlen($value['industry_name']) < 3) || (utf8_strlen($value['industry_name']) > 64)) 
			{
			 	$this->error['industry_name'][$language_id] = $this->language->get('error_industry_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)) 
			{
			 	$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}

			if ((utf8_strlen($value['meta_description']) < 3) || (utf8_strlen($value['meta_description']) > 64)) 
			{
			 	$this->error['meta_description'][$language_id] = $this->language->get('error_meta_description');
			}

			if ((utf8_strlen($value['meta_keyword']) < 3) || (utf8_strlen($value['meta_keyword']) > 64)) 
			{
			 	$this->error['meta_keyword'][$language_id] = $this->language->get('error_meta_keyword');
			}  
		}
		return !$this->error;
	}	
	protected function validateDelete(){
		if (!$this->user->hasPermission('modify', 'job/industry')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
	}
	public function delete() {
		$this->load->language('job/industry');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/industry');
		
		//change delete//
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
			foreach ($this->request->post['selected'] as $industry_id) {
				$this->model_job_industry->deleteIndustry($industry_id);
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

			$this->response->redirect($this->url->link('job/industry', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	} 
	public function autcomplete(){
		$this->load->model('job/industry');

		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = false;
		}
		if (isset($this->request->get['filter_sort_order'])) {
			$filter_sort_order = $this->request->get['filter_sort_order'];
		} else {
			$filter_sort_order = false;
		}
		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = false;
		}
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pvd.name';
		}
		if (isset($this->request->get['sort'])) {
			
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.status';
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
				
		$url = '';
		$data['form']=array();
		$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
		'filter_name' => $filter_name,
		'filter_sort_order' => $filter_sort_order,
		'filter_status' => $filter_status,

		'start' => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit' => $this->config->get('config_limit_admin')
		);
		
		$results=$this->model_job_industry->getindustry($filter_data);

		if($results)
		{
		foreach($results as $result)
		{
			$json[]=array(
				'industry_id'=>$result['industry_id'],
				'name'=>$result['name'],
			);
			
		}
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}