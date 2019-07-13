<div class="col-md-12">

	<div class="row">
		<h1 class="page-header">Products</h1>
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
				   <th>Title</th>
				   <th>Description</th>
				   <th>Category</th>
				   <th>Price</th>
				   <th>Quantity</th>   
			  </tr>
			</thead>
			<tbody>		
                <?php get_products_in_admin(); ?>
			</tbody>
		</table>

	</div>
</div>