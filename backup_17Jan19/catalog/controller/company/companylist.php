<?php
class ControllerCompanyCompanyList extends Controller {
	private $error = array();
	public function index() {
		
				
		$this->load->language('company/companylist');

		$this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('job/company');
        $this->load->model('tool/image');

	
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'full_name';
		}
		
		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'DESC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		$url = '';
		
		if (isset($this->request->get['category_id'])) {
		 	$category_id = $this->request->get['category_id'];
		} else {
		 	$category_id = false;
		}

		if (isset($this->request->get['filter_limit'])) {
		 $filter_limit = $this->request->get['filter_limit'];
		} else {
		 $filter_limit = false;
		}
		$url = '';
		
		if (isset($this->request->get['category_id'])) {
			$url .= '&category_id=' . $this->request->get['category_id'];
		}

		if (isset($this->request->get['filter_limit'])) {
			$url .= '&filter_limit=' . $this->request->get['filter_limit'];
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

		if(empty($this->request->get['filter_limit'])){
			$filter_limit = $this->config->get('config_limit_admin'); 
		 }

             $data['jobdetalis']=array();
	        $filter_data = array(
			'category_id'   => $category_id,
			'sort'          => $sort,
		    'order'         => $order,
			'start'         => ($page - 1) * $filter_limit,
			'limit'         => $filter_limit
		);

	    //print_r($filter_data);die();
    
         $companytotal=$this->model_job_company->getjobcompany($filter_data);

          $jobdetalis=$this->model_job_company->getCompanys($filter_data);
                
			foreach ($jobdetalis as $jobdetali) {
				
				if(isset($jobdetali['company_logo'])){
					$thumb = $this->model_tool_image->resize($jobdetali['company_logo'],250,75);
				} else {
					$thumb = $this->model_tool_image->resize('placeholder.png',250,70);
				}

				/*if (is_file(DIR_IMAGE . $jobdetali['company_logo'])) {
					$thumb = $this->model_tool_image->resize($jobdetali['company_logo'], 250, 70);
				} else {
					$thumb = $this->model_tool_image->resize('no_image.png', 250, 70);
				}*/
				
				$jobtota=$this->model_job_company->getjobTotals($jobdetali['company_id']);

				$data['jobdetalis'][]=array(
					'company_id' => $jobdetali['company_id'],
					'thumb'      => $thumb,
					'jobtota'    => $jobtota,
					'href'      => $this->url->link('company/viewcompany&company_id=' .$jobdetali['company_id'])
				);
			}

       			$url = '';
			//2/9/2019//
			if (isset($this->request->get['filter_limit'])) {
				$url .= '&filter_limit=' . $this->request->get['filter_limit'];
			}
			
			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}


			$pagination = new Pagination();
			$pagination->total = $companytotal;
			$pagination->page = $page;
			$pagination->limit =$filter_limit;
			$pagination->url = $this->url->link('company/companylist',$url . '&page={page}', true);
			$data['pagination'] = $pagination->render();
		 	$data['results'] = sprintf($this->language->get('text_pagination'), ($companytotal) ? (($page - 1) * $filter_limit) + 1 : 0, ((($page - 1) * $filter_limit) > ($companytotal - $filter_limit)) ? $companytotal : ((($page - 1) * $filter_limit) + $filter_limit), $companytotal, ceil($companytotal / $filter_limit));

	       	$data['sort'] = $sort;
			$data['order'] = $order;
		    $data['filter_limit'] = $filter_limit;
		    $data['category_id'] = $category_id;


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

         $data['shows']=array();  


		$data['shows'][]=array(
        'show_id'=> 5,
        'value'=> 5,
 
		);

		$data['shows'][]=array(
        'show_id'=> 10,
        'value'=> 10,
 
		);

		$data['shows'][]=array(
        'show_id'=> 25,
        'value'=> 25,
 
		);

		$data['shows'][]=array(
        'show_id'=> 100,
        'value'=> 100,
 
		);


        $this->load->model('catalog/category');
        $data['Categories'] = $this->model_catalog_category->getJobCategories(array());
        
        $data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);


		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('company/submitjob')
		);

		$data['heading_title']= $this->language->get('heading_title');
		$data['text_select']= $this->language->get('text_select');
		$data['text_none']= $this->language->get('text_none');
		$data['text_showlimit']= $this->language->get('text_showlimit');
		$data['text_jobcategory']= $this->language->get('text_jobcategory');
		$data['text_keywords']= $this->language->get('text_keywords');
		$data['text_jobs']= $this->language->get('text_jobs');


		$this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getJobCategories($data);

		$categorieslists=$this->model_catalog_category->getJobCategories($data);
         $categories=(array_slice($categorieslists, 2,5));
		foreach ($categories as $categorieslists) {
           $data['categorieslists'][]=array(
           	'category_id'=>$categorieslists['category_id'],
           	'name'=>$categorieslists['name'],
           	  'href'          => $this->url->link('company/companylist', 'category_id=' . $categorieslists['category_id'])
           	);
		
		}


	  $data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('company/companylist', $data));
	}
}
