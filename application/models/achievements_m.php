<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store achievements
 * @author Kevin Kern
 * @version 1.0
 */
class Achievements_m extends MY_Model {
	public $_table = 'achievements';
	public $primary_key = 'id';
	public $has_many = array( 'conditions' => array(	'model'=>'achievement_conditions_m',
														'primary_key'=>'achievement_id'));
}

/* End of file achievements_m.php */
/* Location: ./application/models/achievements_m.php */
