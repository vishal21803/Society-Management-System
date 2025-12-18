<?php 
@session_start();
include("header.php");
include("connectdb.php");
?>

<main>
     <br>
     <div class="text-center mb-5">
    <h1 class="fw-bold">Our Requirements</h1>
  </div>
<div class="d-flex flex-column flex-lg-row">
    <div class="flex-grow-1 p-4">

        <div class="card shadow-lg border-0">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-gear"></i> Our Requirements</span>
            </div>

            <div class="card-body">

                <div class="table-responsive mobile-table">

<div class="row mb-3">

    <!-- Zone filter -->
    <div class="col-md-3">
        <label>Zone</label>
        <select id="filterZone" class="form-control">
            <option value="">All Zones</option>
            <?php 
            $zones = mysqli_query($con,
                "SELECT * FROM sens_zones 
                 WHERE zstatus=1 
                 ORDER BY CAST(REGEXP_SUBSTR(zone_name,'[0-9]+') AS UNSIGNED)"
            );
            while($z=mysqli_fetch_assoc($zones)){
                echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
            }
            ?>
        </select>
    </div>

    <!-- City -->
    <div class="col-md-3">
        <label>City</label>
        <select id="filterCity" class="form-control">
            <option value="">All Cities</option>
        </select>
    </div>

    <!-- Service Type -->
    <div class="col-md-3">
    <label>Requirement Type</label>

    <select id="filterService" class="form-control mb-2">
        <option value="">All Requirement</option>
        <option value="Kirana">Kirana</option>
        <option value="Restaurant">Restaurant</option>
        <option value="Hotel">Hotel</option>
        <option value="Sanitary">Sanitary</option>
        <option value="Education">Education</option>
        <option value="Other">Other</option>
    </select>

    <!-- hidden textbox -->
    <input type="text" id="customService" 
           placeholder="Enter Service Type"
           class="form-control"
           style="display:none;">
</div>


</div>


<table id="serviceTable" class="table table-bordered table-hover text-center align-middle">

<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Requirement Type</th>
    <th>Description</th>
    <th>Name</th>
    <th>Phone</th>
    <th>Zone</th>
    <th>City</th>

    <!-- HIDDEN For filtering -->
    <th style="display:none;">zone_id</th>
    <th style="display:none;">city_id</th>
</tr>
</thead>

<tbody>

<?php

$sql="
SELECT 
    s.*,
    m.fullname,
    m.phone,
    z.zone_name,
    z.zone_id,
    c.city_name,
    c.city_id
FROM sens_required s
LEFT JOIN sens_members m ON s.member_id=m.member_id
LEFT JOIN sens_zones z ON m.zone_id=z.zone_id
LEFT JOIN sens_cities c ON m.city_id=c.city_id
ORDER BY s.require_id DESC
";

$res=mysqli_query($con,$sql);
$i=1;

while($row=mysqli_fetch_assoc($res)){
?>
<tr>
<td><?= $i++ ?></td>
<td><?= $row['require_type'] ?></td>
<td><?= $row['require_desc'] ?></td>
<td><?= $row['fullname'] ?></td>
<td><?= $row['phone'] ?></td>
<td><?= $row['zone_name'] ?></td>
<td><?= $row['city_name'] ?></td>

<td style="display:none;"><?= $row['zone_id'] ?></td>
<td style="display:none;"><?= $row['city_id'] ?></td>

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

<?php include("footer.php"); ?>
