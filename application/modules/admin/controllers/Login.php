<?php defined('BASEPATH') or exit('No direct script access allowed');


class Login extends MY_Controller
{

   function __construct()
   {
      parent::__construct();
     
      if(isset($_SESSION['role'])){
         if($_SESSION['role']=='superadmin'){
            redirect('admin/user/user');
            exit;
         }elseif($_SESSION['role']=='appuser'){
            redirect('user/application');
            exit;
         }
      }


   }

   public function index()
   {

      $this->load->library('form_validation');
      $this->load->view('header');
      $this->load->model("Login_model", "Login");
      $this->load->view('login_page');

      $this->form_validation->set_rules('email', 'email', 'required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required');

      if ($_POST) {

         if ($this->form_validation->run() == TRUE) {

            $result = $this->Login->isadmin_user($_POST);
            if (!empty($result)) {
               $data = [
                  'email' => $result->email,
                  'uid' => $result->uid,
                  'role' => $result->user_role,
                  'username' => $result->username
               ];

               $this->session->set_userdata($data);

               if ($result->user_role == "superadmin") {
                  redirect('admin/applications');
               } else if ($result->user_role == "appuser") {
                  redirect('user/application');
               }
            } else {
               $this->session->set_flashdata('flash_data', 'Username or password is wrong!');
               redirect('admin/login');
            }
         } else {
            redirect('admin/login');
         }

         $this->load->view('footer');
      }
   }
}
