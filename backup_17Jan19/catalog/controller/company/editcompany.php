<?php
class ControllerCompanyEditcompany extends Controller {
	private $error = array();
	public function index() {
		if (!$this->company->isLogged()) {
			$this->response->redirect($this->url->link('employ/login', '', true));
		}
		$this->load->language('company/editcompany');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

				
		$this->load->model('job/company');

		$this->load->model('tool/image');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

			$this->model_job_company->editCompany($this->company->getId(),$this->request->post);
				
			$this->response->redirect($this->url->link('company/dashboard'));
			
		}
		$data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('company/dashboard', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_register'),
			'href' => $this->url->link('company/editcompany', '', true)
		);

		$data['heading_title'] 				= $this->language->get('heading_title');
		$data['text_account_already'] 		= sprintf($this->language->get('text_account_already'), $this->url->link('company/login', '', true));
		$data['text_your_details'] 			= $this->language->get('text_your_details');
		$data['text_your_address'] 			= $this->language->get('text_your_address');
		$data['text_your_password'] 		= $this->language->get('text_your_password');
		$data['text_newsletter'] 			= $this->language->get('text_newsletter');
		$data['text_companypackage'] 		= $this->language->get('text_companypackage');
		$data['text_yes'] 					= $this->language->get('text_yes');
		$data['text_no'] 					= $this->language->get('text_no');
		$data['text_select'] 				= $this->language->get('text_select');
		$data['text_none'] 					= $this->language->get('text_none');
		$data['text_loading'] 				= $this->language->get('text_loading');
		$data['text_company_detail'] 		= $this->language->get('text_company_detail');
		
		$data['button_upload'] 				= $this->language->get('button_upload');
		$data['button_update'] 				= $this->language->get('button_update');
		////
		
		$data['label_customer_group'] 		= $this->language->get('label_customer_group');
		$data['label_full_name'] 			= $this->language->get('label_full_name');
		$data['label_lastname'] 			= $this->language->get('label_lastname');
		$data['label_companyname'] 			= $this->language->get('label_companyname');
		$data['label_cell_phone'] 			= $this->language->get('label_cell_phone');
		$data['label_company_description'] 	= $this->language->get('label_company_description');
		$data['label_no_employees'] 		= $this->language->get('label_no_employees');
		$data['label_company_website'] 		= $this->language->get('label_company_website');
		$data['label_email'] 				= $this->language->get('label_email');
		$data['label_landline_phone'] 		= $this->language->get('label_landline_phone');
		$data['label_fax'] 					= $this->language->get('label_fax');
		$data['label_company'] 				= $this->language->get('label_company');
		$data['label_company_image'] 		= $this->language->get('label_company_image');
		$data['label_address'] 				= $this->language->get('label_address');
		$data['label_address_2'] 			= $this->language->get('label_address_2');
		$data['label_pincode'] 				= $this->language->get('label_pincode');
		$data['label_city'] 				= $this->language->get('label_city');
		$data['label_country']				= $this->language->get('label_country');
		$data['label_zone'] 				= $this->language->get('label_zone');
		$data['label_newsletter'] 			= $this->language->get('label_newsletter');
		$data['label_password'] 			= $this->language->get('label_password');
		$data['label_confirm'] 				= $this->language->get('label_confirm');
		$data['label_officeopen'] 			= $this->language->get('label_officeopen');
		$data['label_officeclose'] 			= $this->language->get('label_officeclose');
		$data['text_map'] 					= $this->language->get('text_map');
		$data['label_jobcategory'] 			= $this->language->get('label_jobcategory');
		$data['label_package'] 				= $this->language->get('label_package');
		$data['text_your_address'] 				= $this->language->get('text_your_address');
		
		$data['entry_customer_group'] 		= $this->language->get('entry_customer_group');
		$data['entry_full_name'] 			= $this->language->get('entry_full_name');
		$data['entry_lastname'] 			= $this->language->get('entry_lastname');
		$data['entry_companyname'] 			= $this->language->get('entry_companyname');
		$data['entry_cell_phone'] 			= $this->language->get('entry_cell_phone');
		$data['entry_company_description'] 	= $this->language->get('entry_company_description');
		$data['entry_no_employees'] 		= $this->language->get('entry_no_employees');
		$data['entry_company_website'] 		= $this->language->get('entry_company_website');
		$data['entry_email'] 				= $this->language->get('entry_email');
		$data['entry_landline_phone'] 		= $this->language->get('entry_landline_phone');
		$data['entry_fax'] 					= $this->language->get('entry_fax');
		$data['entry_company'] 				= $this->language->get('entry_company');
		$data['entry_company_image'] 		= $this->language->get('entry_company_image');
		$data['entry_address'] 				= $this->language->get('entry_address');
		$data['entry_address_2'] 			= $this->language->get('entry_address_2');
		$data['entry_pincode'] 				= $this->language->get('entry_pincode');
		$data['entry_city'] 				= $this->language->get('entry_city');
		$data['entry_country']				= $this->language->get('entry_country');
		$data['entry_zone'] 				= $this->language->get('entry_zone');
		$data['entry_newsletter'] 			= $this->language->get('entry_newsletter');
		$data['entry_password'] 			= $this->language->get('entry_password');
		$data['entry_confirm'] 				= $this->language->get('entry_confirm');
				
