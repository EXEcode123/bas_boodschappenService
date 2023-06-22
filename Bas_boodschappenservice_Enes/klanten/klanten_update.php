<!DOCTYPE html>
<html>
<body>
    <!-- <link rel="stylesheet" href="../style.css"> -->
    <style>
        body {
            background-color: red;
        }

        h1 {
            color: white;
        }

        a {
            font-weight: bold;
            font-size: 30px;
            color: white;
            text-decoration: none;
        }

        #submit {
            box-shadow: 3px 3px;
        }

        #submit:active {
            box-shadow: 0px 0px;
        }

        a:hover {
            color: black;
        }

        label:hover {
            color: white;
        }
        
    </style>
<h1>Klant updaten</h1>


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
<label for="voornaam">Klant voornaam:</label><br>
<input type='text' name='voornaam' id="voornaam" required value="<?php echo $row["klant_voornaam"];?>"> *</br><br>
<label for="achternaam">Klant achternaam:</label><br>
<input type='text' name='achternaam' id="achternaam" required value='<?php echo $row["klant_achternaam"];?>'> *</br><br>
<label for="email">Klant email:</label><br>
<input type='email' name='email' id="email" required value="<?php echo $row["klant_email"];?>"> *</br><br>
<label for="adres">Klant adres:</label><br>
<input type='text' name='adres' id="adres" required value="<?php echo $row["klant_adres"];?>"> *</br><br>
<label for="postcode">Klant postcode:</label><br>
<input type='text' name='postcode' id="postcode" required value="<?php echo $row["klant_postcode"];?>"> *</br><br>
<label for="woonplaats">Klant woonplaats:</label><br>
<input type='text' name='woonplaats' id="woonplaats" required value="<?php echo $row["klant_woonplaats"];?>"> *</br></br>
<input type='submit' name='update' id="submit" value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>



