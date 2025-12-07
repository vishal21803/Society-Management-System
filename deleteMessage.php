<?php
include("connectdb.php");

$id = $_GET['id'];
mysqli_query($con,"DELETE FROM sens_messages WHERE id='$id'");
header("Location: " . $_SERVER['HTTP_REFERER']);
?>
