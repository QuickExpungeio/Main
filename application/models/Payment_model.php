<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_model extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		//$this->load->library('stripe.php');
	}

	function transaction($type){
		$token = $type['stripeToken'];

		//\Stripe\Stripe::setApiKey("sk_test_FuNGHxDVniKbRb7kKv4k32Zf00mQncLvtu");

		// Charge the user's card:
		$charge = \Stripe\Charge::create(array(
		  "amount" => 999,
		  "currency" => "usd",
		  "description" => "Example charge",
		  "capture" => false,
		  "source" => $token,
		));
	}

	function check($type)
	{	
		//echo $type['stripeToken'];
		//exit;
		//check whether stripe token is not empty
		try{
			if(!empty($type['stripeToken']))
			{
				//get token, card and user info from the form
				$token  = $type['stripeToken'];
				$name = $type['name'];
				$email = $type['email'];
				$card_num = $type['card_num'];
				$card_cvc = $type['cvc'];
				$card_exp_month = $type['exp_month'];
				$card_exp_year = $type['exp_year'];
				$amount = $type['amount'];
				$uid = $type['uid'];
				//include Stripe PHP library
				require_once APPPATH."third_party/stripe/init.php";
				
				//set api key
				$stripe = array(
				  // "secret_key"      => "sk_test_FuNGHxDVniKbRb7kKv4k32Zf00mQncLvtu",
				  // "publishable_key" => "pk_test_abeQT29NYeMmQqtYYBiAnOiU008ZvAWzbv"

				  "secret_key"      => "sk_live_6Zdt9TkTEveQ7X2Z6KeVJNGl00qj0q3rnc",
				  "publishable_key" => "pk_live_3Z6EZvBTcPMUMKFUD1A059FZ007JlesYbZ"

				);						
				
				\Stripe\Stripe::setApiKey($stripe['secret_key']);

				// $token = \Stripe\Token::create([
				// 		  'card' => [
				// 		    'number' => '4242424242424242',
				// 		    'exp_month' => 7,
				// 		    'exp_year' => 2020,
				// 		    'cvc' => '314'
				// 		  ]
				// 		]);
				// print_r($token);
				// exit;

				//add customer to stripe
				$customer = \Stripe\Customer::create(array(
					'email' => $email,
					'source'  => $token
				));
				
				//item information
				// $itemName = "Stripe Payment";
				// $itemNumber = "PS123456";
				   $itemPrice = $amount*100;
				   $currency = "usd";
				// $orderID = "SKA92712382139";
				
				//charge a credit or a debit card
				$charge = \Stripe\Charge::create(array(
					'customer' => $customer->id,
					'amount'   => $itemPrice,
					'currency' => $currency
					// 'description' => $itemNumber,
					// 'metadata' => array(
					// 	'item_id' => $itemNumber
					// )
				));
				
				//retrieve charge details
				$chargeJson = $charge->jsonSerialize();

				//check whether the charge is successful
				if($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1)
				{
					//order details 
					$amount = $chargeJson['amount'];
					$balance_transaction = $chargeJson['balance_transaction'];
					$currency = $chargeJson['currency'];
					$status = $chargeJson['status'];
					$date = date("Y-m-d H:i:s");
				
					
					//insert tansaction data into the database
					$dataDB = array(
						'uid' => $uid,
						'name' => $name,
						'account_email' => $email, 
						'card_num' => $card_num, 
						'card_cvc' => $card_cvc, 
						'card_exp_month' => $card_exp_month, 
						'card_exp_year' => $card_exp_year, 
						// 'item_name' => $itemName, 
						// 'item_number' => $itemNumber, 
						// 'item_price' => $itemPrice, 
						// 'item_price_currency' => $currency, 
						'paid_amount' => $amount/100, 
						'paid_amount_currency' => $currency, 
						'txn_id' => $balance_transaction, 
						'payment_status' => $status,
						'created_date' => $date,
						'modified_date' => $date
					);

					if ($this->db->insert('tbl_orders', $dataDB)) {
						if($this->db->insert_id() && $status == 'succeeded'){
							$data['insertID'] = $this->db->insert_id();
							//$this->load->view('payment_success', $data);
							return $status;
							// redirect('Welcome/payment_success','refresh');
						}else{
							echo "Transaction has been failed";
						}
					}
					else
					{
						echo "Not inserted. Transaction has been failed";
					}

				}
				else
				{
					echo "Invalid Token";
					$statusMsg = "";
				}
			}
		}catch (Exception $e) {
		  	$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;
		}catch(\Stripe\Exception\CardException $e){	
			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;

		}catch (\Stripe\Exception\RateLimitException $e){
			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;

		}catch (\Stripe\Exception\InvalidRequestException $e){
			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;

		}catch (\Stripe\Exception\AuthenticationException $e){
			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;

		}catch (\Stripe\Exception\ApiConnectionException $e){
			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;

		}catch (\Stripe\Exception\ApiErrorException $e){

			$data['Status']= $e->getHttpStatus();
			//$data['Type']= $e->getError()->type;
			// $data['Code']= $e->getError()->code;
			// $data['Param']= $e->getError()->param;
			$data['Message']=$e->getMessage();
			return $data;
		}
		
	}
}