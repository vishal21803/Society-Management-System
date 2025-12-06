
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
?>

<main>
<div class="d-flex">
    <?php include('adminDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container mb-5">

    <div class="row g-4">

        <!-- ADD MEMBER CARD -->
        <div class="col-md-6">
            <a href="newsForm.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-newspaper fs-1 mb-2"></i>
                        <h4 class="fw-bold">Add News</h4>
                    </div>
                </div>
            </a>
        </div>

        <!-- PENDING REQUEST CARD -->
        <div class="col-md-6">
            <a href="admin_news.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-warning text-dark shadow animate__animated animate__fadeInRight">
                    <div class="text-center">
                        <i class="bi bi-pencil-square fs-1 mb-2"></i>
                        <h4 class="fw-bold">Edit/Delete News</h4>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

    </div>
</div>

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
