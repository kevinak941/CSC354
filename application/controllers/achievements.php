<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Achievements Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Achievements extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('achievements_m');
		$this->load->model('achievement_conditions_m');
		$this->load->model('user_achievements_m');
		$this->load->helper('achievement_helper');
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}

	public function check() {
		json_response('success', check_achievements(TRUE));
	}
}