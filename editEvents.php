
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
         <h4 class="mb-4">All Events</h4>

<div class="card shadow">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-warning">
                <tr>
                    <th>#</th>
                    <th>Event Title</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $i=1;
            $q = mysqli_query($con,"SELECT * FROM events ORDER BY event_id DESC");
            while($row = mysqli_fetch_assoc($q)){
            ?>
                <tr>
                    <td><?= $i++ ?></td>
                    <td><?= $row['title'] ?></td>
                    <td>
                        <?=$row['event_status']?>
                    </td>
                    <td><?= $row['event_date'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                        onclick="editEvent(<?= $row['event_id'] ?>)">
                        Edit</button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

    </div>
</div>

<div class="modal fade" id="editEventModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 class="modal-title">Edit Event</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input type="hidden" id="edit_event_id">

        <div class="row">
          <div class="col-md-6 mb-2">
            <label>Title</label>
            <input type="text" id="edit_title" class="form-control">
          </div>

          <div class="col-md-6 mb-2">
            <label>Status</label>
            <select id="edit_status" class="form-select">
           <option value="upcoming">Upcoming</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
            </select>
          </div>

          <div class="col-md-6 mb-2">
            <label>Event Date</label>
            <input type="date" id="edit_date" class="form-control">
          </div>

          <div class="col-md-6 mb-2">
            <label>Event Time</label>
            <input type="time" id="edit_time" class="form-control">
          </div>

          <div class="col-md-12 mb-2">
            <label>Event Location</label>
            <input type="text" id="edit_location" class="form-control">
          </div>

          <div class="col-md-12 mb-2">
            <label>Description</label>
            <textarea id="newsText" class="form-control"></textarea>
          </div>

          <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 


          <div class="col-md-6 mb-2">
    <label class="fw-semibold">Show Event To</label>
    <select id="edit_toshow_type" class="form-select" onchange="editTargetSelect()" required>
        <option value="all">All Members</option>
        <option value="zone">Specific Zone</option>
        <option value="city">Specific City</option>
        <option value="member">Specific Member</option>
    </select>
</div>

<!-- ZONE SELECT -->
    <div class="mb-3 d-none" id="zoneBox">
        <label class="form-label">Select Zone</label>
        <select name="toshow_zone" class="form-select">
            <option value="">Select Zone</option>
            <?php
            $z = mysqli_query($con,"SELECT * FROM zones ORDER BY zone_name ASC");
            while($row = mysqli_fetch_assoc($z)){
            ?>
                <option value="<?= $row['zone_id'] ?>"><?= $row['zone_name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- CITY SELECT -->
    <div class="mb-3 d-none" id="cityBox">
        <label class="form-label">Select City</label>
        <select name="toshow_city" class="form-select">
            <option value="">Select City</option>
            <?php
            $c = mysqli_query($con,"SELECT * FROM cities ORDER BY city_name ASC");
            while($row = mysqli_fetch_assoc($c)){
            ?>
                <option value="<?= $row['city_id'] ?>"><?= $row['city_name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <!-- MEMBER SELECT -->
    <div class="mb-3 d-none" id="memberBox">
        <label class="form-label">Select Member</label>
        <select name="toshow_member" class="form-select">
            <option value="">Select Member</option>
            <?php
            $m = mysqli_query($con,"SELECT member_id, fullname FROM members ORDER BY fullname ASC");
            while($row = mysqli_fetch_assoc($m)){
            ?>
                <option value="<?= $row['member_id'] ?>"><?= $row['fullname'] ?></option>
            <?php } ?>
        </select>
    </div>
</div>


      <div class="modal-footer">
        <button class="btn btn-success" onclick="updateEvent()">Update Event</button>
      </div>

      <div id="eventMsg"></div>

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
