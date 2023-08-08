<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
class Login_api extends REST_Controller {


	public function __construct() {

        //load user model
		parent::__construct();
       $this->load->model("Login_model", "login");
	   $this->load->model("Authorization_model");

    }
	function login_post()
	{
		header('Content-type: application/json');
		$Data = json_decode(file_get_contents('php://input'),true);
		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';

		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password);

		if($returnAuth == 1){

			$log['email'] = $Data['email'];

			$log['password'] = $Data['password'];
			$log['deviceid'] = $Data['deviceid'];
			$log['token'] = $Data['token'];

			$data1 = $this->login->validate_user($log);

			if(!empty($data1))
			{
				$verification = $this->login->user_verification($data1->uid);

				if(empty($verification->is_validate))
				{
					$verification->is_validate='0';
					$otp = $this->login->loginotp_user($data1);
				}
			}
			if(empty($data1)){

				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'Please enter valid username / password.';
				$data['data']['response_code'] = '400';
				$this->response($data);
			}else{

				$data['data']['status'] = 'success';
				$data['data']['message'] = 'Login successfully';
				$data['data']['response_code'] = '200';
				$data['data']['verification'] = $verification->is_validate;
				$data['data']['userdetail'] = $data1;
				$this->response($data);
			}

		}else{

			$data['data']['status'] = 'fail';
			$data['data']['message'] = 'User is not Authoeized.';
			$data['data']['response_code'] = '430';
			$this->response($data);
		}
	}
}