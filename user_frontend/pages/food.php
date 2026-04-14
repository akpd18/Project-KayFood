<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Xử lý bộ lọc và lấy dữ liệu món ăn
$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT * FROM dishes WHERE 1=1";
$params = [];

// Điều kiện lọc
if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
}

// Sắp xếp để món mới nhất hiện lên đầu
$query .= " ORDER BY id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$dishes = $stmt->fetchAll();

// 3. Khai báo biến CSS riêng để file header.php nhận diện
$css_file = '../assets/css/index.css';

// 4. Gọi Header dùng chung
include_once '../components/header.php'; 
?>

<main class="container">
    <div class="section-header">
        <h2 class="section-title">Traditional Vietnamese Dishes</h2>
        <div class="title-underline"></div> 
    </div>

    <div class="filter-wrapper">
        <a href="food.php" class="filter-item <?php echo $category == '' ? 'active' : ''; ?>">
            <i class='bx bx-restaurant'></i> All
        </a>
        <a href="food.php?category=nuoc" class="filter-item <?php echo $category == 'nuoc' ? 'active' : ''; ?>">
            <i class='bx bx-bowl-hot'></i> Soup
        </a>
        <a href="food.php?category=kho" class="filter-item <?php echo $category == 'kho' ? 'active' : ''; ?>">
            <i class='bx bx-dish'></i> Dry
        </a>
    </div>

    <div class="grid-food">
        <?php if (count($dishes) > 0): ?>
            <?php foreach ($dishes as $dish): ?>
            <article class="food-item">
                <div class="image-wrapper">
                    <img src="../../admin_frontend/assets/images/<?php echo $dish['image']; ?>?v=<?php echo time(); ?>" 
                         alt="<?php echo htmlspecialchars($dish['name']); ?>" 
                         ondblclick="window.location.href='detail.php?id=<?php echo $dish['id']; ?>&type=dish'"
                         style="cursor: pointer;">
                </div>
                <div class="info">
                    <h3><?php echo htmlspecialchars($dish['name']); ?></h3>
                    <span class="price"><?php echo number_format($dish['price'], 0, ',', '.'); ?>đ</span>
                    <div class="actions">
                        <a href="detail.php?id=<?php echo $dish['id']; ?>&type=dish" class="btn-detail">Detail</a>
                        <button class="btn-buy">Add to Cart</button>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-result">There are currently no dishes listed in this category.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
// 5. Gọi Footer dùng chung
include_once '../components/footer.php'; 
?>