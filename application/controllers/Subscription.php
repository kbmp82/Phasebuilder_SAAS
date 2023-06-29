<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscription extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load Helpers
		$this->load->helper('url');
        $this->load->helper('p_helper');
		$this->config->load('paypal');
		$this->load->model('user/LoginModel');
		$this->load->model('user/SubscriptionModel');
        $this->load->model('user/ArticleModel');

		// Load PayPal library
        $config = $this->SubscriptionModel->get_paypal_credentials();
	   	$this->load->library('paypal/paypal_pro', $config);
         if(empty($this->session->userdata['ID']))
         {
           $this->session->set_userdata('last_page', 'Subscription');
         redirect('login');
         }
	}

	/**
	 * Demo Intro
	 */
	function index()
	{ 
		if($this->session->userdata('ID') == ''){
		     $this->session->set_userdata('last_page', 'Subscription');
			redirect('login');
		}else{
			// Load Intro Page
			$data['subscriptions'] = $this->SubscriptionModel->get_all_subscriptions();
            $data['user_subscription'] = $this->SubscriptionModel->get_AllSubscriptionByUser();

            $data['discount'] = $this->SubscriptionModel->get_UserDiscount();
             $data['stripe'] = $this->SubscriptionModel->get_stripe_cred();
			$this->load->view('subscription',$data);
		}
	}
	function stripe_checkout(){
	        
	     $cred =  $this->SubscriptionModel->get_stripe_cred() ;
	            if($cred->mode == 'sandbox'){

	                $apiKey  =  $cred->secret_key_sandbox  ;
	            }
	            else{
	               $apiKey  =  $cred->secret_key_live ;
	            }

            if(empty($apiKey)){
                print 'Payment Keys are not found' ;
                
                exit() ;
            }
	  //     $apiKey = 'sk_test_Xi20qwkNgpvZljk4o2NZSXK3' ;
	       
	   if(isset($_POST['stripeToken'])){
				
			
				
				
				
			$subscription_id   =   $_POST['sub_id'] ;        
	     	$stripeToken   =   $_POST['stripeToken'] ;        
			$stripeEmail   =   $_POST['stripeEmail'] ;        
			$price     =   $_POST['price'] ;
			//$price  =    $price 	;
			$duration     =   $_POST['duration'] ;
			$plan     =   $_POST['plan'] ; 
			$plan_id  =	str_replace(' ','-',$plan) ;			

		// Create a customer ... 
					
            	$curl = curl_init();
            	curl_setopt_array($curl, array(
            		CURLOPT_RETURNTRANSFER => 1,
            		CURLOPT_URL => "https://api.stripe.com/v1/customers",
            		CURLOPT_POST => 1,
            		CURLOPT_HTTPHEADER => array(
            			"Authorization: Bearer " . $apiKey
            		),
            		CURLOPT_POSTFIELDS => http_build_query(array(
            			"email" => $stripeEmail ,

            		))
            	));

            	$resp = curl_exec($curl);
            	curl_close($curl);

				$cust	=	json_decode($resp) ;
				$customer_id = 	$cust->id ;
				
			
	 // List all plans 

			$curl2 = curl_init();
				curl_setopt_array($curl2, array(
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_URL => "https://api.stripe.com/v1/plans",
					CURLOPT_POST => false,
					CURLOPT_HTTPHEADER => array(
						"Authorization: Bearer " . $apiKey
					),
				
				));

					$resp2 = curl_exec($curl2);
					curl_close($curl2);
					$plans	=	json_decode($resp2) ;
					$plans = 	$plans->data ; 	
			
					

			
				foreach($plans as $all_plan){
					
					if($all_plan->id == $plan){
						$plan_id 	=	$plan ;
					}
					else{
					
			//		Create a Plan if not exists ... 	

						$curl2 = curl_init();
							curl_setopt_array($curl2, array(
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => "https://api.stripe.com/v1/plans",
								CURLOPT_POST => 1,
								CURLOPT_HTTPHEADER => array(
									"Authorization: Bearer " . $apiKey
								),
								CURLOPT_POSTFIELDS => http_build_query(array(
									"amount" => $price ,
									"interval" => 'month',
									"product[name]" => $plan_id,
									"currency" => 'usd',
									"id" => $plan_id,
								 ))
							));

						$resp2 = curl_exec($curl2);
						curl_close($curl2);
						$new_plan	=	json_decode($resp2) ;
						if(isset($new_plan->id)){
						$plan_id  = $new_plan->id ;
						}
					}
				
					
				}
                //check if user has current subscription and cancel it before creating a new one
		 if($this->session->userdata('account_status') == "Good"){
                                          // ECHO "ACCOUNT STATIS IS GOOD..CANCELING SUB BEFORE CREATING NEW ONE";
                                          $this->session->set_userdata('sub_change', 'yes');
                                          $this->cancel_subscription();
                                          }else{
                                              $this->session->set_userdata('sub_change', 'no');
                                          }
                                          $this->db->where('user_id',$this->session->userdata('ID'));
                                            $query=$this->db->delete('user_subscription');
                                          //  echo "query result delete is: ".var_dump($query);
					
		// Create a Subscription ... 
		
					$curl3 = curl_init();
						curl_setopt_array($curl3, array(
						CURLOPT_RETURNTRANSFER => 1,
						CURLOPT_URL => "https://api.stripe.com/v1/subscriptions",
						CURLOPT_POST => 1,
						CURLOPT_HTTPHEADER => array(
							"Authorization: Bearer " . $apiKey
						),
						CURLOPT_POSTFIELDS => http_build_query(array(
							"items[0][plan]" => $plan_id,
							"customer" => $customer_id ,
							"source" => $stripeToken ,
						 ))
					));

					$resp3 = curl_exec($curl3);
					curl_close($curl3);
							
						$array 	=	json_decode($resp3) ;

					if($array->id){
						
								 $created		=		$array->current_period_start ;
								 $end		=		$array->current_period_end ;
								$created = date("c", $created) ;  
								$end_date = date("c", $end)	;
								$amount  =	$array->plan->amount/100 ;
								$currency  =	$array->plan->currency ;
								$status  =	$array->status ;
								$title  =	$array->plan->id ;
								
								// $subscription_id = $subscription_id ,
								// $subscription_id = $array->id ,
								// $nex_bill_date = $array->created ,
								// $amt_billed = '0' ,
								// $status   = 'active' ,
								// $suspended = '0' ,
							
						$data_sub = array(
								'user_id' => $this->session->userdata('ID') ,
								'start_date'	=> $created ,
								'end_date'	=> $end_date ,
								'subscription_id'	=> $subscription_id ,
								'amount'	=> $amount, 
								'payment_profile_id'	=> $array->id,
								'next_bill_date'	=> $end_date ,
								'amt_billed'	=> 0 , 
								'status'	=>	'active' ,
								'suspended'	=>	'0' ,
                                'suspended_end_date' =>	'none' ,
                                'gateway' => 'stripe',
                                'stripe_cust_id' => $customer_id,
								)	;
						$data_trans = array(
								'user_id' => $this->session->userdata('ID') ,
								'transaction_id'	=> $array->id ,
								'subscriptionid'	=> $subscription_id ,
								'payment_type' => 'Recurring',
								'order_time' => $created,
								'amount'	=> $amount,
								'fee_amt'	=> '',
								'settle_amt'	=> '', 
								'tax_amt'	=> '', 
								'exchange_rate'	=> '', 
								'currency_code'	=> $currency, 
								'payment_status'	=> $status, 
								'pending_reason	'	=> '', 
								'title'	=> $title,
                                'gateway' => 'stripe',
								) ;
								


                                          $this->db->select('suspended');
   $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $query = $this->db->get();
   $row = $query->row();

        if (isset($row)) {
        $status_acct = $row->suspended;
        }else{
            $status_acct = 0;
        }
   if($status_acct && $status_acct == 1){
    $this->SubscriptionModel->unsuspendAccount($this->session->userdata('ID'));

   }

						$result	=$this->SubscriptionModel->save_stripe($data_sub,$data_trans) ;
					  	$this->SubscriptionModel->get_sub_status();
                        $this->SubscriptionModel->renewCredits();
                       // echo $this->session->userdata('account_status');
								if($result){
								   $this->my_subscriptions('subscription/my_subscriptions') ;
								}
								
					}
				
		 }
	 
	}
	

	
	
	function checkout(){
		if($this->session->userdata('ID') != ''){
		   $sub_id = $this->input->post('p_id');//	$sub_id = $this->input->post('sub_id');
			$id = $this->input->post('p_id');
			$name = $this->input->post('p_name');
			$qty = $this->input->post('qty');
			$price = $this->input->post('price');
		   //	$shipping = $_POST['shipping'];
			//$tax = $_POST['tax'];
			$pay_type = $this->input->post('pay_type');
            $sub_type = $this->input->post('sub_type');
			$billing_period = $this->input->post('billing_period');
			$billing_frequency = $this->input->post('billing_frequency');
			$billing_cycles = $this->input->post('billing_cycles');
			$currency = $this->input->post('currency');
			$description = $this->input->post('description');
			$subtotal = $price * $qty;
            // $billing_period_trial = $this->input->post('billing_period_trial');
		   //	$billing_frequency_trial = $this->input->post('billing_frequency_trial');
		   //	$billing_cycles_trial = $this->input->post('billing_cycles_trial');
            if($sub_type == "article"){

              if($this->input->post('article_domain') != "" && $this->input->post('article_type') != "" && $this->input->post('article_creation') != "" && $this->input->post('amazon_url') != "" ){
                   //unset the article data from previous order
                 $this->session->unset_userdata('article_details');
           if($this->input->post('article_creation') == "create_self"){
             if($this->input->post('article_title') != ""){
                 $azon_asin = get_asin($this->input->post('amazon_url'));
                 if($azon_asin != ''){
                      //add new article data
                 $article['article_details'][0] = array(
                 'article_credits' => $this->input->post('a_credits'),
				'article_title' => $this->input->post('article_title'),
				'article_type' => $this->input->post('article_type'),
                'article_keyword' => $this->input->post('article_keyword'),
				'article_domain' => $this->input->post('article_domain'),
				'article_ins' => $this->input->post('article_ins'),
                'price' => $this->input->post('price'),
                'amazon_asin' => $azon_asin,
			);

                 $this->session->set_userdata('article_details', $article);
                 }else{
                    $this->session->set_flashdata('articles_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please use correct Amazon product URL.</span>');
            redirect('articles');
                 }

             }else{
                 $this->session->set_flashdata('articles_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please fill in article title and instructions.</span>');
            redirect('articles');
             }
           }else{
               //add new article data
               $article['article_details'][0] = array(
               'article_credits' => $this->input->post('a_credits'),//$_POST['a_credits']
				'article_title' => 'auto',
                'article_keyword' => 'auto',
				'article_type' => $this->input->post('article_type'),//$_POST['article_type'],
				'article_domain' => $this->input->post('article_domain'),//$_POST['article_domain'],
				'article_ins' => 'auto',
                'price' => $this->input->post('price'),//$_POST['article_ins'],
                'amazon_asin' => 'auto',
			);
                 $this->session->set_userdata('article_details', $article);
           }
        }else{
           	$this->session->set_flashdata('articles_update_success', '<span style="float: left;width: 100%;" class="alert alert-danger">Please fill in all fields.'.$_POST['article_domain'].' '.$_POST['article_type'].' '.$_POST['article_creation'].'</span>');
            redirect('articles');
        }


            }
			// Clear PayPalResult from session userdata
			$this->session->unset_userdata('PayPalResult');
			// Clear cart from session userdata
			$this->session->unset_userdata('shopping_cart');
			// For demo purpose, we create example shopping cart data for display on sample cart review pages
			// Example Data - cart item
			$cart['items'][0] = array(
				'id' => $id,
				'name' => $name,
				'qty' => $qty,
				'price' => $price,
				'billing_period' => $billing_period,
				'billing_frequency' => $billing_frequency,
				'billing_cycles' => $billing_cycles,
				'currency' => $currency,
				'description' => $description,
				'pay_type' => $pay_type,
                'sub_type' => $sub_type,
				'sub_id' => $sub_id,
			);

			// Example Data - cart variable with items included
			$cart['shopping_cart'] = array(
				'items' => $cart['items'],
				'subtotal' => $subtotal,
			
			);
			// Example Data - grand total
			$cart['shopping_cart']['grand_total'] = number_format($cart['shopping_cart']['subtotal'], 2);
			// Load example cart data to variable
			$this->load->vars('cart', $cart);
			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Example - Load Review Page
			//$this->load->view('checkout',$cart);
            //go to paypal
            
            if($sub_type == "article" &&  $this->input->post('a_credits') > 0 && $this->input->post('price') == 'free'){
               //$cart['shopping_cart']['items'][0]['price'] = 0.00;
               $this->OrderComplete();
            }else{

               $this->SetExpressCheckout();
            }

		}else{
			redirect('login');
		}
	}
	
	
	/**
	 * SetExpressCheckout
	 */
	function SetExpressCheckout()
	{
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');
		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');
		/**
		 * Here we are setting up the parameters for a basic Express Checkout flow.
		 *
		 * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
		 * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
		 *
		 * $domain used here is set in the config file.
		 */
		$SECFields = array(
			'maxamt' => round($cart['shopping_cart']['grand_total'] * 2,2), 					// The expected maximum total amount the order will be, including S&H and sales tax.
			'returnurl' => site_url('subscription/GetExpressCheckoutDetails'), 							    // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
            'cancelurl' => site_url('/Subscription'), 							    // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
			'hdrimg' => 'https://phasebuilder.com/membershipkc/main/images/pp_logo_750.png', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
			'logoimg' => 'https://phasebuilder.com/membershipkc/main/images/pp-logo_full.png', 					// A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
			'brandname' => 'Phase Builder', 							                                // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
			'customerservicenumber' => '816-555-5555', 				                                // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
		   'billingtype' => 'RecurringPayments',
		   'billingagreementdescription' => $cart['shopping_cart']['items'][0]['description'],
        'PAYMENTREQUEST_0_PAYMENTACTION'=>'Sale',
'L_PAYMENTREQUEST_0_NAME0'=>$cart['shopping_cart']['items'][0]['name'],
//'L_PAYMENTREQUEST_0_QTY0'=>1,
'L_PAYMENTREQUEST_0_AMT0'=>$cart['shopping_cart']['items'][0]['price'],
'PAYMENTREQUEST_0_DESC' => $cart['shopping_cart']['items'][0]['description']
		);

		/**
		 * Now we begin setting up our payment(s).
		 *
		 * Express Checkout includes the ability to setup parallel payments,
		 * so we have to populate our $Payments array here accordingly.
		 *
		 * For this sample (and in most use cases) we only need a single payment,
		 * but we still have to populate $Payments with a single $Payment array.
		 *
		 * Once again, the template file includes a lot more available parameters,
		 * but for this basic sample we've removed everything that we're not using,
		 * so all we have is an amount.
		 */
		$Payments = array();
		$Payment = array(
			'amt' => $cart['shopping_cart']['grand_total'], 	// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
		);

		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments' => $Payments,
		);
		
		/**
		 * Here we are making the call to the SetExpressCheckout function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);
		
			
		//print_r($PayPalResult);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If all goes well, we save our token in a session variable so that it's
		 * readily available for us later, and then redirect the user to PayPal
		 * using the REDIRECTURL returned by the SetExpressCheckout() function.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);
			
			//print_r($PayPalResult);
			//exit();

			$this->load->view('paypal_error');
		}
		else
		{
			// Successful call.

			// Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
			$this->session->set_userdata('PayPalResult', $PayPalResult);
			
			
			//print_r($PayPalResult);
			//exit();
			

			// In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
			// Move to PayPal checkout
			redirect($PayPalResult['REDIRECTURL'], 'Location');
		}
	}

	/**
	 * GetExpressCheckoutDetails
	 */
	function GetExpressCheckoutDetails()
	{
	
	

	
		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');

		// Get PayPal data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		/**
		 * Now we pass the PayPal token that we saved to a session variable
		 * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
		 * request.
		 */
		$PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('paypal_error');
		}
		else
		{
			// Successful call.

			/**
			 * Here we'll pull out data from the PayPal response.
			 * Refer to the PayPal API Reference for all of the variables available
			 * in $PayPalResult['variablename']
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
		
		
				
		
		
		
			 *
			 * Again, Express Checkout allows for parallel payments, so what we're doing here
			 * is usually the library to parse out the individual payments using the GetPayments()
			 * method so that we can easily access the data.
			 *
			 * We only have a single payment here, which will be the case with most checkouts,
			 * but we will still loop through the $Payments array returned by the library
			 * to grab our data accordingly.
			 */
			$cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
			$cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
			$cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
			$cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
			$cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

			foreach($PayPalResult['PAYMENTS'] as $payment) {
				$cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
				$cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
				$cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
				$cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
				$cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
				$cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
				$cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
			}

			/**
			 * At this point, we now have the buyer's shipping address available in our app.
			 * We could now run the data through a shipping calculator to retrieve rate
			 * information for this particular order.
			 *
			 * This would also be the time to calculate any sales tax you may need to
			 * add to the order, as well as handling fees.
			 *
			 * We're going to set static values for these things in our static
			 * shopping cart, and then re-calculate our grand total.
			 */
        /*
        $cart['shopping_cart']['shipping'] = $cart['shopping_cart']['shipping'];
			$cart['shopping_cart']['handling'] = $cart['shopping_cart']['shipping'];
			$cart['shopping_cart']['tax'] = $cart['shopping_cart']['shipping'];

			$cart['shopping_cart']['grand_total'] = number_format(
				$cart['shopping_cart']['subtotal']
				+ $cart['shopping_cart']['shipping']
				+ $cart['shopping_cart']['handling']
				+ $cart['shopping_cart']['tax'],2);
            */
			/**
			 * Now we will redirect the user to a final review
			 * page so they can see the shipping/handling/tax
			 * that has been added to the order.
			 */
			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Load example cart data to variable
			$this->load->vars('cart', $cart);

			// Example - Load Review Page
           // $this->load->view('review', $cart);
            // process payment
            $this->DoExpressCheckoutPayment();
		}
	}

	/**
	 * DoExpressCheckoutPayment
	 */
	function DoExpressCheckoutPayment()
	{
		/**
		 * Now we'll setup the request params for the final call in the Express Checkout flow.
		 * This is very similar to SetExpressCheckout except that now we can include values
		 * for the shipping, handling, and tax amounts, as well as the buyer's name and
		 * shipping address that we obtained in the GetExpressCheckoutDetails step.
		 *
		 * If this information is not included in this final call, it will not be
		 * available in PayPal's transaction details data.
		 *
		 * Once again, the template for DoExpressCheckoutPayment provides
		 * many more params that are available, but we've stripped everything
		 * we are not using in this basic demo out.
		 */
$flag1 = '';
		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');


$cartdata= $cart['items'][0]['id'];

		// Get cart data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		$DECPFields = array(
			'token' => $PayPal_Token, 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
			'payerid' => $cart['paypal_payer_id'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
		);

		/**
		 * Just like with SetExpressCheckout, we need to gather our $Payment
		 * data to pass into our $Payments array.  This time we can include
		 * the shipping, handling, tax, and shipping address details that we
		 * now have.
		 */
		$Payments = array();
		$Payment = array(
			'amt' => number_format($cart['shopping_cart']['grand_total'],2), 	    // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
			'itemamt' => number_format($cart['shopping_cart']['subtotal'],2),       // Subtotal of items only.
			'currencycode' => 'USD', 					                                // A three-character currency code.  Default is USD.
			//'shippingamt' => number_format($cart['shopping_cart']['shipping'],2), 	// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
			//'handlingamt' => number_format($cart['shopping_cart']['handling'],2), 	// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
			//'taxamt' => number_format($cart['shopping_cart']['tax'],2), 			// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
			'shiptoname' => $cart['shipping_name'], 					            // Required if shipping is included.  Person's name associated with this address.  32 char max.
			'shiptostreet' => $cart['shipping_street'], 					        // Required if shipping is included.  First street address.  100 char max.
			'shiptocity' => $cart['shipping_city'], 					            // Required if shipping is included.  Name of city.  40 char max.
			'shiptostate' => $cart['shipping_state'], 					            // Required if shipping is included.  Name of state or province.  40 char max.
			'shiptozip' => $cart['shipping_zip'], 						            // Required if shipping is included.  Postal code of shipping address.  20 char max.
			'shiptocountrycode' => $cart['shipping_country_code'], 				    // Required if shipping is included.  Country code of shipping address.  2 char max.
			'shiptophonenum' => $cart['phone_number'],  				            // Phone number for shipping address.  20 char max.
			'paymentaction' => 'Sale', 					                                // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
		);
		
	
		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'DECPFields' => $DECPFields,
			'Payments' => $Payments,
		);

		/**
		 * Here we are making the call to the DoExpressCheckoutPayment function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

		
		$CRPPFields = array(
			'token' => $PayPalResult['TOKEN'],
		);
		
		$userData = $this->LoginModel->get_user($this->session->userdata('ID'));
        $sub_id = $cart['shopping_cart']['items'][0]['sub_id'];
		$name = $cart['shopping_cart']['items'][0]['name'];
		$billing_period = $cart['shopping_cart']['items'][0]['billing_period'];
		$billing_frequency = $cart['shopping_cart']['items'][0]['billing_frequency'];
		$billing_cycles = $cart['shopping_cart']['items'][0]['billing_cycles'];
		$currency = $cart['shopping_cart']['items'][0]['currency'];
		$price = $cart['shopping_cart']['items'][0]['price'];
		$description = $cart['shopping_cart']['items'][0]['description'];
		$pay_type = $cart['shopping_cart']['items'][0]['pay_type'];
		$subtotal = $cart['shopping_cart']['subtotal'];
		//$shipping = $cart['shopping_cart']['shipping'];
		//$tax = $cart['shopping_cart']['tax'];
/*
if($this->session->userdata('account_status') == "Good"){
    $this->db->select('next_bill_date')->from('user_subscription');
    $this->db->where('user_id',$this->session->userdata('ID'));
    $next_bill = $this->db->get()->row()->next_bill_date;
    $trialDays = get_days_between($next_bill,'now');
$ProfileDetails = array(
					'subscribername' => $userData->firstname,
					'profilestartdate' => date("Y-m-d\TH:i:s\Z"),//strtotime("+".$trialDays." days")),
					'profilereference' => $userData->username,
					'desc' => $description,
				);
 }else{
 */
  $ProfileDetails = array(
					'subscribername' => $userData->firstname,
					'profilestartdate' => date("Y-m-d\TH:i:s\Z"),
					'profilereference' => $userData->username,
					'desc' => $description,
				);
