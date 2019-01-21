<?php
class ControllerJobMail extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('job/mail');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/mail');

		$this->getList();
	}

	public function add() {
		$this->load->language('job/mail');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/mail');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_job_mail->addMail($this->request->post);
						
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

			$this->response->redirect($this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('job/mail');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/mail');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			
			$this->model_job_mail->editMail($this->request->get['mail_id'], $this->request->post);
			
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

			$this->response->redirect($this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('job/mail');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('job/mail');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $mail_id) {
				$this->model_job_mail->deleteMail($mail_id);
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

			$this->response->redirect($this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true));
		}

		$this->getList();
	}
		
	protected function getList() {
		
		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'mail_id';
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
			'href' => $this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['add'] = $this->url->link('job/mail/add', 'token=' . $this->session->data['token'] . $url, true);
		$data['delete'] = $this->url->link('job/mail/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['mails'] = array();

		$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);
				
		$mail_total = $this->model_job_mail->getTotalMail($filter_data);
		$results = $this->model_job_mail->getMails($filter_data);

		foreach ($results as $result) {
			$data['mails'][] = array(
				'mail_id'   => $result['mail_id'],
				'name'      => $result['name'],
				'date_added'=> $result['date_added'],
				'edit'      => $this->url->link('job/mail/edit', 'token=' . $this->session->data['token'] . '&mail_id=' . $result['mail_id'] . $url, true)
			);
		}

		$data['heading_title'] 	= $this->language->get('heading_title');
		$data['token'] 			= $this->session->data['token'];
		$data['text_list'] 		= $this->language->get('text_list');
		$data['text_no_results']= $this->language->get('text_no_results');
		$data['text_confirm'] 	= $this->language->get('text_confirm');
		$data['text_enable'] 	= $this->language->get('text_enable');
		$data['text_disable'] 	= $this->language->get('text_disable');
		$data['text_select'] 	= $this->language->get('text_select');
		$data['text_none'] 		= $this->language->get('text_none');

		$data['column_name']    = $this->language->get('column_name');
		$data['column_date'] 	= $this->language->get('column_date');
		$data['column_action'] 	= $this->language->get('column_action');	
		
		$data['button_add'] 	= $this->language->get('button_add');
		$data['button_edit'] 	= $this->language->get('button_edit');
		$data['button_delete'] 	= $this->language->get('button_delete');
		$data['button_filter'] 	= $this->language->get('button_filter');

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

		$data['sort_name']     = $this->url->link('job/mail', 'token=' . $this->session->data['token'] . '&sort=name' . $url, true);
		$data['sort_date']     = $this->url->link('job/mail', 'token=' . $this->session->data['token'] . '&sort=date' . $url, true);

		$url = '';
		
		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		$pagination = new Pagination();
		$pagination->total = $mail_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($mail_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($mail_total - $this->config->get('config_limit_admin'))) ? $mail_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $mail_total, ceil($mail_total / $this->config->get('config_limit_admin')));
				
		$data['sort'] 			  = $sort;
		$data['order'] 			  = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/mail_list', $data));
	}

	protected function getForm() {
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_form'] 	= !isset($this->request->get['mail_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] 	= $this->language->get('text_enabled');
		$data['text_disabled'] 	= $this->language->get('text_disabled');
		$data['text_default'] 	= $this->language->get('text_default');
		$data['text_percent'] 	= $this->language->get('text_percent');
		$data['text_amount'] 	= $this->language->get('text_amount');
		$data['text_select'] 	= $this->language->get('text_select');
		$data['text_none'] 		= $this->language->get('text_none');
		$data['text_enable'] 	= $this->language->get('text_enable');
		$data['text_disable'] 	= $this->language->get('text_disable');
		
		$data['lable_type'] 	= $this->language->get('lable_type');
		$data['lable_name'] 	= $this->language->get('lable_name');
		$data['lable_message']  = $this->language->get('lable_message');
		$data['lable_subject'] 	= $this->language->get('lable_subject');
		$data['lable_status'] 	= $this->language->get('lable_status');

		$data['entry_type'] 	= $this->language->get('entry_type');
		$data['entry_name'] 	= $this->language->get('entry_name');
		$data['entry_message']  = $this->language->get('entry_message');
		$data['entry_subject'] 	= $this->language->get('entry_subject');
		$data['entry_status'] 	= $this->language->get('entry_status');
		
		$data['tab_mail'] 		= $this->language->get('tab_mail');

		$data['button_save'] 	= $this->language->get('button_save');
		$data['button_cancel'] 	= $this->language->get('button_cancel');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}
		
		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
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
			'href' => $this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true)
		);
		
		$data['companytypes'] = array();
				
		$data['companytypes'][] = array(
			'companytype'    => $this->language->get('text_companyignupmail'),
			'value' 		=> 'company signup email'
		);
		
		$data['companytypes'][] = array(
			'companytype'    => $this->language->get('text_growerapprovemail'),
			'value' 		=> 'company approve email'
		);

		$data['companytypes'][] = array(
			'companytype'    => $this->language->get('text_adminmail'),
			'value' 		=> 'company submitjob admin email'
		);

		$data['companytypes'][] = array(
			'companytype'    => $this->language->get('text_employignupmail'),
			'value' 		=> 'employ signup email'
		);

		$data['companytypes'][] = array(
			'companytype'     => $this->language->get('text_applyignupmail'),
			'value' 		  => 'apply Job email'
		);


		$data['companytypes'][] = array(
			'companytype'     => $this->language->get('text_companyforgottenemail'),
			'value' 		  => 'company forgotten email'
		);

		$data['companytypes'][] = array(
			'companytype'     => $this->language->get('text_employforgottenmail'),
			'value' 		  => 'employ forgotten mail'
		);

		$data['companytypes'][] = array(
			'companytype'     => $this->language->get('text_companyapprove'),
			'value' 		  => 'company approve mail'
		);

		$data['companytypes'][] = array(
			'companytype'     => $this->language->get('text_employapprove'),
			'value' 		  => 'employ approve mail'
		);
				
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();	
		

		if (!isset($this->request->get['mail_id'])) {
			$data['action'] = $this->url->link('job/mail/add', 'token=' . $this->session->data['token'] . $url, true);
		} else {
			$data['action'] = $this->url->link('job/mail/edit', 'token=' . $this->session->data['token'] . '&mail_id=' . $this->request->get['mail_id'] . $url, true);
		}

		$data['cancel'] = $this->url->link('job/mail', 'token=' . $this->session->data['token'] . $url, true);

		if (isset($this->request->get['mail_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$mail_info=$this->model_job_mail->getMail($this->request->get['mail_id']);
			
		}
		$data['token'] = $this->session->data['token'];
		
		if (isset($this->request->post['seller_mail'])) {
			$data['seller_mail'] = $this->request->post['seller_mail'];
		} elseif (isset($mail_info)) {
			$data['seller_mail'] = $this->model_job_mail->getMailLanguage($this->request->get['mail_id']);
		} else {
			$data['seller_mail'] = array();
		}

		//print_r($data['seller_mail']);die();
		
		if (isset($this->request->post['companytype'])) {
			$data['companytype'] = $this->request->post['companytype'];
		} elseif (!empty($mail_info['companytype'])) {
			$data['companytype'] = $mail_info['companytype'];
		} else {
			$data['companytype'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($mail_info['status'])) {
			$data['status'] = $mail_info['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('job/mail_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'job/mail')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		foreach ($this->request->post['seller_mail'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}
		}
		
		return !$this->error;
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'job/mail')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		return !$this->error;
	}
			
}