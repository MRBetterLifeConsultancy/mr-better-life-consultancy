<footer class="main-footer ml-2 text-center d-none">
    <div class="d-none1">
        <p class="text-center text-orange m-0 p-0">Login as</p>
        <ul class="nav nav-pills nav-sidebar flex-row justify-content-center">
            <?php
            $selected = "";
            $selected_active = "";
            if ($menu_name == "admin_login")
            {
                $selected = "menu-open";
                $selected_active = "active";
            }
            ?>
            <li class="nav-item ml-2">
                <a class="nav-link <?php echo $selected_active ?>" href="<?php echo $custom_site_url. $controller ?>/admin_login">Admin</a>
            </li>
        </ul>
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->