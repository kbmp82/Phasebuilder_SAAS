<?php
  //get_subscribed_subscription
class SubscriptionModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();

        	$this->load->helper('url');
        $this->config->load('paypal');
        $this->load->helper('p_helper');
        
    }
    
    function get_UserDiscount(){
        $this->db->select('*');
        $this->db->where('ID',$this->session->userdata('ID'));
      $query = $this->db->get('user_table');
            $query->row() ;
            if($query->num_rows()>0)
 {
  $row = $query->row();
    return $row->discount/100;
  }

    }
    function get_stripe_cred(){
            
          $query =     $this->db->get('stripe_settings') ;
        return     $query->row() ;
            
    }
    public function get_user_name($user_id)
	{
		$query = $this->db->get_where('user_table', array('ID' => $user_id));
		if($query->num_rows()) return $query->row();
		return false;
	}
    function save_stripe($subArray,$tranArray){
            
      
    $in_sub =   $this->db->insert('user_subscription',$subArray);
     
           $insert_id = $this->db->insert_id();
     
     $in_tran =   $this->db->insert('transactions',$tranArray);
     
       $insert_id2 = $this->db->insert_id();

     return $insert_id ;
                
    }
    
    
    public function get_paypal_credentials(){
          //get paypal settings from db
         $query=$this->db->get('payment_settings');
 if($query->num_rows()>0)
 {
  $row = $query->row();
 if($row->sandbox == "sandbox"){
     $sandbox = TRUE;
 }else{
    $sandbox = FALSE;
 }
 $APIUsername_live = $row->paypal_user_live;
  $APIUsername_sand = $row->paypal_user_sand;
   $APIPassword_live = $row->paypal_pass_live;
    $APIPassword_sand = $row->paypal_pass_sand;
     $APISignature_live = $row->paypal_sig_live;
      $APISignature_sand = $row->paypal_sig_sand;

 }
		$config = array(
			'Sandbox' => $sandbox,//$this->config->item('Sandbox'),            // Sandbox / testing mode option.
			'APIUsername' => $sandbox ? $APIUsername_sand : $APIUsername_live, //$this->config->item('APIUsername'),    // PayPal API username of the API caller
			'APIPassword' => $sandbox ? $APIPassword_sand : $APIPassword_live,//$this->config->item('APIPassword'),    // PayPal API password of the API caller
			'APISignature' => $sandbox ? $APISignature_sand : $APISignature_live,//$this->config->item('APISignature'),    // PayPal API signature of the API caller
			'APISubject' => '',                                    // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion'),        // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			'DeviceID' => $this->config->item('DeviceID'),
			'ApplicationID' => $this->config->item('ApplicationID'),
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);

		if ($config['Sandbox']) {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}
        return $config;
    }
      public function get_sub_status(){

        if($this->session->userdata('ID') != ''){

             $this->db->where('user_id',$this->session->userdata('ID'));
         $query=$this->db->get('user_subscription');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will only have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
  $gateway = $row->gateway;
  $next_bill_date =  $row->next_bill_date;
 // ECHO "next_bill_date IS: ".$next_bill_date;
  $amt_billed = $row->amt_billed;
  $amount = $row->amount;
  $status = $row->status;
  $end_date = $row->end_date;
  if($gateway == "trial"){
       $today_time = strtotime(date("Y-m-d\TH:i:s\Z"));
$expire_time = strtotime($row->end_date);

                      if ($today_time > $expire_time) {
     //if(date("Y-m-d\TH:i:s\Z") > $end_date) {
       $data = array(
                            'next_bill_date' => 0,
                            'profile_status' => 'none',
                            'account_status' => 'Demo'
                            );
                     $this->session->set_userdata($data);
     }else{
          $data = array(
                            'account_status' => 'Good',
                            );
                           $this->session->set_userdata($data);
     }
  }elseif($gateway == "paypal"){
      //check paypal
  //check if next bill date has passed and if so, check subscription status on paypal
//  if(date("Y-m-d\TH:i:s\Z") >= $next_bill_date){

      //get profile status from PayPal
   $GRPPDFields = array(
            'PROFILEID' => $row->payment_profile_id
        );
   $PayPalRequestData = array(
                        'GRPPDFields' => $GRPPDFields,
   );
     $recurringProfileDetails=$this->paypal_pro->GetRecurringPaymentsProfileDetails($PayPalRequestData);
  /*
   echo "<pre>";
        print_r($recurringProfileDetails);
        echo "</pre>";
  */

        if($recurringProfileDetails['ACK'] == 'Success')
            {

                //save status repsonse to vars
                $profile_status = $recurringProfileDetails['STATUS'];
                $nextBillingDate = (isset($recurringProfileDetails['NEXTBILLINGDATE'])) ? $recurringProfileDetails['NEXTBILLINGDATE'] : $next_bill_date;
                //$lastPaymentDate = $recurringProfileDetails['LASTPAYMENTDATE'];
                $totalBilled = $recurringProfileDetails['AGGREGATEAMT'];
                 $today_time = strtotime(date("Y-m-d\TH:i:s\Z"));
$expire_time = strtotime($nextBillingDate);
                 if($profile_status == "Active" || $profile_status == "Pending"){


                      if ($today_time >= $expire_time && $totalBilled > $amt_billed) {
                    //  if(date("Y-m-d\TH:i:s\Z") >= $next_bill_date && $totalBilled > $amt_billed){

                         $this->renewCredits();
                         $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'amt_billed' => $totalBilled,
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);


                     }
                     $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => $profile_status,
                            'account_status' => 'Good',
                            'payment_profile_id' => $row->payment_profile_id
                            );
                           $this->session->set_userdata($data);
                                               $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $status_acct = $this->db->get()->row()->suspended;
   if($status_acct == 1){
 $this->SubscriptionModel->unsuspendAccount($this->session->userdata('ID'));
     $data = array(
                            'status' => 'taken'
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('domains', $data);
   }

                 //}else if($profile_status == "Cancelled" && date("Y-m-d\TH:i:s\Z") < $next_bill_date ){
                 }else if($profile_status == "Cancelled" && $today_time < $expire_time ){
                       $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => $profile_status,
                            'account_status' => 'Cancelled'
                            );
                            $this->session->set_userdata($data);
                             $data = array(
                            'status' => 'cancelled',
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);


                 }else{
                     $this->db->select('never_suspend');
                     $this->db->from('user_table');
   $this->db->where('ID',$this->session->userdata('ID'));
   $never = $this->db->get()->row()->never_suspend;

                     $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $query = $this->db->get();
   $row = $query->row();

        if (isset($row)) {
        $status_acct = $row->suspended;

           if($status_acct == 0 && $never == 0){

    $this->suspendAccount($this->session->userdata('ID'),'No subscription found');
     $data = array(
                            'status' => 'suspended'
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('domains', $data);
   }
        }

                    $suspended_end_date = $this->db->get_where('user_subscription', array('ID' => $this->session->userdata('ID')))->row()->suspended_end_date;
                     $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => $profile_status,
                            'account_status' => 'Suspended',
                            'suspended_end_date' => $suspended_end_date
                            );
                     $this->session->set_userdata($data);
                     $data = array(
                            'status' => 'cancelled',
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);

                 }


            }else{
                $data = array(
                            'next_bill_date' => $next_bill_date,
                            'profile_status' => 'Cancelled',
                            'account_status' => 'Cancelled'
                            );
                            $this->session->set_userdata($data);
                             $data = array(
                            'status' => 'cancelled',
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);

            }

 // }


  }else{
      //check stripe
       $cred =  $this->get_stripe_cred() ;
	            if($cred->mode == 'sandbox'){

	                $apiKey  =  $cred->secret_key_sandbox  ;
	            }
	            else{
	               $apiKey  =  $cred->secret_key_live ;
	            }
      $cust_id = $row->stripe_cust_id;
      $plan_id = $row->payment_profile_id;
     $curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_RETURNTRANSFER => 1,
					  CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/".$plan_id,
                      //CURLOPT_URL => "https://api.stripe.com/v1/charges?limit=1&customer=".$cust_id,
                      CURLOPT_POST => 0,
						CURLOPT_HTTPHEADER => array(
							"Authorization: Bearer " . $apiKey
						),

					));

					$resp = curl_exec($curl);
					curl_close($curl);

						$result = json_decode($resp) ;

                     // var_dump($result);
                        $nextBillingDate = date("Y-m-d\TH:i:s\Z", $result->current_period_end);
                        $today_time = strtotime(date("Y-m-d\TH:i:s\Z"));
                        $expire_time = strtotime($nextBillingDate);
                       if($result->status == "active"){
                        //  echo "SUBSCRITPION IS ACTIVE";

                           //get last charge
                            $curl = curl_init();
						curl_setopt_array($curl, array(
						CURLOPT_RETURNTRANSFER => 1,
                       CURLOPT_URL => "https://api.stripe.com/v1/charges?limit=1&customer=".$cust_id,
                      CURLOPT_POST => 0,
						CURLOPT_HTTPHEADER => array(
							"Authorization: Bearer " . $apiKey
						),

					));

					$resp = curl_exec($curl);

					curl_close($curl);
                    	$result = json_decode($resp,TRUE) ;

                          // if(date("Y-m-d\TH:i:s\Z") >= $nextBillingDate && date("Y-m-d\TH:i:s\Z",$result['data'][0]['created']) >= $nextBillingDate){
                               if($today_time >= $expire_time && strtotime(date("Y-m-d\TH:i:s\Z",$result['data'][0]['created'])) >= $expire_time){
                         //   ECHO "<BR><BR>".date("Y-m-d\TH:i:s\Z").". IS >= ".$next_bill_date." && ".date("Y-m-d\TH:i:s\Z",$result['data'][0]['created'])." >= ".$next_bill_date;
                         $this->renewCredits();
                         $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'amt_billed' => $amt_billed+$amount,
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);


                     }
                     $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => 'active',
                            'account_status' => 'Good',
                            'payment_profile_id' => $plan_id
                            );
                           $this->session->set_userdata($data);
                         //  echo "just set userdata for stripe: ".$this->session->userdata('account_status');
                                               $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $status_acct = $this->db->get()->row()->suspended;
   if($status_acct == 1){
 $this->SubscriptionModel->unsuspendAccount($this->session->userdata('ID'));
     $data = array(
                            'status' => 'taken'
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('domains', $data);
   }

                         //}elseif($result->status == "canceled" && time() < $result->current_period_end){

                        }elseif($result->status == "canceled" && $today_time < $expire_time){
                         //   echo "CANCELED EOB NOT MET";
                            //$nextBillingDate = date("Y-m-d\TH:i:s\Z", $result->current_period_end);
                       $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => 'Cancelled',
                            'account_status' => 'Cancelled'
                            );
                            $this->session->set_userdata($data);
                             $data = array(
                            'status' => 'cancelled',
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);
                          //  ECHO "<BR><BR>ACCOUNT STATUS IS: ".$this->session->userdata('account_status');

                 }else{
                     $this->db->select('never_suspend');
                     $this->db->from('user_table');
   $this->db->where('ID',$this->session->userdata('ID'));
   $never = $this->db->get()->row()->never_suspend;
                     $this->db->select('suspended');
                     $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $query = $this->db->get();
   $row = $query->row();

        if (isset($row)) {
        $status_acct = $row->suspended;
           if($status_acct == 0 && $never == 0){

    $this->suspendAccount($this->session->userdata('ID'),'No subscription found');
     $data = array(
                            'status' => 'suspended'
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('domains', $data);
   }
        }

                     $suspended_end_date = $this->db->get_where('user_subscription', array('ID' => $this->session->userdata('ID')))->row()->suspended_end_date;
                     $data = array(
                            'next_bill_date' => $nextBillingDate,
                            'profile_status' => 'Suspended',
                            'account_status' => 'Suspended',
                            'suspended_end_date' => $suspended_end_date
                            );
                     $this->session->set_userdata($data);
                     $data = array(
                            'status' => 'cancelled',
                            );
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);

                 }

  }
  }else{
     $data = array(
                            'next_bill_date' => 0,
                            'profile_status' => 'none',
                            'account_status' => 'Demo'
                            );
                     $this->session->set_userdata($data);
                     $data = array(
                            'allowed_domains' => 0,
                            'article_credits' => 0,
                            );
     $this->db->where('ID',$this->session->userdata('ID'));
     $this->db->update('user_table', $data);
  }

  
        }else{
            $this->load->helper('url');
            redirect('login');
        }


  //   echo "done with get status, account status is: ".$this->session->userdata('account_status');

    }
    public function cancel_subscription_stripe(){
        if($this->session->userdata('ID') != ''){
             $this->db->where('user_id',$this->session->userdata('ID'));
             $this->db->where('gateway','stripe');
         $profile_id=$this->db->get('user_subscription')->row()->payment_profile_id;
         }
         $cred =  $this->get_stripe_cred() ;
	            if($cred->mode == 'sandbox'){

	                $apiKey  =  $cred->secret_key_sandbox  ;
	            }
	            else{
	               $apiKey  =  $cred->secret_key_live ;
	            }

      	$curl = curl_init();
							curl_setopt_array($curl, array(
								CURLOPT_RETURNTRANSFER => 1,
								CURLOPT_URL => "https://api.stripe.com/v1/subscriptions/".$profile_id,
								CURLOPT_POST => 1,
                                CURLOPT_CUSTOMREQUEST => "DELETE",
								CURLOPT_HTTPHEADER => array(
									"Authorization: Bearer " . $apiKey
								),
							   //	CURLOPT_POSTFIELDS => http_build_query(array("at_period_end"=>"true" ))
							));

						$resp = curl_exec($curl);
						curl_close($curl);
						$result = json_decode($resp) ;

                        if($result->status == "canceled"){
                            $data = array(
							'status' => 'cancelled',

							);
                             $this->db->where('user_id',$this->session->userdata('ID'));
             $this->db->where('gateway','stripe');
              $this->db->where('payment_profile_id',$profile_id);

                            $this->db->update('user_subscription', $data);
                        }
                         //return $result;
    }
    public function cancel_subscription(){
           if($this->session->userdata('ID') != ''){
             $this->db->where('user_id',$this->session->userdata('ID'));
             $this->db->where('gateway','paypal');
             $this->db->where('status','active');
         $query=$this->db->get('user_subscription');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will nly have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
          $MRPPSFields = array(
			'PROFILEID' => $row->payment_profile_id,
            'ACTION' => 'Cancel'
		);
   $PayPalRequestData = array(
						'MRPPSFields' => $MRPPSFields,
   );
     $recurringProfileDetails=$this->paypal_pro->ManageRecurringPaymentsProfileStatus($PayPalRequestData);
   /*
   echo "<pre>";
		print_r($recurringProfileDetails);
		echo "</pre>";
   */

        if($recurringProfileDetails['ACK'] == 'Success')
			{

                         $data = array(
							'status' => 'cancelled',

							);
                            $this->db->where('user_id', $this->session->userdata('ID'));
                            $this->db->update('user_subscription', $data);
                     }




            }
           // return $recurringProfileDetails;
            }

        }


    //new billing cycle renew users article and domain credits
    public function renewCredits(){

         if($this->session->userdata('ID') != ''){
          $this->db->where('user_id',$this->session->userdata('ID'));
         $query=$this->db->get('user_subscription');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will only have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
  $gateway = $row->gateway;
  if($gateway != "trial"){


          $this->db->where('ID',$this->session->userdata('ID'));
         $query=$this->db->get('user_table');
         if($query->num_rows()>0)
 {
     //currently set up to grab a single row as we think each user will nly have 1 subscription. If more are added will need to change the code to look for each subscription
  $row = $query->row();
  $allowedDomains =  $row->allowed_domains;
  $articleCredits = $row->article_credits;
  }
   $this->db->select('subscription_id');
   $this->db->from('user_subscription');
   $this->db->where('user_id',$this->session->userdata('ID'));
   $sub_id = $this->db->get()->row()->subscription_id;
   $this->db->select('domain_number');
   $this->db->from('subscriptions');
   $this->db->where('subscription_id',$sub_id);
   $domain_number = $this->db->get()->row()->domain_number;
         $data = array(
                            'allowed_domains' => $allowedDomains + $domain_number,
                            'article_credits' => $domain_number + $articleCredits,
                            );
     $this->db->where('ID',$this->session->userdata('ID'));
     $this->db->update('user_table', $data);
       }
  }
     }else{
       	$this->load->helper('url');
            redirect('login');
     }
    }

     public function unsuspendAccount($user_id){
         $this->db->select('cpanel_user');
   $this->db->from('domains');
   $this->db->where('user_id',$user_id);
   $username = $this->db->get()->row()->cpanel_user;
      $whmusername = $this->config->item('whm_user');

        $token = $this->config->item('whm_token');

        $ip = $this->config->item('whm_ip');

         $query_whm = "https://" . $ip . ":2087/json-api/unsuspendacct?api.version=1&user=".$username;
                $header[0] = "Authorization: whm " . $whmusername . ":" . $token;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);
                curl_close($curl);
   /*
   echo "<pre>";
        print_r($result);
        echo "</pre>";
         */
                if ($result == false) {

                    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                    // log error if curl exec fails

                }else{
                     if (strpos($result, "account is now active") > 0) {
                         $data = array(
                            'suspended' => 0,
                             'suspended_end_date' => 'none',
                            );
                            $this->db->where('user_id', $user_id);
                            $this->db->update('user_subscription', $data);
                            $data = array(
                            'status' => 'taken'
                            );
                            $this->db->where('user_id', $user_id);
                            $this->db->update('domains', $data);
                        return TRUE;
                      }else{
                         return FALSE;
                      }
                }



    }
   public function suspendAccount($user_id,$reason){
        $this->db->select('cpanel_user');
   $this->db->from('domains');
   $this->db->where('user_id',$user_id);
   $username = $this->db->get()->row()->cpanel_user;
   $delete_accounts = $this->db->get('build_credentials')->row()->delete_accounts;
      $whmusername = $this->config->item('whm_user');

        $token = $this->config->item('whm_token');

        $ip = $this->config->item('whm_ip');

         $query_whm = "https://" . $ip . ":2087/json-api/suspendacct?api.version=1&user=" . $username . "&reason=" . $reason ."&disallowun=1";
        // echo $query_whm;

                $header[0] = "Authorization: whm " . $whmusername . ":" . $token;

                $curl = curl_init(); // Create Curl Object

                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // set the username and password

                curl_setopt($curl, CURLOPT_URL, $query_whm); // execute the query

                curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                $result = curl_exec($curl);
                curl_close($curl);
          /*
          echo "<pre>";
        print_r($result);
        echo "</pre>";
        */
                if ($result == false) {

                    error_log("curl_exec threw error \"" . curl_error($curl) . "\" for $query");

                    // log error if curl exec fails

                }else{
                     if (strpos($result, "account has been suspended") > 0) {
                          $data = array(
                            'suspended' => 1,
                            'suspended_end_date' => date("Y-m-d\TH:i:s\Z",strtotime('+'.$delete_accounts.' days')),
                            );
                            $this->db->where('user_id', $user_id);
                            $this->db->update('user_subscription', $data);
                            $data = array(
                            'status' => 'suspended'
                            );
                            $this->db->where('user_id', $user_id);
                            $this->db->update('domains', $data);
                        return TRUE;
                      }else{
                         return FALSE;
                      }
                }



    }
    public function get_all_subscriptions(){
        $this->db->where('sub_type','main') ;
        $query=$this->db->get('subscriptions');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }


    public function get_all_add_ons(){
          $this->db->where('sub_type','addon');
        $query=$this->db->get('subscriptions');

        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }


    public function get_all_subscriptions_addons(){
        $this->db->where('sub_type','addon');
        $query=$this->db->get('subscriptions');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
    }

    public function insert_subscription($data){
        $this->db->insert('subscriptions', $data);
        return $insert_id = $this->db->insert_id();
    }

    public function check_subscription($sub_id){
        $this->db->where('subscription_id',$sub_id);
        $query=$this->db->get('subscriptions');
        if($query->num_rows()>0)
        {
            return $query->result();
        }
        else
        {
            return 0;
        }
    }


    public function get_subname_by_id($sub_id){

        $this->db->select('title');
        $this->db->from('subscriptions');
        $this->db->where('id',$sub_id);

         $this->db->get()->row()->title;


    }



    public function edit_subscription($id, $action = "") {

        if ($action == "delete") {
            $this->db->where('id', $id);
            $this->db->delete('subscriptions');
           redirect('admin/subscription/get_subscription_list');
        } else {
            $query = $this->db->get_where('subscriptions', array('id' => $id));
            return $query->result_array();
        }
    }


   public function update_subscription($data) {

        $this->db->where('subscription_id', $data['subscription_id']);
        $this->db->update('subscriptions', $data);
        redirect('admin/subscription/get_subscription_list');
    }


    public function get_SubscriptionByUser(){

        $userid  = $this->session->userdata('ID') ;
       $this->db->select('subscription_id')->from('user_subscription');
       $this->db->where("user_id",$userid);
       $this->db->where("(status='active' OR status='cancelled')");
       //$this->db->where("subscription_id !=",0);
         $query = $this->db->get();
         if($query->num_rows() > 0){
               $row = $query->row();
            $sub_id = $row->subscription_id;
            if($sub_id != 0){
           $this->db->select('title')->from('subscriptions');
        $this->db->where('subscription_id',$sub_id);
        return $this->db->get()->row()->title;
        }else{
           return "Full Access Trial Subscription";
        }

         }else{
              return $query->result_array() ;
         }


    	}
        public function get_AllSubscriptionByUser(){

        $userid  = $this->session->userdata('ID') ;

       $this->db->select('*')->from('user_subscription us')->join('subscriptions s','us.subscription_id = s.id') ;

       $this->db->where('us.user_id', $userid);
         $this->db->where('us.status','active' );


            $query = $this->db->get();

    return         $query->result_array() ;

    	}

    public function get_subscribed_subscription(){

         $this->db->where('user_id',$this->session->userdata('ID')) ;
         $this->db->where('status','active' );
        $query=$this->db->get('user_subscription');
         	if($query->num_rows() > 0){
               $row = $query->row();
               $sub_id = $row->subscription_id;
         	}else{
         	    $sub_id ='';
         	}
            return $sub_id ;

    }
  
  function get_active_payment(){
            $status = '';
		$query = $this->db->get_where('payment_settings',array('status'=>1));

			if($query->num_rows() > 0){
			   $status = 'paypal' ;
			}

		$query2 = $this->db->get_where('stripe_settings',array('status'=>1));

			if($query2->num_rows() > 0 && $status != ''){
			    $status = 'both' ;
			}else if($query2->num_rows() > 0){
               $status = 'stripe';
			}

			return 	$status ;

	}

}
?>