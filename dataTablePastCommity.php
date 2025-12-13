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

    <div class="card shadow-lg border-0">

        <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
            <span><i class="bi bi-people-fill me-2"></i> Past Committee</span>
            <a href="addPastCommitte.php">
                <button class="btn btn-success btn-sm">+ Add Past Commity Member</button>
            </a>
        </div>

       <div class="card-body">
        <div class="table-responsive mobile-table">

            <table class="table table-bordered table-hover align-middle text-center" id="myTable">

                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Post</th>
                        <th>Zone</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
<?php
$res = mysqli_query($con,"
SELECT 
    c.*,
    z.zone_name,
    ci.city_name
FROM sens_past_commity c
LEFT JOIN sens_zones z ON c.comi_zone = z.zone_id
LEFT JOIN sens_cities ci ON c.comi_city = ci.city_id
ORDER BY c.comi_name ASC
");

$i = 1;
while($row = mysqli_fetch_assoc($res)){
?>
<tr id="row<?= $row['comi_id'] ?>">
    <td><?= $i++ ?></td>

    <td>
        <img src="upload/committee/<?= $row['comi_img'] ?>" width="50" height="50" class="rounded-circle">
    </td>

    <td><?= $row['comi_name'] ?></td>
    <td><?= $row['comi_gender'] ?></td>
    <td><?= $row['comi_post'] ?></td>
    <td><?= $row['zone_name'] ?></td>
    <td><?= $row['city_name'] ?></td>

    <td>
        <button title="Edit" class="btn btn-sm btn-primary"
onclick="openComiEdit(
<?= $row['comi_id'] ?>,
'<?= $row['comi_name'] ?>',
'<?= $row['comi_gender'] ?>',
'<?= $row['comi_post'] ?>',
'<?= $row['comi_address'] ?>',
<?= $row['comi_zone'] ?>,
<?= $row['comi_city'] ?>,
'<?= $row['comi_priority'] ?>',
'<?= $row['comi_duration'] ?>'
)"><i class="bi bi-pencil"></i></button>


        <button title="Delete" class="btn btn-sm btn-danger"
        onclick="deleteComi(<?= $row['comi_id'] ?>)">
        <i class="bi bi-trash"></i></button>
    </td>
</tr>
<?php } ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- ✅ EDIT MODAL -->
<div class="modal fade" id="editComiModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5>Edit Committee Member</h5>
      </div>

      <div class="modal-body">
        <input type="hidden" id="edit_id">

        <div class="row">

          <div class="col-md-6 mb-3">
            <label>Name</label>
            <input type="text" id="edit_name" class="form-control">
          </div>

          <div class="col-md-6 mb-3">
            <label>Gender</label>
            <select id="edit_gender" class="form-select">
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>



          <label for="">Post/Designation</label>
          <select id="edit_post" class="form-select">
 <option value="Sabhapati">Sabhapati</option>
    <option value="Karya Adhyaksh">Karya Adhyaksh</option>
    <option value="Sah Sabhapati">Sah Sabhapati</option>
     <option value="Mahamantri">Mahamantri</option>
     <option value="Sah Mantri">Sah Mantri</option>
  <option value="Koshadhyaksh">Koshadhyaksh</option>
    <option value="Karyakarini">Karyakarini</option>
</select>


          <div class="col-md-6 mb-3">
            <label>Zone</label>
            <select id="edit_zone" class="form-select" onchange="loadComiCities(this.value)">
              <?php
$z = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);
              while($r=mysqli_fetch_assoc($z)){
              ?>
                <option value="<?= $r['zone_id'] ?>"><?= $r['zone_name'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label>City</label>
            <select id="edit_city" class="form-select"></select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Priority</label>
            <input type="number"  id="edit_priority" class="form-control"></select>
          </div>

          <div class="col-md-6 mb-3">
            <label>Duration</label>
            <input type="text" id="edit_duration" class="form-control"></select>
          </div>

          <div class="col-md-12 mb-3">
            <label>Address</label>
            <textarea id="edit_address" class="form-control"></textarea>
          </div>

           <div class="col-md-12 mb-3">
            <label>Photo</label>
           <input type="file" id="edit_photo" class="form-control"></select>

          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateComi()">Update</button>
      </div>

    </div>
  </div>
</div>

</div>
</main>

<script>
function openComiEdit(id,name,gender,post,address,zone,city,priority,duration){
    $("#edit_id").val(id);
    $("#edit_name").val(name);
    $("#edit_gender").val(gender);
    $("#edit_post").val(post);
    $("#edit_address").val(address);
    $("#edit_zone").val(zone);
        $("#edit_priority").val(priority);
    $("#edit_duration").val(duration);


    loadComiCities(zone, city);

    $("#editComiModal").modal("show");
}

function loadComiCities(zone, selectedCity = ""){
    $.post("loadCities.php",{zone_id:zone},function(res){
        $("#edit_city").html(res);
        if(selectedCity!=""){
            $("#edit_city").val(selectedCity);
        }
    });
}


function updateComi() {

    let formData = new FormData();
    formData.append("id", $("#edit_id").val());
    formData.append("name", $("#edit_name").val());
    formData.append("gender", $("#edit_gender").val());
    formData.append("post", $("#edit_post").val());
    formData.append("priority", $("#edit_priority").val());
    formData.append("duration", $("#edit_duration").val());
    formData.append("address", $("#edit_address").val());
    formData.append("zone", $("#edit_zone").val());
    formData.append("city", $("#edit_city").val());

    // ADD PHOTO
    let file = $("#edit_photo")[0].files[0];
    if (file) {
        formData.append("photo", file);
    }

    $.ajax({
        url: "updatePastComi.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(res){
            if(res.trim() == "success"){
                alert("Committee Updated");
                location.reload();
            } else {
                alert("Update Failed: " + res);
            }
        }
    });
}


function deleteComi(id){
    if(confirm("Delete this member?")){
        $.post("deletepastComi.php",{id:id},function(res){
            if(res.trim()=="success"){
                $("#row"+id).fadeOut();
            }else{
                alert("Delete Failed");
            }
        });
    }
}
</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
