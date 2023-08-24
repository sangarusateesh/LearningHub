<?php
require 'includes/sessioncheck.php';
$date = date("Y-m-d");
$records = $clsObj->get_records(['table'=>'daily_updates','where'=>"dou='$date' and status=1"]);
// print_r($records);die;
$record = $records[0];
$record['email'] = 'sangaru.satti@gmail.com';
// print_r($record);die;
if($record){
	// session_start();
	$_SESSION['user_id'] = $record['id'];
}
unset($_SESSION['userData']);
print_r($_SESSION);die;
$user_id = isset($_SESSION)?$_SESSION['user_id']:'';
?>