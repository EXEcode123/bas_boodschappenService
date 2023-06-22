<html>
<!--
	Auteur: R. Wigmans
	Function: home page CRUD Acteur
-->

<body>
	<h1>klanten</h1>
	<nav>
		<a href='klanten_insert.php'>Toevoegen nieuwe klant</a>
	</nav>
	
<?php

// De classe definitie
include_once "../classes/klanten.classes.php";
//$conn = dbConnect();

// Maak een object Klant
$klant = new Klant;

// Haal alle klanten op uit de database mbv de method getActeurs()
$lijst = $klant->getKlanten();

// Print een HTML tabel van de lijst	
$klant->showTable($lijst);
?>
</body>
</html>