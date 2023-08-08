<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
class Getoffence_api extends REST_Controller {

    public function __construct()
    {
     	parent::__construct();
        $this->load->model("Offence_model", "offence");
	    $this->load->model("Authorization_model");
	 	$this->load->helper(array('form', 'url'));


	}

	function offence_get()
	{
	 	header('Content-type: application/json');
		$Data = json_decode(file_get_contents('php://input'),true);
		$Data = $Data;

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';

		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password);
		if($returnAuth == 1)
		{
			$data1 = $this->offence->getoffence(0);

			if(!empty($data1)){

				$data['data']['status'] = 'Success';
				$data['data']['message'] = 'Data Found Successfully';
				$data['data']['response_code'] = '200';
				$data['data']['info'] = $data1;
				$this->response($data);
			}
			else
			{
				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'No Data Found';
				$data['data']['response_code'] = '400';
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

	function offence_post()
	{
	 	header('Content-type: application/json');
		$Data = json_decode(file_get_contents('php://input'),true);
		$Data = $Data;

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';

		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password);
		if($returnAuth == 1)
		{
			$data1 = $this->offence->getoffence($Data);

			if(!empty($data1)){

				$data['data']['status'] = 'Success';
				$data['data']['message'] = 'Data Found Successfully';
				$data['data']['response_code'] = '200';
				$data['data']['info'] = $data1;
				$this->response($data);
			}
			else
			{
				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'No Data Found';
				$data['data']['response_code'] = '400';
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