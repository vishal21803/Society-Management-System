<?php
include("connectdb.php");

$name=$_REQUEST["name"];
$phone=$_REQUEST["phone"];
$desc=$_REQUEST["desc"];

mysqli_query($con,"insert into sens_contact(con_name,con_phone,con_desc) values('$name','$phone','$desc')");

header("location:showContact.php?sent=1");



?>