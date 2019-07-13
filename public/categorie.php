<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->



	<?php $id_param = escape_string($_GET['id']); ?>
	
	<?php 
	    $getCategorie = get_categorie_by_id($id_param); // pozivamo funkciju iz functions.php koja dohvata informacije o specificnoj kategoriji 
	    $categorie = mysqli_fetch_assoc($getCategorie);	
	?>

	<!-- Page Content -->
    <div class="container">

        <div class="row">
		
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $categorie["cat_title"]; ?>
                    <small>We have listed all available products for this category</small>
                </h1>
            </div>
			
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?> 

            <div class="col-md-9">

                <div class="row">
			        <?php get_product_by_category($id_param); // pozivamo funkciju iz functions.php koja dohvata i prikazuje producte kategorije ?>	
                </div>

            </div>

        </div>
		
    </div>
    <!-- /.container -->
	











<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_FRONT -->