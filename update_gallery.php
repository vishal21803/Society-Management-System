<?php
include("connectdb.php");

if(isset($_POST['gallery_id'])){

    $id          = intval($_POST['gallery_id']);
    $title       = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $visibility  = intval($_POST['visibility_type']);

    // IMAGE HANDLING
    if(!empty($_FILES['image']['name'])){

        $oldImgQuery = mysqli_query($con, "SELECT image FROM gallery WHERE gallery_id='$id'");
        $oldImgRow = mysqli_fetch_assoc($oldImgQuery);

        // Delete old image if exists
        if(!empty($oldImgRow['image'])){
            $oldPath = "upload/gallery/".$oldImgRow['image'];
            if(file_exists($oldPath)){
                unlink($oldPath);
            }
        }

        // Upload new image
        $newImage = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "upload/gallery/".$newImage);

        $update = mysqli_query($con,"UPDATE gallery SET 
            title='$title',
            description='$description',
            visibility_type='$visibility',
            image='$newImage'
            WHERE gallery_id='$id'
        ");

    } else {

        // Update without image
        $update = mysqli_query($con,"UPDATE gallery SET 
            title='$title',
            description='$description',
            visibility_type='$visibility'
            WHERE gallery_id='$id'
        ");
    }

    if($update){
        echo "success";
    } else {
        echo "error";
    }

} else {
    echo "invalid";
}
?>
