
<?php require_once("../resources/config.php"); ?>      <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>  <!-- poziv header.php fajla iz TEMPLATE_FRONT -->

    <!-- Page Content -->
    <div class="container">
        <div class="row">

			<h1 class="text-center">User Login</h1>
		    <?php  	
                if (isset($_SESSION['message']))
                {
					echo '
					        <div class="alert alert-danger alert-dismissible col-sm-4 col-sm-offset-5" role="alert">					        			
					    ';					 
					display_message(); 			 
					echo ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					      </div>';				
				}							
			 ?>
					
				<div class="col-sm-4 col-sm-offset-5">         
					<form class="" action="" method="post" enctype="multipart/form-data">
							
							<?php login_user(); ?>

						<div class="form-group"><label for="">
							Username<input type="text" name="username" class="form-control"></label>
						</div>
						 <div class="form-group"><label for="password">
							Password<input type="password" name="password" class="form-control"></label>
						</div>

						<div class="form-group">
						  <input type="submit" name="submit" class="btn btn-primary" >
						</div>
					</form>
				</div>  

        </div>
    </div>
    <!-- /.container -->



	<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_FRONT -->