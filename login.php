<?php include("header.php"); ?>

<main id="loginbody">
    <div class="glass-card text-center">

        <h3 class="text-white mb-4">🔐 Login</h3>

        <form method="POST" action="checkLogin.php">

            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="👤 Username" required>
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="🔒 Password" required>
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

<?php include("footer.php"); ?>
