<?php 
class ControllerInformationTestimonialList extends Controller {
	private $error = array(); 
	public function index() {
		$this->language->load('information/testimonial');
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('information/testimonial_list')
		);
		
		$this->document->setTitle($this->language->get('heading_title'));
    	$data['heading_title'] = $this->language->get('heading_title');
    	$data['text_testimonial'] = $this->language->get('text_testimonial');
    	
    	$data['testimonial'] = $this->url->link('information/testimonial', '', true);
    	
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');
		
		$this->load->model('catalog/testimonial');
		
		$data['testimonals'] = array();		
		$filter_data = array();
		
		$results = $this->model_catalog_testimonial->getTestimonials($filter_data);	
			
			foreach($results as $result){
			
					if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'],118,118);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', 118,118);
					}
					if ($result['image']) {
					$bigimage = $this->model_tool_image->resize($result['image'],500,500);
					} else {
						$bigimage = $this->model_tool_image->resize('placeholder.png', 500,500);
					}
					
					$data['testimonals'][] =  array(
					'testimonial_id' => $result['testimonial_id'],
					'name'    		 => $result['name'],
					'enquiry' => html_entity_decode($result['enquiry'], ENT_QUOTES, 'UTF-8'),
					'status'         => $result['status'],
					'thumb'          => $image,	
					'bigthumb'          => $bigimage,
					'rating'    =>$result['rating']				
					);
			
			}
			
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/information/testimonial_list')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/information/testimonial_list', $data));
		} else {
			$this->response->setOutput($this->load->view('information/testimonial_list', $data));
		}			
		
		
		
  	}
}
?>
