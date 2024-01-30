<?php defined('BASEPATH') or exit('No direct script access allowed');

class Chat_model extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function insert($table, $data)
   {
      $this->db->insert($table, $data);
      return $this->db->insert_id();
   }
   public function getwhere($table, $where)
   {
      return $this->db->get_where($table, $where)->result();
   }
   public function getadmin($appID)
   {

      $adminID = $this->db->select('sender')->from('expungement_chat')->where('expungement_id', $appID)->where('is_admin', 1)->get()->row();
      if (!empty($adminID)) {
         return $adminID->sender;
      } else {
         $defaultAdminID = $this->db->select('uid')->from('user_master')->where('user_role', 'superadmin')->get()->row();
         if (!empty($defaultAdminID)) {
            return $defaultAdminID->uid;
         }
      }
   }
   public function update($table, $data, $where)
   {

      $this->db->update($table, $data, $where);
   }
   // public function delete($table, $data, $where)
   // {

   //    $table_name = 'cron';
   //    $condition = array('expungement_id' => 'value');
   //    $this->db->where($condition);
   //    $this->db->delete($table_name);
   // }
   public function getNameById($userId)
   {

      $data =  $this->db->select("username")->from("user_master")->where('uid', $userId)->get()->row();
      if (!empty($data)) {
         return $data->username;
      } else {
         return "You";
      }
   }

   public function getUserDashboardData($uid)
   {

      $this->db->select("um.uid,ex.status,ex.exfid,ex.arresting_agency,ex.date_arrest,ex.offense_attested,um.username,ex.case_no,um.email,um.address,ex.suffix,ex.firstname,ex.lastname,ex.license,ex.arrest_date,ex.arrest_month,ex.arrest_year,(select COUNT(id) FROM expungement_chat where expungement_id = ex.exfid and is_Reeded=0 and is_admin=1 ) as is_Reeded , ex.application_id");
      $this->db->from("expungument as ex");
      $this->db->join("user_master um", "um.uid = ex.uid", "left");
      $this->db->where("um.email !=", '');
      $this->db->where("ex.uid", $uid);
      $this->db->order_by("ex.exfid", "DESC");
      $data = $this->db->get()->result();
      return $data;
   }
   public function getDocumentsUploadByUser_Admin($userId, $expungement_id)
   {
      // ->where("is_admin",0)->where("sender",$userId)
      // return $this->db->select("attachment ,time")->from("expungement_chat")->where("is_admin",0)->where("sender",$userId)->where("attachment !=",'')->get()->result();
      $sender = $this->db->select("attachment ,time")->from("expungement_chat")->where("expungement_id", $expungement_id)->where("is_admin", 0)->where("sender", $userId)->where("attachment !=", '')->get()->result();
      //  echo $this->db->last_query();die;

      $this->db->select("attachment ,time");
      $this->db->from("expungement_chat");
      $this->db->where("expungement_id", $expungement_id);
      $this->db->where("is_admin", 1);
      $this->db->where("receiver", $userId);
      $this->db->where("attachment !=", '');
      $receiver = $this->db->get()->result();

      $senderreceiver = array_merge($sender, $receiver);
      return $senderreceiver;
      // echo $this->db->last_query();die;
   }
   // public function chat_message()
   // {
   //    $this->db->select('id,email,send_by');
   //    $this->db->from('email_cron');
   //    $this->db->where('date', '2023-10-05');
   //    $datas = $this->db->get()->result_array();

   //    foreach ($datas as $data) {
   //       if ($data['send_by'] == 2) {
   //          // echo $data['send_by'];die;
   //          $mailContaint = $this->db->get_where('wiki', array('id' => 8))->row();

   //          $logo = base_url('assets/images/logo.png');
   //          $replaceTo = array("__LOGO__", "__TITLE__", "__USEREMAIL__", "__CONTACTUSTEXT__");
   //          $replaceFrom = array($logo, "Unread Notification To User", "email", $data['id']);
   //          $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
   //          $to = 'rutvik.kachhiya@bhavitech.com';
   //          $subject = $mailContaint->subject;
   //          $message = $newContaint;
   //          $emailResponse = email_send($to, "", $subject, $message);
   //          // echo '<pre>';print_r($emailResponse);
   //          if ($emailResponse['code'] = 200) {
   //             // echo 'hello.<br>';
   //             $query = "UPDATE email_cron SET status = '1'";
   //             $this->db->query($query);
   //             return true;
   //          } else {
   //             // echo 'rutvik';
   //             return false;
   //          }
   //       } else {
   //          $mailContaint = $this->db->get_where('wiki', array('id' => 9))->row();

   //          $logo = base_url('assets/images/logo.png');
   //          $replaceTo = array("__LOGO__", "__TITLE__", "__USEREMAIL__", "__CONTACTUSTEXT__");
   //          $replaceFrom = array($logo, "Unread Notification To Admin", "email", $data['id']);
   //          $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
   //          $to = 'rutvikkachhiya2209@gmail.com';
   //          $subject = $mailContaint->subject;
   //          $message = $newContaint;
   //          $emailResponse = email_send($to, "", $subject, $message);
   //          // echo '<pre>';print_r($emailResponse);die;
   //          if ($emailResponse['code'] = 200) {
   //             // echo 'hello.<br>';
   //             $query = "UPDATE email_cron SET status = '1'";
   //             $this->db->query($query);
   //             return true;
   //          } else {
   //             // echo 'rutvik';
   //             return false;
   //          }
   //       }
   //    }
   // }
}
