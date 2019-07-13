<?php
    
	ob_start();        // output buffering
	session_start();   // otvaranje sesije
	// session_destroy();   // ubijanje sesije
	
    // posto WINDOWS koristi \ a MAC /, definisemo DS  - zamjena za : directory separator tj. za / i \
       defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);

    // na ovaj nacin putem echo naredbe izbacujes na front PATH do foldera u kojem je dokument iz kojeg radis echo
    // echo __DIR__;  // --> REZULTAT : C:\xampp\htdocs\testpaypal\resources	   
    // na ovaj nacin putem echo naredbe izbacujes na front PATH do dokumenta iz kojeg radis echo
    // echo __FILE__; // --> REZULTAT : C:\xampp\htdocs\testpaypal\resources\config.php
	
   // definisemo zamjenu TEMPLATE_FRONT za putanju C:\xampp\htdocs\testpaypal\resources\templates\front
      defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . "templates"  . DS . "front");
   // echo TEMPLATE_FRONT; --> C:\xampp\htdocs\testpaypal\resources\templates/front   
   
   // definisemo zamjenu TEMPLATE_BACK za putanju C:\xampp\htdocs\testpaypal\resources\templates\front
      defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS ."templates"  . DS . "back");
   // echo TEMPLATE_BACK; --> C:\xampp\htdocs\testpaypal\resources\templates\back

   
   
      defined("UPLOAD_DIRECTORY") ? null : define("UPLOAD_DIRECTORY", __DIR__ . DS . "uploads");

		
		
    // parametri za konekciju na bazu
	    // host
		defined("DB_HOST") ? null : define("DB_HOST", "localhost");
        // user
		defined("DB_USER") ? null : define("DB_USER", "root");
        // password
		defined("DB_PASS") ? null : define("DB_PASS", "");
        // naziv baze
		defined("DB_NAME") ? null : define("DB_NAME", "paypal_shop");
    
	// konekcija na bazu
	$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	// omogucavamo da svaki put kada se konektujemo na bazu, imamo na raspolaganju
	// fajl u kojem cemo cuvati sve funkcije
    // u prevodu, svaki put kada koristimo config.php, imamo pristup i functions.php
	require_once("functions.php");
	
	require_once("cart.php");

?>