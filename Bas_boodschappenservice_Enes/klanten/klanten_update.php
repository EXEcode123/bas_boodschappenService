<!DOCTYPE html>
<html>
<body>
<h1>CRUD Klant</h1>
<h2>Wijzigen</h2>

<?php

    include_once '../classes/klanten.classes.php';
    $klant = new Klant;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $klant->updateKlant2($_POST['id'], $_POST['voornaam'], $_POST['achternaam'], $_POST['email'], $_POST['adres'], $_POST['postcode'], $_POST['woonplaats']);
        echo '<script>alert("Klant is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['klant_id'])){
        
        $row = $klant->getKlant($_GET['klant_id']);
    }
?>
	
<form method="post">
<input type='hidden' name='id' value='<?php echo $row["klant_id"];?>'>
<input type='text' name='voornaam' required value="<?php echo $row["klant_voornaam"];?>"> *</br>
<input type='text' name='achternaam' required value='<?php echo $row["klant_achternaam"];?>'> *</br>
<input type='email' name='email' required value="<?php echo $row["klant_email"];?>"> *</br>
<input type='text' name='adres' required value="<?php echo $row["klant_adres"];?>"> *</br>
<input type='text' name='postcode' required value="<?php echo $row["klant_postcode"];?>"> *</br>
<input type='text' name='woonplaats' required value="<?php echo $row["klant_woonplaats"];?>"> *</br></br>
<input type='submit' name='update' value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>



