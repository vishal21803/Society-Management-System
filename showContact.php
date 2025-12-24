<?php include("header.php"); ?>

<style>
    /* ========= Contact Page Styling ========= */

    .contact-section {
        padding: 60px 0;
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    .contact-card {
        background: rgba(255, 255, 255, 0.65);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        animation: fadeIn 0.9s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .contact-info-box {
        margin-bottom: 25px;
        padding: 20px 22px;
        background: #ffffff;
        border-left: 5px solid #fcc203;
        border-radius: 10px;
        transition: 0.3s;
        box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    }

    .contact-info-box:hover {
        transform: translateX(10px);
        box-shadow: 0 5px 18px rgba(0,0,0,0.15);
    }

    .contact-info-box i {
        color: #fcc203;
        font-size: 25px;
        margin-right: 12px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 16px;
        box-shadow: none;
        border: 1px solid #ccc;
    }

    .form-control:focus {
        border-color: #fcc203;
        box-shadow: 0 0 8px rgba(255, 217, 0, 0.4);
    }

    .btn-submit {
        background: #fcc203;
        color: white;
        border-radius: 12px;
        padding: 12px;
        width: 100%;
        transition: 0.3s;
        font-weight: bold;
    }

    .btn-submit:hover {
        background: #988405ff;
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,123,255,0.3);
    }
</style>

<main>
    <section class="contact-section">
        <div class="container">
            <div class="row g-4">

                <!-- LEFT SIDE CONTACT INFO -->
                <div class="col-md-5">
                    <div class="contact-card">

                        <h3 class="fw-bold mb-4">📞 Contact Information</h3>

                        <!-- Email -->
                        <div class="contact-info-box d-flex align-items-center">
                            <i class="bi bi-envelope-fill"></i>
                            <div>
                                <strong>Email:</strong><br>
                                123vishal18910@gmail.com
                            </div>
                        </div>

                        <!-- Phone 1 -->
                        <div class="contact-info-box d-flex align-items-center">
                            <i class="bi bi-telephone-fill"></i>
                            <div>
                                <strong>Phone:</strong><br>
                                +91 9479031066 
                                
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="contact-info-box d-flex align-items-center">
                            <i class="bi bi-geo-alt-fill"></i>
                            <div>
                                <strong>Address:</strong><br>
                                Bhilai,Chhattisgarh
                            </div>
                        </div>

                    </div>
                </div>

                <!-- RIGHT SIDE FORM -->
                <div class="col-md-7">
                    <div class="contact-card">

                        <h3 class="fw-bold mb-4">✉️ Send Us a Message</h3>

                        <form action="save_contact.php" method="POST">

                            <!-- Subject -->
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>

                            <!-- Phone -->
                            <div class="mb-3">
<input type="number" 
       name="phone" 
       class="form-control" 
       placeholder="Phone Number" 
       id="phoneInput"
       required 
       oninput="if(this.value.length > 10) this.value = this.value.slice(0, 10);">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <textarea name="desc" rows="5" class="form-control" placeholder="Message..." required></textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn-submit">Submit</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ================= SUCCESS MODAL ================= -->
<div class="modal fade" id="successModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header" style="background:#fcc203; color:white;">
        <h5 class="modal-title">Message Sent ✔</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body text-center p-4">
        <h4 class="mb-3">🎉 Thank You!</h4>
        <p style="font-size:17px;">
            Your message has been sent successfully.<br>
            We will contact you soon!
        </p>
      </div>

      <div class="modal-footer">
        <button class="btn btn-warning fw-bold" data-bs-dismiss="modal">OK</button>
      </div>

    </div>
  </div>
</div>

<!-- AUTO OPEN MODAL WHEN sent=1 -->
<?php if(isset($_GET['sent']) && $_GET['sent'] == 1) { ?>
<script>
    var myModal = new bootstrap.Modal(document.getElementById('successModal'));
    myModal.show();
</script>
<?php } ?>
</main>

<?php include("footer.php"); ?>
