<?php
class ControllerJobJobSubmitList extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('job/job_submit_list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/joblist');

		$this->getList();
	}

	public function delete() {
		$this->load->language('job/job_submit_list');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/joblist');

		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $member_id) {
				$this->model_job_joblist->deleteList($member_id);
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

			$this->response->redirect($this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function approve(){
		$this->load->language('job/job_submit_list');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/joblist');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['job_id'])){
			$approves[] = $this->request->get['job_id'];
		}
		if ($approves){
			foreach($approves as $job_id){
				$this->model_job_joblist->approve($job_id);
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
			$this->response->redirect($this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList(); 
	}

	public function disapprove(){
		$this->load->language('job/job_submit_list');
		$this->document->setTitle($this->language->get('heading_title'));
		$this->load->model('job/joblist');
		$approves = array();
		if (isset($this->request->post['selected'])){
			$approve = $this->request->post['selected'];
		} 
		elseif (isset($this->request->get['job_id'])){
			$approves[] = $this->request->get['job_id'];
		}
		if ($approves){
			foreach($approves as $job_id){
				$this->model_job_joblist->disApprove($job_id);
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
			$this->response->redirect($this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList(); 

	}

	protected function getList() {
		if (isset($this->request->get['filter_company_id'])) {
			$filter_company_id = $this->request->get['filter_company_id'];
		} else {
			$filter_company_id = '';
		}
		if (isset($this->request->get['filter_experience'])) {
			$filter_experience = $this->request->get['filter_experience'];
		} else {
			$filter_experience = '';
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
		if (isset($this->request->get['filter_company_id'])) {
			$url .= '&filter_company_id=' . $this->request->get['filter_company_id'];
		}

		if (isset($this->request->get['filter_experience'])) {
			$url .= '&filter_experience=' . $this->request->get['filter_experience'];
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
			'href' => $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('job/job_submit_list/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/job_submit_list/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['lists'] = array();

		$filter_data = array(
		'filter_company_id' => $filter_company_id,
		'filter_experience' => $filter_experience,
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

         $this->load->model('job/joblist');
         $this->load->model('job/company');
		$list_total = $this->model_job_joblist->getTotalList($filter_data);

		$results = $this->model_job_joblist->getLists($filter_data);

		foreach ($results as $result) {

			$ompanyinfo= $this->model_job_company->getCompany($result['company_id']);

			 if(isset($ompanyinfo['full_name'])){
					$cname=$ompanyinfo['full_name'];         
				} else {
					$cname='';
				}


				if($result['jobtype_id']==1){
					$type= "Part Time";
				} else {
					$type="Full Time";
				}

				$this->load->model('catalog/category');
				$category_info= $this->model_catalog_category->getJobCategory($result['category_id']);
               
                if(isset($category_info['name'])){
					$cnametype=$category_info['name'];         
				} else {
					$cnametype='';
				}

				$this->load->model('job/applyjob');
				$jobtotal=$this->model_job_applyjob->getsumbitjobtotal($result['job_id']);

				if (!$result['status']) {
					$approve = $this->url->link('job/job_submit_list/approve', 'token=' . $this->session->data['token'] . '&job_id=' . $result['job_id'] . $url, true);
				} else {
					$approve = '';
				}

				if ($result['status']) {
					$disapproved = $this->url->link('job/job_submit_list/disapprove', 'token=' . $this->session->data['token'] . '&job_id=' . $result['job_id']);
				} else {
					$disapproved = '';
				}

               $data['lists'][] = array(
					'job_id'          => $result['job_id'],
					'approve'         => $approve,
					'disapproved'     => $disapproved,
					'cname'           => $cname,
					'type'            => $type,
					'cnametype'       => $cnametype,
					'jobtotal'        => $jobtotal,
					'location'     	  => $result['location'],
					'title'     	  => $result['title'],
					'experience'      => $result['experience'],
			    	'href'            => $this->url->link('job/jobappleylist', 'token=' . $this->session->data['token'] . '&job_id=' .$result['job_id'])
			  );
		}

		$data['heading_title'] 				= $this->language->get('heading_title');
		$data['text_list']                  = $this->language->get('text_list');
		$data['text_no_results']            = $this->language->get('text_no_results');
		$data['text_confirm']               = $this->language->get('text_confirm');
		$data['text_none']                  = $this->language->get('text_none');

		$data['filters_company_name']       = $this->language->get('filters_company_name');
		$data['filters_experience']         = $this->language->get('filters_experience');

		$data['column_company_name']        = $this->language->get('column_company_name');
		$data['column_title']               = $this->language->get('column_title');
		$data['column_experience']          = $this->language->get('column_experience');
		$data['column_location']            = $this->language->get('column_location');
		$data['column_job_type']            = $this->language->get('column_job_type');
		$data['column_jobtypelist']         = $this->language->get('column_jobtypelist');
		$data['column_applejoblist']        = $this->language->get('column_applejoblist');
		$data['column_applejob']         	= $this->language->get('column_applejob');
		$data['column_action']         	= $this->language->get('column_action');

		$data['button_add']                 = $this->language->get('button_add');
		$data['button_edit']                = $this->language->get('button_edit');
		$data['button_delete']              = $this->language->get('button_delete');
		$data['button_filter']              = $this->language->get('button_filter');
		$data['button_approve']        		= $this->language->get('button_approve');
		$data['button_desapprove']        	= $this->language->get('button_desapprove');
		
		$data['token']                      = $this->session->data['token'];
	


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
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';
		if (isset($this->request->get['filter_company_id'])) {
			$url .= '&filter_company_id=' . $this->request->get['filter_company_id'];
		}

		if (isset($this->request->get['filter_experience'])) {
			$url .= '&filter_experience=' . $this->request->get['filter_experience'];
		}

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_company_name'] 	= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=jd.company_name' . $url, true);
		$data['sort_experience'] 	= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=jd.experience' . $url, true);
		$data['sort_location'] 		= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=j.location' . $url, true);
		$data['sort_job_type'] 		= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=j.jobtype_id' . $url, true);
		$data['sort_sort_order'] 	= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=j.sort_order' . $url, true);
		$data['sort_cate'] 			= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=j.category_id' . $url, true);
		$data['sort_title_name'] 	= $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . '&sort=jd.title' . $url, true);
		$url = '';
		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}
		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}
		if (isset($this->request->get['filter_company_id'])) {
			$url .= '&filter_company_id=' . $this->request->get['filter_company_id'];
		}
		
		if (isset($this->request->get['filter_experience'])) {
			$url .= '&filter_experience=' . $this->request->get['filter_experience'];
		}
		$pagination = new Pagination();
		$pagination->total = $list_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/job_submit_list', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($list_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($list_total - $this->config->get('config_limit_admin'))) ? $list_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $list_total, ceil($list_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;
		$data['filter_company_id'] = $filter_company_id;
		if(isset($this->request->get['filter_company_id'])) {
		$company_info = $this->model_job_company->getCompany($this->request->get['filter_company_id']);
		}
		if(isset($company_info['full_name'])) {
			$data['filter_company_id'] = $company_info['full_name'];
		}
		$data['filter_experience'] = $filter_experience;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/job_submit_list_list', $data));
	}

	
	public function autocomplete(){
		if (isset($this->request->get['filter_full_name'])) {
			if (isset($this->request->get['filter_full_name'])) {
			 	$filter_full_name = $this->request->get['filter_full_name'];
			} else {
			 	$filter_full_name = '';
			}

			if (isset($this->request->get['sort'])) {
				$sort = $this->request->get['sort'];
			} else {
				$sort = '';
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
				'filter_full_name'    => $filter_full_name,
				'sort'  => $sort,
				'order' => $order,
				'start' => ($page - 1) * $this->config->get('config_limit_admin'),
				'limit' => $this->config->get('config_limit_admin')
			);
			$accounts = $this->model_job_company->getCompanys($filter_data);
			foreach ($accounts as $account) {
				$json[] = array(
				'company_id'  => $account['company_id'],
				'full_name'   => strip_tags(html_entity_decode($account['full_name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}
		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['full_name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}