
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='admin')
{
include("header.php");
?>

<main>
<div class="d-flex ">
    <?php 
    include('adminDashboard.php'); 
    include("connectdb.php");
    ?>
    <div class="flex-grow-1 my-3">
        
    <div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card  animate__animated animate__fadeInUp">

                <!-- HEADER -->
                <div class="event-header text-center">
                    <h4 class="mb-0"><i class="bi bi-calendar-event"></i> Add New Event</h4>
                </div>

                <!-- BODY -->
                <div class="card-body ">

                    <form id="eventForm"  enctype="multipart/form-data">

                        <!-- EVENT TITLE -->
                        <div class="form-floating mb-3 animate__animated animate__fadeInLeft">
                            <input type="text" class="form-control" name="event_title" placeholder="Event Title" required>
                            <label>Event Title</label>
                        </div>

                        <!-- EVENT DESCRIPTION -->
                        <div class="form-floating mb-3 animate__animated animate__fadeInRight">
                            <textarea id="newsText" class="form-control" style="height:120px" name="event_desc" placeholder="Description" required></textarea>
                            <label>Event Description</label>
                        </div>
                        <button type="button" onclick="hinglishToHindi()" class="btn btn-warning btn-sm">
    Hinglish → Hindi
</button>
<button type="button" onclick="autoTranslateHindi()" class="btn btn-warning btn-sm">
    Translate to Hindi
</button> 


                        <div class="row">
                            <!-- DATE -->
                            <div class="col-md-6 mb-3 animate__animated animate__fadeInLeft">
                                <label class="form-label fw-semibold">Event Date</label>
                                <input type="date" class="form-control" name="event_date" required>
                            </div>

                            <!-- TIME -->
                            <!-- <div class="col-md-6 mb-3 animate__animated animate__fadeInRight">
                                <label class="form-label fw-semibold">Event Time</label>
                                <input type="text" class="form-control" name="event_time" required>
                            </div>
                        </div> -->

                        <!-- LOCATION -->
                        <div class="form-floating mb-3 animate__animated animate__fadeInUp">
                            <input type="text" class="form-control" name="event_location" placeholder="Location" required>
                            <label>Event Location</label>
                        </div>

                        <div class="form-floating mb-3 animate__animated animate__fadeInUp">
                            <input type="text" class="form-control" name="link" placeholder="Event Link" >
                            <label>Event Link</label>
                        </div>


                        <!-- STATUS -->
                        <!-- <div class="mb-3 animate__animated animate__fadeInUp">
                            <label class="form-label fw-semibold">Event Status</label>
                            <select name="event_status" class="form-select">
                                <option value="upcoming">Upcoming</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div> -->

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

                        <!-- ================= EVENT VISIBILITY SECTION ================= -->
<div class="card p-3 mb-4 border-0 shadow-sm animate__animated animate__fadeInUp">
    <h6 class="fw-bold mb-3 text-success">
        <i class="bi bi-eye"></i> Event Visibility
    </h6>

    <!-- Visibility Type -->
    <div class="mb-3">
        <label class="form-label fw-semibold">Show Event To</label>
        <select name="toshow_type" id="toshow_type" class="form-select" onchange="toggleTargetSelect()" required>
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
$z = mysqli_query($con,
    "SELECT * FROM sens_zones 
     WHERE zstatus = 1 
     ORDER BY CAST(REGEXP_SUBSTR(zone_name, '[0-9]+') AS UNSIGNED)"
);
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
            $c = mysqli_query($con,"SELECT * FROM sens_cities where cstatus=1 ORDER BY city_name ASC");
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
            $m = mysqli_query($con,"SELECT member_id, fullname FROM sens_members ORDER BY fullname ASC");
            while($row = mysqli_fetch_assoc($m)){
            ?>
                <option value="<?= $row['member_id'] ?>"><?= $row['fullname'] ?></option>
            <?php } ?>
        </select>
    </div>
</div>


                        <!-- SUBMIT -->
                        <div class="d-grid">
                            <button class="btn btn-lg" style="background:var(--green);color:white;">
                                <i class="bi bi-save"></i> Save Event
                            </button>
                        </div>


                    </form>
                             <div id="eventMsg" class="mt-3"></div>

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
}else{
    include("index.php");
}
?>
