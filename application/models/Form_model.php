<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function getrace()
	{

		return $this->db->get("race")->result();
	}
	function getstate()
	{

		return $this->db->get("state")->result();
	}
	function getagency()
	{

		return $this->db->get("agency_webpage")->result();
	}
	function getoffence()
	{

		return $this->db->select("id ,short_description ", FALSE)->from('offence')->where('status', 'ACTIVE')->order_by("id", "desc")->get()->result();
	}
	function getcharge()
	{
		return $this->db->get_where("charges", array('id' => 1))->row();
	}
	function getcity()
	{
		return $this->db->get("city")->result();
	}
	function isemailexist($email)
	{
		return $this->db->get_where("user_master", array("email" => $email))->num_rows();
	}

	function expungedatastore($data, $password)
	{
		$result = array();

		if (!empty($data)) {

			$isUserExist = $this->db->select('uid,email')->from('user_master')->where('email', $data['email'])->get()->row();
			$lastId = "";

			if (empty($isUserExist)) {

				$userData = array(
					'user_role' => 'appuser',
					'email' => $data['email'],
					'password' => base64_encode($password),
					'is_validate' => '1',
					'username' => ucfirst($data['firstname']) . " " . ucfirst($data['lastname'])
				);
				$this->db->insert('user_master', $userData);
				$UserId = $this->db->insert_id();

				$data['uid'] = $UserId;
				$this->db->insert('expungument', $data);
				$lastId = $this->db->insert_id();
			} else {

				$data['uid'] = $isUserExist->uid;
				$this->db->insert('expungument', $data);
				$lastId = $this->db->insert_id();
			}
			$this->sendEmail($lastId, $data['email'], $data['firstname'], $data['lastname'], 0);
			$this->sendEmail($lastId, $data['email'], $data['firstname'], $data['lastname'], 1);
			$result['data'] = $data['uid'];
			$result['email'] = $data['email'];
			$result['applicationID'] = $lastId;
			$result['message'] = "Successfull";
		} else {

			$result['data'] = false;
			$result['message'] = "Fill All Data Properly";
		}
		return $result;
	}

	function sendotp($email)
	{
		$response = array();
		$code = rand(11111, 99999);
		$verificationData = array("email" => $email, "code" => $code);

		$isEmailExist = $this->db->get_where("email_verification", array("email" => $email))->row();
		if (empty($isEmailExist)) {
			$this->db->insert("email_verification", $verificationData);
		} else {
			$code = $isEmailExist->code;
		}
		$mailContaint = $this->db->get_where('wiki', array('id' => 5))->row();
		$logo = base_url('assets/images/logo.png');
		//$msg = "Your want to register with us, and you must have to verify your email address. so for verify email your OTP for verification is <b>" . $code . "</b> . <br><br>For further communication, please Log in to the https://form.henrycountyda.org/.";
		$replaceTo = array("__LOGO__", "__TITLE__", "__THANKSTAX__", "__APPLICATIONTEXT__", "__CODE__");
		$replaceFrom = array($logo, "Email Verification", "Thanks for Registration", "Account Verification Code is", $code);

		$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
		$to = $email;
		$subject = $mailContaint->subject;
		$message = $newContaint;

		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.dreamhost.com',
			'smtp_port' => "465",
			'smtp_user' => 'no_reply@quickexpunge.io', // change it to yours
			'smtp_pass' => '1L0vefreedom', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('no_reply@quickexpunge.io'); // change it to yours
		$this->email->to($to); // change it to yours
		$this->email->subject($subject);
		$this->email->message($message);
		$isMailSent = $this->email->send();

		if ($isMailSent) {

			$response['message'] = "Mail has been sent successfully";
			$response['code'] = 200;
		} else {
			$response['message'] = "Email not sent successfuly!! Please Try Again";
			$response['code'] = 400;
		}

		return $response;
	}

	function verifyotp($email, $otp)
	{
		$response = array();
		$isEmailExist = $this->db->get_where("email_verification", array("email" => $email, "code" => $otp))->row();
		if (!empty($isEmailExist)) {

			$this->db->delete("email_verification",array("email" => $email));
		
			$response['message'] = "Email verification has been done successfully";
			$response['code'] = 200;
		
		} else {
			$response['message'] = "Invalid OTP";
			$response['code'] = 400;
		}
		return $response;
	}

	private function sendEmail($applicationID,$email,$fname,$lname,$forAdmin=0){

	   if($forAdmin==1){

			$mailContaint = $this->db->get_where('wiki', array('id' => 4))->row();
			$logo = base_url('assets/images/logo.png');
			$msg = " New application received from = " . ucfirst($fname) . " " . ucfirst($lname) . ",.<br>Thank you in advance for your patience<br>Your application id is <b>" . $applicationID . "</b>";
			$replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__");
			$replaceFrom = array($logo, "New Application Received", $fname . " " . $lname, $msg);
			$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
			$to = "no_reply@quickexpunge.io";
			$subject = $mailContaint->subject;
			$message = $newContaint;
		} else {
			$mailContaint = $this->db->get_where('wiki', array('id' => 1))->row();
			$logo = base_url('assets/images/logo.png');
			$url = "<a href=" . base_url('admin/login') . ">Click here</a>";
			$msg ="Your application has been successfully submitted, We wil now consider your ENTIRE record for possible restricton , You do not need to resubmit the application if you have additional charges.<br>For further communication, please Log in to the ".$url.",<br>Your application id is <b>".$applicationID."</b>";
			$replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__", "__Clickhere__");
			$replaceFrom = array($logo, "Application Submited", $fname . " " . $lname, $msg, $url);

			$newContaint = str_replace($replaceTo,$replaceFrom,$mailContaint->description);
			$to = $email;
			$subject = $mailContaint->subject;
			$message = $newContaint;
	   }
	   $config = array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.dreamhost.com',
	      'smtp_port' => "465",
	      'smtp_user' => 'no_reply@quickexpunge.io', // change it to yours
	      'smtp_pass' => '1L0vefreedom', // change it to yours
	      'mailtype' => 'html',
	      'charset' => 'iso-8859-1',
	      'wordwrap' => TRUE
	   );
	   $this->load->library('email', $config);
	   $this->email->set_newline("\r\n");
	   $this->email->from('no_reply@quickexpunge.io'); // change it to yours
	   $this->email->to($to);// change it to yours
	   $this->email->subject($subject);
	   $this->email->message($message);
	   $this->email->send();
	}

}