// }
/*$ScheduleDetails = array(
					'desc' => 'testerrr',
					'maxfailedpayments' => '3',
					'autobilloutamt' => '1,000.00',
				);
		         */
		
/*
if($this->session->userdata('account_status') == "Good"){
    $trialDays = get_days_between($next_bill,'now');
   // $cart['shopping_cart']['trialDays'] = $trialDays;
   $BillingPeriod = array(
				   'trialbillingperiod' => 'Day',
					'trialbillingfrequency' => $trialDays,          //number of days between today and next billing period. Ex: 14 days left before next subscription payment then input here would be 14. Doing this as a trial keeps billing date the same and activate upgrade on next billing cycle
				   'trialtotalbillingcycles' => 1,                             //set to 1 so it runs 1 cycle
					'trialamt' => 0,                                        //cost of trial period
                    //'initamt' => 0,                                       //to charge a fee during subscription upgrade add it here
					'billingperiod' => $billing_period, 						// Required.  Unit for billing during this subscription period.  One of the following: Day, Week, SemiMonth, Month, Year
					'billingfrequency' => $billing_frequency, 					// Required.  Number of billing periods that make up one billing cycle.  The combination of billing freq. and billing period must be less than or equal to one year.
					'totalbillingcycles' => $billing_cycles,
					'amt' => $price,
					'currencycode' => $currency, 						// Required.  Three-letter currency code.
					//'shippingamt' => $shipping, 						// Shipping amount for each billing cycle during the payment period.
					//'taxamt' => $tax 								// Tax amount for each billing cycle during the payment period.
				);

$cart['shopping_cart']['change'] = "yes";
//$this->SubscriptionModel->get_sub_status();

}else{
*/
 $BillingPeriod = array(
				   //	'trialbillingperiod' => $billing_period_trial,
					//'trialbillingfrequency' => $billing_frequency_trial,
				   //	'trialtotalbillingcycles' => $billing_cycles_trial,
					//'trialamt' => $price_trial,
                    //'initamt' => $price,
					'billingperiod' => $billing_period, 						// Required.  Unit for billing during this subscription period.  One of the following: Day, Week, SemiMonth, Month, Year
					'billingfrequency' => $billing_frequency, 					// Required.  Number of billing periods that make up one billing cycle.  The combination of billing freq. and billing period must be less than or equal to one year.
					'totalbillingcycles' => $billing_cycles,
					'amt' => $price,
					'currencycode' => $currency, 						// Required.  Three-letter currency code.
					//'shippingamt' => $shipping, 						// Shipping amount for each billing cycle during the payment period.
					//'taxamt' => $tax 								// Tax amount for each billing cycle during the payment period.
				);
                $cart['shopping_cart']['change'] = "no";
