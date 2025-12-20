<?php 
@session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin') {

include("header.php");
include("connectdb.php");
?>

<main>
<div class="d-flex flex-column flex-lg-row">
    <?php include('adminDashboard.php'); ?>

    <div class="flex-grow-1 p-4">

        <div class="card shadow border-0">

            <div class="card-header bg-warning fw-bold text-dark d-flex justify-content-between align-items-center">
                <span><i class="bi bi-calendar-event me-2"></i> Manage Events</span>
                <a href="eventForm.php" class="btn btn-success btn-sm">+ Add Event</a>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Event Title</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 1;
                            $q = mysqli_query($con,"SELECT * FROM sens_events ORDER BY event_id DESC");
                            while($row = mysqli_fetch_assoc($q)){
                            $eid = $row['event_id'];
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                 <td>
                                    <?php if($row['event_img']) { ?>
                                        <button title="View" class="btn btn-sm btn-info viewImageBtn"
                                            data-src="upload/events/<?= $row['event_img'] ?>">
                                            <i class="bi bi-eye-fill"></i>

                                        </button>
                                    <?php } else { ?>
                                        <span class="text-muted">No Image</span>
                                    <?php } ?>
                                </td>
                                <td><?= $row['title'] ?></td>

                              

                                <td><?= date("d-m-Y", strtotime($row['event_date'])) ?></td>

                                <td>
                                    <button title="Edit" class="btn btn-sm btn-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal<?= $eid ?>">
                                        <i class="bi bi-pencil"></i>
                                    </button>

                                    <button title="Delete" class="btn btn-sm btn-danger"
                                        onclick="deleteEvent(<?= $eid ?>)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- ================= EDIT EVENT MODAL ================ -->
                            <div class="modal fade" id="editModal<?= $eid ?>" tabindex="-1">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                  <form method="POST" action="update_event.php"  enctype="multipart/form-data">

                                    <input type="hidden" name="event_id" value="<?= $eid ?>">

                                    <div class="modal-header bg-warning">
                                      <h5 class="modal-title">Edit Event</h5>
                                      <!-- <button class="btn-close" data-bs-dismiss="modal"></button> -->
                                    </div>

                                    <div class="modal-body">
                                        <div class="row">

                                            <div class="col-md-6 mb-2">
                                                <label>Title</label>
                                                <input type="text" name="title" 
                                                    value="<?= $row['title'] ?>" 
                                                    class="form-control">
                                            </div>

                                           

                                            <div class="col-md-6 mb-2">
                                                <label>Event Date</label>
                                                <input type="date" name="event_date" 
                                                       value="<?= $row['event_date'] ?>" 
                                                       class="form-control">
                                            </div>



                                            <div class="col-md-12 mb-2">
                                                <label>Location</label>
                                                <input type="text" name="event_location" 
                                                       value="<?= $row['event_location'] ?>" 
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-12 mb-2">
                                                <label>YouTube Link</label>
                                                <input type="text" name="youtube_link" 
                                                       value="<?= $row['video_link'] ?>" 
                                                       class="form-control">
                                            </div>

                                            <label class="form-check-label ms-1" for="showFront">
    Do you want to show on Front Page?
</label>

<input type="hidden" name="show_front" value="0"> <!-- default -->

<input type="checkbox" 
       class="form-check-input ms-2"
       id="showFront"
       name="show_front"
       value="1"
       <?php if($row['event_front'] == 1){ echo "checked"; } ?> >



                                            <div class="col-md-12 mb-2">
                                                <label>Description</label>
<textarea name="description" class="form-control" rows="6"><?= $row['description'] ?></textarea>
                                            </div>

                                              <label for="">Visible to</label>
        <select id="edit_toshow_type" name="toshow_type" class="form-control mb-2"  onchange="editTargetSelect()">
            <option value="all">All</option>
            <option value="zone">Zone</option>
            <option value="city">City</option>
            <option value="member">Member</option>
        </select>

        <input type="hidden" name="toshow_id" id="final_toshow_id" value="0">

<!-- ZONE -->
<div class="mb-3 d-none" id="zoneBox">
  <label>Select Zone</label>
  <select class="form-select" onchange="setTarget(this.value)">
    <?php
$z = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);
    while($row = mysqli_fetch_assoc($z)){ ?>
      <option value="<?= $row['zone_id'] ?>"><?= $row['zone_name'] ?></option>
    <?php } ?>
  </select>
</div>

<!-- CITY -->
<div class="mb-3 d-none" id="cityBox">
  <label>Select City</label>
  <select class="form-select" onchange="setTarget(this.value)">
    <?php
    $c = mysqli_query($con,"SELECT * FROM sens_cities where cstatus=1");
    while($row = mysqli_fetch_assoc($c)){ ?>
      <option value="<?= $row['city_id'] ?>"><?= $row['city_name'] ?></option>
    <?php } ?>
  </select>
</div>

<!-- MEMBER -->
<div class="mb-3 d-none" id="memberBox">
  <label>Select Member</label>
  <select class="form-select" onchange="setTarget(this.value)">
    <?php
    $m = mysqli_query($con,"SELECT member_id, fullname FROM sens_members");
    while($row = mysqli_fetch_assoc($m)){ ?>
      <option value="<?= $row['member_id'] ?>"><?= $row['fullname'] ?></option>
    <?php } ?>
  </select>
</div>

                                             <!-- IMAGE UPLOAD -->
                        <div class="mb-4 animate__animated animate__zoomIn">
                            <label class="form-label fw-semibold">Event Poster</label>
                            <div class="upload-box" onclick="document.getElementById('fileInput').click()">
                                <i class="bi bi-cloud-upload fs-2"></i>
                                <p class="mb-0">Click to Upload</p>
                                <img id="previewImg" style="width:250px;height:200px;">
                            </div>
                            <input type="file" id="fileInput" name="event_img" hidden onchange="previewImage(event)">
                        </div>

                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success" type="submit">Update Event</button>
                                    </div>

                                  </form>

                                </div>
                              </div>
                            </div>
                            <!-- ================= END EDIT MODAL ================ -->

                            <?php } ?>
                        </tbody>

                    </table>
                </div>

            </div>

        </div>

    </div>
</div>


<!-- ✅ IMAGE VIEW MODAL (UNCHANGED, CLEAN LOOK) -->
<div class="modal fade" id="imageViewModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">Image</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center">
        <img id="fullImagePreview" src="" class="img-fluid rounded shadow">
      </div>

    </div>
  </div>
</div>
</main>

<script>
    function editTargetSelect(){
  let type = document.getElementById("edit_toshow_type").value;

  document.getElementById("zoneBox").classList.add("d-none");
  document.getElementById("cityBox").classList.add("d-none");
  document.getElementById("memberBox").classList.add("d-none");

  document.getElementById("final_toshow_id").value = 0;

  if(type === "zone") document.getElementById("zoneBox").classList.remove("d-none");
  if(type === "city") document.getElementById("cityBox").classList.remove("d-none");
  if(type === "member") document.getElementById("memberBox").classList.remove("d-none");
}

function setTarget(val){
  document.getElementById("final_toshow_id").value = val;
}

</script>

<?php
include("footer.php");
} else {
    include("index.php");
}
?>
