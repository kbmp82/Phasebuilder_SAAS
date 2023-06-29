<?php

class ArticleModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('p_helper');

    }

    public function get_current_articles(){

    $this->db->select('*')->from('articles') ;

        $this->db->where('user_id',$this->session->userdata('ID')) ;


        $query	=	$this->db->get()  ;

            $result	= $query->result_array() ;

            return $result ;

    }
public function get_current_domains(){
    	$this->db->select('*')->from('domains') ;

        $this->db->where('user_id',$this->session->userdata('ID')) ;
        $this->db->not_like('domain', 'demo-');
                	$query	=	$this->db->get()  ;

            $result	= $query->result_array() ;
                        	return $result ;
}
public function get_article_cost(){
    	$this->db->select('price_basic,price_premium,price_elite')->from('build_credentials') ;
                	$query	=	$this->db->get()  ;

            $result	= $query->result_array() ;
                            return $result ;
}
public function get_article_credits(){
       $this->db->select('*')->from('user_table') ;

        $this->db->where('ID',$this->session->userdata('ID')) ;
                	$query	=	$this->db->get()  ;

             $result	= $query->result_array() ;
                            return $result ;
}
public function get_domain($domain_id){
    	$this->db->select('domain')->from('domains') ;

        $this->db->where('id',$domain_id) ;
                	$query	=	$this->db->get()  ;
                   $result	= $query->result_array() ;
                            return $result ;
}
public function get_review_article($id){
 $this->db->select('*')->from('articles');
     $this->db->where('id',$id) ;
    $query	=$this->db->get()  ;
        $result	= $query->result_array() ;
                            return $result ;

}
public function get_review_article_iw($id){
     $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }
    $this->db->select('*')->from('articles');
     $this->db->where('id',$id) ;
    $query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
             $project_id = $row->project_id;
            $article_id = $row->article_id;
//get review data
    $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
   <func_name>review_article</func_name>
   <proj_id>'.$project_id.'</proj_id>
   <article_id>'.$article_id.'</article_id>
</request>';
$response = call_iwriter($xml);
   if($response->status == "ok"){
     $a_array = array(

                    'title' => $response->title,
                    'review_url' => $response->review_url, //need to order an article and see what is returned for this value

                );
                return $a_array;
   }
   }
}
public function get_projects(){
       $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }

    //get project data
    $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
  <func_name>get_project_status</func_name>
   <proj_id>1493466</proj_id>
</request>';
 $response = call_iwriter($xml);
  return $response;

 }
 public function approve_article($project_id,$article_id){
      $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }
   /* $this->db->select('*')->from('articles');
     $this->db->where('id',$id) ;
    $query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            //var_dump($row);
            $project_id = $row->project_id;
            $article_id = $row->article_id;
            */
             //get project data
    $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
  <func_name>review_article</func_name>
   <proj_id>'.$project_id.'</proj_id>
   <article_id>'.$article_id.'</article_id>
   <operation>approve</operation>
   <rate>5</rate>
   <comment>Good job thank you!</comment>
</request>';
  $response = call_iwriter($xml);
  //var_dump($response);
  return $response;
     /*   }else{
            return 0;
        }
        */



 }
 public function archive_article($project_id){
      $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }
 $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
  <func_name>archive_project</func_name>
   <proj_id>'.$project_id.'</proj_id>
</request>';
  $response = call_iwriter($xml);
 }
 public function download_article($project_id,$article_id,$userID){
     $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }
   /* $this->db->select('*')->from('articles');
     $this->db->where('id',$id) ;
    $query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $project_id = $row->project_id;
            $article_id = $row->article_id;
            */
             //get project data
    $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
  <func_name>download_articles</func_name>
   <proj_id>'.$project_id.'</proj_id>
   <article_id>'.$article_id.'</article_id>
</request>';
  $response = call_iwriter($xml);
  //echo '<br><br>BODY&nbsp;IS: '.$response->body;
  $data = array(
        'article_body' => $response->body,
        'delivery_date' => date("Y-m-d")
);

$this->db->where('project_id', $project_id);
$this->db->where('user_id', $userID);
$this->db->update('articles', $data);
if($this->db->affected_rows() > 0){
  return 1;
        }else{
    echo  $this->db->last_query();
        return 0;
        }



 }

