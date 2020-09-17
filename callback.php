<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: *');

$postdata = file_get_contents("php://input");
//echo "postdata:".$postdata."\r\n";
$data_obj = json_decode($postdata);
var_dump($postdata)
?>