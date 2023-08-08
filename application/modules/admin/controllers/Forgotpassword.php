<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgotpassword extends CI_Controller
{

   function __construct()
   {
      parent::__construct();
      $this->load->model("Forgot_model");
   }


   public function index()
   {
      $this->load->view('header');
      $this->load->view('forgotpassword');
      $this->load->view('footer');
   }

   public function processtoreset()
   {

      $email = $this->input->post("email");
      $this->load->library('session');

      if (!empty($email)) {

         $checkEmailExistorNot = $this->Forgot_model->ForgotPassword($email);

         if (!empty($checkEmailExistorNot)) {

            $randomString =  $this->Forgot_model->sendpasswordlink($checkEmailExistorNot, $email);

            if ($randomString) {

               $this->session->set_flashdata('success', 'Forgot password link send to your register email address , Please check your inbox');
               redirect("admin/forgotpassword");
            } else {
               $this->session->set_flashdata('error', 'Something want wrong ! please try after some time');
               redirect("admin/forgotpassword");
            }
         } else {
            $this->session->set_flashdata('error', 'Email not found try again!');
            redirect("admin/forgotpassword");
         }
      } else {
         $this->session->set_flashdata('error', 'Email not found try again!');
         redirect("admin/forgotpassword");
      }
   }
   public function validateemail()
   {
      $urlSegment  = $this->uri->segment(4);
      if (!empty($urlSegment)) {

         $emailAndCode  = base64_decode($urlSegment);
         $codeEmail = explode("___", $emailAndCode);
         $code = $codeEmail[0];
         $email = $codeEmail[1];
         $isValidate = $this->Forgot_model->checkuservalidornot($code, $email);

         if ($isValidate['code'] == 200) {

            $data['email'] = $isValidate['data'];

            $this->load->view('header');
            $this->load->view('set_new_password',$data);
            $this->load->view('footer');
         } else {
            $this->session->set_flashdata('error', $isValidate['message']);
            redirect("admin/forgotpassword");
         }
      } else {
         $this->session->set_flashdata('error', 'Invalid link! please try again');
         redirect("admin/forgotpassword");
      }
   }
   public function resetpassword(){
     // print_r($_POST);die;
      $response = array();
      $newpassword = $this->input->post("newpassword");
      $confirmpassword = $this->input->post("confirmpassword");
      $email = $this->input->post("email");
      $urlSegment  =$this->input->post("uriSeg");
      $emailAndCode  = base64_decode($urlSegment);
      $codeEmail = explode("___", $emailAndCode);
      $emailFromCode = $codeEmail[1];

      if(trim($emailFromCode) == trim($email)){

         if($newpassword == $confirmpassword ){

            $isValidate = $this->Forgot_model->setnewpassword($newpassword, $email);
            if($isValidate){

               // $this->session->set_flashdata('success', 'Password reset successfully');
               $response['message'] = 'Your Password reset successfully';
               $response['code'] = 200;
               
            }else{
               // $this->session->set_flashdata('flash_data', 'Reset password link was expaired');
               $response['message'] = 'Reset password link was expaired';
               $response['code'] = 400;
            }
            // redirect("admin/login");

         }else{
            // $this->session->set_flashdata('error', 'New password and confirm password must be same');
            $response['message'] = 'New password and confirm password must be same';
            $response['code'] = 400;
            // redirect("admin/forgotpassword");
         }

      }else{
         // $this->session->set_flashdata('error', 'Invalid link! please try again');
         $response['message'] = 'Invalid link! please try again';
         $response['code'] = 400;
         // redirect("admin/forgotpassword");
      }

     echo  json_encode($response);

   }
}
