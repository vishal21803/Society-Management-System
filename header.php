<?php
@session_start();
?>
<?php
$currentPage = basename($_SERVER['PHP_SELF']);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Jain Society</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="style.css">

    <style>
html, body {
    max-width: 100%;
    overflow-x: hidden !important;
}
/* --- Custom Hover Dropdown --- */
.dropdown-custom {
    position: relative;
}

.dropdown-custom-menu {
    position: absolute;
    top: 100%;
    left: 0;
    background: white;
    border-radius: 6px;
    min-width: 180px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    display: none;
    z-index: 999;
    background-color:   #FFB347;
}



.dropdown-item-custom {
    display: block;
    padding: 10px 15px;
    text-decoration: none;
    color: black !important;
    font-size: 15px;
}

.dropdown-item-custom:hover {
    background: #f2f2f2;
}

.nav-profile-img{
    width: 28px;
    height: 28px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid white;
}

/* ✅ Mobile dropdown fix */
@media (max-width: 991px) {

    .dropdown-custom-menu {
        position: static !important;
        display: none;
        box-shadow: none;
        background: #FFB347;
        margin-left: 15px;
        margin-top: 5px;
    }

    .dropdown-custom.show .dropdown-custom-menu {
        display: block;
    }
}

.dropdown-custom:hover .dropdown-custom-menu {
    display: block;
}

/* ✅ Mobile navbar full height & scroll */
@media (max-width: 991px) {

    .navbar-collapse {
        max-height: calc(100vh - 70px); /* header height minus */
        overflow-y: auto;
        padding-bottom: 30px;
    }

    /* Dropdown menu bhi scrollable ho */
    .dropdown-custom-menu {
        max-height: 250px;
        overflow-y: auto;
    }
}

.dropdown-toggle-custom::after {
    content: "▾";
    margin-left: 6px;
    font-size: 12px;
}

@media (max-width: 991px) {
    .dropdown-custom-menu {
        border-radius: 8px;
    }
}



/* Full screen white menu */
.offcanvas {
    width: 85% !important;
    max-width: 360px;
        background-color:   #FFB347;

}

/* Menu links */
.mobile-menu li a {
    display: block;
    padding: 14px 22px;
    font-size: 17px;
    color: #000;
    text-decoration: none;
}

.mobile-menu li a:hover {
    background: #f5f5f5;
}

/* Dropdown */
.menu-dropdown ul {
    padding-left: 20px;

}

.menu-dropdown ul li a {
    font-size: 15px;
    color: #444;
}

li{
  list-style-type: none;
}




</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top"
     style="background: linear-gradient(90deg, #FFB347, #FFCC33); box-shadow: 0 4px 6px rgba(0,0,0,0.1);">

  <div class="container">

    <!-- ✅ LOGO -->
    <a class="navbar-brand fw-bold text-white" href="index.php">
      <img src="upload/logo2.png" alt="" style="width:300px;" >
      
    </a>

    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button> -->

    <button class="btn text-dark d-lg-none"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileMenu" >
    <i class="bi bi-list fs-1"></i>
</button>


    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto ">

        <!-- ✅ COMMON LINKS -->
      <li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'index.php') ? 'active-link' : '' ?>" href="index.php">Home</a>
</li>
     <li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'about.php') ? 'active-link' : '' ?>" href="about.php">About Us</a>
</li>

<li class="nav-item dropdown-custom">
  <a class="nav-link text-white" href="#">Updates</a>
<div class="dropdown-custom-menu">
      <a class="dropdown-item-custom" href="showGallery.php">Gallery</a>
      <a class="dropdown-item-custom" href="showNews.php">News</a>
      <a class="dropdown-item-custom" href="showEvents.php">Events</a>
  </div>
</li>




<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showDownloads.php') ? 'active-link' : '' ?>" href="showDownloads.php">Downloads</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showDonate.php') ? 'active-link' : '' ?>" href="showDonate.php">Donation</a>
</li>

<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showContact.php') ? 'active-link' : '' ?>" href="showContact.php">Contact Us</a>
</li>

<li class="nav-item dropdown-custom">
  <a class="nav-link text-white" href="#">Commity</a>
<div class="dropdown-custom-menu">
      <a class="dropdown-item-custom" href="currentCommity.php">Current Commity</a>
      <a class="dropdown-item-custom" href="pastCommity.php">Past Commity</a> 
      <a class="dropdown-item-custom" href="showMembers.php">Members</a>
  </div>
