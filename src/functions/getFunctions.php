

<?php

    /**
     * Funktioner för att returna alla objekt i en array, en grupp objekt som tillhör samma id eller ett ensamt objekt.
     * Används för att hämta data från databasen och skapa de som objekt.
     */


    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.class.php';
    });
    function getAllMainCategories() {

        $database = new dbCategory();
        $stmt = $database->getAllMainCategories();
        $mainCatArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mainCatArray[] = new MainCategory($row['ID'], $row['Name']);
        }
        return $mainCatArray;
    }

    function getAllSubCategories() {
        spl_autoload_register(function ($class) {
            include 'classes/' . $class . '.class.php';
        });
        $database = new dbCategory();
        $stmt = $database->getAllSubcategories();
        $subCatArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $subCatArray[] = new SubCategory($row['ID'], $row['Name'], $row['Description'], $row['MainCatID']);
        }
        return $subCatArray;
    }

    function getTopics($subCatId) {
        $database = new dbTopic();
        $stmt = $database->getTopics($subCatId);
        $topicArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $topicArray[] = new Topic($row['ID'], $row['SubCatId'], $row['UserId'], $row['Name']);
        }
        return $topicArray;
    }

    function getTopic($id) {
        $database = new dbTopic();
        $stmt = $database->getTopic($id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $topic = new Topic($row['ID'], $row['SubCatId'], $row['UserId'], $row['Name']);
        return $topic;
    }

    function getPosts($topicId) {
        $database = new dbPost();
        $stmt = $database->getPosts($topicId);
        $postArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $postArray[] = new Post($row['ID'], $row['UserID'], $row['TopicID'], $row['Message'], $row['Date']);
        }
        return $postArray;
    }

    function getPost($id) {
        $database = new dbPost();
        $stmt = $database->getPosts($id);
        $post = array();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $post = new Post($row['ID'], $row['UserID'], $row['TopicID'], $row['Message'], $row['Date']);
        return $post;
    }

    function getLoggedInUsername() {
        $database = new dbUser();
        $stmt = $database->getUser($_SESSION['ID']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $loggedUsername = $row['Username'];
        return $loggedUsername;
    }

    function getUser($id) {
        $database = new dbUser();
        $stmt = $database->getUser($id);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = new User($row['ID'], $row['Username'], $row['UserPassword'], $row['Description'], $row['RegDate'], $row['Admin']);
        return $user;
    }

    function getAllUsers() {
        $database = new dbUser();
        $stmt = $database->getUsers();
        $userArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $userArray[] = new User($row['ID'], $row['Username'], $row['UserPassword'], $row['Description'], $row['RegDate'], $row['Admin']);
        }
        return $userArray;
    }

    function getAllPostUsers($postArray) {
        $database = new dbUser();
        $stmt = $database->getUsers();
        $userArray = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach($postArray as $postObj) {
                $postUserId = $postObj->getUserId();
                if($postUserId == $row['ID']) {
                    $userArray[] = new User($row['ID'], $row['Username'], $row['UserPassword'], $row['Description'], $row['RegDate'], $row['Admin']);
                }
            }
        }
        return $userArray;
    }
?>