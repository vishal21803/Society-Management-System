<?php
@session_start();

/*
$dbname="u280986508_jain_society";
$user ="u280986508_jain123456";
$pass="Jain.123456";
*/


$dbname="jain_society";
$user ="root";
$pass="";




$con = mysqli_connect("127.0.0.1",$user,$pass) or die("database connecection error");
mysqli_select_db($con,$dbname) or die("database selection error");

?>
