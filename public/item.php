
<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">

        <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?> 

            <div class="col-md-9">
			
			    <?php $id_param = escape_string($_GET['id']); ?>
				<?php get_product_by_id($id_param); // pozivamo funkciju iz functions.php koja dohvata i prikazuje product ?>

            </div>
        </div>	
    </div>
    <!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_FRONT -->