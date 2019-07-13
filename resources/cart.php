<?php require_once("config.php"); ?>      <!-- konekcija na bazu i funkcije -->

<?php

	// ADD (Add to cart , i + ) // funkcionalnost za dodavanje producta u korpu, i povecanje kolicine producta
	if(isset($_GET['add']))
	{
	
	    // kada se klikne na 'Add to cart', proslijedi se varojabla 'add' koja preuzme vrijednost product_id-a
		// dohvatamo onaj product iz tabele producata koji ima id koji je jednak varijabli add (jer je add = product_id kad se klikne 'Add to cart'
		// ovo radim jer mi treba kolicina producta na koji je kliknuto
		$query = query("SELECT * FROM products WHERE product_id = " . escape_string($_GET['add']). " ");		
		confirm($query);

		while($row = fetch_array($query)) 
		{
		    // ADD (plus)
			// svaki put kada se klikne 'Add to cart' dugme nekog producta, kreira se SESIJSKA VARIJABLA SA NAZIVOM 'product_' + id producta
			// pa to izgleda ovako : 
			// product_1 (ako je id producta = 1
			// product_20 (ako je id producta = 20
			// . . . 
			// product_n (ako je id producta = n
			// PO DEFAULTU, VRIJEDNOST SESIJSKE VARIJABLE JE 0 JER NE POSTOJI JOS UVIJEK 
			// nakon prvog klika, VRIJEDNOST SESIJSKE VARIJABLE postaje 1, jer time kreiramo varijablu (i ubacujemo product u cart
			// ---------
			// svakim sljedecim klikom na isti proizvod, povecava se $_SESSION['product_1'] za 1
			// kada $_SESSION['product_1'] postane jednak (=) kolicini proizvoda ( product_quantity u tabeli ) 
			// tada vise nema dodavanja jer nemamo toliko producta u skladistu
			// ---------
			// ova ista metoda će se koristiti i kad se klikne na '+' u CHECKOUT-u
			
		    if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) 
		    {
				$_SESSION['product_' . $_GET['add']]+=1;    // povecavamo za 1 svaki put kad se klikne '*' ili 'Add to cart' ali to radimo sve dok je 
				                                            // kolicina producta koju korisnik zeli <= od kolicine producta koju imamo u bazi
				
				redirect("../public/checkout.php");         // reload checkout.php
			} 
			else 
			{
				set_message("We only only let you purchase " . $row['product_quantity'] . " items of this product because that's all we have in stock!");
				redirect("../public/checkout.php");         // reload checkout.php

			}			
	    }		
	} // kraj ADD metode
	
	
	
	// REMOVE (minus) // funkcionalnost sa smanjeje količine (quantity) produkta iz korpe
	if(isset($_GET['remove'])) 
	{
		$_SESSION['product_' . $_GET['remove']]--;    // smanjujemo sesijsku varijablu za 1

		if($_SESSION['product_' . $_GET['remove']] < 1)
		{
		  unset($_SESSION['item_total']);             // vracamo na 0 ako smo pomocu '-' sve proizvode izbacili iz cart-a
		  unset($_SESSION['item_quantity']);          // vracamo na 0 ako smo pomocu '-' sve proizvode izbacili iz cart-a
		  redirect("../public/checkout.php");
		} 
		else 
		{
		  redirect("../public/checkout.php");
		}
	}   // kraj MINUS metode

	
	
	
	// DELETE // funkcionalnost za izbacivanje produkta s liste
	if(isset($_GET['delete'])) 
	{ 
		$_SESSION['product_' . $_GET['delete']] = '0';    // setujemo na 0 i time uklanjamo s liste
		unset($_SESSION['item_total']);                   // vracamo na 0 ako smo pomocu 'X' sve proizvode izbacili iz cart-a
		unset($_SESSION['item_quantity']);                // vracamo na 0 ako smo pomocu 'X' sve proizvode izbacili iz cart-a

		redirect("../public/checkout.php");
		
	}   // kraj DELETE metode
	
	
	
	
	
	
	// F-JA KOJA PRIKAZUJE NA FRONTU (u checkout-u) sve producte koje je korisnik poslao u korpu tj. cart
	// svaki put kada se klikne 'Add to cart', kreira se SESIJSKA VARIJABLA SA NAZIVOM 'product_' + id producta
	// pa to izgleda ovako : 
	// product_1 (ako je id producta = 1
	// product_20 (ako je id producta = 20
	// . . . 
	// product_n (ako je id producta = n
	function cart()
	{
	    $total = 0;
		$item_quantity = 0;
		
		// paypal variables
		$item_name    = 1;
		$item_number  = 1;
		$amount       = 1;
		$quantity     = 1;
		

					// ovaj foreach je primjer kako se 'prate' sve SESIJSKE VARIJABLE
					// i pomocu ovog foreacha pratim kako se mijenjaju vrijednosti sesijskih varijabli
					// oviso o mojim akcijama ( +, - ili x ) 
					// $name ---> ime sesijske varijable
					// $value --> vrijednost sesijske varijable
					
					/*
					ime        vrijednost
					product_21=1
					product_22=2
					product_23=2
					product_20=1
					*/
					/* otkomentarisi ako zatreba ovaj foreach
					foreach ($_SESSION as $name => $value)
					{
						echo $name."=".$value."<br>";
					}
					*/
		
        // za svaku sesijsku varijablu cemo uraditi select i prikazati u korpi, samo treba izvaditi ID iz sesijske varijable, a to je sve iza product_
	    foreach ($_SESSION as $name => $value)               
		{
		    if( $value > 0 )   // '0' znaci da nije u korpi (cartu), >0 znaci da jeste --> 3 npr znaci da je product u korpi 3 puta
			{
				if(substr($name, 0, 8 ) == "product_")       // svi (sesijski varijeble) produkti pocinju sa 'product_'
				{
				
				    // product_id - product_ = id            // formula za izdvajanje id-a produkta iz sesijske varijable
				    $length = strlen($name - 8);             // duzinu id-a sesijske varijable dobijemo kad od cijelog naziva varijable oduzmemo 8 (product_)          
					$id     = substr($name, 8, $length);     // izdvajamo ID produkta iz naziva sesijske varijable
					 
					 
					// ovo je sql upit kojeg zelimo izvrsiti na nasoj bazi, za id produkta izvucenog iz sesijske varijable
					// drugim rijecima, selectujemo samo one producte na koje je korisnik kliknuo (poslao u korpu)
					$query = "SELECT * FROM products WHERE product_id = " . escape_string($id). " ";    

					// koristimo funkciju query() iz functions.php kojoj predajemo sql upit
					$run_query = query($query);      

					// koristimo funkciju confirm() iz functions.php koja provjerava da li je sve proslo ok sa upitom			
					confirm($run_query);  

					while($row = fetch_array($run_query)) 		
					{
					
					    $sub = $row["product_price"] * $value;
						$item_quantity += $value;
											
					    // prikazujemo product u korpi (cartu) 
						// svaki proizvod ima tri operacije : +,- i x
						echo '
							<tr>
								<td>'.htmlentities($row["product_quantity"]).'</td>
								<td>'.htmlentities($row["product_title"]).'<br>
									<img width="100" src="..'. DS . 'resources'. DS . 'uploads'. DS . ''.htmlentities($row["product_image"]).'">
								</td>
								<td>&#36;'.htmlentities($row["product_price"]).'</td>								
								<td>'.$value.'</td>
								<td>&#36;'.$sub.'</td>
								<td>
									<a class="btn btn-primary" href="../resources/cart.php?remove='.htmlentities($row["product_id"]).'">
										<span class="glyphicon glyphicon-minus"></span>
									</a>   
									<a class="btn btn-success" href="../resources/cart.php?add='.htmlentities($row["product_id"]).'">
										<span class="glyphicon glyphicon-plus"></span>
									</a>
									<a class="btn btn-danger" href="../resources/cart.php?delete='.htmlentities($row["product_id"]).'">
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>         
							</tr>		
						';		
                     
					echo '
						<input type="hidden" name="item_name_'.htmlentities($item_name).'" value="'.htmlentities($row["product_title"]).'">
						<input type="hidden" name="item_number_'.htmlentities($item_number).'" value="'.htmlentities($row["product_id"]).'">
						<input type="hidden" name="amount_'.htmlentities($amount).'" value="'.htmlentities($row["product_price"]).'">
						<input type="hidden" name="quantity_'.htmlentities($quantity).'" value="'.$value.'">
						'; // paypal
						
						// paypal variables // po defaultu, postavljene na 1 // povecavamo za jedan
						$item_name++;
						$item_number++;
						$amount++;
						$quantity++;
					}		
					// ukupna suma koju user treba da plati je $total
					// a to dobijemo ako sumu uvećamo za iznos od $sub za svaki product
					$_SESSION['item_total'] = $total += $sub;   					
					$_SESSION['item_quantity'] = $item_quantity; 
				}		
			}
		}		
	}

	// funkcija za prikaz PAYPAL dugmeta za placanje
	function show_paypal() 
	{
		if(isset($_SESSION['item_quantity']) && $_SESSION['item_quantity'] >= 1) 
		{
			echo '<input type="image" name="upload" border="0"
									src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
									alt="PayPal - The safer, easier way to pay online">';
		}
	}

    // funkcija koju koristi page phank_you.php
	// thank_you.php je stranicu na koju nas vraca paypal nakon obradjene transakcije
	// i putem GET metode dobijamo amt(amount), cc(currency), tx(transaction) i st(status)
	function process_transaction() 
	{
		if(isset($_GET['tx'])) // ovo se setuje od strane paypal-a poslije obrade transakcije
		{
			$amount = $_GET['amt'];
			$currency = $_GET['cc'];
			$transaction = $_GET['tx'];
			$status = $_GET['st'];
			$total = 0;
			$item_quantity = 0;

			foreach ($_SESSION as $name => $value) // isto kao u cart() funkciji, sve sto radimo radimo zasve producte koji su u cart-u putem SESIJSKIH ARIJABLI
			{
				if($value > 0 ) // isto kao u cart() funkciji  // '0' znaci da nije u korpi (cartu), >0 znaci da jeste --> 3 npr znaci da je product u korpi 3 puta
				{
					if(substr($name, 0, 8 ) == "product_")  // isto kao u cart() funkciji
					{
						$length = strlen($name - 8);        // isto kao u cart() funkciji
						$id = substr($name, 8 , $length);   // isto kao u cart() funkciji - ekstraktujemo ID producta iz SESIJSKE varijable

						// insertujemo transakciju u ORDERS tabelu
						$send_order = query("INSERT INTO orders (order_amount, order_transaction, order_currency, order_status ) VALUES('{$amount}', '{$transaction}','{$currency}','{$status}')");
						
						// provjeravamo da li je insert prosao OK
						confirm($send_order);
						
						// poslije inserta, dohvatamo ID insertovanog sloga
						$last_id =last_id();
						
						// dohvatamo iz baze product // i ovo se radi za svaki product za koji je kreirana SESIJSKA varijabla klikom na 'Add to cart' (foreach) 
						$query = query("SELECT * FROM products WHERE product_id = " . escape_string($id). " ");
						confirm($query);

						while($row = fetch_array($query)) 
						{
							$product_price = $row['product_price'];     // uzmemo cijenu
							$product_title = $row['product_title'];     // uzmemo naziv
							$item_quantity += $value;                   // broj producta koju je user naklikao (Add to cart ili '+')
							
							$sub = $row['product_price']*$value;        // sub = cijena producta * broj producta koju je user naklikao (Add to cart ili '+')

                            // insertujemo u tabelu reports
							$insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
							
							// provjeravamo da li je insert prosao OK
							confirm($insert_report);

						}

						// $total += $sub;           // ukupan iznos kojeg je korisnik platio
						// echo $item_quantity;      // ukupan broj producta koje je korisnik platio

				    }

				}
			 
			}

			session_destroy();    // unistavamo sesiju nakon sto nas paypal vrati na thank_you.php
		} 
		else 
		{
		    redirect("index.php");
		}
    }
	
?>