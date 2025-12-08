<?php
include("connectdb.php");

if(isset($_POST['action'], $_POST['request_id'])){

    $action = $_POST['action'];
    $req_id = $_POST['request_id'];

    // ✅ REQUEST SE MEMBER ID NIKALO
    $q = mysqli_fetch_assoc(mysqli_query($con,"
        SELECT * FROM sens_requests 
        WHERE request_id='$req_id'
    "));

    $member_id = $q['member_id'];

    // ✅ APPROVE REQUEST
    if($action == "approve"){

        $start = date('Y-m-d');

        // ✅ MEMBERSHIP START UPDATE (PLAN PEHLE SE MEMBERS ME HAI)
        mysqli_query($con,"
            UPDATE sens_members 
            SET membership_start='$start'
            WHERE member_id='$member_id'
        ");

        // ✅ REQUEST STATUS APPROVED
        mysqli_query($con,"
            UPDATE sens_requests 
            SET status='approved' 
            WHERE request_id='$req_id'
        ");

        echo "✅ Member Approved & Membership Activated!";
        exit;
    }

    // ❌ REJECT REQUEST
    if($action == "reject"){

        mysqli_query($con,"
            UPDATE sens_requests 
            SET status='rejected' 
            WHERE request_id='$req_id'
        ");

        echo "❌ Member Request Rejected!";
        exit;
    }
}
?>
