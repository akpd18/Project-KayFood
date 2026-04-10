<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Tài Khoản - KayFood</title>
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="user-login-body">
    <div class="user-login-container">
        <div class="login-wrapper">
            <div class="login-visual">
                <div class="overlay-text">
                    <h2>KAY<span>FOOD</span></h2>
                    <p>Join the community of traditional food lovers.</p>
                </div>
                <img src="../assets/images/login1.jpg" alt="KayFood Register">
            </div>

            <div class="login-box">
                <div class="login-header">
                    <h3>SIGN UP</h3>
                    <p>Create a new account in seconds</p>
                </div>

                <form action="../modules/register_process.php" method="POST">
                    <div class="user-form-group">
                        <label>Full name</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-user-detail'></i>
                            <input type="text" name="fullname" placeholder="Nguyen Van A" required>
                        </div>
                    </div>

                    <div class="user-form-group">
                        <label>Account</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="username" placeholder="Email or phone number" required>
                        </div>
                    </div>

                    <div class="user-form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="Minimum 10 characters" required>
                        </div>
                    </div>

                    <button type="submit" name="register_user" class="btn-user-login">CREATE ACCOUNT</button>
                    <p class="auth-redirect">Already have an account? <a href="login.php">Login now</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>