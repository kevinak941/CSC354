<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Users Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Users extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}
	
	/**
	 * Check if user is logged in 
	 */
	public function index($user_id) {
	
	}
	
	/**
	 * 
	 */
	public function register() {
		$this->load->model('users_m');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('register_email', 'E-mail', 'trim|xss_clean|required');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|xss_clean|required|matches[register_password_confirm]');
		$this->form_validation->set_rules('register_password_confirm', 'Confirm Password', 'trim|xss_clean|required');
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			json_response('good', array());
		}
		/*$result = $this->users->insert(	array(	'email'		=>	$this->input->post('register_email'),
												'firstname'	=>	$this->input->post('register_first_name'),
												'lastname'	=>	$this->input->post('register_last_name')));
		
		*///echo json_encode(array('status'=>$this->input->post('register_first_name')));
	}
	
	/**
	 *
	 */
	public function login() {
		$this->load->model('users_m');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login_email', 'E-mail', 'trim|xss_clean|required');
		$this->form_validation->set_rules('login_password', 'Password', 'trim|xss_clean|required|callback_login_password_check');
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			json_response('good', array());
		}
	}
	
	public function login_password_check($password) {
		$this->load->model('users_m');
		$result = $this->users_m->get_by('email = "'.$this->input->post('login_email').'" AND password = "'.md5($password).'"');
		if($result != FALSE) return TRUE;
		
		$this->form_validation->set_message('login_password_check', 'Unable to locate email and password');
		return FALSE;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */