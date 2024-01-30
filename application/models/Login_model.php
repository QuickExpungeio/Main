<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	    function __construct() {
        parent::__construct();
        $this->load->database();

    }

    public function validate_user($data) {

        if(!empty($data['email'])){

            $this->db->select('uid,email');
            $this->db->from('user_master');
            $this->db->where('email',$data['email']);
            $this->db->where('password',base64_encode($data['password']));
            $query = $this->db->get()->row();
            if(!empty($query)){
                $this->db->update('user_master',array('deviceid'=>$data['deviceid'],'token'=>$data['token']),array('uid',$query->uid));
            }

        }
		return $query;
    }

    public function isadmin_user($data) {

        if(!empty($data['email'])){

            $this->db->select('uid,email,user_role,username');
            $this->db->from('user_master');
            $this->db->where('email',$data['email']);
            $this->db->where('password',base64_encode($data['password']));
            // $this->db->where('user_role!=','appuser');
            $query = $this->db->get()->row();

        }
		return $query;
    }
	public function user_verification($type)
	{
		$this->db->select(array('is_validate'));
		$this->db->from('user_master');
	 	$this->db->where('uid',$type);
		$query = $this->db->get();
		//print $this->db->last_query();
		$data = $query->row();
		return $data;

	}
	public function getcodeverification($type)
	{
		$uid=$type['uid'];
		$validate_code=$type['validate_code'];
		$this->db->from('user_master');
	 	$this->db->where('uid', $uid);
		$this->db->where('validate_code',$validate_code);
		$query = $this->db->get()->row();
        $data=0;

        if(!empty($query)){

            $this->db->update('user_master',array('is_validate'=> 1),array('uid'=>$query->uid));
            $data=1;
            $username = !empty($query->username)?$query->username:"User";
            $email = $query->email;
            $message = '';
            $message.='<html>
                        <body style="margin:0px; font-family:Helvetica; font-size:16px;">
                            <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F5F5F5;margin:0px;">
                                <tr>
                                    <td align="center" valign="top">
                                        <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                            <tr>
                                <td align="center" valign="top">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader">
                                        <tr>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
            </table>
                        <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer" style="background:#FFF">

                    <tr>
                    <td style="background:linear-gradient(to right, #ffbf96, #fe7096)">
                   <center>Quick Expunge </center>
                    </td>
                    </tr>
                            <tr>
                    <td><p>Dear '.$username.'</p><p>Your email authentication done successfully </p></td>
                            </tr>';

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
                 $this->load->library('email', $config);
                 $this->email->set_newline("\r\n");
                 $this->email->from('info@quickexpunge.io'); // change it to yours
                 $this->email->to($email);// change it to yours
                 $this->email->subject('Quick Expunge Email Authentication');
                 $this->email->message($message);
		}

		return $data;
	}
	public function register_user($data)
	{
		$code = rand(1000,9999);
		//$username= $data['username'];
		//$case_no= $data['case_no'];
		$password= base64_encode($data['password']);
		$role= 'appuser';
		$email= $data['email'];
        $verification_id= $data['verification_id'];
		//$gender=$data['gender'];
		//$birthday=$data['birthday'];
		//$phone_no=$data['phone_no'];
		//$address=$data['address'];
		//$city=$data['city'];
		//$zipcode=$data['zipcode'];
		$deviceid= $data['deviceid'];
		$token= $data['token'];

		$post_data = array("user_role"=>$role,'password'=>$password,'email'=>$email,'verification_id'=>$verification_id,'deviceid'=>$deviceid,'token'=>$token,"validate_code"=>$code);

		$this->db->insert('user_master',$post_data);
        $lastUid = $this->db->insert_id();

        $message='';

        $message = '<!DOCTYPE html>
        <html>
        <head>
            <title>Quick Expunge</title>
        </head>
        <body>
        <table border="0" cellpadding="20" cellspacing="0" width="600" id="m_7280924289489755837emailContainer" style="background:#fff">

         <tbody><tr>
         <td style="background:#67d3e0">
         <center>Quick Expunge</center>
         </td>
         </tr>
         <tr>
         <td align="center" valign="top">
         <table border="0" cellpadding="0" cellspacing="0" width="100%" id="m_7280924289489755837emailBody">
         <tbody><tr>
         <td>
         <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody><tr> <td valign="top" style="text-align:center;font-size:16px;color:#6b688f;line-height:125%;padding-bottom:20px"> Thanks for Registration,<br>  <b>Registration Code</b> is <b>'.$code.'</b> </td> </tr>
         </tbody></table>
         </td>
         </tr>

         </tbody></table>
         </td>
         </tr>
         <tr style="background-color:#393939">
         <td align="center" valign="top">
         <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tbody><tr> <td valign="top" style="font-size:12px;text-align:center;color:#ffffff">
         Copyright 2018 | <a style="color:#fff" href="https://quickexpunge.io" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://https://quickexpunge.io/&amp;source=gmail&amp;ust=1625224149194000&amp;usg=AFQjCNHunyW6kiOSB8ffQKF1Kgl7sSFJNg">Quick Expunge</a>.</td> </tr> </tbody></table>
         </td>
         </tr>
         </tbody></table>


        </body>
        </html>';

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
             $this->load->library('email', $config);
             $this->email->set_newline("\r\n");
             $this->email->from('info@quickexpunge.io'); // change it to yours
             $this->email->to($email);// change it to yours
             $this->email->subject('Quick Expunge Email Authentication');
             $this->email->message($message);//$lastUid

            if($this->email->send()){

                $data= 'Email sent. Please check your email address';
		    }
	        else{
		        $data = show_error($this->email->print_debugger());
		    }

         $result['message'] = $data;
         $result['uid'] = $lastUid;
         return $result;
	}

	//reSend OTP

	public function reSendOTP_user($type)
	{
        $res="";

		$code = rand ( 1000 , 9999 );
		$email= $type['email'];
        $post_data=array('validate_code'=>$code);
        $this->db->where('uid',$type['uid']);


		if($this->db->update('user_master',$post_data)){

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

            $message = '';
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('info@quickexpunge.io'); // change it to yours
            $this->email->to($email);// change it to yours
            $this->email->subject('Quick Expunge Email Authentication');
            $this->email->message('<html>
                  <body style="margin:0px; font-family:Helvetica; font-size:16px;">
                  <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color:#F5F5F5;margin:0px;">
                      <tr>
                          <td align="center" valign="top">
                  <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer">
                  <tr>
                                      <td align="center" valign="top">
                                          <table border="0" cellpadding="20" cellspacing="0" width="100%" id="emailHeader">
                                              <tr>

                                              </tr>
                                          </table>
                                      </td>
                                  </tr>
                  </table>
                              <table border="0" cellpadding="20" cellspacing="0" width="600" id="emailContainer" style="background:#FFF">

                          <tr>
                          <td style="background:linear-gradient(to right, #ffbf96, #fe7096)">
						 <center>Quick Expunge</center>
                          </td>
                          </tr>
                                  <tr>
                                      <td align="center" valign="top">
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%" id="emailBody">
                               <tr>
                         <td>
                         <table border="0" cellpadding="0" cellspacing="0" width="100%">   <tr> <td valign="top" class="textContent" style="text-align:center;font-size:16px;color:#6B688F;line-height: 125%;padding-bottom: 20px;" > Thanks for Registration,<br>  <b>Registration Code</b> is <b>'.$code.'</b> </td> </tr>
                        </table>
                         </td>
                         </tr>

                                          </table>
                                      </td>
                                  </tr>
                                  <tr style="background-color:#393939;">
                                      <td align="center" valign="top">
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%"> <tr> <td valign="top" class="textContent" style="font-size:12px;text-align:center;color:#FFFFFF;">
										  Copyright 2018 | <a href="http://bhavitechnologies.com/" target="_blank">Bhavi Technologies</a>.</td> </tr> </table>
                                      </td>
                                  </tr>
                              </table>
                          </td>
                      </tr>
                  </table>
                  </body>
                  </html>');
            if($this->email->send()){

                $data= 'Email sent. Please check your email address';

            }else{
                $data = show_error($this->email->print_debugger());
            }

            return $data;
        }else{
            return $res;
        }
    }

    function __destruct() {
        $this->db->close();
    }

}