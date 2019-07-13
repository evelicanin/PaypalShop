<div class="col-md-12">

	<div class="row">
	<h1 class="page-header">User messages</h1>
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
	</div>
	
	<div class="row">
		<table class="table table-hover">
			<thead>

			  <tr>
				   <th>Id</th>
				   <th>Name</th>
				   <th>Email</th>
				   <th>Phone</th>
				   <th>Subject</th>
				   <th>Message</th>
		   
			  </tr>
			</thead>
			<tbody>		
                <?php display_messages(); ?>
			</tbody>
		</table>

	</div>
</div>