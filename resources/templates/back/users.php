<div class="col-md-12">

	<?php 
	     
		add_user(); 
		 
    ?>
	
	<div class="row">
		<h1 class="page-header">Admin users</h1>
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

    <div class="col-md-4">
		<form action="" method="post">	

					<label for="username">Username</label>
					<input name="username" type="text" class="form-control">
	                </br>
					<label for="email">Email</label>
					<input name="email" type="text" class="form-control">
	                </br>
					<label for="password">Password</label>
					<input name="password" type="text" class="form-control">
	
	                </br>
				    <input name="add_user" type="submit" class="btn btn-primary" value="Add admin">
					
		</form>		
		
		</br>
        <hr>
	</div>
	
    <div class="col-md-8" style="margin-top:-10px;">
		<table class="table table-hover">
			<thead>

			  <tr>
				   <th>Username</th>
				   <th>Email</th>
				   <th>Password</th>
				   <th>Edit / Delete</th>   
			  </tr>
			</thead>
			<tbody>		
                <?php display_admin_users(); ?>
			</tbody>
		</table>

	</div>
</div>