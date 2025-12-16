<?php include("header.php"); ?>

<main class="about-page">

<!-- ✅ HERO SECTION -->
<section class="about-hero text-center text-white d-flex align-items-center">
    <div class="container animate-fade-up">
        <h1 class="fw-bold"><b>Shri Nagpur Prantiya Digambar Jain Khandelwal Sabha </b></h1>
        <p class="lead">Established in 1916 — A Legacy of Unity, Seva & Sanskar</p>
    </div>
</section>

<!-- ✅ ABOUT INTRO -->
<section class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-12 animate-left">
            <h2 class="fw-bold text-warning mb-3">About Our Sabha</h2>
            <p>
                The <b>Shri Nagpur Prantiya Digambar Jain Khandelwal Sabha </b> was founded in 1916 with a noble vision — to bring together families of the Khandela Gram (Rajasthan) who had spread across different parts of India, and to keep alive the shared values, culture, and spiritual heritage of our community.
            </p>
            <p>
                For more than a century, our Sabha has remained a trusted platform for connecting people, preserving traditions, and promoting community welfare. Today, our members are settled across India, yet our roots keep us united.
            </p>
        </div>
    </div>
</section>

<!-- ✅ HERITAGE -->
<section class="bg-light py-5">
    <div class="container animate-right">
        <h2 class="fw-bold text-center mb-4">Our Heritage — The Khandela Connection</h2>
        <p class="text-center mb-4">
            Our ancestors belonged to Khandela Gram, a culturally rich town in Rajasthan. As families moved across India for opportunities, the Sabha was formed to keep the bond strong.
        </p>

        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-flower1"></i>
                    <h5>Jain Values</h5>
                    <p>Spiritual discipline, compassion and truth.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-people-fill"></i>
                    <h5>Community Identity</h5>
                    <p>Khandelwal culture and traditions.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-card">
                    <i class="bi bi-heart-fill"></i>
                    <h5>Brotherhood</h5>
                    <p>Unity, harmony and mutual respect.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ✅ MISSION & VISION -->
<section class="container py-5">
    <div class="row g-4">
        <div class="col-md-6 animate-left">
            <div class="about-box">
                <h3 class="text-success fw-bold">Our Mission</h3>
                <ul>
                    <li>✔️ Cultural & social gatherings</li>
                    <li>✔️ Community support</li>
                    <li>✔️ Jain spiritual growth</li>
                    <li>✔️ Youth & education promotion</li>
                    <li>✔️ Welfare & connection programs</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6 animate-right">
            <div class="about-box">
                <h3 class="text-primary fw-bold">Our Vision</h3>
                <p>
To build a connected and empowered Jain community that honors its heritage, embraces modern values, and contributes positively to society — fostering spiritual growth, promoting compassion, encouraging youth involvement, and supporting cultural preservation for future generations. We aim to create a environment where every member feels valued, inspired, and united in purpose.                </p>
            </div>
        </div>
    </div>
</section>

<!-- ✅ WHAT WE DO -->
<section class="bg-warning-subtle py-5">
    <div class="container animate-fade-up">
        <h2 class="fw-bold text-center mb-4">What We Do</h2>

        <div class="row g-4 text-center">
            <div class="col-md-4"><div class="service-box">🛕 Religious Programs</div></div>
            <div class="col-md-4"><div class="service-box">🎉 Social Events & Sammelans</div></div>
            <div class="col-md-4"><div class="service-box">👩‍🎓 Youth & Women Empowerment</div></div>
            <div class="col-md-4"><div class="service-box">📚 Education Support</div></div>
            <div class="col-md-4"><div class="service-box">🏥 Health & Welfare</div></div>
            <div class="col-md-4"><div class="service-box">🤝 Member Assistance</div></div>
        </div>
    </div>
</section>

<!-- ✅ WHY WE MATTER -->
<section class="container py-5 animate-left">
    <h2 class="fw-bold mb-4 text-center">Why Our Sabha Matters</h2>
    <div class="row text-center g-4">
        <div class="col-md-3"><div class="impact-box">Unity</div></div>
        <div class="col-md-3"><div class="impact-box">Seva</div></div>
        <div class="col-md-3"><div class="impact-box">Sanskars</div></div>
        <div class="col-md-3"><div class="impact-box">Traditions</div></div>
    </div>
</section>

<!-- ✅ JOIN US -->
<section class="about-join text-center text-white py-5">
    <div class="container animate-fade-up">
        <h2 class="fw-bold">Join Us — Stay Connected</h2>
        <p>
            Whether you are a lifelong member or newly connecting to your roots, we welcome you to be an active part of our Sabha.
        </p>
        <a href="register.php" class="btn btn-light btn-lg mt-3">Become a Member</a>
    </div>
</section>

</main>

<!-- ✅ STYLES -->
<style>
.about-hero{
    height: 320px;
    background: linear-gradient(to right, #f39c12, #c0392b);
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
    background:linear-gradient(to right,#2c3e50,#34495e);
}

/* ✅ Animations */
.animate-left{animation: slideLeft 1s;}
.animate-right{animation: slideRight 1s;}
.animate-fade-up{animation: fadeUp 1s;}

@keyframes slideLeft{from{opacity:0;transform:translateX(-60px);}to{opacity:1;}}
@keyframes slideRight{from{opacity:0;transform:translateX(60px);}to{opacity:1;}}
@keyframes fadeUp{from{opacity:0;transform:translateY(60px);}to{opacity:1;}}
</style>

<?php include("footer.php"); ?>
