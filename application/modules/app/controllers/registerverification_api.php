<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
class Registerverification_api extends REST_Controller {

    public function __construct() {

        //load user model
		parent::__construct();
       	$this->load->model("Login_model", "registerverification");
	   	$this->load->model("Authorization_model");
		$this->load->helper(array('form', 'url'));
		$this->load->helper('file');
	 	$this->load->library('form_validation');

    }
	function registerverification_post(){

		header('Content-type: application/json');
		$Data = json_decode(file_get_contents('php://input'),true);
		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';

		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password);

		if($returnAuth == 1){
			$data1 = $this->registerverification->getcodeverification($Data);
			if(empty($data1)){

				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'Please valid Code';
				$data['data']['response_code'] = '200';
				//$data['data']['verification'] = $data1;
				$this->response($data);
			}
			else
			{
				$data['data']['status'] = 'success';
				$data['data']['message'] = 'Verified successfully Details';
				$data['data']['response_code'] = '200';
				//$data['data']['verification'] = $data1;
				$this->response($data);
			}
		}
		else
		{
			$data['data']['status'] = 'fail';
			$data['data']['message'] = 'User is not Authoeized.';
			$data['data']['response_code'] = '430';
			$this->response($data);
		}

	}
}