<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");
?>

<style>

.page-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:20px;
    background:#fff9e6;
}

/* Auto height - NO fixed height */
.id-card{
    width:400px;
    background:#fff;
    border-radius:12px;
    border:1px solid #ddd;
    padding:15px 18px;
    box-shadow:0px 8px 24px rgba(0,0,0,0.18);
    background:rgba(255,255,255,0.20); /* transparency kam */
    backdrop-filter:blur(4px); /* use 4px only */
    -webkit-backdrop-filter:blur(4px);
    display:flex;
    flex-direction:column;
    gap:10px;

    position:relative;
    animation:fade 0.4s ease;
}

@keyframes fade{from{opacity:0;}to{opacity:1;}}

.id-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:5px;
}

.id-header img{
    width:70px;
    height: 60px;
}

.org-name{
    font-size:12px;
    text-align:right;
    font-weight:600;
    color:#444;
}

.profile-row{
    display:flex;
    gap:12px;
}

.profile-pic{
    width:85px;
    height:100px;
    border-radius:6px;
    object-fit:cover;
    border:2px solid #ffc107;
    box-shadow:0px 6px 14px rgba(0,0,0,0.18);
}

.info-area{
    font-size:13px;
    color:#333;
    width:100%;
}

.info-area p{
    margin:2px 0;
    text-align:left;
    line-height:15px;
}

/* auto height multi-line address */
.addr{
    max-height:100px;
    overflow:auto;
}

.footer-strip{
    font-size:11px;
    background:#ffc107;
    padding:5px 8px;
    border-radius:6px;
    text-align:center;
    font-weight:bold;
}

@media print {
    body *{visibility:hidden;}
    .id-card,.id-card *{
        visibility:visible;
    }
    .id-card{
        position:absolute;
        left:0;
        top:0;
        box-shadow:none;
    }

    /* 🟡 remove scrollbar */
    .addr{
        overflow:visible !important;
        max-height:none !important;
    }
}

/* remove blur + shadows for perfect export */
.no-blur-export, 
.no-blur-export *{
    backdrop-filter:none !important;
    -webkit-backdrop-filter:none !important;
    filter:none !important;
    opacity:1 !important;
    box-shadow:none !important;
    background:#fff9e6 !important;
}
.id-header{
    display:flex;
    justify-content:space-between;
    align-items:center; /* top align */
    gap:10px;
}

.logo-text-wrapper{
    display:flex;
    flex-direction:row; /* logo left, text right */
    align-items:center;
    gap:5px;
}

.header-logo{
    width:70px;
    height:60px;
}

.header-text{
    display:flex;
    flex-direction:column; /* stacked text next to logo */
}

.inline-text{
    font-weight:600;
    font-size:10px;
    text-shadow: black;
}

.below-text{
    font-size:10px;
    margin-left: 12px;
        font-weight:600;

}

.year-text{
    font-size:7px;
    margin-left: 25px;
            font-weight:600;

}



</style>

<main>

<?php
$uid=$_SESSION['uid'];
$q=mysqli_query($con,"
SELECT m.phone,m.photo,m.address,u.email,m.fullname,  m.balance_amount,
       z.zone_name,c.city_name 
FROM sens_members m
JOIN sens_users u ON m.user_id=u.id
JOIN sens_zones z ON m.zone_id=z.zone_id
JOIN sens_cities c ON m.city_id=c.city_id
WHERE m.user_id='$uid'
");
$row=mysqli_fetch_assoc($q);
?>

<div class="page-wrapper">

<div class="id-card">

  <div class="id-header">
    <div class="logo-text-wrapper">
        <img src="upload/reclogo.png" class="header-logo">
        <div class="header-text">
            <span class="inline-text text-danger">श्री नागपुर प्रान्तीय दिगंबर</span>
            <span class="below-text text-danger">जैन खंडेलवाल सभा</span>
                        <span class="year-text text-dark">स्थापना वर्ष - 1916
</span>

        </div>
    </div>

    <div class="org-name">
        पंजीकृत कार्यालय: छिंदवाड़ा (म.प्र.)<br>
        क्रमांक: 173/53/54<br>
        इतवारी भाजीमंडी फूलओली<br>
        नागपुर - 440002
    </div>
</div>


<?php 
$img = ($row['photo']!="") ? $row['photo'] : "default.png";

// condition for round / square style
if($row['balance_amount'] == 0){
    $shape = "border-radius:50%; width:90px; height:90px;";
}else{
    $shape = "border-radius:6px; width:90px; height:110px;";
}
?>


    <div class="profile-row">

    
        <img  style="<?=$shape?>" src="upload/member/<?=($row['photo']?:'default.png')?>"
             class="profile-pic">

        <div class="info-area">
            <p><strong>Name:</strong> <?=$row['fullname']?></p>
            <p><strong>Phone:</strong> <?=$row['phone']?></p>
            <p><strong>Email:</strong> <?=$row['email']?></p>
            <p><strong>Zone:</strong> <?=$row['zone_name']?></p>
            <p><strong>City:</strong> <?=$row['city_name']?></p>
            <p class="addr"><strong>Address:</strong> <?=$row['address']?></p>
        </div>
    </div>

    <div class="footer-strip"> MEMBER ID CARD </div>

</div>
</div>

<div style="margin-top:20px;text-align:center;">
<button onclick="window.print()">Print</button>
<button onclick="downloadPNG()">Download PNG</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>

function downloadPNG() {
    const card = document.querySelector(".id-card");

    // blur remove before capture
    card.classList.add("no-blur-export");

    html2canvas(card, {
        scale: 4,
        backgroundColor: "#fff9e6"
    }).then(canvas => {

        const imgData = canvas.toDataURL("image/png");
        const link = document.createElement("a");
        link.href = imgData;
        link.download = "ID_CARD_<?= $uid ?>.png";
        link.click();

        // restore blur
        card.classList.remove("no-blur-export");

    });
}



</script>

<?php
include("footer.php");
}else{
include("index.php");
}
?>
