<?php
include("header.php");
?>

<main class="qr-page">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-8">

            <div class="qr-card shadow-lg p-4 rounded">

                <!-- ✅ Title -->
                <div class="text-center mb-4">
                    <h2 class="fw-bold gradient-text">Scan & Pay</h2>
                    <p class="text-muted">Secure Digital Payment System</p>
                </div>

                <div class="row align-items-center">

                    <!-- ✅ QR CODE -->
                    <div class="col-md-5 text-center mb-4 mb-md-0">
                        <div class="qr-box">
                            <img src="upload/qrcode.png" alt="QR Code" class="img-fluid qr-img">
                        </div>
                        <p class="mt-3 fw-bold text-success">Scan using any UPI App</p>
                    </div>

                    <!-- ✅ BANK DETAILS -->
                    <div class="col-md-7">

                        <div class="bank-details">

                            <h5 class="fw-bold mb-3">Bank Account Details</h5>

                            <!-- <div class="info-row">
                                <span>Account Name</span>
                                <b>Jain Society Trust</b>
                            </div> -->

                            <div class="info-row">
                                <span>Account Number</span>
                                <b>1136216044</b>
                            </div>

                            <div class="info-row">
                                <span>Bank Name</span>
                                <b>Central Bank OF India</b>
                            </div>

                            <div class="info-row">
                                <span>IFSC Code</span>
                                <b>CBIN0282102</b>
                            </div>

                            <div class="info-row">
                                <span>Branch</span>
                                <b>Maskasath Nagpur Branch</b>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- ✅ Footer Note -->
                <div class="text-center mt-4 note-glow">
                    <i class="bi bi-shield-lock-fill me-1"></i>
                    All payments are fully secure & encrypted
                </div>

            </div>

        </div>

    </div>

</div>

</main>

<style>
/* ✅ Background */
.qr-page{
    min-height: 100vh;
}

/* ✅ Main Card */
.qr-card{
    background: rgba(255,255,255,0.95);
    animation: fadeUp 0.8s ease-in-out;
}

/* ✅ Gradient Text */
.gradient-text{
    background: linear-gradient(45deg, #ff9800, #ff5722);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ✅ QR Styling */
.qr-box{
    padding: 15px;
    border-radius: 20px;
    background: white;
    box-shadow: 0 0 25px rgba(0,0,0,0.15);
    animation: pulse 2s infinite;
}

.qr-img{
    max-width: 220px;
}

/* ✅ Bank Info */
.bank-details{
    background: #f8f9fa;
    padding: 20px;
    border-radius: 15px;
}

.info-row{
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dashed #ccc;
    font-size: 15px;
}

/* ✅ Glowing Note */
.note-glow{
    font-weight: bold;
    color: green;
    animation: glow 2s infinite;
}

/* ✅ Animations */
@keyframes fadeUp{
    from{opacity:0; transform: translateY(30px);}
    to{opacity:1; transform: translateY(0);}
}

@keyframes pulse{
    0%{transform:scale(1);}
    50%{transform:scale(1.05);}
    100%{transform:scale(1);}
}

@keyframes glow{
    0%{opacity:0.6;}
    50%{opacity:1;}
    100%{opacity:0.6;}
}

/* ✅ Mobile Responsive */
@media(max-width:768px){
    .qr-img{
        max-width: 180px;
    }
}
</style>

<?php
include("footer.php");
?>
