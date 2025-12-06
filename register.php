<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg, #FF7A7A, #FFD56A);
    animation: bgAni 10s ease infinite;
    background-size: 300% 300%;
}

@keyframes bgAni {
    0%{ background-position:0% 50%; }
    50%{ background-position:100% 50%; }
    100%{ background-position:0% 50%; }
}

.glass-card{
    width: 380px;
    padding: 30px;
    border-radius: 20px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    border:1px solid rgba(255,255,255,0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    animation: slideUp 1.2s ease-out;
}

@keyframes slideUp {
    from{ opacity:0; transform:translateY(30px); }
    to{ opacity:1; transform:translateY(0); }
}

.glass-card input{
    background: rgba(255,255,255,0.35) !important;
    border: none !important;
    color: #000;
}

.glass-card input::placeholder{
    color:#222;
}

.animate-btn{
    transition:0.3s;
}

.animate-btn:hover{
    transform: scale(1.05);
}
</style>

</head>
<body>

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

</body>
</html>
