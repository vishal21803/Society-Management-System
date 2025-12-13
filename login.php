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

</style>
<main id="loginbody">
    <div class="glass-card text-center position-relative">

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

    <span 
        id="eyeIcon"
        onclick="togglePassword()" 
        style="position:absolute; right:15px; top:50%; transform:translateY(-50%); cursor:pointer; font-size:18px;"
    >👁️</span>
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

        </form>

        <div class="text-center mt-3">
            <small class="text-white">Don’t have an account?</small><br>
            <a href="register.php" class="text-white fw-bold">Create Account</a>
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
        eye.innerHTML = "🙈";   // password visible
    } else {
        pass.type = "password";
        eye.innerHTML = "👁️";  // password hidden
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

</script>

<?php include("footer.php"); ?>
