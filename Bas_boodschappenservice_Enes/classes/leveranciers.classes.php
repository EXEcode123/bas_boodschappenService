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

class Lev extends Database{
	public $id; // column: lev_id
	public $naam; // column: lev_naam
	public $contact; // column: lev_contact
	public $email; // column: lev_email
	public $adres; // column: lev_adres
	public $postcode; // column: lev_postcode
	public $woonplaats;	// column: lev_woonplaats
	
	// Methods
	
	public function setObject($id, $naam, $contact, $email, $adres, $postcode, $woonplaats){
		//self::$conn = $db;
		$this->id = $id;
		$this->naam = $naam;
		$this->email = $email;
		$this->adres = $adres;
		$this->postcode = $postcode;
		$this->woonplaats = $woonplaats;
	}

		
	/**
	 * Summary of getLeveranciers
	 * @return mixed
	 */
	public function getLeveranciers(){
		// query: is een prepare en execute in 1 zonder placeholders
		$lijst = self::$conn->query("select * from 	leveranciers")->fetchAll();
		return $lijst;
	}

	// Get acteur
	public function getLeverancier($id){

		$sql = "select * from leveranciers where lev_id = '$id'";
		$query = self::$conn->prepare($sql);
		$query->execute();
		return $query->fetch();
	}
	
	public function dropDownLeverancier($row_selected = -1){
	
		// Haal alle leveranciers op uit de database mbv de method getLeveranciers()
		$lijst = $this->getLeveranciers();
		
		echo "<label for='Leveranciers'>Kies een leverancier:</label>";
		echo "<select name='leverancierId'>";
		foreach ($lijst as $row){
			if($row_selected == $row["lev_id"]){
				echo "<option value='$row[lev_id]' selected='selected'> $row[lev_naam] $row[lev_contact] $row[lev_email] $row[lev_adres] $row[lev_postcode] $row[lev_woonplaats]</option>\n";
			} else {
				echo "<option value='$row[lev_id]'> $row[lev_naam] $row[lev_contact] $row[lev_email] $row[lev_adres] $row[lev_postcode] $row[lev_woonplaats]</option>\n";
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
			$txt .=  "<td><p class='showtable_columns'>Id</p>" . $row["lev_id"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Naam</p>" . $row["lev_naam"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Contact</p>" . $row["lev_contact"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Email</p>" . $row["lev_email"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Adres</p>" . $row["lev_adres"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Postcode</p>" . $row["lev_postcode"] . "</td>";
			$txt .=  "<td><p class='showtable_columns'>Woonplaats</p>" . $row["lev_woonplaats"] . "</td>";
			
			//Update
			// Wijzig knopje
        	$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../leveranciers/leveranciers_update.php?lev_id=$row[lev_id]' >       
                <button name='update'>Wijzigen</button>	 
            </form> </td>";


			//Delete
			$txt .=  "<td>";
			$txt .= " 
            <form method='post' action='../leveranciers/leveranciers_delete.php?lev_id=$row[lev_id]' >       
                <button name='verwijderen'>Verwijderen</button>	 
            </form> </td>";	
			$txt .= "</tr>";
		}
		$txt .= "</table>";
		echo $txt;
	}

	// Delete leverancier
 /**
  * Summary of deleteLeverancier
  * @param mixed $nr
  * @return bool
  */
	public function deleteLeverancier($id){

		$sql = "delete from leveranciers where lev_id = '$id'";
		$stmt = self::$conn->prepare($sql);
		$stmt->execute();
      return ($stmt->rowCount() == 1) ? true : false;
	}

	public function updateLeverancier2($id, $naam, $contact, $email, $adres, $postcode, $woonplaats){

		$sql = "update leveranciers 
			set lev_naam = '$naam', lev_contact = '$contact', lev_email = '$email', lev_adres = '$adres', lev_postcode = '$postcode', lev_woonplaats = '$woonplaats' 
			WHERE lev_id = '$id'";

		$stmt = self::$conn->prepare($sql);
		$stmt->execute(); 
		return ($stmt->rowCount() == 1) ? true : false;				
	}
	
	public function updateLeverancierSanitized($id, $naam, $contact, $email, $adres, $postcode, $woonplaats){

		$sql = "update leveranciers 
			set lev_naam = :naam, lev_contact = :contact, lev_email = :email, lev_adres = :adres, lev_postcode = :postcode, lev_woonplaats = :woonplaats    
			WHERE lev_id = :id";
			
		// PDO sanitize automatisch in de prepare
		$stmt = self::$conn->prepare($sql);
		$stmt->execute([
			'naam' => $naam,
			'contact'=> $contact,
			'email'=> $email,
			'adres'=> $adres,
			'postcode'=> $postcode,
			'woonplaats'=> $woonplaats,
			'id'=> $id
		]);  
	}
	public function updateLeverancier(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		$sql = "update leveranciers 
			set lev_naam = :naam, lev_contact = :contact, lev_email = :email, lev_adres = :adres, lev_postcode = :postcode, lev_woonplaats = :woonplaats    
			WHERE lev_id = :id";

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
	$sql="SELECT MAX(lev_id)+1 FROM leveranciers";
	return  (int) self::$conn->query($sql)->fetchColumn();
}
	
	public function insertLeverancier(){
		// Voor deze functie moet eerst een setObject aangeroepen worden om $this te vullen
		
		//
		$this->id = $this->BepMaxNr();
		
		$sql = "INSERT INTO leveranciers (lev_id, lev_naam, lev_contact, lev_email, lev_adres, lev_postcode, lev_woonplaats)
		VALUES (:id, :naam, :contact, :email, :adres, :postcode, :woonplaats)";

		$stmt = self::$conn->prepare($sql);
		return $stmt->execute((array)$this);
			
	}
	
	/**
	 * Summary of insertActeur2
	 * @param mixed $naam
	 * @param mixed $contact
	 * @return void
	 */
	public function insertLeverancier2($naam, $contact, $email, $adres, $postcode, $woonplaats){
		
		// query
		$nr = $this->BepMaxNr();
		$sql = "INSERT INTO leveranciers (lev_id, lev_naam, lev_contact, lev_email, lev_adres, lev_postcode, lev_woonplaats)
		VALUES (:id, :naam, :contact, :email, :adres, :postcode, :woonplaats)";
		
		// Prepare
		$stmt = self::$conn->prepare($sql);
		
		// Execute
		$stmt->execute([
			'naam'=>$naam,
			'contact'=>$contact,
			'email'=>$email,
			'adres'=>$adres,
			'postcode'=>$postcode,
			'woonplaats'=>$woonplaats,
			'id'=>$id
		]);			
	}
}
?>
</body>
</html>