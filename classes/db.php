<?php
require_once __DIR__."/../includes/conf.php";
class Db {
    protected $con;
    public function getConnection(){
        if(!$this->con){
            if($con = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE) ){ 
                // $con->query("set time_zone = 'Asia/Kolkata';"); 
                return $con;
            }else if(mysqli_connect_errno()) {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return $this->con;
    }
}
