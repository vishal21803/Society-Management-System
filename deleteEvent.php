<?php
include("connectdb.php");

if(isset($_POST['event_id']))
{
    $event_id = $_POST['event_id'];

    $delete = mysqli_query($con,"DELETE FROM sens_events WHERE event_id='$event_id'");

    if($delete){
        echo "success";
    }else{
        echo "error";
    }
}
else{
    echo "no_id";
}
?>
