<!DOCTYPE html>
<html>
<body>
<h1>CRUD Artikel</h1>
<h2>Wijzigen</h2>

<?php

    include_once '../classes/artikelen.classes.php';
    $artikel = new Artikel;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $artikel->updateArtikel2($_POST['id'], $_POST['oms'], $_POST['ink'], $_POST['verk'], $_POST['voor'], $_POST['minVoor'], $_POST['maxVoor'], $_POST['loc'], $_POST['levId']);
        echo '<script>alert("Artikel is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['art_id'])){
        
        $row = $artikel->getArtikel($_GET['art_id']);
    }
?>
	
<form method="post">
<input type='hidden' name='id' value='<?php echo $row["art_id"];?>'>
<label for="oms">Omschrijving:</label><br>
<input type='text' name='oms' required value="<?php echo $row["art_oms"];?>"> *</br><br>
<label for="ink">Inkoopprijs:</label><br>
<input type='text' name='ink' required value='<?php echo $row["art_ink"];?>'> *</br><br>
<label for="verk">Verkoopprijs:</label><br>
<input type='text' name='verk' required value="<?php echo $row["art_verk"];?>"> *</br><br>
<label for="voor">Hoeveelheid op voorraad:</label><br>
<input type='text' name='voor' required value="<?php echo $row["art_voor"];?>"> *</br><br>
<label for="minVoor">Minimum op voorraad:</label><br>
<input type='text' name='minVoor' required value="<?php echo $row["art_min_voor"];?>"> *</br><br>
<label for="maxVoor">Maximum op voorraad</label><br>
<input type='text' name='maxVoor' required value="<?php echo $row["art_max_voor"];?>"> *</br><br>
<label for="loc">Locatie:</label><br>
<input type='text' name='loc' required value="<?php echo $row["art_loc"];?>"> *</br><br>
<label for="levId">LeverancierId:</label><br>
<input type='text' name='levId' required value="<?php echo $row["lev_id"];?>"> *</br></br>
<input type='submit' name='update' value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>


