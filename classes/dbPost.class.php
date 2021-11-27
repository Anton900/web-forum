<?php
declare(strict_types=1);
error_reporting(E_ALL);

// Anton Wallin
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.

// Klass för hanteringen av post i databasen
class dbPost { 

	public $dbservername = "studentmysql.miun.se";
    public $dbname = "anwa1114";
    public $dbusername = "anwa1114";
    public $dbpassword = "x6e7xcml";

    function __construct(){

    }

	function addPost(string $message, string $date, int $topicid, int $userid) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare('INSERT INTO post (Message, Date, TopicID, UserID) 
									VALUES (:message, :date, :topicid, :userid)');
			$stmt->bindParam(':message', $message);
			$stmt->bindParam(':date', $date);
			$stmt->bindParam(':topicid', $topicid);
			$stmt->bindParam(':userid', $userid);

			// Insert row
			$stmt->execute();
			$conn = NULL;

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function deletePost($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
			$stmt = $conn->prepare("DELETE FROM post WHERE ID = :id");
			$stmt->bindParam(':id', $id);
			$stmt->execute();
	
			$conn = NULL;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}

	}

	function getPosts($topicID) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM post WHERE TopicID = '$topicID'");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	function getPost($id) {
		try {
			$conn = new PDO("mysql:host=$this->dbservername;dbname=$this->dbname", $this->dbusername, $this->dbpassword);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $conn->query("SELECT * FROM post WHERE ID = '$id'");
			$conn = NULL;
			return $stmt;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>