<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Objects Controller
 *
 * @author Kevin Kern
 * @version 1.0
 */
class Objects extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->model('objects_m');
		//if( ! $this->input->is_ajax_request()) 
			//exit;
	}
	
	/**
	 * Creating an object
	 */
	public function create() {

		$this->load->model('tags_m');
		$this->load->model('objects_m');
		$this->load->library('form_validation');

		$index = $this->input->post('object_create_index');
		// Set validation rules for input
		//$this->form_validation->set_rules('object_create_tags', 'Tags', 'trim|xss_clean|required');
		$this->form_validation->set_rules('object_create_name', 'Name', 'trim|xss_clean|required');
		//$this->form_validation->set_rules('object_create_cost', 'Cost', 'trim|xss_clean|required');
		//foreach($index as $key => $value) {
			//$this->form_validation->set_rules('object_create_quantity_'.$key, 'Quantity', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('object_create_ingredient_'.$key, 'Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('object_create_unit_'.$key, 'Unit', 'trim|xss_clean|required');

		//}

		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$this->load->model('object_tags_m');
			$this->load->model('object_images_m');
			$this->load->model('tag_groups_m');
			$this->load->model('object_ingredients_m');
			$this->load->model('ingredients_m');
			$this->load->model('object_directions_m');
			$this->load->model('user_stats_m');
			
			// Retrieve user input 
			$name = $this->input->post('object_create_name');
			$tags = $this->input->post('object_create_tags');
			$order = $this->input->post('object_create_order');
			$cost = $this->input->post('object_create_cost');
			
			// Add new object 
			$object_id = $this->objects_m->insert(	array(	'user_id'	=>	$this->session->userdata('id'),
															'name'		=>	$name,
															'tags'		=>	$tags,
															'cost'		=>	$cost));
															
			if(isset($_FILES["image"])) {
				if ($_FILES["image"]["error"] == UPLOAD_ERR_OK) {
					if(is_dir(UPLOAD_PATH .'recipes/'.$object_id) == FALSE)
						mkdir(UPLOAD_PATH .'recipes/'.$object_id);
					$name = $_FILES["image"]["name"];
					$path_parts = pathinfo($name);
					move_uploaded_file( $_FILES["image"]["tmp_name"], UPLOAD_PATH . "recipes/{$object_id}/" . $_FILES['image']['name']);
					$this->object_images_m->insert(	array	(	'users_id'	=>	$this->session->userdata('id'),
																'object_id'	=>	$object_id,
																'name'		=>	$path_parts['filename'],
																'extension'	=>	$path_parts['extension'],
																'size'		=>	$_FILES["image"]["size"]));
				}
			}
			
			// Handle tags
			$split_tags = explode(',', $tags);
			if(count($split_tags) > 1) {
				// More then one tag detected
				// Add a tag grouping
				$group_id = $this->tag_groups_m->insert(array('name'	=>	$name), TRUE);
				foreach($split_tags as $tag) {
					$tag = trim($tag);
					$check_tag = $this->tags_m->get_by(array('name'=>strtolower($tag)));
					if( ! empty($check_tag)) {
						$tag_id = $check_tag->id;
					} else {
						$tag_id = $this->tags_m->insert(	array(	'name'	=>	strtolower($tag),
																	'value'	=>	$tag));
					}
					$this->object_tags_m->insert(	array(	'object_id'	=>	$object_id,
															'tag_id'	=>	$tag_id,
															'group_id'	=>	$group_id));
				}
			} else if(count($split_tags == 1)) {
				$check_tag = $this->tags_m->get_by(array('name'=>$split_tags[0]));
				if(empty($check_tag)) {
					$tag_id = $this->tags_m->insert(	array(	'name'	=>	strtolower($tag),
																'value'	=>	$tag));
				}
			}
			
			// Increase stats for recipes
			//$this->user_stats_m->update(	$this->session->userdata('id'),	array(	'recipes' => '+1'));
			$this->user_stats_m->update_stat($this->session->userdata('id'), 'recipes', 1);
			
			// Handle ingredients
			if(count($index) > 0) {
				foreach($index as $key => $ingre) {
					// Attempt to match ingredient to existing
					$name = $this->input->post('object_create_ingredient_'.$key);
					if( isset($name) ) {
						$value = $name;
						$name = strtolower(trim($name));
						$check = $this->ingredients_m->get_by('name', $name);
						if( ! empty($check)) {
							$ingre_id = $check->id;
						} else {
							// Insert new ingredient 
							$ingre_id = $this->ingredients_m->insert(	array(	'name'	=>	$name,
																				'value'	=>	$value));
						}
						
						$fractionOption = array();
						$fractionOption['0/8'] = 0;
						$fractionOption['1/8'] = 0.125;
						$fractionOption['1/4'] = 0.25;
						$fractionOption['3/8'] = 0.375;
						$fractionOption['1/2'] = 0.5;
						$fractionOption['5/8'] = 0.625;
						$fractionOption['3/4'] = 0.75;
						$fractionOption['7/8'] = 0.875;
						$fractionOption['8/8'] = 1;
						$fractionOption['1/16'] = 0.0625;
						$qua = $this->input->post('object_create_quantity_'.$key);
						if(isset($fractionOption[$qua])) $qua = $fractionOption[$qua];
						// Add ingredient to object
						$this->object_ingredients_m->insert(	array(	'quantity'	=>	$qua,
																		'unit'		=>	$this->input->post('object_create_unit_'.$key),
																		'ingredient_id'	=>	$ingre_id,
																		'object_id'	=>	$object_id));
					}
				}
			}
			
			// Handle ingredients
			if(count($order) > 0) {
				foreach($order as $key => $direct) {
					// Attempt to match ingredient to existing
					$text = $this->input->post('object_create_direction_'.$key);
					if( isset($text) && $text != "") {
						$this->object_directions_m->insert(array(	'object_id'	=>	$object_id,
																	'order'		=>	$key,
																	'text'		=>	$text));
					}
				}
			}
			
			json_response('success',  array('note'	=>	array(	'type'	=> 'success',
																'text'	=> 'Item created')));
		}
	}
	
	public function edit($id) {
		$this->load->model('tags_m');
		$this->load->model('objects_m');
		$this->load->library('form_validation');
		
		// Set validation rules for input
		$this->form_validation->set_rules('object_edit_tags', 'Tags', 'trim|xss_clean|required');
		$this->form_validation->set_rules('object_edit_name', 'Name', 'trim|xss_clean|required');
		
		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$this->load->model('object_tags_m');
			$this->load->model('tag_groups_m');
			
			// Retrieve user input
			$name = $this->input->post('object_edit_name');
			$tags = $this->input->post('object_edit_tags');
			
			//TODO: Modifiy tags
			
			// Update existing object
			$object_id = $this->objects_m->update(	$id, 
													array(	'name'		=>	$name,
															'tags'		=>	$tags));
															
			json_response('success', array('note'	=>	array(	'type'	=> 'success',
																'text'	=> 'Item saved')));
		}
	}	
	
	public function view() {
		$this->load->model('ingredients_m');
		$this->load->model('object_ingredients_m');
		$this->load->model('users_m');
		$this->load->model('object_directions_m');
		$id = $this->input->get('id');
		if($id != null) {
			$result = $this->objects_m->get_by_id($id);
			if( ! empty($result)) {
				// Check for ingredients 
				$ingres = $this->object_ingredients_m->with('data')->get_many_by('object_id', $id);
				if( ! empty($ingres)) {
					// Object has ingredients 
					
					// Convert decimal to fractional
					foreach($ingres as $key => $value) {
						// Strip trailing 0's
						$temp_value = (float)$value->quantity;
						// Split at decimal point
						$split = explode('.', $temp_value);
						// Make sure split worked, else ignore ingredient
						if(isset($split[1])) {
							// Pull out whole number
							$base = $split[0];
							$temp_value = $split[1];
							// Check value after decimal point
							switch($temp_value) {
								case 0625: 
									$temp_value = "1/16";
									break;
								case 125: 
									$temp_value = "1/8";
									break;
								case 25: 
									$temp_value = "1/4";
									break;
								case 375: 
									$temp_value = "3/8";
									break;
								case 5: 
									$temp_value = "1/2";
									break;
								case 625: 
									$temp_value = "5/8";
									break;
								case 75: 
									$temp_value = "3/4";
									break;
								case 875: 
									$temp_value = "7/8";
									break;
								default:
									break;
							}
							$temp_value = ((int)$base > 0 ? (String)$base : '') . ' ' . (String)$temp_value;
						}
						$ingres[$key]->quantity = $temp_value;
					}
					$result->ingredients = $ingres;
				}
				$directions = $this->object_directions_m->get_many_by('object_id', $id);
				if( ! empty($directions)) {
					$result->directions = $directions;
				}
				$result->is_owner = ($this->session->userdata('id') == $result->user_id) ? TRUE : FALSE;
				$result->user = $this->users_m->get($result->user_id);
				json_response('success', $result);
				return;
			}
		}
		json_response('error', array('message'=>'Unable to locate item'));
	}
	
	/**
	 * Creating an object
	 */
	public function search() {
		$this->load->model('tags_m');
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('object_search_search', 'Search', 'trim|xss_clean|required');

		if($this->form_validation->run() == FALSE) {
			json_validate();
		} else {
			$this->load->model('object_tags_m');
			$this->load->model('tag_groups_m');
			$this->load->model('tags_m');
			$this->load->model('ingredients_m');
			$this->load->model('object_ingredients_m');
			
			$term = strtolower($this->input->post('object_search_search'));
			$terms = explode(',', $term);
			$related_obj_ids = array();
			$ingre_match = array();
			$tag_match = array();
			foreach($terms as $key => $value) {
				$value = trim($value);
				//First check if term matches an ingredient
				$check_ingre = $this->ingredients_m->get_by(array('name'=>$value));
				if( ! empty($check_ingre)) {
					$objects_with_ingre = $this->object_ingredients_m->get_many_by(array('ingredient_id' => $check_ingre->id));
					if( ! empty($objects_with_ingre)) {
						foreach($objects_with_ingre as $ingre) {
							if( ! isset( $related_obj_ids[$ingre->object_id] ))	
								$related_obj_ids[$ingre->object_id] = 0;
							$related_obj_ids[$ingre->object_id]++;
							if( ! isset( $ingre_match[$ingre->object_id] ))	
								$ingre_match[$ingre->object_id] = array();
							$ingre_match[$ingre->object_id][] = $check_ingre->value;	
						}
					}
				}
				//Find out if tag is in system
				$check_tag = $this->tags_m->get_by(array('name'=>$value));
				if( ! empty($check_tag)) {
					// Tag is registered in system
					// Find object ids that have tag
					$objects_with_tag = $this->object_tags_m->get_many_by(array('tag_id'=>$check_tag->id));
					if( ! empty($objects_with_tag)) {
						foreach($objects_with_tag as $tag) {
							if( ! isset( $related_obj_ids[$tag->object_id] ))	
								$related_obj_ids[$tag->object_id] = 0;
							$related_obj_ids[$tag->object_id]++;
							if( ! isset( $tag_match[$tag->object_id] ))	
								$tag_match[$tag->object_id] = array();
							$tag_match[$tag->object_id][] = $check_tag->value;
						}
					}
				} else {
					//Ignore it for now, only operation would be to add it to the database, but it could be useless
				}
				
				// Try search by nae
				$check_name = $this->objects_m->search_name($value);
				if($check_name != FALSE) {
					foreach($check_name as $obj) {
						if( ! isset( $related_obj_ids[$obj['id']] ))	
							$related_obj_ids[$obj['id']] = 0;
						$related_obj_ids[$obj['id']] += 3;
					}
				}
			}

			$results = array();
			$order_results = array();
			if( ! empty($related_obj_ids)) {
				// Group object ids based on their priority rating
				foreach($related_obj_ids as $obj_id => $priority) {
					if(!isset($order_results[$priority])) $order_results[$priority] = array();
					$order_results[$priority][] = $this->objects_m->get_by_id($obj_id);
				}
			}
			//Sort by priority (highest first)
			krsort($order_results);
			foreach($order_results as $priority => $objs) {
				foreach($objs as $obj) {
					//Compile matching ingredients
					$obj->matching_ingredients = ((isset($ingre_match[$obj->id])) ? implode(', ', $ingre_match[$obj->id]) : null);
					//Compile matching tags
					$obj->matching_tags = ((isset($tag_match[$obj->id])) ? implode(', ', $tag_match[$obj->id]) : null);
					$obj->priority = (string)$priority;
					//Force removal of empty objects
					if(isset($obj->id) && $obj->id != "")
						$results[] = $obj;
				}
			}
			
			json_response('success', array('results'	=>	$results));
		}
	}
	
	/**
	 * Add a recipe to a user's clips
	 */
	public function clip() {
		$this->load->model('clips_m');
		$this->load->model('objects_m');
		$this->load->model('user_stats_m');
		$object_id = $this->input->post('object_id');
		$check = $this->clips_m->get_by(array('object_id'=> $object_id, 'user_id'=> $this->session->userdata('id')));
		if( empty($check) ) {
			//Find object
			$object = $this->objects_m->get($object_id);
			if( ! empty($object) ) {
				//$this->user_stats_m->update(	$object->user_id,	array(	'clipped' => '+1'));
				$this->user_stats_m->update_stat($object->user_id, 'clipped', 1);
				//$this->user_stats_m->update(	$object->user_id,	array(	'clip_cash' => '+'.$object->cost));
				$this->user_stats_m->update_stat($object->user_id, 'clip_cash', $object->cost);
				//$this->user_stats_m->update(	$this->session->userdata('id'),	array(	'clips' => '+1'));
				$this->user_stats_m->update_stat($this->session->userdata('id'), 'clips', 1);
				$this->clips_m->insert(array(	'user_id'	=> $this->session->userdata('id'),
												'object_id'	=>	$object_id));
				json_response('success',  array());
			} else {
				// Can't find object
				json_response('error', array('note'	=>	array(	'type'	=> 'error',
																'text'	=> 'Unable to locate object')));
			}
		} else {
			// User already clipped this recipe
			json_response('error', array('note'	=>	array(	'type'	=> 'warning',
															'text'	=> 'You already have this recipe clipped')));
		}
		
		
	}
}

/* End of file objects.php */
/* Location: ./application/controllers/objects.php */
