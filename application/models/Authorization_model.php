<?php   
defined('BASEPATH') OR exit('No direct script access allowed'); 
class Authorization_model extends CI_Model {  
	public function checkValidLogin($username,$password) {
		if (empty($username) || empty($password))
		{
			header('HTTP/1.0 401 Unauthorized');
			header('HTTP/1.1 401 Unauthorized');
			header('WWW-Authenticate: Basic realm="My Realm"');
			return 0;
			//echo 'You must login to use this service'; // User sees this if hit cancel
			//die();
		}else{
			$fetchSetCredential = $this->config->item('rest_valid_logins'); //print_r($fetchSetCredential); die;
			if($username == $fetchSetCredential['username'] && $password == $fetchSetCredential['pass'])  
				return "1"; 
			else 
				return "0"; 
		}
   	}
  }
 
 
