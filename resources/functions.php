<?php

// global
$upload_directory = "uploads";

/**************************************************************************************************************************************************/ 
/**** HELPER FUNCTIONS ****************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 

    // funkcija za preusmjeravanje korisnika
	function redirect($location)
	{
		return header("Location: $location");
	}
 
    // funkcija za setovanje poruke za sesiju
	function set_message($msg)
	{
		if(!empty($msg)) 
		{
			$_SESSION['message'] = $msg;
		}
		else 
		{
			$msg = "";
		}
	}
 
	// funkcija za prikaz poruke
	function display_message() 
	{
		if(isset($_SESSION['message'])) 
		{
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		}
	}
		
	// funkcija za ciscenje stringova koje korisnik unese
	function escape_string($string)
	{
        global $connection;         		
		return mysqli_real_escape_string($connection, $string);
	}
	
/**************************************************************************************************************************************************/ 	
/**** HELPER FUNCTIONS ****************************************************************************************************************************/ 
/**************************************************************************************************************************************************/

/**************************************************************************************************************************************************/ 	
/**** DATABASE FUNCTIONS **************************************************************************************************************************/ 
/**************************************************************************************************************************************************/
	
	// funkcija koja vraca ID posljednjeg inserta
	function last_id()
	{
		global $connection;
		return mysqli_insert_id($connection);
	} 
	
	// funkcija za izvrsavanje sql upita
	function query($sql)
	{
        global $connection;		
		return mysqli_query($connection, $sql);		
	}
	
    // funkcija za dohvatanje slogova izvrsenog upita
	function fetch_array($result)
	{
		return mysqli_fetch_array($result);	
	}
	
    // funkcija za provjeru ispravnosti izvrsenog upita
	function confirm($result)
	{
	    global $connection;         		
        if(!$result)
		    {
				die("DATABASE QUERY FAILED " . mysqli_error($connection));
            }		
	}
	
/**************************************************************************************************************************************************/ 	
/**** DATABASE FUNCTIONS **************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 
    	
/**************************************************************************************************************************************************/ 
/**** LOGIN FUNCTIONS *****************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 

	function login_user()
	{
		if(isset($_POST['submit']))
		{
			$username = escape_string($_POST['username']);
			$password = escape_string($_POST['password']);
			
            // ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
			$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ");
			confirm($query);

			// ukoliko user postoji u bazi, rezultat je = 1, ukoliko ne postoji takav user, rezultat je = 0
			if(mysqli_num_rows($query) == 0) 
			{
				set_message("Your Password or Username are wrong");
				redirect("login.php"); // ostajemo na istoj stranici
			} 
			else 
			{
				$_SESSION['username'] = $username;
				redirect("admin/index.php?admin_content"); // preusmjeravamo korisnika na administraciju
			}
		}
	}
	
	// funkcija koja provjerava da li je logovan korisnik
	function user_is_logged()
	{
		if(!isset($_SESSION['username']))
		{
		    set_message("You need to login as admin to see the admin area");
		    redirect("../../public"); // ne ovako, izbjeci koristenje / ili \, koristiti DS
		    //redirect ("..' . DS . '..' . DS . 'public"); // vracamo iz indexa administracije na index shopa 
		}
	}
	
/**************************************************************************************************************************************************/ 
/**** LOGIN FUNCTIONS *****************************************************************************************************************************/
/**************************************************************************************************************************************************/ 

