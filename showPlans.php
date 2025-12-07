
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
         <div class="container">
    <h3 class="mb-4 fw-bold text-warning">Membership Plans</h3>

    <div class="row g-4">

        <?php
        $q = mysqli_query($con,"SELECT * FROM sens_plans");
        while($plan = mysqli_fetch_assoc($q)){
        ?>
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4 plan-card h-100">
                <div class="card-body text-center">

                    <h4 class="fw-bold mb-2"><?php echo $plan['name']; ?></h4>

                    <h2 class="text-success mb-3">₹<?php echo $plan['price']; ?></h2>

                    <p class="text-muted">
                        <?php
                        if($plan['duration_days'] == NULL){
                            echo "Lifetime Validity";
                        } else {
                            echo $plan['duration_days']." Days Validity";
                        }
                        ?>
                    </p>

                  
                    <a href="buy_plan.php?plan_id=1" class="btn btn-warning px-4 rounded-pill">Buy Now </a>
                    


                </div>
            </div>
        </div>
        <?php } ?>

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
