<?php
class ControllerCommonMegaHeader  extends Controller {
	public function index() {
			$this->load->language('common/header');
			
			$this->load->model('catalog/tmd_megaheader');
			$this->load->model('catalog/information');
			$this->load->model('catalog/manufacturer');
			$this->load->model('catalog/category');
			//$this->load->model('catalog/product');
			$this->load->model('tool/image');
			
				///setting////
			$data['dropdownbgtitle']='';
			$data['headercontainer']=$this->config->get('megaheader_bg_color');
			$data['headertitlecolor']=$this->config->get('megaheader_title');
			$data['headertitlehovcolor'] = $this->config->get('megaheader_hovtitle');
			$data['headersublink']=$this->config->get('megaheader_link');
			$data['headerhlink']=$this->config->get('megaheader_link_hover');
			$data['headerlinksize'] = $this->config->get('megaheader_sub_link');
			$data['headertitlesize'] = $this->config->get('megaheader_title_font');
			$data['menubgtitle'] = $this->config->get('megaheader_bgtitle');
			$data['menubghovtitle'] = $this->config->get('megaheader_bghovtitle');
			$data['dropdownbg'] = $this->config->get('megaheader_drpmebg');
			$data['menuexpend'] = $this->config->get('megaheader_menuexpend');
			$data['dropdowncolor'] = $this->config->get('megaheader_powered');
			/* new code */
			$data['mobilbtn_bgcolor'] = $this->config->get('megaheader_mobilbtn_color');
			$data['columnbg'] = $this->config->get('megaheader_columnbg');
			$data['labelbg'] = $this->config->get('megaheader_labelbg');
			$data['labeltextcolor'] = $this->config->get('megaheader_labeltext');
			
			if($this->config->get('megaheader_fontweight')==1){
			$data['fontweight'] ='bold';
			} else {
				$data['fontweight'] ='normal';				
			}
			
			if($this->config->get('megaheader_fonttype')==1){
			$data['fonttype'] ='uppercase';
			} else {
				$data['fonttype'] ='capitalize';				
			}
			
			$showproductcount = $this->config->get('megaheader_showproductcount');
			/* new code */
			
			
			///setting////
			
			
			$data['dropdownbg'] = $this->config->get('megaheader_drpmebg');
			
			
			/* 20-dec-2016 */
			
			$data['categorylimit'] = $this->config->get('megaheader_maincategory_limit');
		
			/* 20-dec-2016 */		
			$data['subcategorylimit'] = $this->config->get('megaheader_category_limit');
			$data['productlimit'] = $this->config->get('megaheader_product_limit');
		
			/* update code */
			$data['menuexpend'] = $this->config->get('megaheader_menuexpend');
			/* update code */
			///setting////
			$catetext=$this->config->get('megaheader_mobilecategory');
			
			if(!empty($catetext[(int)$this->config->get('config_language_id')])) {
			$data['text_category'] = $catetext[(int)$this->config->get('config_language_id')];
			} else {
			$data['text_category'] = $this->language->get('text_category');
			}
			
			$data['megaheaders'] = array();

			
				
			$results=$this->model_catalog_tmd_megaheader->getmegaheaders();
			
				foreach($results as $result)
				{
					
				if(!empty($result['title'])) {
					$products=array();	
					$submenu=array();
					$informations = unserialize($result['informations']);
					$productsetting = unserialize($result['productsetting']);
					
					if($informations){	
					
					foreach($informations as $information)
					{
					  
						$information =$this->model_catalog_information->getInformation($information);
						
						$submenu[]=array(
							'name'=> $information['title'],
							'description'     => html_entity_decode($information['description']),
							'href'=> $this->url->link('information/information', 'information_id=' . $information['information_id']),
							'main' => $result['enable'],
							'type' =>'product'
						);
					}
					}
				
								
				if(isset($result['categories'])){
					
					
					$categories = unserialize($result['categories']);
					if($categories){	
					foreach($categories as $categorie)
					{	
						
						
						$subcategory=array();
						$maincategoryimage='';
						$image='';
						$categorie = $this->model_catalog_category->getCategory($categorie);
						if(isset($categorie['name'])) {
						if(isset($productsetting['category']['categoryimage']))
						{
						if ($categorie['image']) {
						$maincategoryimage = $this->model_tool_image->resize($categorie['image'], $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));
						}
						else{
						$maincategoryimage = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_category_width'), $this->config->get('megaheader_category_height'));
						}
						
						}
						
						if(isset($productsetting['category']['subcategory']))
						{
						$subcategorys = $this->model_catalog_category->getCategories($categorie['category_id']);

					foreach ($subcategorys as $sub_category) {
						$filter_data = array(
							'filter_category_id'  => $sub_category['category_id'],
							'filter_sub_category' => true
						);
						
						/* new code */
						if($showproductcount==1){
						$subname = $sub_category['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '');
						} else {
						$subname =	$sub_category['name'];
						}						
						/* new code */
						
						$subcategory[] = array(
							'name' => $subname,
							'image'=>'',
							'description'     => isset($productsetting['category']['categorydescription'])? utf8_substr(strip_tags(html_entity_decode($sub_category['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..':'',
							'href' => $this->url->link('product/category', 'path=' . $categorie['category_id'] . '_' . $sub_category['category_id'])
						);
						}
						}
						
						
						//// category product ///
						$category_product='';
						
						if(isset($productsetting['category']['product']))
						{
						
						$filter_data = array(
							'filter_category_id' =>  $categorie['category_id'],
							'start'              => '0',
							'limit'              => '10'
						);

						
						$categoryproducts = $this->model_catalog_product->getProducts($filter_data);
						
						if($categoryproducts){	
					foreach($categoryproducts as $product)
					{
						$image='';
						if(isset($productsetting['category']['image']))
						{
						if ($product['image']) {
						$image = $this->model_tool_image->resize($product['image'], $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));
						}
						else
						{
						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));		
						}
						}
						if(isset($productsetting['category']['price']))
						{
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
						$price = false;
						}

					if ((float)$product['special']) {
						$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
					}
						}
						else
						{
							$price = false;
							$special = false;
						}
					
					
					
						
						if(isset($this->request->get['path'])){
						$path = $this->request->get['path'];
						}else{
						$path='';
						}
						$category_product[]=array(
							'name'     =>isset($productsetting['category']['name']) ? $product['name'] : '',
							'model'     =>isset($productsetting['category']['model']) ? $product['model'] : '',
							'image'     =>$image,
							'sku'     =>isset($productsetting['category']['sku']) ? $product['sku'] : '',
							'upc'     =>isset($productsetting['category']['upc']) ? $product['upc'] : '',
							'description'     => isset($productsetting['category']['description']) ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, 100) . '..' : ' ',
							'price'=>$price,
							'special'=>$special,
							'href'     => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $product['product_id']),
							'main' => $result['enable'],
							'type' =>'product'
							
						);
						
							}
							}
						}
						//// category product ///
						
						$filter_data = array(
							'filter_category_id'  => $categorie['category_id'],
							'filter_sub_category' => true
						);
						
						/* new code */
						if($showproductcount==1){
						$categoriename = $categorie['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : '');
						} else {
						$categoriename =	$categorie['name'];
						}						
						/* new code */
						
						$submenu[]=array(
							'name'     => $categoriename,
							'image'     => $maincategoryimage,
							'product'     => $category_product,
							'sublink'     => $subcategory,
							'description'     => isset($productsetting['category']['categorydescription'])? utf8_substr(strip_tags(html_entity_decode($categorie['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..':'',
							'href'     => $this->url->link('product/category', 'path=' . $categorie['category_id']),
							'main'=>$result['enable'],
							'type'=>'',
							
							
							
							
						);
						
					} }
					}
					
				}
				if(isset($result['products'])){
					
					$products = unserialize($result['products']);
					if($products){	
					foreach($products as $product)
					{
						$product = $this->model_catalog_product->getProduct($product);
						
						$image='';
						if(isset($productsetting['product']['image']))
						{
						if ($product['image']) {
						$image = $this->model_tool_image->resize($product['image'], $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));
						}
						else
						{
						$image = $this->model_tool_image->resize('no_image.png', $this->config->get('megaheader_product_width'), $this->config->get('megaheader_product_height'));		
						}
						}
						if(isset($productsetting['product']['price']))
						{
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
						$price = false;
						}

					if ((float)$product['special']) {
						$special = $this->currency->format($this->tax->calculate($product['special'], $product['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
					}
						}
						else
						{
							$price = false;
							$special = false;
						}
					
					
					
						
						if(isset($this->request->get['path'])){
						$path = $this->request->get['path'];
						}else{
						$path='';
						}
						$submenu[]=array(
							'name'     =>isset($productsetting['product']['name']) ? $product['name'] : '',
							'model'     =>isset($productsetting['product']['model']) ? $product['model'] : '',
							'image'     =>$image,
							'sku'     =>isset($productsetting['product']['sku']) ? $product['sku'] : '',
							'upc'     =>isset($productsetting['product']['upc']) ? $product['upc'] : '',
							'description'     => isset($productsetting['product']['description']) ? utf8_substr(strip_tags(html_entity_decode($product['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..' : ' ',
							'price'=>$price,
							'special'=>$special,
							'href'     => $this->url->link('product/product', 'path=' . $path . '&product_id=' . $product['product_id']),
							'main' => $product['status'],
							'type' =>'product'
							
						);
						
					}
					}
					
				}
				$editor='';
				if($result['type']=='customtype')
				{
					$customlinks=$this->model_catalog_tmd_megaheader->getmegacustomlinks($result['megaheader_id']);
					
					if($customlinks)
					{
						foreach($customlinks as $customlink)
						{
								
							$submenu[]=array(
								'name'     => $customlink['custname'],
								'href'     => $customlink['custurl'],
								'main'     => $result['enable'],
								'type'	   => '',
								
								
							);
						}
				}
				}
				elseif($result['type']=='editor')
				{
					
					$editor=$this->model_catalog_tmd_megaheader->getmegaheadereditoer($result['megaheader_id']);
					$editor= '<span class="editorss">'.html_entity_decode($editor['customcode'], ENT_QUOTES, 'UTF-8') . "\n".'</span>';
				}
					/* 29-nov new code */	
					$background='';
					if ($result['image']) {
						if(!empty($result['bgimagewidth']) && !empty($result['bgimageheight'])){
						$background = $this->model_tool_image->resize($result['image'],$result['bgimagewidth'],$result['bgimageheight']);
						} else{
						$background = $this->model_tool_image->resize($result['image'],287,445);	
						}
					}
					/* 29-nov new code */	
					$ptrnbackground='';
					$patternimages = $result['patternimage'];
					$ptrnbackground  =  HTTP_SERVER.'image/catalog/pattern/'.$patternimages.'.png';	
					
					$data['megaheaders'][]=array(
						'title'=>$result['title'],
						'bgimagetype'=>$result['bgimagetype'],
						'href'=>$result['url'],
						'openew'=>$result['open'],
						'background'=>$background,
						'ptrnbackground'=> $ptrnbackground,
						'background'=>$background,
						'sublink'=>$submenu,
						'editor'=>$editor,
						'icon'=>$result['title_icon'],
						'showicon'=>$result['showicon'],
						'row'   => $result['row'] ? $result['row'] : 1,
						'col'   => $result['col'] ? $result['col'] : 1,
						'type'	=> '',
						/* 29-nov new code */					
						//'bgimageheight'=>$result['bgimageheight'],
						//'menu_label'=>$result['menu_label'],
						/* new code */
						
					);
				
				}}
				
			//echo "<pre>";
			//print_r($data['megaheaders']);die();
			
			
			
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/megaheader')) {
			return $this->load->view($this->config->get('config_template') . '/template/common/megaheader', $data);
		} else {
			return $this->load->view('common/megaheader', $data);
		}
		
		}
}
