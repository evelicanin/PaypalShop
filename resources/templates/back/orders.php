<div class="col-md-12">

	<div class="row">
		<h1 class="page-header">Orders</h1>
	    <?php  	
			if (isset($_SESSION['message']))
			{
				echo '
						<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>		
					';
		
				display_message(); 			 
				echo ' </div>';				
			}					
	 ?>
			 
	<div class="row">
		<table class="table table-hover">
			<thead>

			  <tr>
				   <th>Id</th>
				   <th>Amount</th>
				   <th>Transaction</th>
				   <th>Currency</th>
				   <th>Status</th>
				   <th>Delete order</th>
		   
			  </tr>
			</thead>
			<tbody>		
                <?php display_orders(); ?>
			</tbody>
		</table>

	</div>
</div>