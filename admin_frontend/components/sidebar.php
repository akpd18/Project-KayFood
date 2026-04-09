<aside class="admin-sidebar">
    <div class="sidebar-logo">
        KAY<span>FOOD</span></a>
    </div>
    <ul class="sidebar-menu">
        <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
            <a href="admin.php?page=dashboard"><i class='bx bxs-dashboard'></i> Dashboard</a>
        </li>
        <li class="<?php echo $page == 'dishes' ? 'active' : ''; ?>">
            <a href="admin.php?page=dishes"><i class='bx bxs-food-menu'></i> Quản lý món ăn</a>
        </li>
        <li>
            <a href="#"><i class='bx bxs-cart-alt'></i> Đơn hàng</a>
        </li>
        <li>
            <a href="#"><i class='bx bxs-user-detail'></i> Khách hàng</a>
        </li>
    </ul>
</aside>