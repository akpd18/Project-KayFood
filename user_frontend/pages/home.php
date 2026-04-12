<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Lấy dữ liệu món ăn - CHỈ LẤY CÁC MÓN ĐƯỢC ĐÁNH DẤU SAO
// Thêm điều kiện WHERE is_featured = 1 để lọc các món nổi bật
$stmt = $pdo->query("SELECT * FROM dishes WHERE is_featured = 1");
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
        <h2 class="section-title">BEST-SELLING DISHES</h2>
        <div class="title-underline"></div> 
    </div>

    <div class="grid-food">
        <?php if (count($dishes) > 0): ?>
            <?php foreach ($dishes as $dish): ?>
            <article class="food-item">
               <div class="image-wrapper">
                    <img src="../assets/images/<?php echo $dish['image']; ?>" 
                        alt="<?php echo $dish['name']; ?>"
                        ondblclick="window.location.href='detail.php?id=<?php echo $dish['id']; ?>'"
                        style="cursor: pointer;"
                        title="Nhấn đúp để xem chi tiết">
                </div>
                <div class="info">
                    <h3><?php echo $dish['name']; ?></h3>
                    <span class="price"><?php echo number_format($dish['price'], 0, ',', '.'); ?>đ</span>
                </div>
            </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Hiện chưa có món ăn nổi bật nào được chọn.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
// 5. Gọi Footer dùng chung
include_once '../components/footer.php'; 
?>