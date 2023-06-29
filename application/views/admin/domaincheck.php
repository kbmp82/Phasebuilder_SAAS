<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view("functions.php");
$this->load->view("admin/common/header.php");
 /*
$servername = "localhost";
    $db_user = "phasebui_pbsasus";
    $db_pass = "o[;LAM[QDz1c";
    $db = "phasebui_membershipkc_new";
$con = mysqli_connect($servername,$db_user,$db_pass,$db);  
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $sql = "SELECT domain FROM domain_manage WHERE status = 'inactive'";
    if(!$result = $con->query($sql)){
    die('There was an error running the query [' . $con->error . ']');
}
if ($con->affected_rows > 0) {

 while($row = $result->fetch_assoc()){

    $cur_domain = "http://".$row['domain'];
    if (checkdomain($cur_domain)){
     $sql_update = "UPDATE domain_manage SET status ='active WHERE domain='{$row['domain']}'";
    if(!$result_update = $con->query($sql_update)){
    die('There was an error running the query [' . $con->error . ']');
}
    }


}
}
*/
$this->db->select('domain');
$this->db->from('domain_manage');
$this->db->where('status','inactive');
$query  =	$this->db->get();
if($query->num_rows() > 0 ){
foreach ($query->result_array() as $row)
{
    if (checkdomain($row['domain'])){
        $this->db->set('status', 'active',FALSE);
        $this->db->where('domain',$row['domain']);
        $this->db->update('domain_manage');
    }else{
        echo "<br> NOPE";
    }

}

 }

?>