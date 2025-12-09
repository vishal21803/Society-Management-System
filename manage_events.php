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
                                <th>Event Title</th>
                                <th>Status</th>
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
                                <td><?= $row['title'] ?></td>

                                <td>
                                    <span class="badge 
                                        <?= $row['event_status']=='upcoming'?'bg-primary':
                                            ($row['event_status']=='completed'?'bg-success':'bg-danger') ?>">
                                        <?= ucfirst($row['event_status']) ?>
                                    </span>
                                </td>

                                <td><?= date("d-m-Y", strtotime($row['event_date'])) ?></td>

                                <td>
                                    <button class="btn btn-sm btn-success" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal<?= $eid ?>">
                                        Edit
                                    </button>

                                    <button class="btn btn-sm btn-danger"
                                        onclick="deleteEvent(<?= $eid ?>)">
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- ================= EDIT EVENT MODAL ================ -->
                            <div class="modal fade" id="editModal<?= $eid ?>" tabindex="-1">
                              <div class="modal-dialog modal-lg">
                                <div class="modal-content">

                                  <form method="POST" action="update_event.php">

                                    <input type="hidden" name="event_id" value="<?= $eid ?>">

                                    <div class="modal-header bg-warning">
                                      <h5 class="modal-title">Edit Event</h5>
                                      <button class="btn-close" data-bs-dismiss="modal"></button>
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
                                                <label>Status</label>
                                                <select name="event_status" class="form-select">
                                                    <option value="upcoming"   <?= $row['event_status']=='upcoming'?'selected':'' ?>>Upcoming</option>
                                                    <option value="completed"  <?= $row['event_status']=='completed'?'selected':'' ?>>Completed</option>
                                                    <option value="cancelled"  <?= $row['event_status']=='cancelled'?'selected':'' ?>>Cancelled</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Event Date</label>
                                                <input type="date" name="event_date" 
                                                       value="<?= $row['event_date'] ?>" 
                                                       class="form-control">
                                            </div>

                                            <div class="col-md-6 mb-2">
                                                <label>Event Time</label>
                                                <input type="text" name="event_time" 
                                                       value="<?= $row['event_time'] ?>" 
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

                                            <div class="col-md-12 mb-2">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control"><?= $row['description'] ?></textarea>
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
</main>



<?php
include("footer.php");
} else {
    include("index.php");
}
?>
