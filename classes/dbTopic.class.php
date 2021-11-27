<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

// Klass för hanteringen av topic i databasen
class dbTopic { 

	public $dbservername = "studentmysql.miun.se";
    public $dbname = "anwa1114";
    public $dbusername = "anwa1114";
    public $dbpassword = "x6e7xcml";

    function __construct(){

    }

	function addTopic(string $subCatId, string $userid, string $name) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO topic (SubCatId, UserId, Name) 
									VALUES (:subcatid, :userid, :name)');
			$stmt->bindParam(':subcatid', $subCatId);
			$stmt->bindParam(':userid', $userid);
			$stmt->bindParam(':name', $name);

			// Insert row
			$stmt->execute();
			$conn = NULL;

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
	function deleteTopic($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$stmt = $conn->prepare("DELETE FROM topic WHERE ID = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
	
			$conn = NULL;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

	function getTopics($subCatId) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM topic WHERE SubCatId = '$subCatId'");
			$conn = NULL;
			return $stmt;
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getTopic($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM topic WHERE ID = '$id'");
			$conn = NULL;
			return $stmt;
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getTopicId($name) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM topic WHERE Name = '$name'");
			$conn = NULL;
			return $stmt;
		} catch(PDOException $e){
			echo $e->getMessage();
		}
	}


}
?>