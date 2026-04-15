<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - KayFood</title>
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="user-login-body">

    <div class="user-login-container">
        <div class="login-wrapper">
            <!-- Nửa bên trái: Hình ảnh -->
            <div class="login-visual">
                <div class="overlay-text">
                    <h2>KAY<span>FOOD</span></h2>
                    <p>Traditional flavors, modern experience</p>
                </div>
                <img src="../../admin_frontend/assets/images/login1.jpg" alt="KayFood Banner">
            </div>

            <!-- Nửa bên phải: Form -->
            <div class="login-box">
                <div class="login-header">
                    <h3>LOGIN</h3>
                    <p>Welcome to KayFood</p>
                </div>

                <form action="../modules/auth_user_process.php" method="POST" class="user-login-form">
                    <div class="user-form-group">
                        <label>Account</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-user'></i>
                            <input type="text" name="account" placeholder="Email or phone number" required>
                        </div>
                    </div>

                    <div class="user-form-group">
                        <label>Password</label>
                        <div class="input-wrapper">
                            <i class='bx bxs-lock-alt'></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="error-msg">
                            <i class='bx bxs-error-circle'></i>
                            <?php 
                                echo $_SESSION['error_message']; 
                                unset($_SESSION['error_message']); 
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="form-helper">
                        <a href="forgot-password.php">Forgot password?</a>
                    </div>

                    <button type="submit" name="login_user" class="btn-user-login">LOGIN</button>
                    <p class="auth-redirect">Already have an account? <a href="register.php">Sign up now</a></p>
                    <div class="back-to-home">
                        <a href="home.php"><i class='bx bx-arrow-back'></i> Back to home</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>