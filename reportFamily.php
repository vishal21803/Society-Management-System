<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
include("connectdb.php");
?>


<main>
<div class="d-flex flex-column flex-lg-row">

<?php include("adminDashboard.php"); ?>

<div class="flex-grow-1 p-4">

<div class="card shadow">
<div class="card-header bg-warning fw-bold text-dark">
    <i class="bi bi-people-fill me-2"></i> Family Members Report
</div>

<div class="card-body">

<!-- FILTERS -->
<div class="row mb-3">
    <div class="col-md-3">
        <label>Zone</label>
        <select id="zoneFilter" class="form-control">
            <option value="">All Zones</option>
            <?php
            $z=mysqli_query($con,"SELECT zone_name FROM sens_zones WHERE zstatus=1");
            while($r=mysqli_fetch_assoc($z)){
                echo "<option>{$r['zone_name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-3">
        <label>City</label>
        <select id="cityFilter" class="form-control">
            <option value="">All Cities</option>
            <?php
            $c=mysqli_query($con,"SELECT city_name FROM sens_cities");
            while($r=mysqli_fetch_assoc($c)){
                echo "<option>{$r['city_name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-3">
    <label>Marital Status</label>
    <select id="maritalFilter" class="form-control">
        <option value="">All</option>
        <option value="Married">Married</option>
        <option value="Unmarried">Unmarried</option>
    </select>
</div>

</div>

<!-- TABLE -->
<div class="table-responsive">
<table id="familyTable" class="table table-bordered table-hover align-middle">
<thead class="table-dark">
<tr>
    <th>#</th>
    <th>Member Name</th>
    <th>Family Member Name</th>
    <th>Phone</th>
    <th>Relation</th>
    <th>Marital Status</th>
    <th>Education</th>
    <th>Age</th>
    <th>Zone</th>
    <th>City</th>
</tr>
</thead>

<tbody>
<?php
$i=1;
$q=mysqli_query($con,"
SELECT 
    f.*,
    m.fullname AS member_name,
    z.zone_name,
    c.city_name,
    TIMESTAMPDIFF(YEAR, f.fam_dob, CURDATE()) AS age
FROM sens_family f
JOIN sens_members m ON f.member_id = m.member_id
LEFT JOIN sens_zones z ON m.zone_id = z.zone_id
LEFT JOIN sens_cities c ON m.city_id = c.city_id
ORDER BY f.fam_id DESC
");

while($row=mysqli_fetch_assoc($q)){
?>
<tr>
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['member_name']) ?></td>
    <td><?= htmlspecialchars($row['fam_name']) ?></td>
    <td><?= htmlspecialchars($row['fam_phone']) ?></td>
    <td><?= htmlspecialchars($row['fam_relation']) ?></td>
    <td>
        <span class="badge <?= $row['marry_status']=='married'?'bg-success':'bg-info' ?>">
            <?= ucfirst($row['marry_status']) ?>
        </span>
    </td>
    <td><?= htmlspecialchars($row['fam_education']) ?></td>
    <td><?= $row['age'] ?></td>
    <td><?= $row['zone_name'] ?></td>
    <td><?= $row['city_name'] ?></td>
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



<?php
include("footer.php");
}else{
include("index.php");
}
?>
