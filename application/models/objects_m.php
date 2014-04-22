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
	public $has_many = array(	'ingredients'	=>	array(	'model'			=>	'object_ingredients_m',
															'primary_key'	=>	'object_id'),
								'object_images'	=>	array(	'model'			=>	'object_images_m',
															'primary_key'	=>	'object_id'));
	
	/**
	 * Specifically collects and formats data for output in feed
	 */
	public function get_feed() {
		$result = $this->db->query("SELECT objects.*, users.firstname, users.avatar,
									users.lastname, clips.id as is_clipped,
									GROUP_CONCAT(CONCAT(i.quantity, ' ', i.unit, ' ', ingredients.name )) as ingredients,
									GROUP_CONCAT(CONCAT('uploads/recipes/', img.object_id, '/', img.name,'.',img.extension)) as object_images
									FROM (objects) JOIN users ON users.id = objects.user_id 
									LEFT JOIN object_ingredients as i ON objects.id = i.id
									LEFT JOIN ingredients ON i.ingredient_id = ingredients.id
									LEFT JOIN object_images as img ON objects.id = img.object_id
									LEFT JOIN clips ON objects.id = clips.object_id AND clips.user_id = ?
									GROUP BY objects.id
									ORDER BY created_on DESC", array($this->session->userdata('id')));
		if($result->num_rows > 0)
			return $result->result_array();
		return false;
	}
	
	public function get_by_id($id) {
		$result = $this->db->query("SELECT objects.*, users.firstname, users.avatar,
									users.lastname, 
									GROUP_CONCAT(CONCAT(i.quantity, ' ', i.unit, ' ', ingredients.name )) as ingredients,
									GROUP_CONCAT(CONCAT('uploads/recipes/', img.object_id, '/', img.name,'.',img.extension)) as object_images
									FROM (objects) JOIN users ON users.id = objects.user_id 
									LEFT JOIN object_ingredients as i ON objects.id = i.id
									LEFT JOIN ingredients ON i.ingredient_id = ingredients.id
									LEFT JOIN object_images as img ON objects.id = img.object_id
									WHERE objects.id = ? LIMIT 1", array($id));
		if($result->num_rows > 0)
			return $result->row();
		return false;
	}
	
	public function user($user_id) {
		$result = $this->db->query("SELECT objects.*, users.firstname, users.avatar,
									users.lastname, 
									GROUP_CONCAT(CONCAT(i.quantity, ' ', i.unit, ' ', ingredients.name )) as ingredients,
									GROUP_CONCAT(CONCAT('uploads/recipes/', img.object_id, '/', img.name,'.',img.extension)) as object_images
									FROM (objects) 
									LEFT JOIN users ON users.id = objects.user_id 
									LEFT JOIN object_ingredients as i ON objects.id = i.id
									LEFT JOIN ingredients ON i.ingredient_id = ingredients.id
									LEFT JOIN object_images as img ON objects.id = img.object_id
									WHERE objects.user_id = ?
									GROUP BY objects.id
									ORDER BY created_on DESC", array($user_id));
		if($result->num_rows > 0)
			return $result->result_array();
		return false;
	}
}

/* End of file objects_m.php */
/* Location: ./application/models/objects_m.php */
