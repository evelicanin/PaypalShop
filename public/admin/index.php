<?php require_once("../../resources/config.php"); ?>     <!-- konekcija na bazu i funkcije -->
<?php include(TEMPLATE_BACK . DS . "header.php"); ?>     <!-- poziv header.php fajla iz TEMPLATE_BACK -->

	<?php user_is_logged();?> <!-- ako user nije logovan, vrati ga nazad na index shopa -->
	
        <div id="page-wrapper">
 
            <div class="container-fluid">
			
                <?php 

					    // if($_SERVER['REQUEST_URI'] == "/TESTPAYPAL/public/admin/" || $_SERVER['REQUEST_URI'] == "/TESTPAYPAL/public/admin/index.php")
						if(isset($_GET['admin_content']))
						{
							include(TEMPLATE_BACK . "/admin_content.php");
						}

						if(isset($_GET['messages']))
						{
							include(TEMPLATE_BACK . "/messages.php");
						}
						
						if(isset($_GET['orders']))
						{
							include(TEMPLATE_BACK . "/orders.php");
						}
						
						if(isset($_GET['reports']))
						{
							include(TEMPLATE_BACK . "/reports.php");
						}
						
						if(isset($_GET['categories']))
						{
							include(TEMPLATE_BACK . "/categories.php");
						}

						if(isset($_GET['products']))
						{
							include(TEMPLATE_BACK . "/products.php");
						}

						if(isset($_GET['add_product']))
						{
							include(TEMPLATE_BACK . "/add_product.php");
						}

						if(isset($_GET['users']))
						{
							include(TEMPLATE_BACK . "/users.php");
						}

						if(isset($_GET['add_user']))
						{
							include(TEMPLATE_BACK . "/add_user.php");
						}

						if(isset($_GET['edit_user']))
						{
							include(TEMPLATE_BACK . "/edit_user.php");
						}
						
						if(isset($_GET['view_order']))
						{
							include(TEMPLATE_BACK . "/view_order.php");
						}
						
						if(isset($_GET['edit_product']))
						{
							include(TEMPLATE_BACK . "/edit_product.php");
						}
						
  						if(isset($_GET['slides']))
						{
							include(TEMPLATE_BACK . "/slides.php");
						}  						
						
						if(isset($_GET['delete_slide_id']))
						{
							include(TEMPLATE_BACK . "/delete_slide.php");
						}
                 ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include(TEMPLATE_BACK . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_BACK -->