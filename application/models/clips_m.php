<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store user clips
 * @author Kevin Kern
 * @version 1.0
 */
class Clips_m extends MY_Model {
	public $_table = 'clips';
	public $primary_key = 'id';
	public $belongs_to = array('object'	=>	array(	'model'			=>'objects_m',
													'primary_key'	=>'object_id'),
								'user'	=>	array(	'model'			=>'users_m',
													'primary_key'	=>'user_id'));
}

/* End of file clips_m.php */
/* Location: ./application/models/clips_m.php */
