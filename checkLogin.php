<?php 
@session_start();

$loginInput = $_REQUEST["name"];   // email OR username OR phone
$password   = $_REQUEST["password"];

include("connectdb.php");

/* FETCH USER BY EMAIL OR USERNAME OR PHONE */
$login = strtolower($loginInput);

$rsCust = mysqli_query($con,"
    SELECT DISTINCT u.*
    FROM sens_users u
    LEFT JOIN sens_members m ON u.id = m.user_id
    WHERE 
        LOWER(u.email)='$login'
        OR LOWER(u.name)='$login'
        OR LOWER(m.phone)='$login'
        OR LOWER(CONCAT(LEFT(m.fullname,4), m.member_id))='$login'
");


if(mysqli_num_rows($rsCust) == 0){
    header("location:login.php?regmsg=1"); // Invalid Username/Email/Phone
    exit;
}

$row = mysqli_fetch_assoc($rsCust);

/* PASSWORD CHECK */
if($row["password"] != $password){
    header("location:login.php?regmsg=2"); // Invalid Password
    exit;
}

/* USER FOUND → STORE BASIC SESSION */
$_SESSION['uname'] = $row["name"];
$_SESSION['uid']   = $row["id"];
$userid = $row["id"];

/* FETCH MEMBER INFO */
$rsmem = mysqli_query($con,"
    SELECT * FROM sens_members 
    WHERE user_id='$userid'
");

if(mysqli_num_rows($rsmem) > 0){
    $memData = mysqli_fetch_assoc($rsmem);
    $_SESSION["member_id"] = $memData["member_id"];

    $member_id = $memData["member_id"];

    /* ❌ BLOCK IF MEMBER STATUS INACTIVE */
    if($memData["mstatus"] == 0){
        header("location:login.php?regmsg=5"); // contact admin
        exit;
    }


    /* CHECK IF REQUEST IS APPROVED */
    $rsReq = mysqli_query($con,"
        SELECT * FROM sens_requests
        WHERE member_id='$member_id'
        ORDER BY request_id DESC
        LIMIT 1
    ");

    if(mysqli_num_rows($rsReq) > 0){
        $req = mysqli_fetch_assoc($rsReq);

        if($req["status"] == "pending"){
            // ❌ BLOCK LOGIN
            header("location:login.php?regmsg=3");
            exit;
        }

        if($req["status"] == "rejected"){
            header("location:login.php?regmsg=4");
            exit;
        }
    }
}

/* ROLE-BASED REDIRECT */
if($row["role"] == 'user'){
    $_SESSION['utype'] = 'user';
    header("location:userPage.php");
    exit;
}
elseif($row["role"] == 'admin'){
    $_SESSION['utype'] = 'admin';
    header("location:adminPage.php");
    exit;
}
elseif($row["role"] == 'accountant'){
    $_SESSION['utype'] = 'accountant';
    header("location:accountantPage.php");
    exit;
}
?>
