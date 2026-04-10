<?php
session_start();
// 1. Nhúng file kết nối database (Lùi 2 cấp: khỏi modules/ rồi khỏi user_frontend/ để vào core/)
require_once __DIR__ . '/../../core/db.php'; 

if (isset($_POST['login_user'])) {
    // Lấy dữ liệu từ form login của User (đã đổi tên name="account" ở form trước đó)
    $account = trim($_POST['account']);
    $password = trim($_POST['password']);

    try {
        // Truy vấn dựa trên cột 'username' (hoặc bạn có thể đổi thành email nếu cần)
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :account LIMIT 1");
        $stmt->execute(['account' => $account]);
        $user_data = $stmt->fetch();

        if ($user_data) {
            // Kiểm tra mật khẩu (Sử dụng password_verify vì trong DB bạn đang dùng mã hash $2y$10...)
            if (password_verify($password, $user_data['password'])) {
                
                // ĐĂNG NHẬP THÀNH CÔNG
                // Lưu các thông tin cần thiết vào Session cho User
                $_SESSION['user_id'] = $user_data['id'];
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_fullname'] = $user_data['full_name'];
                $_SESSION['user_role'] = $user_data['role'];

                // Xóa thông báo lỗi cũ
                unset($_SESSION['error_message']);

                // Chuyển hướng về trang chủ người dùng
                header("Location: ../pages/home.php"); 
                exit();
            } else {
                // SAI MẬT KHẨU
                $_SESSION['error_message'] = "Thông tin tài khoản hoặc mật khẩu không đúng!";
                header("Location: ../pages/login.php");
                exit();
            }
        } else {
            // KHÔNG TÌM THẤY TÀI KHOẢN
            $_SESSION['error_message'] = "Thông tin tài khoản hoặc mật khẩu không đúng!";
            header("Location: ../pages/login.php");
            exit();
        } 
    }   
    catch (PDOException $e) {
        die("Lỗi hệ thống: " . $e->getMessage());
    }
} else {
    // Nếu truy cập trực tiếp file này mà không qua form
    header("Location: ../pages/login.php");
    exit();
}