<?php 

if(isset($_POST["verwijderen"])){
	include '../classes/leveranciers.classes.php';
	
	// Maak een object Acteur
	$lev = new Lev;
	
	// Delete Acteur op basis van NR
	$lev->deleteLeverancier($_GET["lev_id"]);
	echo '<script>alert("Leverancier verwijderd")</script>';
	echo "<script> location.replace('../index.php'); </script>";
}
?>



