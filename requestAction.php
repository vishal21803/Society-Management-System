<?php
include("connectdb.php");

if(isset($_POST['action'], $_POST['request_id'])){

    $action = $_POST['action'];
    $req_id = $_POST['request_id'];   // yahi ab req_id hoga

    // ✅ APPROVE PLAN REQUEST
    if($action == "approve"){

        // ✅ Request ka data nikaalo
        $q = mysqli_fetch_assoc(mysqli_query($con,"
            SELECT * FROM sens_plan_requests WHERE req_id='$req_id'
        "));

        $user_id = $q['user_id'];
        $plan_id = $q['plan_id'];

        // ✅ Plan ka duration nikaalo
        $p = mysqli_fetch_assoc(mysqli_query($con,"
            SELECT * FROM sens_plans WHERE plan_id='$plan_id'
        "));

        $start = date('Y-m-d');

        if(!empty($p['duration_days'])){
            $end = date('Y-m-d', strtotime("+".$p['duration_days']." days"));
        } else {
            $end = NULL; // lifetime
        }

        // ✅ MEMBERS TABLE UPDATE
        mysqli_query($con,"
            UPDATE sens_members 
            SET plan_id='$plan_id',
                membership_start='$start',
                membership_end=" . ($end ? "'$end'" : "NULL") . "
            WHERE member_id='$user_id'
        ");

        // ✅ PLAN REQUEST APPROVED
        mysqli_query($con,"
            UPDATE sens_plan_requests 
            SET status='approved' 
            WHERE req_id='$req_id'
        ");

        echo "✅ Plan Approved & Membership Activated!";
    }

    // ❌ REJECT PLAN REQUEST
    if($action == "reject"){

        mysqli_query($con,"
            UPDATE sens_plan_requests 
            SET status='rejected' 
            WHERE req_id='$req_id'
        ");

        echo "❌ Plan Request Rejected!";
    }
}
?>
