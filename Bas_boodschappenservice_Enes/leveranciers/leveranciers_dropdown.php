<html>
<body>
<h1>Dropdown Leverancier</h1>

<?php
include "../classes/leveranciers.classes.php";

// Maak een object Acteur
$lev = new Lev;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $id=$_POST['klantId'] : $id=-1;
		$lev->dropDownLeverancier($id);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$lev->id = $_POST['leverancierId'];
	$row = $lev->getLeverancier();
	
	echo "Gekozen waarde: id: $_POST[leverancierId] $row[lev_naam] $row[lev_contact] $row[lev_email] $row[lev_adres] $row[lev_postcode] $row[lev_woonplaats]"; 
}
?>

</body>
</html>

