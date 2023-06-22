<?php

include_once 'classes/database.php';

class Klant extends Database{
	public $id;
	public $voornaam;
	public $achternaam;
	public $email;
	public $adres;
	public $postcode;
	public $woonplaats;	
	
	// Methods
	
	public function setObject($id, $voornaam, $achternaam, $email, $adres, $postcode, $woonplaats){
		//self::$conn = $db;
		$this->id = $id;
		$this->voornaam = $voornaam;
		$this->achternaam = $achternaam;
		$this->email = $email;
		$this->adres = $adres;
		$this->postcode = $postcode;
		$this->woonplaats = $woonplaats;
	}

		
	/**
	 * Summary of getActeurs
	 * @return mixed
	 */
	public function getKlanten(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	klanten")->fetchAll();
		return $lijst;
	}

	// Get acteur
	public function getKlant($nr){

		$sql = "select * from klanten where klant_id = '$id'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownKlant($row_selected = -1){
	
		// Haal alle acteurs op uit de database mbv de method getKlanten()
		$lijst = $this->getKlanten();
		
		echo "<label for='Klanten'>Kies een klant:</label>";
		echo "<select name='klantId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["klant_id"]){
				echo "<option value='$row[klant_id]' selected='selected'> $row[klant_voornaam] $row[klant_achternaam] $row[klant_email] $row[klant_adres] $row[klant_postcode] $row[klant_woonplaats]</option>\n";
			} else {
				echo "<option value='$row[klant_id]'> $row[klant_voornaam] $row[klant_achternaam] $row[klant_email] $row[klant_adres] $row[klant_postcode] $row[klant_woonplaats]</option>\n";
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
			$txt .=  "<td>" . $row["klant_id"] . "</td>";
			$txt .=  "<td>" . $row["klant_voornaam"] . "</td>";
			$txt .=  "<td>" . $row["klant_achternaam"] . "</td>";
			$txt .=  "<td>" . $row["klant_email"] . "</td>";
			$txt .=  "<td>" . $row["klant_adres"] . "</td>";
			$txt .=  "<td>" . $row["klant_postcode"] . "</td>";
			$txt .=  "<td>" . $row["klant_woonplaats"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='update_klant.php?id=$row[klant_id]' >       
                <button name='update'>Wijzigen</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='klanten_delete.php?id=$row[klant_id]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete acteur
 /**
  * Summary of deleteKlant
  * @param mixed $nr
  * @return bool
  */
	public function deleteKlant($id){

		$sql = "delete from klanten where klant_id = '$id'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateKlant2($id, $voornaam, $achternaam, $email, $adres, $postcode, $woonplaats){

		$sql = "update klanten 
			set klant_voornaam = '$voornaam', klant_achternaam = '$achternaam', klant_email = '$email', klant_adres = '$adres', klant_postcode = '$postcode', klant_woonplaats = '$woonplaats' 
			WHERE klant_id = '$id'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateKlantSanitized($id, $voornaam, $achternaam, $email, $adres, $postcode, $woonplaats){

		$sql = "update klanten 
			set klant_voornaam = :voornaam, klant_achternaam = :achternaam, klant_email = :email, klant_adres = :adres, klant_postcode = :postcode, klant_woonplaats = :woonplaats    
			WHERE klant_id = :id";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'voornaam' => $voornaam,
			'achternaam'=> $achternaam,
			'email'=> $email,
			'adres'=> $adres,
			'postcode'=> $postcode,
			'woonplaats'=> $woonplaats,
			'id'=> $id
		]);  
	}
	public function updateKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update klanten 
			set klant_voornaam = :voornaam, klant_achternaam = :achternaam, klant_email = :email, klant_adres = :adres, klant_postcode = :postcode, klant_woonplaats = :woonplaats    
			WHERE klant_id = :id";

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
	$sql="SELECT MAX(klant_id)+1 FROM klanten";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertKlant(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->id = $this->BepMaxNr();
		
		$sql = "INSERT INTO klanten (klant_id, klant_voornaam, klant_achternaam, klant_email, klant_adres, klant_postcode, klant_woonplaats)
		VALUES (:id, :voornaam, :achternaam, :email, :adres, :postcode, :woonplaats)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertActeur2
	 * @param mixed $voornaam
	 * @param mixed $achternaam
	 * @return void
	 */
	public function insertKlant2($voornaam, $achternaam, $email, $adres, $postcode, $woonplaats){
		
		// query
		$nr = $this->BepMaxNr();
		$sql = "INSERT INTO klanten (klant_id, klant_voornaam, klant_achternaam, klant_email, klant_adres, klant_postcode, klant_woonplaats)
		VALUES (:id, :voornaam, :achternaam, :email, :adres, :postcode, :woonplaats)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'voornaam'=>$voornaam,
			'achternaam'=>$achternaam,
			'email'=>$email,
			'adres'=>$adres,
			'postcode'=>$postcode,
			'woonplaats'=>$woonplaats,
			'id'=>$id
		]);			
	}
}
?>