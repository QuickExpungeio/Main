<?php defined('BASEPATH') or exit('No direct script access allowed');

class Applications extends MY_Controller
{
   function __construct()
   {  
      parent::__construct();
      if (isset($_SESSION['role'])) {
         if ($_SESSION['role'] != 'superadmin') {
            redirect('admin/login');
            exit;
         }
      } else {
         redirect('admin/login');
                   exit;
      }
      $this->load->model('Expunge_model');
      $this->load->model('User_model');
      $this->load->model('Chat_model');
   }

   public function index()
   {
      // echo '<pre>';print_r($_SESSION);die;
      $params["results"] = $this->Expunge_model->get_expungelist();
      $params["openCount"] =  $this->Expunge_model->getExpungumentBasedOnStatus('open');
      $params["inprogressCount"] =  $this->Expunge_model->getExpungumentBasedOnStatus('inprogress');
      $params["closedCount"] =  $this->Expunge_model->getExpungumentBasedOnStatus('closed');
      $params["averageCount"] =  $this->Expunge_model->getExpungumentBasedOnStatus('avg');
// echo '<pre>';print_r($params["results"]);die;
      $this->load->view('header');
      $this->load->view('navbar', $params);
      $this->load->view('applications', $params);
      $this->load->view('footer');
   }
   function count_details($screen)
   {
      // print_r($view);die;
      $params["results"] = $this->Expunge_model->getExpungumentBasedOnStatusDetails($screen);
      $params['screen'] = $screen;
      // print_r();
      // echo $this->db->last_query();die;
      // $params["dashboard_count"] =  $this->Expunge_model->get_dashboard_count();
      // echo '<pre>';
      // print_r($params["results"]);
      // echo $this->db->last_query();
      // die;
      // Print the result or use it as needed
      // echo "Number of rows with status 0: " . $count;
      $this->load->view('header');
      $this->load->view('navbar', $params);
      $this->load->view('applications_open', $params);
      $this->load->view('footer');
   }

   function details($id = 0)
   {
      //  echo '<pre>';print_r($this->input->post());die;
      $user_id = ($id == 0) ? $this->input->post('user_id') : $id;
      $userID = $this->input->post('uid');
      $expungement_id = $this->input->post('list_id');
      $params["results"] = $this->User_model->getuserdetails($user_id);
      $params['attachments'] = $this->Chat_model->getDocumentsUploadByUser_Admin($userID, $expungement_id);
      // echo '<pre>';print_r($params["attachments"]);die;
// echo $this->db->last_query();die;
      $this->load->view('header');
      $this->load->view('navbar');
      $this->load->view("view_userdetail", $params);
      $this->load->view('footer');
   }
   

   function removedetails()
   {
      // $this->load->view('header');
      $res = $this->User_model->deleteuserdetail($_POST);
      if ($res) {
         $this->session->set_flashdata('success', 'User Has Been Deleted Successfully');
         redirect('admin/user/user');
      } else {
         $this->session->set_flashdata('error', 'Try again');
         redirect('admin/user/user');
      }
   }

   function removemultidetail()
   {
      $ids = $this->input->post('ids');
      $res = $this->User_model->delete_multipaldetail($ids);

      if ($res) {
         $this->session->set_flashdata('success', 'User Has Been Deleted Successfully');
         return true;
      } else {
         $this->session->set_flashdata('error', 'Try again');
         return false;
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

   function updatecomment()
   {
      $applicationID = $this->input->post('id');
      $textcomment = $this->input->post('textcomment');
      $this->User_model->updatecomment($textcomment, $applicationID);
      return true;
   }
   function updatestatus()
   {
      $applicationID = $this->input->post('id');
      $status = $this->input->post('status');
      $this->User_model->updatestatus($status, $applicationID);
      return true;
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
         redirect(base_url('admin/applications/details/') . $uid);
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
               }
            }
         } else {

            $this->session->set_flashdata('danger', $reportDocument['error']);
         }
      } else {

         $this->session->set_flashdata('danger', 'Letter Not Upload Successfully');
      }
      redirect(base_url("admin/applications/details/") . $id);
   }
}
   