/**************************************************************************************************************************************************/  
/**** FRONT-END FUNCTIONS *************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 

	// funkcija za cuvanje poruka koju ostavljaju korisnici
	function save_message()
	{
		
		if(isset($_POST['submit']))
		{
		    $to          =   "edis.velicanin@gmail.com";
			
			if(isset($_POST['name'])){ $name = escape_string($_POST['name']); } 
			if(isset($_POST['email'])){ $email = escape_string($_POST['email']); } 
			if(isset($_POST['phone'])){ $phone = escape_string($_POST['phone']); } 
			if(isset($_POST['subject'])){ $subject = escape_string($_POST['subject']); } 
			if(isset($_POST['message'])){ $message = escape_string($_POST['message']); } 
						
			// insert u tabelu historije
			$insert_msg  = "INSERT INTO messages (";
			$insert_msg .= "  name, email, phone, subject, message ";
			$insert_msg .= ") VALUES (";
			$insert_msg .= "  '{$name}', '{$email}', '{$phone}', '{$subject}', '{$message}' ";
			$insert_msg .= ")";
			// $insert_result_ist = mysqli_query($connection, $insert_msg);
			$insert_result_ist = query($insert_msg);
            confirm($insert_result_ist);         
			
            set_message("Your message has been sent.");
			redirect("contact.php"); // idemo na index		
			
        }		
	}	
	
    // f-ja koja dohvata i prikazuje sve kategorije u vidu liste linkova
	function get_categories()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM categories";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
            echo '<a href="categorie.php?id='.htmlentities($row["cat_id"]).'" class="list-group-item">'.htmlentities($row["cat_title"]).'</a>';	
		}
	}

    // f-ja koja dohvata i prikazuje kategoriju koji ima id jednak onome koji je proslijedjen
	function get_categorie_by_id($id)
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM categories WHERE cat_id = '{$id}' LIMIT 1";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

        return $run_query;
	}
	
    // f-ja koja dohvata i prikazuje kategoriju koji ima id jednak onome koji je proslijedjen
	function get_categorie_name_by_id($id)
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT cat_title FROM categories WHERE cat_id = '{$id}' LIMIT 1";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);         
		
        return $run_query;
	}
	
    // f-ja koja dohvata i prikazuje sve producte shopa
	function get_products()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM products";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
			        <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id='.htmlentities($row["product_id"]).'">
								<img src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'" alt="">
							</a>
							<div class="caption">								
								<h4>'.htmlentities($row["product_title"]).'</h4>
								<p>'.htmlentities($row["short_desc"]).'</p>
								<a  class="btn btn-primary" 
									href="../resources/cart.php?add='.htmlentities($row["product_id"]).'">
									Add to cart
								</a>
								<a href="item.php?id='.htmlentities($row["product_id"]).'" class="btn btn-default">More info</a>
							</div>
                        </div>
                    </div>
				';
		}
	}

   // f-ja koja dohvata i prikazuje sve producte shopa koji su HOT
	function get_hot_products()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM products WHERE hot_product = 1";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
			        <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id='.htmlentities($row["product_id"]).'">
								<img src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'" alt="">
							</a>
							<div class="caption">								
								<h4>'.htmlentities($row["product_title"]).'</h4>
								<p>'.htmlentities($row["short_desc"]).'</p>
								<a  class="btn btn-primary" 
									href="../resources/cart.php?add='.htmlentities($row["product_id"]).'">
									Add to cart
								</a>
								<a href="item.php?id='.htmlentities($row["product_id"]).'" class="btn btn-default">More Info</a>
							</div>
                        </div>
                    </div>
				';
		}
	}
	
    // f-ja koja dohvata i prikazuje product za proslijedjeni id producta
	function get_product_by_id($id)
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM products WHERE product_id = '{$id}' ";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{	
			echo '
			    <div class="col-sm-3 col-md-8">
					<div class="thumbnail">
						<img class="img-responsive" src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'" alt="">
					 </div>
                </div>
				<div class="row">
				  <div class="col-sm-3 col-md-4">
					<div class="thumbnail">
					  <div class="caption">
						<h3>'.htmlentities($row["product_title"]).'</h3>
						<h4>'.htmlentities($row["product_price"]).'</h4>
						<h4>Available : '.htmlentities($row["product_quantity"]).'</h4>
						<p>'.htmlentities($row["product_description"]).'</p>
						<p>
						    <a href="../resources/cart.php?add='.htmlentities($row["product_id"]).'" class="btn btn-primary" role="button">Add to cart</a> 
						</p>
					  </div>
					</div>
				  </div>
				</div>
				';

		}
	}
	
    // f-ja koja dohvata i prikazuje product za proslijedjeni id producta
	function get_product_by_category($id)
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM products WHERE product_category_id = '{$id}' ";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
			        <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id='.htmlentities($row["product_id"]).'">
								<img src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'" alt="">
							</a>
							<div class="caption">								
								<h4><a href="item.php?id='.htmlentities($row["product_id"]).'">'.htmlentities($row["product_title"]).'</a></h4>
								<p>'.htmlentities($row["short_desc"]).'</p>
								<a  class="btn btn-primary" 
									href="../resources/cart.php?add='.htmlentities($row["product_id"]).'">
									Add to cart
								</a>
								<a href="item.php?id='.htmlentities($row["product_id"]).'" class="btn btn-default">More info</a>
							</div>
                        </div>
                    </div>
				';			
		}
	}
	
/**************************************************************************************************************************************************/ 	
/**** FRONT-END FUNCTIONS *************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 

/**************************************************************************************************************************************************/ 	
/**** BACK-END FUNCTIONS **************************************************************************************************************************/ 
/**************************************************************************************************************************************************/ 


    /* DASHBOARD ***********************************************************************************************************************************/
    // f-ja koja vraca broj narudzbi od strane korisnika shop-a
	function count_orders()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_orders FROM orders";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
            echo '
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">'.htmlentities($row["num_of_orders"]).'</div>
                                        <div>New Orders!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?orders">
                                <div class="panel-footer">
                                    <span class="pull-left">View all orders</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>				
			';	
		}
	}

    // f-ja koja vraca broj poruka poslanih putem kontakt forme od strane korisnika shop-a
	function count_messages()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_messages FROM messages WHERE message_seen = 0";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
            echo '
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">'.htmlentities($row["num_of_messages"]).'</div>
                                        <div>New messages!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?messages">
                                <div class="panel-footer">
                                    <span class="pull-left">View all messages</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>				
			';	
		}
	}

    // f-ja koja vraca broj poruka poslanih putem kontakt forme od strane korisnika shop-a
	function count_messages_top_nav()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_messages FROM messages WHERE message_seen = 0";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
            echo htmlentities($row["num_of_messages"]);
		}
	}
	
    // f-ja koja vraca broj poruka poslanih putem kontakt forme od strane korisnika shop-a
	function count_products()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_products FROM products";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-support fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">'.htmlentities($row["num_of_products"]).'</div>
                                        <div>Products!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?products">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>			
			
			     ';
		}
	}

    // f-ja koja vraca broj kategorija proizvoda
	function count_categories()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_categories FROM categories";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
                    <div class="col-lg-6 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">'.htmlentities($row["num_of_categories"]).'</div>
                                        <div>Categories!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="index.php?categories">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>			
			
			     ';
		}
	}
	
	function count_products_when_delete_category($cat_id)
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT count(*) num_of_products FROM products WHERE product_category_id = '{$cat_id}' ";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		$row = fetch_array($run_query);
		
		return $row["num_of_products"];
		
	}
	
    /* DASHBOARD ***********************************************************************************************************************************/
	
	/* ORDERS **************************************************************************************************************************************/
    // f-ja koja vraca sve narudzbe korisnika shopa
	function display_orders()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM orders";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
            echo '
				<tr>
					<td>'.htmlentities($row["order_id"]).'</td>
					<td>'.htmlentities($row["order_amount"]).'</td>
					<td>'.htmlentities($row["order_transaction"]).'</td>
					<td>'.htmlentities($row["order_currency"]).'</td>
					<td>'.htmlentities($row["order_status"]).'</td>
                    <td>
					    <a class="btn btn-danger" 
						   href="../../resources/templates/back/delete_order.php?id='.htmlentities($row["order_id"]).'">
						    <span class="glyphicon glyphicon-remove"></span>
						</a>
					</td>	
				</tr>					
			';	
		}
	}
	/* ORDERS **************************************************************************************************************************************/	
	
	/* MESSAGES ************************************************************************************************************************************/		
    // f-ja koja vraca sve poruke koje su korisnici shopa poslali putem kontakt forme
	function display_messages()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM messages";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
		    if ($row["message_seen"] == 1)
			{
				echo '
					<tr>
						<td>'.htmlentities($row["id"]).'</td>
						<td>'.htmlentities($row["name"]).'</td>
						<td>'.htmlentities($row["email"]).'</td>
						<td>'.htmlentities($row["phone"]).'</td>
						<td>'.htmlentities($row["subject"]).'</td>
						<td>'.htmlentities($row["message"]).'</td>			
						<td>   
							<a class="btn btn-success  disabled" 
							   href="../../resources/templates/back/seen_message.php?id='.htmlentities($row["id"]).'">
								<i class="fa fa-check"></i>
							</a>
						</td>
					</tr>					
				';	
			}
			else 
			{
				echo '
					<tr>
						<td>'.htmlentities($row["id"]).'</td>
						<td>'.htmlentities($row["name"]).'</td>
						<td>'.htmlentities($row["email"]).'</td>
						<td>'.htmlentities($row["phone"]).'</td>
						<td>'.htmlentities($row["subject"]).'</td>
						<td>'.htmlentities($row["message"]).'</td>			
						<td>   
							<a class="btn btn-danger" 
							   href="../../resources/templates/back/seen_message.php?id='.htmlentities($row["id"]).'">
								<i class="fa fa-check"></i>
							</a>
						</td>
					</tr>					
				';	
			}		
		}
	}
	/* MESSAGES ************************************************************************************************************************************/	
	
	/* PRODUCTS ************************************************************************************************************************************/		
    // f-ja koja dohvata i prikazuje sve producte shopa
	function get_products_in_admin()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT p.product_id, p.product_title, p.product_image, p.product_description, p.product_price, p.product_quantity, c.cat_title  FROM products p, categories c WHERE p.product_category_id = c.cat_id";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
				<tr>
					<td>'.htmlentities($row["product_id"]).'</td>
					<td>
                        <img  height ="64" width="192" 
                              src="..'. DS . '..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'">
                              <br><P class="text-primary">'.htmlentities($row["product_title"]).'</P>
					</td>					
					<td>'.htmlentities($row["product_description"]).'</td>
					<td><b class="text-warning">'.htmlentities($row["cat_title"]).'</b></td>
					<td><p class="text-primary">'.htmlentities($row["product_price"]).'</P></td>
					<td><b class="text-danger">'.htmlentities($row["product_quantity"]).'</b></td>			
					<td>   
						<a class="btn btn-primary" 
						   href="index.php?edit_product&id='.htmlentities($row["product_id"]).'">
							<i class="fa fa-pencil"></i>
						</a>
						</br>
						</br>
						<a class="btn btn-danger" 
						   href="../../resources/templates/back/delete_product.php?id='.htmlentities($row["product_id"]).'">
							<i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>					
			';	
		}
	}

	// funkcija za dodavanje novih producta
	function add_product()
	{
		if(isset($_POST['publish']))
		{

			$product_title          = escape_string($_POST['product_title']);
			$product_category_id    = escape_string($_POST['product_category_id']);
			$product_price          = escape_string($_POST['product_price']);
			$product_description    = escape_string($_POST['product_description']);
			$short_desc             = escape_string($_POST['short_desc']);
			$product_quantity       = escape_string($_POST['product_quantity']);
			$product_image          = escape_string($_FILES['file']['name']);
			$image_temp_location    = escape_string($_FILES['file']['tmp_name']);

			move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);

			$query = query("INSERT INTO products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image) VALUES('{$product_title}','{$product_category_id}','{$product_price}','{$product_description}','{$short_desc}','{$product_quantity}','{$product_image}')");

			$last_id = last_id();
			confirm($query);
			
			set_message("New Product with id {$last_id} was added");
			redirect("index.php?products");

		}
	}
	
	function update_product()
	{
		if(isset($_POST['update']))
		{
			$product_title          = escape_string($_POST['product_title']);
			$product_category_id    = escape_string($_POST['product_category_id']);
			$product_price          = escape_string($_POST['product_price']);
			$product_description    = escape_string($_POST['product_description']);
			$short_desc             = escape_string($_POST['short_desc']);
			$product_quantity       = escape_string($_POST['product_quantity']);
			$product_image          = escape_string($_FILES['file']['name']);
			$image_temp_location    = escape_string($_FILES['file']['tmp_name']);

			if(empty($product_image))
			{
				$get_pic = query("SELECT product_image FROM products WHERE product_id =" .escape_string($_GET['id']). " ");
				confirm($get_pic);

				while($pic = fetch_array($get_pic)) 
				{
					$product_image = $pic['product_image'];
				}
			}

			move_uploaded_file($image_temp_location  , UPLOAD_DIRECTORY . DS . $product_image);

			$query = "UPDATE products SET ";
			$query .= "product_title            = '{$product_title}'        , ";
			$query .= "product_category_id      = '{$product_category_id}'  , ";
			$query .= "product_price            = '{$product_price}'        , ";
			$query .= "product_description      = '{$product_description}'  , ";
			$query .= "short_desc               = '{$short_desc}'           , ";
			$query .= "product_quantity         = '{$product_quantity}'     , ";
			$query .= "product_image            = '{$product_image}'          ";
			$query .= "WHERE product_id=" . escape_string($_GET['id']);

			$send_update_query = query($query);
			confirm($send_update_query);
			
			set_message("Product has been updated");
			redirect("index.php?products");

		}
	}		
	/* PRODUCTS ************************************************************************************************************************************/			
	
	/* REPORTS ************************************************************************************************************************************/			
    // f-ja koja dohvata i prikazuje reporte o prodanim productma
	function display_reports()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT r.report_id, r.order_id, r.product_id, r.product_title, r.product_price, r.product_quantity FROM reports r";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
				<tr>
					<td>'.htmlentities($row["report_id"]).'</td>
					<td>'.htmlentities($row["order_id"]).'</td>
					<td>'.htmlentities($row["product_id"]).'</td>			
					<td><b class="text-warning">'.htmlentities($row["product_title"]).'</b></td>
					<td><p class="text-primary">'.htmlentities($row["product_price"]).'</P></td>
					<td><b class="text-danger">'.htmlentities($row["product_quantity"]).'</b></td>			
				</tr>					
			';	
		}
	}

	/* REPORTS ***************************************************************************************************************************************/		
	
	/* USERS *****************************************************************************************************************************************/		
	
	// f-ja koja dohvata i prikazuje reporte o prodanim productma
	function display_admin_users()
	{	
		// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi	
		$query = "SELECT * FROM users";    

		// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
		$run_query = query($query);      

		// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
		confirm($run_query);                    

		// resultat upita je uvijek niz (cak i kad radis count)
		// taj niz cemo pomocu while petlje da prikazemo na frontu
		// slog po slog iz upita se smjesta u varijablu $row
		// koristimo funkciju  << fetch_array >> iz functions.php koja mijenja mysqli_fetch_array($result)
		while ($row = fetch_array($run_query))
		{
			echo '
				<tr>
					<td>'.htmlentities($row["username"]).'</td>
					<td>'.htmlentities($row["email"]).'</td>			
					<td>'.htmlentities($row["password"]).'</td>			
					<td>   
						<a class="btn btn-primary" 
						   href="index.php?edit_user&id='.htmlentities($row["user_id"]).'">
							<i class="fa fa-pencil"></i>
						</a>
						<a class="btn btn-danger" 
						   href="../../resources/templates/back/delete_user.php?id='.htmlentities($row["user_id"]).'">
							<i class="fa fa-trash"></i>
						</a>
					</td>	
				</tr>					
			';	
		}
	}
	
	// funkcija za update podataka admin usera
	function update_user()
	{
		if(isset($_POST['update']))
		{		
			
			$username          = escape_string($_POST['username']);
			$email             = escape_string($_POST['email']);
			$password          = escape_string($_POST['password']);
			
			$query = "UPDATE users SET ";
			$query .= "username                 = '{$username}'        , ";
			$query .= "email                    = '{$email}'           , ";
			$query .= "password                 = '{$password}'          ";
			$query .= "WHERE user_id=" . escape_string($_GET['id']);

			$send_update_query = query($query);
			confirm($send_update_query);
			
			set_message("User has been updated");
			redirect("index.php?users");


		}
	}	
	
	// funkcija za dodavanje novog admin usera
	function add_user() 
	{
		if(isset($_POST['add_user'])) 
		{
			$username = escape_string($_POST['username']);
			$email    = escape_string($_POST['email']);
			$password = escape_string($_POST['password']);
		
			$insert_user = query("INSERT INTO users(username, email, password) VALUES ('{$username}', '{$email}', '{$password}') ");
			confirm($insert_user);
			set_message("User " . $username . " added");
        }
	}
	
	/* USERS *****************************************************************************************************************************************/			
	
	/* CATEGORIES ************************************************************************************************************************************/		
	
	// funkcija za prikaz svih kategorija u tabeli
	function show_categories_in_admin()
	{
		$category_query = query("SELECT * FROM categories");
		confirm($category_query);
		
		while($row = fetch_array($category_query)) 
		{

			$cat_id = $row['cat_id'];
			$cat_title = $row['cat_title'];
			
			echo '		
					<tr>
						<td>'.htmlentities($row["cat_id"]).'</td>
						<td>'.htmlentities($row["cat_title"]).'</td>
						<td>'.count_products_when_delete_category($row["cat_id"]).'</td>
						<td><a class="btn btn-danger" href="../../resources/templates/back/delete_category.php?id='.htmlentities($row["cat_id"]).'">
						    <span class="glyphicon glyphicon-remove"></span></a>
						</td>
					</tr> ';
		}
	}

	// funkcija za dodavanje nove kategorije
	function add_category() 
	{
		if(isset($_POST['add_category'])) 
		{
			$cat_title = escape_string($_POST['cat_title']);

			if(empty($cat_title) || $cat_title == " ") 
			{
			    echo "<p class='bg-danger'>This cannot be empty! Please enter a category title.</p>";
			} 
			else
			{
				$insert_cat = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
				confirm($insert_cat);
				set_message("Category " . $cat_title . " created");
			}
        }
	}

	// funkcija za prikaz svih kategorija u dropdown listi
	function show_categories_add_product_page()
	{
		$query = query("SELECT * FROM categories");
		confirm($query);

		while($row = fetch_array($query))
		{
		    echo '<option value="'.htmlentities($row["cat_id"]).'">'.htmlentities($row["cat_title"]).'</option>;';
	    }
	}

	// funkcija koja vraca naziv kategorije za proslijedjeni id kategorije
	function show_product_category_title($product_category_id)
	{
		$category_query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
		confirm($category_query);

		while($category_row = fetch_array($category_query))
		{
            return $category_row['cat_title'];
		}
	}

	// funkcija vraca putanju do slike producta
	function display_image($picture)
	{

		global $upload_directory;
		
		// u tabeli 'products', koloni product_image nalazi se ime slike (npr. image_7.jpg)
		// to ime spajamo sa putanjom do slike + / --> resources/uploads/image_7.jpg
		return $upload_directory  . DS . $picture; 

	}
	
	/* CATEGORIES ************************************************************************************************************************************/		
	
	/* SLIDES ****************************************************************************************************************************************/		
	
	// dodavanje novih slideova u admonistraciji slideova
	function add_slides()
	{
	    if(isset($_POST['add_slide']))
		{
		    $slide_title     = escape_string($_POST['slide_title']);
		    $slide_image     = escape_string($_FILES['file']['name']);
		    $slide_image_loc = escape_string($_FILES['file']['tmp']);
			
			if ( empty($slide_title) || empty($slide_image) )
				{
					set_message("This field can not be empty! Please select an image to be uploaded.");
				    redirect("index.php?slides");
				}
			else
				{
				    move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);
					
					$slide_query = query("INSERT INTO slides(slide_title, slide_image) VALUES ('{$slide_title}','{$slide_image}')");
		            confirm($slide_query);
					
					set_message("New slide added.");
					redirect("index.php?slides");
				}		
		}	
	}	
	
	// dohvatamo sve slajdove osim zadnje dodanog (zadnje dodani imamo u posebnoj funkciji)
	function get_slides()
	{
		$slide_query = query("SELECT * FROM slides WHERE slide_id < ( SELECT MAX(slide_id) FROM slides )");
		confirm($slide_query);
		
		while($row = fetch_array($slide_query)) 
		{				
			echo '		
					<div class="item">
                        <img  src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["slide_image"]).'">
					</div>			
                 ';
		}	
	}

	// posljednje dodani slide ima najveci slide_id. NJega postavljamo da je uvijek ''active'' slide
	function get_active_slide()
	{
		$slide_query = query("SELECT * FROM slides WHERE slide_id = ( SELECT MAX(slide_id) FROM slides ) ");
		confirm($slide_query);
		
		while($row = fetch_array($slide_query)) 
		{				
			echo '		
					<div class="item active">
                        <img  src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["slide_image"]).'">
					</div>			
                 ';
		}	
	}	
	
    // takodje dohvata posljednje dodani slide, ali ovu funkciju koristimo u administraciji	
	function get_current_slide_in_admin()
	{
		$slide_query = query("SELECT * FROM slides WHERE slide_id = ( SELECT MAX(slide_id) FROM slides ) ");
		confirm($slide_query);
		
		while($row = fetch_array($slide_query)) 
		{				
			echo '		
					<div class="item active">
                        <img height= "300" width="800"  src="..'. DS . '..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["slide_image"]).'">
					</div>			
                 ';
		}	
	}	

	// funkcija za prikaz ''tackica za navigaciju'' na slideru
	function get_carousel_indicators()
	{
		$slide_query = query("SELECT count(*) num_slides FROM slides WHERE slide_id < ( SELECT MAX(slide_id) FROM slides ) ");
		confirm($slide_query);
		
	    echo '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';	
		while($row = fetch_array($slide_query)) 
		{		
			$num_slides = $row["num_slides"];
			$counter = 1;
			while ( $counter <=  $num_slides )
			{
			    echo '<li data-target="#carousel-example-generic" data-slide-to="'.$counter.'"></li>';
				$counter =  $counter + 1;
			}		
		}			
	}

	// funkcija za prikaz strelica <- i -> na slideru
    function get_left_right_arrows()
	{
	     echo '
				<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
				<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>		 
		      ';
	}
	
	// funkcija za prikaz svih dodanih slide-ova u vidu slicica ( u administraciji )
	// za svaki slide klikom na slicicu pozivamo delete_slide.php za brisanje slidea klikom na slicicu
	function get_slide_thumbnailes()
	{
		$slide_query = query("SELECT * FROM slides ORDER BY slide_id DESC ");
		confirm($slide_query);
		
 	     echo '<span class="label label-danger">Click a thumbnail to delete a slide</span> </br></br>';
			
		while($row = fetch_array($slide_query)) 
		{		

			echo '		
					<a  href="../../resources/templates/back/delete_slide.php?id='.htmlentities($row["slide_id"]).'">
						<img height="100" width="200" class="thumbnail_admin" src="..'. DS . '..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["slide_image"]).'">  
					</a>
                 ';
		}		
	}
	
	/* SLIDES ****************************************************************************************************************************************/		
?>