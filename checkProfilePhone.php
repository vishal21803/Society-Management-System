<?php
@session_start();
include("connectdb.php");

$phone = trim($_POST['phone']);
$currentMemberId = $_SESSION['member_id'];

/* 1️⃣ Check SAME USER */
$q1 = mysqli_query($con,
    "SELECT member_id 
     FROM sens_members 
     WHERE phone='$phone' 
     AND member_id='$currentMemberId'"
);

if(mysqli_num_rows($q1) > 0){
    echo "same";
    exit;
}

/* 2️⃣ Check OTHER USERS */
$q2 = mysqli_query($con,
    "SELECT member_id 
     FROM sens_members 
     WHERE phone='$phone' 
     AND member_id != '$currentMemberId'"
);

if(mysqli_num_rows($q2) > 0){
    echo "other";
    exit;
}

/* 3️⃣ AVAILABLE */
echo "available";
