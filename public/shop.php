<?php require_once("../resources/config.php"); ?>
<?php include (TEMPLATE_FRONT. DS . "header.php");?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
            <h1>Shop</h1>
        <hr>

        <!-- Title -->
        <div class="row">


            <div class="col-lg-12">
                <h3>Latest Features</h3>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->

        <div class="row text-center">
          <?php get_products_in_shop_page();?>
        </div>

        <!-- /.row -->



        <!-- Footer -->
        <?php include(TEMPLATE_FRONT.DS.'footer.php');?>
