	
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
		
    <h1 class="page-header">Add slides</h1>
	
    <div class="row">

    <h3 class="bg-success"></h3>

		<div class="col-xs-3">

			<form action="" method="post" enctype="multipart/form-data">
			
			<?php  add_slides() ?>	
				
				<div class="form-group">
					 <input type="file" name="file">
				</div>

				<div class="form-group">
					<label for="title">Slide Title</label>
					<input type="text" name="slide_title" class="form-control">
				</div>

				<div class="form-group">
					<input type="submit" name="add_slide" value="Add new slide" class="btn btn-primary">
				</div>

			</form>

		</div>

		<div class="col-xs-8">
 
            <span class="label label-primary">Last added slide</span>
			
		     <?php  get_current_slide_in_admin() ?>		   
			 
		</div>

    </div>

	<hr>

	<h1 class="page-header">Delete slides</h1> 

	<div class="row">
							
			<div class="col-xs-12">

			     <?php  get_slide_thumbnailes() ?>		 
	    </div>
	</div>


