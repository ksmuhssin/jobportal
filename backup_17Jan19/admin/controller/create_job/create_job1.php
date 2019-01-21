<?php
class ControllerCreateJobCreateJob extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('create_job/create_job');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('create_job/create_job');

		$this->getList();
	}

	public function add() {
		$this->load->language('create_job/create_job');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('create_job/create_job');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {

			$this->model_create_job_create_job->addJob($this->request->post);

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

			$this->response->redirect($this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('create_job/create_job');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('create_job/create_job');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $job_id) {
				$this->model_create_job_create_job->deleteJob($job_id);
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

			$this->response->redirect($this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}

	public function edit() {
		$this->load->language('create_job/create_job');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('create_job/create_job');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_create_job_create_job->editJob($this->request->get['job_id'], $this->request->post);

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

			$this->response->redirect($this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	protected function getList() {
		
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
			'href' => $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('create_job/create_job/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('create_job/create_job/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['jobs'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');
		
		$job_total = $this->model_create_job_create_job->getTotalJobs($filter_data);
		$job_info = $this->model_create_job_create_job->getJobs($filter_data);

		foreach($job_info as $result) {

			if (is_file(DIR_IMAGE . $result['banner'])) {
				$image = $this->model_tool_image->resize($result['banner'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$data['jobs'][] = array(
				'job_id' 		=> $result['job_id'],
				'title' 	=> $result['title'],
				'image' 		=> $image,
				'edit'      	=> $this->url->link('create_job/create_job/edit', 'token=' . $this->session->data['token'] . '&job_id=' . $result['job_id'] . $url, true)

			);
		}



		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['token'] 		= $this->session->data['token'];
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_banner'] = $this->language->get('entry_banner');

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

		if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

	
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_sort_order'] = $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . '&sort=sort_order' . $url, true);

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $job_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($job_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($job_total - $this->config->get('config_limit_admin'))) ? $job_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $job_total, ceil($job_total / $this->config->get('config_limit_admin')));

		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('create_job/create_job_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['job_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');
		$data['text_fultime'] = $this->language->get('text_fultime');
		$data['text_parttime'] = $this->language->get('text_parttime');
		$data['text_upload'] = $this->language->get('text_upload');
		$data['tab_general'] 			= $this->language->get('tab_general');
		$data['tab_data'] 			= $this->language->get('tab_data');
		
		$data['entry_email'] = $this->language->get('entry_email');
		$data['entry_jobtype_id'] = $this->language->get('entry_jobtype_id');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_title'] = $this->language->get('entry_title');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_salary'] = $this->language->get('entry_salary');
		$data['entry_book_format'] = $this->language->get('entry_book_format');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_description'] = $this->language->get('description');
		$data['entry_category'] = $this->language->get('entry_category');
		$data['entry_banner'] = $this->language->get('entry_banner');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_application'] = $this->language->get('entry_application');
		$data['entry_experience'] = $this->language->get('entry_experience');
		
		
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_upload'] = $this->language->get('button_upload');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['text_none'] = $this->language->get('text_none');
		$data['token'] 		= $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true)
		);

		if (!isset($this->request->get['job_id'])) {
			$data['action'] = $this->url->link('create_job/create_job/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('create_job/create_job/edit', 'token=' . $this->session->data['token'] . '&job_id=' . $this->request->get['job_id'] . $url, true);
		}

		$data['book_formates'][] = array(
			'value'  		=> $this->language->get('text_pdf'),
			'book_format' 		=> 'PDF'
		);
		$data['book_formates'][] = array(
			'value'  		=> $this->language->get('text_flash'),
			'book_format' 		=> 'FLASH'
		);
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		$data['cancel'] = $this->url->link('create_job/create_job', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['job_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$job_info = $this->model_create_job_create_job->getJob($this->request->get['job_id']);
		}

		if (isset($this->request->post['category_id'])) {
			$data['category_id'] = $this->request->post['category_id'];
		} elseif (!empty($job_info)) {
			$data['category_id'] = $job_info['category_id'];
		} else {
			$data['category_id'] = 0;
		}

		if (isset($this->request->post['category'])) {
			$data['category'] = $this->request->post['category'];
		} elseif (!empty($job_info)) {
			$this->load->model('job/category');
			$category_info = $this->model_job_category->getCategory($job_info['category_id']);

			if ($category_info) {
				$data['category'] = $category_info['name'];
			} else {
				$data['category'] = '';
			}
		} else {
			$data['category'] = '';
		}

		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($job_info)) {
			$data['location'] = $job_info['location'];
		} else {
			$data['location'] = '';
		}

		if (isset($this->request->post['url'])) {
			$data['url'] = $this->request->post['url'];
		} elseif (!empty($job_info)) {
			$data['url'] = $job_info['url'];
		} else {
			$data['url'] = '';
		}

		if (isset($this->request->post['salary'])) {
			$data['salary'] = $this->request->post['salary'];
		} elseif (!empty($job_info)) {
			$data['salary'] = $job_info['salary'];
		} else {
			$data['salary'] = '';
		}

		if (isset($this->request->post['banner'])) {
			$data['banner'] = $this->request->post['banner'];
		} elseif (!empty($job_info)) {
			$data['banner'] = $job_info['banner'];
		} else {
			$data['banner'] = '';
		}
		
		$this->load->model('tool/image');
		if (isset($this->request->post['banner']) && is_file(DIR_IMAGE . $this->request->post['banner'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['banner'], 100, 100);
		} elseif (!empty($job_info) && is_file(DIR_IMAGE . $job_info['banner'])) {
			$data['thumb'] = $this->model_tool_image->resize($job_info['banner'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['jobtype_id'])) {
			$data['jobtype_id'] = $this->request->post['jobtype_id'];
		} elseif (!empty($job_info)) {
			$data['jobtype_id'] = $job_info['jobtype_id'];
		} else {
			$data['jobtype_id'] = '';
		}

		if (isset($this->request->post['job_desc'])) {
			$data['job_desc'] = $this->request->post['job_desc'];
		} elseif (isset($this->request->get['job_id'])) {
			$data['job_desc'] = $this->model_create_job_create_job->getJobDescriptions($this->request->get['job_id']);
		} else {
			$data['job_desc'] = array(0);
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('create_job/create_job_form', $data));
	}
	
	public function upload() {
		$this->load->language('create_job/create_job');

		$json = array();

		if (!$json) {
			if (!empty($this->request->files['file']['name']) && is_file($this->request->files['file']['tmp_name'])) {
				// Sanitize the filename
				$filename = basename(html_entity_decode($this->request->files['file']['name'], ENT_QUOTES, 'UTF-8'));
            
				// Validate the filename length
				if ((utf8_strlen($filename) < 3) || (utf8_strlen($filename) > 128)) {
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
		}

		if (!$json) {
			$targetDir = DIR_IMAGE.'pdf/';
			$file = $filename . '.' . token(32);
			$location = $targetDir.$file;
			$location1 = 'pdf/'.$file;
			move_uploaded_file($this->request->files['file']['tmp_name'],$location);
			$json['filename'] = $file;
			$json['mask'] = $location1;
			$json['success'] = $this->language->get('text_upload');
		}




		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'create_job/create_job')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		/*if ((utf8_strlen($this->request->post['description']) < 2) || (utf8_strlen($this->request->post['description']) > 64)) {
			$this->error['description'] = $this->language->get('error_description');
		}*/

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'create_job/create_job')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		$this->load->model('create_job/create_job');

		return !$this->error;
	}
	public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name'])) {
			$this->load->model('create_job/create_job');

			$filter_data = array(
				'filter_name' => $this->request->get['filter_name'],
				'sort'        => 'name',
				'order'       => 'ASC',
				'start'       => 0,
				'limit'       => 5
			);

			$results = $this->model_create_job_create_job->getJobs($filter_data);

			foreach ($results as $result) {
				$json[] = array(
					'job_id' => $result['job_id'],
					'name'        => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
				);
			}
		}

		$sort_order = array();

		foreach ($json as $key => $value) {
			$sort_order[$key] = $value['name'];
		}

		array_multisort($sort_order, SORT_ASC, $json);

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

}


