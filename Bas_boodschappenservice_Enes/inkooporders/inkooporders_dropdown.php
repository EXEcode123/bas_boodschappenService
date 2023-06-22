<html>
<body>
<h1>Dropdown Klant</h1>

<?php
include "../classes/klanten.classes.php";

// Maak een object inkord
$inkord = new Inkord;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $id=$_POST['klantId'] : $id=-1;
		$klant->dropDownInkooporder($id);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$klant->id = $_POST['inkordId'];
	$row = $klant->getKlant();
	
	echo "Gekozen waarde: id: $_POST[inkord_id] $row[lev_id] $row[art_id] $row[inkord_datum] $row[inkord_best_aant] $row[inkord_status]"; 
}
?>

</body>
</html>

