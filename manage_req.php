
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
        <!-- <div class="col-md-4">
            <a href="adminaddmem.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-person-plus fs-1 mb-2"></i>
                        <h4 class="fw-bold">Add Members</h4>
                        <p class="mb-0">Create new member</p>
                    </div>
                </div>
            </a>
        </div> -->

         <!-- ADD MEMBER CARD -->
        <!-- <div class="col-md-4">
            <a href="editMembers.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-secondary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Edit Members</h4>
                    </div>
                </div>
            </a>
        </div> -->

       

        <!-- PENDING REQUEST CARD -->
        <div class="col-md-4">
            <a href="manage_request.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-warning text-dark shadow animate__animated animate__fadeInRight">
                    <div class="text-center">
                        <i class="bi bi-hourglass-split fs-1 mb-2"></i>
                        <h4 class="fw-bold">Membership Requests</h4>
                        <p class="mb-0">Approve or reject</p>
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
