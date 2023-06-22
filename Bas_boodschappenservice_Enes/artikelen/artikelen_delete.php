<?php 

if(isset($_POST["verwijderen"])){
	include '../classes/artikelen.classes.php';
	
	// Maak een object Artikel
	$artikel = new Artikel;
	
	// Delete Acteur op basis van id
	$artikel->deleteArtikel($_GET["id"]);
	echo '<script>alert("Artikel verwijderd")</script>';
	echo "<script> location.replace('../index.php'); </script>";
}
?>



