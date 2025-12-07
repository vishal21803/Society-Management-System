
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container mt-4">
    <div class="row">

        <?php
        $res = mysqli_query($con,"SELECT * FROM sens_news ORDER BY created_at DESC");
        while($row = mysqli_fetch_assoc($res)){
        ?>
        <div class="col-md-4 mb-3">
            <div class="card shadow">
                <img src="upload/news/<?php echo $row['news_img']; ?>" height="200">

                <div class="card-body">
                    <h5><?php echo $row['title']; ?></h5>
                    <p><?php echo substr($row['description'],0,50); ?>...</p>

                    <button class="btn btn-warning btn-sm" onclick="editNews(<?php echo $row['news_id']; ?>)">
                        ✏ Edit
                    </button>
                </div>
            </div>
        </div>
        <?php } ?>

    </div>
</div>

<?php include("news_edit_modal.php"); ?>
    </div>
</div>

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
