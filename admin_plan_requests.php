

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

        <?php
include("connectdb.php");

$res = mysqli_query($con,"
SELECT pr.*, p.name, p.price 
FROM sens_plan_requests pr
JOIN sens_plans p ON pr.plan_id = p.plan_id
WHERE pr.status = 'pending'
");
?>

<table class="table table-bordered">
<tr>
  <th>User</th>
  <th>Plan</th>
  <th>Amount</th>
  <th>Request Date</th>
  <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($res)) { ?>
<tr>
  <td><?= $row['user_id'] ?></td>
  <td><?= $row['name'] ?></td>
  <td>₹<?= $row['price'] ?></td>
  <td><?= $row['request_date'] ?></td>
  <td>
    <a href="approve_plan.php?req_id=<?= $row['req_id'] ?>" class="btn btn-success btn-sm">Approve</a>
  </td>
</tr>
<?php } ?>
</table>

    </div>
</div>

</main>




<?php
include("footer.php");
}else{
    include("index.php");
}
?>
