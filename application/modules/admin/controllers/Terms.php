<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('app_view/terms_condition');
    }
}
?>
