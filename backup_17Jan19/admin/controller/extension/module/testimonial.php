<?php
class ControllerExtensionModuleTestimonial extends Controller {
	private $error = array(); 
	
	public function index() {   
		$this->language->load('extension/module/testimonial');

		$this->document->setTitle($this->language->get('heading_title'));
		
		$this->load->model('extension/module');
				
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			if (!isset($this->request->get['module_id'])) {
				$this->model_extension_module->addModule('testimonial', $this->request->post);
			} else {
				$this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
			}
						
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
		}
				
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_content_top'] = $this->language->get('text_content_top');
		$data['text_content_bottom'] = $this->language->get('text_content_bottom');		
		$data['text_column_left'] = $this->language->get('text_column_left');
		$data['text_column_right'] = $this->language->get('text_column_right');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_layout1'] = $this->language->get('text_layout1');
		$data['text_layout2'] = $this->language->get('text_layout2');

		$data['label_limit'] = $this->language->get('label_limit');
		$data['label_name'] = $this->language->get('label_name');
		$data['label_status'] = $this->language->get('label_status');
		$data['label_heading_color'] = $this->language->get('label_heading_color');
		$data['label_name_color'] = $this->language->get('label_name_color');
		$data['label_bgimage'] = $this->language->get('label_bgimage');
		$data['label_bgwidth'] = $this->language->get('label_bgwidth');
		$data['label_des_color'] = $this->language->get('label_des_color');
		$data['label_btn_bg'] = $this->language->get('label_btn_bg');
		$data['label_btn_color'] = $this->language->get('label_btn_color');
		$data['label_btn_bghov'] = $this->language->get('label_btn_bghov');
		$data['label_btn_hovcolor'] = $this->language->get('label_btn_hovcolor');
		$data['label_content_bg'] = $this->language->get('label_content_bg');
		$data['label_next_prev'] = $this->language->get('label_next_prev');
		$data['label_next_prev_bg'] = $this->language->get('label_next_prev_bg');
		$data['label_layout'] = $this->language->get('label_layout');

