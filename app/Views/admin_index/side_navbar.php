<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-white">
        <img src="<?php echo $custom_site_url; ?>/assets/img/MR-Betterlife.png" alt="" height="50px">
    </a>
    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "dashboard")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/dashboard" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "view_edit_prospects")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_prospects" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>View Prospects</p>
                    </a>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "create_user" || $menu_name == "view_edit_users" || $menu_name == "deleted_users")
                {
                    $selected = "menu-open";
                    $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">
                    <a href="#" class="nav-link <?php echo $selected_active ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Users<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <?php
                            $selected = "";
                            if ($menu_name == "create_user")
                                $selected = "active";
                            ?>
                            <a href="<?php echo $custom_site_url . $controller; ?>/create_user" class="nav-link <?php echo $selected ?>">
                                <i class="fas fa-plus-circle"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            $selected = "";
                            if ($menu_name == "view_edit_users")
                                $selected = "active";
                            ?>
                            <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_users" class="nav-link <?php echo $selected ?>">
                                <i class="fas fa-edit"></i>
                                <p>View Edit Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <?php
                            $selected = "";
                            if ($menu_name == "deleted_users")
                                $selected = "active";
                            ?>
                            <a href="<?php echo $custom_site_url . $controller; ?>/deleted_users" class="nav-link <?php echo $selected ?>">
                                <i class="fas fa-trash-alt"></i>
                                <p>Deleted Users</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "view_edit_regions")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_regions" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-map"></i>
                        <p>View Regions</p>
                    </a>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "view_edit_universities")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_universities" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-building"></i>
                        <p>View Universities</p>
                    </a>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "view_edit_university_courses")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_university_courses" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-book"></i>
                        <p>View University Courses</p>
                    </a>
                </li>
                <?php
                $selected = "";
                $selected_active = "";
                if ($menu_name == "view_edit_testimonials")
                {
                    $selected = "active";
                    // $selected_active = "active";
                }
                ?>
                <li class="nav-item <?php echo $selected ?>">

                    <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_testimonials" class="nav-link <?php echo $selected ?>">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>View Testimonials</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex1 d-none">
            <div class="image">
                <img src="<?php echo $custom_site_url; ?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_profile" class="d-block ">Profile</a>
            </div>
        </div>
    </div>
    <!-- /.sidebar -->
</aside>