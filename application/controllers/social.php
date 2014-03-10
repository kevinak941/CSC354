<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Social extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('facebook', array(
			'appId'  => '528112363968653',
			'secret' => '11483470c9389315fa5b0ef0740016bd'
		));
	}
	
	public function facebook() 
	{
		if($this->input->is_ajax_request() == TRUE) {
			$provider = "Facebook";
			$this->load->model('authentications');
			$this->load->model('users');
			
			$response = $this->input->get_post('response');
			$userID = $response['authResponse']['userID'];
			$accessToken = $response['authResponse']['accessToken'];
			$expiresIn = $response['authResponse']['expiresIn'];
			$signedRequest = $response['authResponse']['signedRequest'];
			
			//Find facebook user using API
			$fb_user = $this->facebook->getUser();
			
			//Check for authentication by FB user id
			$check = $this->authentications->get(	array(	'provider'	=>	$provider,
															'uid'		=>	$userID,
															'single'	=>	TRUE));
			
			if($fb_user) {
				$this->load->helper('login_helper');
				
				$response = $this->facebook->api('/me');
				
				$username = "user_".$fb_user;
				$password = "";
				
				if($check === FALSE) {
					// Authentication does not exist for userID
					// Must be a new user
					$generate_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
					$password = md5($generate_password);
					$user_id = $this->users->add(	1, 0, "user_".$fb_user, $password, "", NULL, $generate_password);
					$this->users->init_user($user_id);
					// Let's insert one
					
					$this->authentications->insert(	array(	'provider'		=>	$provider,
															'uid'			=>	$userID,
															'access_token'	=>	$accessToken,
															'expires'		=>	$expiresIn,
															'user_id'		=>	$user_id,
															'refresh_token'	=>	$signedRequest));
											
				} else {
					// There is one, so let's use it
					// Let's check if there is a linked account
					$user_id = $check['user_id'];
					$test_user = $this->users->getByUserId($user_id, true);
					if($test_user !== FALSE) {
						// RN User exists
						$password = $test_user['password'];
					} else {
						// Unable to locate linked user id, potential creation error
						// Let's make them a new account
						$generate_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') , 0 , 10 );
						$password = md5($generate_password);
						$user_id = $this->users->add(	1, 0, "user_".$fb_user, $password, "", NULL, $generate_password);
						$this->users->init_user($user_id);
						$this->authentications->update(	array(	'user_id'		=>	$user_id),
														array(	'provider'		=>	$provider,
																'uid'			=>	$fb_user));
					}
					
					$this->authentications->update(	array(	'access_token'	=>	$accessToken,
															'expires'		=>	$expiresIn,
															'refresh_token'	=>	$signedRequest),
													array(	'provider'		=>	$provider,
															'uid'			=>	$fb_user));
															
					
				}
				$this->fb_store_user($user_id, $response);
				login($username, $password);
			}
			
		}
		
		return;
	}
	
	private function fb_store_user($user_id, $response) {
		//Contact info
		//echo json_encode($response);
		$this->load->model('values');
		
		$object_id = $this->objects->getObjectIdByType(7, $user_id);
		if($object_id !== FALSE) {
			if($response['first_name']) $this->values->updateOrAdd($object_id, 1, 1, $response['first_name']);
			if($response['last_name']) $this->values->updateOrAdd($object_id, 2, 2, $response['last_name']);
			if(isset($response['email'])) {
				$this->values->updateOrAdd($object_id, 7, 41, $response['email']);
				$this->users->update($user_id, 'email', $response['email']);
			}
			if(isset($response['location'])) {
				$loc = explode(", ", $response['location']['name']);
				$this->values->updateOrAdd($object_id, 10, 44, $loc[0]);
				$this->values->updateOrAdd($object_id, 11, 45, $loc[1]);
			}
			
		}
		
		// Make an image upload directory for user
		if( ! file_exists('./htdocs/images/uploads/'.$user_id))
			mkdir('./htdocs/images/uploads/'.$user_id);
		
		// Attempt to copy facebook avatar
		$store_path = './htdocs/images/uploads/'.$user_id.'/fb_'.$user_id.'.png';
		$get_path = $this->fb_avatar();
		if(isset($get_path)) {
			file_put_contents($store_path, file_get_contents($get_path));
			$avatar_id = $this->objects->add($user_id, "facebook avatar", 11);
			$this->values->add($avatar_id, 25, 65, "Facebook Avatar");
			$this->values->add($avatar_id, 40, 66, $store_path);
			$this->users->update($user_id, 'avatar',$store_path);
		}
		
		// Store any work information
		if(isset($response['work']) && is_array($response['work'])) {
			foreach($response['work'] as $value) {
				$work_id = $this->objects->add($user_id, "facebook work", 4);
				if(isset($value['employer']['name']))
					$this->values->add($work_id, 18, 47, $value['employer']['name']);
				if(isset($value['position']['name'])) 
					$this->values->add($work_id, 25, 52, $value['position']['name']);
				if(isset($value['location']['name'])) {
					$loc = explode(", ", $value['location']['name']);
					$this->values->add($work_id, 10, 191, $loc[0]);
					$this->values->add($work_id, 11, 192, $loc[1]);
				}
			}
		}
		
		// Store education history
		if(isset($response['education']) && is_array($response['education'])) {
			foreach($response['education'] as $value) {
				$education_id = $this->objects->add($user_id, "facebook education", 12);
				if(isset($value['school']) && isset($value['school']['name']))
					$this->values->add($education_id, 33, 56, $value['school']['name']);
				if(isset($value['year']) && isset($value['year']['name']))
					$this->values->add($education_id, 31, 58, $value['year']['name']);
				if(isset($value['concentration']) && isset($value['concentration'][0]['name']))
					$this->values->add($education_id, 31, 58, $value['concentration'][0]['name']);
			}
		}
		
		$profile_id = $this->objects->getObjectIdByType(5, $user_id);
		if($profile_id !== FALSE) {
			if(isset($response['bio']))
				$this->values->updateOrAdd($profile_id, 89, 202, $response['bio']);
		}
		
	}
	
	private function fb_avatar() {
		$response = $this->facebook->api(	'me/picture',
											'GET',
											array( 'redirect'=>FALSE,
													'height'=>'200',
													'type'	=>	'normal',
													'width'	=>	'200')
								);
		return $response['data']['url'];
		
	}
}