<?php
require_once __DIR__ . '/../../core/db.php';

// Lấy toàn bộ món ăn, mới nhất lên đầu
$stmt = $pdo->query("SELECT * FROM dishes ORDER BY id DESC");
$dishes = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/dishes.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
    html, body {
        height: 100%;
        overflow: hidden;
    }
</style>


<div class="kayfood-admin-wrapper">
    <div class="table-header-section">
        <h3>Danh sách món ăn</h3>
        <button class="btn-add-new" onclick="openDishModal('add')">
            <i class='bx bx-plus'></i> Thêm món mới
        </button>
    </div>

    <div class="table-responsive">
        <table class="main-dish-table">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-img">ẢNH</th>
                    <th class="col-name">TÊN MÓN</th>
                    <th class="col-desc">MÔ TẢ</th> 
                    <th class="col-price">GIÁ</th>
                    <th class="col-action">THAO TÁC</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dishes as $dish): ?>
                <tr>
                    <td class="text-center-bold"><?php echo $dish['id']; ?></td>
                    <td><img src="../assets/images/dishes/<?php echo $dish['image']; ?>" class="dish-thumb"></td>
                    <td><span class="dish-name-label"><?php echo htmlspecialchars($dish['name']); ?></span></td>
                    <td><div class="dish-description"><?php echo htmlspecialchars($dish['description']); ?></div></td>
                    <td class="dish-price"><?php echo number_format($dish['price'], 0, ',', '.'); ?>đ</td>
                    <td class="text-center">
                        <button class="action-btn edit-btn" onclick="openDishModal('edit', <?php echo htmlspecialchars(json_encode($dish)); ?>)">
                            <i class='bx bx-edit-alt'></i>
                        </button>
                        <a href="../modules/dish_process.php?delete_id=<?php echo $dish['id']; ?>" class="action-btn delete-btn" onclick="return confirm('Xác nhận xóa?')">
                            <i class='bx bx-trash'></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="dishModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Thêm món ăn mới</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>
        
        <form action="../modules/dish_process.php" method="POST" enctype="multipart/form-data" class="modern-form">
            <input type="hidden" name="dish_id" id="m_dish_id">
            <input type="hidden" name="action_type" id="m_action_type" value="add">

            <div class="form-group">
                <label>Tên món ăn</label>
                <input type="text" name="name" id="m_name" placeholder="Ví dụ: Phở bò đặc biệt" required>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="description" id="m_description" rows="3" placeholder="Nhập mô tả món ăn (hương vị, nguyên liệu...)" style="width: 100%; padding: 12px; border: 1.5px solid #eee; border-radius: 8px; box-sizing: border-box;"></textarea>
            </div>

            <div class="form-group">
                <label>Giá bán (VNĐ)</label>
                <input type="number" name="price" id="m_price" placeholder="Nhập giá tiền..." required>
            </div>

            <div class="form-group">
                <label>Hình ảnh sản phẩm</label>
                <div class="custom-file-upload">
                    <input type="file" name="image" id="m_image">
                    <p class="file-hint">Định dạng JPG, PNG. Tỉ lệ vuông là tốt nhất.</p>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Hủy</button>
                <button type="submit" name="submit_dish" class="btn-primary">Xác nhận lưu</button>
            </div>
        </form>
    </div>
</div>

<script>
function openDishModal(mode, data = null) {
    document.getElementById('m_action_type').value = mode;
    if(mode === 'edit') {
        document.getElementById('modalTitle').innerText = "Cập nhật món ăn";
        document.getElementById('m_dish_id').value = data.id;
        document.getElementById('m_name').value = data.name;
        document.getElementById('m_price').value = data.price;
        // Bổ sung dòng này để lấy dữ liệu mô tả
        document.getElementById('m_description').value = data.description || "";
        document.getElementById('m_image').required = false;
    } else {
        document.getElementById('modalTitle').innerText = "Thêm món ăn mới";
        document.getElementById('m_name').value = "";
        document.getElementById('m_price').value = "";
        // Reset trường mô tả khi thêm mới
        document.getElementById('m_description').value = "";
        document.getElementById('m_image').required = true;
    }
    document.getElementById('dishModal').style.display = "flex";
}

function closeModal() { 
    document.getElementById('dishModal').style.display = "none"; 
}

// Đóng khi click ngoài vùng modal
window.onclick = function(e) {
    if (e.target == document.getElementById('dishModal')) closeModal();
}
</script>