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
		$this->load->library('form_validation');

		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			json_response('success', array());
		}
	}
	
	public function edit($id) {

	}	
}

/* End of file objects.php */
/* Location: ./application/controllers/objects.php */
