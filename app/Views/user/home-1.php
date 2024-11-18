<main class="main">
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
        <div class="dark-div pt-25vh">
            <div class="container">
                <div class="row gy-4 justify-content-center justify-content-lg-between">
                    <div class="col-lg-8 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center">
                        <h1 data-aos="fade-up">Are you planning to <br> study abroad ?</h1>
                        <p data-aos="fade-up" data-aos-delay="100">Join MR Betterlife and Arrange your 100% free consultation and embark on your journey to studying in foreign countries.</p>
                        <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                            <a class="btn btn-primary" href="#book-a-session">Book a session</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /Hero Section -->

    <section id="services" class="services">
        <div class="container">
            <h3 class="text-dark text-center">Our Services</h3>
            <div class="row gx-3 gy-2 mt-3">
                <?php
                    $i = 1;
                    foreach($services as $ids => $service)
                    {
                        $brief_doc = json_decode($service['brief_document'], true);
                ?>
                <div class="col-md-4">
                    <div class="card p-2">
                        <div class="card-body">
                            <img class="img-fluid" src="<?php echo $custom_site_url ?>assets/img/service-images/<?php echo $brief_doc['image_1_url'] ?>" alt="service image cap" style="height:150px;">
                            <h3 class="service-title"><?php echo $service['service_name'] ?></h3>
                            <p class="my-1"><?php echo $brief_doc['header_content'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            <div>
        </div>
    </section>

    <!-- University Section Section -->
    <section class="light-background section">
        <div class="container text-justify" data-aos="fade-up">
            <h4>Know your destination</h4>
            <p>Begin an exciting academic journey in these varied and welcoming study locations!</p>
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
                <!-- <div class="col-6 col-md-3 text-center mb-2">
                    <div class="country-banner">
                        <a href="<?php echo $custom_site_url. $controller ."/view_region/rid=".$region['region_id'] ?>" class="text-dark">
                        <img src="<?php echo $custom_site_url ?>/assets/img/regions/<?php echo $image_file ?>" class="shadow-sm" alt="<?php echo $region_name ?> flag">
                        <p><?php echo $name ?></p>
                        </a>
                    </div>
                </div> -->

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

    <!-- Menu Section -->
    <section id="menu" class="menu section">
        <div class="container">
            <h2 class="text-center mb-3">Partner Universities</h2>
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">
                <?php
                    $i = 1;
                    foreach($region_universities as $rid => $region)
                    {
                        $selected = '';
                        if($i == 1)
                        {
                            $selected = 'active show';
                        }
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $selected ?>" data-bs-toggle="tab" data-bs-target="#menu-<?php echo $rid ?>">
                    <h4><?php echo $region['shortcode'] ?></h4>
                    </a>
                </li><!-- End tab nav item -->
                <?php
                        $i += 1;
                    }
                ?>
            </ul><br>
            <div class="tab-content" data-aos="fade-up" data-aos-delay="200">
                <?php
                    $i = 1;
                    foreach($region_universities as $rid => $region)
                    {
                        $selected = '';
                        if($i == 1)
                        {
                            $selected = 'active show';
                        }
                ?>
                <div class="tab-pane fade <?php echo $selected ?>" id="menu-<?php echo $rid ?>">
                    <div class="row gy-5 align-items-center">
                        <?php
                            $uni_count = 0;
                            foreach($region['universities'] as $uid => $university)
                            {
                                if($uni_count == 6)
                                {
                                    break;
                                }
                                $uni_logo = $university['logo'];
                        ?>
                        <div class="col-lg-3 menu-item">
                            <a href="<?php echo $custom_site_url. $controller ?>/view_university/uid=<?php echo $university['university_id'] ?>" class="glightbox"><img src="<?php echo $custom_site_url; ?>assets/img/universities/<?php echo $university['logo'] ?>" class="menu-img img-fluid" alt=""></a>
                        </div>
                        <?php
                                $uni_count += 1;
                            }
                        ?>
                        <div class="col-md-12 text-center">
                            <a class="btn btn-outline-primary" href="<?php echo $custom_site_url. $controller ?>/view_uniuniversities/rid=<?php echo $rid ?>">See more</a>
                        </div>
                    </div>
                </div>
                <?php
                        $i += 1;
                    }
                ?>
            </div>
        </div>
    </section><!-- /Menu Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section light-background">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>TESTIMONIALS</h2>
        <p>What Our Students <span class="description-title">Saying About Us</span></p>
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
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-6">
                            <div class="testimonial-content">
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span><?php echo $testimonial['review'] ?></span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                                <h3><?php echo $testimonial['user_name'] ?></h3>
                                <!-- <h4>Ceo &amp; Founder</h4> -->
                                <div class="stars">
                                    <?php 
                                        for($i=0; $i < $testimonial['no_of_stars']; $i ++)
                                        {
                                    ?>
                                    <i class="bi bi-star-fill"></i>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 text-center">
                            <img src="<?php echo $custom_site_url. $user_picture_url; ?>" class="img-fluid testimonial-img" alt="">
                        </div>
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

    <!-- Contact Section -->
    <section id="book-a-session" class="container-fluid contact section py-0 mt-10">
        <div class="d-flex">
            <div class="col-lg-6 col-md-6 contact-content">
                <!-- Section Title -->
                <div class="container contact-title mt-5" data-aos="fade-up">
                    <h2>Contact Us</h2>
                    <p><span>Book a </span> <span class="description-title">Free Counselling Session</span></p>
                </div><!-- End Section Title -->
                <div class="px-5 pt-0">
                    <p>We are excited to help you achieve your dreams and looking forward to your successful endeavors!</p>
                </div> 
            </div>
            <div class="col-lg-6 col-md-6 pt-5">
                <div class="container" data-aos="fade-up" data-aos-delay="100">
                    <form id="contactForm" name="contactForm" class="px-5 py-3" data-aos="fade-up" data-aos-delay="600">
                        <div class="row gy-4 px-5">
                            <div class="col-md-6">
                                <div class="form-group required">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group required">
                                    <input type="phone" class="form-control" name="phone" placeholder="Your Phone">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group required">
                                    <input type="email" class="form-control" name="email" placeholder="Your Email">
                                </div>
                            </div>

                            <div class="col-md-12 d-none">
                                <div class="form-group required">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group required">
                                    <textarea class="form-control" name="message" rows="6" placeholder="Message"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <button class="btn btn-primary" type="submit" onclick="bookSession(event, this)">Book free session</button>
                            </div>

                        </div>
                    </form><!-- End Contact Form -->
                </div>
            </div>
        </div>
    </section><!-- /Contact Section -->
</main>

<script>
    function bookSession(ev, e) 
    {
        ev.preventDefault();
        enableDisableDiv('#contactForm', false);
        if (!$('#contactForm').valid()) {
            toastr.error('Please check for form errors.');
            enableDisableDiv('#contactForm', true);
            return;
        }
        var name = $('#contactForm').find('[name="name"]').val();
        var phone = $('#contactForm').find('[name="phone"]').val();
        var email = $('#contactForm').find('[name="email"]').val();
        var subject = $('#contactForm').find('[name="subject"]').val();
        var message = $('#contactForm').find('[name="message"]').val();
        
        var submitData = {};
        submitData['name'] = name;
        submitData['phone'] = phone;
        submitData['email'] = email;
        submitData['subject'] = subject;
        submitData['message'] = message;

        var submittedData = {
            'submittedData': submitData
        };

        $.ajax({
            url: '<?php echo $custom_site_url . $controller; ?>/create_prospect/create',
            datatype: 'json',
            type: 'POST',
            data: submittedData,
            success: function(response) {
                enableDisableDiv('#contactForm', true);
                var receivedData = $.parseJSON(response);
                if (receivedData.success == 1) 
                {
                    toastr.success(receivedData.message);
                    if (receivedData.redirect_url) 
                    {
                        // window.location.href = receivedData.redirect_url;
                        window.location.reload();
                    }
                } 
                else 
                {
                    toastr.error(receivedData.message);
                }
            },
            error: function() 
            {
                enableDisableDiv('#contactForm', true);
                toastr.error("Refresh the page and try again")
            }
        });
    }

    // form validation
    $('#contactForm').validate({
        rules: {
            name:{
                required: true
            },
            phone:{
                required: true,
                pattern: /^[6-9]\d{9}$/,
            },
            email:{
                required: true,
                email: true
            },
            subject:{
                required: true
            },
            message:{
                required: true
            },
        },
        messages: {
            name:{
                required: "Please enter your full name"
            },
            phone:{
                required: "Please enter a phone number",
                pattern: "Enter phone starting with [6,7,8,9] and 10 digits long"
            },
            email:{
                required: "Please enter your email"
            },
            subject:{
                required: "Please enter subject/purpose of the session"
            },
            message:{
                required: "Please enter message"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        }
    });
</script>