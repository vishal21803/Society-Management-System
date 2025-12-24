
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
        <div class="col-md-2">
            <a href="reportBill.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Bill Report</h4>
                    </div>
                </div>
            </a>
        </div>

       <div class="col-md-2">
            <a href="reportReceipt.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Receipt Report</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="reportRequest.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Request Report</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="reportEvent.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Event Report</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="reportNews.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">News Report</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a href="reportGallery.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Gallery Report</h4>
                    </div>
                </div>
            </a>
        </div>
         <div class="col-md-2">
            <a href="reportMessage.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Message Report</h4>
                    </div>
                </div>
            </a>
        </div>
         <div class="col-md-2">
            <a href="reportDownload.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Download Report</h4>
                    </div>
                </div>
            </a>
        </div>

          <div class="col-md-2">
            <a href="reportExpenses.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Expenses Report</h4>
                    </div>
                </div>
            </a>
        </div>

         <div class="col-md-2">
            <a href="reportReceive.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Receivable Report</h4>
                    </div>
                </div>
            </a>
        </div>

         <div class="col-md-2">
            <a href="reportFamily.php" class="text-decoration-none">
                <div class="dashboard-square-card bg-primary text-white shadow animate__animated animate__fadeInLeft">
                    <div class="text-center">
                        <i class="bi bi-pencil fs-1 mb-2"></i>
                        <h4 class="fw-bold">Family Report</h4>
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
