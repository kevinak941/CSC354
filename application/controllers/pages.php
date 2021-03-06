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
		if($this->session->userdata('logged_in') != TRUE) {
			json_response('success',  array('note'	=>	array(	'type'	=> 'error',
																'text'	=> 'You must log in to view this page.'),
											'redirect'	=>	'#p_login'));
			exit;
		}
	}
	
	public function dashboard() {
		$id = $this->input->post('id');
		if($id == null) $id = $this->session->userdata('id');
		$this->load->model('ranks_m');
		$this->load->model('user_stats_m');
		$this->load->model('user_friends_m');
		$this->load->model('clips_m');
		$this->load->model('achievements_m');
		$this->load->model('achievement_conditions_m');
		$this->load->helper('achievement_helper');
		$user = $this->users_m->get($id);
		if( ! empty($user) ) {
			$stats = $this->user_stats_m->get($id);
			$user->rank = $this->ranks_m->get($user->rank);
			$user->session_user_id = $this->session->userdata('id');
			$user->is_owner = ($this->session->userdata('id') == $id);
			if($user->is_owner == false) $user->is_friend = $this->user_friends_m->is_friend($id);
			else $user->is_friend = false;
			$user->num_friends = $stats->friends;
			$user->num_recipes = $stats->recipes;
			$user->num_clips = $stats->clips;
			$user->num_clipped = $stats->clipped;//$this->clips_m->count_clipped($this->session->userdata('id'));
			$user->num_cash = $stats->clip_cash;
			$user->achievements = check_achievements($id);
			json_response('success', $user);
		}
	}
	
	public function edit_profile() {
		$fname 	= $this->input->post('profile_first_name');
		$lname 	= $this->input->post('profile_last_name');
		$bio 	= $this->input->post('profile_bio');
		$this->users_m->update($this->session->userdata('id'),
								array(	'firstname'	=>	$fname,
										'lastname'	=>	$lname,
										'bio'		=>	$bio));
		json_response('success',  array('note'	=>	array(	'type'	=> 'success',
															'text'	=> 'Profile Information Updated')));
	}
	
	public function achievements() {
		$this->load->model('achievements_m');
		$this->load->helper('achievement_helper');
		$achievements = check_achievements($this->session->userdata('id'));//= $this->achievements_m->with('conditions')->get_all();
		if( ! empty($achievements) ) {
			json_response('success', $achievements);
		}
	}
	
	public function ranks() {
		$this->load->model('ranks_m');
		$ranks = $this->ranks_m->get_all();
		json_response('success', $ranks);
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
		if( $objects !== FALSE ) {
			foreach($objects as $key => $value) {
				if($value['user_id'] === $this->session->userdata('id'))
					$objects[$key]['is_owner'] = true;
				else $objects[$key]['is_owner'] = false;
			}	
		}
		json_response('success', $objects);
	}
	
	/**
	 * Fetches the user's book entries
	 */
	public function book() {
		$this->load->model('objects_m');
		$this->load->model('clips_m');
		$objects = $this->objects_m->user($this->session->userdata('id'));//with('object_images')->get_many_by('user_id', $this->session->userdata('id'));
		$clips = $this->clips_m->user($this->session->userdata('id'));//->with('user')->get_many_by('user_id', $this->session->userdata('id'));
		if($clips !== FALSE) {
			foreach($clips as $key=>$clip) {
				//Glitch remove any empty clips
				if($clip['id'] == "") unset($clips[$key]);
			}
		}
		json_response('success', array('objects'=>$objects,'clips'=>$clips));
	}
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */