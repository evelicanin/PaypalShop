	
	<?php require_once("../../config.php");

		// brisemo onaj order koji ima ID koji proslijedimo GET metodom
		if(isset($_GET['id'])) 
		{

			$query = query("DELETE FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
			confirm($query);

			set_message("Product has been successfully deleted");
			redirect("../../../public/admin/index.php?products");
			
		} 
		else 
		{
			redirect("../../../public/admin/index.php?products");
		}

	 ?>