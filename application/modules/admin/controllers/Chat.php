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
   function index()
   {
      $applicationID = $this->input->post('user_id');
      $userID = $this->input->post('uid');
      //  echo '<pre>';print_r($this->input->post());die;
      $params["applicationId"] = $_SESSION['applicationidforchat'] = !empty($applicationID) ? $applicationID : $_SESSION['applicationidforchat'];
      $params["userId"] = $_SESSION['useridforchat'] = !empty($userID) ? $userID : $_SESSION['useridforchat'];
      $params["chatData"] = $this->Chat_model->getwhere('expungement_chat', array('expungement_id' => $_SESSION['applicationidforchat']));
      $params['userName'] =$this->Chat_model->getNameById($userID);
      $params['attachments'] = $this->Chat_model->getDocumentsUploadByUser($userID);
      //echo '<pre>';print_r($params["attachments"]);die;
      $this->Chat_model->update('expungement_chat',array("is_Reeded"=>1),array('expungement_id'=>$applicationID));
      $this->load->view('header');
      $this->load->view('navbar', $params);
      $this->load->view("chat_list", $params);
      $this->load->view('footer');
   }

   public function insert()
   {

      $ckedit = $this->input->post('ckedit'); //message
      $userId = $this->input->post('userId'); //Applicent ID
      $applicationId = $this->input->post('applicationId');

      $chatData = array(
         'expungement_id ' => !empty($applicationId) ? $applicationId : '',
         'sender ' => $_SESSION['uid'],
         'receiver' => $userId,
         'topic' => "",
         'subject' => "",
         'message' => trim($ckedit),
         'is_admin' => 1
      );
      $lastChatId = $this->Chat_model->insert('expungement_chat', $chatData);
      $chatData = $this->Chat_model->getwhere('expungement_chat',array('id'=>$lastChatId));
      if(!empty($chatData)){

         $html = '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">Admin</span><br><span class="direct-chat-timestamp pull-right">'.date('d M Y h:i a', strtotime($chatData[0]->time)).'</span></div><img class="direct-chat-img" src="'.base_url('assets/images/pic-1.png').'" alt="Message User Image"><div class="direct-chat-text">'.$chatData[0]->message.'</div></div>';
      }
      $response['message'] = trim($html);
      $response['code'] = '200';
      echo json_encode($response);
      exit;
   }

   public function uploaddoc(){

      $response=[];

      if(isset($_FILES) && isset($_POST) ){

         $applicationId = $this->input->post('applicationId');
         $userId = $this->input->post('userData');
         $userIdForChat = $_SESSION['useridforchat'];

         $docPath = FCPATH.'uploads/chat_document/document_'.$userIdForChat;
         $uploadDocuments = $this->myuploadlibrary->upload_single_image($_FILES, 'file', 1, $docPath);
         $imageName = explode("/", $uploadDocuments);
         $uploadDocuments = end($imageName);

         if (!empty($uploadDocuments)) {

            $uploadDocumentsPath = site_url() . 'uploads/chat_document/document_'.$userIdForChat ."/".$uploadDocuments;
         }

         $chatData = array(
            'expungement_id ' => !empty($applicationId) ? $applicationId : '',
            'sender ' => $_SESSION['uid'],
            'receiver' => $userId,
            'topic' => "",
            'subject' => "",
            'message' => "",
            'attachment'=>$uploadDocumentsPath,
            'is_admin' => 1
         );
         $lastChatId =$this->Chat_model->insert('expungement_chat', $chatData);
         $chatData = $this->Chat_model->getwhere('expungement_chat',array('id'=>$lastChatId));
         $html = '<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">Admin</span><br><span class="direct-chat-timestamp pull-right">'.date('d M Y h:i a', strtotime($chatData[0]->time)).'</span></div><img class="direct-chat-img" src="'.base_url('assets/images/pic-1.png').'" alt="Message User Image"><div class="direct-chat-text-img"><img src="'.$uploadDocumentsPath.'" style="width: auto;max-width: 500px;"/></div></div>';

         $response['message'] =  $html;
         $response['code'] = 200;
      }else{
         $response['message'] = "Please Upload File";
         $response['code'] = 400;
      }
      echo json_encode($response);
      exit;


   }

   public function getchat(){
      $response=[];
      $applicationID = $this->input->post('applicationId');
      $userID = $this->input->post('userId');

      // echo '<pre>';print_r($_POST);die;
      if(isset($applicationID) && isset($userID) ){

         $chatData = $this->Chat_model->getwhere('expungement_chat', array('expungement_id' => $_SESSION['applicationidforchat']));
         $userName=$this->Chat_model->getNameById($userID);
         if(!empty($chatData)){
            $html='';

            foreach($chatData as $chatVal){

               if ($chatVal->is_admin == 0) {

                  $imgClass =!empty($chatVal->attachment)?"direct-chat-text-img-right scrollClass":"direct-chat-text scrollClass";
                  $chatOrImage = (!empty($chatVal->attachment))?'<img src="'.$chatVal->attachment.'" style="width: auto;max-width: 500px;"/>':$chatVal->message;
                  $html.='<div class="direct-chat-msg"><div class="direct-chat-info clearfix "><span class="direct-chat-name pull-left">'.$userName.'</span><br><span class="direct-chat-timestamp pull-left">'.date('d M Y h:i a', strtotime($chatVal->time)).'</span></div><img class="direct-chat-img" src="'.base_url('assets/images/pic-1.png').'" alt="Message User Image"><div class="'.$imgClass.'">'.$chatOrImage.'</div></div>';

               }else{

                  $imgClass =!empty($chatVal->attachment)?"direct-chat-text-img scrollClass":"direct-chat-text scrollClass";
                  $chatOrImage = !empty($chatVal->attachment)?'<img src="'.$chatVal->attachment.'" style="width: auto;max-width: 500px;"/>':$chatVal->message;
                  $html.='<div class="direct-chat-msg right"><div class="direct-chat-info clearfix"><span class="direct-chat-name pull-right">Admin</span><br><span class="direct-chat-timestamp pull-right">'.date('d M Y h:i a', strtotime($chatVal->time)).'</span></div><img class="direct-chat-img" src="'.base_url('assets/images/pic-1.png').'" alt="Message User Image"><div class="'.$imgClass.'">'.$chatOrImage.'</div></div>';

               }

            }
            $response['message']=$html;
            $response['code']=200;

         }else{
            $response['message']="No Data Found";
            $response['code']=400;
         }
      }else{
         $response['message']="No Data Found";
         $response['code']=400;
      }
      echo json_encode($response);
      exit;
   }
}
