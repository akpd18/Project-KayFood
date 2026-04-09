<?php 
session_start(); 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Quản trị - KayFood</title>
    <link rel="stylesheet" href="/Project-Kayfood/admin_frontend/assets/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="login-page">
    <div class="login-card">
        <h1>KAY<span>FOOD</span></h1>
        <p>Hệ thống quản trị nội bộ</p>
        <form action="/Project-Kayfood/admin_frontend/modules/auth_process.php" method="POST">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <i class='bx bxs-user'></i>
                <input type="text" name="username" placeholder="Nhập username" required>
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <i class='bx bxs-lock-alt'></i>
                <input type="password" name="password" placeholder="Nhập mật khẩu" required>
                <?php if (isset($_SESSION['error_message'])): ?>
                    <p style="color: #ff4d4d; font-size: 14px; margin-top: 20px; margin-bottom: -10px; font-weight: bold">
                        <?php 
                            echo $_SESSION['error_message']; 
                            unset($_SESSION['error_message']); 
                        ?>
                    </p>
                <?php endif; ?>
            </div>

            <button type="submit" name="login_admin" class="btn-login">ĐĂNG NHẬP</button>
        </form>
    </div>

</body>
</html>