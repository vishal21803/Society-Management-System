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
                <span><i class="bi bi-newspaper me-2"></i> Request Report</span>

              
            </div>


<div class="card-body">
    <div class="table-responsive mobile-table">
      
    
<div class="row mb-3">


<div class="col-md-2">
    <label>Request From</label>
    <input type="date" id="reqs" class="form-control">
</div>

<div class="col-md-2">
    <label>Request To</label>
    <input type="date" id="reqt" class="form-control">
</div>

<div class="col-md-2">
    <label>Approved From</label>
    <input type="date" id="apps" class="form-control">
</div>

<div class="col-md-2">
    <label>Approved To</label>
    <input type="date" id="appt" class="form-control">
</div>

<div class="col-md-2">
    <label>Zone</label>
    <select id="zoer" class="form-control">
        <option value="">All</option>
        <?php
$z = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);        while($r=mysqli_fetch_assoc($z)) echo "<option>{$r['zone_name']}</option>";
        ?>
    </select>
</div>

<div class="col-md-2">
    <label>City</label>
    <select id="cityr" class="form-control">
        <option value="">All</option>
        <?php
        $c=mysqli_query($con,"SELECT city_name FROM sens_cities");
        while($r=mysqli_fetch_assoc($c)) echo "<option>{$r['city_name']}</option>";
        ?>
    </select>
</div>

<div class="col-md-2 mt-2">
    <label>Plan</label>
    <select id="planr" class="form-control">
        <option value="">All</option>
        <?php
        $p=mysqli_query($con,"SELECT name FROM sens_plans");
        while($r=mysqli_fetch_assoc($p)) echo "<option>{$r['name']}</option>";
        ?>
    </select>
</div>

<div class="col-md-2 mt-2">
    <label>Request Status</label>
    <select id="statusr" class="form-control">
        <option value="">All</option>
        <option value="pending">pending</option>
        <option value="approved">Approved</option>
        <option value="rejected">Rejected</option>
      
    </select>
</div>


</div>


              <table id="myReqTable" class="table table-bordered table-hover align-middle">
<thead class="table-dark">
<tr>
    <th>#</th>
     <th>Member</th>
    <th>Zone</th>
    <th>City</th>
    <th>Plan</th>
    <th>Request Date</th>
    <th>Approved Date</th>
    <th>Status</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
$q = mysqli_query($con,"
SELECT 
r.*,
m.fullname,
z.zone_name,
c.city_name,
p.name
FROM sens_requests r
JOIN sens_members m ON r.member_id = m.member_id
LEFT JOIN sens_zones z ON m.zone_id = z.zone_id
LEFT JOIN sens_cities c ON m.city_id = c.city_id
LEFT JOIN sens_plans p ON m.plan_id = p.plan_id
ORDER BY r.request_id DESC
");
while($row=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= $row['zone_name'] ?></td>
    <td><?= $row['city_name'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= date("Y-m-d",strtotime($row['request_date'])) ?></td>
    <td><?= $row['approved_date'] ? date("Y-m-d",strtotime($row['approved_date'])) : '-' ?></td>
    <td>
        <span class="badge <?= $row['status']=='approved'?'bg-success':'bg-warning' ?>">
            <?= ucfirst($row['status']) ?>
        </span>
    </td>
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
