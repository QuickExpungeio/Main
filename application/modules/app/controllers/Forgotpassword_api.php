<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');

class Forgotpassword_api extends REST_Controller {

    public function __construct() {

       parent::__construct();
       $this->load->model('Authorization_model');
       $this->load->model("Forgot_model");

	}

	function forgot_post()
	{
		header('Content-type: application/json');

		$Data = json_decode(file_get_contents('php://input'),true);

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';
		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password); //echo $returnAuth ; die;
		if($returnAuth == 1)
		{

			$email = $Data['email'];

			$findemail = $this->Forgot_model->ForgotPassword($email);


			if($findemail)
	        {
				$data1 = $this->Forgot_model->sendpassword($findemail);

	        	$data['data']['status'] = 'success';
				$data['data']['message'] = 'Please Check your email';
				$data['data']['response_code'] = '200';
				$this->response($data);
			}
			else
			{
				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'Enter Valid Email address';
				$data['data']['response_code'] = '103';
				$this->response($data);
			}
		}else{

			$data['data']['status'] = 'fail';
	        $data['data']['message'] = 'User is not authorized';
			$data['data']['response_code'] = '430';
			$this->response($data);
		}
	}


	function reset_post()
	{
		header('Content-type: application/json');

		$Data = json_decode(file_get_contents('php://input'),true);

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';
		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password); //echo $returnAuth ; die;
		if($returnAuth == 1)
		{
			$email = $Data['email'];

			$findemail = $this->Forgot_model->ForgotPassword($email);
			if($findemail)
	        {
				$data1 = $this->Forgot_model->sendpassword($findemail);
	        	$data['status'] = 'success';
				$data['message'] = 'Please Check your email!';
				$data['response_code'] = '200';
				$this->response($data);
			}
			else
			{
				$data['status'] = 'fail';
				$data['message'] = 'Enter Valid Email address';
				$data['response_code'] = '103';
				$this->response($data);
			}
		}else{

			$data['status'] = 'fail';
	        $data['message'] = 'User is not authorized';
			$data['response_code'] = '430';
			$this->response($data);
		}
	}


}