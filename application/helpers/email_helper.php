<?php

if (!function_exists('email_send')) {
   function email_send($to,$from,$subject,$message){

      $CI = get_instance();
      $response=array();
      $config = array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.dreamhost.com',
	      'smtp_port' => "465",
	      'smtp_user' => 'info@quickexpunge.io', // change it to yours
	      'smtp_pass' => '1L0vefreedom', // change it to yours
	      'mailtype' => 'html',
	      'charset' => 'iso-8859-1',
	      'wordwrap' => TRUE
	   );
	   $CI->load->library('email', $config);
	   $CI->email->set_newline("\r\n");
	   $CI->email->from('info@quickexpunge.io'); // change it to yours
	   $CI->email->to($to);// change it to yours		
	   $CI->email->subject($subject);
	   $CI->email->message($message);
	   // $CI->email->send();
      $isMailSent = $CI->email->send();

		if ($isMailSent) {

			$response['message'] = "Mail has been sent successfully";
			$response['code'] = 200;
		} else {
	// 		$errors = $CI->email->print_debugger();
   //  print_r($errors);
			$response['message'] = "Email not sent successfuly!! Please Try Again";
			$response['code'] = 400;
		}
      return $response;
   }
}







?>