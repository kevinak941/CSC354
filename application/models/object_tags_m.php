<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store tag data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Object_tags_m extends MY_Model {
	public $_table = 'object_tags';
	public $primary_key = 'object_id';
	
	public function get_groups($tag_id) {
		$return = array();
		$result = $this->db->query("SELECT group_id FROM object_tags WHERE tag_id = ? GROUP BY group_id", array($tag_id));
		if($result->num_rows() > 0)
			return $result->result_array();
		return FALSE;
	}
}

/* End of file object_tags_m.php */
/* Location: ./application/models/object_tags_m.php */
