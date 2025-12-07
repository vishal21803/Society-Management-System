<?php
@include("connectdb.php");

if(!isset($_POST['id'])) {
    echo json_encode(['error' => 'no_id']);
    exit;
}

$id = (int) $_POST['id'];

$res = mysqli_query($con, "SELECT * FROM sens_gallery WHERE gallery_id = $id LIMIT 1");
if(!$res) {
    echo json_encode(['error' => mysqli_error($con)]);
    exit;
}

if(mysqli_num_rows($res) == 0){
    echo json_encode(['error' => 'not_found']);
    exit;
}

$row = mysqli_fetch_assoc($res);
echo json_encode($row);
