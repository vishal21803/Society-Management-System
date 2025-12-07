
<?php
include("header.php");
?>

<main id="loginbody">
    

<div class="glass-card">
    <h3 class="text-center text-white mb-4">📝 Register</h3>

    <form action="insertUser.php" method="POST">

        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="User Name" required>
        </div>

         

        <div class="mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Create Password" required>
        </div>

        <!-- <div class="mb-3">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
        </div> -->

        <button type="submit" class="btn btn-light w-100 animate-btn">Register</button>
    </form>

    <div class="text-center mt-3">
        <a href="login.php" class="text-white">Already have an account?</a>
    </div>
</div>

</main>

<?php
include("footer.php");
?>
