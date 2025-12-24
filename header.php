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

    <title>SocioManage</title>

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

    <!-- LOGO -->
    <a class="navbar-brand fw-bold text-white d-flex align-items-center"
   href="index.php"
   style="font-size: 1.6rem;">

    <i class="bi bi-buildings me-2" style="font-size: 4rem;"></i>
    SocioManage
</a>


    <!-- mobile button -->
    <button class="btn text-dark d-lg-none"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#mobileMenu" >
      <i class="bi bi-list fs-1"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">

 <?php if(!isset($_SESSION["uname"])) { ?> 

        <!-- PUBLIC MENU ONLY -->
        <!-- <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'index.php') ? 'active-link' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'about.php') ? 'active-link' : '' ?>" href="about.php">About Us</a>
        </li>

        <li class="nav-item dropdown-custom">
            <a class="nav-link text-white" href="#">Updates</a>
            <div class="dropdown-custom-menu">
                <a class="dropdown-item-custom" href="showNews.php">News</a>
                <a class="dropdown-item-custom" href="showEvents.php">Events</a>
                <a class="dropdown-item-custom" href="showGallery.php">Gallery</a>
                
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
            <a class="nav-link text-white" href="#">Committee</a>
            <div class="dropdown-custom-menu">
                <a class="dropdown-item-custom" href="currentCommity.php">Current Committee</a>
                <a class="dropdown-item-custom" href="pastCommity.php">Past Committee</a>
                <a class="dropdown-item-custom" href="showMembers.php">Our Members</a>
                <a class="dropdown-item-custom" href="showServices.php">Our Services</a>
                <a class="dropdown-item-custom" href="showNeed.php">Our Requirement</a>
            </div>
        </li>

        <li class="nav-item"><a class="nav-link text-white"  href="https://jainkhandelwal.org/matrimony/">Matrimony</a></li> -->

