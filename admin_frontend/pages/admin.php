<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php"); 
    exit(); 
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - KayFood</title>
    <link rel="stylesheet" href="/Project-Kayfood/admin_frontend/assets/css/index.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="admin-page">

<div class="admin-wrapper">
    <?php include_once '../components/sidebar.php'; ?>

    <div class="admin-content">
        <?php include_once '../components/top_navbar.php'; ?>

        <div class="content-body">
            <?php 
                // Điều hướng nội dung trang con
                switch($page) {
                    case 'dishes':
                        include_once 'dishes_list.php';
                        break;
                    case 'add-dish':
                        include_once 'dishes/add.php';
                        break;
                    default:
                        include_once 'dashboard.php';
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>