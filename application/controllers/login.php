<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Login extends CI_Controller {
	
	public function __construct {
		parent::__construct();
		//if( ! $this->input->is_ajax_request) 
			//exit;
	}
	
	public function register() {
		$this->load->model('users');
		echo json_encode(array('status'=>'success'));
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */