<?php

class ControllerCompanyViewcompany extends Controller {

	private $error = array();

	public function index() {

		



		$this->load->language('company/viewcompany');

		$this->document->setTitle($this->language->get('heading_title'));



		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');

		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('job/company');

		$this->load->model('job/job');

		$this->load->model('localisation/zone');

		$this->load->model('tool/image');

		if(empty($this->request->get['company_id'])){

          	$this->response->redirect($this->url->link('company/companylist'));



          }

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('text_home'),

			'href' => $this->url->link('common/home')

		);



		$data['breadcrumbs'][] = array(

			'text' => $this->language->get('heading_title'),

			'href' => $this->url->link('company/viewcompany', '', true)

		);



		$url = '';

	

		if (isset($this->request->get['sort'])) {

			$sort = $this->request->get['sort'];

		} else {

			$sort = 'date_added';

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





		$data['heading_title'] 				= $this->language->get('heading_title');

		$data['text_account_already'] 		= sprintf($this->language->get('text_account_already'), $this->url->link('company/login', '', true));

		$data['text_your_details'] 			= $this->language->get('text_your_details');

		$data['text_your_address'] 			= $this->language->get('text_your_address');

		$data['text_your_password'] 		= $this->language->get('text_your_password');

		$data['text_newsletter'] 			= $this->language->get('text_newsletter');

		$data['text_yes'] 					= $this->language->get('text_yes');

		$data['text_no'] 					= $this->language->get('text_no');

		$data['text_select'] 				= $this->language->get('text_select');

		$data['text_none'] 					= $this->language->get('text_none');

		$data['text_loading'] 				= $this->language->get('text_loading');

		$data['text_company_detail'] 		= $this->language->get('text_company_detail');

		$data['entry_vacancies'] 			= $this->language->get('entry_vacancies');

		$data['button_view'] 				= $this->language->get('button_view');

		$data['button_apply'] 				= $this->language->get('button_apply');

		$data['button_continue'] 			= $this->language->get('button_continue');

		$data['button_upload'] 				= $this->language->get('button_upload');



		$data['text_no_results'] 				= $this->language->get('text_no_results');

			

	 $this->load->model('job/company');

        $this->load->model('tool/image');

         $this->load->model('localisation/zone');

          $this->load->model('localisation/country');



         





		$jobdetalis=$this->model_job_company->showCompany($this->request->get['company_id']);



		 if(empty($jobdetalis)){

          	$this->response->redirect($this->url->link('company/companylist'));



          }



		$data['address']=$jobdetalis['address'];

		$data['officeopen']=$jobdetalis['officeopen'];

		$data['officeclose']=$jobdetalis['officeclose'];

		

		$data['latitude']=$jobdetalis['latitude'];

		$data['longitude']=$jobdetalis['longitude'];





		$data['description']=$jobdetalis['company_description'];



		if(isset($jobdetalis['full_name'])){

		 $data['full_name']=$jobdetalis['full_name'];

		}

		else{

		 $data['full_name']='';

		}





		$zone_info = $this->model_localisation_zone->getZone($jobdetalis['zone_id']);

        

		if(isset($zone_info['name'])){

		$data['zonename']=$zone_info['name'];

		}

		else{

		$data['zonename']='';

		}

		

		$country_info = $this->model_localisation_country->getCountry($jobdetalis['country_id']);

        if(isset($country_info['name'])){

		$data['countryname']=$country_info['name'];

		}

		else{

		$data['countryname']='';

		}



	   $data['jobtota']=$this->model_job_company->getjobTotals($this->request->get['company_id']);









 

		if(isset($jobdetalis['company_logo'])){

			$data['thumblogo'] = $this->model_tool_image->resize($jobdetalis['company_logo'],900,300);

		} else {

			$data['thumblogo'] = $this->model_tool_image->resize('placeholder.png',900,300);

		}



        $companytotal = $this->model_job_company->getjobTotals($this->request->get['company_id']);

		$results = $this->model_job_company->getCompanyJobs($this->request->get['company_id']);


			foreach ($results as $result) {
				
				if (is_file(DIR_IMAGE . $result['banner'])) {

					$banner = $this->model_tool_image->resize($result['banner'], 140, 140);

				} else {

					$banner = $this->model_tool_image->resize('no_image.png', 140, 140);

				}

				if($result['jobtype_id']==1){

					$type= "Part Time";

				} else {

					$type="Full Time";

				}

                  

                  if(isset($result['description'])){

                    	$description = substr($result['description'], 0, 80);

                  }



				$data['jobs'][] = array(

					'job_id'  		=> $result['job_id'],

					'type'       	=> $type,


					'banner'       	=> $banner,

					'title'        	=> $result['title'],

					'location'      => $result['location'],

					'description'   => $description,

					'href'      	=> $this->url->link('job/jobdetail', 'job_id=' . $result['job_id']),
					'quick'     	=> $this->url->link('job/quick', 'job_id=' . $result['job_id']),

					'view'        	=> $this->url->link('job/jobdetail', 'job_id=' . $result['job_id']),

					'apply'       	=> $this->url->link('job/jobdetail', 'job_id=' . $result['job_id'])

				);

			}

						

		if(!empty($company_info['company_logo'])){

			$data['thumb'] = $this->model_tool_image->resize($company_info['company_logo'],45,45);

		} else {

			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);

		}





		$pagination = new Pagination();

		$pagination->total = $companytotal;

		$pagination->page = $page;

		$pagination->limit = $this->config->get('config_limit_admin');

		$pagination->url = $this->url->link('company/viewcompany', '&page={page}');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($companytotal) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($companytotal - $this->config->get('config_limit_admin'))) ? $companytotal : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $companytotal, ceil($companytotal / $this->config->get('config_limit_admin')));

       	$data['sort'] = $sort;

		$data['order'] = $order;

        

       

        $data['mapcode'] = html_entity_decode($this->config->get('jobportal_mapcode'), ENT_QUOTES, 'UTF-8');





		

		$data['column_left'] 	= $this->load->controller('common/column_left');

		$data['column_right'] 	= $this->load->controller('common/column_right');

		$data['content_top'] 	= $this->load->controller('common/content_top');

		$data['content_bottom'] = $this->load->controller('common/content_bottom');

		$data['footer'] 		= $this->load->controller('common/footer');

		$data['header'] 		= $this->load->controller('common/header');

		

		$this->response->setOutput($this->load->view('company/viewcompany', $data));

	}

}