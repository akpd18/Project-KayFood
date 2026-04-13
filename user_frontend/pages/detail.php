<?php
// 1. Kết nối Database
require_once '../../core/db.php';

// 2. Lấy ID món ăn từ URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// 3. Truy vấn lấy thông tin món ăn theo ID
$stmt = $pdo->prepare("SELECT * FROM dishes WHERE id = ?");
$stmt->execute([$id]);
$dish = $stmt->fetch();

// Nếu không tìm thấy món ăn, quay về trang chủ
if (!$dish) {
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
            <img src="../assets/images/dish/<?php echo $dish['image']; ?>" alt="<?php echo $dish['name']; ?>">
        </div>

        <div class="detail-info">
            <nav class="breadcrumb">
                <a href="home.php">Trang chủ</a> | <span><?php echo $dish['name']; ?></span>
            </nav>
            
            <h1 class="dish-name"><?php echo $dish['name']; ?></h1>
            
            <div class="dish-price">
                <?php echo number_format($dish['price'], 0, ',', '.'); ?>đ
            </div>

            <div class="dish-description">
                <h3>Mô tả món ăn</h3>
                <p><?php echo $dish['description'] ? $dish['description'] : "Món ăn truyền thống thơm ngon, chuẩn vị được chế biến từ nguyên liệu tươi sạch trong ngày."; ?></p>
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
    
    // Tính toán giá trị mới
    let newValue = currentValue + amount;
    
    // Đảm bảo số lượng không nhỏ hơn 1
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