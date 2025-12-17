
<?php @session_start();
if(isset($_SESSION["uname"]) && $_SESSION["utype"]=='user')
{
include("header.php");
include("connectdb.php");

?>
<style>
.id-card{
    width: 420px;
    padding: 20px;
    border-radius: 20px;
    background: linear-gradient(135deg,#ffffffdd,#f4f4f4dd,#fff3cd);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 2px solid #ffc107;
    position: relative;
    overflow: hidden;
    margin-left: 550px;
}

@media (max-width: 576px) {
.id-card{
    width: 420px;
    padding: 20px;
    border-radius: 20px;
    background: linear-gradient(135deg,#ffffffdd,#f4f4f4dd,#fff3cd);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    border: 2px solid #ffc107;
    position: relative;
    overflow: hidden;
    margin-left: 10px;
}
  
}


/* logo at top */
.logo-area{
    text-align:center;
    margin-bottom:10px;
}
.logo-area img{
    width:200px;
    height:70px;
}

/* profile image */
.profile-pic{
    width:110px;
    height:110px;
    border-radius:50%;
    border:4px solid #fff;
    box-shadow:0 5px 15px rgba(0,0,0,.3);
    object-fit:cover;
    margin:auto;
    display:block;
}

.member-name{
    text-align:center;
    margin-top:10px;
    font-size:22px;
    font-weight:700;
    color:#000;
}

.info-box{
    background:#fff;
    padding:10px 15px;
    margin-top:10px;
    border-radius:15px;
    border:1px solid #ffc107;
}

.info-box p{
    margin:3px 0;
    font-size:15px;
    font-weight:500;
    color:#222;
}
.info-box strong{
    font-weight:700;
    color:#000;
}
.society-title{
    margin:5px 0;
    font-weight:700;
    font-size:18px;
}

.reg-info{
    font-size:12px;
    line-height:16px;
    color:#333;
    text-align:center;
    background:#fff8e1;
    padding:6px 10px;
    border-radius:10px;
    border:1px solid #ffc107;
    margin-top:6px;
}

.reg-info p{
    margin:0;
    font-weight:600;
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
<div class="d-flex  justify-content-center align-items-center" style="min-height:80vh;">
    <div class="flex-grow-1 p-4">
        <!-- Main content here -->
          <div class="id-card">

    <!-- LOGO SECTION -->
 <div class="logo-area">
    <img src="upload/logo2.png">


    <div class="reg-info">
        <p>पंजीकृत कार्यालय: छिंदवाड़ा (म.प्र.)</p>
        <p>पंजीकृत क्रमांक: 173/53/54</p>
        <p>कार्यालय : इतवारी, भाजीमंडी, फूलओली</p>
        <p>नागपुर - 440002</p>
    </div>
</div>

    <!-- PROFILE PIC -->
       <?php 
            if($row['balance_amount'] == 0){
                $picClass="border-radius:50%;";
            } else {
                $picClass="border-radius:15px;";
            }

            // fallback image if null
            $img = ($row["photo"]!="") ? $row["photo"] : "default.png";
            ?>

                        <img src="upload/member/<?=$img?>" class="profile-pic" style="<?=$picClass?>">


    <!-- NAME -->
    <div class="member-name"> <?=$row['fullname']?></div>

    <!-- DETAILS BOX -->
    <div class="info-box">
        <p><strong>Phone:</strong><?=$row['phone']?></p>
        <p><strong>Email:</strong><?=$row['email']?></p>
        <p><strong>Zone:</strong> <?=$row['zone_name']?></p>
        <p><strong>City:</strong> <?=$row['city_name']?></p>
      <p><strong>Address:</strong> <?=$row['address']?></p>


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
