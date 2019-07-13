
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
			 
            <h4 class="text-center bg-danger"></h4>
            <h1>Checkout</h1>
			
			<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="business" value="edistizu_business@gmail.com">
                <input type="hidden" name="currency_code" value="US">
				
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Stock</th>
							<th>Product</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Sub-total</th>		 
						</tr>
					</thead>
					
					<tbody>				  
						<?php  cart();  ?>  <!-- ne pozivamo cart.php, nego funkciju cart() iz cart.php -->
					</tbody>
					
				</table>
			
                <?php  show_paypal();  ?>  <!-- pozivamo funkciju show_paypal() iz cart.php -->
				
			</form>

			<!--  ***********CART TOTALS*************-->			
			<div class="col-md-4 pull-right">
			<h2>Cart Totals</h2>

				<table class="table table-bordered" cellspacing="0">
					<tbody>	
						<tr class="cart-subtotal">
							<th>Number of items</th>
							<td>
							    <span class="amount">
								<?php echo isset($_SESSION['item_quantity']) ? $_SESSION['item_quantity'] : $_SESSION['item_quantity'] = "0" ?>    
								</span>
							</td>
						</tr>
						<tr class="shipping">
							<th>Shipping and Handling</th>
							<td>Free Shipping</td>
						</tr>
						<tr class="order-total">
							<th>Order Total</th>
							<td><strong><span class="amount">&#36;</span> 
								<?php echo isset($_SESSION['item_total']) ? $_SESSION['item_total'] : $_SESSION['item_total'] = "0" ?>
								</strong> </td>
						</tr>
					</tbody>
				</table>
				
			</div><!-- CART TOTALS-->
			
        </div>	
    </div>
    <!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>  <!-- poziv footer.php fajla iz TEMPLATE_FRONT -->