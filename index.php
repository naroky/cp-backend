<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: *');

$postdata = file_get_contents("php://input");
//echo "postdata:".$postdata."\r\n";
$data_obj = json_decode($postdata);
$cp_trans_id = date('YmdHis').rand(100,999);
//var_dump($data_obj);
$url = "https://aoc.truecorp.co.th/authen";
//$url = "https://aoc-stg.truecorp.co.th/authen"; // stg
$postdata = "grant_type=client_credentials&client_id=".$data_obj->client_id."&client_secret=".$data_obj->client_secret."&cp_trans_id=".$cp_trans_id;
//echo "url:".$url."\r\n";
//echo "postdata:".$postdata."\r\n";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$postdata);
// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close ($ch);
// Further processing ...
if ($server_output != "") 
{ 
    $resObj = json_decode($server_output);  
    $jsonRes->access_token = $resObj->access_token;
    $jsonRes->cp_trans_id = $data_obj->cp_trans_id;
    $jsonRes->service_id = $data_obj->service_id;
    $jsonRes->css_keyword = $data_obj->css_keyword;
    $jsonRes->cp_id = $data_obj->cp_id;
    echo json_encode($jsonRes);
    } 
else 
{ 
    echo "Fail";
}
?>