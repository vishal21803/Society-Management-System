<?php
include("header.php");
?>
<style>
     .hero {
            background: url('./upload/kaivalya-dham-0.jpg') ;
            background-size: cover;
            background-repeat: no-repeat;
            padding: 150px 0;
            color: white;
            text-shadow: 1px 1px 3px black;
        }
        .feature-icon {
            font-size: 40px;
            color: #16a34a;
        }
</style>

<main>
<!-- ========== HERO SECTION ========== -->
<section class="hero text-center">
    <div class="container">
        <h1 class="fw-bold display-4">Welcome to Our Jain Society</h1>
        <p class="lead">Connecting Jain families, culture, values & community together.</p>
        <?php if(!isset($_SESSION["uname"])) { ?>

        <a href="register.php" class="btn btn-warning btn-lg mt-3" style="color:white;">Join Our Society</a>

        <?php } ?>

    </div>
</section>

<!-- ========== ABOUT SECTION ========== -->
<section id="about" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-4">About Us</h2>
        <p class="text-center w-75 mx-auto">
            Our Jain Society is dedicated to promoting Jain culture, unity and welfare.
            We work towards organizing religious events, social activities, community development 
            and providing support to all our members.
        </p>
    </div>
</section>

<!-- ========== FEATURES SECTION ========== -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Our Features</h2>

        <div class="row g-4 text-center">
            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded">
                    <div class="feature-icon mb-3">🛕</div>
                    <h5 class="fw-bold">Temple Information</h5>
                    <p>Explore nearby Jain temples and their timings.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded">
                    <div class="feature-icon mb-3">🧘</div>
                    <h5 class="fw-bold">Community Events</h5>
                    <p>Religious, cultural & youth events updated regularly.</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="p-4 bg-white shadow rounded">
                    <div class="feature-icon mb-3">📜</div>
                    <h5 class="fw-bold">Member Directory</h5>
                    <p>Find members based on zone & city structure.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== ZONES & CITIES ========== -->
<!-- <section id="zones" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Zones & Cities</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">North Zone</h5>
                    <ul>
                        <li>City 1</li>
                        <li>City 2</li>
                        <li>City 3</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">South Zone</h5>
                    <ul>
                        <li>City 4</li>
                        <li>City 5</li>
                        <li>City 6</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">West Zone</h5>
                    <ul>
                        <li>City 7</li>
                        <li>City 8</li>
                        <li>City 9</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> -->

<?php if(!isset($_SESSION["uname"])) { ?>
    
<!-- ========== MEMBERSHIP SECTION ========== -->
<section id="membership" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Membership Plans</h2>

        <div class="row g-4 justify-content-center">
            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded text-center">
                    <h4 class="fw-bold">Yearly Membership</h4>
                    <p class="lead">₹500 / year</p>
                    <a href="register.php" class="btn btn-success">Join Now</a>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-4 bg-white shadow rounded text-center border border-success">
                    <h4 class="fw-bold">Lifetime Membership</h4>
                    <p class="lead">₹5000 / once</p>
                    <a href="register.php" class="btn btn-success">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php } ?>

<!-- ========== NEWS & EVENTS ========== -->
<section id="events" class="py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Latest News & Events</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">Diwali Mahotsav</h5>
                    <small>Date: 15 Nov 2025</small>
                    <p class="mt-2">Grand celebration & cultural programs.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">Blood Donation Camp</h5>
                    <small>Date: 22 Dec 2025</small>
                    <p class="mt-2">Organized by youth wing of society.</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 bg-light rounded shadow-sm">
                    <h5 class="fw-bold">Paryushan Parv</h5>
                    <small>Date: 1 Sep 2025</small>
                    <p class="mt-2">Full-fledged spiritual event.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========== GALLERY SECTION ========== -->
<section id="gallery" class="py-5 bg-light">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Gallery</h2>

        <div class="row g-3">
            <div class="col-md-4"><img src="g1.jpg" class="img-fluid rounded"></div>
            <div class="col-md-4"><img src="g2.jpg" class="img-fluid rounded"></div>
            <div class="col-md-4"><img src="g3.jpg" class="img-fluid rounded"></div>
        </div>
    </div>
</section>


</main>


<?php
include("footer.php");
?>
