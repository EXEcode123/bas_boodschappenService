<html>
<body>
<h1>Dropdown Klant</h1>

<?php
include "../classes/klanten.classes.php";

// Maak een object Acteur
$klant = new Klant;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $id=$_POST['klantId'] : $id=-1;
		$klant->dropDownKlant($id);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$klant->id = $_POST['klantId'];
	$row = $klant->getKlant();
	
	echo "Gekozen waarde: id: $_POST[klantId] $row[klant_voornaam] $row[klant_achternaam] $row[klant_email] $row[klant_adres] $row[klant_postcode] $row[klant_woonplaats]"; 
}
?>

</body>
</html>

