<html>
<!--
	Auteur: R. Wigmans
	Function: home page CRUD Acteur
-->

<body>
	<h1>Verkooporders</h1>
	<nav>
		<a href='verkooporders_insert.php'>Toevoegen nieuwe verkooporder</a>
	</nav>
	
<?php

// De classe definitie
include_once "../classes/verkooporders.classes.php";
//$conn = dbConnect();

// Maak een object Klant
$verkord = new Verkord;

// Haal alle klanten op uit de database mbv de method getActeurs()
$lijst = $verkord->getVerkooporders();

// Print een HTML tabel van de lijst	
$verkord->showTable($lijst);
?>
</body>
</html>