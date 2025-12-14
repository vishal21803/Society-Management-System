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

.dropdown-custom:hover .dropdown-custom-menu {
    display: block;
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

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
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
          <a class="dropdown-item-custom" href="contactQueries.php">Contact Queries</a>
          <a class="dropdown-item-custom" href="dataTableDownload.php">Manage Downloads</a>
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


