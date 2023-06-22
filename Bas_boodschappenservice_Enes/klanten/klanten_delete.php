<?php 

if(isset($_POST["verwijderen"])){
	include '../classes/klanten.classes.php';
	
	// Maak een object Acteur
	$klant = new Klant;
	
	// Delete Acteur op basis van NR
	$klant->deleteKlant($_GET["klant_id"]);
	echo '<script>alert("Klant verwijderd")</script>';
	echo "<script> location.replace('../index.php'); </script>";
}
?>



