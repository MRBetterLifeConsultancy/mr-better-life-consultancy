<main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url ?>assets/img/loans-page-title-bg.jpg);">
        <div class="container">
        <h1>Education Loans</h1>
        <nav class="breadcrumbs">
            <ol>
            <li><a href="index.html">Services</a></li>
            <li class="current">Educational Loans</li>
            </ol>
        </nav>
        </div>
    </div><!-- End Page Title -->

    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="service-title">Financing your global study dreams</h3>
                    <p class="service-header">
                        Financing your global study dreams With our leading partnered nationalized banks, private banks, NBFCs and international lenders and a team of loan experts, we are empowering the global study dreams of thousands of students like you. Our loan experts will suggest the right financial institution based on your eligibility & preferences, assist in documentation & submission of your loan application and will address all your loan related queries. Get your education loan approved faster, as we swiftly guide you each step of the way to avail the one meeting all your funding needs.
                    </p>
                </div>
                <div class="col-md-5">
                    <img class="img-fluid" src="<?php echo $custom_site_url ?>assets/img/service-images/service-6-1.jpg" alt="service image cap">
                </div> 
                <div class="col-md-6">
                    <ul class="service-offering">
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Study Loans through 20+ Leading Financial Institutions
                        </li>
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Secured and Unsecured Loans
                        </li>
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Pre-visa Disbursal of Loans
                        </li>
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Hassle Free Documentation
                        </li>
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Quick Sanction of loans
                        </li>
                        <li>
                            <i class="fas fa-regular fa-star"></i>
                            Zero Service Charges
                        </li>
                    </ul>
                </div>
            </div>
        <div>
    </section>

    <!-- Services Section -->
    <section class="services section light-background">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Loan Process</h2>
            <p>Our team will not only assist you in selecting the right financial institution but also guide you step by step as to how to get education loan for studying abroad.</p>
        </div><!-- End Section Title -->

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-3 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon flex-shrink-0"><i class="bi bi-1-circle" style="color: #f57813;"></i></div>
                    <div>
                        <h4 class="title">Approach us in person or online</h4>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-3 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon flex-shrink-0"><i class="bi bi-2-circle" style="color: #15a04a;"></i></div>
                    <div>
                        <h4 class="title">Create Your Profile and Know Your Eligibility</h4>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-3 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon flex-shrink-0"><i class="bi bi-3-circle" style="color: #d90769;"></i></div>
                    <div>
                        <h4 class="title">Proceed With Documentation & Application</h4>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-3 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="400">
                    <div class="icon flex-shrink-0"><i class="bi bi-4-circle" style="color: #15bfbc;"></i></div>
                    <div>
                        <h4 class="title">Get your loan Sanctioned and Disbursed !</h4>
                    </div>
                </div><!-- End Service Item -->
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

    <section class="section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Our Banking Partners</h2>
        </div><!-- End Section Title -->
        <div class="container">
            <div class="row justify-content-center align-items-center gy-4">
                <?php
                    foreach($banking_partners as $idx => $bank)
                    {
                ?>
                <div class="col-md-4 text-center">
                    <img src="<?php echo $custom_site_url ?>/assets/img/banks/<?php echo $bank['logo'] ?>" class="img-fluid">
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>
</main>