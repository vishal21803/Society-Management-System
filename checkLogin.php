<?php 
@session_start();

$loginInput = $_REQUEST["name"];   // user yahan email ya username dono daal sakta hai
$password = $_REQUEST["password"];

include("connectdb.php");

/* ✅ EMAIL SE USER FETCH */
$rsCust = mysqli_query($con,"
    SELECT * FROM sens_users 
    WHERE BINARY email='$loginInput' 
       OR BINARY name='$loginInput'
");

if(mysqli_num_rows($rsCust) == 0){
    // ❌ Email not found
    header("location:login.php?regmsg=1");
    exit;
}
else{
    $row = mysqli_fetch_array($rsCust);

    /* ✅ PASSWORD MATCH */
    if($row["password"] == $password){

        // ✅ SESSION ME NAME SAVE HOGA (EMAIL NAHI)
        $_SESSION['uname'] = $row["name"];   // ✅ NAME STORE
        $_SESSION['uid']   = $row["id"];

        $memid = $row["id"];

        /* ✅ MEMBER ID FETCH */
        $rsmem = mysqli_query($con,"
            SELECT * FROM sens_members 
            WHERE user_id='$memid'
        ");

        if(mysqli_num_rows($rsmem) > 0){
            $row5 = mysqli_fetch_assoc($rsmem);
            $_SESSION["member_id"] = $row5["member_id"];
        }

        /* ✅ ROLE BASED REDIRECTION */
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

    }
    else{
        // ❌ Wrong Password
        header("location:login.php?regmsg=2");
        exit;
    }
}
?>
