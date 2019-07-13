

	<?php 
	
		if(isset($_GET['id'])) 
		{
			// dohvatimo product za proslijedjeni id koji se pokupi na stranici prodzcts.php
			$query = query("SELECT * FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			// setujemo varijable podacima iz baze koji odgovaraju productu s id-em kojeg smo dobili od products.php
			// ove varijable cemo postaviti u formu za editovanje producta, tako da cim dodjemo na edit_product.php, forma bude popunjea
			// sa podacima onog producta kod kojeg je korisnik kliknuo na EDIT ikonicu i time proslijedio ID
			while($row = fetch_array($query))
			{
				$username          = escape_string($row['username']);
				$email             = escape_string($row['email']);
				$password          = escape_string($row['password']);			 
			}
		}
		
	 ?>

	<!-- forma za editovanje producta -->     
	<form action="" method="post" enctype="multipart/form-data">

		<h1 class="page-header">Edit user</h1>
		
		<div class="col-md-4">

			<div class="form-group">
				<label for="username">Username </label>
				<input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
			</div>

			<div class="form-group">
				<label for="email">Email</label>
				<input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
			</div>
			
			<div class="form-group">
				<label for="password">Password</label>
				<input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
			</div>

			 <div class="form-group pull-right">
				<input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
			</div>
			
		</div><!--Main Content-->




	</form>

	<?php 

		update_user(); // updatujemo product pomocu funkcije update_product()

	 ?>
