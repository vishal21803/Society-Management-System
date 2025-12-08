<?php @session_start();
$uname=$_SESSION["uname"];

include("connectdb.php");
$a=$_REQUEST["name"];
$b=$_REQUEST["email"];
$c=$_REQUEST["password"];


mysqli_query($con,"insert into sens_users(name,email,password,role,created_at,created_by) values('$a','$b','$c','user',NOW(),'$uname')");

header("location:successpage.php");


?>