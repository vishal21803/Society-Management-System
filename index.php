<?php
include("header.php");
?>
<style>
     /* .hero {
            background: url('./upload/Hero.png') ;
            background-size: cover;
            background-repeat: no-repeat;
            padding: 150px 0;
            color: white;
            text-shadow: 1px 1px 3px black;
        } */


            .hero {
    min-height: 50vh;
    display: flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(
        -45deg,
        #1e3c72,
        #9bbfffff,
        #f7971e,
        #ffd200
    );
    background-size: 400% 400%;
    animation: gradientBG 12s ease infinite;
    color: white;
}

@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Glass content */
.hero-content {
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(14px);
    padding: 50px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
}

/* Fade animation */
.animate-fade {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 1s ease forwards;
}

.delay-1 { animation-delay: 0.3s; }
.delay-2 { animation-delay: 0.6s; }

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

        .feature-icon {
            font-size: 40px;
            color: #16a34a;
        }
        /* ========== COMMON SECTION BACKGROUND ========== */
section {
    background: linear-gradient(135deg, #fff9e6, #ffe8b5);
}

/* ========== NEWS CARDS ========== */
.card {
    border-radius: 20px !important;
    overflow: hidden;
    transition: all 0.45s ease;
    box-shadow: 0 10px 28px rgba(0,0,0,0.15);
    background: #fff;
    position: relative;
}

.card:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 18px 45px rgba(0,0,0,0.25);
}

.card img {
    transition: 0.4s ease;
}

.card:hover img {
    transform: scale(1.1);
}

.card-title {
    font-weight: 700;
    font-size: 19px;
}

.card-text {
    font-size: 14px;
    color: #444;
}

.card-footer {
    font-size: 13px;
    background: transparent;
}

/* Read More Link */
.card a {
    color: #ff8800;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.card a:hover {
    color: #d96c00;
    text-shadow: 0 0 6px rgba(255, 153, 0, 0.6);
}

/* ========== FEATURES SECTION ========== */
.feature-icon {
    font-size: 45px;
    animation: floatIcon 2s ease-in-out infinite alternate;
}

@keyframes floatIcon {
    from { transform: translateY(0); }
    to { transform: translateY(-6px); }
}

section .shadow {
    border-radius: 20px;
    transition: all 0.45s ease;
    background: linear-gradient(135deg, #ffffff, #fff8e5);
}

section .shadow:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 16px 40px rgba(0,0,0,0.2);
}

/* ========== EVENTS CARDS ========== */
#events .shadow {
    border-left: 6px solid #ffb300;
    background: linear-gradient(135deg, #ffffff, #fff3d6);
    position: relative;
}

#events .shadow::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(120deg, transparent, rgba(255, 183, 0, 0.2), transparent);
    opacity: 0;
    transition: 0.4s;
}

#events .shadow:hover::after {
    opacity: 1;
}

#events .shadow:hover {
    transform: translateY(-12px) scale(1.03);
}

/* Event Button */
#events .btn-outline-primary {
    border-radius: 25px;
    font-weight: 600;
    transition: 0.35s;
}

#events .btn-outline-primary:hover {
    background: #ff9800;
    border-color: #ff9800;
    color: white;
    box-shadow: 0 0 12px rgba(255, 152, 0, 0.7);
}

#events .shadow::after {
    pointer-events: none;   /* ✅ Click pass through karega */
}

#events .shadow {
    z-index: 1;
}

#events .btn-outline-primary {
    position: relative;
    z-index: 5;   /* ✅ Button hamesha top par rahega */
}


/* ========== HEADINGS EFFECT ========== */


h2::after {
    content: "";
    position: absolute;
    width: 60%;
    height: 4px;
    left: 20%;
    bottom: 0;
    border-radius: 20px;
}

/* ========== RESPONSIVE FIX ========== */
@media(max-width:768px){
    .card:hover,
    section .shadow:hover,
    #events .shadow:hover {
        transform: scale(1.02);
    }
}

</style>


<?php
@session_start();
include("connectdb.php");

$isLoggedIn = false;
$myZone = 0;
$myCity = 0;
$member_id = 0;

