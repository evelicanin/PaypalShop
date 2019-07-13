

	<?php require_once("../../config.php"); ?>

	<?php
		// brisemo onaj order koji ima ID koji proslijedimo GET metodom
		if(isset($_GET['id'])) 
		{

			$query = query("DELETE FROM orders WHERE order_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			set_message("Order Deleted");
			redirect("../../../public/admin/index.php?orders");
			
		} 
		else 
		{

			redirect("../../../public/admin/index.php?orders");

		}

	 ?>