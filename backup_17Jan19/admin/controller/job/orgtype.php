 <?php
class ControllerJobOrgtype extends Controller{
 private $error = array();
 public function index(){
		$this->load->language('job/orgtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/orgtype');
		
		$this->getList();
 }
 public function add(){
		$this->load->language('job/orgtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/orgtype');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
			$this->model_job_orgtype->addOrgtype($this->request->post);
			
	
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
			$this->response->redirect($this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true));
    	}
		$this->getform();
 } 
 public function edit(){
        
		$this->load->language('job/orgtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/orgtype');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
			$this->model_job_orgtype->editOrgtype($this->request->get['orgtype_id'],$this->request->post);
			//print_r($this->request->post);die();
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
       
			$this->response->redirect($this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true));
    	}
		$this->getForm();
  }
 public function getList(){
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'od.orgtype_name';
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
		
		$data['form'] = array();
		
		$filter_data = array(
		'sort'  => $sort,
		'order' => $order,
		'start' => ($page - 1) * $this->config->get('config_limit_admin'),
		'limit' => $this->config->get('config_limit_admin')
		);
		$this->load->model('tool/image');
		
		$orgtype_total = $this->model_job_orgtype->getTotalOrgtypes($filter_data);
		
		$results=$this->model_job_orgtype->getOrgtypes($filter_data);
		
		foreach($results as $result)
		{
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			if ($result['status']) {
				$status = $this->language->get('text_enable');
			} else {
				$status = $this->language->get('text_disable');
			}
			$data['form'][]=array(
			'orgtype_id'  =>$result['orgtype_id'],
			'orgtype_name'=>$result['orgtype_name'],
			'seo_keyword' =>$result['seo_keyword'],
			'meta_title'  =>$result['meta_title'],
			'image'       =>$image,
			'status'      =>$status,
			'edit'        => $this->url->link('job/orgtype/edit', 'token=' . $this->session->data['token'] . '&orgtype_id=' .$result['orgtype_id'] . $url, true));
		}		
					
		$url = '';
        
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
	 
		if (isset($this->request->get['filter_stauts'])) {
			$url .= '&filter_stauts=' . $this->request->get['filter_stauts'];
		}
	 
		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . $this->request->get['filter_name'];  
		}
		
		$data['sort'] = $sort;
		$data['order'] = $order;
		
		$data['sort_orgtype_name']  = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . '&sort=od.orgtype_name' . $url, true);
		
		$data['sort_status'] = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);
		
		$data['sort_image']  = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . '&sort=p.image' . $url, true);
		
		$data['sort_meta_title']  = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . '&sort=od.meta_title' . $url, true);

		$data['heading_title']           = $this->language->get('heading_title');
		$data['text_form']               = $this->language->get('text_form');
		$data['text_list']               = $this->language->get('text_list');
		$data['text_enable']             = $this->language->get('enable');
		$data['text_disable']            = $this->language->get('disable');
		$data['text_no_results']         = $this->language->get('text_no_results');
		$data['text_confirm']            = $this->language->get('text_confirm');

		$data['column_image']            = $this->language->get('column_image');
		$data['column_orgtype_name']     = $this->language->get('column_orgtype_name');
		$data['column_meta_title']       = $this->language->get('column_meta_title');
		$data['column_status']           = $this->language->get('column_status');
		$data['column_seo_keyword']      = $this->language->get('column_seo_keyword');
		$data['column_action']           = $this->language->get('column_action');

		$data['button_add']              = $this->language->get('button_add');
		$data['button_cancle']           = $this->language->get('button_cancle');
		$data['button_delete']           = $this->language->get('button_delete');
		$data['button_edit']             = $this->language->get('button_edit');
		$data['button_view']             = $this->language->get('button_view');
		$data['token']                   = $this->session->data['token'];

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
			'href' => $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true)
		);
		
			//select for list
    	$data['results'] = '';
        
		if (isset($this->error['warning'])) {
		 	$data['error_warning'] = $this->error['warning'];
		} else {
		 	$data['error_warning'] = '';
		}if (isset($this->session->data['success'])) {
		 	$data['success'] = $this->session->data['success'];

		unset($this->session->data['success']);
		} else {
		 	$data['success'] = '';
		}
	 
		if (!isset($this->request->get['orgtype_id'])) {
		 	$data['action'] = $this->url->link('job/orgtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
		 	$data['action'] = $this->url->link('job/orgtype/edit', 'token=' . $this->session->data['token'] . '&orgtype_id=' . $this->request->get['orgtype_id'] . $url, true);
		}
        
	 	if (isset($this->request->post['selected'])) {
		 	$data['selected'] = (array) $this->request->post['selected'];
		} else {
		 	$data['selected'] = array();
		}
		//action button
		$data['add']    = $this->url->link('job/orgtype/add', '&token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/orgtype/delete', '&token=' . $this->session->data['token'] . $url, true);
      
		if (!isset($this->request->get['orgtype_id'])) {
		 	$data['action'] = $this->url->link('job/orgtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
		 	$data['action'] = $this->url->link('job/orgtype/edit', 'token=' . $this->session->data['token'] . '&orgtype_id=' . $this->request->get['orgtype_id'] . $url, true);
		}
		 $data['add']    = $this->url->link('job/orgtype/add', 'token=' . $this->session->data['token'] . $url, true);
		 $data['delete'] = $this->url->link('job/orgtype/delete', 'token=' . $this->session->data['token'] . $url, true);
        
         /////pagination//
        
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$pagination = new Pagination();
		$pagination->total  = $orgtype_total;
		$pagination->page   = $page;
		$pagination->limit  = $this->config->get('config_limit_admin');
		$pagination->url    = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
        
		$data['results'] = sprintf($this->language->get('text_pagination'), ($orgtype_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($orgtype_total - $this->config->get('config_limit_admin'))) ? $orgtype_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $orgtype_total, ceil($orgtype_total / $this->config->get('config_limit_admin')));
        
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/orgtype_list', $data));
        
  }
 public function getform() {
		$data['heading_title']              = $this->language->get('heading_title');
		$data['text_form']                  = $this->language->get('text_form');
		$data['text_list']                  = $this->language->get('text_list');
		$data['text_enable']                = $this->language->get('enable');
		$data['text_disable']               = $this->language->get('disable');

		$data['tab_general']                = $this->language->get('tab_general');
		$data['tab_data']                   = $this->language->get('tab_data');

		$data['lable_orgtype_name']         = $this->language->get('lable_orgtype_name');
		$data['lable_description']          = $this->language->get('lable_description');
		$data['lable_meta_title']           = $this->language->get('lable_meta_title');
		$data['lable_meta_description']     = $this->language->get('lable_meta_description');
		$data['lable_meta_keyword']         = $this->language->get('lable_meta_keyword');
		$data['lable_SEO_keyword']          = $this->language->get('lable_SEO_keyword');
		$data['lable_image']                = $this->language->get('lable_image');
		$data['lable_status']               = $this->language->get('lable_status');

	    $data['entry_orgtype_name']         = $this->language->get('entry_orgtype_name');
		$data['entry_description']          = $this->language->get('entry_description');
		$data['entry_meta_title']           = $this->language->get('entry_meta_title');
		$data['entry_meta_description']     = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword']         = $this->language->get('entry_meta_keyword');
		$data['entry_SEO_keyword']          = $this->language->get('entry_SEO_keyword');
		$data['entry_image']                = $this->language->get('entry_image');
		$data['entry_status']               = $this->language->get('entry_status');
		
		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
		$data['button_save']                = $this->language->get('button_save');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_cancel']              = $this->language->get('button_cancel');
        
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
		'href' => $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true)
		);
		if (!isset($this->request->get['orgtype_id'])) {
			$data['action'] = $this->url->link('job/orgtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/orgtype/edit', 'token=' . $this->session->data['token'] . '&orgtype_id=' . $this->request->get['orgtype_id'] . $url, true);
		}
		$data['cancel'] = $this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true);
        
		///  language  
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->request->post['selected'])) {
		 	$data['selected'] = (array) $this->request->post['selected'];
		} else {
	  		$data['selected'] = array();
		}
		
		///edit 
				
		if (isset($this->error['orgtype_name'])) {
			$data['error_org_type'] = $this->error['orgtype_name'];
		} else {
			$data['error_org_type'] = '';
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = '';
		}
		
		if (isset($this->request->get['orgtype_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$orgtypes_info = $this->model_job_orgtype->getOrgtype($this->request->get['orgtype_id']);
		}
		$data['token'] = $this->session->data['token'];
			///edit form  

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (isset($orgtypes_info['sort_order'])) {
			$data['sort_order'] = $orgtypes_info['sort_order'];
		} else {
			$data['sort_order'] = '';
		}
	 	
	 	if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		}elseif (isset($orgtypes_info['description'])) {
			$data['description'] = $orgtypes_info['description'];
		}else {
			$data['description'] = '';
		}
	 
		if (isset($this->request->post['vendor_id'])) {
			$vendor_ids = $this->request->post['vendor_id'];
		} elseif (!empty($parent_info)) {
		} else {
		 	$vendor_ids = '';
		}
	 
		 $this->load->model('tool/image');
		if (isset($this->request->post['image'])) 
		{
			$data['image'] = $this->request->post['image'];
		} 
		elseif (!empty($orgtypes_info)) 
		{
			$data['image'] = $orgtypes_info['image'];
		} else 
		{
			$data['image'] = '';
		}
		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) 
		{
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		}
		elseif(!empty($orgtypes_info) && is_file(DIR_IMAGE . $orgtypes_info['image']))
		{
			$data['thumb'] = $this->model_tool_image->resize($orgtypes_info['image'], 100, 100);
		} 
		else 
		{
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		/// name this is input 
		$data['vendors']=array();
		//$this->load->model('vendor/vendor');
		if(!empty($vendor_ids))
		{
			foreach($vendor_ids as $vendor_id)
			{
				$vendor_info=$this->model_vendor_vendor->getOrgtypes($vendor_id);
				$data['vendors'][]=array(
				'vendor_id'=>$vendor_id,
				'name'=>$vendor_info['name'],
			);
		}
		}
		
		if (isset($this->request->post['variation_desription'])) {
			$data['variation_desription'] = $this->request->post['variation_desription'];
		} elseif (isset($orgtypes_info)) {
			$data['variation_desription'] = $this->model_job_orgtype->getOrgtypevariationDescriptions($this->request->get['orgtype_id']);
		} else {
			$data['variation_desription'] = array();
		}
		$data['header']       = $this->load->controller('common/header');
		$data['column_left']  = $this->load->controller('common/column_left');
		$data['footer']       = $this->load->controller('common/footer');
        
		$this->response->setOutput($this->load->view('job/orgtype', $data));
 	}
 	public function validateForm(){
		if (!$this->user->hasPermission('modify', 'job/orgtype')) {
				$this->error['warning'] = $this->language->get('error_permission');
		}
		foreach ($this->request->post['variation_desription'] as $language_id => $value){
			if ((utf8_strlen($value['orgtype_name']) < 3) || (utf8_strlen($value['orgtype_name']) > 64)) {
				$this->error['orgtype_name'][$language_id] = $this->language->get('error_org_type');
			} 

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)){
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			} 
		}
		
       return !$this->error;
 	}
	protected function validateDelete(){
		if (!$this->user->hasPermission('modify', 'job/orgtype')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
     return !$this->error;
    }
	public function delete() {
		$this->load->language('job/orgtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/orgtype');
		
		//change delete//
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
		foreach ($this->request->post['selected'] as $orgtype_id) {
			
		$this->model_job_orgtype->deleteOrgtype($orgtype_id);
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

		$this->response->redirect($this->url->link('job/orgtype', 'token=' . $this->session->data['token'] . $url, true));
		}
			$this->getList();
	}
}