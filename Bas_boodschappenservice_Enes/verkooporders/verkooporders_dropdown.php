<html>
<body>
<h1>Dropdown Klant</h1>

<?php
include "../classes/verkooporders.classes.php";

// Maak een object Acteur
$verkord = new Verkord;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $id=$_POST['verkordId'] : $id=-1;
		$verkord->dropDownVerkooporder($id);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$verkord->id = $_POST['verkordId'];
	$row = $verkord->getVerkooporder();
	
	echo "Gekozen waarde: id: $_POST[verkordId] $row[klant_id] $row[art_id] $row[verkord_datum] $row[verkord_best_aant] $row[verkord_status]"; 
}
?>

</body>
</html>
