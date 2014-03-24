<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
	
//Main Session Page Controller
//Contains only the required functions

class MY_Controller extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		// Check if user is logged in
		//$this->isLoggedIn();
		// Load default variables for views
		$this->loadViewVars();
	}
	
	public function isLoggedIn() {
		if($this->checkLoggedIn() == FALSE) {
			redirect(base_url(''));
			return FALSE;
		}
		return TRUE;
	}
	
	/**
	 * Check if given user is logged in
	 *
	 * @return (BOOL) (True) If the user has an active session, aka is logged in
	 * @return (BOOL) (False) If the user is NOT logged in
	 */
	public function checkLoggedIn() {
		if($this->session->userdata('logged_in') != TRUE)
			return FALSE;
			
		return TRUE;
	}
	
	/**
	 * Loads default variables into a view
	 */
	public function loadViewVars() {
		$data = new stdClass();
		$data->ci_class = $this->router->class;
		$data->ci_method = $this->router->method;
		
		$this->load->vars($data);
	}
	
}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
