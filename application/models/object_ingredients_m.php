<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Used to store object ingredient data
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Object_ingredients_m extends MY_Model {
	public $_table = 'object_ingredients';
	public $primary_key = 'id';
	public $belongs_to = array(	'data' => array( 	'model'			=>	'ingredients_m',
													'primary_key'	=>	'ingredient_id'));

}

/* End of file object_ingredients_m.php */
/* Location: ./application/models/object_ingredients_m.php */
