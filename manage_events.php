
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
            <a href="eventForm.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-calendar-event fs-1 mb-2"></i>
                        <h4 class="fw-bold">Add Events</h4>
                    </div>
                </div>
            </a>
        </div>

         <!-- ADD MEMBER CARD -->
        <div class="col-md-6">
            <a href="editEvents.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-secondary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Edit Events</h4>
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
