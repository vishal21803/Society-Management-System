<?php
include 'connectdb.php';

$id = $_GET['id'];

mysqli_query($con, "DELETE FROM sens_contact WHERE con_id=$id");

echo "<script>alert('Deleted Successfully'); window.location='contactQueries.php';</script>";
?>
