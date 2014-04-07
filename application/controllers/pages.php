<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pages Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Pages extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('users_m');
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}
	
	public function dashboard($id) {
		if($id == undefined) $id = $this->session->userdata('id');
		$this->load->model('ranks_m');
		$user = $this->users_m->get($id);
		if( ! empty($user) ) {
			$user->rank = $this->ranks_m->get($user->rank);
			$user->is_owner = ($this->session->userdata('id') == $id);
			json_response('success', $user);
		}
	}
	
	public function achievements() {
		$this->load->model('achievements_m');
		$this->load->helper('achievement_helper');
		$achievements = check_achievements();//= $this->achievements_m->with('conditions')->get_all();
		if( ! empty($achievements) ) {
			json_response('success', $achievements);
		}
	}
	
	public function stats() {
		$this->load->model('user_stats_m');
		$result = $this->user_stats_m->get($this->session->userdata('user_id'));
		if( ! empty($result) ) {
			json_response('success', $result);
		}
	}
	
	/**
	 * Fetches the user's feed for their dashboard
	 */
	public function feed() {
		$this->load->model('objects_m');
		$objects = $this->objects_m->get_feed();
		json_response('success', $objects);
	}
	
	/**
	 * Fetches the user's book entries
	 */
	public function book() {
		$this->load->model('objects_m');
		$this->load->model('clips_m');
		$objects = $this->objects_m->get_many_by('user_id', $this->session->userdata('id'));
		$clips = $this->clips_m->with('object')->with('user')->get_many_by('user_id', $this->session->userdata('id'));
		json_response('success', array('objects'=>$objects,'clips'=>$clips));
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */