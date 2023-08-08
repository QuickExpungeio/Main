<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends CI_Controller {


   public function index()
   {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->load->view('header');
      $this->load->view('reset_password_1');
      $this->load->view('footer');
   }
}
