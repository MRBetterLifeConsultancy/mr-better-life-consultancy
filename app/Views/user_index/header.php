<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="<?php echo $custom_site_url; ?>" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="<?php echo $custom_site_url; ?>/assets/img/MR-Betterlife.png" alt="">
            <!-- <h1 class="sitename">MR </h1> -->
        </a>
        <nav id="navmenu" class="navmenu">
            <ul>
                <?php
                    $selected = "";
                    if($menu_name == "home")
                    {
                        $selected = "active";
                    }
                ?>
                <li class="d-none1"><a href="<?php echo $custom_site_url . $controller; ?>/" class="<?php echo $selected ?>">Home</a></li>
                <?php
                    $selected = "";
                    if($menu_name == "view_region")
                    {
                        $selected = "active";
                    }
                ?>
                <li class="dropdown"><a href="#" class="<?php echo $selected ?>"><span>Study Destinations</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <?php
                            foreach ($g_regions as $idx => $region) 
                            {
                                $region_name = $region['region_name'];
                                $name = $region['shortcode'];
                                $image_file = $region['logo'];
    
                                $selected = "";
                                if($menu_name == $name)
                                {
                                    $selected = "active";
                                }
                        ?>
                        <li>
                            <a href="<?php echo $custom_site_url. $controller ."/view_region/rid=".$region['region_id'] ?>" class="<?php echo $selected ?>">
                                <img src="<?php echo $custom_site_url; ?>assets/img/regions/<?php echo $region['logo'] ?>" class="img-fluid1" style="max-width:30px;" alt="">
                                Study in <?php echo $name ?>
                            </a>
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </li>
                <?php
                    $selected = "";
                    if($menu_name == "universities")
                    {
                        $selected = "active";
                    }
                ?>
                <li class="dropdown"><a href="<?php echo $custom_site_url.$controller ?>/universities" class="<?php echo $selected ?>"><span>Universities</span></a></li>
                <?php
                    $selected = "";
                    if($menu_name == "services")
                    {
                        $selected = "active";
                    }
                ?>
                <li class="dropdown">
                    <a href="<?php echo $custom_site_url . $controller . '/view_all_services' ?>" class="<?php echo $selected ?>"><span>Services</span> 
                    <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <?php
                            foreach ($g_services as $idx => $service) 
                            {
                                $sid = $service['service_id'];
                                $service_name = $service['service_name'];

                                $selected = "";
                                if($menu_name == 'services')
                                {
                                    $selected = "active";
                                }
                        ?>
                        <li><a href="<?php echo $custom_site_url . $controller . '/view_all_services#sid-'.$service['service_id'] ?>" class="<?php echo $selected ?>"><?php echo $service_name ?></a></li>
                        <?php
                            }
                        ?>
                    </ul>
                </li>
                <?php
                    $selected = "";
                    if($menu_name == "about")
                    {
                        $selected = "active";
                    }
                ?>
                <li><a href="<?php echo $custom_site_url . $controller; ?>/about"  class="<?php echo $selected ?>">About</a></li>
                <?php
                    $selected = "";
                    if($menu_name == "contact")
                    {
                        $selected = "active";
                    }
                ?>
                <li><a href="<?php echo $custom_site_url . $controller; ?>/contact" class="<?php echo $selected ?>">Contact Us</a></li>
                <?php
                    if($view_type == 1)
                    {
                        if(isset($g_user_id) && $g_user_id > 0)
                        {

                ?>
                        <li><a href="<?php echo $custom_site_url . $controller; ?>/profile" class="<?php echo $selected ?>">Profile</a></li>
                        <li><a href="<?php echo $custom_site_url . $controller; ?>/logout" class="<?php echo $selected ?>">Logout</a></li>
                <?php
                        }
                        else
                        {
                ?>
                        <li><a href="<?php echo $custom_site_url . $controller; ?>/register" class="<?php echo $selected ?>">Register</a></li>
                        <li><a href="<?php echo $custom_site_url . $controller; ?>/login" class="<?php echo $selected ?>">Login In</a></li>
                <?php
                        }
                    }
                ?>
                
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <?php
            if(isset($g_user_id) && $g_user_id > 0)
            {

        ?>
            <div>
                <a class="btn btn-primary btn-border-radius-lg" href="<?php echo $custom_site_url . $controller; ?>/profile">Profile</a>
                <!-- <a class="btn" href="<?php echo $custom_site_url . $controller; ?>/profile"><i class="bi bi-person-circle"></i></a> -->
                <a href="<?php echo $custom_site_url . $controller; ?>logout" class="text-secondary mx-3">Logout</a>
            </div>
        <?php
            }
            else
            {
                if($view_type == 0)
                {
        ?>
            <div>
                <!-- <a class ="btn btn-outline-success" href="<?php echo $custom_site_url . $controller; ?>/contact">Book a session</a> -->
                <!-- <a class ="btn btn-success" href="<?php echo $custom_site_url . $controller; ?>/register">Register</a> -->
                <a class ="btn btn-primary" href="<?php echo $custom_site_url . $controller; ?>/login">Sign In</a>
            <div>
        <?php
                }
                else
                {
        ?>
                <a class ="btn-getstarted bg-primary" href="<?php echo $custom_site_url . $controller; ?>/login">Sign In</a>
        <?php
                }
            }
        ?>
    </div>
</header>