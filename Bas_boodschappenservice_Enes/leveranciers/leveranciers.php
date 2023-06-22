<html>
<!--
	Auteur: R. Wigmans
	Function: home page CRUD Acteur
-->

<body>
	<h1>Leveranciers</h1>
	<nav>
		<a href='leveranciers_insert.php'>Toevoegen nieuwe leverancier</a>
	</nav>
	
<?php

// De classe definitie
include_once "../classes/leveranciers.classes.php";
//$conn = dbConnect();

// Maak een object Klant
$lev = new Lev;

// Haal alle klanten op uit de database mbv de method getActeurs()
$lijst = $lev->getLeveranciers();

// Print een HTML tabel van de lijst	
$lev->showTable($lijst);
?>
</body>
</html>