<!DOCTYPE html>
<html lang="en">
    <?php include('head.php') ?>
    <body class="<?php echo $page_class_name ?>">
        <?php include('header.php') ?>
        <?php include(APPPATH . 'Views' . DIRECTORY_SEPARATOR . $page_path . DIRECTORY_SEPARATOR . $page_name . '.php') ?>        

        <?php include('footer.php') ?>
        <?php include('footer_js.php') ?>
    </body>
</html>