<?php
if( ! function_exists('json_response')) {
	/**
	 * Uniform structure for response
	 * @param (status) (String) The string status
	 * @param (data) (Array) Data to send down
	 */
	function json_response($status, $data) {
		echo json_encode(array(	'status'	=>	$status,
								'data'		=>	$data));
	}
	
	function json_validate() {
		$CI = & get_instance();
		$validation = array();
		
		foreach($_POST as $key => $value) {
			if(form_error($key) != "")
				$validation[] = array(	'name'		=>	$key,
										'message'	=> 	form_error($key));
		}
		
		json_response('validate', array(	'errors'	=>	$validation));
	}
}