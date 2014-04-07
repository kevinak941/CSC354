<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store tag data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class User_stats_m extends MY_Model {
	public $_table = 'user_stats';
	public $primary_key = 'user_id';
	
	public function get($id) {
		$check = parent::get($id);
		if( ! empty($check))
			return $check;
		else {
			$insert['user_id'] = $id;
			parent::insert($insert);
			get($id);
		}
	}
	
	public function update($id, $data) {
		$check = parent::get($id);
		if(empty($check) ) {
			$up['user_id'] = $id;
			parent::insert($up);
		}
		return parent::update($id, $data, TRUE);
			
	}
}

/* End of file user_stats_m.php */
/* Location: ./application/models/user_stats_m.php */
