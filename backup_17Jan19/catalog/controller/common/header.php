<?php
class ControllerCommonHeader extends Controller {
	public function index() {
		// Analytics
		$this->load->model('extension/extension');

		$data['analytics'] = array();

		$analytics = $this->model_extension_extension->getExtensions('analytics');

		foreach ($analytics as $analytic) {
			if ($this->config->get($analytic['code'] . '_status')) {
				$data['analytics'][] = $this->load->controller('extension/analytics/' . $analytic['code'], $this->config->get($analytic['code'] . '_status'));
			}
		}

		if ($this->request->server['HTTPS']) {
			$server = $this->config->get('config_ssl');
		} else {
			$server = $this->config->get('config_url');
		}

		if (is_file(DIR_IMAGE . $this->config->get('config_icon'))) {
			$this->document->addLink($server . 'image/' . $this->config->get('config_icon'), 'icon');
		}

		$data['title'] = $this->document->getTitle();

		$data['base'] = $server;
		$data['description'] = $this->document->getDescription();
		$data['keywords'] = $this->document->getKeywords();
		$data['links'] = $this->document->getLinks();
		$data['styles'] = $this->document->getStyles();
		$data['scripts'] = $this->document->getScripts();
		//$data['lang'] = $this->language->get('code');
        
        $data['lang'] = $this->session->data['language'];
		$data['direction'] = $this->language->get('direction');

		$data['name'] = $this->config->get('config_name');

		if (is_file(DIR_IMAGE . $this->config->get('config_logo'))) {
			$data['logo'] = $server . 'image/' . $this->config->get('config_logo');
		} else {
			$data['logo'] = '';
		}

		$this->load->language('common/header');

		$data['companeylogin']=$this->company->isLogged();

		$data['text_home'] = $this->language->get('text_home');

		// Wishlist
		/*if ($this->customer->isLogged()) {
			$this->load->model('account/wishlist');

			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), $this->model_account_wishlist->getTotalWishlist());
		} else {
			$data['text_wishlist'] = sprintf($this->language->get('text_wishlist'), (isset($this->session->data['wishlist']) ? count($this->session->data['wishlist']) : 0));
		}*/

		
		//$data['text_logged'] = sprintf($this->language->get('text_logged'), $this->url->link('account/account', '', true), $this->customer->getFirstName(), $this->url->link('account/logout', '', true));

		$data['text_account'] = $this->language->get('text_account');


		$data['text_register'] = $this->language->get('text_register');
		$data['text_login'] = $this->language->get('text_login');
		$data['text_order'] = $this->language->get('text_order');
		$data['text_transaction'] = $this->language->get('text_transaction');
		$data['text_download'] = $this->language->get('text_download');
		$data['text_logout'] = $this->language->get('text_logout');
		$data['text_checkout'] = $this->language->get('text_checkout');
		$data['text_category'] = $this->language->get('text_category');
		$data['text_all'] = $this->language->get('text_all');
		//xml start
		$data['text_about'] = $this->language->get('text_about');
		$data['text_contact'] = $this->language->get('text_contact');
		$data['text_email'] = $this->language->get('text_email');
		$data['text_submitjob'] = $this->language->get('text_submitjob');
		//xml end

		$data['home'] = $this->url->link('common/home');
		$data['wishlist'] = $this->url->link('account/wishlist', '', true);

		$data['companysubmit'] = $this->url->link('company/submitjob', '', true);
		$data['companylogin'] = $this->url->link('employ/login', '', true);



		$data['employlogged'] = $this->employ->isLogged();
		$data['companeylogged'] = $this->company->isLogged();

		$data['account'] = $this->url->link('account/account', '', true);
		$data['register'] = $this->url->link('employ/register', '', true);
		$data['login'] = $this->url->link('employ/login', '', true);
		
		$data['logoutempl'] = $this->url->link('employ/logout', '', true);
		$data['looutempl'] = $this->url->link('company/logout', '', true);


		$data['submitjob'] = $this->url->link('company/submitjob', '', true);
		$data['order'] = $this->url->link('account/order', '', true);
		$data['transaction'] = $this->url->link('account/transaction', '', true);
		$data['download'] = $this->url->link('account/download', '', true);
		$data['logout'] = $this->url->link('account/logout', '', true);
		$data['shopping_cart'] = $this->url->link('checkout/cart');
		$data['checkout'] = $this->url->link('checkout/checkout', '', true);
		$data['contact'] = $this->url->link('information/contact');
		//xml start
		$data['about'] = $this->url->link('information/information&information_id=4');
		$data['email'] = $this->config->get('config_email');
		$data['text_testimonial'] = $this->language->get('text_testimonial');
		$data['tmdblog_category'] = $this->url->link('tmdblog/allblogcategory');
		//xml end
		
		
		$data['telephone'] = $this->config->get('config_telephone');

		// Menu
		/*$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);

					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $category['category_id'] . '_' . $child['category_id'])
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}*/

		$data['language'] = $this->load->controller('common/language');
		$data['currency'] = $this->load->controller('common/currency');
		$data['search'] = $this->load->controller('common/search');
		// Mega header 
		$data['categories'] = array();
		$data['megaheaders'] = $this->load->controller('common/megaheader');
        
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
		// Mega header 
		// For page specific css
		if (isset($this->request->get['route'])) {
			if (isset($this->request->get['product_id'])) {
				$class = '-' . $this->request->get['product_id'];
			} elseif (isset($this->request->get['path'])) {
				$class = '-' . $this->request->get['path'];
			} elseif (isset($this->request->get['manufacturer_id'])) {
				$class = '-' . $this->request->get['manufacturer_id'];
			} elseif (isset($this->request->get['information_id'])) {
				$class = '-' . $this->request->get['information_id'];
			} else {
				$class = '';
			}

			$data['class'] = str_replace('/', '-', $this->request->get['route']) . $class;
		} else {
			$data['class'] = 'common-home';
		}
        
        $headerlayout = $this->config->get('jobportal_header');
							
        if($headerlayout=='header1'){
           return $this->load->view('common/header', $data);
		} elseif($headerlayout=='header2'){
          return $this->load->view('common/header1', $data);		
        } elseif($headerlayout=='header3'){
          return $this->load->view('common/header2', $data);
		} elseif($headerlayout=='header4'){
          return $this->load->view('common/header3', $data);		
		}

		return $this->load->view('common/header', $data);
	}
}
