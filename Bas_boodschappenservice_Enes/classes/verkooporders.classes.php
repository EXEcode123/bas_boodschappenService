<html>
<body>
	<style>
		.showtable_columns {
			color: black;
			font-weight: bold;
			font-size: 20px;
		}
	</style>
<?php

include_once 'database.php';

class Verkord extends Database{
	public $id;
	public $klantId;
	public $artId;
	public $verkordDatum;
	public $verkordBestAant;
	public $verkordStatus;
	// Methods
	
	public function setObject($id, $klantId, $artId, $verkordDatum, $verkordBestAant, $verkordStatus){
		//self::$conn = $db;
		$this->id = $id;
		$this->klantId = $klantId;
		$this->artId = $artId;
		$this->verkordDatum = $verkordDatum;
		$this->verkordBestAant = $verkordBestAant;
		$this->verkordStatus = $verkordStatus;
	}

		
	/**
	 * Summary of getActeurs
	 * @return mixed
	 */
	public function getVerkooporders(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	verkooporders")->fetchAll();
		return $lijst;
	}

	// Get acteur
	public function getVerkooporder($id){

		$sql = "select * from verkooporders where verkord_id = '$id'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownVerkooporder($row_selected = -1){
	
		// Haal alle acteurs op uit de database mbv de method getinkooporders()
		$lijst = $this->getVerkooporders();
		
		echo "<label for='Verkooporders'>Kies een verkooporder:</label>";
		echo "<select name='verkordId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["verkord_id"]){
				echo "<option value='$row[verkord_id]' selected='selected'> $row[klant_id] $row[art_id] $row[verkord_datum] $row[verkord_best_aant] $row[verkord_status] </option>\n";
			} else {
				echo "<option value='$row[verkord_id]'> $row[klant_id] $row[art_id] $row[verkord_datum] $row[verkord_best_aant] $row[verkord_status]</option>\n";
			}
		}
		echo "</select>";
	}

 /**
  * Summary of showTable
  * @param mixed $lijst
  * @return void
  */
	public function showTable($lijst){

		$txt = "<table border=1px>";
		foreach($lijst as $row){
			$txt .= "<tr>";
			$txt .=  "<td><p class='showtable_columns'>id</p>" . $row["verkord_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Klant id</p>" . $row["klant_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Artikel id</p>" . $row["art_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Datum</p>" . $row["verkord_datum"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Bestel aantal</p>" . $row["verkord_best_aant"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Status</p>" . $row["verkord_status"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../verkooporders/verkooporders_update.php?verkord_id=$row[verkord_id]' >       
                <button name='update'>Wijzigen</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../verkooporders/verkooporders_delete.php?verkord_id=$row[verkord_id]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete verkooporder
 /**
  * Summary of deleteVerkooporder
  * @param mixed $nr
  * @return bool
  */
	public function deleteVerkooporder($id){

		$sql = "delete from verkooporders where verkord_id = '$id'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateVerkooporder2($id, $klantId, $artId, $verkordDatum, $verkordBestAant, $verkordStatus){

		$sql = "update verkooporders 
			set klant_id = '$klantId', art_id = '$artId', verkord_datum = '$verkordDatum', verkord_best_aant = '$verkordBestAant', verkord_status = '$verkordStatus' 
			WHERE verkord_id = '$id'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateVerkooporderSanitized($id, $klantId, $artId, $verkordDatum, $verkordBestAant, $verkordStatus){

		$sql = "update verkooporders
			set klant_id = :klantId, art_id = :artId, verkord_datum = :verkordDatum, verkord_best_aant = :verkordBestAant, verkord_status = :verkordStatus   
			WHERE verkord_id = :id";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'klantId' => $klantId,
			'artId'=> $artId,
			'verkordDatum'=> $emverkordDatumail,
			'verkordBestAant'=> $verkordBestAant,
			'verkordStatus'=> $verkordStatus,
			'id'=> $id
		]);  
	}
	public function updateVerkooporder(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update verkooporders 
			set klant_id = :klantId, art_id = :artId, verkord_datum = :verkordDatum, verkord_best_aant = :verkordBestAant, verkord_status = :verkordStatus    
			WHERE verkord_id = :id";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute((array)$this);
		return ($stmt->rowCount() == 1) ? true : false;		
	}
	
	/**
	 * Summary of BepMaxNr
	 * @return int
	 */
	private function BepMaxNr() : int {
		
	// Bepaal uniek nummer
	$sql="SELECT MAX(verkord_id)+1 FROM verkooporders";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertVerkooporder(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->id = $this->BepMaxNr();
		
		$sql = "INSERT INTO verkooporders (verkord_id, klant_id, art_id, verkord_datum, verkord_best_aant, verkord_status)
		VALUES (:id, :klantId, :artId, :verkordDatum, :verkordBestAant, :verkordStatus)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertActeur2
	 * @param mixed $voornaam
	 * @param mixed $achternaam
	 * @return void
	 */
	public function insertVerkooporder2($klantId, $artId, $verkordDatum, $verkordBestAant, $verkordStatus){
		
		// query
		$nr = $this->BepMaxNr();
		$sql = "INSERT INTO verkooporders (verkord_id, klant_id, art_id, verkord_datum, verkord_best_aant, verkord_status)
		VALUES (:id, :klantId, :artId, :verkordDatum, :verkordBestAant, :verkordStatus)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'klantId'=>$klantId,
			'artId'=>$artId,
			'verkordDatum'=>$verkordDatum,
			'verkordBestAant'=>$verkordBestAant,
			'verkordStatus'=>$verkordStatus,
			'id'=>$id
		]);			
	}
}
?>
</body>
</html>
