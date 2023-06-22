<?php

include_once 'classes/database.php';

class Artikel extends Database{
	public $id;
	public $oms;
	public $ink;
	public $verk;
	public $voor;
	public $minVoor;	
	public $maxVoor;
	public $loc;
	public $levId;
	
	// Methods
	
	public function setObject($id, $oms, $ink, $verk, $voor, $minVoor, $maxVoor, $loc, $levId){
		//self::$conn = $db;
		$this->id = $id;
		$this->oms = $oms;
		$this->ink = $ink;
		$this->verk = $verk;
		$this->voor = $voor;
		$this->minVoor = $minVoor;
		$this->maxVoor = $maxVoor;
		$this->loc = $loc;
		$this->levId = $levId;
	}

		
	/**
	 * Summary of get
	 * @return mixed
	 */
	public function getArtikelen(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	artikelen")->fetchAll();
		return $lijst;
	}

	// Get artikel
	public function getArtikel($id){

		$sql = "select * from artikelen where art_id = '$id'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownArtikel($row_selected = -1){
	
		// Haal alle artikelen op uit de database mbv de method getArtikelen()
		$lijst = $this->getArtikelen();
		
		echo "<label for='Artikelen'>Kies een artikel:</label>";
		echo "<select name='ArtlId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["art_id"]){
				echo "<option value='$row[art_id]' selected='selected'> $row[art_oms] $row[art_ink] $row[art_verk] $row[art_voor] $row[art_min_voor] $row[art_max_voor] $row[art_loc] $row[lev_id]</option>\n";
			} else {
				echo "<option value='$row[art_id]'> $row[art_oms] $row[art_ink] $row[art_verk] $row[art_voor] $row[art_min_voor] $row[art_max_voor] $row[art_loc] $row[lev_id]</option>\n";
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
			$txt .=  "<td>" . $row["art_id"] . "</td>";
			$txt .=  "<td>" . $row["art_oms"] . "</td>";
			$txt .=  "<td>" . $row["art_ink"] . "</td>";
			$txt .=  "<td>" . $row["art_verk"] . "</td>";
			$txt .=  "<td>" . $row["art_voor"] . "</td>";
			$txt .=  "<td>" . $row["art_min_voor"] . "</td>";
			$txt .=  "<td>" . $row["art_max_voor"] . "</td>";
			$txt .=  "<td>" . $row["art_loc"] . "</td>";
			$txt .=  "<td>" . $row["lev_id"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='artikelen_update.php?art_id=$row[art_id]' >       
                <button name='update'>Wijzigen</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='artikelen_delete.php?art_id=$row[art_id]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete artikel
 /**
  * Summary of deleteArtikel
  * @param mixed $nr
  * @return bool
  */
	public function deleteArtikel($id){

		$sql = "delete from artikelen where art_id = '$id'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateArtikel2($id, $oms, $ink, $verk, $voor, $minVoor, $maxVoor, $loc, $levId){

		$sql = "update artikelen 
			set art_oms = '$oms', art_ink = '$ink', art_verk = '$verk', art_voor = '$voor', art_min_voor = '$minVoor', art_max_voor = '$maxVoor' 
			WHERE art_id = '$id'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateArtikelSanitized($id, $oms, $ink, $verk, $voor, $minVoor, $maxVoor, $loc, $levId){

		$sql = "update artikelen 
			set art_oms = :oms, art_ink = :ink, art_verk = :verk, art_voor = :voor, art_min_voor = :minVoor, art_max_voor = :maxVoor, art_loc = :loc, lev_id = :levId    
			WHERE art_id = :id";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'oms' => $oms,
			'ink'=> $ink,
			'verk'=> $verk,
			'voor'=> $voor,
			'minVoor'=> $minVoor,
			'maxVoor'=> $maxVoor,
			'loc'=> $loc,
			'levId'=> $levId,
			'id'=> $id
		]);  
	}
	public function updateArtikel(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update artikelen 
			set art_oms = :oms, art_ink = :ink, art_verk = :verk, art_voor = :voor, art_min_voor = :minVoor, art_max_voor = :maxVoor, art_loc = :loc, lev_id = :levId    
			WHERE art_id = :id";

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
	$sql="SELECT MAX(art_id)+1 FROM artikelen";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertArtikel(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->id = $this->BepMaxNr();
		
		$sql = "INSERT INTO artikelen (art_id, art_oms, art_ink, art_verk, art_voor, art_min_voor, art_max_voor, art_loc, lev_id)
		VALUES (:id, :oms, :ink, :verk, :voor, :minVoor, :maxVoor, :loc, :levId)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertArtikel2
	 * @param mixed $voornaam
	 * @param mixed $achternaam
	 * @return void
	 */
	public function insertArtikel2($oms, $ink, $verk, $voor, $minVoor, $maxVoor, $loc, $levId){
		
		// query
		$nr = $this->BepMaxNr();
		$sql = "INSERT INTO artikelen (art_id, art_oms, art_ink, art_verk, art_voor, art_min_voor, art_max_voor, art_loc, lev_id)
		VALUES (:id, :oms, :ink, :verk, :voor, :minVoor, :maxVoor, :loc, :levId)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'oms'=>$oms,
			'ink'=>$ink,
			'verk'=>$verk,
			'voor'=>$voor,
			'minVoor'=>$minVoor,
			'maxVoor'=>$maxVoor,
			'loc'=>$loc,
			'levId'=>$levId,
			'id'=>$id
		]);			
	}
}
?>