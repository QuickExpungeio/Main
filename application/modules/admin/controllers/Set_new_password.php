<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_new_password extends CI_Controller {


   public function index()
   {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->view('header');
      $this->load->view('set_new_password_1');
      $this->load->view('footer');
   }
}
