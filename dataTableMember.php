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
            <span><i class="bi bi-people-fill me-2"></i> Manage Members</span>
            <a href="adminRegisForm.php">
                <button class="btn btn-success btn-sm">+ Add Member</button>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive mobile-table">
                <table class="table table-bordered table-hover align-middle text-center" id="myTable">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Zone</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
<?php
$res = mysqli_query($con,"
SELECT 
    m.*,
    z.*,
    c.*,
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
?>
<tr id="memberRow<?= $row['member_id'] ?>">
    <td><?= $i++ ?></td>
    <td><?= htmlspecialchars($row['fullname']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['zone_name']) ?></td>
    <td><?= htmlspecialchars($row['city_name']) ?></td>
    <td>
        <!-- Edit Button -->
       <button title="Edit" class="btn btn-sm btn-primary"
onclick="openMemberEditModal(
<?= $row['member_id'] ?>,
'<?= addslashes($row['fullname']) ?>',
'<?= $row['phone'] ?>',
'<?= $row['gender'] ?>',
'<?= $row['dob'] ?>',
'<?= $row['address'] ?>',
'<?= $row['membership_start'] ?>',
'<?= $row['membership_end'] ?>',
<?= $row['zone_id'] ?>,
<?= $row['city_id'] ?>,
<?= $row['plan_id'] ?>
)">
<i class="bi bi-pencil"></i>
</button>


        <!-- Delete Button -->
        <button title="Delete" class="btn btn-sm btn-danger"
            onclick="deleteMember(<?= $row['member_id'] ?>)">
            <i class="bi bi-trash"></i>
        </button>

        <!-- Activate / Deactivate Button -->
        <?php if($row['request_status']=='rejected'){ ?>
            <button title="Activate" class="btn btn-sm btn-success activateBtn"
                data-member="<?= $row['member_id'] ?>" data-user="<?= $row['user_id'] ?>">
                <i class="bi bi-check"></i>
            </button>
        <?php } else if($row['request_status']=='approved'){ ?>
            <button title="Deactivate" class="btn btn-sm btn-danger deactivateBtn"
                data-member="<?= $row['member_id'] ?>" data-user="<?= $row['user_id'] ?>">
                <i class="bi bi-x"></i>
            </button>
        <?php } ?>

         <!-- New / Old button -->
<?php if($row['mstatus'] == 1){ ?>
    <button class="btn btn-sm btn-info"
            onclick="updateMemberStatus(<?= $row['member_id'] ?>,0)">
        N
    </button>
<?php } else { ?>
    <button class="btn btn-sm btn-warning"
            onclick="updateMemberStatus(<?= $row['member_id'] ?>,1)">
        O
    </button>
<?php } ?>

    </td>
</tr>
<?php } ?>
                    </tbody>

                    <tfoot class="table-secondary fw-bold">
                        <tr>
                            <td colspan="6" class="text-end">Total Members</td>
                            <td><?= $i-1 ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>

<!-- EDIT MEMBER MODAL -->
<div class="modal fade" id="memberEditModalUnique">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning">
        <h5>Edit Member</h5>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit_member_id">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label>Full Name</label>
            <input type="text" id="edit_fullname" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Phone</label>
            <input type="number" id="edit_phone" class="form-control" placeholder="Phone Number" required oninput="if(this.value.length>10)this.value=this.value.slice(0,10);">
          </div>
          <div class="col-md-6 mb-3">
            <label>Gender</label>
            <select id="edit_gender" class="form-select">
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
          <div class="col-md-6 mb-3">
            <label>DOB</label>
            <input type="date" id="edit_dob" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Membership Start</label>
            <input type="date" id="edit_start" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Membership End</label>
            <input type="date" id="edit_end" class="form-control">
          </div>
          <div class="col-md-6 mb-3">
            <label>Zone</label>
            <select id="edit_zone" class="form-select" onchange="loadMemberCities(this.value)">
              <option value="">Select Zone</option>
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
          <div class="col-md-12 mb-3">
            <label>Plan</label>
            <select id="edit_plan" class="form-select">
              <?php
              $p=mysqli_query($con,"SELECT * FROM sens_plans");
              while($pl=mysqli_fetch_assoc($p)){
              ?>
                <option value="<?= $pl['plan_id'] ?>"><?= $pl['name'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-12 mb-3">
            <label>Address</label>
            <textarea id="edit_address" class="form-control"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateMemberUnique()">Update</button>
      </div>
    </div>
  </div>
</div>

</main>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function openMemberEditModal(id,name,phone,gender,dob,address,start,end,zone,city,plan){
    $("#edit_member_id").val(id);
    $("#edit_fullname").val(name);
    $("#edit_phone").val(phone);
    $("#edit_gender").val(gender);
    $("#edit_dob").val(dob);
    $("#edit_address").val(address);
    $("#edit_start").val(start);
    $("#edit_end").val(end);
    $("#edit_plan").val(plan);
    $("#edit_zone").val(zone);
    loadMemberCities(zone, city);
    $("#memberEditModalUnique").modal("show");
}


function loadMemberCities(zone, selectedCity = ""){
    $.post("loadCities.php",{zone_id:zone},function(res){
        $("#edit_city").html(res);
        if(selectedCity!=""){
            $("#edit_city").val(selectedCity);
        }
    });
}

function updateMemberUnique(){
    $.post("updateMember.php",{
        id: $("#edit_member_id").val(),
        fullname: $("#edit_fullname").val(),
        phone: $("#edit_phone").val(),
        gender: $("#edit_gender").val(),
        dob: $("#edit_dob").val(),
        address: $("#edit_address").val(),
        start: $("#edit_start").val(),
        end: $("#edit_end").val(),
        zone: $("#edit_zone").val(),
        city: $("#edit_city").val(),
        plan: $("#edit_plan").val()
    },function(res){
        if(res.trim()=="success"){
            alert("Member Updated");
            location.reload();
        }else{
            alert("Update Failed");
        }
    });
}

function deleteMember(id){
    if(confirm("Delete this member?")){
        $.post("deleteMember.php",{id:id},function(res){
            if(res.trim()=="success"){
                $("#memberRow"+id).fadeOut();
            }else{
                alert("Delete Failed");
            }
        });
    }
}

$(document).ready(function(){
    $(document).on("click", ".activateBtn", function(){
        let memberId = $(this).data("member");
        let userId = $(this).data("user");
        if(confirm("Activate this member?")){
            $.post("memberAction.php",{action:"activate", member_id:memberId, user_id:userId}, function(res){
                alert(res);
                location.reload();
            });
        }
    });

    $(document).on("click", ".deactivateBtn", function(){
        let memberId = $(this).data("member");
        let userId = $(this).data("user");
        if(confirm("Deactivate this member?")){
            $.post("memberAction.php",{action:"deactivate", member_id:memberId, user_id:userId}, function(res){
                alert(res);
                location.reload();
            });
        }
    });
});

function updateMemberStatus(id,status){
    $.post("updateMemberStatus.php",{member_id:id, mstatus:status},function(res){
        if(res.trim()=="success"){
            location.reload();
        }else{
            alert("Status update failed!");
        }
    });
}

</script>

<?php
include("footer.php");
}else{
    include("index.php");
}
?>
