<?php 
require 'classes/cls.php';
$clsObj = new Cls();
$session = !empty($_SESSION[SESSION_VAR]['user']) ? $_SESSION[SESSION_VAR]['user'] : '';//print_r($session);exit;
$suserId = isset($session['user_id']) ? $session['user_id'] : '';
$sroleId = isset($session['role_id']) ? $session['role_id'] : '';
if(!$suserId || !$sroleId) {header("location:".SITE_URL."/login");exit; }
$pageName = basename($_SERVER['SCRIPT_NAME']);
$s_user = $clsObj->get_record(['table'=>'users','where'=>"id='$suserId'"]);
$p_image= !empty($s_user['image']) && file_exists('uploads/users/'.$s_user['image']) ? '.uploads/users/'.$s_user['image'] : 'images/avatar.png';
$page_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
$redirect_url = !empty($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITE_URL."/admin";
$get = filter_input_array(INPUT_GET);//print_r($getdata);exit;
$action = isset($get['action']) ? $get['action'] : "listing";
$id = !empty($get['id']) ? intval($get['id']) : "";