//}

		
				
$CCDetails = array(
					'creditcardtype' => 'Visa', 					// Required. Type of credit card.  Visa, MasterCard, Discover, Amex, Maestro, Solo.  If Maestro or Solo, the currency code must be GBP.  In addition, either start date or issue number must be specified.
					'acct' => '4900000000000086', 								// Required.  Credit card number.  No spaces or punctuation.  
					'expdate' => '12/2020', 							// Required.  Credit card expiration date.  Format is MMYYYY
					'cvv2' => '123', 								// Requirements determined by your PayPal account settings.  Security digits for credit card.
				);
				
$PayerInfo = array(
					'email' => $userData->email,
				);
				
				
$BillingAddress = array(
						'street' => $userData->address, 						// Required.  First street address.
						'city' => 'mohali', 							// Required.  Name of City.
						'state' => 'chandigarh', 							// Required. Name of State or Province.
						'countrycode' => 'IN', 					// Required.  Country code.
						'zip' => '247001', 							// Required.  Postal code of payer.
						'phonenum' => '1234567890' 						// Phone Number of payer.  20 char max.
					);
					
$ShippingAddress = array(
						'shiptoname' => 'shekhar', 					// Required if shipping is included.  Person's name associated with this address.  32 char max.
						'shiptostreet' => 'abc123', 					// Required if shipping is included.  First street address.  100 char max.
						'shiptostreet2' => 'abc', 					// Second street address.  100 char max.
						'shiptocity' => 'mohali', 					// Required if shipping is included.  Name of city.  40 char max.
						'shiptostate' => 'chandigarh', 					// Required if shipping is included.  Name of state or province.  40 char max.
						'shiptozip' => '247001', 						// Required if shipping is included.  Postal code of shipping address.  20 char max.
						'shiptocountry' => 'India', 					// Required if shipping is included.  Country code of shipping address.  2 char max.
						);
						
