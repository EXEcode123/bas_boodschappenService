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

class Inkord extends Database{
	public $id;
	public $levId;
	public $artId;
	public $inkordDatum;
	public $inkordBestAant;
	public $inkordStatus;
	// Methods
	
	public function setObject($id, $levId, $artId, $inkordDatum, $inkordBestAant, $inkordStatus){
		//self::$conn = $db;
		$this->id = $id;
		$this->levId = $levId;
		$this->artId = $artId;
		$this->inkordDatum = $inkordDatum;
		$this->inkordBestAant = $inkordBestAant;
		$this->inkordStatus = $inkordStatus;
	}

		
	/**
	 * Summary of getActeurs
	 * @return mixed
	 */
	public function getInkooporders(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	inkooporders")->fetchAll();
		return $lijst;
	}

	// Get acteur
	public function getInkooporder($id){

		$sql = "select * from inkooporders where inkord_id = '$id'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownInkooporder($row_selected = -1){
	
		// Haal alle acteurs op uit de database mbv de method getinkooporders()
		$lijst = $this->getInkooporders();
		
		echo "<label for='Inkooporders'>Kies een inkooporder:</label>";
		echo "<select name='inkordId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["inkord_id"]){
				echo "<option value='$row[inkord_id]' selected='selected'> $row[lev_id] $row[art_id] $row[inkord_datum] $row[inkord_best_aant] $row[inkord_status] </option>\n";
			} else {
				echo "<option value='$row[inkord_id]'> $row[lev_id] $row[art_id] $row[inkord_datum] $row[inkord_best_aant] $row[inkord_status]</option>\n";
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
			$txt .=  "<td><p class='showtable_columns'>id</p>" . $row["inkord_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Leverancier id</p>" . $row["lev_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Artikel id</p>" . $row["art_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Datum</p>" . $row["inkord_datum"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Bestel aantal</p>" . $row["inkord_best_aant"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Status</p>" . $row["inkord_status"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../inkooporders/inkooporders_update.php?inkord_id=$row[inkord_id]' >       
                <button name='update'>Wijzigen</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../inkooporders/inkooporders_delete.php?inkord_id=$row[inkord_id]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete inkooporder
 /**
  * Summary of deleteInkooporder
  * @param mixed $nr
  * @return bool
  */
	public function deleteInkooporder($id){

		$sql = "delete from inkooporders where inkord_id = '$id'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateInkooporder2($id, $levId, $artId, $inkordDatum, $inkordBestAant, $inkordStatus){

		$sql = "update inkooporders 
			set lev_id = '$levId', art_id = '$artId', inkord_datum = '$inkordDatum', inkord_best_aant = '$inkordBestAant', inkord_status = '$inkordStatus' 
			WHERE inkord_id = '$id'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateInkooporderSanitized($id, $levId, $artId, $inkordDatum, $inkordBestAant, $inkordStatus){

		$sql = "update inkooporders
			set lev_id = :levId, art_id = :artId, inkord_datum = :inkordDatum, inkord_best_aant = :inkordBestAant, inkord_status = :inkordStatus   
			WHERE inkord_id = :id";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'levId' => $levId,
			'artId'=> $artId,
			'inkordDatum'=> $eminkordDatumail,
			'inkordBestAant'=> $inkordBestAant,
			'inkordStatus'=> $inkordStatus,
			'id'=> $id
		]);  
	}
	public function updateInkooporder(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update inkooporders 
			set lev_id = :levId, art_id = :artId, inkord_datum = :inkordDatum, inkord_best_aant = :inkordBestAant, inkord_status = :inkordStatus    
			WHERE inkord_id = :id";

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
	$sql="SELECT MAX(inkord_id)+1 FROM inkooporders";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertInkooporder(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->id = $this->BepMaxNr();
		
		$sql = "INSERT INTO inkooporders (inkord_id, lev_id, art_id, inkord_datum, inkord_best_aant, inkord_status)
		VALUES (:id, :levId, :artId, :inkordDatum, :inkordBestAant, :inkordStatus)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertActeur2
	 * @param mixed $voornaam
	 * @param mixed $achternaam
	 * @return void
	 */
	public function insertInkooporder2($levId, $artId, $inkordDatum, $inkordBestAant, $inkordStatus){
		
		// query
		$nr = $this->BepMaxNr();
		$sql = "INSERT INTO inkooporders (inkord_id, lev_id, art_id, inkord_datum, inkord_best_aant, inkord_status)
		VALUES (:id, :levId, :artId, :inkordDatum, :inkordBestAant, :inkordStatus)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'levId'=>$levId,
			'artId'=>$artId,
			'inkordDatum'=>$inkordDatum,
			'inkordBestAant'=>$inkordBestAant,
			'inkordStatus'=>$inkordStatus,
			'id'=>$id
		]);			
	}
}
?>
</body>
</html>