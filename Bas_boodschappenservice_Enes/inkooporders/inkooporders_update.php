<!DOCTYPE html>
<html>
<body>
<h1>CRUD Inkooporder</h1>
<h2>Wijzigen</h2>

<?php

    include_once '../classes/inkooporders.classes.php';
    $inkord = new Inkord;

    if(isset($_POST["update"]) && $_POST["update"] == "Wijzigen"){

        $inkord->updateInkooporder2($_POST['id'], $_POST['levId'], $_POST['artId'], $_POST['inkordDatum'], $_POST['inkordBestAant'], $_POST['inkordStatus']);
        echo '<script>alert("Inkooporder is gewijzigd")</script>';
        
        // Toon weer het scherm
        //include "update_form.php";
    }

    if (isset($_GET['inkord_id'])){
        
        $row = $inkord->getInkooporder($_GET['inkord_id']);
    }
?>
	
<form method="post">
<input type='hidden' name='id' value='<?php echo $row["inkord_id"];?>'>
<input type='number' name='levId' required value="<?php echo $row["lev_id"];?>"> *</br>
<input type='number' name='artId' required value='<?php echo $row["art_id"];?>'> *</br>
<input type='date' name='inkordDatum' required value="<?php echo $row["inkord_datum"];?>"> *</br>
<input type='number' name='inkordBestAant' required value="<?php echo $row["inkord_best_aant"];?>"> *</br>
<input type='number' name='inkordStatus' required value="<?php echo $row["inkord_status"];?>"> *</br></br>
<input type='submit' name='update' value='Wijzigen'>

</form></br>

<a href='../index.php'>Terug</a>

</body>
</html>

