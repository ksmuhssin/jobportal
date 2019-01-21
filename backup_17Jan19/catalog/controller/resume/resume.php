<?php
class ControllerResumeResume extends Controller {
	private $error = array();

	public function index() {
		
		$this->load->language('resume/resume');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/moment.js');
		$this->document->addScript('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.js');
		$this->document->addStyle('catalog/view/javascript/jquery/datetimepicker/bootstrap-datetimepicker.min.css');

		$this->load->model('job/resume');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			
			$resume_id = $this->model_job_resume->addResume($this->request->post);

			unset($this->session->data['guest']);

			$this->response->redirect($this->url->link('resume/resumesuccess'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_account'),
			'href' => $this->url->link('account/account', '', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_resume'),
			'href' => $this->url->link('resume/resume', '', true)
		);

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_account_already'] = sprintf($this->language->get('text_account_already'), $this->url->link('resume/login', '', true));
		$data['text_your_details']   = $this->language->get('text_your_details');
		$data['text_your_address']   = $this->language->get('text_your_address');
		$data['text_your_password']  = $this->language->get('text_your_password');
		$data['text_newsletter']     = $this->language->get('text_newsletter');
		$data['text_yes']            = $this->language->get('text_yes');
		$data['text_no']             = $this->language->get('text_no');
		$data['text_select']         = $this->language->get('text_select');
		$data['text_none']           = $this->language->get('text_none');
		$data['text_loading']        = $this->language->get('text_loading');
		$data['text_enable']         = $this->language->get('text_enable');
		$data['text_disable']        = $this->language->get('text_disable');
		$data['text_full_time']      = $this->language->get('text_full_time');
		$data['text_part_time']      = $this->language->get('text_part_time');

		$data['entry_jobtype']       = $this->language->get('entry_jobtype');
		$data['entry_customer']      = $this->language->get('entry_customer');
		$data['entry_status']        = $this->language->get('entry_status');
		$data['entry_image']         = $this->language->get('entry_image');
		$data['entry_resume']        = $this->language->get('entry_resume');
		$data['button_continue']     = $this->language->get('button_continue');
		$data['button_upload']       = $this->language->get('button_upload');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['jobtype_id'])) {
			$data['error_jobtype_id'] = $this->error['jobtype_id'];
		} else {
			$data['error_jobtype_id'] = '';
		}
		
		if (isset($this->error['customer'])) {
			$data['error_customer'] = $this->error['customer'];
		} else {
			$data['error_customer'] = '';
		}
		
		if (isset($this->error['resume'])) {
			$data['error_resume'] = $this->error['resume'];
		} else {
			$data['error_resume'] = '';
		}
		

		$data['action'] = $this->url->link('resume/resume', '', true);
		
		$this->load->model('tool/image');
		
			$data['thumb'] = $this->model_tool_image->resize('placeholder.png',45,45);
		
		if (isset($this->request->post['resume'])) {
			$data['resume'] = $this->request->post['resume'];
			if(!empty($this->request->post['resume']))
			{
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['resume'],45,45);
			}
		} else {
			$data['resume'] = '';
			

		}

		if (isset($this->request->post['customer'])) {
			$data['customer'] = $this->request->post['customer'];
		} else {
			$data['customer'] = '';
		}
		
		if (isset($this->request->post['jobtype_id'])) {
			$data['jobtype_id'] = $this->request->post['jobtype_id'];
		} else {
			$data['jobtype_id'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} else {
			$data['status'] = '';
		}
	
		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('resume', (array)$this->config->get('config_captcha_page'))) {
			$data['captcha'] = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha'), $this->error);
		} else {
			$data['captcha'] = '';
		}

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$this->response->setOutput($this->load->view('resume/resume', $data));
	}

	private function validate() {
		
		if ((utf8_strlen(trim($this->request->post['customer'])) < 2) || (utf8_strlen(trim($this->request->post['customer'])) > 128)) {
			$this->error['customer'] = $this->language->get('error_customer');
		}
		
				
		if ((utf8_strlen($this->request->post['resume']) == "")) {
			$this->error['resume'] = $this->language->get('error_resume');
		}
		
		if ($this->request->post['jobtype_id'] == 0) {
			$this->error['jobtype_id'] = $this->language->get('error_jobtype_id');
		}


		// Captcha
		if ($this->config->get($this->config->get('config_captcha') . '_status') && in_array('resume', (array)$this->config->get('config_captcha_page'))) {
			$captcha = $this->load->controller('extension/captcha/' . $this->config->get('config_captcha') . '/validate');

			if ($captcha) {
				$this->error['captcha'] = $captcha;
			}
		}	
		return !$this->error;
	}
	
	public function upload() {
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

}