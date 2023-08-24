<?php
if(isset($_SERVER['REMOTE_ADDR'])){
    if(session_status() == PHP_SESSION_NONE) {session_start();}
    $server = $_SERVER['SERVER_NAME'];
}else{
    $server = "systemtask.com";
}
date_default_timezone_set('Asia/Kolkata');
error_reporting(E_ALL);
ini_set('memory_limit', '-1');
ini_set('display_startup_errors', 1);
ini_set( 'magic_quotes_gpc', false );
ini_set("log_errors", 1);
ini_set("error_log",dirname(__FILE__).'/error_log');
ini_set('max_execution_time', 300);
define('SITE_NAME',"Progress");
//define('TABLE_PREFIX',"");
define('SESSION_VAR',"vrk");
if(strpos($server,"localhost")!== false) {
    ini_set("display_errors",1);
    define('DB_HOSTNAME','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_DATABASE','progress');
    define('SITE_URL','http://localhost/progress');
    define('SERVER_EMAIL','admin@taskglobe.org');
    define('CONTACT_EMAIL','info@taskglobe.com');
}else if(strpos($server,"localhost")!== '192.168.1.80') {
    ini_set("display_errors",1);
    define('DB_HOSTNAME','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_DATABASE','progress');
    define('SITE_URL','http://localhost/progress');
    define('SERVER_EMAIL','admin@taskglobe.org');
    define('CONTACT_EMAIL','info@taskglobe.com');
}else if(strpos($server,"localhost")!== '192.168.79.24') {
    ini_set("display_errors",1);
    define('DB_HOSTNAME','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_DATABASE','progress');
    define('SITE_URL','http://192.168.79.28/progress');
    define('SERVER_EMAIL','admin@taskglobe.org');
    define('CONTACT_EMAIL','info@taskglobe.com');
}
