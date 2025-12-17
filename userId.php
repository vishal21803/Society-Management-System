<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");
?>

<style>

/* Page wrapper */
.page-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:20px;
    background:#fff9e6;
}

/* Glass ID CARD */
.id-card{
    width:100%;
    max-width:420px;
    padding:25px;
    border-radius:22px;
    background: linear-gradient(145deg, #f7971e,white);
    backdrop-filter: blur(8px);
    border: 2px solid rgba(255,193,7,0.8);
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    overflow:hidden;

    opacity:0;
    transform: translateY(50px) scale(.9);
    animation: fadeSlide .9s ease forwards;
    
}

@keyframes fadeSlide{
    100%{
        opacity:1;
        transform: translateY(0) scale(1);
    }
}

.id-card:hover{
    transform:scale(1.03);
    transition:.35s;
}

.logo-area{
    text-align:center;
    margin-bottom:10px;
}

.logo-area img{
    width:300px;
}

.reg-info{
    font-size:13px;
    background:#fff8e18a;
    padding:8px;
    border-radius:12px;
    border:1px solid #ffc107;
    margin-top:10px;
    line-height:18px;
    text-align:center;
}

/* Profile */
.profile-pic{
    width:110px;
    height:110px;
    display:block;
    margin:auto;
    border-radius:50%;
    border:4px solid #fff;
    box-shadow:0 6px 20px rgba(0,0,0,.25);
    object-fit:cover;
    transition:.3s;
    background: white;
}

.profile-pic:hover{
    transform:scale(1.07);
}

/* Name */
.member-name{
    text-align:center;
    margin-top:12px;
    font-size:23px;
    font-weight:700;
    color:#333;
}

/* Detail box */
.info-box{
    background:#fff;
    padding:15px;
    margin-top:18px;
    border-radius:15px;
    border:1px solid #ffc107;
    box-shadow:0 4px 12px rgba(0,0,0,0.1);
}

.info-box p{
    margin:5px 0;
    font-size:15px;
    font-weight:500;
    color:#444;
}

/* buttons */
.receipt-actions{
    margin-top:18px;
    text-align:center;
}

.receipt-actions button{
    padding:10px 14px;
    border:none;
    border-radius:10px;
    margin:6px;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    background:#ffc107;
    transition:.3s;
}

.receipt-actions button:hover{
    transform:scale(1.06);
}

/* Responsive */
@media(max-width:480px){

    .id-card{
        padding:18px;
    }

    .profile-pic{
        width:95px;
        height:95px;
    }

    .member-name{
        font-size:20px;
    }
}

/* Print */
@media print{
    body *{
        visibility:hidden;
    }
    .id-card, .id-card *{
        visibility:visible;
    }
    .id-card{
        position:absolute;
        left:0;
        top:0;
        width:100%;
        max-width:none;
        border:none;
        box-shadow:none;
        margin:0;
        padding:0;
    }
    #print-card {
        visibility: visible; /* only show this */
        position: absolute;
        left: 0;
        top: 0;
        width: auto;
        max-width: none;
        transform: scale(1); /* prevent browser scaling */
        box-shadow: none;
    }
}

</style>

<main>

<?php
$uid=$_SESSION['uid'];

$id=mysqli_query($con,"SELECT 
        m.phone,
        m.photo,
        m.address,
        u.email,
        m.fullname,
        m.balance_amount,
        z.zone_name,
        c.city_name
    FROM sens_members m
    JOIN sens_users u ON m.user_id=u.id
    JOIN sens_zones z ON m.zone_id=z.zone_id
    JOIN sens_cities c ON m.city_id=c.city_id
    WHERE m.user_id='$uid' ");

$row = mysqli_fetch_assoc($id);
?>
   
<div class="page-wrapper">

    <div class="id-card">

            <div class="logo-area">
                <img src="upload/logo2.png">

                <div class="reg-info fw-bold">
                    <p>पंजीकृत कार्यालय: छिंदवाड़ा (म.प्र.)</p>
                    <p>पंजीकृत क्रमांक: 173/53/54</p>
                    <p>कार्यालय : इतवारी, भाजीमंडी, फूलओली</p>
                    <p>नागपुर - 440002</p>
                </div>
            </div>

            <!-- Profile -->
            <?php 
            if($row['balance_amount'] == 0){
                $picClass="border-radius:50%;";
            } else {
                $picClass="border-radius:15px;";
            }

            $img = ($row["photo"]!="") ? $row["photo"] : "default.png";
            ?>

            <img src="upload/member/<?=$img?>" class="profile-pic" style="<?=$picClass?>">

            <div class="member-name"><?=$row['fullname']?></div>

            <div class="info-box">
                <p><strong>Phone:</strong> <?=$row['phone']?></p>
                <p><strong>Email:</strong> <?=$row['email']?></p>
                <p><strong>Zone:</strong> <?=$row['zone_name']?></p>
                <p><strong>City:</strong> <?=$row['city_name']?></p>
                <p><strong>Address:</strong> <?=$row['address']?></p>
            </div>

         

    </div>
    <div id="print-card" style="display:none;"></div>


</div>

<div class="receipt-actions">
                <button class="btn-print" onclick="printReceipt()">
                    🖨️ Print
                </button>

                <button class="btn-download" onclick="downloadPNG()">
                    ⬇️ Download
                </button>
            </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<script>
function printReceipt(){
    window.print();
}


function downloadPNG() {
    const element = document.querySelector('.id-card');

    // Save current styles
    const originalFilter = element.style.backdropFilter;
    const originalOpacity = element.style.opacity;

    // Remove filter/opacity for export
    element.style.backdropFilter = 'none';
    element.style.opacity = '1';

    html2canvas(element, {
        scale: 6,
        useCORS: true,
        backgroundColor: null
    }).then(canvas => {
        const imgData = canvas.toDataURL("image/png");
        const link = document.createElement("a");
        link.href = imgData;
        link.download = "ID_CARD_<?= $uid ?>.png";
        link.click();

        // Restore original styles
        element.style.backdropFilter = originalFilter;
        element.style.opacity = originalOpacity;
    });
}



</script>

<?php
include("footer.php");
}else{
include("index.php");
}
?>
