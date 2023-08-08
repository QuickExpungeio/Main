<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
require_once(APPPATH.'/libraries/stripe.php');
//require_once(APPPATH.'vendor/autoload.php');

class Stripepayment_api extends REST_Controller {

    public function __construct() {

       parent::__construct();
       $this->load->model('Authorization_model');
       $this->load->model("Payment_model");
    }

	function payment_post()
	{
		header('Content-type: application/json');

		$Data = json_decode(file_get_contents('php://input'),true);

		$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';
		$returnAuth =  $this->Authorization_model->checkValidLogin($username,$password); //echo $returnAuth ; die;
		if($returnAuth == 1){

	        if(!empty($Data)){

	       		$data1 = $this->Payment_model->check($Data);

	   			// $data['data']['status'] = 'success';
				// $data['data']['message'] = 'Your payment is completed successfully!';
				// $data['data']['response_code'] = '200';
				// $data['data']['response'] = $data1;
				// $this->response($data);

				if((!isset($data1['Status']) )|| $data1['Status'] == ''){
		          	$data['data']['status'] = 'success';
					$data['data']['message'] = 'Your payment is completed successfully!';
					$data['data']['response_code'] = '200';
					$data['data']['response'] = $data1;
					$this->response($data);
				}else{
					$data['data']['status'] = 'fail';
					$data['data']['message'] = $data1['Message'];
					$data['data']['response_code'] = $data1['Status'];
					$data['data']['response'] = '';
					$this->response($data);

				}
			}
			else
			{
				$data['data']['status'] = 'fail';
				$data['data']['message'] = 'Enter Valid Token';
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

}