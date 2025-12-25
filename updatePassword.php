<?php
session_start();
include("connectdb.php");

if(isset($_POST['update'])){

    $uid = $_SESSION['uid'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if($new !== $confirm){
        echo "<script>
            alert('❌ Passwords do not match');
            window.history.back();
        </script>";
        exit;
    }

    // 🔐 HASH PASSWORD

    mysqli_query($con,"
        UPDATE sens_users 
        SET password = '$confirm'
        WHERE id = '$uid'
    ");

    header("Location: editPassword.php?updated=1");
}
?>
