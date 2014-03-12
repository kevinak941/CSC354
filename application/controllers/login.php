<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Login Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Login extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//if( ! $this->input->is_ajax_request) 
			//exit;
	}
	
	public function register() {
		$this->load->model('users');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('register_email', 'E-mail', 'trim|xss_clean|required');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|xss_clean|required|matches[register_password_confirm]');
		$this->form_validation->set_rules('register_password_confirm', 'Confirm Password', 'trim|xss_clean|required');
		if($this->form_validation->run()) {
			json_response('good', array());
		} else {
			json_validate();
		}
		/*$result = $this->users->insert(	array(	'email'		=>	$this->input->post('register_email'),
												'firstname'	=>	$this->input->post('register_first_name'),
												'lastname'	=>	$this->input->post('register_last_name')));
		
		*///echo json_encode(array('status'=>$this->input->post('register_first_name')));
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */