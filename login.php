

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: linear-gradient(135deg, #d5b306ff, #ffff00ff);
    animation: gradientBG 8s ease infinite;
    background-size: 300% 300%;
}

@keyframes gradientBG {
    0%{ background-position:0% 50%; }
    50%{ background-position:100% 50%; }
    100%{ background-position:0% 50%; }
}

.glass-card{
    width: 350px;
    padding: 30px;
    border-radius: 20px;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(12px);
    border:1px solid rgba(255,255,255,0.3);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    animation: fadeIn 1.2s ease-out;
}

@keyframes fadeIn {
    from{ opacity:0; transform:translateY(20px); }
    to{ opacity:1; transform:translateY(0); }
}

.glass-card input{
    background: rgba(255,255,255,0.4) !important;
    border: none !important;
    color: #000;
}

.glass-card input::placeholder{
    color:#333;
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
    <h3 class="text-center text-white mb-4">🔐 Login</h3>

    <form method="POST" action="checkLogin.php">
        <div class="mb-3">
            <input type="text" name="name" class="form-control" placeholder="User name" required>
        </div>

        <div class="mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-light w-100 animate-btn">Login</button>
    </form>

    <div class="text-center mt-3">
        <a href="register.php" class="text-white">Create an account</a>
    </div>
</div>

</body>
</html>
