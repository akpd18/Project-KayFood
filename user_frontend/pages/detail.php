<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Lấy ID và LOẠI món từ URL (type có thể là 'food' hoặc 'drink')
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$type = isset($_GET['type']) ? $_GET['type'] : 'food';

// Xác định bảng cần truy vấn dựa vào biến type
$table = ($type === 'drink') ? 'drinks' : 'dishes';

// 3. Truy vấn lấy thông tin theo bảng tương ứng
$stmt = $pdo->prepare("SELECT * FROM $table WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

// Nếu không tìm thấy, quay về trang chủ
if (!$item) {
    header('Location: home.php');
    exit;
}

// 4. Khai báo CSS 
$css_file = '../assets/css/index.css';

// 5. Gọi Header
include_once '../components/header.php';
?>

<main class="container">
    <div class="detail-container">
        <div class="detail-image">
            <img src="../../admin_frontend/assets/images/<?php echo $item['image']; ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
        </div>

        <div class="detail-info">
            <nav class="breadcrumb">
                <a href="home.php">Trang chủ</a> | 
                <a href="<?php echo ($type === 'drink') ? 'drink.php' : 'food.php'; ?>">
                    <?php echo ($type === 'drink') ? 'Đồ uống' : 'Món ăn'; ?>
                </a> | 
                <span><?php echo htmlspecialchars($item['name']); ?></span>
            </nav>
            
            <h1 class="dish-name"><?php echo htmlspecialchars($item['name']); ?></h1>
            
            <div class="dish-price">
                <?php echo number_format($item['price'], 0, ',', '.'); ?>đ
            </div>

            <div class="dish-description">
                <h3>Mô tả <?php echo ($type === 'drink') ? 'thức uống' : 'món ăn'; ?></h3>
                <p>
                    <?php echo $item['description'] ? htmlspecialchars($item['description']) : "Hương vị truyền thống thơm ngon, chuẩn vị được chế biến từ nguyên liệu tươi sạch trong ngày."; ?>
                </p>
            </div>

            <div class="order-section">
                <div class="quantity-picker">
                    <button type="button" class="btn-qty" onclick="changeQuantity(-1)">-</button>
                    <input type="number" id="quantity" value="1" min="1" readonly>
                    <button type="button" class="btn-qty" onclick="changeQuantity(1)">+</button>
                </div>
                <button class="btn-add-cart">THÊM VÀO GIỎ HÀNG</button>
            </div>

            <div class="extra-info">
                <span><i class="fas fa-check-circle"></i> Giao hàng nhanh 30 phút</span>
                <span><i class="fas fa-utensils"></i> Đảm bảo vệ sinh ATTP</span>
            </div>
        </div>
    </div>
</main>

<script>
function changeQuantity(amount) {
    const qtyInput = document.getElementById('quantity');
    let currentValue = parseInt(qtyInput.value);
    let newValue = currentValue + amount;
    
    if (newValue < 1) {
        newValue = 1;
    }
    
    qtyInput.value = newValue;
}
</script>

<?php 
// 6. Gọi Footer
include_once '../components/footer.php'; 
?>