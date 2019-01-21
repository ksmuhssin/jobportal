<?php
class ControllerCompanyApplyjoblist extends Controller {
	private $error = array();
	public function index() {

			if (!$this->company->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		
				
		$this->load->language('company/applyjoblist');

		$this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('job/company');
        $this->load->model('job/applyjob');
        $this->load->model('tool/image');
        $this->load->model('job/employ');
        $this->load->model('job/job');

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
        ////  applyjob list 
        $filter_data = array(
		    'job_id'         => $this->request->get['job_id'],
			'sort'           => $sort,
			'order'          => $order,
			'start'          => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'          => $this->config->get('config_limit_admin')
		);
        $applyjobtotal=$this->model_job_applyjob->getjobcompanytotal($filter_data);

         $applyjobinfos=$this->model_job_applyjob->getapplys($filter_data);

    
          foreach ($applyjobinfos as $applyjobinfo) {

          	$employ_info =$this->model_job_employ->getemploy($applyjobinfo['employ_id']);

          	if(isset($employ_info['fullname'])){
             $employname=$employ_info['fullname'];
          	}else{
               $employname='';
          	}

          	$jobcompanyinfos=$this->model_job_job->getJobCompany($applyjobinfo['job_id']);

   			if($jobcompanyinfos['jobtype_id']==1){
	    		$type= "Part Time";
			} else {
		    	$type="Full Time";
			}
			if(isset($jobcompanyinfos['title'])){
             $jobname=$jobcompanyinfos['title'];
          	}else{
               $jobname='';
          	}
          	$data['applyjobinfos'][]=array(
                  'ap_id'        => $applyjobinfo['ap_id'],
                  'firstname'    => $applyjobinfo['firstname'],
                  'date_added'   => $applyjobinfo['date_added'],
                  'cv'           => 'image/'.$applyjobinfo['cv'],
                  'jobname'      =>  $jobname,
                  'type'         =>  $type,
                  'employname'  =>  $employname,
                  'employview' => $this->url->link('company/candidateprofile&employ_id=' . $applyjobinfo['employ_id'])

 
          	 );
            	
            } 

		$pagination = new Pagination();
		$pagination->total = $applyjobtotal;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('company/applyjoblist&job_id='.$this->request->get['job_id'], '&page={page}');
		$data['pagination'] = $pagination->render();
		$data['results'] = sprintf($this->language->get('text_pagination'), ($applyjobtotal) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($applyjobtotal - $this->config->get('config_limit_admin'))) ? $applyjobtotal : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $applyjobtotal, ceil($applyjobtotal / $this->config->get('config_limit_admin')));
		$data['sort'] = $sort;
		$data['order'] = $order;
          
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

        $this->load->model('catalog/category');
        $data['Categories'] = $this->model_catalog_category->getJobCategories(array());
        
        $data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('company/jobsubmitlist')
		);

		$data['heading_title'] 			= $this->language->get('heading_title');

		$data['text_confirm'] 			= $this->language->get('text_confirm');
		$data['text_employname'] 			= $this->language->get('text_employname');
		$data['text_jobname'] 			= $this->language->get('text_jobname');
		$data['text_jobtype'] 			= $this->language->get('text_jobtype');
		$data['text_resume'] 			= $this->language->get('text_resume');
		$data['text_date'] 			= $this->language->get('text_date');
		$data['text_action'] 			= $this->language->get('text_action');
		$data['text_no_results'] 			= $this->language->get('text_no_results');
	    $data['button_cancel'] 			= $this->language->get('button_cancel');
		$data['button_delete'] 			= $this->language->get('button_delete');
		$data['text_confirm'] 			= $this->language->get('text_confirm');
		$data['text_viewprofile'] 			= $this->language->get('text_viewprofile');
		$data['button_view'] 			= $this->language->get('button_view');
		
		
		$data['action'] = $this->url->link('company/submitjob', '', true);	
		$data['cancel'] = $this->url->link('company/jobsubmitlist', '', true);	
		$data['delete'] = $this->url->link('company/applyjoblist/delete&job_id='.$this->request->get['job_id'].'');	
		
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('company/applyjoblist', $data));
	}
	public function delete(){
		$this->load->language('company/applyjoblist');
		$this->load->model('job/applyjob');
		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $ap_id){
				$this->model_job_applyjob->deleteappleyjob($ap_id);
			}
			$this->session->data['success'] = $this->language->get('text_successdelete');
			$this->response->redirect($this->url->link('company/applyjoblist&job_id='.$this->request->get['job_id'].''));
		}
		$this->index();
	}
}
