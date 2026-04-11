<?php
session_start();
require_once __DIR__ . '/../../core/db.php'; 

// 1. XỬ LÝ HIỂN THỊ TRANG CHỦ 
if (isset($_GET['toggle_featured'])) {
    $id = (int)$_GET['toggle_featured'];
    
    $sql = "UPDATE dishes SET is_featured = 1 - is_featured WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([$id]);

    // Nếu là yêu cầu thông thường (không phải AJAX) thì mới redirect
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        // Chỉ trả về trạng thái HTTP 200 thay vì chuyển trang
        http_response_code(200);
        exit();
    }
    
    header("Location: ../pages/dishes_list.php"); 
    exit();
}

// 2. Xử lý Xóa
if (isset($_GET['delete_id'])) {
    $pdo->prepare("DELETE FROM dishes WHERE id = ?")->execute([(int)$_GET['delete_id']]);
    header("Location: ../pages/dishes_list.php"); 
    exit();
}

// 3. Xử lý Thêm/Sửa
if (isset($_POST['submit_dish'])) {
    $action = $_POST['action_type'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $id = $_POST['dish_id'];

    $img = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $img = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../../assets/images/dishes/" . $img);
    }

    if ($action == 'add') {
        $sql = "INSERT INTO dishes (name, price, image, is_featured) VALUES (?, ?, ?, 0)";
        $pdo->prepare($sql)->execute([$name, $price, $img]);
    } else {
        if ($img) {
            $sql = "UPDATE dishes SET name=?, price=?, image=? WHERE id=?";
            $pdo->prepare($sql)->execute([$name, $price, $img, $id]);
        } else {
            $sql = "UPDATE dishes SET name=?, price=? WHERE id=?";
            $pdo->prepare($sql)->execute([$name, $price, $id]);
        }
    }
    header("Location: ../pages/dishes_list.php"); 
    exit();
}