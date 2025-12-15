<?php
@session_start();
include("connectdb.php");

$email = trim($_POST['email']);
$currentMemberId = $_SESSION['member_id'];

/* 🔹 GET CURRENT USER ID */
$qUser = mysqli_query($con,
    "SELECT user_id 
     FROM sens_members 
     WHERE member_id='$currentMemberId'"
);
$rowUser = mysqli_fetch_assoc($qUser);
$currentUserId = $rowUser['user_id'];

/* ✅ SAME USER EMAIL */
$q1 = mysqli_query($con,
    "SELECT id 
     FROM sens_users 
     WHERE email='$email' 
     AND id='$currentUserId'"
);

if(mysqli_num_rows($q1) > 0){
    echo "same";
    exit;
}

/* ❌ OTHER USER EMAIL */
$q2 = mysqli_query($con,
    "SELECT id 
     FROM sens_users 
     WHERE email='$email' 
     AND id != '$currentUserId'"
);

if(mysqli_num_rows($q2) > 0){
    echo "other";
    exit;
}

/* ✔ AVAILABLE */
echo "available";