// For order items you populate a nested array with multiple $Item arrays.  Normally you'll be looping through cart items to populate the $Item 
// array and then push it into the $OrderItems array at the end of each loop for an entire collection of all items in $OrderItems.
$OrderItems = array();
$Item	 = array(
						//'l_itemcategory' => 'digital', 				// One of the following values:  Digital, Physical
						'l_name' => $name, 						// Item Name.  127 char max.
						'l_desc' => $description, 						// Item description.  127 char max.
						'l_amt' => $price, 							// Cost of individual item.
				);
array_push($OrderItems, $Item);
$PayPalRequestData = array(
						'CRPPFields' => $CRPPFields,
						'ProfileDetails' => $ProfileDetails,
						/*'ScheduleDetails' => $ScheduleDetails, */
						'BillingPeriod' => $BillingPeriod,
						/*'CCDetails' => $CCDetails,*/
						/*'PayerInfo' => $PayerInfo,*/
						/*'BillingAddress' => $BillingAddress, */
						/*'ShippingAddress' => $ShippingAddress, */
						/*'OrderItems' => $OrderItems*/
						);
		
		
		$flag1 = 'true';
		
		
 
if($pay_type=='recurring'){
		$recurringProfileResponse=$this->paypal_pro->CreateRecurringPaymentsProfile($PayPalRequestData);
        /*
        echo "<pre>";
			print_r($recurringProfileResponse);
			echo "</pre>";
				echo $recurringProfileResponse['ACK'];
			//exit();   */
		if($recurringProfileResponse['ACK'] == 'Success')
			{

				$profileId = $recurringProfileResponse['PROFILEID'];
				$transactionId = $profileId;
				$transactionType = $recurringProfileResponse['REQUESTDATA']['BILLINGPERIOD'];
				$paymentType = "Recurring";
				$orderTime = $recurringProfileResponse['REQUESTDATA']['PROFILESTARTDATE'];
				$amount = $recurringProfileResponse['REQUESTDATA']['AMT'];
				$feeAmt = $recurringProfileResponse['REQUESTDATA']['FEEAMT'];
			   //	$settleAmt = $recurringProfileResponse['REQUESTDATA']['SETTLEAMT'];
                $status = isset($recurringProfileResponse['REQUESTDATA']['PROFILESTATUS']) ? $recurringProfileResponse['REQUESTDATA']['PROFILESTATUS'] : $recurringProfileResponse['PROFILESTATUS'];  //ActiveProfile = current and active
				//$taxAmt = $recurringProfileResponse['REQUESTDATA']['TAXAMT'];
				$exchangeRate = '';
				$currencyCode = $recurringProfileResponse['REQUESTDATA']['CURRENCYCODE'];
				$paymentStatus = '';
				$pendingReason = '';

				if(!is_numeric($feeAmt)){
                  $feeAmt = 0;
				}
				$data = array(
							'user_id' => $this->session->userdata('ID'),
							'transaction_id' => $transactionId,
							'subscriptionid' =>$sub_id,
							'payment_type' => $paymentType,
							'order_time' => $orderTime,
							'amount' => $amount,
							'fee_amt' => $feeAmt,
							'settle_amt' => $amount - $feeAmt,
							//'tax_amt' => $taxAmt,
							'exchange_rate' => $exchangeRate,
							'currency_code' => $currencyCode,
							'payment_status' => $paymentStatus,
							'pending_reason' => $pendingReason,
                            'title' => $name,
                            'gateway' => 'paypal',

							);
							//endtime = when user is no longer billed/subscritpion ends
                             switch ($transactionType) {
    case "Day":
   $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+1 day'));
       //$endtime = $recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'].'days';
        break;
    case "Week":
    $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+1 week'));
        //$endtime = ($recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'] * 7).'days';
        break;
    case "Month":
    $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+1 month'));
        //$endtime = ($recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'] * 30).'days';
        break;
        case "SemiMonth":
        $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+6 months'));
        //$endtime = ($recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'] * 180).'days';
        break;
        case "Year":
        $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+1 year'));
        //$endtime = ($recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'] * 365).'days';
        break;
    default:
    $next_bill = date("Y-m-d\TH:i:s\Z",strtotime('+1 month'));
    // $endtime = ($recurringProfileResponse['REQUESTDATA']['TOTALBILLINGCYCLES'] * 30).'days';
}

                            $userdata = array(
							'user_id' => $this->session->userdata('ID'),
							'start_date' => $orderTime,
							'end_date' => 'Until Canceled',//$endtime,
							'subscription_id' => $sub_id,
							'amount' => $amount,
                            'payment_profile_id' => $profileId,
                            'next_bill_date' => $next_bill,
                            'status' => 'active',
                            'suspended' => 0,
                            'suspended_end_date' => 'none',
                            'gateway' => 'paypal',
                            'stripe_cust_id' => 'none',
							);

						   $cart['shopping_cart']['payment_profile_id'] = $profileId;
						  if($flag1 == 'true'){

                                          $this->LoginModel->insert_transaction($data);
                                          if($this->session->userdata('account_status') == "Good"){
                                          $this->session->set_userdata('sub_change', 'yes');
                                          $this->SubscriptionModel->cancel_subscription();
                                          $this->db->where('user_id',$this->session->userdata('ID'));
                                            $query=$this->db->delete('user_subscription');
                                          }else{
                                              $this->session->set_userdata('sub_change', 'no');
                                          }
                                          $this->db->select('suspended');
   $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $query = $this->db->get();
   $row = $query->row();

        if (isset($row)) {
        $status_acct = $row->suspended;
        }else{
            $status_acct = 0;
        }
   if($status_acct && $status_acct == 1){
    $this->SubscriptionModel->unsuspendAccount($this->session->userdata('ID'));

   }

                                          $this->LoginModel->insert_mysubscription($userdata);
                                          $this->SubscriptionModel->renewCredits();
                                          $this->SubscriptionModel->get_sub_status();
                                          $flag1 = 'false';
                                      
                                }
                                
			}
		// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Successful Order
			redirect('subscription/OrderComplete');
		
		
		}else{
		
		
		
		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables, and then redirect to our final
		 * thank you / receipt page.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('paypal_error');
		}
		else
		{
			// Successful call.
			/**
			 * Once again, since Express Checkout allows for multiple payments in a single transaction,
			 * the DoExpressCheckoutPayment response is setup to provide data for each potential payment.
			 * As such, we need to loop through all the payment info in the response.
			 *
			 * The library helps us do this using the GetExpressCheckoutPaymentInfo() method.  We'll
			 * load our $payments_info using that method, and then loop through the results to pull
			 * out our details for the transaction.
			 *
			 * Again, in this case we are you only working with a single payment, but we'll still
			 * loop through the results accordingly.
			 *
			 * Here, we're only pulling out the PayPal transaction ID and fee amount, but you may
			 * refer to the API reference for all the additional parameters you have available at
			 * this point.
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
			 */
			 
			$cartsitem = $this->session->userdata('shopping_cart');

			
			$itemnames = $cartsitem['items'][0]['name'];
			
			
		if($itemnames == 'Testing'){
		   $itemid = 1;
		}else{
		   $itemid = '2';
		}
			
		
			 $flag = 'true';
			foreach($PayPalResult['PAYMENTS'] as $payment)
			{
				$transactionId = $payment['TRANSACTIONID'];
				$transactionType = $payment['TRANSACTIONTYPE'];
				$paymentType = $payment['PAYMENTTYPE'];
				$orderTime = $payment['ORDERTIME'];
				$amount = $payment['AMT'];
				$feeAmt = $payment['FEEAMT'];
			   //	$settleAmt = $payment['SETTLEAMT'];
			   	//$taxAmt = $payment['TAXAMT'];
				$exchangeRate = $payment['EXCHANGERATE'];
				$currencyCode = $payment['CURRENCYCODE'];
				$paymentStatus = $payment['PAYMENTSTATUS'];
				$pendingReason = $payment['PENDINGREASON'];
				 if(!is_numeric($feeAmt)){
                  $feeAmt = 0;
				}
				$data = array(
							'user_id' => $this->session->userdata('ID'),
							'transaction_id' => $transactionId,
							'subscriptionid' =>$sub_id,
							'payment_type' => $transactionId,
							'order_time' => $orderTime,
							'amount' => $amount,
							'fee_amt' => $feeAmt,
							'settle_amt' => $amount - $feeAmt,
							//'tax_amt' => $taxAmt,
							'exchange_rate' => $exchangeRate,
							'currency_code' => $currencyCode,
							'payment_status' => $paymentStatus,
							'pending_reason' => $pendingReason,
                            'title' => $name,
							);

							
							
					if($flag == 'true' && $flag1 == 'true'){
							
                                          $this->LoginModel->insert_transaction($data);

                                         // $this->LoginModel->insert_mysubscription($userdata);
                                          $flag = 'false';
                                      
                                }
                                

                                    

                                

				$cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
				$cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
			}

			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Successful Order
			redirect('subscription/OrderComplete');
		}
		}
	}

	/**
	 * Order Complete - Pay Return Url
	 */
	function OrderComplete()
	{
		// Get cart from session userdata
		$cart = $this->session->userdata('shopping_cart');

        	if(empty($cart)) redirect('subscription/checkout');

		// Set cart data into session userdata
		$this->load->vars('cart', $cart);
		 //check if an article was ordered
        if($cart['shopping_cart']['items'][0]['sub_type'] == "article"){
            $article = $this->session->userdata('article_details');
            //call article model to process article
       $result = $this->ArticleModel->order_article($this->session->userdata('ID'),$article['article_details'][0]['article_domain'],$article['article_details'][0]['article_type'],$article['article_details'][0]['article_title'],$article['article_details'][0]['article_ins'],$article['article_details'][0]['article_keyword'],$article['article_details'][0]['article_credits'],$article['article_details'][0]['price'],$article['article_details'][0]['amazon_asin']);
      //var_dump($result);
       if($result){

				$this->session->set_flashdata('articles_update_success', '<span style="float: left; width: 100%;" class="alert alert-success">Article ordered successfully.</span>');
			   	redirect('articles/view_articles');
			}else{
				$this->session->set_flashdata('articles_update_success', '<span style="float: left; width: 100%;" class="alert alert-danger">Something went wrong.</span>');
			   	redirect('articles/view_articles');
			}
        //redirect to view articles page
       // $this->load->view('view_articles');
        }else{
		// Successful call.  Load view or whatever you need to do here.
	   //	$this->load->view('payment_complete');
       $this->my_subscriptions('subscription/my_subscriptions') ;
        }

	}

	/**
	 * Order Cancelled - Pay Cancel Url
	 */
	function OrderCancelled()
	{
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		$this->session->unset_userdata('shopping_cart');

		// Successful call.  Load view or whatever you need to do here.
		$this->load->view('order_cancelled');
	}
	
	function subscription_add(){
		if($this->session->userdata('ID') != ''){
			$this->load->view('add_subscription');
		}else{
			$this->load->helper('url');
			redirect('login');
		}
	}

    function cancel_subscription(){
      if($this->session->userdata('ID') != ''){
             $this->db->where('user_id',$this->session->userdata('ID'));
              $this->db->where('status','active');
         $query=$this->db->get('user_subscription');
          if($query->num_rows()>0){
             $gateway = $query->row()->gateway;


         if($gateway == "paypal"){
           $this->SubscriptionModel->cancel_subscription();
         }else if($gateway == "stripe"){
          $this->SubscriptionModel->cancel_subscription_stripe();

         }
         //var_dump($result);
         }
     //$this->SubscriptionModel->get_sub_status();
      //redirect('dashboard');
      }

    }
     function cancel_subscription_link(){
      if($this->session->userdata('ID') != ''){
             $this->db->where('user_id',$this->session->userdata('ID'));
              $this->db->where('status','active');
         $gateway=$this->db->get('user_subscription')->row()->gateway;
         // echo  "gateway is ".$gateway;
         if($gateway == "paypal"){
           //  echo " cancelling paypal ";
          $result = $this->SubscriptionModel->cancel_subscription();
         }else if($gateway == "stripe"){
            // echo " cancelling stripe ";
         $result = $this->SubscriptionModel->cancel_subscription_stripe();

         }
        // var_dump($result);

     $this->SubscriptionModel->get_sub_status();
      redirect('dashboard');
      }

    }

	function add_sub(){
		/*echo "<pre>";
		print_r($_POST);
		echo "</pre>";*/
		$sub_id = $_POST['sub_id'];
		$title = $_POST['title'];
		$subtitle = $_POST['subtitle'];
		$duration = $_POST['type'];
		$sub_type = $_POST['sub_type'];
		$pay_type = $_POST['pay_type'];
		$b_frequency = $_POST['b_frequency'];
		$b_cycles = $_POST['b_cycles'];
		$currency = $_POST['currency'];
		$price = $_POST['price'];
        $domains_allowed = $_POST['domain_number'];
        if(isset($_FILES['image'])){
            //var_dump($_FILES['image']);
                   if ($_FILES['image']['error'] == UPLOAD_ERR_OK               //checks for errors
              && is_uploaded_file($_FILES['image']['tmp_name'])) { //checks that file is uploaded
          $profile_pic = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
             $config = array(
				'upload_path' => "./images/",
				'allowed_types' => "gif|jpg|png|jpeg|pdf",
				'max_size' => "2048000000", // Can be set to particular file size
				'max_height' => "1768",
				'max_width' => "10240"
				);
				$this->load->library('upload', $config);
				if($this->upload->do_upload('image'))
				{
					$data1 = array('upload_data' => $this->upload->data());
					$profile_pic = $data1['upload_data']['full_path'];
				}

          //$profile_pic = '';

        }else{
             $profile_pic = '';
          }
        }else{
          $profile_pic = '';
        }
	   //$shipping = $_POST['shipping'];
	   //	$tax = $_POST['tax'];
		$desc = $_POST['desc'];
		$check = $this->SubscriptionModel->check_subscription($sub_id);
		if($check == 0){
				$data = array(
						'subscription_id' => $sub_id,
						'title' => $title,
						'subtitle' => $subtitle,
						'duration' => $duration,
						'pay_type' => $pay_type,
						'sub_type' => $sub_type,
						'billing_frequency' => $b_frequency,
						'billing_cycles' => $b_cycles,
						'currency' => $currency,
						'price' => $price,
					   //'shipping' => $shipping,
					   //	'tax' => $tax,
						'image' => $profile_pic,
						'description' => $desc,
                        'domain_number' => $domains_allowed
						);
			$ins = $this->SubscriptionModel->insert_subscription($data);
			if($ins != ''){
				$this->session->set_flashdata('subscription_inserted', '<span style="float: left; width: 100%; color: #ffffff" class="alert alert-success">Your subscription is inserted.</span>');
				redirect('admin/subscription/get_subscription_list');
			}else{
				$this->session->set_flashdata('subscription_inserted', '<span style="float: left;width: 100%; color: #ffffff" class="alert alert-danger">Please try again.</span>');
				redirect('admin/subscription/add_subscription');
			}
		}else{
				$this->session->set_flashdata('subscription_inserted', '<span style="float: left;width: 100%; color: #ffffff" class="alert alert-danger">Subscription ID already exists. Please try again.</span>');
				redirect('admin/subscription/add_subscription');
		}
	}
	
	
	function my_subscriptions(){
	    
	    	$this->load->view('mysubscription');
	}
	
	
	
	function  add_addOns(){
	         $data['stripe'] = $this->SubscriptionModel->get_stripe_cred(); 
	    	$data['add_ons'] = $this->SubscriptionModel->get_all_add_ons();

		    	$this->load->view('add_ons',$data);
	    
	}
    
    function my_addons(){   


     	$this->load->view('my_addons');
    }
    
    
}
