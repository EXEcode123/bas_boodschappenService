<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once 'classes/artikelen.classes.php';
		
		$artikel = new Artikel;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$artikel->insertArtikel2($_POST['oms'], $_POST['ink'], $_POST['verk'], $_POST['voor'], $_POST['minVoor'], $_POST['maxVoor'], $_POST['loc'], $_POST['levId']);
			
		echo "<script>alert('Klant: $_POST[oms] $_POST[ink] $_POST[verk] $_POST[voor] $_POST[minVoor] $_POST[maxVoor] $_POST[loc] $_POST[levId] is toegevoegd')</script>";
		echo "<script> location.replace('index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Hoofdmenu Artikelen</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="oms">Artikel omschrijving:</label>
   <input type="text" id="oms" name="oms" placeholder="Artikel omschrijving..." required/>
   <br>   
   <label for="ink">Artikel inkoop prijs:</label>
   <input type="text" id="ink" name="ink" placeholder="Prijs..." required/>
   <br>
   <label for="verk">Artikel verkoop prijs:</label>
   <input type="text" id="verk" name="verk" placeholder="Prijs..." required/>
   <br>
   <label for="voor">Artikel voorraad:</label>
   <input type="text" id="voor" name="voor" placeholder="Aantal..." required/>
   <br>
   <label for="minVoor">Minimum voorraad:</label>
   <input type="text" id="minVoor" name="minVoor" placeholder="Min voorraad..." required/>
   <br>
   <label for="maxVoor">Maximum voorraad:</label>
   <input type="text" id="maxVoor" name="maxVoor" placeholder="Max voorraad..." required/> 
   <br>
   <label for="loc">Artikel locatie:</label>
   <input type="text" id="loc" name="loc" placeholder="Artikel locatie..." required/>
   <br>
   <label for="levId">Leverancier id:</label>
   <input type="text" id="levId" name="levId" placeholder="Leverancier id..." required/>  
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='index.php'>Terug</a>

</body>
</html>



