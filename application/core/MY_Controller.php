<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function _construct()
	{

		parent::_construct();
		$this->load->model('Login_model');
	}

}

?>