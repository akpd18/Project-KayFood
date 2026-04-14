<?php
session_start();
require_once __DIR__ . '/../../core/db.php'; 

// 1. XỬ LÝ HIỂN THỊ TRANG CHỦ (TOGGLE FEATURED)
if (isset($_GET['toggle_featured'])) {
    $id = (int)$_GET['toggle_featured'];
    
    // Cập nhật trạng thái nổi bật cho bảng drinks
    $sql = "UPDATE drinks SET is_featured = 1 - is_featured WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$id]);

    // Nếu là yêu cầu AJAX từ script admin
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        http_response_code(200);
        exit();
    }
    
    // Redirect về trang danh sách đồ uống của admin
    header("Location: ../pages/drinks_list.php"); 
    exit();
}

// 2. Xử lý Xóa đồ uống
if (isset($_GET['delete_id'])) {
    $pdo->prepare("DELETE FROM drinks WHERE id = ?")->execute([(int)$_GET['delete_id']]);
    header("Location: ../pages/drinks_list.php"); 
    exit();
}

// 3. Xử lý Thêm/Sửa đồ uống
if (isset($_POST['submit_drink'])) {
    $action = $_POST['action_type'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id = $_POST['drink_id'];

    $img = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img = time() . "_" . $_FILES['image']['name'];
        // Lưu ảnh vào thư mục drinks
        move_uploaded_file($_FILES['image']['tmp_name'], "../../assets/images/drinks/" . $img);
    }

    if ($action == 'add') {
        // Thêm mới vào bảng drinks
        $sql = "INSERT INTO drinks (name, price, image, is_featured) VALUES (?, ?, ?, 0)";
        $pdo->prepare($sql)->execute([$name, $price, $img]);
    } else {
        // Cập nhật thông tin đồ uống
        if ($img) {
            $sql = "UPDATE drinks SET name=?, price=?, image=? WHERE id=?";
            $pdo->prepare($sql)->execute([$name, $price, $img, $id]);
        } else {
            $sql = "UPDATE drinks SET name=?, price=? WHERE id=?";
            $pdo->prepare($sql)->execute([$name, $price, $id]);
        }
    }
    // Quay lại trang danh sách sau khi xử lý xong
    header("Location: ../pages/admin.php?page=drinks");
    exit();
}