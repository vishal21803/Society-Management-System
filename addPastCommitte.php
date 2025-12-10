<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin'){
include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">
<?php include("adminDashboard.php"); ?>

<div class="flex-grow-1 p-4">

<div class="card shadow-lg border-0">
<div class="card-header bg-warning fw-bold">➕ Add Past Committee Member</div>

<div class="card-body">

<form method="POST" action="insertPastComi.php" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">
<label>Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="col-md-6 mb-3">
<label>Gender</label>
<select name="gender" class="form-select" required>
<option value="">Select</option>
<option>Male</option>
<option>Female</option>
</select>
</div>

<div class="col-md-6 mb-3">
  <label>Post / Designation</label>
  <select name="post" class="form-select" required>
    <option value="">Select Post</option>
    <option value="Sabhapati">Sabhapati</option>
    <option value="Karya Adhyaksh">Karya Adhyaksh</option>
    <option value="Sah Sabhapati">Sah Sabhapati</option>
     <option value="Mahamantri">Mahamantri</option>
     <option value="Sah Mantri">Sah Mantri</option>
  <option value="Koshadhyaksh">Koshadhyaksh</option>
    <option value="Karyakarini">Karyakarini</option>
    

  </select>
</div>

<div class="col-md-6 mb-3">
            <label>Priority</label>
            <input type="text"  name="priority" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Duration</label>
            <input type="text" name="duration" class="form-control">
          </div>



<div class="col-md-6 mb-3">
<label>Photo</label>
<input type="file" name="img" class="form-control" required>
</div>
   <!-- ✅ Zone -->
                <div class="mb-3">
                    <label class="fw-bold">Zone</label>
                    <select name="zone" id="zoneDropdown" class="form-select" required onchange="loadCities()">
                        <option value="">-- Select Zone --</option>
                        <?php
                        $rs = mysqli_query($con,"SELECT * FROM sens_zones where zstatus=1 ORDER BY zone_name ASC");
                        while($z = mysqli_fetch_assoc($rs)){
                            echo "<option value='{$z['zone_id']}'>{$z['zone_name']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- ✅ City -->
                <div class="mb-3">
                    <label class="fw-bold">City</label>
                    <select name="city" id="cityDropdown" class="form-select" required>
                        <option value="">-- Select City --</option>
                    </select>
                </div>
                  

<div class="col-md-12 mb-3">
<label>Address</label>
<textarea name="address" class="form-control" required></textarea>
</div>

<button class="btn btn-success">✅ Save Committee</button>

</div>
</form>

</div>
</div>
</div>
</div>
</main>

<script>
function loadCities(zone){
$.post("loadCities.php",{zone_id:zone},function(res){
$("#city").html(res);
});
}
</script>

<?php include("footer.php"); } else { include("index.php"); } ?>
