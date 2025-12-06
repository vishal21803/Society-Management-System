<?php
include("connectdb.php");
$a=$_REQUEST["name"];
$b=$_REQUEST["email"];
$c=$_REQUEST["password"];


mysqli_query($con,"insert into users(name,email,password,role,created_at) values('$a','$b','$c','user',NOW())");

header("location:successpage.php");


?>