<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row pt-5">
                <div class="col-sm-12 col-md-12">
                    <h3>Today</h3>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $users_visited ?></h3>
                            <p>Users Visited Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $prospects_created ?></h3>
                            <p>Prospects Received Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-glasses"></i>
                        </div>
                        <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_prospects" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $users_registered ?></h3>
                            <p>Users Registered Today</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row pt-5">
                <div class="col-sm-12 col-md-12">
                    <h3>Data</h3>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $regions_count ?></h3>
                            <p>Regions</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $universities_count ?></h3>
                            <p>Universities</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-glasses"></i>
                        </div>
                        <a href="<?php echo $custom_site_url . $controller; ?>/view_edit_prospects" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $university_courses_count ?></h3>
                            <p>Courses</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $testimonials_count ?></h3>
                            <p>Reviews</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
