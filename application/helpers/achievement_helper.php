<?php 
if( ! function_exists('test_conditions')) {
	function test_conditions($stats, $conditions) {
		if(is_array($conditions)) {
			$check = true;
			foreach($conditions as $key => $condition) {	
				$test_object = $condition->object;
				$test_value = $condition->value;
				switch($condition->type) {
					case "count":
						if($stats->$test_object < $test_value) $check = false;
						break;
					default:
						break;
				}
			}
			return $check;
		}
	}
}

/**
 * Check if user is earning new achievements
 * @param include_all (BOOL) If true, will return in format array ('new'=>array, 'achievements'=>array
 * Where 'achievements' are all achievements in the game (for dashboard options)
 */
if( ! function_exists('check_achievements') ) {
	function check_achievements($include_all = TRUE) {
		$CI = &get_instance();
		$CI->load->model('achievements_m');
		$CI->load->model('user_achievements_m');
		$CI->load->model('user_stats_m');
		$newly_earned = array();
		$stats = $CI->user_stats_m->get($CI->session->userdata('id'));
		$achievements = $CI->achievements_m->with('conditions')->get_all();
		foreach($achievements as $key => $achievement) {
			//Check if they have achievement
			$check = $CI->user_achievements_m->get('achievement_id', $achievement->id, 'user_id', $CI->session->userdata('id'));
			if(empty($check)) {
				if(test_conditions($stats, $achievement->conditions) == true) {
					array_push($newly_earned, $achievement);
					$achievements[$key]->owned = true;
				} else
					$achievements[$key]->owned = false;
			} else
				$achievements[$key]->owned = true;
		}
		if($include_all == false) {
			return $newly_earned;
		}
		return array(	'new'	=>	$newly_earned,
						'achievements'=>$achievements);
	}
}
?>