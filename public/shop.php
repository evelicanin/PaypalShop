
<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->


    <!-- Page Content -->
    <div class="container">

        <div class="row">
		    <?php  	
                if (isset($_SESSION['message']))
                {
					echo '
					        <div class="alert alert-danger alert-dismissible" role="alert">
					        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>		
					    ';			
					display_message(); 			 
					echo ' </div>';				
				}						
			?>
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?> 

            <div class="col-md-9">

                <div class="row">

					<?php get_products(); // pozivamo funkciju iz functions.php koja dohvata i prikazuje sve producte ?>
					
                </div>

            </div>

        </div>

		
		
		
    </div>
    <!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_FRONT -->