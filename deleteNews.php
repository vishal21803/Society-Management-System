<?php
@include("connectdb.php");

if(isset($_POST['id']))
{
    $id = $_POST['id'];

    // ✅ Pehle image ka naam nikalo (optional delete from folder)
    $getImage = mysqli_query($con, "SELECT news_img FROM news WHERE news_id='$id'");
    if(mysqli_num_rows($getImage) > 0)
    {
        $row = mysqli_fetch_assoc($getImage);
        $image = $row['news_img'];

        // ✅ Folder se image delete karo
        if(file_exists("upload/news/".$image))
        {
            unlink("upload/news/".$image);
        }
    }

    // ✅ News delete query
    $delete = mysqli_query($con, "DELETE FROM news WHERE news_id='$id'");

    if($delete)
    {
        echo "success";
    }
    else
    {
        echo "error";
    }
}
else
{
    echo "invalid";
}
?>
