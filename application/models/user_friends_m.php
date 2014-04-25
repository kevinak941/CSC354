<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store user data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class User_friends_m extends MY_Model {
	public $_table = 'user_friends';
	public $primary_key = 'users_id_1';
	
	public function is_friend($id) {
		$result = parent::get_by(array(	'users_id_1' => $this->session->userdata('id'),
										'users_id_2' =>	$id));
		if( ! empty($result)) return TRUE;
		
		return FALSE;
	}
}

/* End of file users_m.php */
/* Location: ./application/models/users_m.php */
