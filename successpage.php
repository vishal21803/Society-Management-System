<?php include("header.php"); ?>

<style>
/* 🌟 FULL PAGE BACKGROUND */
.success-wrapper{
    min-height: 85vh;
    background: linear-gradient(135deg, #fff9e6, #ffe0a3, #ffcc66);
    display: flex;
    align-items: center;
    justify-content: center;
    animation: fadeIn 1s ease-in-out;
}

/* 🌟 SUCCESS GLASS CARD */
.success-box{
    background: rgba(255,255,255,0.9);
    border-radius: 22px;
    padding: 50px 60px;
    text-align: center;
    box-shadow: 0 25px 60px rgba(0,0,0,0.2);
    animation: popUp 0.8s ease;
    position: relative;
    overflow: hidden;
}

/* ✅ CHECK ICON */
.success-icon{
    height: 90px;
    width: 90px;
    background: linear-gradient(135deg, #28a745, #5cd65c);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 50px;
    color: #fff;
    margin: 0 auto 25px;
    box-shadow: 0 10px 30px rgba(40,167,69,0.5);
    animation: pulse 1.4s infinite;
}

/* ✅ TEXT */
.success-box h1{
    font-weight: 800;
    color: #2e2e2e;
    margin-bottom: 14px;
}

.success-box p{
    font-size: 17px;
    color: #555;
}

.success-box a{
    color: #ff9800;
    font-weight: bold;
    text-decoration: none;
}

.success-box a:hover{
    text-decoration: underline;
}

/* ✅ BUTTON */
.success-btn{
    margin-top: 28px;
    background: linear-gradient(135deg, #ff9800, #ff5722);
    color: #fff;
    border-radius: 40px;

    padding: 12px 32px;
    display: inline-block;
    font-weight: 600;
    text-decoration: none;
    transition: 0.4s;
}

.success-btn:hover{
    background: linear-gradient(135deg, #ff5722, #ff9800);
    transform: scale(1.08);
    text-decoration: none;
        color: #fff;

}

/* 🎯 ANIMATIONS */
@keyframes popUp{
    from{transform: scale(0.6); opacity:0;}
    to{transform: scale(1); opacity:1;}
}

@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
}

@keyframes pulse{
    0%{transform: scale(1);}
    50%{transform: scale(1.12);}
    100%{transform: scale(1);}
}
</style>

<main>
<div class="success-wrapper">
    <div class="success-box">

        <div class="success-icon">✔</div>

        <h1>Account Created Successfully 🎉</h1>

        <p>Your account has been created. You can now safely login.</p>

        <a href="login.php" class="success-btn" style="text-decoration: none;color:white;">Go to Login</a>

    </div>
</div>
</main>

<?php include("footer.php"); ?>
