<?php

class Supportmodel extends CI_Model{
	
	public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		$this->users_table = $this->config->item('users_table');
		$this->load->helper('date');
	}
	
	function submit_ticket()
	{
	    if($this->session->userdata('role') == 'admin'){
           $_POST['admin_read'] = 1;
           $_POST['user_read'] = 0;
	    }else{
	        $_POST['user_read'] = 1;
            $_POST['admin_read'] = 0;
	    }
        $_POST['p_id'] = intval($_POST['p_id']);
	        $user_id		=	$this->session->userdata('ID')  ;
         $data 	 =   $_POST ;
        $data['ticket_date']    =      date('Y-m-d H:i:s',NOW());
        	$this->db->insert('tickets', $data);
      	    
      	  return $this->db->insert_id();
      	  /*
      	    $new_notification = array(
      	         'new_ticket' =>  $new_ticket ,
					  'new_reply' => 	'0' ,
					  'from_id' => $user_id	,
					   'to_id' => 1 ,
					   'read' => '1' ,
					   'datetime'=>now() ,
      	          ) ;
      	    
	    return   	$this->db->insert('notification', $new_notification);
        */
    
	}
	
	
	function add_ticket_reply(){
          if($this->session->userdata('role') == 'admin'){
           $_POST['admin_read'] = 1;
           $_POST['user_read'] = 0;
	    }else{
	        $_POST['user_read'] = 1;
            $_POST['admin_read'] = 0;
	    }
        $_POST['p_id'] = intval($_POST['p_id']);
        $_POST['subject'] = 'none';
	        $user_id		=	$this->session->userdata('ID')  ;
         $data 	 =   $_POST ;
        $data['ticket_date']    =      date('Y-m-d H:i:s',NOW());
        	$this->db->insert('tickets', $data);

      	  return $this->db->insert_id();
          /*
         $user_id		=	$this->session->userdata('ID')  ;
         //$new_ticket  =    $_POST['t_id']  ;
         $to_id  =    $_POST['to_id']  ;
          $data['ticket_date']    =      date('Y-m-d H:i:s',NOW());
       $this->db->insert('ticket_reply',$_POST) ;
       $new_reply_id  =   $this->db->insert_id();   
       /*
         $new_notification = array(
      	         'new_ticket' =>  $new_ticket ,
					  'new_reply' => $new_reply_id ,
					  'from_id' => $user_id	,
					   'to_id' =>$to_id ,
					   'read' => '0' ,
					   'datetime'=>now() ,
      	          ) ;
      	
	   	$this->db->insert('notification', $new_notification);
         */
        
        
         return    $this->db->insert_id();
        
    }
	
	
	
    function get_tickets(){
        
        $this->db->select('*')->from('tickets')->where(array('u_id'=>$this->session->userdata('ID'),'t_type'=>'initial'))  ;
        $this->db->order_by("t_id", "desc");
            return   $this->db->get()->result_array() ;
    }
    
     function update_ticket(){
         
          $read = array('read' => 1);  
          $this->db->where('n_id', $_POST['n_id']);
          print  $this->db->update('notification', $read); 
    }


     function  get_replyById($reply_id){
                        
      	$query = $this->db->get_where('ticket_reply', array('id' => $reply_id));
		if($query->num_rows()) return $query->row();
        
        
    }
    









}

?>
