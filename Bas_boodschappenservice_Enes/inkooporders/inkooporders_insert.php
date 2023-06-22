<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once '../classes/inkooporders.classes.php';
		
		$inkord = new Inkord;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$inkord->insertInkooporder2($_POST['levId'], $_POST['artId'], $_POST['inkordDatum'], $_POST['inkordBestAant'], $_POST['inkordStatus']);
			
		echo "<script>alert('Inkooporder: $_POST[levId] $_POST[artId] $_POST[inkordDatum] $_POST[inkordBestAant] $_POST[inkordStatus] is toegevoegd')</script>";
		echo "<script> location.replace('../index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Hoofdmenu klanten</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="levId">Leverancier id:</label>
   <input type="number" id="levId" name="levId" placeholder="id..." required/>
   <br>   
   <label for="artId">Artikel id:</label>
   <input type="number" id="artId" name="artId" placeholder="id..." required/>
   <br>
   <label for="inkordDatum">Inkooporder datum:</label>
   <input type="date" id="inkordDatum" name="inkordDatum" placeholder="Datum..." required/>
   <br>
   <label for="inkordBestAant">Inkooporder bestel aantal:</label>
   <input type="number" id="inkordBestAant" name="inkordBestAant" placeholder="Aantal..." required/>
   <br>
   <label for="inkordStatus">Inkooporder status:</label>
   <input type="number" id="inkordStatus" name="inkordStatus" placeholder="Status..." required/>
   <br><br>
    <input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='../index.php'>Terug</a>

</body>
</html>



