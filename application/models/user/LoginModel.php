<?php

class LoginModel extends CI_Model{


	public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->users_table = $this->config->item('users_table');
	}

	function login($email,$pass){
				
	$pass	=	crypt($pass,'phaseb2018!~$F');
        
		$this->db->select('email','password');
		$this->db->from($this->users_table);
		$this->db->where('email',$email);
		$this->db->where('password',$pass);
		
		$query = $this->db->get();
		
		 $query->num_rows() ;
		
							    
		if($query->num_rows()==1){
			return true;
		}else{
			return false;
		}
		
	
	}
	
	function check_email($email){
		$this->db->where('email',$email);
		$query=$this->db->get($this->users_table);
		if($query->num_rows()>0)
		{ 
		    $result  =    $query->result(); 
		    
		    $userid  = $result[0]->ID ;
		    
		    $this->db->set('logged_in',1);
        	$this->db->where('id',$userid);
        	$this->db->update('user_table') ;
			return $result ;
	
		}
		else
		{
			return 0;
		}
	}
	

    function check_mysubscription($userid){
	//	$this->db->where('user_id',$userid);
//		$query=$this->db->get('user_subscription');
		
			$this->db->select('*')->from('subscriptions s')->join('user_subscription us','s.subscription_id=us.subscription_id') ;
  
	    $this->db->where("(us.user_id=$userid AND s.sub_type='main')");
	
$query =		$this->db->get() ;
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}

     function check_my_addons($userid){
         
    	$this->db->select('*')->from('subscriptions s')->join('user_subscription us','s.id=us.subscription_id') ;
  
    
    $this->db->where("(us.user_id=$userid AND s.sub_type='addon')");

    	
    return 	$this->db->get()->result() ;
    	
    		
    
   }

function    get_transaction(){
		
		$this->db->select('t.*,s.title')->from('transactions t')->join('subscriptions s','s.subscription_id = t.subscriptionid' ) ;
	//	$this->db->where('user_id',$userid);
		$query=$this->db->get();
		
		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}


function check_transaction($userid){
	   /*
		$this->db->select('t.*,s.title')->from('transactions t')->join('subscriptions s','s.id = t.subscriptionid' ) ;
		$this->db->where('user_id',$userid);
		$query=$this->db->get();

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
        */
        $this->db->select('*')->from('transactions');
		$this->db->where('user_id',$userid);
		$query=$this->db->get();

		if($query->num_rows()>0)
		{
			return $query->result();
		}
		else
		{
			return 0;
		}
	}


	function user_register($data){
	
	// echo "<pre>" ;
	// print_R($_POST) ;
	// echo "<pre>" ;
	
	
		$data=array(
			'firstname'=>$data['firstname'],
			'lastname'=>$data['lastname'],
			'username'=>$data['username'],
			'email'=>$data['email'],
			//'address'=>$data['address'],
			//'phone'=>$data['phone'],
			//'location'=>$data['location'],
			'registerdate'=>$data['registerdate'],
			'randomnum'=>$data['randomnum'],
			'password'=>crypt($data['password'],'phaseb2018!~$F'),
            'allowed_domains' => 0,
            'article_credits' => 0,
            'domain_credits' => 0,
            'first_login' => 0,

		  );
	// echo "<pre>" ;
	// print_R($data) ;
	// echo "<pre>" ;
	
	// die ;
		$this->db->insert($this->users_table, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}

function insert_transaction($data){
		$this->db->insert('transactions', $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
}

function insert_mysubscription($data){

         //var_dump($data);
        // echo $data['I-N0SW4TYRWTEE']
        $userid  = $this->session->userdata('ID') ;
	    $this->db->where('user_id',$userid );
	   	$query=$this->db->get('user_subscription');
	   	
		if($query->num_rows()>0)
		{
		    // ECHO "SUBSCRIPTION FOUND";
            $queryCheck = $this->db->get_where('user_subscription',array('payment_profile_id' => $data['payment_profile_id']));
    	if($queryCheck->num_rows()>0)
		{

		}else{
		   // ECHO "SUBSCRIPTION NOT INSERTED YET";
            $this->db->update('user_subscription', $data);
            $this->db->where('subscription_id',$data['subscription_id']);
        
            }
		}else{
         // ECHO "SUBSCRIPTION NOT FOUND";
    	$this->db->insert('user_subscription', $data);
		$insert_id = $this->db->insert_id();
	        $result = $insert_id ;
		}

             
        	return $result ;
}
	
	function user_activate($key){
		$this->db->set('confirm','1');
		$this->db->where('randomnum',$key);
		if($this->db->update($this->users_table))
		{
			return '1';
		}
	}
	
	public function get_user($user_id)
	{
		$query = $this->db->get_where($this->users_table, array('ID' => $user_id));
		if($query->num_rows()) return $query->row();
		return false;
	}
     function get_user_creds(){

            $this->db->select('affiliate_tag')->from('user_credentials');
        	$this->db->where('user_id',$this->session->userdata('ID') );
            $query = $this->db->get();
            if($query->num_rows() >0){
             if($query->row()->affiliate_tag != ''){
                 return 1;
             }else{
                 return 0;
             }
            }else{
               return 0;
            }
     }
        function logout(){
          $userid  =   $this->session->userdata('ID') ;

            $this->db->set('logged_in',0);
        	$this->db->where('id',$userid);
          
            return	$this->db->update('user_table') ;
        	
        }

}

?>
