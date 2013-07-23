<?php
session_start();
if(!isset($_SESSION["UUID"]) && !isset($_SESSION["SUID"])){
    echo "~";
    }
date_default_timezone_set("America/New_York");
$db=new mysqli("127.0.0.1","root","devils","test",3306);
if($db->connect_errno){
    echo "FAILURE";
}
?>
