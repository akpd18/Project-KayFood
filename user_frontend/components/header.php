<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Project-Kayfood/user_frontend/components/css/index.css">

    <?php if(isset($css_file)) : ?>
        <link rel="stylesheet" href="<?php echo isset($css_file) ? $css_file : '/Project-Kayfood/user_frontend/components/css/index.css'; ?>">
    <?php endif; ?>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="/Project-Kayfood/user_frontend/pages/home.php">KAY<span>FOOD</span></a>
            </div>
            <nav>
                <ul>
                    <li><a href="/Project-Kayfood/user_frontend/pages/home.php">Trang chủ</a></li>
                    <li><a href="#">Thực đơn</a></li>
                    <li><a href="#">Khuyến mãi</a></li>
                    <li><a href="#">Liên hệ</a></li>
                </ul>
            </nav>
            <div class="cart-icon">
                <a href="#" style="text-decoration:none;">🛒 <span id="cart-count">0</span></a>
            </div>
        </div>
    </header>