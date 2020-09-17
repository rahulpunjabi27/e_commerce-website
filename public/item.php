<?php require_once("../resources/config.php") ?>
<?php include(TEMPLATE_FRONT .DS. "header.php") ?>
    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->

            <?php include_once(TEMPLATE_FRONT .DS. "side_nav.php") ?>

            <?php get_item(); ?>


</div>
    <!-- /.container -->

    <?php include_once(TEMPLATE_FRONT .DS. "footer.php") ?>