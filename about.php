<?php include("header.php"); ?>

<main class="about-page">

<!-- 🔷 HERO SECTION -->
<section class="about-hero text-center text-white d-flex align-items-center">
    <div class="container animate-fade-up">
        <h1 class="fw-bold">Society Management System</h1>
        <p class="lead">
            A complete digital solution for managing members, families & society operations
        </p>
    </div>
</section>

<!-- 🔷 ABOUT INTRO -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-12 animate-left">
            <h2 class="fw-bold text-warning mb-3">About the Project</h2>
            <p>
                The <b>SocioManage</b> is a web-based application designed to
                simplify and automate the day-to-day management of societies and organizations.
                It provides a centralized platform to manage members, family details,
                requests, approvals, and administrative tasks efficiently.
            </p>
            <p>
                This system reduces paperwork, improves accuracy, and ensures
                transparent data handling while giving administrators complete control
                over society records.
            </p>
        </div>
    </div>
</section>

<!-- 🔷 CORE FEATURES -->
<section class="bg-light py-5">
    <div class="container animate-right">
        <h2 class="fw-bold text-center mb-4">Core Features</h2>
        <p class="text-center mb-4">
            Built to handle real-world society management needs with scalability and ease of use.
        </p>

        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-people-fill"></i>
                    <h5>Member Management</h5>
                    <p>Add, update and manage member profiles with ease.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-person-lines-fill"></i>
                    <h5>Family Records</h5>
                    <p>Maintain detailed family member information for each member.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-geo-alt-fill"></i>
                    <h5>Zone & City Mapping</h5>
                    <p>Organize members based on zones and cities for better filtering.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 🔷 SYSTEM OBJECTIVES -->
<section class="container py-5">
    <div class="row g-4">
        <div class="col-md-6 animate-left">
            <div class="about-box">
                <h3 class="text-success fw-bold">System Objectives</h3>
                <ul>
                    <li>✔️ Centralized data management</li>
                    <li>✔️ Faster access to member information</li>
                    <li>✔️ Reduced manual errors</li>
                    <li>✔️ Role-based admin & user access</li>
                    <li>✔️ Secure and structured database</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 animate-right">
            <div class="about-box">
                <h3 class="text-primary fw-bold">Why This System?</h3>
                <p>
                    Managing large numbers of members manually can be time-consuming
                    and error-prone. This project provides a structured and scalable
                    solution that allows societies to operate digitally, efficiently,
                    and transparently.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- 🔷 MODULES -->
<section class="bg-warning-subtle py-5">
    <div class="container animate-fade-up">
        <h2 class="fw-bold text-center mb-4">System Modules</h2>

        <div class="row g-4 text-center">
            <div class="col-md-4"><div class="service-box">👤 Member Module</div></div>
            <div class="col-md-4"><div class="service-box">👨‍👩‍👧 Family Module</div></div>
            <div class="col-md-4"><div class="service-box">📍 Zone & City Management</div></div>
            <div class="col-md-4"><div class="service-box">📄 Requests & Approvals</div></div>
            <div class="col-md-4"><div class="service-box">📊 Reports & Filters</div></div>
            <div class="col-md-4"><div class="service-box">🔐 Admin Control Panel</div></div>
        </div>
    </div>
</section>

<!-- 🔷 BENEFITS -->
<section class="container py-5 animate-left">
    <h2 class="fw-bold mb-4 text-center">System Benefits</h2>
    <div class="row text-center g-4">
        <div class="col-md-3"><div class="impact-box">Efficiency</div></div>
        <div class="col-md-3"><div class="impact-box">Accuracy</div></div>
        <div class="col-md-3"><div class="impact-box">Transparency</div></div>
        <div class="col-md-3"><div class="impact-box">Scalability</div></div>
    </div>
</section>

<!-- 🔷 CALL TO ACTION -->
<section class="about-join text-center text-white py-5">
    <div class="container animate-fade-up">
        <h2 class="fw-bold">Smart Management Starts Here</h2>
        <p>
            A modern solution built to simplify society administration and member management.
        </p>
    </div>
</section>

</main>

<!-- 🔷 STYLES -->
<style>
.about-hero{
    height:320px;
    background: linear-gradient(to right, #f39c12, #f1c40f);
}

.about-card{
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 5px 15px rgba(0,0,0,0.15);
    transition:0.4s;
}
.about-card:hover{
    transform:translateY(-8px);
}
.about-card i{
    font-size:40px;
    color:#f39c12;
}
.about-box{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 10px 20px rgba(0,0,0,0.1);
}
.service-box{
    background:#fff;
    padding:18px;
    border-radius:10px;
    font-weight:600;
    box-shadow:0 5px 10px rgba(0,0,0,0.1);
}
.impact-box{
    background:#f5f5f5;
    padding:20px;
    border-radius:12px;
    font-weight:700;
}
.about-join{
    background:linear-gradient(to right,#232526,#414345);
}

/* Animations */
.animate-left{animation:slideLeft 1s;}
.animate-right{animation:slideRight 1s;}
.animate-fade-up{animation:fadeUp 1s;}

@keyframes slideLeft{from{opacity:0;transform:translateX(-60px);}to{opacity:1;}}
@keyframes slideRight{from{opacity:0;transform:translateX(60px);}to{opacity:1;}}
@keyframes fadeUp{from{opacity:0;transform:translateY(60px);}to{opacity:1;}}
</style>

<?php include("footer.php"); ?>
