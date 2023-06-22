<html>
<!--
	Auteur: R. Wigmans
	Function: home page CRUD Acteur
-->

<body>
	<h1>Inkooporders</h1>
	<nav>
		<a href='inkooporders_insert.php'>Toevoegen nieuwe inkooporder</a>
	</nav>
	
<?php

// De classe definitie
include_once "../classes/inkooporders.classes.php";
//$conn = dbConnect();

// Maak een object Klant
$inkOrd = new InkOrd;

// Haal alle klanten op uit de database mbv de method getActeurs()
$lijst = $inkOrd->getInkooporders();

// Print een HTML tabel van de lijst	
$inkOrd->showTable($lijst);
?>
</body>
</html>