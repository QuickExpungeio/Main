<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_model extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function ForgotPassword($email)
   {
      $this->db->select('username');
      $this->db->from('user_master');
      $this->db->where('email', $email);
      $query = $this->db->get()->row_array();
      return (!empty($query)) ? $query['username'] : "";
   }

   //   public function randomPassword()
   //   {
   //     $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
   //     $pass = array(); //remember to declare $pass as an array
   //     $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
   //     for ($i = 0; $i < 8; $i++)
   //     {
   //       $n = rand(0, $alphaLength);
   //       $pass[] = $alphabet[$n];
   //     }
   //     return implode($pass); //turn the array into a string
   //   }

   public function sendpasswordlink($userName, $emailOfUser)
   {


      $base64code = hash("sha256", time() . rand() * 999);
      $randomString =  $base64code . "___" . $emailOfUser;
      $randomString  = base64_encode($randomString);

      $url = '<a href="'.base_url("admin/forgotpassword/validateemail/") . $randomString.'">Click Here</a>';

      $mailContaint = $this->db->get_where('wiki', array('id' => 2))->row();
      $logo = base_url('assets/images/logo.png');

      $replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__LINK__");
      $replaceFrom = array($logo, "Forgot Password", $userName, $url);
      $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
      $to = $emailOfUser;
      $subject = $mailContaint->subject;
      $message = $newContaint;
      $emailResponse = email_send($to, "", $subject, $message);
         if ($emailResponse['code'] = 200) {
            return true;
         } else {
            return false;
         }
   }

   public function checkuservalidornot($code, $email)
   {
      $response = array();
      $getData = $this->db->get_where("user_master", array("email" => $email))->row_array();

      if (!empty($getData)) {
         if ($code == $getData['base64code']) {

            $response['message'] = "User Found";
            $response['data'] = $email;
            $response['code'] = 200;
         } else {
            $response['message'] = "Link is expaired please try again.";
            $response['code'] = 400;
         }
      } else {
         $response['message'] = "User Not Found";
         $response['code'] = 400;
      }

      return $response;
   }

   public function setnewpassword($newpassword, $email){

      //echo "<pre>";print_r($newpassword);die;

      $this->db->update("user_master",array("password"=>""),array("email"=>$email));
      $this->db->update("user_master",array("password"=>base64_encode($newpassword)),array("email"=>$email));
      $afftectedRows = $this->db->affected_rows();
      if($afftectedRows){
         $this->db->update("user_master",array("base64code"=>""),array("email"=>$email));
         return true;
      }else{
         return false;
      }

   }
}
