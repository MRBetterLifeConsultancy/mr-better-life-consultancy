<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/about-page-title-bg.jpg);">
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
    <section id="services" class="services">
        <div class="container">
                <h3 class="text-dark text-center">How do we help students</h3>
                <?php
                    $i = 1;
                    foreach($services as $ids => $service)
                    {
                        $brief_doc = json_decode($service['brief_document'], true);
                ?>
                <div class="service-content" id="sid-<?php echo $service['service_id'] ?>">
                    <div class="row <?php echo $i%2 == 0 ? 'flex-row-reverse': '' ?>">
                        <div class="col-md-6 <?php echo $i%2 == 0 ? '': 'pr-5' ?>">
                            <img class="img-fluid" src="<?php echo $custom_site_url ?>assets/img/service-images/<?php echo $brief_doc['image_1_url'] ?>" alt="service image cap">
                        </div>
                        <div class="col-md-6">
                            <h3 class="service-title"><?php echo $service['service_name'] ?></h3>
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
                            <a class ="btn btn-outline-primary" href="<?php echo $custom_site_url . $controller; ?>/contact">Enquire</a>
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
                <hr>
                <?php
                        $i += 1;
                    }
                ?>
        </div>
    </section>
</main>