<!DOCTYPE html>
<html>
<body>
<h1>CRUD Verkooporder</h1>
<h2>Wijzigen</h2>

<?php

    include_once '../classes/verkooporders.classes.php';
    $verkord = new verkord;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $verkord->updateVerkooporder2($_POST['id'], $_POST['klantId'], $_POST['artId'], $_POST['verkordDatum'], $_POST['verkordBestAant'], $_POST['verkordStatus']);
        echo '<script>alert("Verkooporder is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['verkord_id'])){
        
        $row = $verkord->getVerkooporder($_GET['verkord_id']);
    }
?>
	
<form method="post">
<label for="id">Verkooporder id:</label>
<input type='hidden' name='id' value='<?php echo $row["verkord_id"];?>'>
<label for="klantId">Klant id:</label><br>
<input type='number' name='klantId' required value="<?php echo $row["klant_id"];?>"> *</br><br>
<label for="artId">Artikel id</label><br>
<input type='number' name='artId' required value='<?php echo $row["art_id"];?>'> *</br><br>
<label for="verkordDatum">Verkooporder bestel datum:</label><br>
<input type='date' name='verkordDatum' required value="<?php echo $row["verkord_datum"];?>"> *</br><br>
<label for="verkordBestAant">Verkooporder bestel aantal:</label><br>
<input type='number' name='verkordBestAant' required value="<?php echo $row["verkord_best_aant"];?>"> *</br><br>
<label for="verkordStatus">Verkooporder status:</label><br>
<input type='number' name='verkordStatus' required value="<?php echo $row["verkord_status"];?>"> *</br></br>
<input type='submit' name='update' value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>



