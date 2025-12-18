<?php 
@session_start();

include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">
    <div class="flex-grow-1 p-4">

    <div class="card shadow-lg border-0">
        <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                 <span>Our Members</span>

        </div>

        <div class="card-body">
            <div class="table-responsive mobile-table">
                <div class="row mb-3">
    <div class="col-md-3">
        <label>Zone</label>
        <select id="flterzone" class="form-control">
            <option value="">All Zones</option>
            <?php
$zones= mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);            while($z = mysqli_fetch_assoc($zones)){
echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
            }
            ?>
        </select>
    </div>

    <div class="col-md-3">
        <label>City</label>
        <select id="fltercity" class="form-control">
            <option value="">All Cities</option>
          
        </select>
    </div>
</div>

                <table class="table table-bordered table-hover align-middle text-center" id="myDisplayTable">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Zone</th>
                            <th>City</th>
                            <th style="display:none;">ZoneID</th>
<th style="display:none;">CityID</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
$res = mysqli_query($con,"
SELECT 
    m.member_id,
    m.mstatus,
    m.user_id,
    m.fullname,
    m.phone,
    m.gender,
    m.dob,
    m.address,
    m.membership_start,
    m.membership_end,
    m.zone_id,
    m.city_id,
    m.plan_id,
    z.zone_name,
    c.city_name,
    u.email,
    r.status AS request_status
FROM sens_members m
LEFT JOIN sens_users u ON m.user_id = u.id
LEFT JOIN sens_zones z ON m.zone_id = z.zone_id
LEFT JOIN sens_cities c ON m.city_id = c.city_id
LEFT JOIN sens_requests r ON r.member_id = m.member_id
ORDER BY m.fullname ASC
");

$i = 1;
while($row = mysqli_fetch_assoc($res)){

    $redClass = ($row['mstatus'] == 0) ? "table-danger" : "";
?>
<tr id="memberRow<?= $row['member_id'] ?>" class="<?= $redClass ?>">
    <td><?= $row["member_id"] ?></td>
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['zone_name']) ?></td>
    <td><?= htmlspecialchars($row['city_name']) ?></td>
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

  </div>
</div>

</main>





<?php
include("footer.php");

?>
