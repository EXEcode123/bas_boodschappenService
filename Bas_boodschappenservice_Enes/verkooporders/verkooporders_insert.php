<?php

if(isset($_POST["insert"]) && $_POST["insert"] == "Toevoegen"){
		
		include_once '../classes/verkooporders.classes.php';
		
		$verkord = new Verkord;
		//$acteur->setObject(0, $_POST['voornaam'], $_POST['achternaam']);
		//$acteur->insertActeur();
		$verkord->insertVerkooporder2($_POST['klantId'], $_POST['artId'], $_POST['verkordDatum'], $_POST['verkordBestAant'], $_POST['verkordStatus']);
			
		echo "<script>alert('Verkooporder: $_POST[klantId] $_POST[artId] $_POST[verkordDatum] $_POST[verkordBestAant] $_POST[verkordStatus] is toegevoegd')</script>";
		echo "<script> location.replace('../index.php'); </script>";
			
	} 

?>

<!DOCTYPE html>
<html>
<body>

	<h1>Hoofdmenu klanten</h1>
	<h2>Toevoegen</h2>
	<form method="post">
	<label for="klantId">Klant id:</label>
   <input type="number" id="klantId" name="klantId" placeholder="ID..." required/>
   <br>   
   <label for="artId">Artikel id:</label>
   <input type="number" id="artId" name="artId" placeholder="ID..." required/>
   <br>
   <label for="verkordDatum">verkooporder datum:</label>
   <input type="date" id="verkordDatum" name="verkordDatum" placeholder="Datum..." required/>
   <br>
   <label for="verkordBestAant">Verkooporder bestel aantal:</label>
   <input type="number" id="verkordBestAant" name="verkordBestAant" placeholder="Aantal..." required/>
   <br>
   <label for="verkordStatus">Verkooporder status:</label>
   <input type="number" id="verkordStatus" name="verkordStatus" placeholder="Status..." required/>  
   <br><br>
	<input type='submit' name='insert' value='Toevoegen'>
	</form></br>

	<a href='../index.php'>Terug</a>

</body>
</html>