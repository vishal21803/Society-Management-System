
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
         <div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-warning fw-bold text-dark">
            🔍 Search Member
        </div>

        <div class="card-body">
            <input type="text" 
                   id="searchUser" 
                   class="form-control form-control-lg"
                   placeholder="Type member name..."
                   autocomplete="off">
        </div>
    </div>

    <div class="row mt-3 g-2">
    <div class="col-md-3">
        <select id="filter_zone" class="form-select" onchange="loadUsers()">
            <option value="">All Zones</option>
            <?php
            $z = mysqli_query($con,"SELECT * FROM zones");
            while($row=mysqli_fetch_assoc($z)){
            ?>
            <option value="<?= $row['zone_id'] ?>"><?= $row['zone_name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-md-3">
        <select id="filter_city" class="form-select" onchange="loadUsers()">
            <option value="">All Cities</option>
        </select>
    </div>

    <div class="col-md-3">
        <select id="sort_alpha" class="form-select" onchange="loadUsers()">
            <option value="">Sort Alphabet</option>
            <option value="asc">A → Z</option>
            <option value="desc">Z → A</option>
        </select>
    </div>

    <div class="col-md-3">
        <button class="btn btn-dark w-100" onclick="loadUsers()">Apply Filters</button>
    </div>
</div>


    <!-- SEARCH RESULT -->
    <div id="searchResult" class="mt-4"></div>

</div>

    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning text-dark">
        <h5 class="modal-title">Edit User</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="edit_user_id">

        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Full Name</label>
            <input type="text" id="edit_fullname" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Email</label>
            <input type="email" id="edit_email" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Username</label>
            <input type="text" id="edit_uname" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>DOB</label>
            <input type="date" id="edit_dob" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Gender</label>
            <select id="edit_gender" class="form-select">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Zone</label>
<select id="edit_zone" class="form-select" onchange="loadCitiesByZone(this.value)"></select>
          </div>

          <div class="col-md-6 mb-3">
            <label>City</label>
            <select id="edit_city" class="form-select"></select>
          </div>
        </div>

       <div class="mb-3">
    <label>Address</label>
    <textarea id="edit_address" class="form-control" placeholder="Enter address"></textarea>
</div>


        <div id="updateMsg"></div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateUser()">Save Changes</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
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
