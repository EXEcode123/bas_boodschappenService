<!DOCTYPE html>
<html>
<body>
<h1>Leverancier updaten</h1>

<?php

    include_once '../classes/leveranciers.classes.php';
    $lev = new Lev;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $lev->updateLeverancier2($_POST['id'], $_POST['naam'], $_POST['contact'], $_POST['email'], $_POST['adres'], $_POST['postcode'], $_POST['woonplaats']);
        echo '<script>alert("Leverancier is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['lev_id'])){
        
        $row = $lev->getLeverancier($_GET['lev_id']);
    }
?>
	
<form method="post">
<input type='hidden' name='id' value='<?php echo $row["lev_id"];?>'><br><br>
<label for="naam">Naam:</label><br>
<input type='text' name='naam' id="naam" required value="<?php echo $row["lev_naam"];?>"> *</br><br>
<label for="contact">Contact persoon</label><br>
<input type='text' name='contact' id="contact" required value='<?php echo $row["lev_contact"];?>'> *</br><br>
<label for="email"></label><br>
<input type='email' name='email' id="email" required value="<?php echo $row["lev_email"];?>"> *</br><br>
<label for="adres"></label><br>
<input type='text' name='adres' id="adres" required value="<?php echo $row["lev_adres"];?>"> *</br><br>
<label for="postcode"></label><br>
<input type='text' name='postcode' id="postcode" required value="<?php echo $row["lev_postcode"];?>"> *</br><br>
<label for="woonplaats"></label><br>
<input type='text' name='woonplaats' id="woonplaats" required value="<?php echo $row["lev_woonplaats"];?>"> *</br></br>
<input type='submit' name='update' value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>