<?php } ?>



        <!-- =============================== -->
        <!--        ROLE BASED MENUS        -->
        <!-- =============================== -->

        <!-- ========== ADMIN MENUS ========== -->
        <?php if(isset($_SESSION["uname"],$_SESSION["utype"]) && $_SESSION["utype"]=="admin"){ ?>

            <!-- MASTER -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">Master</a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="dataTableZones.php">Manage Zones</a>
                    <a class="dropdown-item-custom" href="dataTableCities.php">Manage Cities</a>
                    <a class="dropdown-item-custom" href="dataTableMember.php">Manage Members</a>
                    <a class="dropdown-item-custom" href="manageCommity.php">Manage Committee</a>
                    <a class="dropdown-item-custom" href="manage_news.php">Manage News</a>
                    <a class="dropdown-item-custom" href="manage_events.php">Manage Events</a>
                    <a class="dropdown-item-custom" href="manage_gallery.php">Manage Gallery</a>
                     <a class="dropdown-item-custom" href="datatTableDownload.php">Manage Download</a>

                </div>
            </li>

            <!-- TRANSACTION -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">Transaction</a>
                <div class="dropdown-custom-menu">
                   <a class="dropdown-item-custom" href="admin-payments.php">Bills/Receipt History</a>
                    <a class="dropdown-item-custom" href="manageBills.php">Manage Bills</a>
                    <a class="dropdown-item-custom" href="manageReceipt.php">Manage Receipt</a>
                    <a class="dropdown-item-custom" href="manageExpenses.php"> Manage Expenses</a>
                    <a class="dropdown-item-custom" href="manage_req.php">Manage Requests</a>
                    <a class="dropdown-item-custom" href="contactQueries.php">Contact Queries</a>
                    <a class="dropdown-item-custom" href="adminMessages.php">Chat</a>
                </div>
            </li>

            <!-- REPORTS -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">Reports</a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="manageReports.php">All Reports</a>
                       <a class="dropdown-item-custom" href="reportReceive.php">Receivable Report</a>
                        <a class="dropdown-item-custom" href="reportBill.php">Bill Report</a>
                </div>
            </li>

            <!-- PROFILE -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white fw-semibold dropdown-toggle-custom d-flex align-items-center gap-2" href="javascript:void(0)">
                    Profile
                </a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="">Edit Profile</a>
                    <a class="dropdown-item-custom" href="logout.php">Logout</a>
                </div>
            </li>


        <!-- ========== USER MENUS ========== -->
        <?php } elseif(isset($_SESSION["uname"],$_SESSION["utype"]) && $_SESSION["utype"]=="user"){ ?>

            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">Updates</a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="showNews.php">News</a>
                    <a class="dropdown-item-custom" href="showEvents.php">Events</a>
                    <a class="dropdown-item-custom" href="showGallery.php">Gallery</a>
                  
                </div>
            </li>

            <!-- TRANSACTION -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">Transactions</a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="purchaseHistory.php">Membership History</a>
                    <a class="dropdown-item-custom" href="manageFamily.php">My Family</a>
                    <a class="dropdown-item-custom" href="userMessages.php">My Chat</a>
                    <a class="dropdown-item-custom" href="userId.php">My I-Card</a>
                      <a class="dropdown-item-custom" href="show_downloads.php">My Downloads</a>
                    <a class="dropdown-item-custom" href="manageServices.php">My Services</a>
                    <a class="dropdown-item-custom" href="manageNeed.php">My Requirement</a>
                </div>
            </li>

            <!-- PROFILE -->
            <li class="nav-item dropdown-custom">
                <a class="nav-link text-white" href="#">   <?php
          if(isset($_SESSION["member_id"])){
                     $imgiD=$_SESSION["member_id"];

           include("connectdb.php");
           $rsImg=mysqli_query($con,"select photo from sens_members where member_id='$imgiD'");
           while($imgr=mysqli_fetch_array($rsImg)){
            $pic=$imgr["photo"];

           
          
          ?>
    <!-- 👤 Profile Image -->
    <img src="upload/member/<?php echo $pic ; ?>" class="nav-profile-img">
    <?php }}?> Profile</a>
                <div class="dropdown-custom-menu">
                    <a class="dropdown-item-custom" href="editProfile.php">Edit Profile</a>
                    <a class="dropdown-item-custom" href="logout.php">Logout</a>
                </div>
            </li>


        <!-- ========== NOT LOGGED IN ========== -->
        <?php } else { ?>
               <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'index.php') ? 'active-link' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'about.php') ? 'active-link' : '' ?>" href="about.php">About Us</a>
        </li>

        <li class="nav-item dropdown-custom">
            <a class="nav-link text-white" href="#">Updates</a>
            <div class="dropdown-custom-menu">
                <a class="dropdown-item-custom" href="showNews.php">News</a>
                <a class="dropdown-item-custom" href="showEvents.php">Events</a>
                <a class="dropdown-item-custom" href="showGallery.php">Gallery</a>
                
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'showDownloads.php') ? 'active-link' : '' ?>" href="showDownloads.php">Downloads</a>
        </li>

       
        <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'showContact.php') ? 'active-link' : '' ?>" href="showContact.php">Contact Us</a>
        </li>

        <li class="nav-item dropdown-custom">
            <a class="nav-link text-white" href="#">Committee</a>
            <div class="dropdown-custom-menu">
                <a class="dropdown-item-custom" href="currentCommity.php">Current Committee</a>
                <a class="dropdown-item-custom" href="pastCommity.php">Past Committee</a>
                <a class="dropdown-item-custom" href="showMembers.php">Our Members</a>
                <a class="dropdown-item-custom" href="showServices.php">Our Services</a>
                <a class="dropdown-item-custom" href="showNeed.php">Our Requirement</a>
            </div>
        </li>

         
         <li class="nav-item">
            <a class="nav-link text-white <?= ($currentPage == 'login.php') ? 'active-link' : '' ?>" href="login.php">Login</a>
        </li>
        <?php } ?>

      </ul>
    </div>

  </div>
</nav>



<!-- ================= MOBILE MENU ================== -->

<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileMenu">

    <div class="offcanvas-header">
        <h5 class="fw-bold">Menu</h5>
        <button class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>

    <div class="offcanvas-body p-0">

        <ul class="list-unstyled mobile-menu">
