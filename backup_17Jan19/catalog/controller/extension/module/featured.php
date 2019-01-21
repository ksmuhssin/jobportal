<?php
class ControllerExtensionModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_view'] = $this->language->get('button_view');
		$data['button_apply'] = $this->language->get('button_apply');
		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		
		$this->load->model('job/job');

		$this->load->model('tool/image');

		$data['jobdetailinfo'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$jobdetailinfo = array_slice($setting['product'], 0, (int)$setting['limit']);

			foreach ($jobdetailinfo as $job_id) {
				$jobs_info = $this->model_job_job->getJob($job_id);
				if ($jobs_info) {
					
					if ($jobs_info['banner']) {
						$image = $this->model_tool_image->resize($jobs_info['banner'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}
					

					$job_info = $this->model_job_job->getJob($jobs_info['job_id']);
						if($job_info['jobtype_id']==1){
						$type= "Part Time";
						} else {
						$type="Full Time";
						}
                   $data['jobdetailinfo'][] = array(
						'job_id'  		=> $jobs_info['job_id'],
						'name'  		=> $jobs_info['title'],
						'location'  	=> $jobs_info['location'],
						'thumb'      	=> $image,
						'type'       	=> $type,
						'description' 	=> utf8_substr(strip_tags(html_entity_decode($jobs_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					    'href'        	=> $this->url->link('job/jobdetail', 'job_id=' . $jobs_info['job_id']),
					    'quick'         => $this->url->link('job/quick', 'job_id=' . $jobs_info['job_id']),
					    'viewhref'        => $this->url->link('job/jobdetail', 'job_id=' . $jobs_info['job_id'])
					);
				}
			}
			
			
			$jobs_info1 = $this->model_job_job->getJobbylimit(10) ;
			
			
			foreach ($jobs_info1 as $job_details1) {
				
				if ($job_details1) {
					
					$data['jobdetailinfo1'][] = array(
						'job_id'  		=> $job_details1['job_id'],
						'name'  		=> $job_details1['title'],
						'description' 	=> utf8_substr(strip_tags(html_entity_decode($job_details1['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
					    'href'        	=> $this->url->link('job/jobdetail', 'job_id=' . $job_details1['job_id']),
					    'quick'         => $this->url->link('job/quick', 'job_id=' . $job_details1['job_id']),
					    'viewhref'        => $this->url->link('job/jobdetail', 'job_id=' . $job_details1['job_id'])
					);
				}
			}
			
			
		}

		if ($data['jobdetailinfo']) {
			return $this->load->view('extension/module/featured', $data);
		}
	}


}
