<?php
include("connectdb.php");

$id = $_POST['member_id'];
$status = $_POST['mstatus'];

$q = mysqli_query($con,
    "UPDATE sens_members 
     SET mstatus='$status'
     WHERE member_id='$id'"
);

if($q){
    echo "success";
}else{
    echo "error";
}
?>
