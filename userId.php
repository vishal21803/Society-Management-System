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
    width:420px;
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
    top: -70px;
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
    margin-top: 25px;
}

/* .info-area{
    font-size:13px;
    color:#333;
    width:100%;
}

.info-area p{
    margin:2px 0;
    text-align:left;
    line-height:15px;
} */

    .info-area{
    font-size:13px;
    color:#222;
    width:100%;
}

.info-table{
    width:100%;
    border-collapse:collapse;
    table-layout:fixed;
}

.info-table td{
    padding:3px 0;
}

.info-label{
    width:38%;
    text-align:left;
    padding-right:6px;
    white-space:nowrap;
}

.info-value{
    width:30%;
    text-align:left;
    word-break:break-word;
    position: relative;
    left: -215px;
    white-space:normal;
    font-weight: bold;
    
}

/* auto height multi-line address */
.addr{
    max-height:100px;
    overflow:auto;
}

.footer-strip{
    font-size:11px;
    padding:5px 8px;
    border-radius:6px;
    text-align:center;
    font-weight:bold;
    border: 3px solid black;
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
    /* background:#fff9e6 !important; */
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
    font-size:15px;
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


.dpbtn{
    display:flex;
    justify-content:center;
    gap:18px;
    margin-top:18px;
    position: relative;
    top: -270px;
}

.dpbtn button{
    border:none;
    padding:10px 28px;
    font-size:14px;
    font-weight:bold;
    border-radius:28px;
    cursor:pointer;
    transition:0.25s ease;
    color:white;
    box-shadow:0px 6px 16px rgba(0,0,0,0.25);
}

/* Print btn */
.dpbtn .btn-print{
    background: linear-gradient(90deg,#035efc,#0036b5);
}

.dpbtn .btn-print:hover{
    transform:translateY(-3px) scale(1.05);
}

/* PNG btn */
.dpbtn .btn-download{
    background: linear-gradient(90deg,#0fa52b,#064f15);
}

.dpbtn .btn-download:hover{
    transform:translateY(-3px) scale(1.05);
}



</style>

<main>

<?php
$uid=$_SESSION['uid'];
$q=mysqli_query($con,"
SELECT m.phone,m.photo,m.address,u.email,m.fullname,  m.balance_amount,m.member_id,
       z.zone_name,c.city_name 
FROM sens_members m
JOIN sens_users u ON m.user_id=u.id
JOIN sens_zones z ON m.zone_id=z.zone_id
JOIN sens_cities c ON m.city_id=c.city_id
WHERE m.user_id='$uid'
");
$row=mysqli_fetch_assoc($q);

$uniqueID = strtolower(substr($row['fullname'],0,4)) . $row['member_id'];

?>

<div class="page-wrapper">

<div class="id-card">

  <div class="id-header">
    <div class="logo-text-wrapper">
        <!-- <img src="upload/reclogo.png" class="header-logo"> -->
        <div class="header-text">
            <span class="inline-text text-danger"> <i class="bi bi-buildings me-2" style="font-size: 2rem;"></i>
    SocioManage</span>
            <span class="below-text text-danger"></span>
            <span class="year-text text-dark"></span>

        </div>
    </div>

    <div class="org-name">
        Bhilai,Chhattisgarh<br>
       India<br>
       
    </div>
</div>


<?php 
$img = ($row['photo']!="") ? $row['photo'] : "default.png";

// condition for round / square style
if($row['balance_amount'] == 0){
    $shape = "border-radius:50%; width:90px; height:100px;";
}else{
    $shape = "border-radius:6px; width:90px; height:110px;";
}
?>


    <div class="profile-row">

    
        <img  style="<?=$shape?>" src="upload/member/<?=($row['photo']?:'default.png')?>"
             class="profile-pic">

       <div class="info-area">
<table class="info-table">
    <tr>
        <td class="info-label" style="vertical-align:top;">Name</td>
        <td class="info-value addr" style="width:25%;">: <?=$row['fullname']?></td>
    </tr>
    <tr>
        <td class="info-label">Phone</td>
        <td class="info-value">: <?=$row['phone']?></td>
    </tr>
    <tr>
        <td class="info-label">Email</td>
        <td class="info-value">:&nbsp;<?= $row['email']?></td>
    </tr>
    <tr>
        <td class="info-label">Zone</td>
        <td class="info-value">:&nbsp;<?=$row['zone_name']?></td>
    </tr>
    <tr>
        <td class="info-label">City</td>
        <td class="info-value">:&nbsp;<?=$row['city_name']?></td>
    </tr>
    <tr>
        <td class="info-label" style="vertical-align:top;">Address</td>
        <td class="info-value addr" style="width:20%;">: <?=$row['address']?></td>
    </tr>
</table>
</div>

    </div>

    <div class="footer-strip bg-warning"> MEMBER ID - <?=$uniqueID?> </div>

</div>
</div>

<div class="dpbtn" >
<button class="btn btn-primary" onclick="window.print()">Print ID</button>
<button class="btn btn-success" onclick="downloadPNG()">Download ID</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script>

function downloadPNG() {
    const card = document.querySelector(".id-card");

    card.classList.add("no-blur-export");

    html2canvas(card,{
        scale:4,
        backgroundColor:"#fff"      // fixes footer color loss
    }).then(canvas=>{

        const imgData = canvas.toDataURL("image/png");
        const link=document.createElement("a");
        link.href=imgData;
        link.download="ID_CARD_<?= $uid ?>.png";
        link.click();

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
