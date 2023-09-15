<?php defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends MY_Controller
{
   
   public function index()
   {
      $this->load->view('header');
      $this->load->view('navbar');
      $this->load->view('settings');
      $this->load->view('footer');
   }
  
}
