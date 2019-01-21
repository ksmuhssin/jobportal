<?php
class ControllerCompanyJobsubmitlist extends Controller {
	private $error = array();
	public function index() {
		$this->load->language('company/jobsubmitlist');
		
		if (!$this->company->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->load->model('job/job');
		$this->load->model('tool/image');
      
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
		$this->document->setTitle($this->language->get('heading_title'));
		$data['heading_title'] 			= $this->language->get('heading_title');
		$data['column_image'] 			= $this->language->get('column_image');
		$data['column_job'] 			= $this->language->get('column_job');
		$data['column_title'] 			= $this->language->get('column_title');
		$data['column_experience'] 		= $this->language->get('column_experience');
		$data['column_applyjoblist'] 	= $this->language->get('column_applyjoblist');
        $data['entry_image'] 			= $this->language->get('entry_image');
		$data['entry_job'] 			    = $this->language->get('entry_job');
		$data['entry_title'] 			= $this->language->get('entry_title');
		$data['entry_experience'] 		= $this->language->get('entry_experience');
		$data['text_applyjob'] 		    = $this->language->get('text_applyjob');
		$data['column_action'] 			= $this->language->get('column_action');
		$data['text_confirm'] 			= $this->language->get('text_confirm');
		
		
		
		$data['text_no_results'] 		= $this->language->get('text_no_results');

		$data['button_edit'] 			= $this->language->get('button_edit');
		$data['button_delete'] 			= $this->language->get('button_delete');
		$data['button_view'] 			= $this->language->get('View');
		$data['button_add'] 			= $this->language->get('Add');




        $data['job_infos']=array();
        $filter_data = array(
        	'company_id'=>$this->company->getId(),
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
        $job_total=$this->model_job_job->getTotals($filter_data);

		$job_infos=$this->model_job_job->getCompanyJobs($filter_data);

        
         foreach ($job_infos as $job_info) {
         
			if (is_file(DIR_IMAGE . $job_info['banner'])) {
					$banner = $this->model_tool_image->resize($job_info['banner'], 50, 50);
				} else {
					$banner = $this->model_tool_image->resize('no_image.png', 50, 50);
				}

				if($job_info['jobtype_id']==1){
					$type= "Part Time";
				} else {
					$type="Full Time";
				}
				$this->load->model('job/applyjob');
				$jobtotal=$this->model_job_applyjob->getsumbitjobtotal($job_info['job_id']);

			  $data['job_infos'][]=array(
                'type'=>       $type,
				'job_id'=>     $job_info['job_id'],
				'title'=>      $job_info['title'],
				'experience'=> $job_info['experience'],
				'jobtotal'=> $jobtotal,
				'banner'    => $banner,
				'edit'      => $this->url->link('company/submitjob&job_id=' . $job_info['job_id']),
				'view'      => $this->url->link('company/jobsdetail&job_id=' . $job_info['job_id']),
				'applylist' => $this->url->link('company/applyjoblist&job_id=' . $job_info['job_id'])
			);
		}

		$data['add'] = $this->url->link('company/submitjob', '', true);	
		$data['delete'] = $this->url->link('company/jobsubmitlist/delete', '', true);	

		$pagination = new Pagination();
		$pagination->total = $job_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('company/jobsubmitlist', '&page={page}');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($job_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($job_total - $this->config->get('config_limit_admin'))) ? $job_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $job_total, ceil($job_total / $this->config->get('config_limit_admin')));
       	$data['sort'] = $sort;
		$data['order'] = $order;


         $data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('company/jobsubmitlist')
		);

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])){
			$data['success'] = $this->session->data['success'];
			unset($this->session->data['success']);
		} else{
			$data['success'] = '';
		}

	
      
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('company/jobsubmitlist', $data));
	}


	public function delete(){
		$this->load->language('company/jobsubmitlist');
		$this->load->model('job/job');
		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $job_id){
				$this->model_job_job->deleteJob($job_id);
			}
			$this->session->data['success'] = $this->language->get('text_successdelete');
			$this->response->redirect($this->url->link('company/jobsubmitlist'));
		}
		$this->index();
	}

	 
	
	 
}