<?php
class ControllerCommonFooter extends Controller {
	public function index() {
		$this->load->language('common/footer');

		$data['scripts'] = $this->document->getScripts('footer');

		$data['text_useful'] = $this->language->get('text_useful');
		$data['text_allcan'] = $this->language->get('text_allcan');
		$data['text_latestblog'] = $this->language->get('text_latestblog');
		$data['text_submitjob'] = $this->language->get('text_submitjob');
		$data['text_information'] = $this->language->get('text_information');
		$data['text_service'] = $this->language->get('text_service');
		$data['text_extra'] = $this->language->get('text_extra');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_return'] = $this->language->get('text_return');
		$data['text_sitemap'] = $this->language->get('text_sitemap');
		$data['text_manufacturer'] = $this->language->get('text_manufacturer');
		$data['text_voucher'] = $this->language->get('text_voucher');
		$data['text_affiliate'] = $this->language->get('text_affiliate');
		$data['text_special'] = $this->language->get('text_special');
		$data['text_account'] = $this->language->get('text_account');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_wishlist'] = $this->language->get('text_wishlist');
		$data['text_newsletter'] = $this->language->get('text_newsletter');
		$data['text_subscribe'] = $this->language->get('text_subscribe');
		$data['text_emailenter'] = $this->language->get('text_emailenter');
		$data['button_subscribe'] = $this->language->get('button_subscribe');
		$data['text_followus'] = $this->language->get('text_followus');
		$data['text_needhelp'] = $this->language->get('text_needhelp');
		$data['text_callus'] = $this->language->get('text_callus');
		$data['text_jobs'] = $this->language->get('text_jobs');
		$data['text_stayconnect'] = $this->language->get('text_stayconnect');

		$this->load->model('catalog/information');

		$data['informations'] = array();

		foreach ($this->model_catalog_information->getInformations() as $result) {
			if ($result['bottom']) {
				$data['informations'][] = array(
					'title' => $result['title'],
					'href'  => $this->url->link('information/information', 'information_id=' . $result['information_id'])
				);
			}
		}





		$data['subjob'] = $this->url->link('company/submitjob');
		$data['jobs'] = $this->url->link('job/joblist');
		$data['allcandidate'] = $this->url->link('employ/listemploy');
		$data['latetsblog'] = $this->url->link('tmdblog/allblogcategory');
		$data['contact'] = $this->url->link('information/contact');
		$data['return'] = $this->url->link('account/return/add', '', true);
		$data['sitemap'] = $this->url->link('information/sitemap');
		$data['manufacturer'] = $this->url->link('product/manufacturer');
		$data['voucher'] = $this->url->link('account/voucher', '', true);
		$data['affiliate'] = $this->url->link('affiliate/account', '', true);
		$data['special'] = $this->url->link('product/special');
		$data['account'] = $this->url->link('account/account', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);
		$data['newsletter'] = $this->url->link('account/newsletter', '', true);

		$data['powered'] = sprintf($this->language->get('text_powered'), $this->config->get('config_name'), date('Y', time()));
        
        $data['telephone'] = $this->config->get('config_telephone');
        
        if (isset($this->request->post['jobportal_fburl'])) {
		  $data['fburl'] = $this->request->post['jobportal_fburl'];
        } else {
		  $data['fburl'] = $this->config->get('jobportal_fburl');
		}
        if (isset($this->request->post['jobportal_twet'])) {
		  $data['twitter'] = $this->request->post['jobportal_twet'];
        } else {
		  $data['twitter'] = $this->config->get('jobportal_twet');
		}
        if (isset($this->request->post['jobportal_google'])) {
		  $data['google'] = $this->request->post['jobportal_google'];
        } else {
		  $data['google'] = $this->config->get('jobportal_google');
		}
        if (isset($this->request->post['jobportal_instagram'])) {
		  $data['instagram'] = $this->request->post['jobportal_instagram'];
        } else {
		  $data['instagram'] = $this->config->get('jobportal_instagram');
		}
        if (isset($this->request->post['jobportal_in'])) {
		  $data['linkedin'] = $this->request->post['jobportal_in'];
        } else {
		  $data['linkedin'] = $this->config->get('jobportal_in');
		}
        
        $aboutus_descrption = $this->config->get('jobportal_aboutdes');
		
		if(isset($aboutus_descrption)){
			$data['aboutusdescrption'] = $aboutus_descrption;
		} else {
			$data['aboutusdescrption'] = '';			
		}
        
        if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}
		
