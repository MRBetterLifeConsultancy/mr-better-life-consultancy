<?php
    $brief_document = "";
    if($region_data['brief_document'] != null)
    {
        $brief_document = json_decode($region_data['brief_document'], true);
    }
?>
<main class="main">
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(<?php echo $custom_site_url; ?>assets/img/region-images/<?php echo $brief_document['image_2_url'] ?>);">
    <div class="container">
        <h1>Study in <?php echo $region_data['region_name'] ?>.</h1>
        <nav class="breadcrumbs">
        <ol>
            <li><a href="index.html">Study Destinations</a></li>
            <li class="current">Study in <?php echo $region_data['region_name'] ?>.</li>
        </ol>
        </nav>
    </div>
    </div><!-- End Page Title -->
    <section class="pt-0">
        <div class="container-fluid">
            <div class="region">
                <div class="region-content">
                    <?php
                        if(!isset($brief_document['multiple']) || $brief_document['multiple'] == false )
                        {
                    ?>
                    <div class="row gp-5 gy-5">
                        <div class="col-lg-12">
                            <div class="region-header-text"><?php echo $brief_document['header_content'] ?></div>
                        </div>
                        <div class="col-lg-6 pr-6 why-box">
                            <h3>Why study in  <?php echo $region_data['region_name'] ?></h3>
                            <p><?php echo $brief_document['why_content'] ?></p>
                        </div>
                        <div class="col-lg-6">
                            <h3>Key points</h3>
                            <ul>
                                <?php
                                    foreach($brief_document['key_points'] as $idx => $point)
                                    {
                                ?>
                                <li><i class="fas fa-solid fa-star px-2"></i> <span><?php echo $point ?></span></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row gy-4">
                        <div class="text-center">
                            <h3>Cost of studying in <?php echo $region_data['shortcode'] ?></h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-stripped w-80 table-bordered">
                                <?php $cost = $brief_document['cost']; ?>
                                <thead class="table-primary">
                                    <tr>
                                    <?php
                                        foreach($cost['header_cells'] as $idx => $heading)
                                        {
                                    ?>
                                    <th><?php echo $heading ?></th>
                                    <?php
                                        }
                                    ?>
                                    <tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($cost['rows'] as $idx => $row)
                                        {
                                    ?>
                                        <tr>
                                            <?php
                                                foreach($row as $idy => $cell)
                                                {
                                            ?>
                                        <th><?php echo $cell ?></th>
                                            <?php
                                                }
                                            ?>
                                        <tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot class="table-primary">
                                    <tr>
                                    <?php
                                        foreach($cost['footer_cells'] as $idx => $footer)
                                        {
                                    ?>
                                    <th><?php echo $footer ?></th>
                                    <?php
                                        }
                                    ?>
                                    <tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="row gy-4 gx-5">
                        <div class="col-lg-12 text-center">
                            <h3>Career & Industry Insights</h3>
                        </div>
                        <div class="col-md-5 d-flex">
                            <img class="img-fluid region-footer-img mb-5" src="<?php echo $custom_site_url ?>assets/img/region-images/<?php echo $brief_document['image_3_url'] ?>">
                            <img class="img-fluid region-footer-img mt-5" src="<?php echo $custom_site_url ?>assets/img/region-images/<?php echo $brief_document['image_4_url'] ?>">
                        </div>
                        <div class="col-md-7">
                            <div class="region-footer-content"><?php echo $brief_document['career_and_industry'] ?></div>
                        </div>
                    </div>
                    <?php
                        }
                        else
                        {
                    ?>
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="region-header-text"><?php echo $brief_document['header_content'] ?></div>
                            </div>
                        </div> -->
                        <h3 class="section-title"> Countries in <?php echo $region_data['region_name'] ?></h3>
                    <?php
                        foreach($brief_document['countries'] as $idc => $country)
                        {
                    ?>
                        <div class="row gp-5">
                            <div class="col-lg-12">
                                <h3><?php echo $idc ?></h3>
                                <div class="region-header-text1 my-3"><?php echo $country['header_content'] ?></div>
                            </div>
                        </div>
                        <div class="row gp-5 gy-5 mb-5 justify-content-center align-items-center">
                            <div class="col-lg-5">
                                <div class="card-bg"><img src="<?php echo $custom_site_url ?>assets/img/region-images/<?php echo $country['image_1_url'] ?>" alt=""></div>
                            </div>
                            <div class="col-lg-7">
                                <h3>Key points</h3>
                                <ul>
                                    <?php
                                        foreach($country['key_points'] as $idk => $point)
                                        {
                                    ?>
                                    <li><i class="fas fa-solid fa-star px-2"></i> <span><?php echo $point ?></span></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php   
                        }
                        }
                    ?>
                    <hr class="my-5">
                    <div class=" gy-4 gx-5">
                        <div class="mb-5 text-center">
                            <h3>Top Universities in <?php echo $region_data['region_name'] ?></h3>
                        </div>
                        <div class="row"> 
                            <?php
                                foreach($universities as $idu => $university)
                                {
                            ?>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center" style="height:100px">
                                            <img src="<?php echo $custom_site_url ?>assets/img/universities/<?php echo $university['logo'] ?>" alt="university image cap" style="width:150px; ">
                                            <h3 class="ml-3 card-text"><?php echo $university['university_name'] ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="row justify-content-center align-items-center mt-5">
                            <div class="col-md-3 text-center">
                                <h5><a href="<?php echo $custom_site_url.$controller ?>/universities/r_id=<?php echo $region_data['region_id'] ?>">More Universities ></a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>