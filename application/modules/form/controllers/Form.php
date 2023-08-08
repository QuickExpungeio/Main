<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Form extends MY_Controller
{
   function __construct()
   {
      parent::__construct();

      // if (isset($_SESSION['role'])) {
      //    if ($_SESSION['role'] == 'superadmin') {
      //       redirect('admin/user/user');
      //       exit;
      //    } elseif ($_SESSION['role'] == 'appuser') {
      //       redirect('user/user');
      //       exit;
      //    }
      // }

      $this->load->model('Form_model');
      $this->load->library('myuploadlibrary');

   }


   public function index()
   {

      $this->load->view('landingPage');
   }

   public function page()
   {

      $data['race'] = $this->Form_model->getrace();
      $data['state'] = $this->Form_model->getstate();
      $data['agency'] = $this->Form_model->getagency();
      $data['offence'] = $this->Form_model->getoffence();
      $data['city'] = $this->Form_model->getcity();
      $this->load->view('form', $data);
   }

   public function process()
   {
      // print_r($_POST);die;
      if (!empty($_POST)) {
         $suffix = $this->input->post('suffix');
         $firstname = $this->input->post('firstname');
         $middlename = $this->input->post('middlename');
         $lastname = $this->input->post('lastname');
         $any_other_name = $this->input->post('other');
         $phone_no = $this->input->post('phone');
         $ssn = $this->input->post('ssn');
         $email = $this->input->post('email');
         $gender = $this->input->post('gender');
         $addressone = $this->input->post('addressone');
         $addresstwo = $this->input->post('addresstwo');
         $address = $addressone . "  " . $addresstwo;
         $country = $this->input->post('country');
         $license = $this->input->post('license');
         $state_id_no = $this->input->post('state_id_no');
         $state = $this->input->post('state');
         $issuing_state = $this->input->post('issuing_state');
         $city = $this->input->post('city');
         $zipcode = $this->input->post('postcode');
         $bdate = $this->input->post('Bdate');
         $bmonth = $this->input->post('Bmonth');
         $byear = $this->input->post('Byear');
         $race = $this->input->post('race');
         $arresting_agency = $this->input->post('agency');
         $offense_attested = $this->input->post('offrncefor');
         $arrest_date = $this->input->post('arrest_date');
         $arrest_month = $this->input->post('arrest_month');
         $arrest_year = $this->input->post('arrest_year');
         $case_no = $this->input->post('case_no');
         $optradio = $this->input->post('optradio');
         $cpassword = $this->input->post('cpassword');
         if ($optradio == "sendmail") {
            $communication_method = 1;
         } else {
            $communication_method = 2;
         }
         if(empty($email)){
            $email = $this->input->post('emailNew');
         }
         // $middlename = $this->input->post('middlename');
         // $gender = $this->input->post('gender');
         // $ssn = $this->input->post('ssn');
         // $case_no = $this->input->post('case_no');
         // $sendmail = $this->input->post('sendmail');
         // $sendtext = $this->input->post('sendtext');
         // $communication_method=1;

         $verificationimage = [];
         $verification_id = "";

         if (empty($_FILES["upload"]['name'])) {
            $this->form_validation->set_rules('upload', 'Verification ID', 'required');
         } else {
            $verificationimage = $this->myuploadlibrary->upload_single_image($_FILES, 'upload', 1, FCPATH . 'uploads/');
            $imageName = explode("/", $verificationimage);

            $verificationImage = end($imageName);


            if (!empty($verificationImage)) {

               $verification_id = site_url() . 'uploads/' . $verificationImage;
            }
         }

         // if($this->form_validation->run()==TRUE){

         $data = array(
            'suffix' => $suffix,
            'firstname' => $firstname,
            'middlename' => $middlename,
            'lastname' => $lastname,
            'alias' => $any_other_name,
            'birthdate' => $bmonth . " " . $bdate . ", " . $byear,
            'license' => $license,
            'state_id_no' => $state_id_no,
            'race' => $race,
            'phone_no' => $phone_no,
            'ssn' => $ssn,
            'email' => $email,
            'gender' => $gender,
            'address' => $address,
            'city' => $city,
            'state' => $state,
            'issuing_state' => $issuing_state,
            'zipcode' => $zipcode,
            'arresting_agency' => $arresting_agency,
            'arrest_date' => $arrest_date,
            'arrest_month' => $arrest_month,
            'arrest_year' => $arrest_year,
            'offense_attested' => $offense_attested,
            'communication_method' => $communication_method,
            'verification_id' => $verification_id,
            'case_no' => $case_no,

         );
         // echo '<pre>';print_r($data);die;

         if (!isset($verificationimage['error'])) {

            $expData = $this->Form_model->expungedatastore($data, $cpassword);

            if (!empty($expData['applicationID'])) {

               $this->session->set_userdata('uidforsession', $expData['data']);
               $this->session->set_userdata('emailforsession', $expData['email']);

               $_SESSION['applicationID'] = $expData['applicationID'];
               redirect('form/form/page', 'refresh');
            } else {
               $this->session->set_flashdata('error', $expData['message']);
               redirect('form/form/page', 'refresh');
            }
         } else {

            $this->session->set_flashdata('error', $verificationimage['error']);
            redirect('form/form/page', 'refresh');
         }
      } else {
         redirect('form/form/page', 'refresh');
      }
   }

   public function payment()
   {

      $isUserReadyToPay = $this->session->userdata('uidforsession');

      if (!empty($isUserReadyToPay)) {

         $data['payamount'] = $this->Form_model->getcharge();
         $this->load->view('payment', $data);
      } else {
         redirect('form/form', 'refresh');
      }
   }

   public function isemailexist()
   {
      $email =  $this->input->post("email");
      $response = array();
      if (!empty($email)) {

         $isUserRegistered = $this->Form_model->isemailexist($email);

         if ($isUserRegistered) {
            $response['code'] = 200;
            $response['message'] = "Available";
         } else {
            $response['code'] = 201;
            $response['message'] = "Email Not Available";
         }
      } else {
         $response['code'] = 400;
         $response['message'] = "Please enter email address";
      }
      echo json_encode($response);
   }

   public function sendotp()
   {
      $response = array();
      $email = $this->input->post("email");
      if (!empty($email)) {

         $processStatus = $this->Form_model->sendotp($email);
         $response['message'] = $processStatus['message'];
         $response['code'] = $processStatus['code'];
      } else {
         $response['message'] = "Required email address";
         $response['code'] = 400;
      }
      echo json_encode($response);
   }
   public function verifyotp()
   {

      $response = array();
      $email = $this->input->post("email");
      $otp = $this->input->post("otp");
      if (!empty($email) && !empty($otp)) {

         $processStatus = $this->Form_model->verifyotp($email, $otp);
         $response['message'] = $processStatus['message'];
         $response['code'] = $processStatus['code'];
      } else {
         $response['message'] = "Required email and OTP";
         $response['code'] = 400;
      }
      echo json_encode($response);
   }

   public function strippay()
   {

      $this->load->view('thankyou');

      // $username = $this->input->post('username');
      // $cardnumber = $this->input->post('cardnumber');
      // $expmonth = $this->input->post('expmonth');
      // $expyear = $this->input->post('expyear');
      // $cvv = $this->input->post('cvv');
      // $uid = $this->session->userdata('uidforsession');
      // $email = $this->session->userdata('emailforsession');
      // $chargeArray = $this->dm->getcharge();
      // $appCharge = $chargeArray->amount;


      // $this->form_validation->set_rules('username','Name','trim|required');
      // $this->form_validation->set_rules('cardnumber','Card Number','trim|required|numeric|min_length[13]|max_length[19]');
      // $this->form_validation->set_rules('expmonth','Exp Month','trim|required|numeric|min_length[2]|max_length[2]');
      // $this->form_validation->set_rules('expyear','Exp Year','trim|required|numeric|min_length[2]|max_length[2]');
      // $this->form_validation->set_rules('cvv','CVV','trim|required|numeric|min_length[3]|max_length[3]');

      // if($this->form_validation->run()==TRUE){

      // }else{
      //     $this->session->set_flashdata('error',validation_errors() );
      //     redirect('form/form','refresh');
      // }


      // require_once APPPATH . "third_party/stripe/init.php";
      // // \Stripe\Stripe::setApiKey('sk_test_FuNGHxDVniKbRb7kKv4k32Zf00mQncLvtu');
      // \Stripe\Stripe::setApiKey('sk_live_6Zdt9TkTEveQ7X2Z6KeVJNGl00qj0q3rnc');


      //     /* $tokenObj = \Stripe\Token::create([
      //         'card' => [
      //             'number' => '4242424242424242',
      //             'exp_month' => 6,
      //             'exp_year' => 2022,
      //             'cvc' => '314',
      //         ],
      // 	]); */

      //     $tokenObj = \Stripe\Token::create([
      //         'card' => [
      //             'number' => $cardnumber,
      //             'exp_month' => $expmonth,
      //             'exp_year' => $expyear,
      //             'cvc' => $cvv,
      //         ],
      // 	]);

      //     $transferJson = $tokenObj->jsonSerialize();
      //     $token = $transferJson['id'];

      //   $data = array('stripeToken' =>$token,
      //                 'name'=>$username,
      //                 'email'=>$email,
      //                 'card_num'=>$cardnumber,
      //                 'cvc'=>$cvv,
      //                 'exp_month'=>$expmonth,
      //                 'exp_year'=>$expyear,
      //                 'amount'=>$appCharge,
      //                 'uid'=>$uid
      //             );
      //   $result = $this->dm->check($data);

      //   $this->session->unset_userdata('uidforsession');
      //   $this->session->unset_userdata('emailforsession');


      //   if($result['code']==200){

      //     $this->session->set_flashdata('success',$result['Message'] );
      //     redirect('form/form','refresh');

      //   }else{
      //     $this->session->set_flashdata('error',$result['Message'] );
      //     redirect('form/form','refresh');
      //   }
   }
}
