<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>

<!-- ✅ DATATABLE CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<main>
<div class="d-flex flex-column flex-lg-row">

    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">


        <!-- ✅ SAME CARD LAYOUT AS EVENTS -->
        <div class="card shadow">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-newspaper me-2"></i> Download Report</span>

              
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
  <div class="row mb-3">

<div class="col-md-3">
    <label>From Date</label>
    <input type="date" id="filter_from_date" class="form-control">
</div>

<div class="col-md-3">
    <label>To Date</label>
    <input type="date" id="filter_to_date" class="form-control">
</div>

<div class="col-md-3">
    <label>Visible to</label>
    <select id="filter_downshow" class="form-control">
        <option value="">All</option>
        <option value="members">Members</option>
        <option value="general">General</option>
    </select>
</div>



<div class="col-md-3">
    <label>Created By</label>
    <select id="filter_create_by" class="form-control">
        <option value="">All</option>
        <?php
        $u=mysqli_query($con,"SELECT created_by FROM sens_downloads");
        while($r=mysqli_fetch_assoc($u))
            echo "<option>{$r['created_by']}</option>";
        ?>
    </select>
</div>

</div>




              <table id="myDownloadTable" class="table table-bordered table-hover align-middle">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>File Name</th>
    <th>Created At</th>
    <th>Downshow</th>
    <th>Created By</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
$q=mysqli_query($con,"SELECT * FROM sens_downloads ORDER BY id DESC");
while($row=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['file_name']) ?></td>
    <td><?= date("Y-m-d",strtotime($row['created_at'])) ?></td>
    <td>
        <span class="badge <?= $row['downshow']=='yes'?'bg-success':'bg-secondary' ?>">
            <?= ucfirst($row['downshow']) ?>
        </span>
    </td>
    <td><?= htmlspecialchars($row['created_by']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>


            </div>
        </div>
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