		$data['entry_officeopen'] 			= $this->language->get('entry_officeopen');
		$data['entry_officeclose'] 			= $this->language->get('entry_officeclose');
		$data['text_map'] 					= $this->language->get('text_map');
		$data['entry_jobcategory'] 			= $this->language->get('entry_jobcategory');
		$data['entry_package'] 				= $this->language->get('entry_package');

		$this->load->model('job/company');
		
		// GET COMPANY INFORMATION
		
		$company_info = $this->model_job_company->showCompany($this->company->getId());
		

		$data['company_id'] 			= $this->company->getId();
		$data['full_name'] 				=  $company_info['full_name'];
		$data['landline_phone'] 		=  $company_info['landline_phone'];
		$data['cell_phone'] 			=  $company_info['cell_phone'];
		$data['address'] 				=  $company_info['address'];
		$data['city'] 					=  $company_info['city'];
		$data['pincode'] 				=  $company_info['pincode'];
		$data['company_website'] 		=  $company_info['company_website'];
		$data['company_logo'] 			=  $company_info['company_logo'];
		$data['company_description'] 	=  $company_info['company_description'];
		$data['no_employees'] 			=  $company_info['no_employees'];


		$data['officeopen'] 			=  $company_info['officeopen'];
		$data['officeclose'] 			=  $company_info['officeclose'];
		$data['longitude'] 				=  $company_info['longitude'];
		$data['latitude'] 				=  $company_info['latitude'];


		$data['action'] = $this->url->link('company/editcompany');

