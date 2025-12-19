<?php
@session_start();
include("connectdb.php");
$member_id=$_SESSION['member_id'];

$category = $_POST['category'];
$date=$_POST['service_date'];

if($category == "Other"){
    $category = $_POST['other_category'];  // user typed value
}

    $details = mysqli_real_escape_string($con, $_POST['details']);


    $qry = mysqli_query($con,"
        INSERT INTO sens_services(service_type,service_desc,member_id,created_at,service_date)
        VALUES('$category','$details','$member_id',NOW(),'$date')
    ");

    if($qry){
        echo "
        <script>
            alert('Service Added Successfully!');
            window.location='manageServices.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Failed to Add Service!');
            window.location='addService.php';
        </script>
        ";
    }



?>
