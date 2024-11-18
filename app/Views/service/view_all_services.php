<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/services-page-title-bg.jpg);">
        <div class="container">
            <h1>Services</h1>
            <nav class="breadcrumbs">
            <ol>
                <li><a href="index.html">Home</a></li>
                <li class="current">Our Services</li>
            </ol>
            </nav>
        </div>
    </div><!-- End Page Title -->
    <section class="service-cards section">
        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>How do we help students</h2>
        </div><!-- End Section Title -->
        <div class="container-fluid">
            <?php
                $i = 1;
                foreach($services as $ids => $service)
                {
                    $brief_doc = json_decode($service['brief_document'], true);
            ?>
            <div class="row mb-5 justify-content-center align-items-center">
                <div class="col-md-9" data-aos="fade-up" data-aos-delay="100">
                    <div class="card-item">
                        <div class="row <?php echo $i%2 == 0 ? 'flex-row-reverse': '' ?>  justify-content-center align-items-center">
                            <div class="col-md-5">
                                <div class="card-bg"><img src="<?php echo $custom_site_url ?>assets/img/service-images/<?php echo $brief_doc['image_1_url'] ?>" alt=""></div>
                            </div>
                            <div class="col-md-7 d-flex align-items-center">
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $service['service_name'] ?></h4>
                                    <!-- <h3 class="service-title"><?php echo $service['service_name'] ?></h3> -->
                                    <p class="service-header"><?php echo $brief_doc['header_content'] ?></p>
                                    <h4 class="mb-3 mt-5">Offerings</h4>
                                    <ul class="service-offering">
                                        <?php
                                            foreach ($brief_doc['offerings'] as $key => $offering) 
                                            {
                                        ?>
                                        <li>
                                            <i class="fas fa-regular fa-star"></i>
                                            <?php echo $offering ?>
                                        </li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                    <br>
                                    <a class ="btn btn-outline-primary" href="<?php echo $custom_site_url . $controller; ?>/contact/subject=<?php echo $service['service_name'] ?>">Enquire</a>
                                    <?php
                                        if(isset($brief_doc['show_more_link']))
                                        {
                                    ?>
                                    <a class ="mx-3 text-primary" href="<?php echo $custom_site_url . $controller; ?>/<?php echo $brief_doc['show_more_link'] ?>"><?php echo $brief_doc['show_more_link_text'] ?> ></a>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Card Item -->
            </div>
            <?php
                    $i += 1;
                }
            ?>
        </div>
    </section>
</main>