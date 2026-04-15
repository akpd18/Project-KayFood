<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Lấy dữ liệu gộp từ cả 2 bảng dishes và drinks bằng UNION
// Thêm cột 'type' để phân biệt khi nhấn xem chi tiết
$query = "
    (SELECT id, name, price, image, 'food' AS type FROM dishes WHERE is_featured = 1)
    UNION ALL
    (SELECT id, name, price, image, 'drink' AS type FROM drinks WHERE is_featured = 1)
    ORDER BY id DESC
";

$stmt = $pdo->query($query);
$items = $stmt->fetchAll();

// 3. Khai báo biến CSS riêng để file header.php nhận diện
$css_file = '../assets/css/index.css';

// 4. Gọi Header dùng chung
include_once '../components/header.php'; 
?>

<section class="hero-banner">
    <div class="banner-image">
        <img src="../../admin_frontend/assets/images//banner.png" alt="Traditional Vietnamese Dishes">
    </div>
</section>

<main class="container">
    <div class="section-header">
        <h2 class="section-title">BEST SELLER</h2>
        <div class="title-underline"></div> 
    </div>

    <div class="grid-food">
        <?php if (count($items) > 0): ?>
            <?php foreach ($items as $item): ?>
            <article class="food-item">
               <div class="image-wrapper">
                    <img src="../../admin_frontend/assets/images/<?php echo $item['image']; ?>?v=<?php echo time(); ?>" 
                        alt="<?php echo htmlspecialchars($item['name']); ?>"
                        ondblclick="window.location.href='detail.php?id=<?php echo $item['id']; ?>&type=<?php echo $item['type']; ?>'"
                        style="cursor: pointer;"
                        title="Nhấn đúp để xem chi tiết">
                </div>
                <div class="info">
                    <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                    <span class="price"><?php echo number_format($item['price'], 0, ',', '.'); ?>đ</span>
                </div>
            </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Hiện chưa có món ăn hoặc đồ uống nổi bật nào được chọn.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
// 5. Gọi Footer dùng chung
include_once '../components/footer.php'; 
?>