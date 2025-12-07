<?php
include("header.php");
include("connectdb.php");

$isLoggedIn = false;
$myZone = 0;
$myCity = 0;
$member_id = 0;

if(isset($_SESSION['member_id'])) {
    $isLoggedIn = true;
    $member_id = $_SESSION['member_id'];

    $memberQuery = mysqli_query($con, "SELECT zone_id, city_id FROM sens_members WHERE member_id='$member_id'");
    if(mysqli_num_rows($memberQuery) > 0){
        $memberData = mysqli_fetch_assoc($memberQuery);
        $myZone = $memberData['zone_id'];
        $myCity = $memberData['city_id'];
    }
}

if($isLoggedIn){
    $newsQuery = mysqli_query($con, "
        SELECT * FROM sens_news 
        WHERE status='active'
        AND (
            toshow_type='all'
            OR (toshow_type='zone' AND toshow_id='$myZone')
            OR (toshow_type='city' AND toshow_id='$myCity')
            OR (toshow_type='member' AND toshow_id='$member_id')
        )
        ORDER BY news_id DESC
    ");
}else{
    $newsQuery = mysqli_query($con, "
        SELECT * FROM sens_news 
        WHERE status='active' 
        AND toshow_type='all'
        ORDER BY news_id DESC
    ");
}
?>

<style>
.news-hero{
    background: linear-gradient(135deg, #fff9e6, #ffe0a3);
    padding: 70px 0;
    text-align: center;
}

.news-card{
    background: #fff;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
    transition: all 0.45s ease;
    height: 100%;
    position: relative;
}

/* ✅ Premium hover lift + zoom + glow */
.news-card:hover{
    transform: translateY(-12px) scale(1.04);
    box-shadow: 0 25px 60px rgba(255,152,0,0.35);
}

/* ✅ Image smooth zoom */
.news-img{
    height: 220px;
    width: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.news-card:hover .news-img{
    transform: scale(1.08);
}

.news-body{
    padding: 20px;
    transition: 0.4s;
}

/* ✅ Title animation */
.news-title{
    font-weight: bold;
    font-size: 20px;
    transition: 0.3s;
}

.news-card:hover .news-title{
    color: #ff9800;
    letter-spacing: 0.5px;
}

/* ✅ Date styling */
.news-date{
    font-size: 13px;
    color: gray;
}

/* ✅ Read More advanced effect */
.read-btn{
    text-decoration: none;
    font-weight: bold;
    color: #ff9800;
    cursor: pointer;
    display: inline-block;
    margin-top: 5px;
    transition: all 0.35s ease;
}

.read-btn::after{
    content: " →";
    transition: 0.35s;
}

.read-btn:hover{
    color: #e65100;
    transform: translateX(6px);
}

</style>

<main>

<!-- ✅ HERO -->
<section class="news-hero">
    <h1 class="fw-bold">📰 Society News & Announcements</h1>
    <p>Latest updates from Jain Society</p>
</section>

<!-- ✅ NEWS GRID -->
<div class="container my-5">
    <div class="row g-4">

        <?php if(mysqli_num_rows($newsQuery) > 0){ 
            while($news = mysqli_fetch_assoc($newsQuery)){
        ?>
        <div class="col-md-4">
            <div class="news-card animate__animated animate__fadeInUp">

                <img src="upload/news/<?= $news['news_img'] ?>" class="news-img">

                <div class="news-body">
                    <div class="news-title"><?= $news['title'] ?></div>

                    <div class="news-date mb-2">
                        📅 <?= date("d M Y", strtotime($news['news_date'])) ?>
                    </div>

                    <p>
                        <?= substr($news['description'],0,120) ?>...
                        <span class="read-btn"
                        onclick='openNewsModal(
       <?= json_encode($news["title"]) ?>,
       <?= json_encode($news["description"]) ?>,
       <?= json_encode($news["news_img"]) ?>,
       "<?= date("d M Y", strtotime($news["news_date"])) ?>"
   )'>
                         Read More →
                        </span>
                    </p>
                </div>

            </div>
        </div>
        <?php }} else { ?>

        <div class="col-12 text-center">
            <h4>No News Available</h4>
        </div>

        <?php } ?>
    </div>
</div>

</main>


<!-- ✅ PREMIUM MODAL -->
<div class="modal fade" id="newsModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow rounded-4">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="modalTitle"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <img id="modalImage" class="img-fluid rounded mb-3 w-100" style="max-height:350px;object-fit:cover;">

        <p class="text-muted mb-2">
          <i class="bi bi-calendar-event"></i> 
          <span id="modalDate"></span>
        </p>

        <p id="modalDescription" style="font-size:16px;line-height:1.7;"></p>

      </div>

    </div>
  </div>
</div>

<script>
function openNewsModal(title, desc, img, date){
    document.getElementById("modalTitle").innerText = title;
    document.getElementById("modalDescription").innerText = desc;
    document.getElementById("modalImage").src = "upload/news/" + img;
    document.getElementById("modalDate").innerText = date;

    let modal = new bootstrap.Modal(document.getElementById('newsModal'));
    modal.show();
}
</script>

<?php
include("footer.php");
?>
