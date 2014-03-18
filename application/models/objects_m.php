<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store object data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Objects_m extends MY_Model {
	public $_table = 'objects';
	public $primary_key = 'id';
	
	public function get_feed() {
		$this->db->select('objects.*, users.firstname, users.lastname');
		$this->db->from($this->_table);
		$this->db->join('users', 'users.id = objects.user_id');
		
		$result = $this->db->get();
		if($result->num_rows > 0)
			return $result->result_array();
		return false;
	}
}

/* End of file objects_m.php */
/* Location: ./application/models/objects_m.php */