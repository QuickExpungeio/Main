<?php defined('BASEPATH') or exit('No direct script access allowed');

class Application extends MY_Controller
{
	function __construct()
	{

		parent::__construct();

      if(isset($_SESSION['role'])){
         if($_SESSION['role']!='appuser'){
            redirect('admin/login');
            exit;
         }
      }else{
         redirect('admin/login');
         exit;
      }
		$this->load->model('User_model');
		$this->load->model('Chat_model');
	}

	public function index()
	{
      $userID = $this->session->userdata('uid');
		$params["applications"] = $this->Chat_model->getUserDashboardData($userID);
      $params['userName'] = $_SESSION['username'];
		$this->load->view('header');
		$this->load->view('navbar', $params);
		$this->load->view('application', $params);
		$this->load->view('footer');
	}
	public function details(){

		$user_id = $this->input->post('user_id');
		$expungement_id = $this->input->post('appid');
		$params["userId"] = $_SESSION['uid'];
		if(!empty($user_id)){
			$params["results"] = $this->User_model->getuserdetails($user_id);
         $params['userName'] = $_SESSION['username'];
		 $params['attachments'] = $this->Chat_model->getDocumentsUploadByUser_Admin($params["userId"], $expungement_id);
			$this->load->view('header');
			$this->load->view('navbar',$params);
			$this->load->view("view_userdetail", $params);
			$this->load->view('footer');
		}else{
			redirect(site_url('user/user'));
			exit;
		}

	}
   public function logout()
   {
      $this->session->unset_userdata('user_id');
      $this->session->sess_destroy();
      redirect('admin/login');
   }
}
