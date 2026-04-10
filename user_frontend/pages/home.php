<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Lấy dữ liệu món ăn
$stmt = $pdo->query("SELECT * FROM dishes");
$dishes = $stmt->fetchAll();

// 3. Khai báo biến CSS riêng để file header.php nhận diện
$css_file = '../assets/css/index.css';

// 4. Gọi Header dùng chung
include_once '../components/header.php'; 
?>

<section class="hero-banner">
    <div class="banner-image">
        <img src="../assets/images/banner.png" alt="Traditional Vietnamese Dishes">
    </div>
</section>

<main class="container">
    <div class="section-header">
        <h2 class="section-title">Traditional Vietnamese Dishes</h2>
        <div class="title-underline"></div> 
    </div>

    <div class="grid-food">
        <?php if (count($dishes) > 0): ?>
            <?php foreach ($dishes as $dish): ?>
            <article class="food-item">
                <div class="image-wrapper">
                    <img src="../assets/images/<?php echo $dish['image']; ?>" alt="<?php echo $dish['name']; ?>">
                </div>
                <div class="info">
                    <h3><?php echo $dish['name']; ?></h3>
                    <span class="price"><?php echo number_format($dish['price'], 0, ',', '.'); ?>đ</span>
                    <div class="actions">
                        <a href="detail.php?id=<?php echo $dish['id']; ?>" class="btn-detail">Chi tiết</a>
                        <button class="btn-buy">Thêm vào giỏ</button>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Hiện chưa có món ăn nào trong thực đơn.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
// 5. Gọi Footer dùng chung
include_once '../components/footer.php'; 
?>