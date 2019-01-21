<?php
class ControllerExtensionModuleLatest extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/latest');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');
		$data['button_apply'] = $this->language->get('button_apply');

		$this->load->model('job/job');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'p.date_added',
			'order' => 'DESC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_job_job->geJobs($filter_data);
		if ($results) {
			foreach ($results as $result) {
				if ($result['banner']) {
					$banner = $this->model_tool_image->resize($result['banner'], $setting['width'], $setting['height']);
				} else {
					$banner = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

				if($result['jobtype_id']==1){
				 $type= "Part Time";
				} else {
				 $type="Full Time";
				}

				if(isset($result['description'])){
				 $description = substr($result['description'], 0, 80);
				}

				$data['jobs'][] = array(
					'job_id'  		=> $result['job_id'],
					'type'       	=> $type,
					'zone'       	=> $result['location'],
					'banner'       	=> $banner,
					'title'        	=> $result['title'],					
					'salary'        => $result['salary'],					
					'description'   => $description,					
					'href'          => $this->url->link('job/jobdetail', 'job_id=' . $result['job_id'])
				);
			}

			return $this->load->view('extension/module/latest', $data);
		}
	}
}
