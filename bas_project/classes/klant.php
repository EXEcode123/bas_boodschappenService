<?php 

include 'Database.php';

class Klant extends Database{

	public function insertKlant($naam, $mail, $adres, $postcode, $woonplaats){

        $sql = "INSERT INTO klanten (klantNaam, klantEmail, klantAdres, klantPostcode, klantWoonplaats) VALUES ('$naam', '$mail', '$adres', '$postcode', '$woonplaats')";

		$stmt = self::$conn->prepare($sql);

        $stmt->execute();

        return true;

	}

	public function selectKlant(){
		$lijst = self::$conn->query("select * from 	klanten")->fetchAll();
		return $lijst;
        
	}

	public function getKlanten(){

		$lijst = self::$conn->query("select * from 	klanten")->fetchAll();
		return $lijst;
	}

	public function getKlant($conn, $klant){

		$sql = "SELECT * FROM klanten WHERE klantnaam = '$klant'";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function getIds($conn){

		$sql = "SELECT klantId FROM klanten";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function getId($conn, $id){

		$sql = "SELECT * FROM klanten WHERE `klantId` = '$id'";

		$stmt = self::$conn->query($sql);

        $klanten = $stmt->fetchALL(PDO::FETCH_ASSOC);

   	   return $klanten;
	}

	public function deleteKlant($nr, $conn){

		try{
			$sql = "DELETE FROM `Klanten` WHERE `klantId` = '$nr'";
			$stmt = self::$conn->prepare($sql);
        	$stmt->execute();

        	echo '<script>alert("Klant verwijderd")</script>';

       	 	echo "<script> location.replace('selectKlant.php'); </script>";
   	 	} catch(Exception) {
   	 		echo '<script>alert("Er staat nog een verkooporder open onder deze klant")</script>';
   	 	}
 	}

	 public function showTable($lijst){
		
		
		echo "<table>";
		echo "<tr><th>ID</th><th>Naam</th><th>Email</th><th>Adres</th><th>Postcode</th><th>Woonplaats</th></tr>";
		foreach($lijst as $row) {
			
			
			echo "<tr>";
			echo "<td>" . $row["klantId"] . "</td>";
			echo "<td>" . $row["klantNaam"] . "</td>";
			echo "<td>" . $row["klantEmail"] . "</td>";
			echo "<td>" . $row["klantAdres"] . "</td>";
			echo "<td>" . $row["klantPostcode"] . "</td>";
			echo "<td>" . $row["klantWoonplaats"] . "</td>";
			echo "</tr>";
			
		
			
		}
		echo "</table>";
	}

}


?>