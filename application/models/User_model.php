<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User_model extends CI_Model
{

   function __construct()
   {
      parent::__construct();
      $this->load->database();
   }

   public function getuserrole()
   {

      $this->db->select('um.uid,expungument.status,expungument.exfid,expungument.arresting_agency,expungument.date_arrest,expungument.offense_attested,um.username,expungument.case_no,um.email,um.address,expungument.suffix,expungument.firstname,expungument.lastname,expungument.license,expungument.arrest_date,expungument.arrest_month,expungument.arrest_year');
      $this->db->from('expungument');
      $this->db->join('user_master as um', 'um.uid = expungument.uid', 'left');
      $this->db->where('um.`email !=', '');
      $this->db->order_by('expungument.exfid', 'DESC');
      $query = $this->db->get()->result();

      return $query;
   }


   public function exportcsv()
   {

      $this->db->select('um.*,expungument.*');
      $this->db->from('expungument');
      $this->db->join('user_master as um', 'um.uid = expungument.uid', 'left');
      $this->db->where('um.email !=', '');
      $this->db->order_by('expungument.exfid', 'DESC');
      return $this->db->get();
   }

   public function getuserdetails($id)
   {
      $this->db->select('um.*,ex.*');
      $this->db->from('expungument as ex');
      $this->db->join('user_master as um', 'um.uid = ex.uid', 'left');
      $this->db->where('ex.exfid', $id);
      $this->db->order_by('ex.exfid', 'DESC');
      $query = $this->db->get();

      if ($query->num_rows() > 0) {
         foreach ($query->result() as $row) {
            $data[] = $row;
         }
         //echo "<pre>";print_r($data);die;
         return $data;
      }
   }

   public function insertusername($type)
   {

      $uid = $type['uid'];
      $arrest_full_date = $type['arrest_full_date'];
      $arrest_date = $type['arrest_date'];
      $arrest_month = $type['arrest_month'];
      $arrest_year = $type['arrest_year'];
      $birthdate = $type['birthdate'];
      $race = $type['race'];
      $gender = $type['gender'];
      $ssn = $type['ssn'];
      $phone_no = $type['phone_no'];
      $address = $type['address'];
      $state = $type['state'];
      $city = isset($type['city']) ? $type['city'] : "";
      $zipcode = $type['zipcode'];
      $arresting_agency = $type['arresting_agency'];
      $offense_attested = $type['offense_attested'];
      $verification_id = isset($type['verification_id']) ? $type['verification_id'] : "";
      $suffix = $type['suffix'];
      $firstname = $type['firstname'];
      $lastname = $type['lastname'];
      $license = $type['license'];
      $case_no = isset($type['case_no']) ? $type['case_no'] : "";
      $alias = isset($type['any_other_name']) ? $type['any_other_name'] : "";
      $communication_method = isset($type['communication_method']) ? $type['communication_method'] : "";
      $type['status'] = "Received";

      $date_arrest = $arrest_full_date;

      $post_data = array('uid' => $uid, 'arrest_date' => $arrest_date, 'arrest_month' => $arrest_month, 'arrest_year' => $arrest_year, 'race' => $race, 'gender' => $gender, 'ssn' => $ssn, 'phone_no' => $phone_no, 'address' => $address, 'state' => $state, 'zipcode' => $zipcode, 'arresting_agency' => $arresting_agency, 'offense_attested' => $offense_attested, 'verification_id' => $verification_id, 'suffix' => $suffix, 'firstname' => $firstname, 'lastname' => $lastname, 'license' => $license, 'birthdate' => $birthdate, 'case_no' => $case_no, 'alias' => $alias, 'communication_method' => $communication_method, 'city' => $city, 'date_arrest' => $date_arrest, 'status' => 'Received');
      $this->db->insert('expungument', $post_data);
      // $data = $this->db->insert_id();
      // if($data){
      // 	$this->db->get_where('user_master',array('application_id'=>$applicationID),array('exfid' =>$data));
      // }
      return $type;
   }
   public function getstatus($type)
   {
      return $this->db->select('status,uid,firstname,lastname,date_arrest,address,state,city,zipcode,phone_no,arresting_agency,offense_attested,gender,case_no as case_number,comment')->from('expungument')->where('uid', $type['uid'])->order_by('exfid', 'desc')->get()->row();
   }

   public function deleteuserdetail()
   {
      $id = $_POST['list_id'];
      $this->db->where('exfid', $id);
      $this->db->delete('expungument');
   }
   public function delete_multipaldetail($ids)
   {

      $this->db->where_in('exfid', $ids);
      $this->db->delete("expungument");
      return true;
   }
   public function updatestatus($status, $id)
   {

      $this->db->update("expungument", array('status' => $status), array('exfid' => $id));
      $userData = $this->db->select('uid,email,firstname,lastname')->from('expungument')->where('exfid', $id)->get()->row();
      // if (!empty($userData)) {
      //    $mailContaint = $this->db->get_where('wiki', array('id' => 1))->row();
      //    $logo = base_url('assets/images/logo.png');
      //    $msg = "Your application status is updated with <b>" . $status . "</b>";
      //    $replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__");
      //    $replaceFrom = array($logo, "Update Status", $userData->firstname . " " . $userData->lastname, $msg);

      //    $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
      //    $to = $userData->email;
      //    $subject = $mailContaint->subject;
      //    $message = $newContaint;

      //    $config = array(
      //       'protocol' => 'smtp',
      //       'smtp_host' => 'ssl://smtp.dreamhost.com',
      //       'smtp_port' => "465",
      //       'smtp_user' => 'no_reply@quickexpunge.io', // change it to yours
      //       'smtp_pass' => '1L0vefreedom', // change it to yours
      //       'mailtype' => 'html',
      //       'charset' => 'iso-8859-1',
      //       'wordwrap' => TRUE
      //    );
      //    $this->load->library('email', $config);
      //    $this->email->set_newline("\r\n");
      //    $this->email->from('no_reply@quickexpunge.io'); // change it to yours
      //    $this->email->to($to); // change it to yours
      //    $this->email->subject($subject);
      //    $this->email->message($message);
      //    $this->email->send();
      // }
      return true;
   }
   public function updatecomment($textcomment, $id)
   {

      $this->db->update("expungument", array('comment' => $textcomment), array('exfid' => $id));
   }
   public function uploadletter($documentName, $id)
   {

      $OldImages = $this->db->select("uid,email,firstname,lastname,multi_restriction_letter")->from("expungument")->where('exfid', $id)->get()->row();

      if (!empty($OldImages->multi_restriction_letter)) {
         $arrayLetter = json_decode($OldImages->multi_restriction_letter);
         $arrayLetter[] = $documentName;
         $this->db->update("expungument", array('multi_restriction_letter' => json_encode($arrayLetter)), array('exfid' => $id));
      } else {

         $newLetter[] = $documentName;
         $encodedLetter = json_encode($newLetter);
         $this->db->update("expungument", array('multi_restriction_letter' => $encodedLetter), array('exfid' => $id));
      }
      if (!empty($OldImages->email)) {

         $mailContaint = $this->db->get_where('wiki', array('id' => 1))->row();
         $logo = base_url('assets/images/logo.png');
         $msg = "Admin Upload <b>Proof of Restriction</b>";
         $replaceTo = array("__LOGO__", "__TITLE__", "__USERNAME__", "__EMAILTEXT__");
         $replaceFrom = array($logo, "Proof of Restriction", $OldImages->firstname . " " . $OldImages->lastname, $msg);

         $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
         $to = $OldImages->email;
         $subject = "Quick Expunge - Proof of Restriction Uploaded";
         $message = $newContaint;

         $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.dreamhost.com',
            'smtp_port' => "465",
            'smtp_user' => 'no_reply@quickexpunge.io', // change it to yours
            'smtp_pass' => '1L0vefreedom', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
         );
         $this->load->library('email', $config);
         $this->email->set_newline("\r\n");
         $this->email->from('no_reply@quickexpunge.io'); // change it to yours
         $this->email->to($to); // change it to yours
         $this->email->subject($subject);
         $this->email->message($message);
         $this->email->send();
      }

      return true;
   }
   public function removeletter($uid, $letterId)
   {

      $OldImages = $this->db->select("multi_restriction_letter")->from("expungument")->where('exfid', $uid)->get()->row();
      if (!empty($OldImages->multi_restriction_letter)) {

         $arrayLetter = json_decode($OldImages->multi_restriction_letter);

         if (!empty($arrayLetter)) {

            if (($key = array_search($letterId, $arrayLetter)) !== false) {
               unset($arrayLetter[$key]);
            }

            if (!empty($arrayLetter)) {
               $newData = array_values($arrayLetter);
               $this->db->update("expungument", array('multi_restriction_letter' => json_encode($newData)), array('exfid' => $uid));
            } else {
               $this->db->update("expungument", array('multi_restriction_letter' => NULL), array('exfid' => $uid));
            }
         }
      }
      return true;
   }
   public function download($uid, $letterId)
   {
      $OldImages = $this->db->select("multi_restriction_letter")->from("expungument")->where('exfid', $uid)->get()->row();

      if (!empty($OldImages->multi_restriction_letter)) {
         $arrayLetter = json_decode($OldImages->multi_restriction_letter);
         if (!empty($arrayLetter)) {


            $letterName = array_search($letterId, $arrayLetter);
            if ($letterName >= 0) {
               return base_url('/uploads/restriction_letters/') . $letterId;
            } else {
               return false;
            }
         }
      } else {
         return false;
      }
   }
   public function get_list_table()
   {

      $params = $totalRecords = $data = array();

      $params = $_REQUEST;
      $sort_nameKey = isset($params['columns'][$params['order'][0]['column']]['data']) ? $params['columns'][$params['order'][0]['column']]['data'] : "";
      $sort_direction = $params['order'][0]['dir'];
      $where = $sqlTot = $sqlRec = "";

      switch ($sort_nameKey) {
         case 'appno':
            $sort_name = "expungument.exfid";
            break;

         case 'name':
            $sort_name = "expungument.firstname";
            break;

         case 'email':
            $sort_name = "um.email";
            break;

         case 'agency':
            $sort_name = "expungument.arresting_agency";
            break;

         case 'dateofarrest':
            $sort_name = "expungument.arrest_date";
            break;

         case 'status':
            $sort_name = "expungument.status";
            break;

         default:
            $sort_name = "expungument.exfid";
            $sort_direction = "DESC";
            break;
      }



      if (!empty($params['search']['value'])) {
         $where .= " AND ";
         $where .= " ( ";
         $where .= " expungument.firstname LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.lastname LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR um.email LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.arresting_agency LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.license LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.case_no LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.status LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.suffix LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.firstname LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " OR expungument.lastname LIKE '%" . $params['search']['value'] . "%' ";
         $where .= " )";
      }

      $sql = "SELECT um.uid,expungument.status,expungument.exfid,expungument.arresting_agency,expungument.date_arrest,expungument.offense_attested,um.username,expungument.case_no,um.email,um.address,expungument.suffix,expungument.firstname,expungument.lastname,expungument.license,expungument.arrest_date,expungument.arrest_month,expungument.arrest_year,(select COUNT(id) FROM expungement_chat where expungement_id = expungument.exfid and is_Reeded=0 and is_admin=0 ) as is_Reeded
		        FROM expungument
				LEFT JOIN user_master um ON um.uid = expungument.uid
				WHERE 1=1 {$where} AND um.email != ''
				ORDER BY " . $sort_name . " " . $sort_direction . " ";
      //ORDER BY expungument.exfid DESC ";

      $sqlTot .= $sql;
      $sqlRec .= $sql;

      $sqlRec .=  " LIMIT " . $params['start'] . " ," . $params['length'] . " ";
      $queryTot = $this->db->query($sqlTot);
      $totalRecords = $queryTot->num_rows();
      $queryRecords = $this->db->query($sqlRec);
      $results = $queryRecords->result();
      if (!empty($results)) {
         foreach ($results as $val) {

            $date_arrest = $val->arrest_month . "-" . $val->arrest_date . "-" . $val->arrest_year;
            $notiBatch = "";
            if ($val->is_Reeded != 0) {
               //,count(expchat.is_Reeded) as is_Reeded
               $notiBatch = '<span class="NotificationBadge">' . $val->is_Reeded . '</span>';
            }

            $data[] = array(
               'deleteid' => '<input type="checkbox" id="' . $val->exfid . '" class="multdelete" value="' . $val->exfid . '">',
               'appno' => '<a href="javascript:frm_submit(' . $val->exfid . ',`Chat`,' . $val->uid . ');">' . $val->exfid . '</a>',
               'name'        =>  $val->suffix . ' ' . $val->firstname . ' ' . $val->lastname,
               'email'    => $val->email,
               'agency'     => $val->arresting_agency,
               'dateofarrest'   => $date_arrest,
               'drivelicence'   => $val->license,
               'caseno'   => $val->case_no,
               'status'   => $val->status,
               // 'chat' => '<a href="javascript:frm_submit(' . $val->exfid . ',`Chat`,' . $val->uid . ');" class="btn btn-xs" style="float: right; background:#FF7D3F;color:white" >Chat  <i class="fa fa-comment"></i></a>'.$batch,
               'chat' => '<a href="javascript:frm_submit(' . $val->exfid . ',`Chat`,' . $val->uid . ');" ><i class="fa fa-comments" style="font-size:30px"></i>' . $notiBatch . '</a>',
               'action'   => '<a href="javascript:frm_submit(' . $val->exfid . ',`View`);" class="btn btn-xs" style="float: right; background:#FF7D3F;color:white"> <i class="fa fa-edit"></i> View Detail</a>',

            );
         }
      }

      $json_data = array(
         "draw"            => intval($params['draw']),
         "recordsTotal"    => intval($totalRecords),
         "recordsFiltered" => intval($totalRecords),
         "data"            => $data   // total data array
      );

      return $json_data;
   }
}
