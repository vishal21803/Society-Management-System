<!-- admin_sidebar.php -->

<!-- Toggle button for small screens -->
<button class="btn btn-warning d-lg-none  " type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebarOffcanvas" aria-controls="adminSidebarOffcanvas">
    <i class="bi bi-list"></i> Menu
</button>

<!-- Sidebar for large screens -->
<div class="d-none d-lg-flex admin-sidebar flex-column p-3 text-white">
    <a href="#" class="admin-sidebar-brand d-flex align-items-center mb-3 text-white text-decoration-none">
        <span class="fs-4 fw-bold">User Panel</span>
    </a>
    <hr class="admin-sidebar-divider">
    <ul class="admin-sidebar-nav nav flex-column mb-auto">
       
        <li class="nav-item mb-2">
            <a href="purchaseHistory.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-people me-2"></i> Membership History
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="editProfile.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-gear me-2"></i> Your Profile
            </a>
        </li>

         <li class="nav-item mb-2">
            <a href="userMessages.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-chat-dots me-2"></i> Chat
            </a>
        </li>
       
        <li class="nav-item">
            <a href="logout.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
</div>

<!-- Offcanvas sidebar for small screens -->
<div class="offcanvas offcanvas-start text-white" tabindex="-1" id="adminSidebarOffcanvas" aria-labelledby="adminSidebarLabel" style="background: linear-gradient(to bottom, #ded7ccff, #363225ff);">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title text-dark fw-bold" id="adminSidebarLabel">Admin Panel</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0">
    <ul class="nav flex-column mb-auto">
       
        <li class="nav-item mb-2">
            <a href="purchaseHistory.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-people me-2"></i> Membership History
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="editProfile.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-gear me-2"></i> Your Profile
            </a>
        </li>
         <li class="nav-item mb-2">
            <a href="userMessages.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-chat-dots me-2"></i> Chat
            </a>
        </li>
       
        <li class="nav-item">
            <a href="logout.php" class="nav-link admin-sidebar-link text-white fw-semibold">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
        </li>
    </ul>
  </div>
</div>

<style>
.admin-sidebar {
    width: 250px;
    height: 100vh;
    background: linear-gradient(to bottom, #ded7ccff, #363225ff);
    box-shadow: 2px 0 8px rgba(217, 212, 212, 0.1);
}

.admin-sidebar-divider {
    border-color: rgba(255,255,255,0.4);
}

.admin-sidebar-link {
    transition: 0.3s;
    border-radius: 6px;
}

.admin-sidebar-link:hover {
    background-color: rgba(255, 69, 0, 0.3);
    color: #fff !important;
}

/* Optional: style offcanvas links same as sidebar */
.offcanvas .nav-link {
    padding: 0.75rem 1rem;
}
</style>
