<?php
class ReportingModel extends CI_Model{
    
    
    public function __construct(){
        
        parent::__construct() ;
        
        
    }
    
    
    
    
    function    get_allTransactions(){
		
		$this->db->select('t.id,t.transaction_id,s.title,s.subtitle,t.order_time,t.amount,,t.currency_code,t.payment_status')->from('transactions t')->join('subscriptions s','s.id = t.subscriptionid' ) ;
	
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
    
    
    function get_Transactions(){
        
      $this->db->select('t.id,t.transaction_id,s.title,s.subtitle,t.order_time,t.amount,,t.currency_code,t.payment_status')->from('transactions t')->join('subscriptions s','s.id = t.subscriptionid' )  ;
        
      if(isset($_POST['currentmonth'])){
            
            $currentmonth   =     $_POST['currentmonth'] ;
    
            $this->db->where('month(order_time)',"$currentmonth") ;
     }
     
    if(isset($_POST['fromdate'])) {   
      $fromdate  =  $_POST['fromdate'] ;
         $todate  =   $_POST['todate'] ;
        
        $this->db->where('order_time >=', $fromdate);
        $this->db->where('order_time <=', $todate);
    }   
    
    if(isset($_POST['currentweek'])){
          $this_week_sd  =  $_POST['weekstarted'] ;
         $this_week_ed  =   $_POST['weeksend'] ;
        
        $this->db->where('order_time >=', $this_week_sd);
        $this->db->where('order_time <=', $this_week_ed);
    }
    

    if(isset($_POST['lastmonth'])){
     
        $pm = (int) date('n', strtotime('-1 months'));
        $pmy = (int) date('Y', strtotime('-1 months')); 
        $this->db->where('MONTH(order_time)', $pm);
        $this->db->where('YEAR(order_time)', $pmy);
 
    }    
    
     if(isset($_POST['lastdays'])){    
     
         $this->db->where('order_time BETWEEN DATE_SUB(NOW(), INTERVAL 14 DAY) AND NOW()');
      
     }
        $thisDay =  "(DATE_SUB(NOW(), INTERVAL 1 DAY) ";
        
    if(isset($_POST['currentday'])){    
                 $curdate  =     date('Y-m-d');

        $this->db->where('DATE(`order_time`) =', $curdate );
        
    }    
        
        	$query=$this->db->get();
        
        	if($query->num_rows()>0)
		{
			return $query->result();
		}
        	else
		{
			print 'No result Found' ;
		}
        	
    }
    
    
    
    
    
    
    
    
}