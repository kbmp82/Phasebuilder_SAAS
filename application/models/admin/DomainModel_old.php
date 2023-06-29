<?php

class DomainModel extends CI_Model{


	public $domain_mgmt;
	
	public function __construct()
	{
		parent::__construct();
		
		$this->domain_mgmt = $this->config->item('domain_manage');
	}

	function add_domain($data){
		
		$this->db->select('domain');
		$this->db->from('domain_manage');
		$this->db->where('domain',$data['domain']);
			$query  =	$this->db->get() ; 
		
			if($query->num_rows() > 1 ){
					return null ;
			}else{
			
				$this->db->insert('domain_manage', $data);
				$insert_id = $this->db->insert_id();
				return $insert_id;
		
			}
		// print_R($insert_id) ;
	
	}
	
	function get_alldomain(){
			if($this->input->get('action')){
				
				
				$this->db->select('domain_manage.*,username,user_table.ID as user_id')->from('domain_manage')
				->join('user_table','domain_manage.assignedto	=	user_table.ID','left');
				$this->db->where('domain_manage.id',$this->input->get('id'));
				
				

		
			}
			else{
				
		$this->db->select('domain_manage.*,username,user_table.ID as user_id')->from('domain_manage')
				->join('user_table','domain_manage.assignedto	=	user_table.ID','left');
			
		}
			
			$query	=	$this->db->get()  ;
			
			$result	= $query->result_array() ;

			return $result ;		
			
	}
	
	
	  public function edit_domain($id, $action = "") {

        if ($action == "delete") {
            $this->db->where('id', $id);
         return   $this->db->delete('domain_manage');
          
        } else {
            $query = $this->db->get_where('domain_manage', array('id' => $id));
            return $query->result_array();
        }
    }
	
	 public function update_domain($data) {
			
			
        $this->db->where('id', $data['id']);
        $this->db->update('domain_manage', $data);
		redirect('admin/domain/domain_list');
    }	
	

	
}

?>
