<?php
require_once __DIR__ . '/../../core/db.php';

// Lấy toàn bộ đồ uống từ bảng drinks, mới nhất lên đầu
$stmt = $pdo->query("SELECT * FROM drinks ORDER BY id DESC");
$drinks = $stmt->fetchAll();
?>

<link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<style>
    html, body {
        height: 100%;
        overflow: hidden;
    }
</style>

<div class="kayfood-admin-wrapper">
    <div class="table-header-section">
        <h3>Drinks List</h3>
        <button class="btn-add-new" onclick="openDrinkModal('add')">
            <i class='bx bx-plus'></i> Add new drink
        </button>
    </div>

    <div class="table-responsive">
        <table class="main-dish-table">
            <thead>
                <tr>
                    <th class="col-id">ID</th>
                    <th class="col-img">IMAGE</th>
                    <th class="col-name">NAME DRINK</th>
                    <th class="col-desc">DESCRIPTION</th> 
                    <th class="col-price">PRICE</th>
                    <th class="col-action">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($drinks as $drink): ?>
                <tr>
                    <td class="dish-id"><?php echo $drink['id']; ?></td>
                    <td><img src="../assets/images/<?php echo $drink['image']; ?>?v=<?php echo time(); ?>" class="dish-image"></td>
                    <td><span class="dish-name-label"><?php echo htmlspecialchars($drink['name']); ?></span></td>
                    <td><div class="dish-description"><?php echo htmlspecialchars($drink['description']); ?></div></td>
                    <td class="dish-price"><?php echo number_format($drink['price'], 0, ',', '.'); ?>đ</td>
                    <td class="col-action text-center">
                        <div class="action-group">
                            <button class="action-btn edit-btn" onclick="openDrinkModal('edit', <?php echo htmlspecialchars(json_encode($drink)); ?>)">
                                <i class='bx bx-edit-alt'></i>
                            </button>

                            <a href="javascript:void(0);" 
                                class="star-btn <?php echo ($drink['is_featured'] == 1) ? 'active' : ''; ?>" 
                                onclick="toggleFeatured(this, <?php echo $drink['id']; ?>)"
                                title="Hiển thị lên trang chủ">
                                <i class='bx <?php echo ($drink['is_featured'] == 1) ? 'bxs-star' : 'bx-star'; ?>'></i>
                            </a>

                            <a href="../modules/drink_process.php?delete_id=<?php echo $drink['id']; ?>" 
                            class="delete-btn" 
                            onclick="return confirm('Confirm deletion of this drink?');">
                                <i class='bx bx-trash'></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="drinkModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Add New Drink</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>
        
        <form action="../modules/drink_process.php" method="POST" enctype="multipart/form-data" class="modern-form">
        <input type="hidden" name="drink_id" id="m_drink_id">
        <input type="hidden" name="action_type" id="m_action_type" value="add">

        <div class="form-group">
            <label>Drink Name</label>
            <input type="text" name="name" id="m_name" placeholder="e.g., Cà Phê Sữa Đá" required>
        </div>

        <div class="form-group">
            <label>Detail Description</label>
            <textarea name="description" id="m_description" rows="3" placeholder="Enter drink description..." style="width: 100%; padding: 12px; border: 1.5px solid #eee; border-radius: 8px; box-sizing: border-box;"></textarea>
        </div>

        <div class="form-group">
            <label>Price (VND)</label>
            <input type="number" name="price" id="m_price" placeholder="Enter price..." required>
        </div>

        <div class="form-group">
            <label>Drink images</label>
            <div class="custom-file-upload">
                <input type="file" name="image" id="m_image">
                <p class="file-hint">JPG or PNG format. A square aspect ratio is best..</p>
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
            <button type="submit" name="submit_drink" class="btn-primary">Save</button>
        </div>
        </form>
    </div>
</div>

<script>
function toggleFeatured(element, drinkId) {
    // Gửi yêu cầu đến file xử lý đồ uống
    fetch(`../modules/drink_process.php?toggle_featured=${drinkId}`)
        .then(response => {
            if (response.ok) {
                const icon = element.querySelector('i');
                if (element.classList.contains('active')) {
                    element.classList.remove('active');
                    icon.classList.replace('bxs-star', 'bx-star');
                } else {
                    element.classList.add('active');
                    icon.classList.replace('bx-star', 'bxs-star');
                }
            }
        })
        .catch(error => console.error('Lỗi:', error));
}

function openDrinkModal(mode, data = null) {
    document.getElementById('m_action_type').value = mode;
    if(mode === 'edit') {
        document.getElementById('modalTitle').innerText = "Update Drink";
        document.getElementById('m_drink_id').value = data.id;
        document.getElementById('m_name').value = data.name;
        document.getElementById('m_price').value = data.price;
        document.getElementById('m_description').value = data.description || "";
        document.getElementById('m_image').required = false;
    } else {
        document.getElementById('modalTitle').innerText = "Add New Drink";
        document.getElementById('m_name').value = "";
        document.getElementById('m_price').value = "";
        document.getElementById('m_description').value = "";
        document.getElementById('m_image').required = true;
    }
    document.getElementById('drinkModal').style.display = "flex";
}

function closeModal() { 
    document.getElementById('drinkModal').style.display = "none"; 
}

window.onclick = function(e) {
    if (e.target == document.getElementById('drinkModal')) closeModal();
}
</script>