<?php
session_start();
require_once __DIR__ . '/../../core/db.php'; 

// 1. Xử lý Xóa
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id'];
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    header("Location: ../pages/admin.php?page=customers"); 
    exit();
}

// 2. Xử lý Thêm/Sửa
if (isset($_POST['submit_user'])) {
    $action = $_POST['action_type'];
    $id = $_POST['user_id'];
    $username = $_POST['username'];
    $full_name = $_POST['full_name'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($action == 'add') {
        // Thêm mới + Mã hóa mật khẩu
        $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, full_name, role) VALUES (?, ?, ?, ?)";
        $pdo->prepare($sql)->execute([$username, $hashed_pw, $full_name, $role]);
    } else {
        // Sửa thông tin
        if (!empty($password)) {
            // Nếu có nhập mật khẩu mới
            $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE users SET username=?, password=?, full_name=?, role=? WHERE id=?";
            $pdo->prepare($sql)->execute([$username, $hashed_pw, $full_name, $role, $id]);
        } else {
            // Nếu giữ nguyên mật khẩu cũ
            $sql = "UPDATE users SET username=?, full_name=?, role=? WHERE id=?";
            $pdo->prepare($sql)->execute([$username, $full_name, $role, $id]);
        }
    }
    header("Location: ../pages/admin.php?page=customers"); 
    exit();
}