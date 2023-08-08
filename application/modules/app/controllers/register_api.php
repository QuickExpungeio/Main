<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/libraries/REST_Controller.php');
require_once(APPPATH.'/libraries/Format.php');
class Register_api extends REST_Controller {

    public function __construct()
    {

        //load user model
		parent::__construct();
       	$this->load->model("Login_model", "register");
	    $this->load->model("authorization_model");
	 	$this->load->helper(array('form', 'url'));
		$this->load->helper('file');
	 	$this->load->library('form_validation');
	}

	function register_post()
	{

	 	header('Content-type: application/json');
	 	$Data = json_decode(file_get_contents('php://input'),true);
	 	$username = $password = '';
		$username =  ($_SERVER['PHP_AUTH_USER'] != '') ? $_SERVER['PHP_AUTH_USER']: '';
		$password =  ( $_SERVER['PHP_AUTH_PW'] != '')  ? $_SERVER['PHP_AUTH_PW'] : '';

		$returnAuth =  $this->authorization_model->checkValidLogin($username,$password);
		if($returnAuth == 1)
		{
	 		$this->form_validation->set_data($Data);

			//$this->form_validation->set_rules($config);

			$this->form_validation->set_rules('email','email','required|valid_email|is_unique[user_master.email]');
			//$this->form_validation->set_rules('username','username','required|min_length[5]|max_length[30]|is_unique[user_master.username]');

            if($this->form_validation->run()==FALSE){
			  //print_r($this->form_validation->error_array());
			    if(!empty($this->form_validation->error_array()['email']))
				{
				  	$data['data']['status'] = 'fail';
                 	$data['data']['message'] = 'Email Already Exists';
				 	$data['data']['response_code'] = '601';
    			 	$this->response($data);
				}
			}
			else{

				//upload images
				if(!empty($Data['verification_id'])){
					$dataURL=$Data['verification_id'];
					$dataURL = str_replace('data:image/png;base64,', '', $dataURL);
					$dataURL = str_replace(' ', '+', $dataURL);
					$image = base64_decode($dataURL);
					$filename = date("d-m-Y-h-i-s") . '.' . 'png'; //renama file name based on time

					$path = realpath('uploads');
					file_put_contents($path.'/'.$filename,$image);
					$path1 = site_url().'uploads';
					$Data['verification_id']=$path1.'/'.$filename;
				}
				else
				{
					$Data['verification_id']='';
				}

				$data1 = $this->register->register_user($Data);
				$data['data']['uid'] = $data1['uid'];
				$data['data']['status'] = 'success';
				$data['data']['message'] = 'Register successfully';
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

}