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
        WHERE event_status='upcoming'
        AND (
            toshow_type='all' OR
            (toshow_type='zone' AND toshow_id='$myZone') OR
            (toshow_type='city' AND toshow_id='$myCity') OR
            (toshow_type='member' AND toshow_id='$member_id')
        )
        ORDER BY event_id
       
    ");
}else{
    $eventQuery = mysqli_query($con,"
        SELECT * FROM sens_events
        WHERE event_status='upcoming'
        AND toshow_type='all'
        ORDER BY event_id DESC
       
    ");
}
?>

<style>
    /* ===== EVENTS HERO ===== */
.events-hero{
    background: linear-gradient(135deg, #fff9e6, #ffe0a3);
    padding: 80px 0;
    text-align: center;
}

/* ===== EVENT CARD ===== */
.event-card{
    background: rgba(255,255,255,0.85);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    transition: all 0.45s ease;
    height: 100%;
    position: relative;
    overflow: hidden;
}

/* ✅ Hover Lift + Glow */
.event-card:hover{
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 25px 60px rgba(255,152,0,0.35);
}

/* ✅ Gradient Side Glow Strip */
.event-card::before{
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 6px;
    background: linear-gradient(to bottom, #ff9800, #ff5722);
}

/* ===== TITLE ===== */
.event-title{
    font-size: 20px;
    font-weight: bold;
    transition: 0.3s;
}

.event-card:hover .event-title{
    color: #ff9800;
    letter-spacing: 0.5px;
}

/* ===== META INFO ===== */
.event-meta{
    font-size: 14px;
    color: #666;
}

/* ===== READ MORE BUTTON ===== */
.event-btn{
    display: inline-block;
    margin-top: 10px;
    font-weight: bold;
    color: #ff9800;
    text-decoration: none;
    transition: 0.35s;
}

.event-btn::after{
    content: " →";
    transition: 0.35s;
}

.event-btn:hover{
    color: #e65100;
    transform: translateX(6px);
}

</style>


<main>
    <section class="events-hero">
    <div class="container">
        <h1 class="fw-bold display-5">Upcoming Events</h1>
        <p class="lead">Stay updated with all Jain community activities & programs</p>
    </div>
</section>

<div class="container my-5">
    <div class="row g-4">

    <?php if(mysqli_num_rows($eventQuery) > 0){
        while($event = mysqli_fetch_assoc($eventQuery)){ ?>

        <div class="col-md-4">
            <div class="event-card  animate__animated animate__fadeInUp">

                <h5 class="event-title"><?= $event['title'] ?></h5>

                <p class="event-meta mt-2">
                    📍 <?= $event['event_location'] ?><br>
                    🕒 <?= $event['event_time'] ?><br>
                    📅 <?= date("d M Y", strtotime($event['event_date'])) ?>
                </p>

                <p class="mt-2">
                    <?= substr($event['description'], 0, 120) ?>...
                </p>

                <a href="javascript:void(0)"
                   class="event-btn"
                    onclick='openEventModal(
                                   <?= json_encode($event["title"]) ?>,
                                   <?= json_encode($event["description"]) ?>,
                                   <?= json_encode($event["event_date"]) ?>,
                                   <?= json_encode($event["event_time"]) ?>,
                                   <?= json_encode($event["event_location"]) ?>
                               )'>
                   View Details
                </a>
<button class="btn btn-warning btn-sm" onclick="openVideo('<?= $event['video_link'] ?>')">
    ▶ Play Video
</button>




            </div>
        </div>

    <?php }}else{ ?>
        <div class="col-12 text-center">
            <p class="text-muted">No Events Available</p>
        </div>
    <?php } ?>

    </div>
</div>



<div class="modal fade" id="eventModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="eventModalTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><b>📍 Location:</b> <span id="eventModalLocation"></span></p>
        <p><b>🕒 Time:</b> <span id="eventModalTime"></span></p>
        <p><b>📅 Date:</b> <span id="eventModalDate"></span></p>

        <hr>

        <p id="eventModalDescription" style="line-height:1.7;"></p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>




<div class="modal fade" id="videoModal">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-0 border-0 rounded-3 overflow-hidden">

      <div class="ratio ratio-16x9">
        <iframe id="videoFrame" src="" allow="autoplay" allowfullscreen></iframe>
      </div>

    </div>
  </div>
</div>



</main>

<script>
function openEventModal(title, desc, location, time, date){
    document.getElementById("eventModalTitle").innerText = title;
    document.getElementById("eventModalDescription").innerText = desc;
    document.getElementById("eventModalLocation").innerText = location;
    document.getElementById("eventModalTime").innerText = time;
    document.getElementById("eventModalDate").innerText = date;

    let modal = new bootstrap.Modal(document.getElementById('eventModal'));
    modal.show();
}


function openVideo(url){
    let videoID = "";

    // For short link: https://youtu.be/xxxxx
    if(url.includes("youtu.be")){
        videoID = url.split("youtu.be/")[1].split("?")[0];
    }

    // For normal link: https://www.youtube.com/watch?v=xxxxx
    else if(url.includes("watch?v=")){
        videoID = url.split("watch?v=")[1].split("&")[0];
    }

    // Set iframe source
    let frame = document.getElementById("videoFrame");
    frame.src = "https://www.youtube.com/embed/" + videoID + "?autoplay=1";

    // Show Modal
    var modal = new bootstrap.Modal(document.getElementById('videoModal'));
    modal.show();

    // Stop video on close
    document.getElementById('videoModal').addEventListener('hidden.bs.modal', function () {
        frame.src = "";
    });
}



</script>


<?php
include("footer.php");
?>