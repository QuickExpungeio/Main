<?php defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
   function __construct()
   {
      
      parent::__construct();

      if(isset($_SESSION['role'])){
         if($_SESSION['role']!='superadmin'){
            redirect('admin/login');
            exit;
         }
      }else{
         redirect('admin/login');
         exit;
      }
      $this->load->model('User_model');
      $this->load->model('Expunge_model');
   }


   function userrole()
   {
      $this->load->view('header');
      $this->load->model('User_model');
      $this->load->view('navbar');
      $this->load->view("user/userrole_add");
      $this->load->view('footer_validation');
   }


   function add_user()
   {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $this->form_validation->set_rules('firstname', 'firstname', 'is_unique[user_master.firstname]');
      $this->form_validation->set_rules('phone', 'phone', 'numeric');
      $this->form_validation->set_rules('phone2', 'phone2', 'numeric');
      if ($this->form_validation->run() == TRUE) {
         $this->load->database();
         $this->load->model('User_model');
         if ($this->User_model->insertusername($_POST)) {
            $this->session->set_flashdata('success', 'User Has Been Inserted Successfully');
            redirect('admin/user/user');
         } else {
            $this->session->set_flashdata('error', 'Email-ID Is Already In Database.');
            redirect('admin/user/user/userrole');
         }
      } else {
         $this->session->set_flashdata('error', 'First Name Already In Database.');
         redirect('admin/user/user/userrole');
      }
   }

   public function export()
   {
      $query = $this->User_model->exportcsv();
      $filename = 'user_details_on_' . date('Ymd') . '.csv';
      header("Content-Description: File Transfer");
      header("Content-Disposition: attachment; filename=$filename");
      header("Content-Type: application/csv; ");
      $file = fopen('php://output', 'w');

      $header = array('ID', 'User Name', 'First Name', 'Last Name', 'Email', 'Case Number', 'Alias', 'Preferred Communication Method', 'Date of Birth', 'Race', 'Gender', 'Social Security Number', 'Phone No', 'State', 'Zipcode', 'Arresting Agency', 'Date of Arresting', 'Driving License Number', 'Offense Arrested For', 'Verification Picture');
      fputcsv($file, $header);
      foreach ($query->result_array() as  $row) {
         $username = $row['firstname'] . '' . $row['lastname'];
         if ($row['communication_method'] == 1) {
            $commeth = "Email";
         } elseif ($row['communication_method'] == 2) {
            $commeth = "SMS";
         } elseif ($row['communication_method'] == 3) {
            $commeth = "SMS and Email";
         }
         $arrestdate = $row['arrest_date'] . ' ' . $row['arrest_month'] . ',' . $row['arrest_year'];
         $value = array(
            $row['exfid'], $username, $row['firstname'], $row['lastname'], $row['email'], $row['case_no'], $row['alias'], $commeth, $row['birthdate'], $row['race'], $row['gender'], $row['ssn'], $row['phone_no'], $row['state'], $row['zipcode'], $row['arresting_agency'], $arrestdate, $row['license'], $row['offense_attested'], $row['verification_id']
         );
         fputcsv($file, $value);
      }


      fclose($file);
      exit;
   }

   function edit_user()
   {
      if ($this->User_model->updateuser($_POST)) {
         $this->session->set_flashdata('success', 'User Has Been Updated Successfully');
         redirect('admin/user/user');
      }
   }

   function update_user()
   {

      $res = $this->User_model->viewuser($_POST);
      $this->load->view('header');
      $this->load->view('navbar');
      if ($res) {
         $data['result'] = $res;
         $this->load->view('user/user_edit', $data);
      } else {
         echo "Fail";
      }
      $this->load->view('footer_validation');
   }


   function update_userrole()
   {
      $this->load->view('header');
      $this->load->view('navbar');
      $res = $this->User_model->viewuserrole($_POST);
      if ($res) {
         $data['result'] = $res;
         $this->load->view('user/userrole_edit', $data);
      } else {
         echo "Fail";
      }
      $this->load->view('footer_validation');
   }

   function delete_userdetail()
   {
      $this->load->view('header');
      $res = $this->User_model->deleteuserdetail($_POST);
      if ($res) {
         $this->session->set_flashdata('success', 'User Has Been Deleted Successfully');
         redirect('admin/user/user');
      } else {
         $this->session->set_flashdata('error', 'Try again');
         redirect('admin/user/user');
      }
   }

   function delete_multipaldetail()
   {
      $res = $this->User_model->delete_multipaldetail($this->input->post('ids'));

      if ($res) {
         $this->session->set_flashdata('success', 'User Has Been Deleted Successfully');
         return true;
      } else {
         $this->session->set_flashdata('error', 'Try again');
         return false;
      }
   }

   function uploaddocument()
   {
      $this->load->library('myuploadlibrary');
      $id = $this->input->post("docid");

      if (!empty($_FILES["reportDocument"]['name'])) {

         $reportDocument = $this->myuploadlibrary->upload_single_image($_FILES, 'reportDocument', $id, FCPATH . 'uploads/restriction_letters/');

         if (!isset($reportDocument['error'])) {

            if (isset($reportDocument)) {
               $imageName = explode("/", $reportDocument);
               $documentName = end($imageName);

               $res = $this->User_model->uploadletter($documentName, $id);
               if ($res) {
                  $this->session->set_flashdata('success', 'Letter Upload Successfully');
                  redirect(base_url("admin/user/user/view_userdetail/") . $id);
               }
            }
         } else {

            $this->session->set_flashdata('danger', $reportDocument['error']);
            redirect(base_url("admin/user/user/view_userdetail/") . $id);
         }
      } else {

         $this->session->set_flashdata('danger', 'Letter Not Upload Successfully');
         redirect(base_url("admin/user/user/view_userdetail/") . $id);
      }
   }

   function updatestatus()
   {

      $this->User_model->updatestatus($this->input->post('status'), $this->input->post('id'));
      return true;
   }
   function updatecomment()
   {
      $this->User_model->updatecomment($this->input->post('textcomment'), $this->input->post('id'));
      return true;
   }
   //autosuggestion for edit email
   function check_user_avalibility()
   {
      if ($this->User_model->is_user_available($_POST["email"])) {
         echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already In Database</label>';
      } else {
         echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
      }
   }
   //Change password in Database

   function managementlist()
   {
      $params["results"] = $this->User_model->getmanagementuser();
      $this->load->view('header');
      $this->load->view('navbar', $params);
      $this->load->view('management/management_page', $params);
      $this->load->view('footer');
   }

   function managementadd()
   {
      $this->load->view('header');
      $this->load->view('navbar');
      $this->load->view("management/management_add");
      $this->load->view('footer_validation');
   }


   function add_management()
   {

      $this->load->library('form_validation');
      $this->form_validation->set_rules('phone', 'phone', 'numeric');
      $this->form_validation->set_rules('phone2', 'phone2', 'numeric');
      if ($this->form_validation->run() == TRUE) {
         if ($this->User_model->insertmanagement($_POST)) {
            $this->session->set_flashdata('success', 'User Has Been Inserted Successfully');
            redirect('admin/user/user/managementlist');
         } else {
            $this->session->set_flashdata('error', 'Email-ID Is Already In Database.');
            redirect('admin/user/user/managementlist');
         }
      } else {
         $this->session->set_flashdata('flash_data', 'Enter Valid Phone No');
         redirect('admin/client/client/viewclient');
      }
   }
   function update_management()
   {
      //USER VIEW PAGE
      $this->load->view('header');
      $this->load->view('navbar');
      $res = $this->User_model->viewuserrole($_POST);
      if ($res) {
         $data['result'] = $res;
         $this->load->view('management/management_edit', $data);
      } else {
         echo "Fail";
      }

      $this->load->view('footer_validation');
   }

   function edit_management()
   {
      if ($this->User_model->updateuser($_POST)) {
         $this->session->set_flashdata('success', 'Management Has Been Updated Successfully');
         redirect('admin/user/user/managementlist');
      }
   }
   public function removeletter()
   {

      $uid = $this->input->post("userid");
      $letterId = $this->input->post("userLetterid");
      $response = [];
      if (!empty($letterId) && !empty($uid)) {

         $this->User_model->removeletter($uid, $letterId);
         $response['message'] = "Letter Deleted successfully";
         $response['result'] = 'SUCCESS';
      } else {

         $response['message'] = "User Id and Letter Id Required";
         $response['result'] = 'FAIL';
      }

      echo json_encode($response);
   }
   public function download()
   {

      $this->load->helper('download');
      $uid = $this->input->post("userid");
      $letterId = $this->input->post("userLetterid");
      $LetterName = $this->User_model->download($uid, $letterId);
      if (!file_exists($LetterName)) {
         $LetterName  = file_get_contents($LetterName);
         force_download($letterId, $LetterName);
      } else {
         redirect(base_url('admin/user/user/view_userdetail/') . $uid);
      }
   }
   public function jsonList()
   {
      $json_data = $this->User_model->get_list_table(); // get the invoice list
      echo json_encode($json_data);
   }

   public function logout()
   {
      $this->session->unset_userdata('user_id');
      $this->session->sess_destroy();
      redirect('admin/login');
   }
}
