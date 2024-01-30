<?php defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends MY_Controller
{
   function __construct()
   {
      parent::__construct();

      if (empty($_SESSION['uid'])) {
         redirect('admin/login');
      }

      $this->load->model('User_model');
      $this->load->model('Chat_model');
      $this->load->library('myuploadlibrary');
   }

   public function index()
   {
      // echo '<pre>';print_r($_POST);
      //  echo '<pre>';print_r($_SESSION);die;
      $applicationID = $this->input->post('appid');
      $expungement_id = $this->input->post('appid');
      $_SESSION['applicationidforchat'] = (isset($applicationID) && !empty($applicationID)) ? $applicationID : $_SESSION['applicationidforchat'];
      $params["chatData"] = $this->Chat_model->getwhere('expungement_chat', array('expungement_id' => $_SESSION['applicationidforchat']));
      $params["adminID"] = $this->Chat_model->getadmin($_SESSION['applicationidforchat']);
      $params["applicationId"] = $_SESSION['applicationidforchat'];
      $params["userId"] = $_SESSION['uid'];
      $params['userName'] = isset($_SESSION['username']) ? $_SESSION['username'] : "You";
      $params['attachments'] = $this->Chat_model->getDocumentsUploadByUser_Admin($params["userId"], $expungement_id);
      // echo '<pre>';
      $this->Chat_model->update('expungement_chat', array("is_Reeded" => 1), array('expungement_id' => $applicationID));
      $this->db->select('email');
      $receiver = $this->db->get_where('user_master', array('uid' =>$_SESSION['uid']))->row('email');
      // echo '<pre>';print_r($receiver);die;
      $this->db->where(array('expungement_id' => $applicationID ,'receiver' => $receiver ));
      $this->db->delete('cron');
      // echo $this->db->last_query();die;
      $this->load->view('header');
      $this->load->view('navbar', $params);
      $this->load->view('user_chat', $params);
      $this->load->view('footer');
   }
   public function sendmessage()
   {
      $ckedit = $this->input->post('ckedit'); //message
      $userId = $this->input->post('userId'); //Applicent ID
      $adminID = $this->input->post('adminID');
      $applicationId = $this->input->post('applicationId');
      $userName = isset($_SESSION['username']) ? $_SESSION['username'] : "You";
      // $email = $this->db->get_where('user_master', array('uid' => $userId))->row('email');
      $this->db->select('email');
      $sender = $this->db->get_where('user_master', array('uid' =>$_SESSION['uid']))->row('email');
      // $receiver = $this->db->get_where('user_master', array('uid' => $adminID))->row('email');
      $date = getCurrentDateOfAllTimeZone();
      $response = [];
      if (!empty($ckedit)) {

         $chatData = array(
            'expungement_id ' => !empty($applicationId) ? $applicationId : '',
            'sender ' => $userId,
            'receiver' => $adminID,
            'topic' => "",
            'subject' => "",
            'message' => trim($ckedit),
            'is_admin' => 0,
            'time' => getCurrentTimeOfAllTimeZone()
         );
         $cronData = array(
            'expungement_id ' => !empty($applicationId) ? $applicationId : '',
            'sender' => $sender,
            'receiver' => "no_reply@quickexpunge.io",
            'date' => $date,
            'message' => trim($ckedit),
            // 'send_by' => 1
         );
         // echo '<pre>';print_r($cronData);die;
         $this->db->insert('cron', $cronData);
         $lastChatId = $this->Chat_model->insert('expungement_chat', $chatData);
         $chatData = $this->Chat_model->getwhere('expungement_chat', array('id' => $lastChatId));

         if (!empty($chatData)) {

            $html = '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">' . $userName . '</span><br><span class="direct-chat-timestamp pull-right">' . date('d M Y h:i a', strtotime($chatData[0]->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="direct-chat-text">' . $chatData[0]->message . '</div></div>';
         }
         $response['message'] = trim($html);
         $response['code'] = '200';
      } else {
         $response['message'] = "";
         $response['code'] = '400';
      }
      echo json_encode($response);
      exit;
   }
   public function uploaddoc()
   {
      $response = [];

      if (isset($_FILES) && isset($_POST)) {

         $applicationId = $this->input->post('applicationId');
         $userId = $this->input->post('userData');
         $adminID = $this->input->post('adminID');

         $this->db->select('email');
         $sender = $this->db->get_where('user_master', array('uid' =>$_SESSION['uid']))->row('email');
         // $receiver = $this->db->get_where('user_master', array('uid' => $adminID))->row('email');
         $date = getCurrentDateOfAllTimeZone();

         $docPath = FCPATH . 'uploads/chat_document/document_' . $userId;
         $uploadDocuments = $this->myuploadlibrary->upload_single_image($_FILES, 'file', 1, $docPath);
         if (!is_array($uploadDocuments)) {
         $imageName = explode("/", $uploadDocuments);
         $uploadDocuments = end($imageName);

         if (!empty($uploadDocuments)) {

            $uploadDocumentsPath = site_url() . 'uploads/chat_document/document_' . $userId . "/" . $uploadDocuments;
         }

            $chatData = array(
               'expungement_id ' => !empty($applicationId) ? $applicationId : '',
               'sender ' => $userId,
               'receiver' => $adminID,
               'topic' => "",
               'subject' => "",
               'message' => "",
               'attachment' => $uploadDocumentsPath,
               'is_admin' => 0
            );
            $cronData = array(
               'expungement_id ' => !empty($applicationId) ? $applicationId : '',
               'sender' => $sender,
               'receiver' => "no_reply@quickexpunge.io",
               'date' => $date,
               'message' => "",
               'attachment' => $uploadDocumentsPath
               // 'send_by' => 1
            );
            // echo '<pre>';print_r($cronData);die;
            $this->db->insert('cron', $cronData);
            $lastChatId = $this->Chat_model->insert('expungement_chat', $chatData);
            $chatData = $this->Chat_model->getwhere('expungement_chat', array('id' => $lastChatId));

            if (!empty($chatData)) {
               $html = '';
               $fileExtentionNew = "img";

               foreach ($chatData as $ky => $chatVal) {
                  $fileName = "";
                  $fileExtentiona = array();
                  if (!empty($chatVal->attachment)) {
                     $imageData = explode("/", $chatVal->attachment);
                     $fileName = end($imageData);

                     $fileExtentiona = explode(".", $fileName);

                     // echo "<pre>".$ky." = ";print_r($fileExtentiona);
                     $fileExtentionNew = $fileExtentiona[1];
                     // echo $fileExtentionNew; die;
                  // echo $fileExtentionNew; die;
               }
               // echo $fileExtentionNew; die;
               switch ($fileExtentionNew) {
                  case 'doc':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'docx':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'DOCX':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'pdf':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-pdf-o" style="font-size:30px">' . $fileName . '</i>';
                     break;
                  case 'PDF':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-pdf-o" style="font-size:30px">' . $fileName . '</i>';
                     break;
                  case 'xlsx':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-excel-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'xls':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-excel-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'txt':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-text-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;


                  default:
                     $isFileIsImageOrDocOrPdf = '<img src="' . $chatVal->attachment . '" style="width: auto;max-width: 500px;"/>';
                     break;
               }
               // print_r($chatVal->is_admin);die; " ";
               if ($chatVal->is_admin == 1) {

                  $imgClass = !empty($chatVal->attachment) ? "direct-chat-text-img-right scrollClass" : "direct-chat-text scrollClass";
                  $chatOrImage = (!empty($chatVal->attachment)) ?  $isFileIsImageOrDocOrPdf : $chatVal->message;
                  $html .= '<div class="direct-chat-msg"><div class="direct-chat-info clearfix "><span class="direct-chat-name pull-left"></span><br><span class="direct-chat-timestamp pull-left">' . date('d M Y h:i a', strtotime($chatVal->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="' . $imgClass . '">' . $chatOrImage . '</div></div>';
               } else {

                  $imgClass = !empty($chatVal->attachment) ? "direct-chat-text-img scrollClass" : "direct-chat-text scrollClass";
                  $chatOrImage = !empty($chatVal->attachment) ?  $isFileIsImageOrDocOrPdf : $chatVal->message;
                  $html .= '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">Admin</span><br><span class="direct-chat-timestamp pull-right">' . date('d M Y h:i a', strtotime($chatVal->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="' . $imgClass . '">' . $chatOrImage . '</div></div>';
               }
            }

            // $html = '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">User</span><br><span class="direct-chat-timestamp pull-right">' . date('d M Y h:i a', strtotime($chatData[0]->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="direct-chat-text-img"><img src="' . $uploadDocumentsPath . '" style="width: auto;max-width: 500px;"/></div></div>';

            $response['message'] =  $html;
            $response['code'] = 200;
         }
      } else {
         $response['message'] = $uploadDocuments['error'];
         $response['code'] = 400;
      }
      } else {
         $response['message'] = "Please Upload File";
         $response['code'] = 400;
      }
      echo json_encode($response);
      exit;
   }
   public function getchat()
   {
      $response = [];
      $applicationID = $this->input->post('applicationId');
      // echo '<pre>';print_r($applicationID);die;
      $userName = isset($_SESSION['username']) ? $_SESSION['username'] : "You";
      if (isset($applicationID)) {

         $_SESSION['applicationidforchat'] = (isset($applicationID) && !empty($applicationID)) ? $applicationID : $_SESSION['applicationidforchat'];
         $chatData = $this->Chat_model->getwhere('expungement_chat', array('expungement_id' => $_SESSION['applicationidforchat']));
         // echo '<pre>';
         // print_r($chatData);die;
         $html = '';
         $fileExtentionNew = "img";
         if (!empty($chatData)) {
            foreach ($chatData as $ky => $chatVal) {
               $fileName = "";
               $fileExtentiona = array();
               if (!empty($chatVal->attachment)) {
                  $imageData = explode("/", $chatVal->attachment);
                  $fileName = end($imageData);

                  $fileExtentiona = explode(".", $fileName);

                  // echo "<pre>".$ky." = ";print_r($fileExtentiona);
                  $fileExtentionNew = $fileExtentiona[1];
                  // echo $fileExtentionNew;
               }
               switch ($fileExtentionNew) {
                  case 'doc':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'docx':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'DOCX':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-word-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'pdf':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-pdf-o" style="font-size:30px">' . $fileName . '</i>';
                     break;
                  case 'PDF':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-pdf-o" style="font-size:30px">' . $fileName . '</i>';
                     break;
                  case 'xlsx':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-excel-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'xls':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-excel-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;
                  case 'txt':
                     $isFileIsImageOrDocOrPdf = '<i class="fa fa-file-text-o" style="font-size:30px;">' . $fileName . '</i>';
                     break;


                  default:
                     $isFileIsImageOrDocOrPdf = '<img src="' . $chatVal->attachment . '" style="width: auto;max-width: 500px;"/>';
                     break;
               }
               // print_r( $isFileIsImageOrDocOrPdf)." ";
               if ($chatVal->is_admin == 1) {

                  $imgClass = !empty($chatVal->attachment) ? "direct-chat-text-img-right scrollClass" : "direct-chat-text scrollClass";
                  $chatOrImage = (!empty($chatVal->attachment)) ? $isFileIsImageOrDocOrPdf : $chatVal->message;
                  $html .= '<div class="direct-chat-msg"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-left">Admin</span><br><span class="direct-chat-timestamp pull-left">' . date('d M Y h:i a', strtotime($chatVal->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="' . $imgClass . '">' . $chatOrImage . '</div></div>';
               } else {
                  $imgClass = !empty($chatVal->attachment) ? "direct-chat-text-img scrollClass" : "direct-chat-text scrollClass";
                  $chatOrImage = (!empty($chatVal->attachment)) ? $isFileIsImageOrDocOrPdf : $chatVal->message;
                  $html .= ' <div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">' . $userName . '</span><br><span class="direct-chat-timestamp pull-right">' . date('d M Y h:i a', strtotime($chatVal->time)) . '</span></div><img class="direct-chat-img" src="' . base_url('assets/images/pic-1.png') . '" alt="Message User Image"><div class="' . $imgClass . '">' . $chatOrImage . '</div></div>';
               }
            }

            $response['message'] = $html;
            $response['code'] = 200;
         } else {
            $response['message'] = "No Data Found";
            $response['code'] = 400;
         }
      } else {
         $response['message'] = "No Data Found";
         $response['code'] = 400;
      }
      echo json_encode($response);
      exit;
   }
}
