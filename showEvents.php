<?php
include("header.php");
include("connectdb.php");

$isLoggedIn = false;
$myZone = 0;
$myCity = 0;
$member_id = 0;

if(isset($_SESSION['member_id'])){
    $isLoggedIn = true;
    $member_id = $_SESSION['member_id'];

    $m = mysqli_query($con,"SELECT zone_id, city_id FROM sens_members WHERE member_id='$member_id'");
    $md = mysqli_fetch_assoc($m);
    $myZone = $md['zone_id'];
    $myCity = $md['city_id'];
}

if($isLoggedIn){
    $eventQuery = mysqli_query($con,"
        SELECT * FROM sens_events
        WHERE
            (
                toshow_type='all' OR
                (toshow_type='zone' AND toshow_id='$myZone') OR
                (toshow_type='city' AND toshow_id='$myCity') OR
                (toshow_type='member' AND toshow_id='$member_id')
            )
        ORDER BY event_id DESC
    ");
}else{
    $eventQuery = mysqli_query($con,"
        SELECT * FROM sens_events
        WHERE toshow_type='all'
        ORDER BY event_id DESC
    ");
}
?>

<style>
/* ===== HERO ===== */
.events-hero{
    background: linear-gradient(135deg, #fff8e1, #ffdd9b);
    padding: 80px 0;
    text-align: center;
}

/* ===== EVENT CARD ===== */
.event-card{
    background: #fff;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    transition: 0.4s ease;
    height: 100%;
}

.event-card:hover{
    transform: translateY(-10px);
}

/* IMAGE */
.event-img{
    width: 100%;
    height: 180px;
    object-fit: cover;
}

/* CONTENT */
.event-body{
    padding: 20px;
}

.event-title{
    font-size: 22px;
    font-weight: bold;
    transition: 0.3s;
}

.event-card:hover .event-title{
    color: #ff9800;
}

.event-meta{
    color: #777;
    font-size: 14px;
}

/* BUTTON */
.event-btn{
    display: inline-block;
    padding: 8px 16px;
    background: #ff9800;
    color: #fff;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.event-btn:hover{
    background: #e57c00;
    transform: translateY(-2px);
}
</style>

<main>

<section class="events-hero">
    <h1 class="fw-bold display-5">Events</h1>
    <p class="lead">Stay updated with all community activities & programs</p>
</section>

<div class="container my-5">
    <div class="row g-4">

<?php 
if(mysqli_num_rows($eventQuery) > 0){
    while($event = mysqli_fetch_assoc($eventQuery)){

        $img = $event['event_img'];
        if($img == "" || !file_exists("upload/events/".$img)){
            $img = "logo2.png"; // MUST keep a default img in uploads/events/default-event.jpg
        }
?>
   <div class="col-md-4">
    <div class="event-card animate__animated animate__fadeInUp position-relative"> <!-- position-relative added -->

        <img src="upload/events/<?= $img ?>" class="event-img">

        <div class="event-body">
            <h5 class="event-title"><?= $event['title'] ?></h5>

            <p class="event-meta mt-2">
                📍 <?= $event['event_location'] ?><br>
                📅 <?= date("d M Y", strtotime($event['event_date'])) ?>
            </p>

            <p><?= substr($event['description'], 0, 100) ?>...</p>

          <div class="d-flex justify-content-between align-items-center mt-3">
    <a href="javascript:void(0)"
       class="event-btn"
       onclick='openEventModal(
           <?= json_encode($event["title"]) ?>,
           <?= json_encode($event["description"]) ?>,
           <?= json_encode($event["event_location"]) ?>,
           <?= json_encode($event["event_time"]) ?>,
           <?= json_encode($event["event_date"]) ?>,
           <?= json_encode($img) ?>
       )'>
       View Details
    </a>

    <?php if($event['video_link'] != ""){ ?>
    <button class="btn btn-primary btn-sm"
            onclick="openVideo('<?= $event['video_link'] ?>')">
        Play Video
    </button>
    <?php } ?>
</div>

        </div>
    </div>
</div>

<?php }} else { ?>
    <div class="col-12 text-center">
        <p class="text-muted">No Events Available</p>
    </div>
<?php } ?>

    </div>
</div>


<!-- ===== EVENT MODAL ===== -->
<div class="modal fade" id="eventModal">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-warning">
        <h5 id="eventModalTitle" class="modal-title"></h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <img id="eventModalImage" class="img-fluid rounded mb-3" style="max-height:300px; object-fit:cover; width:100%;">

        <p><b>📍 Location:</b> <span id="eventModalLocation"></span></p>
        <b></b> <span id="eventModalTime"></span>
        <p><b>📅 Date:</b> <span id="eventModalDate"></span></p>

        <hr>

        <p id="eventModalDescription"></p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<!-- ===== VIDEO MODAL ===== -->
<div class="modal fade" id="videoModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-0 rounded">

      <div class="ratio ratio-16x9">
        <iframe id="videoFrame" src="" allow="autoplay" allowfullscreen></iframe>
      </div>

    </div>
  </div>
</div>

</main>

<script>
function openEventModal(title, desc, location, time, date, img){
    document.getElementById("eventModalTitle").innerText = title;
    document.getElementById("eventModalDescription").innerText = desc;
    document.getElementById("eventModalLocation").innerText = location;
    document.getElementById("eventModalTime").innerText = time;
    document.getElementById("eventModalDate").innerText = date;
    document.getElementById("eventModalImage").src = "upload/events/" + img;

    new bootstrap.Modal(document.getElementById('eventModal')).show();
}

// ===== OPEN VIDEO =====
function openVideo(url){
    let id = "";

    // Short link: youtu.be/xxxxx
    if(url.includes("youtu.be/")){
        id = url.split("youtu.be/")[1].split("?")[0];
    }

    // Normal link: watch?v=xxxxx
    else if(url.includes("watch?v=")){
        id = url.split("watch?v=")[1].split("&")[0];
    }

    // Shorts link: youtube.com/shorts/xxxxx
    else if(url.includes("/shorts/")){
        id = url.split("/shorts/")[1].split("?")[0];
    }

    if(id == ""){
        alert("Invalid YouTube Link!");
        return;
    }

    document.getElementById("videoFrame").src =
        "https://www.youtube.com/embed/" + id + "?autoplay=1";

    new bootstrap.Modal(document.getElementById('videoModal')).show();

    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById("videoFrame").src = "";
    });
}

</script>

<?php include("footer.php"); ?>
