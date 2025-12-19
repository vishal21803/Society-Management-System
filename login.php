<?php include("header.php"); ?>

<style>
    /* FIX CHECKBOX VISIBILITY */
.form-check-input {
    width: 1.2em;
    height: 1.2em;
    cursor: pointer;
    appearance: auto !important;
    -webkit-appearance: checkbox !important;
    opacity: 1 !important;
    background-color: #fff !important;
    border: 1px solid #ccc;
}

a.forgot-link:hover {
    text-decoration: underline;
    opacity: 0.85;
}


</style>
<main id="loginbody">
    <div class="glass-card text-center position-relative" id="loginBox">

        <h3 class="text-white mb-4">🔐 Login</h3>

        <!-- ✅ ERROR MESSAGE SECTION -->
      <?php
if(isset($_GET['regmsg'])){
    
    if($_GET['regmsg'] == 1){
        echo '<div id="loginAlert" class="alert alert-danger py-2">❌ Invalid Username</div>';
    }
    if($_GET['regmsg'] == 2){
        echo '<div id="loginAlert" class="alert alert-warning py-2">❌ Invalid Password</div>';
    }
    if($_GET['regmsg'] == 3){
        echo '<div id="loginAlert" class="alert alert-info py-2">
                ⏳ Your membership request is still <b>pending approval</b>.
              </div>';
    }
    if($_GET['regmsg'] == 4){
        echo '<div id="loginAlert" class="alert alert-danger py-2">
                ❌ Your membership request was <b>rejected</b>. Please contact admin.
              </div>';
    }
     if($_GET['regmsg'] == 5){
        echo '<div id="loginAlert" class="alert alert-danger py-2">
                Contact <b>Admin</b> to access your account.
              </div>';
    }
  
  
  


}
?>


        <form method="POST" action="checkLogin.php">

            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="👤 Email/Phone Number" required>
            </div>

            <!-- ✅ PASSWORD WITH SHOW/HIDE -->
            <div class="mb-3 position-relative">
    <input 
        type="password" 
        name="password" 
        id="password" 
        class="form-control" 
        placeholder="🔒 Password" 
        required
    >

  <i id="eyeIcon"
   class="bi bi-eye"
   onclick="togglePassword()"
   style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:20px;">
</i>

</div>
<div class="form-check text-start mb-3">
    <input class="form-check-input" type="checkbox" name="remember" id="remember">
    <label class="form-check-label text-white ms-2" for="remember">
        Remember me
    </label>
</div>


            <button type="submit" class="btn btn-dark w-100 animate-btn">
                Login Securely
            </button>
            <div class="text-end mt-2">
    <a href="javascript:void(0)"
   class="text-white small fw-semibold forgot-link"
   onclick="showForgot()">
    Forgot Password?
</a>

</div>

        </form>

        <div class="text-center mt-3">
            <small class="text-white">Don’t have an account?</small><br>
            <a href="register.php" class="text-white fw-bold">Create Account</a>
        </div>

    </div>

    <!-- FORGOT PASSWORD CARD -->
<div id="forgotBox" class="glass-card text-center d-none">

    <h4 class="text-white mb-3">🔑 Forgot Password</h4>

    <input type="email" id="forgotEmail" class="form-control mb-2"
           placeholder="Enter Registered Email">

    <div id="forgotMsg" class="text-white small mb-2"></div>

    <button class="btn btn-secondary w-100 mb-2" onclick="checkEmail()">
        Check Email
    </button>

    <button class="btn btn-success w-100 d-none" id="sendPassBtn"
            onclick="sendPassword()">
        Get Password
    </button>

    <div id="spinner" class="mt-2 d-none">
    <div class="spinner-border text-light spinner-border-sm" role="status"></div>
    <span class="text-white ms-2">Sending password...</span>
</div>


    <div class="mt-3">
        <a href="javascript:void(0)" class="text-white fw-semibold"
           onclick="backToLogin()">← Back to Login</a>
    </div>

</div>

</main>

<!-- ✅ AUTO HIDE ALERT (3 Seconds) -->
<script>
setTimeout(() => {
    let alertBox = document.getElementById("loginAlert");
    if(alertBox){
        alertBox.style.transition = "0.5s";
        alertBox.style.opacity = "0";
        setTimeout(()=>alertBox.remove(), 500);
    }
}, 3000);