		$data['entry_limit'] = $this->language->get('entry_limit');
		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_heading_color'] = $this->language->get('entry_heading_color');
		$data['entry_name_color'] = $this->language->get('entry_name_color');
		$data['entry_bgimage'] = $this->language->get('entry_bgimage');
		$data['entry_bgwidth'] = $this->language->get('entry_bgwidth');
		$data['entry_des_color'] = $this->language->get('entry_des_color');
		$data['entry_btn_bg'] = $this->language->get('entry_btn_bg');
		$data['entry_btn_bghov'] = $this->language->get('entry_btn_bghov');
		$data['entry_btn_color'] = $this->language->get('entry_btn_color');
		$data['entry_btn_hovcolor'] = $this->language->get('entry_btn_hovcolor');
		$data['entry_content_bg'] = $this->language->get('entry_content_bg');
		$data['entry_next_prev'] = $this->language->get('entry_next_prev');
		$data['entry_next_prev_bg'] = $this->language->get('entry_next_prev_bg');
		$data['entry_layout'] = $this->language->get('entry_layout');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_color'] = $this->language->get('tab_color');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_module_add'] = $this->language->get('button_module_add');
		$data['button_remove'] = $this->language->get('button_remove');
		
		
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
		

		
  		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_module'),
			'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'], 'SSL')
		);

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/testimonial', 'token=' . $this->session->data['token'], 'SSL')
			);
		} else {
			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/module/testimonial', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL')
			);			
		}
		
		if (!isset($this->request->get['module_id'])) {
			$data['action'] = $this->url->link('extension/module/testimonial', 'token=' . $this->session->data['token'], 'SSL');
		} else {
			$data['action'] = $this->url->link('extension/module/testimonial', 'token=' . $this->session->data['token'] . '&module_id=' . $this->request->get['module_id'], 'SSL');
		}
		
		$data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);
		
		if (isset($this->request->get['module_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$module_info = $this->model_extension_module->getModule($this->request->get['module_id']);
		}
		
		if (isset($this->request->post['name'])) {
			$data['name'] = $this->request->post['name'];
		} elseif (!empty($module_info)) {
			$data['name'] = $module_info['name'];
		} else {
			$data['name'] = '';
		}
		
		if (isset($this->request->post['limit'])) {
			$data['limit'] = $this->request->post['limit'];
		} elseif (!empty($module_info)) {
			$data['limit'] = $module_info['limit'];
		} else {
			$data['limit'] = 5;
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($module_info)) {
			$data['status'] = $module_info['status'];
		} else {
			$data['status'] = '';
		}
		
		/*new code*/
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (isset($module_info['image'])) {
			$data['image'] = $module_info['image'];
		} else {
			$data['image'] = '';
		}
		
		
		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($module_info) && is_file(DIR_IMAGE . $module_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($module_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		
		if (isset($this->request->post['testi_bgheight'])) {
			$data['testi_bgheight'] = $this->request->post['testi_bgheight'];
		} elseif (isset($module_info['testi_bgheight'])) {
			$data['testi_bgheight'] = $module_info['testi_bgheight'];
		} else {
			$data['testi_bgheight'] = '';
		}
		
		if (isset($this->request->post['testi_bgwidth'])) {
			$data['testi_bgwidth'] = $this->request->post['testi_bgwidth'];
		} elseif (isset($module_info['testi_bgwidth'])) {
			$data['testi_bgwidth'] = $module_info['testi_bgwidth'];
		} else {
			$data['testi_bgwidth'] = '';
		}
		
		if (isset($this->request->post['testi_headingcolor'])) {
			$data['testi_headingcolor'] = $this->request->post['testi_headingcolor'];
		} elseif (isset($module_info['testi_headingcolor'])) {
			$data['testi_headingcolor'] = $module_info['testi_headingcolor'];
		} else {
			$data['testi_headingcolor'] = '';
		}
		
		if (isset($this->request->post['testi_namecolor'])) {
			$data['testi_namecolor'] = $this->request->post['testi_namecolor'];
		} elseif (isset($module_info['testi_namecolor'])) {
			$data['testi_namecolor'] = $module_info['testi_namecolor'];
		} else {
			$data['testi_namecolor'] = '';
		}
		
		if (isset($this->request->post['testi_descolor'])) {
			$data['testi_descolor'] = $this->request->post['testi_descolor'];
		} elseif (isset($module_info['testi_descolor'])) {
			$data['testi_descolor'] = $module_info['testi_descolor'];
		} else {
			$data['testi_descolor'] = '';
		}
		
		if (isset($this->request->post['testi_btnbg'])) {
			$data['testi_btnbg'] = $this->request->post['testi_btnbg'];
		} elseif (isset($module_info['testi_btnbg'])) {
			$data['testi_btnbg'] = $module_info['testi_btnbg'];
		} else {
			$data['testi_btnbg'] = '';
		}
		
		if (isset($this->request->post['testi_btnbghov'])) {
			$data['testi_btnbghov'] = $this->request->post['testi_btnbghov'];
		} elseif (isset($module_info['testi_btnbghov'])) {
			$data['testi_btnbghov'] = $module_info['testi_btnbghov'];
		} else {
			$data['testi_btnbghov'] = '';
		}
		
		if (isset($this->request->post['testi_btncolor'])) {
			$data['testi_btncolor'] = $this->request->post['testi_btncolor'];
		} elseif (isset($module_info['testi_btncolor'])) {
			$data['testi_btncolor'] = $module_info['testi_btncolor'];
		} else {
			$data['testi_btncolor'] = '';
		}
		
		if (isset($this->request->post['testi_btnhovcolor'])) {
			$data['testi_btnhovcolor'] = $this->request->post['testi_btnhovcolor'];
		} elseif (isset($module_info['testi_btnhovcolor'])) {
			$data['testi_btnhovcolor'] = $module_info['testi_btnhovcolor'];
		} else {
			$data['testi_btnhovcolor'] = '';
		}
		
		
		if (isset($this->request->post['testi_contentbg'])) {
			$data['testi_contentbg'] = $this->request->post['testi_contentbg'];
		} elseif (isset($module_info['testi_contentbg'])) {
			$data['testi_contentbg'] = $module_info['testi_contentbg'];
		} else {
			$data['testi_contentbg'] = '';
		}
		
		
		if (isset($this->request->post['testi_nextprev'])) {
			$data['testi_nextprev'] = $this->request->post['testi_nextprev'];
		} elseif (isset($module_info['testi_nextprev'])) {
			$data['testi_nextprev'] = $module_info['testi_nextprev'];
		} else {
			$data['testi_nextprev'] = '';
		}
		
		
		if (isset($this->request->post['testi_nextprev_bg'])) {
			$data['testi_nextprev_bg'] = $this->request->post['testi_nextprev_bg'];
		} elseif (isset($module_info['testi_nextprev_bg'])) {
			$data['testi_nextprev_bg'] = $module_info['testi_nextprev_bg'];
		} else {
			$data['testi_nextprev_bg'] = '';
		}
		
		
		/*new code*/

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/testimonial', $data));
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/testimonial')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 64)) {
			$this->error['name'] = $this->language->get('error_name');
		}
				
		return !$this->error;
	}
}
?>
