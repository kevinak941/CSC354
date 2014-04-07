<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store user data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Users_m extends MY_Model {
	public $_table = 'users';
	public $primary_key = 'id';
	public $protected_attributes = array('password');
	
	/*public function get_by_email($email) {
		$result = parent::get_by('email', $email);
		if( ! empty($result) ) {
			$result['rank'] = 
		}
	}*/
}

/* End of file users_m.php */
/* Location: ./application/models/users_m.php */
