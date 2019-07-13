

<?php require_once("../../config.php");

    // brisemo onaj order koji ima ID koji proslijedimo GET metodom
	if(isset($_GET['id'])) 
	{

		$query = query("UPDATE messages SET message_seen = 1 WHERE id = " . escape_string($_GET['id']) . " ");
		confirm($query);

		set_message("You have read the message !!!");
		redirect("../../../public/admin/index.php?messages");
		
	} 
	else 
	{

	    redirect("../../../public/admin/index.php?messages");

	}

 ?>