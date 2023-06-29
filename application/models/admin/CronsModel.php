<?php

class CronsModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('p_helper');
        $this->load->library('ftp');
$this->load->library('upload');
        $this->load->model('admin/CronsModel');
        $this->load->model('user/WebsiteModel');
        $this->load->helper('url');

    }


   function delete_user_demo($domain,$cpanel_username,$db_user,$db,$server_id){
    $whm['creds'] = $this->WebsiteModel->get_whm_by_id($server_id);
 $subfolder = explode('.', $domain)[0];

   //delete subdomain
 $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=SubDomain&cpanel_jsonapi_func=delsubdomain&domain=".$domain;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
  // $result = json_decode($res, true);
                  //delete DB

                    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedb&db=".$db;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
  // $result = json_decode($res, true);

           //delete DB User

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=MysqlFE&cpanel_jsonapi_func=deletedbuser&dbuser=".$db_user;

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);
 //  $result = json_decode($res, true);
    //unlink sub folder

    $query = "https://" . $whm['creds'][0]->ip . ":2087/json-api/cpanel?cpanel_jsonapi_user=".$cpanel_username."&cpanel_jsonapi_apiversion=2&cpanel_jsonapi_module=Fileman&cpanel_jsonapi_func=fileop&op=unlink&sourcefiles=%2Fpublic_html%2Fdemo%2F".$subfolder."&doubledecode=0";

    $curl = curl_init();                                // Create Curl Object

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,0);       // Allow self-signed certs

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,0);       // Allow certs that do not match the hostname

    curl_setopt($curl, CURLOPT_HEADER,0);               // Do not include header in output

    curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);       // Return contents of transfer on curl_exec

    $header[0] = "Authorization: whm " . $whm['creds'][0]->whm_user . ":" . $whm['creds'][0]->whm_token;

    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);    // set the username and password

    curl_setopt($curl, CURLOPT_URL, $query);            // execute the query

    curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton

    $res = curl_exec($curl);

    curl_close($curl);


   $result = json_decode($res, true);
    /*  echo " <pre>";
        print_r($result);
        echo "</pre>";
   */



         $this->db->where('domain', $domain );
         $this->db->delete('domains');
         $this->db->where('domain',$domain);
         $this->db->delete('categories');
          $this->db->where('domain',$domain);
         $this->db->delete('categories_asg');

    }
}
?>