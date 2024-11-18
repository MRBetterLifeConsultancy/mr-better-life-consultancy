<footer id="footer" class="footer dark-background">
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-12 footer-about">
            <a href="index.html">
              <img style="height: 120px;" class="mt-1 mb-1" src="<?php echo $custom_site_url; ?>/assets/img/MR-Betterlife.png" alt="">
            </a>
            <div class="social-links d-flex mt-4">
              <a href="https://www.facebook.com/share/15f4ng4YNw/?mibextid=LQQJ4d" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="https://www.instagram.com/mrbetterlifeoverseas?igsh=MW9oN2VpajhlaDJ0eg==" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href=" https://www.instagram.com/mrbetterlifeoverseas?igsh=MW9oN2VpajhlaDJ0eg==" class="linkedin"><i class="bi bi-linkedin"></i></a>
              <a href="https://www.youtube.com/@mrbetterlifeconsultancy" class="youtube"><i class="bi bi-youtube"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/">Home</a></li>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/">Study Destinations</a></li>
              <li><a href="<?php echo $custom_site_url.$controller ?>/universities">Universities</a></li>
              <li><a href="<?php echo $custom_site_url . $controller . '/view_all_services' ?>">Services</a></li>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/about">About us</a></li>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/contact">Contact</a></li>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/register">Register</a></li>
              <li><a href="<?php echo $custom_site_url . $controller; ?>/login">Login</a></li>
              <!-- <li><a href="#">Terms of service</a></li>
              <li><a href="#">Privacy policy</a></li> -->
            </ul>
          </div>

          <div class="col-lg-3 col-6 footer-links">
            <h4>Our Services</h4>
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
              <li><a href="<?php echo $custom_site_url . $controller . '/view_all_service#sid-'.$service['service_id'] ?>" class="<?php echo $selected ?>"><?php echo $service_name ?></a></li>
              <?php
                  }
              ?>
            </ul>
          </div>

          <!-- <div class="col-lg-2 col-6 footer-links">
            
          </div> -->

          <div class="col-lg-4 col-md-12 footer-contact text-center text-md-start">
            <h4>Branches</h4>
            <p>
              <span>Chittoor</span>, 
              <span>Madanapalli</span>,
              <span>Hyderabad</span>
            </p>
            <p>
              <span>Chennai</span>,
              <span>Guntur</span>,
              <span>Adilabad</span>.<br>
            </p>
            <br>
            <h4>Contact Us</h4>
            <!-- <strong>Main Branch:</strong> -->
            <p>1st floor, 23-6-72, MR Palli Rd, </p>
            <p>Vasavinagar, New Balaji Colony, </p>
            <p>Tirupati, Andhra Pradesh 517501 </p>
            <br>
            <p><strong>Phone: </strong>  <span>  +44 7913145678, +91 9912000140</span>
            <p><strong>Email: </strong> <span>info@mrbetterlifeconsultancy.com</span></p>
          </div>

        </div>
      </div>
    </div>

    <div class="container copyright text-center">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">MR Better Life Consultancy.</strong> <span>All Rights Reserved</span></p> 
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>