<!-- ✅ SHOW / HIDE PASSWORD -->
function togglePassword(){
    let pass = document.getElementById("password");
    let eye = document.getElementById("eyeIcon");

    if(pass.type === "password"){
        pass.type = "text";
        eye.classList.remove("bi-eye");
        eye.classList.add("bi-eye-slash");  // closed eye
    } else {
        pass.type = "password";
        eye.classList.remove("bi-eye-slash");
        eye.classList.add("bi-eye"); // open eye
    }
}


document.addEventListener("DOMContentLoaded", function () {

    // Autofill on page load
    let savedUser = localStorage.getItem("jain_username");
    let savedPass = localStorage.getItem("jain_password");

    if (savedUser && savedPass) {
        document.querySelector("input[name='name']").value = savedUser;
        document.querySelector("input[name='password']").value = savedPass;
        document.getElementById("remember").checked = true; // ✅ NOW IT SHOWS
    }

    // On form submit
    document.querySelector("form").addEventListener("submit", function () {

        let remember = document.getElementById("remember");
        let username = document.querySelector("input[name='name']").value;
        let password = document.querySelector("input[name='password']").value;

        if (remember.checked) {
            localStorage.setItem("jain_username", username);
            localStorage.setItem("jain_password", password);
        } else {
            localStorage.removeItem("jain_username");
            localStorage.removeItem("jain_password");
        }
    });

});

function showForgot(){
    document.getElementById("loginBox").classList.add("d-none");
    document.getElementById("forgotBox").classList.remove("d-none");
}

function backToLogin(){
    document.getElementById("forgotBox").classList.add("d-none");
    document.getElementById("loginBox").classList.remove("d-none");
}

function checkEmail(){
    let email = document.getElementById("forgotEmail").value;

    if(email === ""){
        document.getElementById("forgotMsg").innerHTML = "❌ Enter email first";
        return;
    }

    fetch("checkEmail.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"email="+email
    })
    .then(res => res.text())
    .then(data => {
        if(data.trim() === "exists"){
            document.getElementById("forgotMsg").innerHTML =
                "✅ Email registered. Click Get Password";
            document.getElementById("sendPassBtn").classList.remove("d-none");
        }else{
            document.getElementById("forgotMsg").innerHTML =
                "❌ Email not registered";
            document.getElementById("sendPassBtn").classList.add("d-none");
        }
    });
}

function sendPassword(){
    let email = document.getElementById("forgotEmail").value;

    let spinner = document.getElementById("spinner");
    let btn = document.getElementById("sendPassBtn");
    let msg = document.getElementById("forgotMsg");

    // UI states
    spinner.classList.remove("d-none"); // 🔄 show spinner
    btn.disabled = true;
    msg.innerHTML = "";

    fetch("ajaxSendPassword.php",{
        method:"POST",
        headers:{"Content-Type":"application/x-www-form-urlencoded"},
        body:"email="+email
    })
    .then(res => res.text())
    .then(data => {

        spinner.classList.add("d-none"); // ❌ hide spinner
        btn.disabled = false;

        msg.innerHTML = data;

        // success ke baad button hide
        if(data.includes("✅")){
            btn.classList.add("d-none");
        }
    })
    .catch(err=>{
        spinner.classList.add("d-none");
        btn.disabled = false;
        msg.innerHTML = "❌ Something went wrong. Try again.";
    });
}

document.querySelector("form").addEventListener("submit", function (e) {

    let remember = document.getElementById("remember");
    let username = document.querySelector("input[name='name']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();

    // ❗ VALIDATION MIN 4 CHAR
    if(username.length < 4 ) {
        alert("Minimum 4 characters required");
        e.preventDefault();   // stop form submit  
        return;
    }

    // existing localStorage code
    if (remember.checked) {
        localStorage.setItem("jain_username", username);
        localStorage.setItem("jain_password", password);
    } else {
        localStorage.removeItem("jain_username");
        localStorage.removeItem("jain_password");
    }
});


</script>

<?php include("footer.php"); ?>
