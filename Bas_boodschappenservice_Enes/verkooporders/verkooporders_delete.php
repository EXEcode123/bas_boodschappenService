<?php 

if(isset($_POST["verwijderen"])){
	include '../classes/verkooporders.classes.php';
	
	// Maak een object Verkooporder
	$verkord = new Verkord;
	
	// Delete Verkooporder op basis van NR
	$verkord->deleteVerkooporder($_GET["verkord_id"]);
	echo '<script>alert("Verkooporder verwijderd")</script>';
	echo "<script> location.replace('../index.php'); </script>";
}
?>