		$this->load->model('catalog/category');

	

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
		}
		if(!empty($cat_name)) {
			$data['cat_name'] = $cat_name['name'];
		} else {
			$data['cat_name'] = '';
		}

		
		// GET IMAGE
		if(!empty($company_info['company_logo'])){
			$data['thumb'] = $this->model_tool_image->resize($company_info['company_logo'],45,45);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);
		}

		$data['zone_id'] 	=  $company_info['zone_id'];
		$data['country_id'] =  $company_info['country_id'];
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['full_name'])) {
			$data['error_full_name'] = $this->error['full_name'];
		} else {
			$data['error_full_name'] = '';
		}
		
		if (isset($this->error['landline_phone'])) {
			$data['error_landline_phone'] = $this->error['landline_phone'];
		} else {
			$data['error_landline_phone'] = '';
		}
		if (isset($this->error['company_logo'])) {
			$data['error_company_logo'] = $this->error['company_logo'];
		} else {
			$data['error_company_logo'] = '';
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

		if (isset($this->error['city'])) {
			$data['error_city'] = $this->error['city'];
		} else {
			$data['error_city'] = '';
		}
		
		if (isset($this->error['company_website'])) {
			$data['error_company_website'] = $this->error['company_website'];
		} else {
			$data['error_company_website'] = '';
		}
		
		if (isset($this->error['no_employees'])) {
			$data['error_no_employees'] = $this->error['no_employees'];
		} else {
			$data['error_no_employees'] = '';
		}
		
		
		
	

		if (isset($this->error['pincode'])) {
			$data['error_pincode'] = $this->error['pincode'];
		} else {
			$data['error_pincode'] = '';
		}

		if (isset($this->error['country'])) {
			$data['error_country'] = $this->error['country'];
		} else {
			$data['error_country'] = '';
		}

		if (isset($this->error['zone'])) {
			$data['error_zone'] = $this->error['zone'];
		} else {
			$data['error_zone'] = '';
		}

		if (isset($this->error['jobcategory'])) {
			$data['error_jobcategory'] = $this->error['jobcategory'];
		} else {
			$data['error_jobcategory'] = '';
		}
	
		if (isset($this->request->post['full_name'])) {
			$data['full_name'] = $this->request->post['full_name'];
		} 

		if (isset($this->request->post['lastname'])) {
			$data['lastname'] = $this->request->post['lastname'];
		} 
		
		if (isset($this->request->post['company_logo'])) {
			$data['company_logo'] = $this->request->post['company_logo'];
			if(!empty($this->request->post['company_logo'])){
				$data['thumb'] = $this->model_tool_image->resize($this->request->post['company_logo'],45,45);
			}
		} 
		
		if (isset($this->request->post['email'])) {
			$data['email'] = $this->request->post['email'];
		}

		if (isset($this->request->post['landline_phone'])) {
			$data['landline_phone'] = $this->request->post['landline_phone'];
		} 
		
		if (isset($this->request->post['cell_phone'])) {
			$data['cell_phone'] = $this->request->post['cell_phone'];
		}		
		
		if (isset($this->request->post['address'])) {
			$data['address'] = $this->request->post['address'];
		}
		
		if (isset($this->request->post['company_website'])) {
			$data['company_website'] = $this->request->post['company_website'];
		}
		
		if (isset($this->request->post['company_description'])) {
			$data['company_description'] = $this->request->post['company_description'];
		}
		
		if (isset($this->request->post['no_employees'])) {
			$data['no_employees'] = $this->request->post['no_employees'];
		} 

		if (isset($this->request->post['pincode'])) {
			$data['pincode'] = $this->request->post['pincode'];
		} elseif (isset($this->session->data['shipping_address']['pincode'])) {
			$data['pincode'] = $this->session->data['shipping_address']['pincode'];
		} 

		if (isset($this->request->post['city'])) {
			$data['city'] = $this->request->post['city'];
		} 

		if (isset($this->request->post['country_id'])) {
			$data['country_id'] = (int)$this->request->post['country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} 

		if (isset($this->request->post['zone_id'])) {
			$data['zone_id'] = (int)$this->request->post['zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} 

		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		if (isset($this->request->post['confirm'])) {
			$data['confirm'] = $this->request->post['confirm'];
		} else {
			$data['confirm'] = '';
		}
		
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			if ($information_info) {
				$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_account_id'), true), $information_info['title'], $information_info['title']);
			} else {
				$data['text_agree'] = '';
			}
		} else {
			$data['text_agree'] = '';
		}

		if (isset($this->request->post['agree'])) {
			$data['agree'] = $this->request->post['agree'];
		} else {
			$data['agree'] = false;
		}

		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['column_right'] 	= $this->load->controller('common/column_right');
		$data['content_top'] 	= $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] 		= $this->load->controller('common/footer');
		$data['header'] 		= $this->load->controller('common/header');
		$this->response->setOutput($this->load->view('company/editcompany', $data));
	}

	private function validate() {
				
		if ((utf8_strlen(trim($this->request->post['full_name'])) < 1) || (utf8_strlen(trim($this->request->post['full_name'])) > 320)) {
			$this->error['full_name'] = $this->language->get('error_full_name');
		}

	
		if ((utf8_strlen($this->request->post['landline_phone']) < 3) || (utf8_strlen($this->request->post['landline_phone']) > 32)) {
			$this->error['landline_phone'] = $this->language->get('error_landline_phone');
		}
		
		if ((utf8_strlen($this->request->post['cell_phone']) < 10) || (utf8_strlen($this->request->post['cell_phone']) > 10)) {
			$this->error['cell_phone'] = $this->language->get('error_cell_phone');
		}
		
		if ((utf8_strlen($this->request->post['company_logo']) == "")) {
			$this->error['company_logo'] = $this->language->get('error_company_logo');
		}
	
		if ((utf8_strlen(trim($this->request->post['address'])) < 3) || (utf8_strlen(trim($this->request->post['address'])) > 128)) {
			$this->error['address'] = $this->language->get('error_address');
		}

		if ((utf8_strlen(trim($this->request->post['city'])) < 2) || (utf8_strlen(trim($this->request->post['city'])) > 128)) {
			$this->error['city'] = $this->language->get('error_city');
		}
		
		if ((utf8_strlen(trim($this->request->post['company_website'])) < 9) || (utf8_strlen(trim($this->request->post['company_website'])) > 128)) {
			$this->error['company_website'] = $this->language->get('error_company_website');
		}
		
		
		
		if ((utf8_strlen(trim($this->request->post['no_employees'])) == '')) {
			$this->error['no_employees'] = $this->language->get('error_no_employees');
		}

		if ((utf8_strlen(trim($this->request->post['jobcategory'])) == '')) {
			$this->error['jobcategory'] = $this->language->get('error_jobcategory');
		}


		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

		if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['pincode'])) < 2 || utf8_strlen(trim($this->request->post['pincode'])) > 10)) {
			$this->error['pincode'] = $this->language->get('error_pincode');
		}

		if ($this->request->post['country_id'] == '') {
			$this->error['country'] = $this->language->get('error_country');
		}

		if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
			$this->error['zone'] = $this->language->get('error_zone');
		}
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('register', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');
			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}
		// Agree to terms
		if ($this->config->get('config_account_id')) {
			$this->load->model('catalog/information');
			$information_info = $this->model_catalog_information->getInformation($this->config->get('config_account_id'));
			if ($information_info && !isset($this->request->post['agree'])) {
				$this->error['warning'] = sprintf($this->language->get('error_agree'), $information_info['title']);
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
		$this->error['warning'] = $this->language->get('error_warning');
		}
		return !$this->error;
	}
	public function upload()
	{
		$this->load->language('tool/upload');
		$json = array();
		if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
			// Sanitize the filename
			$filename = basename(preg_replace('/[^a-zA-Z0-9\.\-\s+]/', '', html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8')));
			// Validate the filename length
			if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 64)) {
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
			if (!$json) {
				$targetDir = DIR_IMAGE.'catalog/';
				$file = $filename;
				$location = $targetDir.$file;
				$location1 = 'catalog/'.$file;
				move_uploaded_file($this->request->files['file']['tmp_name'], $location);
				$json['location1'] =$location1;
				$json['success'] = $this->language->get('text_upload');
			}
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
}