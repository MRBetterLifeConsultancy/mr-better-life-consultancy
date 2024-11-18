<main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
        <img src="<?php echo $custom_site_url ?>assets/img/hero-bg.jpg" alt="" data-aos="fade-in">
        <div class="container">
            <div class="row">
                <div class="col-xl-4">
                    <h1 data-aos="fade-up">Planning to <br> study abroad ?</h1>
                    <blockquote data-aos="fade-up" data-aos-delay="100">
                    <p>Join MR Betterlife and Arrange your 100% free consultation and embark on your journey to studying in foreign countries.</p>
                    </blockquote>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                    <a href="<?php echo $custom_site_url. $controller; ?>/contact" class="btn-get-started">Book Free Session</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <!-- Why Us Section -->
    <section id="why-us" class="why-us section">
        <div class="container">
            <div class="row g-0">
                <div class="col-xl-5 img-bg" data-aos="fade-up" data-aos-delay="100">
                    <img src="<?php echo $custom_site_url ?>assets/img/why-us-bg.jpg" alt="">
                </div>
                <div class="col-xl-7 slides position-relative" data-aos="fade-up" data-aos-delay="200">

            <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
                {
                "loop": true,
                "speed": 600,
                "autoplay": {
                    "delay": 5000
                },
                "slidesPerView": "auto",
                "centeredSlides": true,
                "pagination": {
                    "el": ".swiper-pagination",
                    "type": "bullets",
                    "clickable": true
                },
                "navigation": {
                    "nextEl": ".swiper-button-next",
                    "prevEl": ".swiper-button-prev"
                }
                }
            </script>
            <div class="swiper-wrapper">

                <div class="swiper-slide">
                <div class="item">
                    <h3 class="mb-3">Plan your abroad study with us!</h3>
                    <h4 class="mb-3">With a keen ear for your choices and preferences, our counselling experience is so seamless that you will land in your dream university!</h4>
                    <p>We offer wide range of services to students from profile evaluation, career counselling, univeristy/course selection to financial aid, visa guidance and many more. We take care of the student even after they reach the destination through Post-departure assitance</p>
                </div>
                </div><!-- End slide item -->

                <div class="swiper-slide">
                <div class="item">
                    <h3 class="mb-3">Multi Country Advantage</h3>
                    <h4 class="mb-3">The World is your Campus!</h4>
                    <p>Aspire for more. Choose what suits you the best from 800+ global universities in 33 countries, world over. The choices and opportunities our universities offer are endless!</p>
                    <ul>
                        <li>8 regions</l1>
                        <li>80+ countries</li>
                        <li>700+ universities</li>
                    </ul>
                </div>
                </div><!-- End slide item -->

                <div class="swiper-slide">
                <div class="item">
                    <h3 class="mb-3">Support from expert team</h3>
                    <p>Our Regional Managers and expert team at the head office are just a call/text away and eager to offer solutions that your business needs.</p>
                    <a href="#call-to-action" class="btn btn-outline-primary btn-rounded">Book Free Session</a>
                </div>
                </div><!-- End slide item -->
            </div>
            <div class="swiper-pagination"></div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        </div>
    </div>

    </section><!-- /Why Us Section -->

    <!-- University Section Section -->
    <section class="light-background section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Know your destination</h2>
            <p>Begin an exciting academic journey in these varied and welcoming study locations!</p>
        </div><!-- End Section Title -->
        <div class="container text-justify" data-aos="fade-up">

            <div class="row mt-2" data-aos="fade-up">
                <?php
                    foreach ($g_regions as $idx => $region) 
                    {
                        $region_name = $region['region_name'];
                        $name = $region['shortcode'];
                        $bd = json_decode($region['brief_document'], true);
                        if($bd != [] && isset($bd['home_image_url']))
                        {
                            $image_file = $bd['home_image_url'];
                        }
                        else
                        {
                            $image_file = '';
                        }
                ?>
                <div class="col-6 col-md-4 gy-5 gx-5 text-center mb-2" style="min-height:40vh;">
                    <div class="w-100 h-100 text-center destination-image" style="background-image:url('<?php echo $custom_site_url ?>/assets/img/region-images/<?php echo $image_file ?>');">
                        <div class="w-100 h-100">
                            <a href="<?php echo $custom_site_url. $controller ."/view_region/rid=".$region['region_id'] ?>" class="text-dark">
                                <span><?php echo $name ?></span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php
                    }
                ?>
            </div>
        </div>
    </section><!-- /University Section Section -->

    <!-- Services Section -->
    <section id="services" class="services section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Services</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row gy-4">
                <?php
                    $i = 1;
                    foreach($services as $ids => $service)
                    {
                        $brief_doc = json_decode($service['brief_document'], true);
                        // $brief_doc['home_page_icon'] = 'briefcase';
                ?>
                <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon flex-shrink-0"><i class="bi bi-<?php echo $brief_doc['home_page_icon'] ?>" style="color: #f57813;"></i></div>
                    <div>
                        <h4 class="title"><?php echo $service['service_name'] ?></h4>
                        <p class="description"><?php echo $brief_doc['header_content'] ?></p>
                        <!-- <a href="#" class="readmore stretched-link"><span>Learn More</span><i class="bi bi-arrow-right"></i></a> -->
                    </div>
                </div>
                <?php
                    }
                ?>
                <!-- End Service Item -->
            </div>
        </div>
    </section><!-- /Services Section -->

    <!-- Book Free Session Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
        <img src="<?php echo $custom_site_url ?>assets/img/cta-bg.jpg" alt="">
        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Book Free Session</h3>
                        <p>We are excited to help you achieve your dreams and looking forward to your successful endeavors!</p>
                        <a class="cta-btn" href="<?php echo $custom_site_url. $controller; ?>/contact">Book Free Session</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Book Free Session Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Testimonials</h2>
            <!-- <p>What our students saying about us</p> -->
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                    {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    },
                    "breakpoints": {
                        "320": {
                        "slidesPerView": 1,
                        "spaceBetween": 40
                        },
                        "1200": {
                        "slidesPerView": 3,
                        "spaceBetween": 1
                        }
                    }
                    }
                </script>
                <div class="swiper-wrapper">
                    <?php
                        foreach($testimonials as $idt => $testimonial)
                        {
                            $user_picture_url = '/assets/img/users/blank-profile-picture.png';
                    ?>
                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <div class="stars">
                                <?php 
                                    for($i=0; $i < $testimonial['no_of_stars']; $i ++)
                                    {
                                ?>
                                <i class="bi bi-star-fill"></i>
                                <?php
                                    }
                                    for($i= $testimonial['no_of_stars']+1; $i <= 5; $i++)
                                    {
                                ?>
                                <i class="bi bi-star"></i>
                                <?php
                                    }
                                ?>
                            </div>
                            <p><?php echo $testimonial['review'] ?></p>
                            <div class="profile mt-auto">
                                <img src="<?php echo $custom_site_url. $user_picture_url; ?>" class="img-fluid testimonial-img" alt="">
                                <h3><?php echo $testimonial['user_name'] ?></h3>
                                <!-- <h4>Ceo &amp; Founder</h4> -->
                            </div>
                        </div>
                    </div><!-- End testimonial item -->
                    <?php
                        }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section><!-- /Testimonials Section -->
</main>