<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

// Klass för hanteringen av user i databasen
class dbUser { 

	public $dbservername = "studentmysql.miun.se";
    public $dbname = "anwa1114";
    public $dbusername = "anwa1114";
    public $dbpassword = "x6e7xcml";

    function __construct(){

    }

	function addUser(string $username, string $password) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO user (username, UserPassword, description, regdate) 
									VALUES (:username, :UserPassword, :description, :regdate)');
			$regDate = date("Y-m-d H:i");
			$description = "Denna användare har inte skrivit något om sig själv än";
			$stmt->bindParam(':username', $username);
			$stmt->bindParam(':UserPassword', $password);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':regdate', $regDate);

			// Insert row
			$stmt->execute();
			$conn = NULL;

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getUsers() {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query('SELECT * FROM user');
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getUser($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM user WHERE ID = $id");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getUserFromUsername($username) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM user WHERE Username = '$username'");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getLoginUser($username, $password) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM user WHERE Username = '$username' and UserPassword = '$password'");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function updateBio($id, $desc) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("UPDATE user SET Description = '$desc' WHERE ID = '$id'");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>