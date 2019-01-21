<?php
class ControllerCommonTheme extends Controller {
	private $error = array();
		
	public function index() {
		$this->load->model('setting/setting');
		
		$this->load->language('common/theme');
		$this->document->setTitle($this->language->get('heading_title'));
		
		$data['heading_title'] 			 = $this->language->get('heading_title');
		$data['text_yes'] 				 = $this->language->get('text_yes');
		$data['text_no'] 				 = $this->language->get('text_no');
		$data['text_edit'] 				 = $this->language->get('text_edit');
		$data['text_form'] 				 = $this->language->get('text_form');
		$data['text_default']            = $this->language->get('text_default');
		$data['text_enable']             = $this->language->get('text_enable');
		$data['text_disable']            = $this->language->get('text_disable');
		$data['text_none'] 				  = $this->language->get('text_none');
		$data['text_select']              = $this->language->get('text_select');
		$data['text_header1']             = $this->language->get('text_header1');
		$data['text_header2']             = $this->language->get('text_header2');
		$data['text_header3']             = $this->language->get('text_header3');
		$data['text_header4']             = $this->language->get('text_header4');
		$data['text_footer1']             = $this->language->get('text_footer1');
		$data['text_footer2']             = $this->language->get('text_footer2');
		$data['text_footer3']             = $this->language->get('text_footer3');
		$data['text_footer4']             = $this->language->get('text_footer4');
		$data['text_testimonial1']        = $this->language->get('text_testimonial1');
		$data['text_testimonial2']        = $this->language->get('text_testimonial2');
		$data['text_search1']        	  = $this->language->get('text_search1');
		$data['text_search2']        	  = $this->language->get('text_search2');
		$data['text_jobcategory1']        = $this->language->get('text_jobcategory1');
		$data['text_jobcategory2']        = $this->language->get('text_jobcategory2');

		$data['tab_setting']             = $this->language->get('tab_setting');
		$data['tab_header']              = $this->language->get('tab_header');
		$data['tab_footer']              = $this->language->get('tab_footer');
		$data['tab_search']              = $this->language->get('tab_search');
		$data['tab_jobcategory']         = $this->language->get('tab_jobcategory');
		$data['tab_testimonial']         = $this->language->get('tab_testimonial');
		$data['tab_footerelement']       = $this->language->get('tab_footerelement');
		
		$data['button_save']             = $this->language->get('button_save');
		$data['button_add']              = $this->language->get('button_add');
		$data['button_remove']           = $this->language->get('button_remove');
		$data['button_cancel']           = $this->language->get('button_cancel');
		$data['tab_socialmedia'] 		 = $this->language->get('tab_socialmedia');
		
		$data['lable_footericon'] 		= $this->language->get('lable_footericon');
		$data['lable_aboutdes'] 		= $this->language->get('lable_aboutdes');
		$data['lable_title'] 			= $this->language->get('lable_title');
		$data['lable_phoneno'] 			= $this->language->get('lable_phoneno');
		$data['lable_mobile'] 			= $this->language->get('lable_mobile');
		$data['lable_email'] 			= $this->language->get('lable_email');
		$data['lable_address2'] 		= $this->language->get('lable_address2');
		$data['lable_fburl'] 			= $this->language->get('lable_fburl');
		$data['lable_google'] 			= $this->language->get('lable_google');
		$data['lable_twet'] 			= $this->language->get('lable_twet');
		$data['lable_in'] 				= $this->language->get('lable_in');
		$data['lable_instagram'] 		= $this->language->get('lable_instagram');
		$data['lable_pinterest'] 		= $this->language->get('lable_pinterest');
		$data['lable_youtube'] 			= $this->language->get('lable_youtube');
		$data['lable_blogger'] 			= $this->language->get('lable_blogger');
		$data['lable_skype'] 			= $this->language->get('lable_skype');
		$data['lable_mapcode'] 			= $this->language->get('lable_mapcode');
		$data['lable_titlef'] 			= $this->language->get('lable_titlef');
		$data['lable_flicker'] 			= $this->language->get('lable_flicker');
		$data['lable_textuseful'] 		= $this->language->get('lable_textuseful');
		$data['lable_link'] 			= $this->language->get('lable_link');
		$data['lable_name']             = $this->language->get('lable_name');
		$data['lable_text']             = $this->language->get('lable_text');

		$data['entry_footericon'] 		 = $this->language->get('entry_footericon');
		$data['entry_aboutdes'] 		= $this->language->get('entry_aboutdes');
		$data['entry_title'] 			= $this->language->get('entry_title');
		$data['entry_phoneno'] 			= $this->language->get('entry_phoneno');
		$data['entry_mobile'] 			= $this->language->get('entry_mobile');
		$data['entry_email'] 			= $this->language->get('entry_email');
		$data['entry_address2'] 		= $this->language->get('entry_address2');
		$data['entry_fburl'] 			= $this->language->get('entry_fburl');
		$data['entry_google'] 			= $this->language->get('entry_google');
		$data['entry_twet'] 			= $this->language->get('entry_twet');
		$data['entry_in'] 				= $this->language->get('entry_in');
		$data['entry_instagram'] 		= $this->language->get('entry_instagram');
		$data['entry_pinterest'] 		= $this->language->get('entry_pinterest');
		$data['entry_youtube'] 			= $this->language->get('entry_youtube');
		$data['entry_blogger'] 			= $this->language->get('entry_blogger');
		$data['entry_skype'] 			= $this->language->get('entry_skype');
		$data['entry_mapcode'] 			= $this->language->get('entry_mapcode');
		$data['entry_titlef'] 			= $this->language->get('entry_titlef');
		$data['entry_flicker'] 			= $this->language->get('entry_flicker');
		$data['entry_textuseful'] 		= $this->language->get('entry_textuseful');
		$data['entry_link'] 			= $this->language->get('entry_link');
		$data['entry_name']              = $this->language->get('entry_name');
		$data['entry_text']              = $this->language->get('entry_text');
		$data['entry_package']          = $this->language->get('entry_package');
		
		$data['help_category'] 			= $this->language->get('help_category');
		$data['token']                  = $this->session->data['token'];
		
		$data['button_image_add'] 		= $this->language->get('button_image_add');
		$data['button_save'] 			= $this->language->get('button_save');
		$data['button_remove'] 			= $this->language->get('button_remove');
		$data['button_add'] 			= $this->language->get('button_add');
		$data['button_cancel'] 			= $this->language->get('button_cancel');
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('jobportal', $this->request->post);
			
			//print_r($this->request->post);die();
			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('common/theme', 'token=' . $this->session->data['token'] . '&type=shipping', true));
		}
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('common/theme', 'token=' . $this->session->data['token'], true)
		);
		
		$data['action'] = $this->url->link('common/theme', 'token=' . $this->session->data['token'], true);

		$data['cancel'] = $this->url->link('common/theme', 'token=' . $this->session->data['token'], true);

		$data['token'] = $this->session->data['token'];
		
		$this->load->model('localisation/language');
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		///// Setting /////
		if (isset($this->request->post['jobportal_package'])) {
			$data['jobportal_package'] = $this->request->post['jobportal_package'];
		} else {
			$data['jobportal_package'] = $this->config->get('jobportal_package');
		}
		
		if (isset($this->request->post['jobportal_header'])) {
			$data['jobportal_header'] = $this->request->post['jobportal_header'];
		} else {
			$data['jobportal_header'] = $this->config->get('jobportal_header');
		}
		
		if (isset($this->request->post['jobportal_footer'])) {
			$data['jobportal_footer'] = $this->request->post['jobportal_footer'];
		} else {
			$data['jobportal_footer'] = $this->config->get('jobportal_footer');
		}
        
        if (isset($this->request->post['jobportal_testimonial'])) {
			$data['jobportal_testimonial'] = $this->request->post['jobportal_testimonial'];
		} else {
			$data['jobportal_testimonial'] = $this->config->get('jobportal_testimonial');
		}
        
        if (isset($this->request->post['jobportal_search'])) {
			$data['jobportal_search'] = $this->request->post['jobportal_search'];
		} else {
			$data['jobportal_search'] = $this->config->get('jobportal_search');
		}
        
        if (isset($this->request->post['jobportal_jobcategory'])) {
			$data['jobportal_jobcategory'] = $this->request->post['jobportal_jobcategory'];
		} else {
			$data['jobportal_jobcategory'] = $this->config->get('jobportal_jobcategory');
		}
        
		if (isset($this->request->post['jobportal_aboutdes'])) {
			$data['jobportal_aboutdes'] = $this->request->post['jobportal_aboutdes'];
		} else {
			$data['jobportal_aboutdes'] = $this->config->get('jobportal_aboutdes');
		}
        
		if (isset($this->request->post['jobportal_title'])) {
			$data['jobportal_title'] = $this->request->post['jobportal_title'];
		} else {
			$data['jobportal_title'] = $this->config->get('jobportal_title');
		}
		
		if (isset($this->request->post['jobportal_phoneno'])) {
			$data['jobportal_phoneno'] = $this->request->post['jobportal_phoneno'];
		} else {
			$data['jobportal_phoneno'] = $this->config->get('jobportal_phoneno');
		}
		
		if (isset($this->request->post['jobportal_mobile '])) {
			$data['jobportal_mobile'] = $this->request->post['jobportal_mobile'];
		} else {
			$data['jobportal_mobile'] = $this->config->get('jobportal_mobile');
		}
		
		
		if (isset($this->request->post['jobportal_email_soci '])) {
			$data['jobportal_email_soci'] = $this->request->post['jobportal_email_soci'];
		} else {
			$data['jobportal_email_soci'] = $this->config->get('jobportal_email_soci');
		}
		
		
		if (isset($this->request->post['jobportal_address2'])) {
			$data['jobportal_address2'] = $this->request->post['jobportal_address2'];
		} else {
			$data['jobportal_address2'] = $this->config->get('jobportal_address2');
		}
		
		
		if (isset($this->request->post['jobportal_fburl'])) {
			$data['jobportal_fburl'] = $this->request->post['jobportal_fburl'];
		} else {
			$data['jobportal_fburl'] = $this->config->get('jobportal_fburl');
		}
		
		if (isset($this->request->post['jobportal_google'])) {
			$data['jobportal_google'] = $this->request->post['jobportal_google'];
		} else {
			$data['jobportal_google'] = $this->config->get('jobportal_google');
		}
		
		
		if (isset($this->request->post['jobportal_twet'])) {
			$data['jobportal_twet'] = $this->request->post['jobportal_twet'];
		} else {
			$data['jobportal_twet'] = $this->config->get('jobportal_twet');
		}
		
		
		
		
		if (isset($this->request->post['jobportal_in'])) {
			$data['jobportal_in'] = $this->request->post['jobportal_in'];
		} else {
			$data['jobportal_in'] = $this->config->get('jobportal_in');
		}
		
		
		if (isset($this->request->post['jobportal_instagram'])) {
			$data['jobportal_instagram'] = $this->request->post['jobportal_instagram'];
		} else {
			$data['jobportal_instagram'] = $this->config->get('jobportal_instagram');
		}


		
		if (isset($this->request->post['jobportal_pinterest'])) {
			$data['jobportal_pinterest'] = $this->request->post['jobportal_pinterest'];
		} else {
			$data['jobportal_pinterest'] = $this->config->get('jobportal_pinterest');
		}



		
		if (isset($this->request->post['jobportal_youtube'])) {
			$data['jobportal_youtube'] = $this->request->post['jobportal_youtube'];
		} else {
			$data['jobportal_youtube'] = $this->config->get('jobportal_youtube');
		}

		
		if (isset($this->request->post['jobportal_blogger'])) {
			$data['jobportal_blogger'] = $this->request->post['jobportal_blogger'];
		} else {
			$data['jobportal_blogger'] = $this->config->get('jobportal_blogger');
		}
        
        if (isset($this->request->post['jobportal_skype'])) {
			$data['jobportal_skype'] = $this->request->post['jobportal_skype'];
		} else {
			$data['jobportal_skype'] = $this->config->get('jobportal_skype');
		}
        if (isset($this->request->post['jobportal_skype'])) {
			$data['jobportal_skype'] = $this->request->post['jobportal_skype'];
		} else {
			$data['jobportal_skype'] = $this->config->get('jobportal_skype');
		}
        
        if (isset($this->request->post['jobportal_mapcode'])) {
			$data['jobportal_mapcode'] = $this->request->post['jobportal_mapcode'];
		} else {
			$data['jobportal_mapcode'] = $this->config->get('jobportal_mapcode');
		}
		
			if (isset($this->request->post['jobportal_footericon'])) {
				$data['jobportal_footericon'] = $this->request->post['jobportal_footericon'];
			} else {
				$data['jobportal_footericon'] = $this->config->get('jobportal_footericon');
			}


			if (isset($this->request->post['jobportal_ftitle'])) {
				$data['jobportal_ftitle'] = $this->request->post['jobportal_ftitle'];
			} else {
				$data['jobportal_ftitle'] = $this->config->get('jobportal_ftitle');
			}


			if (isset($this->request->post['jobportal_flicker'])) {
				$data['jobportal_flicker'] = $this->request->post['jobportal_flicker'];
			} else {
				$data['jobportal_flicker'] = $this->config->get('jobportal_flicker');
			}

			if (isset($this->request->post['jobportal_usfull'])) {
				$data['jobportal_usfull'] = $this->request->post['jobportal_usfull'];
			} else {
				$data['jobportal_usfull'] = $this->config->get('jobportal_usfull');
			}

			
		   $this->load->model('tool/image');
			if (isset($this->request->post['jobportal_footericon']) && is_file(DIR_IMAGE . $this->request->post['jobportal_footericon'])) {
				$data['thumb'] = $this->model_tool_image->resize($this->request->post['jobportal_footericon'], 100, 100);
			} elseif ($this->config->get('jobportal_footericon') && is_file(DIR_IMAGE . $this->config->get('jobportal_footericon'))) {
				$data['thumb'] = $this->model_tool_image->resize($this->config->get('jobportal_footericon'), 100, 100);
			} else {
				$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
			}

			$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

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

		$data['header'] 		= $this->load->controller('common/header');
		$data['column_left'] 	= $this->load->controller('common/column_left');
		$data['footer'] 		= $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('common/theme.tpl', $data));
	}
	protected function validate() {
		
	if (!$this->user->hasPermission('modify','common/theme')) {
			$this->error['warning'] = $this->language->get('error_permission');
	}
	
	return !$this->error;
}
}
