
	<?php require_once("../../config.php");?>
	
	<?php 

		if(isset($_GET['id']))
		 {
		 $broj = count_products_when_delete_category($_GET['id']) ;	 
		 
			if ($broj == 0) // ako nema producta koji su vezani za kategoriju koju zelimo brisati
			{
				$query = query("DELETE FROM categories WHERE cat_id = " . escape_string($_GET['id']) . " ");
				confirm($query);

				set_message("Category Deleted");			
				redirect("../../../public/admin/index.php?categories");
			} 
			else 
			{
			    set_message("You can not deelte a category that has products. Delete the products first");	
				redirect("../../../public/admin/index.php?categories");
			}
			
		}
		else 
		{

			redirect("../../../public/admin/index.php?categories");
		}

	 ?>