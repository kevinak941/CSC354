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

	public function user($id) {
		$result = $this->db->query("SELECT clips.created_on, objects.*, users.firstname, users.avatar,
									users.lastname, 
									GROUP_CONCAT(CONCAT('uploads/recipes/', img.object_id, '/', img.name,'.',img.extension)) as object_images
									FROM clips
									LEFT JOIN objects ON objects.id = clips.object_id
									LEFT JOIN users ON users.id = objects.user_id
									LEFT JOIN object_images as img ON objects.id = img.object_id
									WHERE clips.user_id = ?
									GROUP BY objects.id", array($id));
		if($result->num_rows > 0)
			return $result->result_array();
		return false;
	}	
	
	public function count_user($id) {
		$result = $this->db->query("SELECT id 
									FROM clips
									WHERE user_id = ?",
									array($id));
		return $result->num_rows;
	}
	
	public function count_clipped($id) {
		$result = $this->db->query("SELECT id
									FROM clips
									WHERE object_id IN (SELECT id FROM objects WHERE user_id = ?)",
									array($id));
		return $result->num_rows;
	}
}

/* End of file clips_m.php */
/* Location: ./application/models/clips_m.php */
