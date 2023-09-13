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
         if(!empty($defaultAdminID)){
            return $defaultAdminID->uid;
         }   
      }
   }
   public function update($table,$data,$where){

      $this->db->update($table,$data,$where);

   }
   public function getNameById($userId){

      $data =  $this->db->select("username")->from("user_master")->where('uid',$userId)->get()->row();
      if(!empty($data)){
         return $data->username;
      }else{
         return "You";
      }
   }

   public function getUserDashboardData($uid){

      $this->db->select("um.uid,ex.status,ex.exfid,ex.arresting_agency,ex.date_arrest,ex.offense_attested,um.username,ex.case_no,um.email,um.address,ex.suffix,ex.firstname,ex.lastname,ex.license,ex.arrest_date,ex.arrest_month,ex.arrest_year,(select COUNT(id) FROM expungement_chat where expungement_id = ex.exfid and is_Reeded=0 and is_admin=1 ) as is_Reeded , ex.application_id");
      $this->db->from("expungument as ex");
      $this->db->join("user_master um" ,"um.uid = ex.uid","left");
      $this->db->where("um.email !=",'');
      $this->db->where("ex.uid",$uid);
      $this->db->order_by("ex.exfid","DESC");
      $data =$this->db->get()->result();
      return $data;

   }
   public function getDocumentsUploadByUser_Admin($userId,$expungement_id){
      // ->where("is_admin",0)->where("sender",$userId)
      // return $this->db->select("attachment ,time")->from("expungement_chat")->where("is_admin",0)->where("sender",$userId)->where("attachment !=",'')->get()->result();
       $sender = $this->db->select("attachment ,time")->from("expungement_chat")->where("expungement_id",$expungement_id)->where("is_admin",0)->where("sender",$userId)->where("attachment !=",'')->get()->result();
      //  echo $this->db->last_query();die;

       $this->db->select("attachment ,time");
       $this->db->from("expungement_chat");
       $this->db->where("expungement_id",$expungement_id);
       $this->db->where("is_admin",1);
       $this->db->where("receiver",$userId);
       $this->db->where("attachment !=",'');
       $receiver =$this->db->get()->result();
             
       $senderreceiver = array_merge($sender,$receiver);
       return $senderreceiver;
      // echo $this->db->last_query();die;
   }
}
