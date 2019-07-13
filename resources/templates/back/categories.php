
	<h1 class="page-header">Product Categories</h1>

		<form action="" method="post" class="form-inline">	
				<span class="label label-primary">Enter a category title</span>
				</br>
				<input name="cat_title" type="text" class="form-control col-lg-8">
				<input name="add_category" type="submit" class="btn btn-primary" value="Add Category">
		</form>		

	<?php 
	     
		 add_category(); 
		 
    ?>
	
	</br>
	<h3 class="page-header">All categories</h3>
	
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
	
		<table class="table">
		
			<thead>
				<tr>
					<th>id</th>
					<th>Title</th>
					<th><b>Number of proucts</b></th>
				</tr>
			</thead>

			<tbody>
				<?php 

					show_categories_in_admin();

				?>
			</tbody>

		</table>






