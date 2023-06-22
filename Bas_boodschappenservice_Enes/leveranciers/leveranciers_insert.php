<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once '../classes/leveranciers.classes.php';
		
		$lev = new Lev;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$lev->insertLeverancier2($_POST['naam'], $_POST['contact'], $_POST['email'], $_POST['adres'], $_POST['postcode'], $_POST['woonplaats']);
			
		echo "<script>alert('Leverancier: $_POST[naam] $_POST[contact] $_POST[email] $_POST[adres] $_POST[postcode] $_POST[woonplaats] is toegevoegd')</script>";
		echo "<script> location.replace('../index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Hoofdmenu Leveranciers</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="naam">Bedrijf naam:</label>
   <input type="text" id="naam" name="naam" placeholder="Naam..." required/>
   <br>   
   <label for="contact">Contact persoon:</label>
   <input type="text" id="contact" name="contact" placeholder="Naam en achternaam..." required/>
   <br>
   <label for="email">Email:</label>
   <input type="email" id="email" name="email" placeholder="Email..." required/>
   <br>
   <label for="adres">Adres:</label>
   <input type="text" id="adres" name="adres" placeholder="Adres..." required/>
   <br>
   <label for="postcode">postcode:</label>
   <input type="text" id="postcode" name="postcode" placeholder="Postcode..." required/>
   <br>
   <label for="woonplaats">woonplaats:</label>
   <input type="text" id="woonplaats" name="woonplaats" placeholder="Woonplaats..." required/>        
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='../index.php'>Terug</a>

</body>
</html>



