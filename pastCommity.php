<?php
include("header.php");
include("connectdb.php");
?>
<style>
    .profile-card {
    width: 300px;
    background: linear-gradient(145deg, #f7971e, #ffd200);
    border-radius: 20px;
    text-align: center;
    padding: 25px 20px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: all 0.4s ease;
    position: relative;
    overflow: visible;  /* 🔥 VERY IMPORTANT */
    margin: 0 auto; /* 🔹 centers by default */
}

.profile-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

/* ✅ PERFECT CIRCLE FIX */
.profile-image {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin-left:auto;
    margin-right: auto;
    border: 5px solid #fff;
    background: #fff;
    box-shadow: 0 8px 18px rgba(0,0,0,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;  /* 🔥 DOUBLE SAFETY */
}

.profile-content {
    margin-top: 10px;
}

.name {
    font-size: 20px;
    font-weight: 700;
    margin: 8px 0 4px;
    color: #222;
}

.post {
    font-size: 14px;
    color: #666;
    margin-bottom: 12px;
}

.info span {
    display: block;
    font-size: 14px;
    color: #444;
    margin: 4px 0;
}

/* 🔹 MOBILE MEDIA QUERY */
@media (max-width: 767px) {
    .profile-card {
        width: 90%; /* almost full width on mobile */
        margin: 20px auto; /* center with spacing */
    }
}

</style>

<main class="py-5 ">

<div class="container">

  <div class="text-center mb-5">
    <h1 class="fw-bold">Our Past Commity Members</h1>
    <p class="text-muted">Leadership That Leads With Values</p>
  </div>

  <div class="row g-4">

<?php
$res = mysqli_query($con,"
SELECT 
  c.comi_duration,
  c.comi_name,
  c.comi_post,
  c.comi_img,
  z.zone_name,
  ct.city_name
FROM sens_past_commity c
LEFT JOIN sens_zones z ON c.comi_zone = z.zone_id
LEFT JOIN sens_cities ct ON c.comi_city = ct.city_id
ORDER BY FIELD(c.comi_post,'President','Vice President','Minister')
");


while($row = mysqli_fetch_assoc($res)){ 
   $img=$row["comi_img"];


?>

    <div class="col-xl-3 col-lg-4 col-md-6 animate__animated animate__fadeInUp">

     <div class="profile-card">
    <div class="profile-image">
        <img src="upload/Committee/<?=$img?>" alt="Profile">
    </div>

    <div class="profile-content">
        <h3 class="name"><?=$row["comi_name"]?></h3>
        <p class="post"><?=$row["comi_post"]?></p>

        <div class="info">
            <span><strong>Zone:</strong> <?=$row["zone_name"]?></span>
            <span><strong>City:</strong> <?=$row["city_name"]?></span>
            <span><strong>Duration:</strong> <?=$row["comi_duration"]?></span>
        </div>
    </div>
</div>
    </div>

<?php } ?>

  </div>
</div>

</main>

<?php
include("footer.php");
?>
