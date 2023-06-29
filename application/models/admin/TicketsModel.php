<?php



class TicketsModel extends CI_Model{

    

    public function __construct()

    {

        parent::__construct() ;

        

        

        $this->tickets = $this->config->item('tickets') ;

        

    }

    

    

    function get_tickets(){

     
          $this->db->select('*')->from('tickets t')->where('t.t_type','initial')->join('user_table u','u.id=t.u_id') ;
       // $this->db->select('*')->from('tickets t')->join('user_table u','u.id=t.u_id') ;

          $this->db->order_by("t_id", "desc");

        return $this->db->get()->result_array() ;

     

    }

    
    function get_UserByID($id){
        $this->db->select('*')->from('user_table')->where('ID',$id);
       return  $this->db->get()->row()->username;
    }
    function get_notification(){

         $this->db->select('*')->from('user_table')->where('ID',$this->session->userdata['ID']);
        $role =$this->db->get()->row()->role;
        if($role == "admin"){
               $this->db->select('*')->from('tickets')->where('admin_read',0);
        }else{
             $this->db->select('*')->from('tickets')->where(array('user_read'=> 0,'to_id'=>$this->session->userdata['ID']));

        }
          $this->db->order_by("t_id", "desc");

         //$this->db->select('*')->from('tickets n')->where('from_id',$this->session->userdata['ID'])

                   // ->join('tickets t','n.new_ticket=t.t_id') ;

                   //  $this->db->order_by("t_id", "desc");

        $result    =   $this->db->get()->result_array() ;



            return $result ;

    }

    

    

    function update_ticket(){

        

          $_POST['t_id'] ; 

      

         

            $read = array('admin_read' => 1); 

         $this->db->where('t_id', $_POST['t_id']);

    $read =     $this->db->update('tickets', $read); 

                 

          if($read){

              

                $read = array('read' => 1); 

          $this->db->where('n_id', $_POST['n_id']);

     $ntfy =     $this->db->update('notification', $read); 

         print 1 ;

          }

          

          return false ;

          

    }

    

    function get_ticketByid(){

     $ticket_id = $this->input->get('id');

  

          

      //  $this->db->select('t.t_id,t.ticket_date,t.subject,t.detail,t.u_id,u.username,');

     

       // $this->db->select('*') ;
        //  $this->db->from('tickets');
        //   $this->db->where('t_id',$ticket_id) ;

        $this->db->from('tickets t');

        $this->db->join('user_table u','u.ID = t.u_id') ;

        $this->db->where('t_id',$ticket_id) ;





        $query = $this->db->get();
         $this->mark_tickets($ticket_id);
     return   $query->row() ;



                    

    }

    

    function mark_tickets($ticket_id){
        $this->db->select('*')->from('user_table')->where('ID',$this->session->userdata['ID']);
        $role =$this->db->get()->row()->role;
        if($role == "admin"){
              $this->db->set('admin_read',1);
        }else{
             $this->db->set('user_read',1);
        }

        $this->db->where('t_id',$ticket_id);
        $this->db->or_where('p_id',$ticket_id);
         $this->db->update('tickets');
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

         $new_ticket  =    $_POST['t_id']  ;

         $to_id  =    $_POST['to_id']  ;

         

       $this->db->insert('ticket_reply',$_POST) ;

       $new_reply  =   $this->db->insert_id();   

       

      

         $new_notification = array(

      	         'new_ticket' =>  $new_ticket ,

					  'new_reply' => $new_reply ,

					  'from_id' => $user_id	,

					   'to_id' =>$to_id ,

					   'read' => '1' ,

					   'datetime'=>now() ,

      	          ) ;

      	

	   	$this->db->insert('notification', $new_notification);

     

        
         */
        

         return    $this->db->insert_id();

        

    }

    

  

    

    function get_ticket_reply(){

        $ticket_id = $this->input->get('id');
          $this->db->select('*') ;
          $this->db->from('tickets');
           $this->db->where('p_id',$ticket_id) ;
           $this->db->order_by("t_id", "asc");
        /*

         $this->db->select('tr.from_id as user_id,tr.*,n.*')->from('ticket_reply tr') ;

    $this->db->join('notification n','tr.id = n.new_reply','left') ;

         

         $this->db->where('t_id',$ticket_id) ;

          $this->db->order_by("id", "asc");  */

        return $this->db->get()->result_array() ;

    }

   

    

    function get_new_ntfy(){

        $this->db->select('*')->from('notification n')

                    ->join('tickets t','n.new_ticket=t.t_id') ;

                    

                     $this->db->order_by("t_id", "desc");

        $result    =   $this->db->get()->result_array() ;



            return $result ;

        

        

    }

    

    

   function  get_replyById($reply_id){

                        

      	$query = $this->db->get_where('ticket_reply', array('id' => $reply_id));

		if($query->num_rows()) return $query->row();

        

        

    }

    

    

    function UpdateStatus(){

        


         if($_POST['status'] == 'closed'){
             $close_time = strtotime('now');
         }else{
            $close_time = 0;
         }
         $status = array('status' => $_POST['status'],'close_date'=>$close_time);
         $this->db->where('t_id', $_POST['t_id']);
         $this->db->or_where('p_id', $_POST['t_id']);
          $status =     $this->db->update('tickets', $status); 

         

                if($status){

                    print   $_POST['status'] ;

                }

    }

   function get_unread($ticket,$id){

     if($id === 0){
          $this->db->select('*')->from('tickets');
        $this->db->where('t_id',$ticket);
        $this->db->where('admin_read',0);
        $query = $this->db->get();
         if($query->num_rows() > 0){
          return 1;
      }else{
          $this->db->select('*')->from('tickets');
        $this->db->where('p_id',$ticket);
        $this->db->where('admin_read',0);
        $query = $this->db->get();
         if($query->num_rows() > 0){
             return 1;
         }else{
             return 0;
         }
      }
     }else{
       $this->db->select('*')->from('tickets');
        $this->db->where('t_id',$ticket);
        $this->db->where('user_read',0);
        $query = $this->db->get();
         if($query->num_rows() > 0){
          return 1;
      }else{
          $this->db->select('*')->from('tickets');
        $this->db->where('p_id',$ticket);
        $this->db->where('user_read',0);
        $query = $this->db->get();
         if($query->num_rows() > 0){
             return 1;
         }else{
             return 0;
         }
      }
     }





   }

    function deleteTicket($ticketID = ''){

             if($ticketID == ''){

             $ticketID = $_POST['t_id']   ;
             }
                $this->db->where('t_id', $ticketID);
                $this->db->or_where('p_id', $ticketID);
               $result = $this->db->delete('tickets');

            

            if($result){

                
             /*
               $this->db->where('new_ticket', $ticketID);

               $result = $this->db->delete('notification');

                

                $this->db->where('t_id', $ticketID);

               $result = $this->db->delete('ticket_reply');     

                */

                   return true ;   

            }else{

                return false ;

            }

                

    }

    

    

}