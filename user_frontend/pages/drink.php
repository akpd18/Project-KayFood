<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Xử lý bộ lọc (All, Hot, Cold)
$category = isset($_GET['category']) ? $_GET['category'] : '';

// Truy vấn từ bảng drinks
$query = "SELECT * FROM drinks WHERE 1=1"; 
$params = [];

// Điều kiện lọc theo loại Hot/Cold
if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
}

$query .= " ORDER BY id DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$drinks = $stmt->fetchAll();

// 3. Khai báo biến CSS
$css_file = '../assets/css/index.css';

// 4. Gọi Header
include_once '../components/header.php'; 
?>

<main class="container">
    <div class="section-header">
        <h2 class="section-title">Refreshing Vietnamese Drinks</h2>
        <div class="title-underline"></div> 
    </div>

    <div class="filter-wrapper">
        <a href="drink.php" class="filter-item <?php echo $category == '' ? 'active' : ''; ?>">
            <i class='bx bx-category'></i> All
        </a>
        <a href="drink.php?category=hot" class="filter-item <?php echo $category == 'hot' ? 'active' : ''; ?>">
            <i class='bx bxs-hot'></i> Hot
        </a>
        <a href="drink.php?category=cold" class="filter-item <?php echo $category == 'cold' ? 'active' : ''; ?>">
            <i class='bx bx-fridge'></i> Cold
        </a>
    </div>

    <div class="grid-drink">
        <?php if (count($drinks) > 0): ?>
            <?php foreach ($drinks as $drink): ?>
            <article class="drink-item">
                <div class="image-wrapper">
                    <img src="../assets/images/drinks/<?php echo $drink['image']; ?>" 
                         alt="<?php echo htmlspecialchars($drink['name']); ?>" 
                         ondblclick="window.location.href='detail.php?id=<?php echo $drink['id']; ?>&type=drink'"
                         style="cursor: pointer;">
                </div>
                <div class="info">
                    <h3><?php echo htmlspecialchars($drink['name']); ?></h3>
                    <span class="price"><?php echo number_format($drink['price'], 0, ',', '.'); ?>đ</span>
                    <div class="actions">
                        <a href="detail.php?id=<?php echo $drink['id']; ?>&type=drink" class="btn-detail">Chi tiết</a>
                        <button class="btn-buy">Add cart</button>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-result">There are currently no drinks listed in this category.</p>
        <?php endif; ?>
    </div>
</main>

<?php 
// 5. Gọi Footer
include_once '../components/footer.php'; 
?>