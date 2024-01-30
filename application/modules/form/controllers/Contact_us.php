<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contact_us extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        // if (isset($_SESSION['role'])) {
        //    if ($_SESSION['role'] == 'superadmin') {
        //       redirect('admin/user/user');
        //       exit;
        //    } elseif ($_SESSION['role'] == 'appuser') {
        //       redirect('user/user');
        //       exit;
        //    }
        // }

        $this->load->model('Form_model');
        $this->load->helper('form'); // Load the form helper
        $this->load->library('form_validation'); // Load form validation library
    }


    public function index()
    {
        $this->load->view('contact_us');
    }
    public function process()
    {

        $comment = $this->input->post('comment');
        $email = $this->input->post('email');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if ($this->form_validation->run() === TRUE) {
            
            $data = array(
                'comment' => $comment,
                'email' => $email,
            );
            $this->Form_model->insert_contact_us($data);
          
            // Redirect to a success page or perform other actions
            redirect('form');
        } else {
            // If form data is valid, insert it into the database
            $this->load->view('contact_us');
           
        }
    }
}