<?php if(!isset($_SESSION["uname"])) { ?>
            <!-- <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>

            <li class="menu-dropdown">
                <a data-bs-toggle="collapse" data-bs-target="#mobUpdate">Updates ▾</a>
                <ul class="collapse" id="mobUpdate">
                    <li><a href="showNews.php">News</a></li>
                    <li><a href="showEvents.php">Events</a></li>
                    <li><a href="showGallery.php">Gallery</a></li>
                </ul>
            </li>

            <li><a href="showDownloads.php">Downloads</a></li>
            <li><a href="showDonate.php">Donation</a></li>
            <li><a href="showContact.php">Contact Us</a></li>

            <li class="menu-dropdown">
                <a data-bs-toggle="collapse" data-bs-target="#mobCommittee">Committee ▾</a>
                <ul class="collapse" id="mobCommittee">
                  <li><a  href="currentCommity.php">Current Committee</a></li>
                  <li><a  href="pastCommity.php">Past Committee</a></li>
                  <li><a  href="showMembers.php">Our Members</a></li>
                  <li><a  href="showServices.php">Our Services</a></li>
                  <li><a  href="showNeed.php">Our Requirement</a></li>
                </ul>
            </li>
            <li><a  href="https://jainkhandelwal.org/matrimony/">Matrimony</a></li> -->
            <?php } ?>
            
            

            <!-- Admin Mob -->
            <?php if(isset($_SESSION["utype"]) && $_SESSION["utype"]=="admin"){ ?>

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobMaster">Master ▾</a>
                    <ul class="collapse" id="mobMaster">
                        <li><a href="dataTableZones.php">Manage Zones</a></li>
                        <li><a href="dataTableCities.php">Manage Cities</a></li>
                        <li><a href="dataTableMember.php">Manage Members</a></li>
                        <li><a href="manageCommity.php">Manage Committee</a></li>
                        <li><a  href="manage_news.php">Manage News</a></li>
                         <li><a  href="manage_events.php">Manage Events</a></li>
                         <li><a  href="manage_gallery.php">Manage Gallery</a></li>
                         <li> <a  href="datatTableDownload.php">Manage Download</a></li>
                    
                    </ul>
                </li>

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobTrans">Transaction ▾</a>
                    <ul class="collapse" id="mobTrans">
                      <li><a  href="admin-payments.php">Bills/Receipt History</a></li>
                        <li><a href="manageBills.php">Manage Bills</a></li>
                        <li><a href="manageReceipt.php">Manage Receipt</a></li>
                        <li><a href="manageExpenses.php">Manage Expenses</a></li>
                        <li><a href="manage_req.php">Manage Requests</a></li>
                        <li><a  href="contactQueries.php">Contact Queries</a></li>
                         <li><a  href="adminMessages.php">Chat</a></li>
                    
                    </ul>
                </li>

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobReports">Reports ▾</a>
                    <ul class="collapse" id="mobReports">
                      <li> <a  href="manageReports.php">All Reports</a></li>
                      <li><a  href="reportReceive.php">Receivable Report</a></li>
                      <li><a  href="reportBill.php">Bill Report</a></li>
                      
                       
                        
                    </ul>
                </li>

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobProf">Profile ▾</a>
                    <ul class="collapse" id="mobProf">
                        <li><a href="">Edit Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>

            <?php } elseif(isset($_SESSION["utype"]) && $_SESSION["utype"]=="user"){ ?>

              
                    
                    

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobUpdUser">Updates ▾</a>
                    <ul class="collapse" id="mobUpdUser">
                        <li><a  href="showNews.php">News</a></li>
                        <li><a  href="showEvents.php">Events</a></li>
                        <li><a  href="showGallery.php">Gallery</a></li>
                       
                    </ul>
                </li>


                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobTransUser">Transaction ▾</a>
                    <ul class="collapse" id="mobTransUser">
                        <li><a href="purchaseHistory.php">Membership History</a></li>
                        <li><a href="manageFamily.php">My Family</a></li>
                        <li> <a  href="userMessages.php">My Chat</a></li>
                        <li> <a  href="userId.php">My I-Card</a></li>
                        <li> <a  href="show_downloads.php">My Downloads</a></li>
                        <li><a href="manageServices.php">My Services</a></li>
                        <li><a href="manageNeed.php">My Requirement</a></li>
                    </ul>
                </li>

                <li class="menu-dropdown">
                    <a data-bs-toggle="collapse" data-bs-target="#mobProfUser">Profile ▾</a>
                    <ul class="collapse" id="mobProfUser">
                        <li><a href="editProfile.php">Edit Profile</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>

            <?php } else { ?>
                   <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>

            <li class="menu-dropdown">
                <a data-bs-toggle="collapse" data-bs-target="#mobUpdate">Updates ▾</a>
                <ul class="collapse" id="mobUpdate">
                    <li><a href="showNews.php">News</a></li>
                    <li><a href="showEvents.php">Events</a></li>
                    <li><a href="showGallery.php">Gallery</a></li>
                </ul>
            </li>

            <li><a href="showDownloads.php">Downloads</a></li>
            <li><a href="showContact.php">Contact Us</a></li>

            <li class="menu-dropdown">
                <a data-bs-toggle="collapse" data-bs-target="#mobCommittee">Committee ▾</a>
                <ul class="collapse" id="mobCommittee">
                  <li><a  href="currentCommity.php">Current Committee</a></li>
                  <li><a  href="pastCommity.php">Past Committee</a></li>
                  <li><a  href="showMembers.php">Our Members</a></li>
                  <li><a  href="showServices.php">Our Services</a></li>
                  <li><a  href="showNeed.php">Our Requirement</a></li>
                </ul>
            </li>
                <li><a href="login.php">Login</a></li>
            <?php } ?>

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





