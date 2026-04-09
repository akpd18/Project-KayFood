<?php
session_start();
// Nhúng file kết nối database (kiểm tra kỹ đường dẫn này)
require_once __DIR__ . '/../../core/db.php'; 

if (isset($_POST['login_admin'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Sử dụng Prepared Statement của PDO để tránh SQL Injection
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user_data = $stmt->fetch();

        if ($user_data) {
            if (password_verify($password, $user_data['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_fullname'] = $user_data['full_name'];          
                // Đăng nhập thành công, xóa lỗi cũ (nếu có) và chuyển trang
                unset($_SESSION['error_message']);
                header("Location: ../pages/admin.php"); 
                exit();
            } else {
                // SAI MẬT KHẨU
                $_SESSION['error_message'] = "Tên đăng nhập hoặc mật khẩu không chính xác!";
                header("Location: ../pages/login.php");
                exit();
            }
        } else {
            // SAI USERNAME
            $_SESSION['error_message'] = "Tên đăng nhập hoặc mật khẩu không chính xác!";
            header("Location: ../pages/login.php");
            exit();
        } 
    }   
    catch (PDOException $e) {
        die("Lỗi truy vấn: " . $e->getMessage());
    }
} else {
    header("Location: ../pages/login.php");
    exit();
}