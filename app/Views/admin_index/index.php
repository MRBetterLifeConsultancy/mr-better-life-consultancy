<!DOCTYPE html>
<html lang="en">
    <?php include('head.php') ?>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <?php include('navbar.php') ?>
            <?php include('side_navbar.php') ?>
            <?php include(APPPATH . 'Views' . DIRECTORY_SEPARATOR .$page_path . DIRECTORY_SEPARATOR . $page_name . '.php') ?>

            <?php include('footer.php') ?>
        </div>
        <!-- ./wrapper -->
        <?php include('footer_js.php') ?>
    </body>
</html>