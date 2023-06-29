<?php
 
class HomeModel extends CI_Model{





    public $users_table;



    public function __construct()

    {

        parent::__construct();

        $this->users_table = $this->config->item('users_table');
        $this->load->helper('p_helper');


    }

       function get_demos(){
          if (isset($this->session->userdata['ID'])) {
         $this->db->select('demo_expire');
        $expire = $this->db->get('build_credentials')->row()->demo_expire;

        $data[] = array(
                                'expire' => $expire
                                ) ;



                     return $data ;
                      } else {
   header("location: login");
}
       }
       function total_domains(){
       if (isset($this->session->userdata['ID'])) {

       $query1 = $this->db->where('user_id',$this->session->userdata('ID'));
       $total = $query1->get('domains')->num_rows();
       $this->db->select('allowed_domains');
       $this->db->where('ID',$this->session->userdata('ID'));
       $allowed = $this->db->get('user_table')->row()->allowed_domains;
               $data[] = array(
                                'total' => $total ,
                                 'allowed' =>  $allowed
                                ) ;



                     return $data ;
                     } else {
   header("location: login");
}

    }
     function check_keys(){
       if (isset($this->session->userdata['ID'])) {

       $this->db->where('user_id',$this->session->userdata('ID'));
       $this->db->select('access_key');
       $query = $this->db->get('user_credentials');
       if($query->num_rows() > 0){
          $row = $query->row();

       $user_key = $row->access_key;
       $this->db->select('*');
       $admin_key = $this->db->get('build_credentials')->row()->access_key;
       if($user_key == $admin_key){
           return 1;
       }else{
           return 0;
       }
        }else{
            return 0;
        }
                     } else {
   header("location: login");
}
     }


      function tickets(){
           if (isset($this->session->userdata['ID'])) {
     //     $query1 = $this->db->where_not_in('admin_read',1);

             $NewTickets =   $this->db->get('tickets')->num_rows() ;



       $this->db->where('u_id',$this->session->userdata('ID'));
       $totalTickets =   $this->db->get('tickets')->num_rows() ;
       $this->db->where('u_id',$this->session->userdata('ID'));
       $this->db->where('status','open');
       $openTickets =   $this->db->get('tickets')->num_rows() ;

           $data[] = array(

                       'open' => $openTickets ,

                        'total' => $totalTickets

                        ) ;

            return $data ;
         } else {
   header("location: login");
}
    }


   function iw_info(){
         if (isset($this->session->userdata['ID'])) {
     $this->db->where('user_id',$this->session->userdata('ID'));
       $totalArticles =   $this->db->get('articles')->num_rows();
       $this->db->where('user_id',$this->session->userdata('ID'));
       $this->db->where('status','processing');
       $processingArticles =   $this->db->get('articles')->num_rows();
       $this->db->where('user_id',$this->session->userdata('ID'));
       $this->db->where('status','queued');
       $queuedArticles =   $this->db->get('articles')->num_rows();
       $this->db->where('user_id',$this->session->userdata('ID'));
       $this->db->where('status','waiting review');
       $waitingReviewArticles =   $this->db->get('articles')->num_rows();
   $articles['article_stats'] = array(
                'total' => $totalArticles,
                'processing' => $processingArticles,
                'queued' => $queuedArticles,
                'review' => $waitingReviewArticles,
            );

        return $articles;
        } else {
   header("location: login");
}
        }





}



?>

