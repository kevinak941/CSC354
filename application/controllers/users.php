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
		$this->load->model('users_m');
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}
	
	/**
	 * Check if user is logged in 
	 */
	public function check($id) {
		if($this->session->userdata('logged_in') == TRUE) {
			if($this->session->userdata('id') == $id)
				json_response('success', array());
		}
		json_response('fail', array());
	}	
	
	public function add_friend() {
		$id = $this->input->post('id');
		$this->load->model('user_friends_m');
		//Check if user is already friend
		$check = $this->user_friends_m->get_by(array(	'users_id_1' => $this->session->userdata('id'),
														'users_id_2' => $id));
		if(empty($check)) {
			// Users are not friends
			$this->user_friends_m->insert(	array(	'users_id_1'	=>	$this->session->userdata('id'),
													'users_id_2'	=>	$id));
			$this->user_stats_m->update(	$this->session->userdata('id'),	array(	'friends' => '+1'));

			json_response('error', array('note'	=>	array(	'type'	=> 'success',
															'text'	=> 'User added as friend')));
		} else {
			// Have entry in friends table, let's check are_friends
			if($check->are_friends == 1) {
				//Everything is already set
				json_response('error', array('note'	=>	array(	'type'	=> 'warning',
																'text'	=> 'User is already your friend')));
			} else {
				// Set are_friends to true
			}
		}
												
	}
	
	/**
	 * 
	 */
	public function register() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('register_email', 'E-mail', 'trim|xss_clean|required|callback_register_email_check');
		$this->form_validation->set_rules('register_password', 'Password', 'trim|xss_clean|required|matches[register_password_confirm]');
		$this->form_validation->set_rules('register_password_confirm', 'Confirm Password', 'trim|xss_clean|required');
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$user_id = $this->users_m->insert(	array(	'email'		=>	$this->input->post('register_email'),
														'password'	=>	md5($this->input->post('register_password'))));
			json_response('success',  array('note'	=>	array(	'type'	=> 'success',
																'text'	=> 'Your account has been created'))); 
		}
	}
	
	/**
	 *
	 */
	public function login() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('login_email', 'E-mail', 'trim|xss_clean|required');
		$this->form_validation->set_rules('login_password', 'Password', 'trim|xss_clean|required|callback_login_password_check');
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$login = $this->users_m->with('rank')->get_by('email', $this->input->post('login_email'));
			if( ! empty($login)) {
				$session_data = array(
					'id'		=> $login->id,
					'email'    	=> $login->email,
					'logged_in'	=> TRUE
				);
				$this->session->set_userdata($session_data);
				$session_data['user_id'] = $this->session->userdata('id');
				json_response('success', $session_data);
			} else
				$this->form_validation->set_message('login_password_check', 'Unable to locate email and password');
		}
		return;
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
		$result = $this->users_m->get_by(array('email' => $this->input->post('login_email'), 'password' => md5($password)));
		if( ! empty($result)) return TRUE;
		
		$this->form_validation->set_message('login_password_check', 'Unable to locate email and password');
		return FALSE;
	}
	
	/**
	 * CI Validation Callback
	 * Check if an e-mail is already created
	 */
	public function register_email_check($email) {
		$result = $this->users_m->get_by('email', $email);
		if(empty($result)) return TRUE;
		
		$this->form_validation->set_message('register_email_check', 'This e-mail is already taken.');
		return FALSE;
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */