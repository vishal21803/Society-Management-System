<?php
@session_start();
include("connectdb.php");
$member_id=$_SESSION['member_id'];

$category = $_POST['category'];
$date=$_POST['require_date'];

if($category == "Other"){
    $category = $_POST['other_category'];  // user typed value
}

    $details = mysqli_real_escape_string($con, $_POST['details']);


    $qry = mysqli_query($con,"
        INSERT INTO sens_required(require_type,require_desc,member_id,created_at,require_date)
        VALUES('$category','$details','$member_id',NOW(),'$date')
    ");

    if($qry){
        echo "
        <script>
            alert('Requirement Added Successfully!');
            window.location='manageNeed.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Failed to Add Service!');
            window.location='addRequirement.php';
        </script>
        ";
    }



?>