</li>



        <li class="nav-item"><a class="nav-link text-white" href="https://www.matrimonysoftware.in">Matrimony</a></li>
<?php if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "user"){ ?>

   <li class="nav-item dropdown-custom">
  <a class="nav-link text-white" href="#">Dashboard</a>
<div class="dropdown-custom-menu">
      <a class="dropdown-item-custom" href="purchaseHistory.php">Membership History</a>
      <a class="dropdown-item-custom" href="manageFamily.php">My Family</a> 
      <a class="dropdown-item-custom" href="show_downloads.php">My Downloads</a>
      <a class="dropdown-item-custom" href="userMessages.php">Chat</a>

  </div>
</li>



      <li class="nav-item dropdown-custom">
  <a class="nav-link text-white fw-semibold dropdown-toggle-custom d-flex align-items-center gap-2"
     href="javascript:void(0)">
          <?php
          if(isset($_SESSION["member_id"])){
                     $imgiD=$_SESSION["member_id"];

           include("connectdb.php");
           $rsImg=mysqli_query($con,"select photo from sens_members where member_id='$imgiD'");
           while($imgr=mysqli_fetch_array($rsImg)){
            $pic=$imgr["photo"];

           
          
          ?>
    <!-- 👤 Profile Image -->
    <img src="upload/member/<?php echo $pic ; ?>" class="nav-profile-img">
    <?php }}?>

    Profile
  </a>

  <div class="dropdown-custom-menu">
      <a class="dropdown-item-custom" href="editProfile.php">Edit Profile</a>
      <a class="dropdown-item-custom" href="logout.php">Logout</a>
  </div>
</li>

<?php } else if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "admin"){ ?>

    <!-- <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'adminPage.php') ? 'active-link' : '' ?>" 
         href="adminPage.php">Dashboard</a>
    </li> -->

    <li class="nav-item dropdown-custom">
  <a class="nav-link text-white fw-semibold dropdown-toggle-custom" href="javascript:void(0)">
   Dashboard
  </a>
  <div class="dropdown-custom-menu">
          <a class="dropdown-item-custom" href="dataTableZones.php">Manage Zones</a>
          <a class="dropdown-item-custom" href="dataTableCities.php">Manage Cities</a>
          <a class="dropdown-item-custom" href="dataTableMember.php">Manage Members</a>
          <a class="dropdown-item-custom" href="manageCommity.php">Manage Commity</a>
          <a class="dropdown-item-custom" href="manage_events.php">Manage Events</a>
          <a class="dropdown-item-custom" href="manage_news.php">Manage News</a>
          <a class="dropdown-item-custom" href="admin-payments.php">Bill/Receipt History</a>
          <a class="dropdown-item-custom" href="manageBills.php">Manage Bills</a>
          <a class="dropdown-item-custom" href="manageReceipt.php">Manage Receipt</a>
          <a class="dropdown-item-custom" href="manageExpenses.php">Manage Expenses</a>

          <a class="dropdown-item-custom" href="contactQueries.php">Contact Queries</a>
          <a class="dropdown-item-custom" href="datatTableDownload.php">Manage Downloads</a>
          <a class="dropdown-item-custom" href="adminMessages.php">Manage Messages</a>
          <a class="dropdown-item-custom" href="manageReports.php">Manage Reports</a>




  </div>
</li>

  <li class="nav-item dropdown-custom">
  <a class="nav-link text-white fw-semibold dropdown-toggle-custom d-flex align-items-center gap-2"
     href="javascript:void(0)">
          <?php
          if(isset($_SESSION["member_id"])){
                     $imgiD=$_SESSION["member_id"];

           include("connectdb.php");
           $rsImg=mysqli_query($con,"select photo from sens_members where member_id='$imgiD'");
           while($imgr=mysqli_fetch_array($rsImg)){
            $pic=$imgr["photo"];

           
          
          ?>
    <!-- 👤 Profile Image -->
    <img src="upload/.<?php $pic?>" class="nav-profile-img">
    <?php }}?>

    Profile
  </a>

  <div class="dropdown-custom-menu">
      <a class="dropdown-item-custom" href="#">Edit Profile</a>
      <a class="dropdown-item-custom" href="logout.php">Logout</a>
  </div>
</li>



<?php } else if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "accountant"){ ?>

    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'accountantPage.php') ? 'active-link' : '' ?>" 
         href="accountantPage.php">Dashboard</a>
    </li>

