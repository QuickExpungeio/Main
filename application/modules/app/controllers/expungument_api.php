<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
class expungument_api extends REST_Controller {

    public function __construct()
    {
     	parent::__construct();
        $this->load->model("user/User_model", "expungument");
	    $this->load->model("Authorization_model");
	 	$this->load->helper(array('form', 'url'));
		$this->load->helper('file');
		$this->load->library('myuploadlibrary');
	}

	function expungument_post()
	{
	 	header('Content-type: application/json');
		$Data = json_decode($_POST['data'],true);

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';
		$verificationImage="";
		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password);
		if($returnAuth == 1)
		{

			if(!empty($_FILES["verification_id"]['name'])){

				$verificationimage = $this->myuploadlibrary->upload_single_image($_FILES,'verification_id',1,FCPATH.'uploads/');

				if (!isset($verificationimage['error'])) {

					if (isset($verificationimage)) {

							$imageName = explode("/",$verificationimage);
							$verificationImage = end($imageName);
					}
				}
			}
			if (!empty($verificationImage)) {

				$Data['verification_id'] = site_url().'/uploads/'.$verificationImage;
			}

			$data1 = $this->expungument->insertusername($Data);
			if(empty($data1)){

				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'Please valid Code';
				$data['data']['response_code'] = '400';
				$this->response($data);
			}
			else
			{
				$data['data']= $data1;
				$data['data']['status'] = 'success';
				$data['data']['message'] = 'Data Add Successfully';
				$data['data']['response_code'] = '200';
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

	function getstatus_post()
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
			$data1 = $this->expungument->getstatus($Data);

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