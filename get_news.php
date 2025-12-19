<?php
include("connectdb.php");

$id = $_POST['id'];

$q = mysqli_query($con,"SELECT * FROM sens_news WHERE news_id='$id'");
$data = mysqli_fetch_assoc($q);

echo json_encode($data);
?>
