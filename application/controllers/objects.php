<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Objects Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Objects extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('objects_m');
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}
	
	/**
	 * Creating an object
	 */
	public function create() {
		$this->load->model('tags_m');
		$this->load->model('objects_m');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('object_create_tags', 'Tags', 'trim|xss_clean|required');
		$this->form_validation->set_rules('object_create_name', 'Name', 'trim|xss_clean|required');


		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$this->load->model('object_tags_m');
			$this->load->model('tag_groups_m');
			
			$name = $this->input->post('object_create_name');
			$tags = $this->input->post('object_create_tags');
			
			$object_id = $this->objects_m->insert(	array(	'user_id'	=>	$this->session->userdata('id'),
															'name'		=>	$name,
															'tags'		=>	$tags));
			
			// Handle tags
			$split_tags = explode(',', $tags);
			if(count($split_tags) > 1) {
				// More then one tag detected
				// Add a tag grouping
				$group_id = $this->tag_groups_m->insert(array('name'	=>	$name), TRUE);
				foreach($split_tags as $tag) {
					$tag_id = $this->tags_m->insert(	array(	'name'	=>	strtolower($tag),
																'value'	=>	$tag));
					$this->object_tags_m->insert(	array(	'object_id'	=>	$object_id,
															'tag_id'	=>	$tag_id,
															'group_id'	=>	$group_id));
				}
			} else if(count($split_tags == 1)) {
			
			}
			json_response('success', array());
		}
	}
	
	public function edit($id) {

	}	
	
	public function feed() {
		$this->load->model('objects_m');
		$objects = $this->objects_m->get_feed();
		json_response('success', $objects);
	}
	
	public function book() {
		$this->load->model('objects_m');
		$objects = $this->objects_m->get_by('user_id', $this->session->userdata('id'));
		json_response('success', $objects);
	}
	
	/**
	 * Creating an object
	 */
	public function search() {
		$this->load->model('tags_m');
		$this->load->model('objects_m');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('object_search_search', 'Search', 'trim|xss_clean|required');

		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$this->load->model('object_tags_m');
			$this->load->model('tag_groups_m');
			
			$term = $this->input->post('object_search_search');
			
			//TODO: Actually search
			$results = $this->objects_m->get_all();
			
			json_response('success', array('results'	=>	$results));
		}
	}
}

/* End of file objects.php */
/* Location: ./application/controllers/objects.php */
