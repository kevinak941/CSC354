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
															'primary_key'	=>	'object_id'));
	
	public function get_feed() {
		$this->db->select("objects.*, users.firstname, users.lastname, GROUP_CONCAT(CONCAT(i.unit, -, i.quantity )) as ingredients");
		/*$this->db->from($this->_table);
		$this->db->order_by('created_on', 'DESC');
		$this->db->join('users', 'users.id = objects.user_id');
		$this->db->join('object_ingredients as i', 'objects.id = i.id', 'left');
		$this->db->join('ingredients', 'i.ingredient_id = ingredients.id', 'left');
		$this->db->group_by('objects.id');
		$result = $this->db->get();*/
		$result = $this->db->query("SELECT `objects`.*, `users`.`firstname`, 
									`users`.`lastname`, 
									GROUP_CONCAT(CONCAT(i.quantity, ' ', i.unit, ' ', ingredients.name )) as ingredients 
									FROM (`objects`) JOIN `users` ON `users`.`id` = `objects`.`user_id` 
									LEFT JOIN `object_ingredients` as i ON `objects`.`id` = `i`.`id`
									LEFT JOIN `ingredients` ON `i`.`ingredient_id` = `ingredients`.`id`
									GROUP BY `objects`.`id`
									ORDER BY `created_on` DESC");
		if($result->num_rows > 0)
			return $result->result_array();
		return false;
	}
}

/* End of file objects_m.php */
/* Location: ./application/models/objects_m.php */
