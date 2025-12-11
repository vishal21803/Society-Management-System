<?php
include("connectdb.php");

if(isset($_GET['ids'])) {
    $ids = $_GET['ids']; // "23,25,28"

    $sql = "DELETE FROM sens_contact WHERE con_id IN ($ids)";
    mysqli_query($con, $sql);

    header("Location: contactQueries.php?msg=deleted");
    exit;
}
?>
