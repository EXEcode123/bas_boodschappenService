<html>
<!--
	Auteur: R. Wigmans
	Function: home page CRUD Acteur
-->

<body>
	<h1>Artikelen</h1>
	<nav>
		<a href='artikelen_insert.php'>Toevoegen nieuwe Artikel</a>
	</nav>
	
<?php

// De classe definitie
include_once "classes/artikelen.classes.php";
//$conn = dbConnect();

// Maak een object Artikel
$artikel = new Artikel;

// Haal alle artikelen op uit de database mbv de method getArtikelen()
$lijst = $artikel->getArtikelen();

// Print een HTML tabel van de lijst	
$artikel->showTable($lijst);
?>
</body>
</html>