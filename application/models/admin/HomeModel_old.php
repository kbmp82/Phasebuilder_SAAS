<?php
class HomeModel extends CI_Model{


    public $users_table;
	
	public function __construct()
	{
		parent::__construct();
		$this->users_table = $this->config->item('users_table');
	    
	}

	function active_users(){
    
        
	    $query1 = $this->db->where('logged_in',1);
	           
            $active = $query1->get('user_table')->num_rows();
	        
	       $query2 = $this->db->where('logged_in',0);
	           
            $inactive = $query2->get('user_table')->num_rows();  
            
            $data[] = array(
                            'Users' ,'All users status'
                            ) ;
                            
            $data[] = array(
                        'Active users',$active
                            )   ;
                            
            $data[] = array(
                        'Inactive users',$inactive
                            )   ;                
            return $data ;                
	}
	
    function active_subs(){
        
         $active = $this->db->get('user_subscription')->num_rows();
         
         $total = $this->db->get('subscriptions')->num_rows();
          
            $check    =   $active/$total * 360 ;
                  $inactive =     $total - $active ;
                $inactive  =    abs( $inactive ); 
               
                 $data[] = array(
                            'Subscriptions' ,'All subscriptions'
                            ) ;
                            
                $data[] = array(
                            'Active Subscriptions' ,$active
                            ) ;
                
                $data[] = array(
                            'Inactive Subscriptions' ,$inactive
                            ) ;
                         
                            
                return $data ;
    }

    function active_domain(){
        
   //  $total =   $this->db->get('domain_manage')->num_rows() ; 
    
       $query1 = $this->db->where('status','active');
	           
            $active = $query1->get('domain_manage')->num_rows();
                
       $query2 = $this->db->where('status','inactive');
	           
            $inactive = $query2->get('domain_manage')->num_rows();
            
         $query3 = $this->db->where('status','held');
	           
            $held = $query3->get('domain_manage')->num_rows();    
    
                 $data[] = array(
                            'Domains' ,'All domains'
                            ) ; 
                            
                 $data[] = array(
                            'Active Domains' ,$active
                            ) ;     
                            
                  
                $data[] = array(
                            'Inactive Domains' ,$inactive
                            ) ;    
                            
                 $data[] = array(
                            'Held Domains' ,$held
                            ) ;   
                            
                return $data ;            
    }  
    
    
    function open_tickets(){
        
          $query1 = $this->db->where_not_in('admin_read',1);
             $NewTickets =   $this->db->get('tickets')->num_rows() ;        
    
       $query1 = $this->db->where('admin_read',1);
             $openTickets =   $this->db->get('tickets')->num_rows() ;        
        
         $data[] = array(
                         'Domains' ,'All domains'
                           ) ;
                           
           $data[] = array(
                       'Open Tickets',$openTickets
                        ) ;
                        
             $data[] = array(
                       'Not-opened Tickets',$NewTickets
                        ) ;  
                        
            return $data ;                
    }
    
    function calculate_revenue(){
        
       $this->db->select('*');
    $this->db->from('transactions');
    
    $records     =    $this->db->get()->result_array()  ;
            
           $total_sum=0;

            foreach ($records as $row){
            
                
                    
          $data  = array() ;          
              $date      =     $row['order_time'];
                    $d_parse =  date_parse($date) ;
                    $parse_month    =  $d_parse['month'] ;
                     $dateObj   = DateTime::createFromFormat('!m', $parse_month);
                    $monthName[] = $dateObj->format('F');
                  
                  
                    $total_sum+=$row['amount'];
          
                
                
            }
          
               $data[] = array(
                            'Revenue' ,'By month'
                            ) ;     
                
              
                            
                $months   =  array_unique($monthName) ;   
                 $months = array_values($months);
                 
             
                
                foreach($months as $month){    
                   $data[]  =  array( $month ,$total_sum ) ;
                    }
             
            
         
           return $data ;
       
    }
        
        
        function c_revenue(){
           //  select month(`order_time`) as themonth , SUM(`amount`)
//from transactions group  by month(`order_time`) ;datepart(yyyy, [date]) as [year]
             
                $this->db->select_sum('amount');
                $this->db->select("month(order_time) themonth,year(order_time) theyear")->from('transactions') ;
            $this->db->group_by('year(order_time)'); 
          $this->db->group_by('month(order_time)'); 
       
         $array    =                 $this->db->get()->result_array() ;
                        
                    $data[] = array(
                            'Revenue' ,'By month'
                            ) ;   
                  
                 foreach($array as $res){
                     
                   $monthNum  = $res['themonth'] ;
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F'); // March
                    $yearDate           =    $monthName.'-'.$res['theyear']  ;
                    
                     $data[] = array($yearDate,$res['amount'] ) ;
                 }
                        
          return    $data ;


                
        }
        
}

?>
