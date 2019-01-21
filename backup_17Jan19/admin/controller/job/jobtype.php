 <?php
class ControllerJobJobtype extends Controller{
	private $error = array();
	public function index()
	{
		$this->load->language('job/jobtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/jobtype');
		
		$this->getList();
	}
	public function add(){
		$this->load->language('job/jobtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/jobtype');
        
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
			$this->model_job_jobtype->addJobtype($this->request->post);
			
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
			$this->response->redirect($this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true));
		}
        $this->getform();
	}
    
	public function edit(){
        
		$this->load->language('job/jobtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/jobtype');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
            
			$this->model_job_jobtype->editJobtype($this->request->get['jobtype_id'],$this->request->post);
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
			$this->response->redirect($this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getForm();
	}
	public function getList()
	{
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'od.jobtype_name';
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
		
		$jobtype_total = $this->model_job_jobtype->getTotalJobtypes($filter_data);
		
		$results=$this->model_job_jobtype->getJobtypes($filter_data);
		
		foreach($results as $result)
			{
				if ($result['status']) {
					$status = $this->language->get('text_enable');
				} else {
					$status = $this->language->get('text_disable');
				}
			$data['form'][]=array(
				'jobtype_id'      =>$result['jobtype_id'],
				'jobtype'         =>$result['jobtype'],
				'meta_description'=>$result['meta_description'],
				'meta_title'      =>$result['meta_title'],
				'status'          =>$status,
				'edit'            => $this->url->link('job/jobtype/edit', 'token=' . $this->session->data['token'] . '&jobtype_id=' .$result['jobtype_id'] . $url, true));
			}				
		$url = '';
        
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}
		
		
		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['sort_jobtype']  = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . '&sort=od.jobtype_name' . $url, true);
		
		$data['sort_status'] = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, true);
		
		$data['sort_image']  = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . '&sort=p.image' . $url, true);
		
		$data['sort_meta_title']  = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . '&sort=od.meta_title' . $url, true);
		
		$data['sort_meta_description']  = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . '&sort=od.meta_description' . $url, true);

        $data['heading_title']           = $this->language->get('heading_title');
        $data['text_form']               = $this->language->get('text_form');
        $data['text_list']               = $this->language->get('text_list');

        $data['column_title']            = $this->language->get('column_title');
        $data['column_meta_title']       = $this->language->get('column_meta_title');
        $data['column_status']           = $this->language->get('column_status');
        $data['column_product']          = $this->language->get('column_product');
        $data['column_jobtype_name']     = $this->language->get('column_jobtype_name');
        $data['column_sort_order']       = $this->language->get('column_sort_order');
        $data['column_description']      = $this->language->get('column_description');

        $data['entry_property']          = $this->language->get('entry_property');
        $data['column_action']           = $this->language->get('column_action');
        $data['column_jobtype']          = $this->language->get('column_jobtype');
        $data['button_add']              = $this->language->get('button_add');
        $data['button_cancle']           = $this->language->get('button_cancle');
        $data['button_delete']           = $this->language->get('button_delete');
        $data['button_']                 = $this->language->get('button_delete');
        $data['button_edit']             = $this->language->get('button_edit');
        $data['button_view']             = $this->language->get('button_view');
        $data['column_description']      = $this->language->get('column_description');
        $data['column_price']            = $this->language->get('column_price');
        $data['column_sort_order']       = $this->language->get('column_sort_order');
        $data['text_enable']             = $this->language->get('enable');
        $data['text_disable']            = $this->language->get('disable');
		$data['text_no_results']         = $this->language->get('text_no_results');
        $data['text_confirm']            = $this->language->get('text_confirm');
        $data['button_filter']           = $this->language->get('button_filter');
        $data['token']                   = $this->session->data['token'];
        
        
        //// variable define
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
			'href' => $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true)
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
		
		if (!isset($this->request->get['jobtype_id'])) {
		 	$data['action'] = $this->url->link('job/jobtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
		 	$data['action'] = $this->url->link('job/jobtype/edit', 'token=' . $this->session->data['token'] . '&jobtype_id=' . $this->request->get['jobtype_id'] . $url, true);
		}
        
	 	if (isset($this->request->post['selected'])) {
		 	$data['selected'] = (array) $this->request->post['selected'];
		} else {
		 	$data['selected'] = array();
		}
		//action button
		 $data['add']    = $this->url->link('job/jobtype/add', '&token=' . $this->session->data['token'] . $url, true);
		 
		 $data['delete'] = $this->url->link('job/jobtype/delete', '&token=' . $this->session->data['token'] . $url, true);
      
		if (!isset($this->request->get['jobtype_id'])) {
	  		$data['action'] = $this->url->link('job/jobtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/jobtype/edit', 'token=' . $this->session->data['token'] . '&jobtype_id=' . $this->request->get['jobtype_id'] . $url, true);
		}
		$data['add']    = $this->url->link('job/jobtype/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/jobtype/delete', 'token=' . $this->session->data['token'] . $url, true);
        
         /////pagination//
		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		
		$pagination = new Pagination();
		$pagination->total  = $jobtype_total;
		$pagination->page   = $page;
		$pagination->limit  = $this->config->get('config_limit_admin');
		$pagination->url    = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
        
		$data['results'] = sprintf($this->language->get('text_pagination'), ($jobtype_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($jobtype_total - $this->config->get('config_limit_admin'))) ? $jobtype_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $jobtype_total, ceil($jobtype_total / $this->config->get('config_limit_admin')));      
		
        
		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');
		$this->response->setOutput($this->load->view('job/jobtype_list', $data));
        
	}
	public function getform()
	{
		$data['heading_title']              = $this->language->get('heading_title');
		$data['text_form']                  = $this->language->get('text_form');
		$data['text_list']                  = $this->language->get('text_list');
	 	$data['text_select']                = $this->language->get('text_select');
		$data['text_enable']                = $this->language->get('enable');
		$data['text_disable']               = $this->language->get('disable');

		$data['lable_jobtype']              = $this->language->get('lable_jobtype');
		$data['lable_description']          = $this->language->get('lable_description');
		$data['lable_meta_title']           = $this->language->get('lable_meta_title');
		$data['lable_meta_description']     = $this->language->get('lable_meta_description');
		$data['lable_meta_keyword']         = $this->language->get('lable_meta_keyword');
		$data['lable_SEO_keyword']          = $this->language->get('lable_SEO_keyword');
		$data['lable_status']               = $this->language->get('lable_status');

		$data['entry_jobtype']              = $this->language->get('entry_jobtype');
		$data['entry_description']          = $this->language->get('entry_description');
		$data['entry_meta_title']           = $this->language->get('entry_meta_title');
		$data['entry_meta_description']     = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword']         = $this->language->get('entry_meta_keyword');
		$data['entry_SEO_keyword']          = $this->language->get('entry_SEO_keyword');
		$data['entry_status']               = $this->language->get('entry_status');

		$data['button_remove']              = $this->language->get('button_remove');
		$data['button_add']                 = $this->language->get('button_add');
		$data['button_save']                = $this->language->get('button_save');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_cancel']              = $this->language->get('button_cancel');
        
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
		 'href' => $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true)
		);
		if (!isset($this->request->get['jobtype_id'])) {
		 	$data['action'] = $this->url->link('job/jobtype/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
		 	$data['action'] = $this->url->link('job/jobtype/edit', 'token=' . $this->session->data['token'] . '&jobtype_id=' . $this->request->get['jobtype_id'] . $url, true);
		}
		$data['cancel'] = $this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true);
        
		////////////////////////  language /////////////////////
	  	$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		/////////////////////// language

		if (isset($this->request->post['selected'])) {
		 	$data['selected'] = (array) $this->request->post['selected'];
		} else {
	  		$data['selected'] = array();
		}
		
		//////////////////////  edit///
				
		if (isset($this->error['jobtype'])) {
			$data['error_jobtype'] = $this->error['jobtype'];
		} else {
			$data['error_jobtype'] = '';
		}
		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = '';
		}
		
		if (isset($this->error['sort_order'])) {
			$data['error_sort_order'] = $this->error['sort_order'];
		} else {
			$data['error_sort_order'] = '';
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
	  
		if (isset($this->request->get['jobtype_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {       
			$jobtypes_info = $this->model_job_jobtype->getJobtypes($this->request->get['jobtype_id']);
		}
		$data['token'] = $this->session->data['token'];
        ///////////// edit form ////////////////////

		if (isset($this->request->post['description'])) {
			$data['description'] = $this->request->post['description'];
		} elseif (isset($jobtypes_info['description'])) {
			$data['description'] = $jobtypes_info['description'];
		} else {
			$data['description'] = '';
		}
		
		if (isset($this->request->post['seo_keyword'])) {
			$data['seo_keyword'] = $this->request->post['seo_keyword'];
		} elseif (isset($jobtypes_info['seo_keyword'])) {
			$data['seo_keyword'] = $jobtypes_info['seo_keyword'];
		} else {
			$data['seo_keyword'] = '';
		}
	  
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($jobtypes_info['status'])) {
			$data['status'] = $jobtypes_info['status'];
		} else {
			$data['status'] = '';
		}
			
		if (isset($this->request->post['variation_desription'])) {
			$data['variation_desription'] = $this->request->post['variation_desription'];
		} elseif (isset($jobtypes_info)) {
			$data['variation_desription'] = $this->model_job_jobtype->getJobtypeDescriptions($this->request->get['jobtype_id']);
		} else {
			$data['variation_desription'] = array();
		}
		
		$data['header']       = $this->load->controller('common/header');
		$data['column_left']  = $this->load->controller('common/column_left');
		$data['footer']       = $this->load->controller('common/footer');
        
		$this->response->setOutput($this->load->view('job/jobtype_form', $data));
	}
	public function validateForm()
	{
		if (!$this->user->hasPermission('modify', 'job/jobtype')) {
				$this->error['warning'] = $this->language->get('error_permission');}
		foreach ($this->request->post['variation_desription'] as $language_id => $value) 
		{      
			if ((utf8_strlen($value['jobtype']) < 3) || (utf8_strlen($value['jobtype']) > 64)) 
				{
					$this->error['jobtype'][$language_id] = $this->language->get('error_jobtype');
				} 
			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 64)) 
				{
					$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
				}  
		}
       return !$this->error;
	}
	protected function validateDelete()
    {
		if (!$this->user->hasPermission('modify', 'job/jobtype')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		return !$this->error;
    }
	public function delete() {
		$this->load->language('job/jobtype');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('job/jobtype');
		//change delete//
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			
		foreach ($this->request->post['selected'] as $jobtype_id) {
			
		$this->model_job_jobtype->deleteJobtype($jobtype_id);
		
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

		$this->response->redirect($this->url->link('job/jobtype', 'token=' . $this->session->data['token'] . $url, true));
		}
			$this->getList();
		}
		
	public function autocomplete() {
		
		if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = false;
		}
				
		if (isset($this->request->get['filter_name'])) {
			
		if (isset($this->request->get['sort'])) {
		$sort = $this->request->get['sort'];
		} else {
		$sort = 'od.jobtype_name';
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
		$this->load->model('job/jobtype');
		$filter_data = array(
				'sort'  => $sort,
				'order' => $order,
				'filter_name' => $filter_name,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
		);
		$results=$this->model_job_jobtype->getJobtypes($filter_data);
			foreach ($results as $result) {
				$json[] = array(
					'jobtype_id' => $result['jobtype_id'],
					'jobtype'        => strip_tags(html_entity_decode($result['jobtype'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}
		$sort_order = array();
		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['jobtype'];
		}
		array_multisort($sort_order, SORT_ASC, $json);
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}	
}