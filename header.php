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
    <title>Jain Society</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Animate.css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <link rel="stylesheet" href="dataTables.dataTables.min.css">
    
    <link rel="stylesheet" href="style.css">

    <style>
html, body {
    max-width: 100%;
    overflow-x: hidden !important;
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
      <ul class="navbar-nav ms-auto">

        <!-- ✅ COMMON LINKS -->
      <li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'index.php') ? 'active-link' : '' ?>" href="index.php">Home</a>
</li>
     <li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'about.php') ? 'active-link' : '' ?>" href="about.php">About Us</a>
</li>

<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showGallery.php') ? 'active-link' : '' ?>" href="showGallery.php">Gallery</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showNews.php') ? 'active-link' : '' ?>" href="showNews.php">News</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showCommity.php') ? 'active-link' : '' ?>" href="showCommity.php">Commity</a>
</li>
<li class="nav-item">
  <a class="nav-link text-white <?= ($currentPage == 'showEvents.php') ? 'active-link' : '' ?>" href="showEvents.php">Events</a>
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




        <li class="nav-item"><a class="nav-link text-white" href="https://www.matrimonysoftware.in">Matrimony</a></li>
     
<?php if(isset($_SESSION["uname"]) && $_SESSION["utype"] == "user"){ ?>

    <!-- ✅ USER LOGGED IN -->
    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'userPage.php') ? 'active-link' : '' ?>" href="userPage.php">
        Dashboard
      </a>
    </li>

<?php } else if(isset($_SESSION["uname"]) && $_SESSION["utype"] == "admin"){ ?>

    <!-- ✅ ADMIN LOGGED IN -->
    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'adminPage.php') ? 'active-link' : '' ?>" href="adminPage.php">
        Dashboard
      </a>
    </li>

<?php } else if(isset($_SESSION["uname"]) && $_SESSION["utype"] == "accountant"){ ?>

    <!-- ✅ ACCOUNTANT LOGGED IN -->
    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'accountantPage.php') ? 'active-link' : '' ?>" href="accountantPage.php">
        Dashboard
      </a>
    </li>

<?php } else { ?>

    <!-- ✅ NOT LOGGED IN -->
    <li class="nav-item">
      <a class="nav-link text-white <?= ($currentPage == 'login.php') ? 'active-link' : '' ?>" href="login.php">
        Login
      </a>
    </li>

<?php } ?>

      </ul>
    </div>

  </div>
</nav>