public function order_article($user_id,$article_domain,$article_type,$article_title,$article_ins,$article_keyword,$article_credits,$article_cost,$asin){
     $this->db->select('*')->from('articles');
      $this->db->where('user_id', $this->session->userdata('ID'));
       $this->db->where('domain_mgmt_id', $article_domain);
        $this->db->where('type', $article_type);
        $this->db->where('article_title', $article_title);
        $this->db->where('keyword', $article_keyword);
        $this->db->where('asin', $asin);
        $query	=$this->db->get()  ;
         if($query->num_rows()>0){

         }else{
           $this->db->select('*')->from('build_credentials');
                	$query	=$this->db->get()  ;
        $row = $query->row();

        if (isset($row)) {
            $iwriter_api = $row->iwriter_api;
            $iwriter_user = $row->iwriter_user;
        }

        if($article_ins == ""){
            $article_ins = "I need a product review article written in third person around the keyword:  '".$article_keyword."'.

Please use the keyword within the first 2 sentences of the article as well as the last paragraph of the article.  For the rest of the article use variations of the keyword 2 -3 times if possible.";
        }else{
          $article_ins = "I need a product review article written in third person around the keyword:  '".$article_keyword."'.

Please use the keyword within the first 2 sentences of the article as well as the last paragraph of the article.  For the rest of the article use variations of the keyword 2 -3 times if possible.

".$article_ins;
        }
        $submit_tier = '<submit_tier></submit_tier>';
        if($article_type == "price_basic"){
            $price = 5.50;
            $submit_tier ='<submit_tier>top</submit_tier>';
        }else if($article_type == "price_premium"){
                $price = 6.50;
        }else if($article_type == "price_elite"){
               $price = 11.50;
        }else{
             $price = 3.50;
        }

    if($article_title != "auto"){

       $xml = '<request>
   <user_id>'.$iwriter_user.'</user_id>
   <api_key>'.$iwriter_api.'</api_key>
   <func_name>add_project</func_name>
   <title>'.$article_title.'</title>
   '.$submit_tier.'
   <category>27</category>
   <art_len>500</art_len>
   <price_per>'.$price.'</price_per>
   <keywords>
      <keyword>'.$article_keyword.'</keyword>
   </keywords>
   <writing_style>Journalistic</writing_style>
   <art_purpose>product review</art_purpose>
   <special_instructions>'.$article_ins.'</special_instructions>
   <api_value>'.$this->session->userdata('ID').'</api_value>
</request>';

  $response = call_iwriter($xml);
  //var_dump($response);
   if($response->status == "ok"){
     $a_array = array(

                    'user_id' => $this->session->userdata('ID'),

                    'domain_mgmt_id' => $article_domain,

                    'status' => 'queued',

                    'type' => $article_type,

                    'rewrites' => 0,

                    'creation_date' => date("Y-m-d"),

                    'delivery_date ' => 0,

                    'article_title ' => $article_title,

                    'keyword' => $article_keyword,

                    'project_id' => $response->project_id,

                    'post_url' => 'pending',

                    'gross_profit' => 0,

                    'article_id' => 0,
                    'article_body' => 0,
                    'asin' => $asin,


                );
                $this->db->insert('articles', $a_array);
                if($article_cost == 'free'){
                $data = array('article_credits' => $article_credits - 1);

        $this->db->where('ID', $this->session->userdata('ID'));

        $result = $this->db->update('user_table', $data);
                }
                return TRUE;
   }else{
     return $response;
   }

 // keep xml structure entact
  //return htmlentities($result, ENT_QUOTES | ENT_HTML401 | ENT_SUBSTITUTE | ENT_DISALLOWED, 'UTF-8', true);
  //return $result;
    }else{

    }
         }


}
public function post_demo_article($domain){
      $domain_only = ltrim(strstr($domain, '.'), '.');
            //get the subdomain
            $subdomain = explode('.', $domain)[0];
    $this->db->where('user_id',$this->session->userdata('ID'));
    $query = $this->db->get('user_credentials');
    $row = $query->row();
    $secret_key = $row->secret_key;
    $access_key_id = $row->access_key;
    $azon_tag = $row->affiliate_tag;

    //store article variables from post data
    $this->db->select('*')->from('articles');
    $this->db->where(array('user_id'=>0,'article_id'=>0));
   $row = $this->db->get()->row();
    $article_body = $row->article_body;
    $article_title = $row->article_title;
    //echo "article title: ".$article_title;
    $post_date = date('Y-m-d H:i:s', strtotime('now'));
     //get domain details from db
            $this->db->select('*')->from('domains');
     $this->db->where('domain',$domain) ;
    $query	=$this->db->get();
        $row = $query->row();
        if (isset($row)) {
            $username = $row->cpanel_user;
            $password = $row->cpanel_pass;



            //create file name for wp upload and make it unique so no conlficts between files arise
            $file_name = "post_article";
            //set file data
           $file_data = "<?php
include('wp-load.php');
require_once(ABSPATH .'/wp-admin/includes/taxonomy.php');
require_once(ABSPATH .'/wp-includes/post.php');
require_once(ABSPATH .'/wp-includes/link-template.php');
require_once(ABSPATH .'/wp-admin/includes/image.php');
\$cat_id = get_category_by_slug('product-reviews')->term_id;
  //echo 'cat_id is: '.\$cat_id;
\$my_post = array(
  'post_title'    => wp_strip_all_tags('".$article_title."'),
  'post_content'  => '".$article_body."',
  'post_status'   => 'publish',
  'post_author'   => 1,
  'post_type'      => 'post',
  'post_date'         => '".$post_date."',
  'post_category' => array( \$cat_id )
);
 \$pid = wp_insert_post( \$my_post );
 if(\$pid != 0){

 echo get_post_permalink(\$pid,true,false);
 }
unlink('post_article.php');

?>";
//write code to file
$users_dir = $this->session->userdata('users_dir');
$myfile = fopen( $users_dir."/".$file_name. ".txt", "w");
fwrite($myfile, $file_data);
fclose($myfile);

copy( $users_dir."/".$file_name. ".txt",  $users_dir."/".$file_name . ".php");
            // set up basic connection

            $config = array();
            $config['hostname'] = "ftp." . $domain_only;
            $config['username'] = $username . "@" . $domain_only;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
            if ($this->ftp->connect($config)) {
               $this->ftp->upload($users_dir."/".$file_name . ".php", '/public_html/demo/'.$subdomain.'/post_article.php', 'ascii', 0775);

                // check if a file exist

                //   $path = "/public_html/"; //the path where the file is located

                $file = "post_article.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files('/public_html/demo/'.$subdomain.'/'); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $query = "http://" . $domain . "/post_article.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);

                    curl_close($curl);

                } else {

                    var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();
                return $result;
            } else {
             return 0;
            }
            }else{
              return 0;
            }
}
public function post_article(){
    $this->db->where('user_id',$this->session->userdata('ID'));
    $query = $this->db->get('user_credentials');
    $row = $query->row();
    $secret_key = $row->secret_key;
    $access_key_id = $row->access_key;
    $azon_tag = $row->affiliate_tag;

    //store article variables from post data
    $article_id = $this->input->post('a_id');
    $azon_asin = $this->input->post('asin');
    $article_body = addslashes($this->input->post('article_body'));
    $article_title = $this->input->post('article_title');
    $article_post_type = $this->input->post('post_type');
    $article_date = $this->input->post('chosen_time');
    if($article_post_type == "future"){
         $post_date = date('Y-m-d H:i:s', strtotime($article_date));
    }else{
       $post_date = date('Y-m-d H:i:s', strtotime('now'));
    }
     $azon_api_url = call_azon_api_item($azon_asin, $azon_tag, $secret_key, $access_key_id);
    // echo "signed url: ".$azon_api_url;
    $azon_xml = scrape_url_content($azon_api_url);
     $azon_xml=simplexml_load_string($azon_xml);
     $image_url = $azon_xml->Items->Item->LargeImage->URL;
    // echo "<br> image_url 1 ".$image_url;
     $affiliate_url = $azon_xml->Items->Item->DetailPageURL;
     $affiliate_url_only	=	explode('?',$affiliate_url) ;
        $newQuer[]   =  	$affiliate_url_only[0]	;
        $newQuer[]	=	str_replace($affiliate_url_only[1],"tag=".$azon_tag,$affiliate_url_only[1])	;

            $PageUrl	=	implode('?',$newQuer) ;
     // echo "<br> affiliate_url ".$affiliate_url;
      $price = $azon_xml->Items->Item->OfferSummary->LowestNewPrice->FormattedPrice;
     //  echo "<br> price ".$price;
       $features = $azon_xml->Items->Item->ItemAttributes->Feature;
       $feature_start = '<div class="review-features">
                <h4>Features</h4>
                <div>
                    <ul class="featured_list">';
                    $feature_end = '</ul>
                </div>
            </div>';
            $all_features = '';
       foreach($features as $feature){
         $all_features .= '<li>'.$feature.'</li>';
       }

       //echo "<br>".$feature_start.$all_features.$feature_end;
        $title = $azon_xml->Items->Item->ItemAttributes->Title;
        // echo "<br> title ".$title;

    //get domain_mgmt_id from db
           $this->db->select('*')->from('articles');
     $this->db->where('id',$article_id);
    $query	=$this->db->get();
        $row = $query->row();

        if (isset($row)) {
            $domain_id = $row->domain_mgmt_id;
            }
            //get domain details from db
            $this->db->select('*')->from('domains');
     $this->db->where('id',$domain_id) ;
    $query	=$this->db->get();
        $row = $query->row();
        if (isset($row)) {
            $domain = $row->domain;
            $username = $row->cpanel_user;
            $password = $row->cpanel_pass;
              $pre = '<div><div>
            <div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-center azon-review-image"><br>
                     <a rel="nofollow" target="_blank" class="re_track_btn" href="'.$PageUrl.'">
                        <img src="'.$image_url.'?tag='.$azon_tag.'">
                    </a>


                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 review-title-section">
                     <div class="review-title" style="text-align:left"><h2>
                        <a rel="nofollow" target="_blank" class="re_track_btn" href="'.$PageUrl.'">
                          '.$title.'
                        </a>
                    </h2></div>
                    <div class="review-price">
                     Amazon Price: '.$price.'
                    </div>
                    <div>
                        <div>
                            <div>
                             <a href="'.$PageUrl.'" target="_blank" rel="nofollow"><button class="btn-azon-small amazon zocial">Buy It Now On Amazon!</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            '.$feature_start.$all_features.$feature_end.'
        </div>';
        $review_button = '<center><p><a href="'.$PageUrl.'#customerReviews" target="_blank"><div class="amazon"><button class="btn-azon"><i class="fa fa-amazon" style="font-size:90px;float: left;"></i>Click Here To See What Customers Are Saying</button></div></a></p></center>';
        $article_body = $pre.$article_body.$review_button;
      //exit;
            //create file name for wp upload and make it unique so no conlficts between files arise
            $file_name = "post_article_".$this->session->userdata['ID']."_".uniqid();
            //set file data
           $file_data = "<?php
include('wp-load.php');
require_once(ABSPATH .'/wp-admin/includes/taxonomy.php');
require_once(ABSPATH .'/wp-includes/post.php');
require_once(ABSPATH .'/wp-includes/link-template.php');
require_once(ABSPATH .'/wp-admin/includes/image.php');
\$cat_id = get_category_by_slug('product-reviews')->term_id;
  //echo 'cat_id is: '.\$cat_id;
\$my_post = array(
  'post_title'    => wp_strip_all_tags('".$article_title."'),
  'post_content'  => '".$article_body."',
  'post_status'   => '".$article_post_type."',
  'post_author'   => 1,
  'post_type'      => 'post',
  'post_date'         => '".$post_date."',
  'post_category' => array( \$cat_id )
);
 \$pid = wp_insert_post( \$my_post );
 if(\$pid != 0){

 echo get_post_permalink(\$pid,true,false);
 }
unlink('post_article.php');

?>";
//write code to file
 $users_dir = $this->session->userdata['ID'] . "_tempdir";
          if (file_exists($users_dir)) {
              deleteDir($users_dir);
        $this->session->unset_userdata('users_dir');
}
      mkdir($users_dir);
      $this->session->set_userdata('users_dir', $users_dir);
$users_dir = $this->session->userdata('users_dir');
$myfile = fopen( $users_dir."/".$file_name. ".txt", "w");
fwrite($myfile, $file_data);
fclose($myfile);

copy( $users_dir."/".$file_name. ".txt",  $users_dir."/".$file_name . ".php");
            // set up basic connection

            $config['hostname'] = "ftp." . $domain;
            $config['username'] = $username . "@" . $domain;
            $config['password'] = $password;
            $config['debug'] = true;
            $config['port'] = 21;
            $config['passive'] = true;
            sleep(5);
            if ($this->ftp->connect($config)) {
               $this->ftp->upload( $users_dir."/".$file_name . ".php", '/public_html/post_article.php', 'ascii', 0775);

                // check if a file exist

                //   $path = "/public_html/"; //the path where the file is located

                $file = "post_article.php"; //the file you are looking for

                $check_file_exist = $file; //combine string for easy use

                $contents_on_server = $this->ftp->list_files('/public_html/'); //Returns an array of filenames from the specified directory on success or FALSE on error.

                // Test if file is in the ftp_nlist array

                if (in_array($check_file_exist, $contents_on_server)) {

                    $query = "http://" . $domain . "/post_article.php";

                    $curl = curl_init(); // Create Curl Object

                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // Allow self-signed certs

                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0); // Allow certs that do not match the hostname

                    curl_setopt($curl, CURLOPT_HEADER, 0); // Do not include header in output

                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // Return contents of transfer on curl_exec

                    curl_setopt($curl, CURLOPT_URL, $query); // execute the query

                    curl_setopt($curl, CURLOPT_FRESH_CONNECT, true); //force cURL to use a fresh conneciton

                    $result = curl_exec($curl);

                    curl_close($curl);

                } else {

                    var_dump($contents_on_server);

                }

                // close the connection

                $this->ftp->close();

                //clean up
               deleteDir($users_dir);
        $this->session->unset_userdata('users_dir');
                if($result){
                 $data = array('status' => 'published','post_url' => $result,'article_title' => $article_title,'article_body' => $article_body);
       $this->db->where('user_id', $this->session->userdata('ID'));
        $this->db->where('id',$article_id);
        $this->db->update('articles', $data);
                }else{
                    return 0;
                }
               return $result;
            } else {
             return 0;
            }
            }else{
              return 0;
            }
}
}
?>