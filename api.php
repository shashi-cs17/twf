<?php
header("Content-Type:application/json");
require "func_execute.php";

if(!empty($_GET['input']))
{
	$input=$_GET['input'];
	$cost = get_output($input);
	
	response(200,"true",$cost);
	
}
else
{
	response(400,"false",0);
}

function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);
	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;
	
	$json_response = json_encode($response);
	echo $json_response;
}