		if (is_file(DIR_IMAGE . $this->config->get('jobportal_footericon'))) {
			$data['footericon'] = $server . 'image/' . $this->config->get('jobportal_footericon');
		} else {
			$data['footericon'] = '';
		}
        
        if (isset($this->request->post['jobportal_title'])) {
			$data['title'] = $this->request->post['jobportal_title'];
			} else {
			$data['title'] = $this->config->get('jobportal_title');
			}
			if (isset($this->request->post['jobportal_phoneno'])) {
			$data['phoneno'] = $this->request->post['jobportal_phoneno'];
			} else {
			$data['phoneno'] = $this->config->get('jobportal_phoneno');
			}
			
			if (isset($this->request->post['jobportal_mobile'])) {
			$data['mobile'] = $this->request->post['jobportal_mobile'];
			} else {
			$data['mobile'] = $this->config->get('jobportal_mobile');
			}
			
			if (isset($this->request->post['jobportal_email_soci'])) {
			$data['email'] = $this->request->post['jobportal_email_soci'];
			} else {
			$data['email'] = $this->config->get('jobportal_email_soci');
			}
			
			if (isset($this->request->post['jobportal_address2'])) {
			$data['address2'] = $this->request->post['jobportal_address2'];
			} else {
			$data['address2'] = $this->config->get('jobportal_address2');
			}

			if (isset($this->request->post['jobportal_flicker'])) {
			$data['flickerdata'] = $this->request->post['jobportal_flicker'];
			} else {
			$data['flickerdata'] = $this->config->get('jobportal_flicker');
			}


			if (isset($this->request->post['jobportal_usfull'])) {
		    	$data['jobportalnames'] = $this->request->post['jobportal_usfull'];
			} else {
			  $data['jobportalnames'] = $this->config->get('jobportal_usfull');
			}

		foreach ($data['jobportalnames'] as $result) {
				$data['result'][] = array(
					'link' => $result['jobportal_link'],
					'text' => $result['jobportal_text']				
				);
			
		}


        $data['home'] = $this->url->link('common/home');
		

		// Whos Online
		if ($this->config->get('config_customer_online')) {
			$this->load->model('tool/online');

			if (isset($this->request->server['REMOTE_ADDR'])) {
				$ip = $this->request->server['REMOTE_ADDR'];
			} else {
				$ip = '';
			}

			if (isset($this->request->server['HTTP_HOST']) && isset($this->request->server['REQUEST_URI'])) {
				$url = 'http://' . $this->request->server['HTTP_HOST'] . $this->request->server['REQUEST_URI'];
			} else {
				$url = '';
			}

			if (isset($this->request->server['HTTP_REFERER'])) {
				$referer = $this->request->server['HTTP_REFERER'];
			} else {
				$referer = '';
			}

			$this->model_tool_online->addOnline($ip, $this->customer->getId(), $url, $referer);
		}

		$this->load->model('catalog/category');
		$data['categories'] = $this->model_catalog_category->getJobCategories($data);
		$categorieslists=$this->model_catalog_category->getJobCategories($data);
		foreach ($categorieslists as $categorieslists) {
           $data['categorieslists'][]=array(
           	'category_id'=>$categorieslists['category_id'],
           	'name'=>$categorieslists['name'],
           	  'href'          => $this->url->link('job/joblist', 'job_filter=' . $categorieslists['category_id'])
           	);
		
		}
          
		$footerlayout = $this->config->get('jobportal_footer');
			if($footerlayout=='footer1'){
				return $this->load->view('common/footer', $data);
            } elseif($footerlayout=='footer2'){
			  return $this->load->view('common/footer1', $data);
			} elseif($footerlayout=='footer3'){
              return $this->load->view('common/footer2', $data);
            } elseif($footerlayout=='footer4'){
              return $this->load->view('common/footer3', $data);
            }			
        
        return $this->load->view('common/footer', $data);	
            
	}



	public function  emailfunction(){
		$this->load->language('common/footer');
		$json=array();
		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$emessage=$this->request->post['touchmessage'];	
			$name=$this->request->post['touchname'];	
			$textemail=$this->request->post['touchemail'];
			
			$smssubject = sprintf($name, ENT_QUOTES, 'UTF-8');
			$smsmessage = sprintf($textemail,$emessage, ENT_QUOTES, 'UTF-8') . "\n\n";
			$smsmessage.= sprintf($emessage,ENT_QUOTES, 'UTF-8') . "\n\n";
			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');
			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($smssubject);
			$mail->setHtml($smsmessage);
			$mail->send();
			$json['success'] = $this->language->get('text_success');
		}
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));

	}





}
