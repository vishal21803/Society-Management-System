<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>


<main>
<div class="d-flex flex-column flex-lg-row">

<?php include('adminDashboard.php'); ?>

<div class="flex-grow-1 p-4">

<div class="card shadow">

<div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
    <span><i class="bi bi-calendar-event me-2"></i> Events Report</span>
</div>

<div class="card-body">
<div class="table-responsive mobile-table">

<!-- 🔹 FILTERS -->
<div class="row mb-3">

<div class="col-md-2">
    <label>Start Date</label>
    <input type="date" id="ev_start" class="form-control">
</div>

<div class="col-md-2">
    <label>End Date</label>
    <input type="date" id="ev_end" class="form-control">
</div>

<div class="col-md-2">
    <label>Zone</label>
    <select id="ev_zone" class="form-control">
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
    <select id="ev_city" class="form-control">
        <option value="">All</option>
        <?php
        $c=mysqli_query($con,"SELECT city_name FROM sens_cities");
        while($r=mysqli_fetch_assoc($c)) echo "<option>{$r['city_name']}</option>";
        ?>
    </select>
</div>

<div class="col-md-2">
    <label>Member</label>
    <select id="ev_member" class="form-control">
        <option value="">All</option>
        <?php
        $m=mysqli_query($con,"SELECT fullname FROM sens_members");
        while($r=mysqli_fetch_assoc($m)) echo "<option>{$r['fullname']}</option>";
        ?>
    </select>
</div>

<div class="col-md-2">
    <label>Created By</label>
    <select id="ev_created" class="form-control">
        <option value="">All</option>
        <?php
        $u=mysqli_query($con,"SELECT DISTINCT created_by FROM sens_events");
        while($r=mysqli_fetch_assoc($u)) echo "<option>{$r['created_by']}</option>";
        ?>
    </select>
</div>

</div>

<!-- 🔹 EVENTS TABLE -->
<table id="myEventTable" class="table table-bordered table-hover align-middle w-100">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Event Date</th>
    <th>Title</th>
    <th>Show To</th>
    <th>Created By</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
$q=mysqli_query($con,"
SELECT 
    e.*,
    z.zone_name,
    c.city_name,
    m.fullname AS member_name,
    e.created_by AS created_by_name
FROM sens_events e
LEFT JOIN sens_zones z ON (e.toshow_type='zone' AND e.toshow_id=z.zone_id)
LEFT JOIN sens_cities c ON (e.toshow_type='city' AND e.toshow_id=c.city_id)
LEFT JOIN sens_members m ON (e.toshow_type='member' AND e.toshow_id=m.member_id)
ORDER BY e.event_id DESC
");

while($row=mysqli_fetch_assoc($q)){

    if($row['toshow_type']=='all'){
        $showTo="All Members";
    }elseif($row['toshow_type']=='zone'){
        $showTo=$row['zone_name'];
    }elseif($row['toshow_type']=='city'){
        $showTo=$row['city_name'];
    }elseif($row['toshow_type']=='member'){
        $showTo="Member: ".$row['member_name'];
    }
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= date("Y-m-d",strtotime($row['event_date'])) ?></td>
    <td><?= htmlspecialchars($row['title']) ?></td>
    <td><?= htmlspecialchars($showTo) ?></td>
    <td><?= htmlspecialchars($row['created_by_name']) ?></td>
</tr>
<?php } ?>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</main>

<?php include("footer.php"); }
else{ include("index.php"); }
?>
