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

		return $this->db->select("id ,short_description ", FALSE)->from('offence')->where('status', 'ACTIVE')->order_by("short_description", "asc")->get()->result();
		// echo $this->db->last_query();die;
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
			$lastId = $newPassword = "";
			// echo '<pre>'.$data['fill'];print_r($isUserExist);die;
			if (empty($isUserExist)) {
			
				if($data['fill'] == 2){
					$newPassword = $this->generatePassword();
					// echo '<pre>';print_r($newPassword);die;
				}else{
					$newPassword = $password;
				}
			
				$userData = array(
					'user_role' => 'appuser',
					'email' => $data['email'],
					'password' => base64_encode($newPassword),
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
			if ($data['fill'] == 1) {
				$this->sendEmail($lastId, $data['email'], $data['firstname'],$data['lastname'],$newPassword, 0);
				$this->sendEmail($lastId, $data['email'], $data['firstname'], $data['lastname'],$newPassword, 1);
			} else {
				$this->sendEmail($lastId, $data['email'], $data['firstname'],$data['lastname'],$newPassword, 2);
			}

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

		$isMailSent = email_send($to, "", $subject, $message);

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

			$this->db->delete("email_verification", array("email" => $email));

			$response['message'] = "Email verification has been done successfully";
			$response['code'] = 200;
		} else {
			$response['message'] = "Invalid OTP";
			$response['code'] = 400;
		}
		return $response;
	}

	private function sendEmail($applicationID, $email, $fname, $lname,$newPassword,$forAdmin = 0)
	{
		
		if ($forAdmin == 1) {

			$mailContaint = $this->db->get_where('wiki', array('id' => 4))->row();
			$logo = base_url('assets/images/logo.png');
			$msg = " New application received from " . ucfirst($fname) . " " . ucfirst($lname) . " ,.<br>Application id is <b> " . $applicationID . "</b>";
			$replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__");
			$replaceFrom = array($logo, "New Application Received", $fname . " " . $lname, $msg);
			$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
			$to = "no_reply@quickexpunge.io";
			$subject = $mailContaint->subject;
			$message = $newContaint;
		} else if ($forAdmin == 0) {                                                                                                                                                                                                                                                                                                                     
			$mailContaint = $this->db->get_where('wiki', array('id' => 9))->row();
			$logo = base_url('assets/images/logo.png');
			$url = "<a href=" . base_url('admin/login') . ">Click here</a>";
			$msg = "Your application has been successfully submitted, We wil now consider your ENTIRE record for possible restricton , You do not need to resubmit the application if you have additional charges.<br>For further communication, please Log in to the " . $url . ",<br>Your application id is <b>" . $applicationID . "</b>";
			$replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__", "__Clickhere__");
			$replaceFrom = array($logo, "Application Submited", $fname . " " . $lname, $msg, $url);

			$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
			$to = $email;
			$subject = $mailContaint->subject;
			$message = $newContaint;
		} else {
			$mailContaint = $this->db->get_where('wiki', array('id' => 7))->row();
			// Generate a random password
			// $newPassword = $this->generatePassword();
			$logo = base_url('assets/images/logo.png');
			$url = "<a href=" . base_url('admin/login') . ">Click here</a>";
			$msg = "Your application has been successfully submitted, We wil now consider your ENTIRE record for possible restricton , You do not need to resubmit the application if you have additional charges.<br>For further communication, please Log in to the " . $url . ",<br>Your application id is <b>" . $applicationID . "</b>,<br>Your Email Address is <b>" . $email . "</b>,";
			if(!empty($newPassword)){
			$msg .="<br>Your Password is <b>" . $newPassword . "</b>";
			}
			$replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__", "__Clickhere__");
			$replaceFrom = array($logo, "Application Submited", $fname . " " . $lname, $msg, $url);

			$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
			$to = $email;
			$subject = $mailContaint->subject;
			$message = $newContaint;
		}
		//  echo '<pre>';print_r($message);die;
		$emailResponse = email_send($to, "", $subject, $message);
		if ($emailResponse['code'] = 200) {
			return true;
		} else {
			return false;
		}
	}
	public function generatePassword($length = 12)
	{
		// Generate a random password using letters, digits, and special characters
		// $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';
		// $password = '';
		// $charLength = strlen($characters);
		// for ($i = 0; $i < $length; $i++) {
		// 	$password .= $characters[rand(0, $charLength - 1)];
		// }
		// return $password;

		$capitalLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$smallLetters = "abcdefghijklmnopqrstuvwxyz";
		$numbersLetters = date("Y");
		$spacialLetters = "@";

			$capitalRendom  = $this->getRandomString($capitalLetters,1);
			$smallRendom  = $this->getRandomString($smallLetters,6);
			$spacialRendom  = $this->getRandomString($spacialLetters,1);
			$numberRendom  = $numbersLetters;//$this->getRandomString($numbersLetters,4);

			$pass = $capitalRendom.$smallRendom.$spacialRendom.$numberRendom;
			// echo"<pre>";print_r($pass);die;
			return $pass;

	}
	private function getRandomString($characters,$length){
		$password = "";
		$charLength = strlen($characters);
		for ($i = 0; $i < $length; $i++) {
			$password .= $characters[rand(0, $charLength - 1)];
		}
		return $password;
	}

	public function insert_contact_us($data)
	{
		$this->db->insert('contact_us', $data);

		$mailContaint = $this->db->get_where('wiki', array('id' => 6))->row();
		$logo = base_url('assets/images/logo.png');
		$replaceTo = array("__LOGO__", "__TITLE__", "__USEREMAIL__", "__CONTACTUSTEXT__");
		$replaceFrom = array($logo, "Contact Us", $data['email'], $data['comment']);
		$newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
		$to = "info@quickexpunge.io";
		$subject = $mailContaint->subject;
		$message = $newContaint;

		$emailResponse = email_send($to, "", $subject, $message);
		if ($emailResponse['code'] = 200) {
			return true;
		} else {
			return false;
		}
	}
}
