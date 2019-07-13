<div class="col-md-12">

	<div class="row">
		<h1 class="page-header">Reports</h1>
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
				   <th>Report Id</th>
				   <th>Order id</th>
				   <th>Product</th>
				   <th>Product title</th>
				   <th>Product price</th>
				   <th>Product quantity</th>		   		      		   
			  </tr>
			</thead>
			<tbody>		
                <?php display_reports(); ?>
			</tbody>
		</table>

	</div>
</div>