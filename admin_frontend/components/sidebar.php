<aside class="admin-sidebar">
    <div class="sidebar-logo">
        KAY<span>FOOD</span></a>
    </div>
    <ul class="sidebar-menu">
        <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
            <a href="admin.php?page=dashboard"><i class='bx bxs-dashboard'></i> DASHBOARD</a>
        </li>

        <li class="<?php echo $page == 'dishes' ? 'active' : ''; ?>">
            <a href="admin.php?page=dishes"><i class='bx bx-restaurant'></i> DISH </a>
        </li>

        <li class="<?php echo $page == 'drinks' ? 'active' : ''; ?>">
            <a href="admin.php?page=drinks"><i class='bx bx-coffee'></i> DRINK </a>
        </li>

        <li>
            <a href="#"><i class='bx bxs-cart-alt'></i> ORDER </a>
        </li>

        <li>
            <a href="#"><i class='bx bxs-user-detail'></i> CUSTOMER </a>
        </li>
    </ul>
</aside>