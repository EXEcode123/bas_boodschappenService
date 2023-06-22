<?php 

if(isset($_POST["verwijderen"])){
	include '../classes/inkooporders.classes.php';
	
	// Maak een object inkord
	$inkord = new Inkord;
	
	// Delete inkord op basis van NR
	$inkord->deleteInkooporder($_GET["inkord_id"]);
	echo '<script>alert("Inkooporder verwijderd")</script>';
	echo "<script> location.replace('../index.php'); </script>";
}
?>



