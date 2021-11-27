<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

// Klass för hanteringen av maincategory och subcategory i databasen
class dbCategory { 

	public $dbservername = "studentmysql.miun.se";
    public $dbname = "anwa1114";
    public $dbusername = "anwa1114";
    public $dbpassword = "x6e7xcml";

    function __construct(){

    }

	function getAllMainCategories() {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query('SELECT * FROM maincategory');
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getMainCategory($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM maincategory WHERE ID = $id");
			return $stmt;

			$conn = NULL;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function addMainCategory(string $name) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO maincategory (name) 
									VALUES (:name)');
			$stmt->bindParam(':name', $name);

			$stmt->execute();
			$conn = NULL;

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function deleteMainCategory($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$stmt = $conn->prepare("DELETE FROM maincategory WHERE ID = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
	
			$conn = NULL;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

	function getAllSubCategories() {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query('SELECT * FROM subcategory');
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function addSubCategory(string $name, string $desc, int $mainCatId) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO subcategory (name, description, maincatid) 
									VALUES (:name, :description, :maincatid)');
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':description', $desc);
			$stmt->bindParam(':maincatid', $mainCatId);

			$stmt->execute();
			$conn = NULL;

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function deleteSubCategory($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$stmt = $conn->prepare("DELETE FROM subcategory WHERE ID = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
	
			$conn = NULL;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}
}
?>