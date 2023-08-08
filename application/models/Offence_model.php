<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offence_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function getoffence($data){
		
		if (empty($data)) {
			return $this->db->get("offence")->result();
		}else{
			return $this->db->select('*')->from("offence")->where("short_description LIKE '%".$data['OffenceName']."%'")->get()->result();
		}
		
	}
}