<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once '../classes/klanten.classes.php';
		
		$klant = new Klant;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$klant->insertKlant2($_POST['voornaam'], $_POST['achternaam'], $_POST['email'], $_POST['adres'], $_POST['postcode'], $_POST['woonplaats']);
			
		echo "<script>alert('Klant: $_POST[voornaam] $_POST[achternaam] $_POST[email] $_POST[adres] $_POST[postcode] $_POST[woonplaats] is toegevoegd')</script>";
		echo "<script> location.replace('../index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Hoofdmenu klanten</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="voornaam">Voornaam:</label>
   <input type="text" id="nv" name="voornaam" placeholder="Voornaam..." required/>
   <br>   
   <label for="achternaam">Achternaam:</label>
   <input type="text" id="an" name="achternaam" placeholder="Achternaam..." required/>
   <br>
   <label for="email">email:</label>
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