if(isset($_SESSION['member_id'])) {
    $isLoggedIn = true;
    $member_id = $_SESSION['member_id'];

    $memberQuery = mysqli_query($con, "SELECT zone_id, city_id FROM sens_members WHERE member_id='$member_id'");
    if(mysqli_num_rows($memberQuery) > 0) {
        $memberData = mysqli_fetch_assoc($memberQuery);
        $myZone = $memberData['zone_id'];
        $myCity = $memberData['city_id'];
    }
}
?>

<?php
if($isLoggedIn){

  $galleryQuery = mysqli_query($con, "
    SELECT * FROM sens_gallery 
    WHERE gallery_front = 1 AND 
    (
        visibility_type='all'
        OR (visibility_type='zone' AND zone_id='$myZone')
        OR (visibility_type='city' AND city_id='$myCity')
        OR (visibility_type='member' AND member_id='$member_id')
    )
    ORDER BY priority DESC, created_at DESC
");

}else{

    // ✅ Guest user sirf ALL dekhega
    $galleryQuery = mysqli_query($con, "
    SELECT * FROM sens_gallery 
    WHERE visibility_type='all' AND gallery_front=1
    ORDER BY gallery_id DESC
    ");

}
?>

<?php
if($isLoggedIn){

$newsQuery = mysqli_query($con, "
    SELECT * FROM sens_news 
    WHERE status='active'
    AND news_front = 1
    AND (
        toshow_type='all'
        OR (toshow_type='zone' AND toshow_id='$myZone')
        OR (toshow_type='city' AND toshow_id='$myCity')
        OR (toshow_type='member' AND toshow_id='$member_id')
    )
    ORDER BY news_id DESC
    LIMIT 3
");


}
else{

    // ✅ Guest sirf ALL type dekhega
   $newsQuery = mysqli_query($con, "
    SELECT * FROM sens_news 
    WHERE status='active'
    AND news_front = 1
    AND toshow_type='all'
    ORDER BY news_id DESC
    LIMIT 3
");

}
?>

<?php


// === Events Query
if($isLoggedIn){
  $eventQuery = mysqli_query($con, "
    SELECT * FROM sens_events
    WHERE event_front = 1
    AND (
        toshow_type='all'
        OR (toshow_type='zone' AND toshow_id='$myZone')
        OR (toshow_type='city' AND toshow_id='$myCity')
        OR (toshow_type='member' AND toshow_id='$member_id')
    )
    ORDER BY event_id DESC
    LIMIT 3
");

}else{
    $eventQuery = mysqli_query($con, "
    SELECT * FROM sens_events
    WHERE event_front = 1
    AND toshow_type='all'
    ORDER BY event_id DESC
    LIMIT 3
");

}
?>






<main>
<!-- ========== HERO SECTION ========== -->
<section class="hero text-center">
    <div class="container hero-content">
        <h1 class="fw-bold display-4 animate-fade">
            Welcome to Society Management System
        </h1>

        <p class="lead animate-fade delay-1">
            Connecting families, culture, values & community together.
        </p>

        <?php if(!isset($_SESSION["uname"])) { ?>
            <a href="register.php"
               class="btn btn-warning btn-lg mt-3 animate-fade delay-2"
               style="color:white;">
                Join Our Society
            </a>
        <?php } ?>
    </div>
</section>


<!-- ========== ABOUT SECTION ========== -->
<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">About Us</h2>
        <p class="text-center w-75 mx-auto">
            This Project was established with a vision to unite families from a common heritage and strengthen bonds across different regions. It aims to preserve cultural values, traditions, and social harmony while fostering a sense of belonging and collective growth within the community.
        </p>
    </div>
</section>


        <h2 class="fw-bold text-center mb-4">News & Headlines</h2>

<div class="container mt-5">
    <div class="row">

        <?php
        if(mysqli_num_rows($newsQuery) > 0){
            while($news = mysqli_fetch_assoc($newsQuery)){
        ?>
            <div class="col-md-4 mb-4">   <!-- ✅ Sirf ek col-md-4 -->

                <div class="card h-100 shadow">

                    <img src="upload/news/<?= $news['news_img'] ?>" 
                         class="card-img-top" 
                         style="height:200px;object-fit:fill;">

                    <div class="card-body">
                        <h5 class="card-title"><?= $news['title'] ?></h5>

                        <p class="card-text">
                            <?= substr($news['description'], 0, 120) ?>...
                            <br>
                           <a href="javascript:void(0)" 
   onclick='openNewsModal(
       <?= json_encode($news["title"]) ?>,
       <?= json_encode($news["description"]) ?>,
       <?= json_encode($news["news_img"]) ?>,
         <?= json_encode($news["news_time"]) ?>,
       "<?= date("d M Y", strtotime($news["news_date"])) ?>"
   )'>
   Read More
</a>
                        </p>
                    </div>

                      <div class="text-end me-2">
                            <a href="showNews.php" class="btn btn-outline-primary" style="color:black">
                               More News
                            </a>
                        </div>

                    <div class="card-footer bg-white border-0">
                        <small class="text-muted">
                            News Date: <?= date("d M Y", strtotime($news['news_date'])) ?>
                        </small>
                    </div>

                </div>

            </div>
        <?php
            }
        } else {
        ?>
            <div class="col-12 text-center">
                <p>No News Available</p>
            </div>
        <?php } ?>

    </div>
</div>


<div class="modal fade" id="newsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <img id="modalImage" class="img-fluid rounded mb-3 w-100" style="max-height:300px;object-fit:fill;">

        <p class="text-muted mb-2">
          <i class="bi bi-calendar-event"></i> 
          <span id="modalDate"></span>
        </p>
        <p class="text-muted mb-2">
          <i class="bi bi-clock"></i> 
          <span id="modalTime"></span>
        </p>

        <p id="modalDescription" style="font-size:16px;line-height:1.7;"></p>

      </div>

      <div class="modal-footer">
        <button class="btn btn-dark" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


        <h2 class="fw-bold text-center mb-4">Gallery</h2>

<div id="galleryCarousel" class="carousel slide mt-4" data-bs-ride="carousel">
    <div class="carousel-inner">

        <?php
        $active = "active";
        if(mysqli_num_rows($galleryQuery) > 0){
            while($row = mysqli_fetch_assoc($galleryQuery)){
        ?>
            <div class="carousel-item <?= $active ?>">
                <img src="upload/gallery/<?= $row['image'] ?>" class="d-block w-100" style="height:650px;object-fit:fill;">
                
                <div class="carousel-caption bg-dark bg-opacity-50 rounded p-3">
                    <h5><?= $row['title'] ?></h5>
                    <p><?= $row['description'] ?></p>
                </div>
            </div>
        <?php
                $active = "";
            }
        } else {
        ?>
            <div class="carousel-item active">
                <img src="assets/no-image.jpg" class="d-block w-100" style="height:450px;object-fit:cover;">
                <div class="carousel-caption bg-dark bg-opacity-50 rounded p-3">
                    <h5>No Gallery Found</h5>
                    <p>Please add images from admin panel.</p>
                </div>
            </div>
        <?php } ?>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>


<!-- ========== FEATURES SECTION ========== -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Features</h2>

        <div class="row g-4 text-center">
            
            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">👥</div>
                    <h5 class="fw-bold">Member Management</h5>
                    <p>
                        Maintain detailed member profiles with easy access to personal, family, and contact information.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">📅</div>
                    <h5 class="fw-bold">Events & Activities</h5>
                    <p>
                        Create, manage, and publish events with schedules, updates, and participation details.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">💳</div>
                    <h5 class="fw-bold">Billing & Receipts</h5>
                    <p>
                        Track payments, generate bills and receipts, and view transaction history in one place.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">📂</div>
                    <h5 class="fw-bold">Document Downloads</h5>
                    <p>
                        Securely share and download notices, forms, reports, and official documents.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">💬</div>
                    <h5 class="fw-bold">Communication System</h5>
                    <p>
                        Send messages and announcements to members for quick and effective communication.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded h-100">
                    <div class="feature-icon mb-3">📊</div>
                    <h5 class="fw-bold">Reports & Analytics</h5>
                    <p>
                        View insights, summaries, and reports to help manage operations efficiently.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>



<!-- ========== EVENTS CARDS ========== -->
<section id="events" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Earlier Events</h2>

        <div class="row g-4">

            <?php
            if(mysqli_num_rows($eventQuery) > 0){
                while($event = mysqli_fetch_assoc($eventQuery)){
            ?>
                <div class="col-md-4">
                    <div class="p-4 bg-white shadow rounded h-100 d-flex flex-column justify-content-between">

                        <?php if(!empty($event['event_img'])){ ?>
                            <img src="upload/events/<?= htmlspecialchars($event['event_img']); ?>" 
                                 class="img-fluid rounded mb-3"
                                 style="height:180px;object-fit:cover;width:100%;">
                        <?php } ?>

                        <div>
                            <h5 class="fw-bold"><?= htmlspecialchars($event['title']); ?></h5>

                            <p class="text-muted mb-1">
                                <i class="bi bi-calendar-event"></i> 
                                <?= date("d M Y", strtotime($event['event_date'])); ?>
                                · <?= htmlspecialchars($event['event_time']); ?>
                            </p>

                            <p class="text-muted mb-2">
                                <i class="bi bi-geo-alt"></i> 
                                <?= htmlspecialchars($event['event_location']); ?>
                            </p>

                            <p><?= substr($event['description'], 0, 100); ?>...</p>
                        </div>

                        <!-- Buttons row -->
                        <div class="d-flex justify-content-between align-items-center mt-3">

                           

                            <a href="javascript:void(0)" 
                               class="btn btn-outline-primary btn-sm"
                               onclick='openEventModal(
                                    <?= json_encode($event["title"]); ?>,
                                    <?= json_encode($event["description"]); ?>,
                                    <?= json_encode($event["event_date"]); ?>,
                                    <?= json_encode($event["event_time"]); ?>,
                                    <?= json_encode($event["event_location"]); ?>,
                                    <?= json_encode($event["event_img"]); ?>
                               )'>
                                Read More
                            </a>

                             <?php if(!empty($event['video_link'])){ ?>
                                <button class="btn btn-primary btn-sm"
                                        onclick="openVideo('<?= $event['video_link']; ?>')">
                                    <i class="bi bi-play-circle"></i> Play Video
                                </button>
                            <?php } ?>

                        </div>

                    </div>
                </div>

            <?php } } else { ?>

                <div class="col-12 text-center">
                    <p>No Events Available</p>
                </div>

            <?php } ?>

        </div>
    </div>
</section>

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
<!-- ========== EVENTS MODAL ========== -->
<div class="modal fade" id="eventModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="eventModalTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        
      <img id="eventModalImg" class="img-fluid rounded mb-3" style="height:300px;object-fit:cover;width:100%;display:none;">

        <p class="text-muted mb-1">
            <i class="bi bi-calendar-event"></i> <span id="eventModalDate"></span>
             <i class="bi "></i> <span id="eventModalTime"></span>
        </p>
        <p class="text-muted mb-2">
            <i class="bi bi-geo-alt"></i> <span id="eventModalLocation"></span>
        </p>

        <p id="eventModalDescription" style="font-size:16px;line-height:1.7;"></p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<?php if(!isset($_SESSION["uname"])) { ?>
    
<!-- ========== MEMBERSHIP SECTION ========== -->
<!-- <section id="membership" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Membership Plans</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded text-center">
                    <h4 class="fw-bold">Yearly Membership</h4>
                    <p class="lead">₹500 / year</p>
                    <a href="register.php" class="btn btn-success">Join Now</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded text-center border border-success">
                    <h4 class="fw-bold">Lifetime Membership</h4>
                    <p class="lead">₹5100 / once</p>
                    <a href="register.php" class="btn btn-success">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</section> -->

<?php } ?>




</main>

<script>
function openNewsModal(title, desc, img, time,date){
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalDescription").innerText = desc;
    document.getElementById("modalImage").src = "upload/news/" + img;
        document.getElementById("modalTime").innerText = time;

    document.getElementById("modalDate").innerText = date;

    let modal = new bootstrap.Modal(document.getElementById('newsModal'));
    modal.show();
}

function openEventModal(title, desc, date, time, location, img) {

    document.getElementById("eventModalTitle").innerText = title;
    document.getElementById("eventModalDescription").innerText = desc;
    document.getElementById("eventModalDate").innerText = date;
    document.getElementById("eventModalTime").innerText = time;
    document.getElementById("eventModalLocation").innerText = location;

    let imgTag = document.getElementById("eventModalImg");

    if(img && img !== ""){
        imgTag.src = "upload/events/" + img;
        imgTag.style.display = "block";
    } else {
        imgTag.style.display = "none";
    }

    new bootstrap.Modal(document.getElementById("eventModal")).show();
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


<?php
include("footer.php");
?>
