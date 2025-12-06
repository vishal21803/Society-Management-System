
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
?>

<main>
<div class="d-flex">
    <?php include('userDashboard.php'); ?>
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
    </div>
</div>
</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
