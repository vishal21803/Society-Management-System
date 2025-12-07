<?php
@session_start();
include("connectdb.php");

if(isset($_POST['update'])){

    $uid = $_SESSION['member_id'];

    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $address  = $_POST['address'];
    $password = $_POST['password'];

    // ✅ Photo Upload
    if(!empty($_FILES['photo']['name'])){
        $photo = time().$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'], "upload/member/".$photo);

        mysqli_query($con,"UPDATE members SET photo='$photo' WHERE member_id='$uid'");
    }

    // ✅ Password Update (optional)
    if($password!=""){
        mysqli_query($con,"UPDATE users SET password='$password' WHERE id=(SELECT user_id FROM members WHERE member_id='$uid')");
    }

    // ✅ Profile Update
    mysqli_query($con,"UPDATE members SET 
        fullname='$fullname',
        phone='$phone',
        address='$address'
        WHERE member_id='$uid'
    ");

    mysqli_query($con,"UPDATE users SET email='$email' 
        WHERE id=(SELECT user_id FROM members WHERE member_id='$uid')
    ");

    header("Location: editprofile.php?updated=1");
    exit();
}
?>
