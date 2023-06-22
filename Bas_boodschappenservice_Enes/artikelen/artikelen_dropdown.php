<html>
<body>
<h1>Dropdown Artikel</h1>

<?php
include "classes/artikelen.classes.php";

// Maak een object Artikel
$artikel = new Artikel;
 
?>

<form method='post'>
	<?php
		isset($_POST['kies-btn']) ? $id=$_POST['artId'] : $id=-1;
		$artikel->dropDownArtikel($id);
	?>
	<br>
	<input type='submit' name='kies-btn' value='Kies'></input>
</form>	

<?php

if (isset($_POST['kies-btn'])){
	$artikel->id = $_POST['artikelId'];
	$row = $artikel->getArtikel();
	
	echo "Gekozen waarde: id: $_POST[ArtikelId] $row[oms] $row[ink] $row[verk] $row[voor] $row[minVoor] $row[maxVoor] $row[loc] $row[levId]"; 
}
?>

</body>
</html>

