<?php
$url = 'http://'.trim($_GET['url'] || $_POST['url']).'/asg.txt';
echo $url;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER,0);               // Do not include header in output
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);    //force cURL to use a fresh conneciton
    $result = curl_exec($ch);
    curl_close($ch);
    echo $result;

?>

