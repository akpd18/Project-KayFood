<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KayFood - Traditional Vietnamese Dishes</title>
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="home.php">KAY<span>FOOD</span></a>
            </div>
            
            <nav>
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Promotions</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>

            <div class="header-right">
                <div class="cart-wrapper">
                    <a href="cart.php" class="action-item">
                        <div class="icon-box">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="badge" id="cart-count">0</span>
                        </div>
                    </a>
                </div>

                <div class="divider"></div>

                <div class="auth-wrapper">
                    <?php if(isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
                        <div class="user-info-header">
                            <a href="profile.php" class="action-item">
                                <i class="fa-solid fa-circle-user"></i>
                                <span><?php echo explode(' ', $_SESSION['user_fullname'])[0]; ?></span>
                            </a>
                            <a href="../modules/logout.php" title="Đăng xuất" class="logout-btn">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="action-item login-link">
                            <i class="fa-solid fa-user"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>