<?php } else { ?>

    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'login.php') ? 'active-link' : '' ?>" 
         href="login.php">Login</a>
    </li>

<?php } ?>

      </ul>
    </div>

  </div>
</nav>

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">
  
  <!-- Header -->
  <div class="offcanvas-header">
    <h5 class="offcanvas-title fw-bold">Menu</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>

  <!-- Body -->
  <div class="offcanvas-body p-0">

    <ul class="list-unstyled mobile-menu">

      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About Us</a></li>
      <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#updateMenu">
          Update <span>▾</span>
        </a>
        <ul class="collapse" id="updateMenu">
          <li><a href="showNews.php">News</a></li>
          <li><a href="showEvents.php">Events</a></li>
          <li><a href="showGallery.php">Gallery</a></li>

        </ul>
      </li>
      <li><a href="showDownloads.php">Downloads</a></li>
      <li><a href="showDonate.php">Donation</a></li>
      <li><a href="showContact.php">Contact Us</a></li>
      
      <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#trainingMenu">
          Commity <span>▾</span>
        </a>
        <ul class="collapse" id="trainingMenu">
          <li><a href="currentCommity.php">Current Commity</a></li>
          <li><a href="pastCommity.php">Past Commity</a></li>
          <li><a href="showMembers.php">Members</a></li>
        </ul>
      </li>

      <li><a href="https://www.matrimonysoftware.in">Matrimony</a></li>
    
<?php if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "admin"){ ?>

     

      <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#adminDashMenu">
          Dashboard <span>▾</span>
        </a>
        <ul class="collapse" id="adminDashMenu">
     <li><a href="dataTableZones.php">Manage Zones</a></li>
    <li><a href="dataTableCities.php">Manage Cities</a></li>
    <li><a href="dataTableMember.php">Manage Members</a></li>
    <li><a href="manageCommity.php">Manage Commity</a></li>
    <li><a href="manage_events.php">Manage Events</a></li>
    <li><a href="manage_news.php">Manage News</a></li>
    <li><a href="admin-payments.php">Bill/Receipt History</a></li>
    <li><a href="manageBills.php">Manage Bills</a></li>
    <li><a href="manageReceipt.php">Manage Receipt</a></li>
    <li><a href="contactQueries.php">Contact Queries</a></li>
    <li><a href="datatTableDownload.php">Manage Downloads</a></li>
    <li><a href="adminMessages.php">Manage Messages</a></li>
    <li><a href="manageReports.php">Manage Reports</a></li>
        </ul>
      </li>


      <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#adminDashProf">
          Profile <span>▾</span>
        </a>
        <ul class="collapse" id="adminDashProf">
     <li><a href="">Edit Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
    
        </ul>
      </li>

      <?php } else if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "user") {?>
      
      
          <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#userDashMenu">
          Dashboard <span>▾</span>
        </a>
        <ul class="collapse" id="userDashMenu">
     <li><a  href="purchaseHistory.php">Membership History</a></li>
    <li><a  href="manageFamily.php">My Family</a></li>
    <li><a  href="show_downloads.php">My Downloads</a></li>
    <li><a  href="userMessages.php">Chat</a></li>
   
        </ul>
      </li>


         <li class="menu-dropdown">
        <a href="#" data-bs-toggle="collapse" data-bs-target="#userDashProf">
          Profile <span>▾</span>
        </a>
        <ul class="collapse" id="userDashProf">
     <li><a href="editProfile.php">Edit Profile</a></li>
    <li><a href="logout.php">Logout</a></li>
    
        </ul>
      </li>


      <?php }  else if(isset($_SESSION["uname"], $_SESSION["utype"]) && $_SESSION["utype"] == "accountant") {?>
      
      
      
      
      
      <?php } else { ?>
        <li><a href="login.php">Login</a></li>


        <?php  } ?>
      

    </ul>

  </div>
</div>


<script>
document.querySelectorAll('.dropdown-custom > a').forEach(link => {
    link.addEventListener('click', function (e) {

        // Sirf mobile ke liye
        if (window.innerWidth <= 991) {
            e.preventDefault();

            let parent = this.parentElement;

            // Close others
            document.querySelectorAll('.dropdown-custom').forEach(d => {
                if (d !== parent) d.classList.remove('show');
            });

            parent.classList.toggle('show');
        }
    });
});
</script>


