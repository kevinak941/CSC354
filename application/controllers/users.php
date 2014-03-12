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
		$this->form_validation->set_rules('register_email', 'E-mail', 'trim|xss_clean|required|callback_register_email_check');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|xss_clean|required|matches[register_password_confirm]');
		$this->form_validation->set_rules('register_password_confirm', 'Confirm Password', 'trim|xss_clean|required');
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$user_id = $this->users->insert(	array(	'email'		=>	$this->input->post('register_email'),
														'password'	=>	$this->input->post('register_password')));
			json_response('success', array());
		}
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
			$login = $this->users_m->get_by('email = "'.$this->input->post('login_email').'" AND password = "'.md5($this->input->post('login_password')).'"');

			$session_data = array(
				'id'		=> $login->user_id,
				'email'    	=> $login->email,
				'logged_in'	=> TRUE
			);

			$this->session->set_userdata($session_data);
			json_response('success', array());
		}
	}
	
	public function logout() 
	{
		$newdata = array(
			'id'   		=> '',
			'email'    	=> '',
			'logged_in' => FALSE
		);
		$this->session->unset_userdata($newdata );
		$this->session->sess_destroy();
		//Redirect
	}
	
	/**
	 * CI Validation Callback
	 * Check if an e-mail and password matches on in database
	 */
	public function login_password_check($password) {
		$this->load->model('users_m');
		$result = $this->users_m->get_by('email = "'.$this->input->post('login_email').'" AND password = "'.md5($password).'"');
		if(empty($result)) return TRUE;
		
		$this->form_validation->set_message('login_password_check', 'Unable to locate email and password');
		return FALSE;
	}
	
	/**
	 * CI Validation Callback
	 * Check if an e-mail is already created
	 */
	public function register_email_check($email) {
		$this->load->model('users_m');
		$result = $this->users_m->get_by('email', $email);
		if(empty($result)) return TRUE;
		
		$this->form_validation->set_message('register_email_check', 'This e-mail is already taken.');
		return FALSE;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */