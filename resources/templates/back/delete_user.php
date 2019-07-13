	
	<?php require_once("../../config.php"); ?>
	<?php

		// brisemo onaj order koji ima ID koji proslijedimo GET metodom
		if(isset($_GET['id'])) 
		{

			$query = query("DELETE FROM users WHERE user_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			set_message("User Deleted");
			redirect("../../../public/admin/index.php?users");
			
		} 
		else 
		{

			redirect("../../../public/admin/index.php?users");

		}

	 ?>