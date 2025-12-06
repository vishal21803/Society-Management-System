<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin') {
    include("header.php");
    include("connectdb.php");
?>
<div class="d-flex" style="min-height:100vh;">

    <!-- Sidebar -->
    <?php
     include('adminDashboard.php'); 
    include("connectdb.php");
    ?>

    <!-- Main content -->
    <div class="flex-grow-1 p-4 bg-light" style="background: #fff8f0;">

        <div class="container-fluid">

            <h2 class="mb-4 text-warning fw-bold">Manage Locations</h2>
          <div id="zoneMessage" class="mt-3"></div>
          <div id="cityMessage" class="mt-3"></div>


            <!-- Tabs -->
            <ul class="nav nav-pills mb-4" id="locationTabs" role="tablist">
                <li class="nav-item me-2" role="presentation">
                    <!-- <button class="nav-link active bg-warning text-dark" id="state-tab" data-bs-toggle="tab" data-bs-target="#stateForm" type="button">Add State</button> -->
                </li>
                <li class="nav-item me-2" role="presentation">
                    <button class="nav-link bg-warning text-dark" id="zone-tab" data-bs-toggle="tab" data-bs-target="#zoneForm" type="button">Add Zone</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link bg-warning text-dark" id="city-tab" data-bs-toggle="tab" data-bs-target="#cityForm" type="button">Add City</button>
                </li>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link bg-warning text-dark ms-2" id="editZ-tab" data-bs-toggle="tab" data-bs-target="#editZone" type="button">Manage Zone</button>
                </li>
                 <li class="nav-item" role="presentation">
                    <button class="nav-link bg-warning text-dark ms-2" id="editC-tab" data-bs-toggle="tab" data-bs-target="#editCity" type="button">Manage City</button>
                </li>
            </ul>

            <div class="tab-content">

                <!-- STATE FORM -->
                <!-- <div class="tab-pane fade show active" id="stateForm">
                    <div class="card shadow-sm mb-4 border-warning">
                        <div class="card-header bg-warning text-dark fw-bold">Add State</div>
                        <div class="card-body">
                            <form id="stateFormAjax">
                                <div class="mb-3">
                                    <label class="form-label">State Name</label>
                                    <input type="text" name="state_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Save State</button>
                            </form>
                            <div id="stateMessage" class="mt-2"></div>
                        </div>
                    </div>
                </div> -->

                <!-- ZONE FORM -->
                <div class="tab-pane fade" id="zoneForm">
                    <div class="card shadow-sm mb-4 border-warning">
                        <div class="card-header bg-warning text-dark fw-bold">Add Zone</div>
                        <div class="card-body">
                            <form id="zoneFormAjax">
                                <!-- <div class="mb-3">
                                    <label class="form-label">Select State</label>
                                    <select id="zoneStateDropdown" name="state_id" class="form-select" required>
                                        <option value="">Select State</option>
                                        <?php
                                        $res = mysqli_query($con,"SELECT * FROM states ORDER BY state_name ASC");
                                        while($row = mysqli_fetch_array($res)){
                                            echo "<option value='{$row['state_id']}'>{$row['state_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div> -->
                                <div class="mb-3">
                                    <label class="form-label">Zone Name</label>
                                    <input type="text" name="zone_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Save Zone</button>
                            </form>
                            <div id="zoneMessage" class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- CITY FORM -->
                <div class="tab-pane fade" id="cityForm">
                    <div class="card shadow-sm mb-4 border-warning">
                        <div class="card-header bg-warning text-dark fw-bold">Add City</div>
                        <div class="card-body">
                            <form id="cityFormAjax">
                                <!-- <div class="mb-3">
                                    <label class="form-label">Select State</label>
                                    <select id="stateDropdown" class="form-select" onchange="loadZones();" required>
                                        <option value="">Select State</option>
                                        <?php
                                            $res2 = mysqli_query($con,"SELECT * FROM states ORDER BY state_name ASC");
                                            while($row2 = mysqli_fetch_array($res2)){
                                                echo "<option value='{$row2['state_id']}'>{$row2['state_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div> -->
                                <div class="mb-3">
                                    <label class="form-label">Select Zone</label>
                                    <select id="zoneDropdown" name="zone_id" class="form-select" required>
                                        <option value="">Select Zone</option>
                                         <?php
                                            $res2 = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
                                            while($row2 = mysqli_fetch_array($res2)){
                                                echo "<option value='{$row2['zone_id']}'>{$row2['zone_name']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">City Name</label>
                                    <input type="text" name="city_name" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-warning">Save City</button>
                            </form>
                            <div id="cityMessage" class="mt-2"></div>
                        </div>
                    </div>
                </div>

                <!-- ================= ZONE & CITY LIST SECTION ================= -->



<!-- ================= ZONE LIST SECTION ================= -->

<!-- ================= ZONE FILTER OPTIONS ================= -->
<div class="row mt-4 g-2 d-none" id="searchZoneBtn" >
    <div class="col-md-6">
        <input type="text" id="searchZone" class="form-control"
               placeholder="🔍 Search Zone Name..." onkeyup="filterZones()">
    </div>

    <div class="col-md-3">
        <select id="sortZone" class="form-select" onchange="filterZones()">
            <option value="">Sort Alphabet</option>
            <option value="asc">A → Z</option>
            <option value="desc">Z → A</option>
        </select>
    </div>
</div>

<div id="zoneListSection" class="mt-4 d-none animate__animated animate__fadeInUp">

    <div class="card border-warning shadow-sm">
        <div class="card-header bg-warning fw-bold text-dark">
            All Zones
        </div>
        <div class="card-body table-responsive scroll-table-box">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Zone Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="zoneList">
                    <?php
                    $resZ = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
                    $i=1;
                    while($z = mysqli_fetch_assoc($resZ)){
                    ?>
                    <tr id="zoneRow<?= $z['zone_id'] ?>">
                        <td><?= $i++ ?></td>
                        <td><?= $z['zone_name'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="editZone(<?= $z['zone_id'] ?>,'<?= $z['zone_name'] ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteZone(<?= $z['zone_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- ================= CITY LIST SECTION ================= -->
 <!-- ================= CITY FILTER OPTIONS ================= -->
<div class="row mt-4 g-2 d-none" id="searchCityBtn">

    <div class="col-md-4">
        <input type="text" id="searchCity" class="form-control"
               placeholder="🔍 Search City..." onkeyup="filterCities()">
    </div>

    <div class="col-md-4">
        <select id="filterZone" class="form-select" onchange="filterCities()">
            <option value="">All Zones</option>
            <?php
            $zres = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
            while($z = mysqli_fetch_assoc($zres)){
            ?>
                <option value="<?= $z['zone_id'] ?>">
                    <?= $z['zone_name'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-4">
        <select id="sortCity" class="form-select" onchange="filterCities()">
            <option value="">Sort Alphabet</option>
            <option value="asc">A → Z</option>
            <option value="desc">Z → A</option>
        </select>
    </div>

</div>

<div id="cityListSection" class="mt-4 d-none animate__animated animate__fadeInUp">

    <div class="card border-warning shadow-sm">
        <div class="card-header bg-warning fw-bold text-dark">
            All Cities
        </div>
        <div class="card-body table-responsive scroll-table-box">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>Zone</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="cityList">
                    <?php
                    $resC = mysqli_query($con,"
                        SELECT c.city_id, c.city_name, z.zone_name 
                        FROM cities c 
                        JOIN zones z ON c.zone_id = z.zone_id
                        ORDER BY c.city_name ASC
                    ");
                    $i=1;
                    while($c = mysqli_fetch_assoc($resC)){
                    ?>
                    <tr id="cityRow<?= $c['city_id'] ?>">
                        <td><?= $i++ ?></td>
                        <td><?= $c['city_name'] ?></td>
                        <td><?= $c['zone_name'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-success" onclick="editCity(<?= $c['city_id'] ?>,'<?= $c['city_name'] ?>')">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteCity(<?= $c['city_id'] ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


       <!-- ZONE UPDATE MODAL -->
<div class="modal fade" id="zoneModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5>Edit Zone</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editZoneId">
        <input type="text" id="editZoneName" class="form-control">
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateZone()">Update</button>
      </div>
    </div>
  </div>
</div>

<!-- CITY UPDATE MODAL -->
<div class="modal fade" id="cityModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5>Edit City</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editCityId">
        <input type="text" id="editCityName" class="form-control">
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateCity()">Update</button>
      </div>
    </div>
  </div>
</div>
            <div class="row mt-4">

    <!-- ZONE LIST -->
  

        </div>
    </div>



    <!-- CITY LIST -->
    


            </div>

        </div>

    </div>
</div>

<script>
function showForm(id){
    var tabEl = new bootstrap.Tab(document.querySelector('#' + id + '-tab'));
    tabEl.show();
}
</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
