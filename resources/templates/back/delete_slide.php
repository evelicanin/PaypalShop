	<?php require_once("../../config.php"); ?>

	<?php
		// brisemo onaj order koji ima ID koji proslijedimo GET metodom
		if(isset($_GET['id'])) 
		{

			$query = query("DELETE FROM slides WHERE slide_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			set_message("Slide Deleted");
			redirect("../../../public/admin/index.php?slides");
			
		} 
		else 
		{

			redirect("../../../public/admin/index.php?slides");

		}

	 ?>