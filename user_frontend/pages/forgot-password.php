<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khôi Phục Mật Khẩu - KayFood</title>
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="user-login-body">
    <div class="user-login-container">
        <div class="login-wrapper">
            <div class="login-visual">
                <div class="overlay-text">
                    <h2>KAY<span>FOOD</span></h2>
                    <p>Don't worry, we'll help you recover your password</p>
                </div>
                <img src="../../admin_frontend/assets/images/login1.jpg" alt="KayFood Forgot Password">
            </div>

            <div class="login-box">
                <div class="login-header">
                    <h3>FORGOT PASSWORD</h3>
                    <p>Enter your registered email to recover your password</p>
                </div>

                <form action="../modules/forgot_process.php" method="POST">
                    <div class="user-form-group">
                        <label>Email</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-envelope'></i>
                            <input type="email" name="email" placeholder="yourname@gmail.com" required>
                        </div>
                    </div>

                    <button type="submit" name="reset_password" class="btn-user-login">SEND VERIFICATION CODE</button>

                    <div class="back-to-home">
                        <a href="login.php"><i class='bx bx-chevron-left'></i> Back to login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>