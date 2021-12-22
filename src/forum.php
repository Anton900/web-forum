<?php
    // Anton Wallin 
    // 2021-03-22
    // DT058G, Webbprogrammering
    // Projektuppgift
    // Ett webbforum för diskussion om främst programmering.
    
    session_start();
    // Om användarnamns variabel för sessionen inte finns, ladda login sidan
    if(!(isset($_SESSION['uname']))) {
        header("Location: login.php");
    }

?>
<?php
$page_title = "Funktion";
include("includes/header.php");
?>
<script src="js/FormDisplay.js"></script>
<script src="js/MainCatDisplay.js"></script>
<?php
    spl_autoload_register(function ($class) {
        include 'classes/' . $class . '.class.php';
    });
    include 'functions/getFunctions.php';
    include 'functions/findFunctions.php';

    // Radera kategori
    if(isset($_REQUEST["delMainCat"])){
        $mainId = $_REQUEST['delMainCat'];
        $database = new dbCategory();
        $database->deleteMainCategory($mainId);
        header("Location: forum.php");
    }

    // Radera under-kategori
    if(isset($_REQUEST["delSubCat"])){
        $subId = $_REQUEST['delSubCat'];
        $database = new dbCategory();
        $database->deleteSubCategory($subId);
        header("Location: forum.php");
    }

    // Radera tråd
    if(isset($_REQUEST["delTopic"])){
        $subCatId = $_SESSION['subCatId'];
        $topicId = $_REQUEST['delTopic'];
        $database = new dbTopic();
        $database->deleteTopic($topicId);
        header("Location: forum.php?subCat=$subCatId");
    }

    // Radera inlägg
    if(isset($_REQUEST["delPost"])){
        $topicId = $_SESSION['topicId'];
        $postId = $_REQUEST['delPost'];
        $database = new dbPost();
        $database->deletePost($postId);
        header("Location: forum.php?topic=$topicId");
    }

    global $topicId;
    global $topicArray;

    // Hämta användarens information som är inloggad för sessionen
    global $userObj;
    $userObj = getUser($_SESSION['ID']);

    // Skapa kategori
    if(isset($_REQUEST["create-mainCat"])){
        $mainCatName = $_REQUEST['mainCat-name'];
        $database = new dbCategory();
        $database->addMainCategory($mainCatName);
        header("Location: forum.php");
    }

    // Skapa under-kategori
    if(isset($_REQUEST["create-subCat"])){
        $subCatName = $_REQUEST['topic-name'];
        $subCatDesc = $_REQUEST['message'];
        $mainCatId = $_REQUEST['mainCatNames'];
        $database = new dbCategory();
        $database->addSubCategory($subCatName, $subCatDesc, $mainCatId);
        header("Location: forum.php");
    }
    
    // Skapa tråd
    if(isset($_REQUEST["create-topic"])){
        $subCatId = $_SESSION['subCatId'];
        $userId = $userObj->getId();
        $topicName = $_REQUEST['topic-name'];
        $database = new dbTopic();
        $database->addTopic($subCatId, $userId, $topicName);
        $stmt = $database->getTopicId($topicName);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $topicId = $row['ID'];
        $database2 = new dbPost();
        $message = $_REQUEST['message'];
        $database2->addPost($message, date("Y-m-d H:i"), $topicId, $userId);
        header("Location: forum.php?topic=$topicId");
    }
    
    // Skapa inlägg
    if(isset($_REQUEST["create-post"])){
        $topicId = $_SESSION['topicId'];
        $userId = $userObj->getId();
        $message = $_REQUEST['message'];
        $database2 = new dbPost();
        $database2->addPost($message, date("Y-m-d H:i"), $topicId, $userId);
        header("Location: forum.php?topic=$topicId");
    }

    $mainCatArray = getAllMainCategories();
    $subCatArray = getAllSubCategories();
    $loggedUsername = getLoggedInUsername();
    

    echo "<div id = 'forum-page'>";
    echo "<div id = 'forum-container'>";
    
    // Om användaren har tryckt på en tråd
    if(isset($_REQUEST['topic'])) {
        echo "<h2>Inloggad som: $loggedUsername";
        if($userObj->getAdmin() == 1) {
            echo "<strong> [Adminstrator]</strong>";
        }
        echo "</h2>";
        $_SESSION['topicId'] = $_REQUEST['topic'];
        $topicId = $_REQUEST['topic'];
        $postArray = getPosts($topicId);
        $topic = getTopic($topicId);
        $userArray = getAllPostUsers($postArray);

        try {
            $topicName = $topic->getName();
            
            echo "<div class = 'main-category'>";
                echo "<div class='main-text'>$topicName</div>";
            echo "</div> <!-- main-category -->";
            
            // Skriv ut alla inlägg i tråden
            foreach($postArray as $postObj) {
                $postId = $postObj->getId();
                $message = $postObj->getMessage();
                $postDate = $postObj->getDate();
                $userId = $postObj->getUserId();
                $user = getUser($userId);
                $username = $user->getUsername();
                echo "<div class = 'post-container'>";
                    echo "<div class = 'post-date'><strong>Inlägget skapades:</strong> $postDate</div>";
                    echo "<div class = 'post-title'>$message</div>";
                    echo "<div class = 'post-line'></div>";
                    echo "<div class = 'post-user'><strong>Inlägg av:</strong><a href='profil.php?profil=$username'> $username</a>";
                    // Sätt ett '[Administrator]' märke om användaren är admin
                    if($user->getAdmin() == 1) {
                        echo "<strong> [Administrator]</strong>";
                    }
                    echo "</div>";
                    // Om användaren gjorde inlägget eller är admin, visa radera knappen
                    if($postObj->getUserId() == $userObj->getId() || $userObj->getAdmin() == 1) {
                        echo "<div class = 'post-delete'><a href='forum.php?delPost=$postId'>Radera Inlägg</a></div>";
                    }
                echo "</div> <!-- post-container -->";
                
            } 
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

        // Skapa inlägg och formulär för inlägg
        echo "<input type='button' id='button-input' value='Skapa Inlägg' />";
        echo "<div id = 'form-input' >";
            echo "<form method='GET'>";
                echo "<label>Inlägg:</label>";
                echo "<textarea name = 'message' rows = '10' cols = '60' required></textarea>";
                echo "<br/>";
                echo "<br/>";
                echo "<input type='submit' name='create-post' value='Skapa Inlägg' />";
            echo "</form>";
        echo "</div> <!-- form-input -->";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        
    }
    // Om inget tråd och under-kateogori är tryckt på, visa kategorier
    else if(empty($_REQUEST['subCat'])){
        echo "<h2>Inloggad som: $loggedUsername";
        if($userObj->getAdmin() == 1) {
            echo "<strong> [Adminstrator]</strong>";
        }
        echo "</h2>";
        
        try {
            // Skriv ut alla kategorier
            foreach($mainCatArray as $mainObj) {
                $mainName = $mainObj->getName();
                $mainId = $mainObj->getId();
                echo "<div class = 'main-category'>";
                echo "<div class='main-text'>$mainName</div>"; 
                
                // Om admin, visa radera kategori knappen
                if($userObj->getAdmin() == 1) {
                    echo "<div class = 'main-delete'><a href='forum.php?delMainCat=$mainId'>Radera $mainName</a></div>";
                }
                echo "</div>";
                
                // Visa alla under-kategorier som tillhör kategorin
                foreach($subCatArray as $subObj) {
                    $mainID = $mainObj->getId();
                    $subFKID = $subObj->getMainCatId();
                    $subID = $subObj->getId();
                    if($mainID == $subFKID) {
                        $subName = $subObj->getName();
                        $subDesc = $subObj->getDescription();
                        echo "<div class = 'sub-category'>";
                        echo "<div class = 'sub-text'><a href='forum.php?subCat=$subID'>$subName</a></div>";
                        echo "<div class='sub-desc'>$subDesc</div>";
                        
                        // Om användaren är admin, visa radera under-kategorin
                        if($userObj->getAdmin() == 1) {
                            echo "<div class = 'sub-line'></div>";
                            echo "<div class = 'sub-delete'><a href='forum.php?delSubCat=$subID'>Radera Kategori</a></div>";
                        }
                        echo "</div>";
                        
                    }
                }

                echo "<br/>";
        }

        } catch(PDOException $e){
            echo $e->getMessage();
        }

        // Om admin, visa skapa under-kategori knappen
        if($userObj->getAdmin() == 1) {
            echo "<input type='button' id='button-input' value='Skapa Underkategori' />";
        }
        // Formulär för att skapa under-kategori
        echo "<div id = 'form-input' >";
        echo "<form method='GET'>";
        echo "<label>Huvudkategori: </label>";
        echo "<select name='mainCatNames'>";

        // Alla kategorier som finns. Användaren väljer kategorin som under-kategorin ska hamnas på
        foreach($mainCatArray as $mainObj) {
            $mainCatName = $mainObj->getName();
            $mainCatId = $mainObj->getId();
            echo "<option value='$mainCatId'>$mainCatName</option>";
        }
        echo "</select>";
        echo "<br/>";
        echo "<label>Underkategori namn: </label>";
            echo "<input type='text' name='topic-name' required>";
            echo "<br/>";
            echo "<label>Underkategori beskrivning:</label>";
            echo "<textarea name = 'message' rows = '10' cols = '60' required></textarea>";
            echo "<br/>";
            echo "<br/>";
            echo "<input type='submit' name='create-subCat' value='Skapa Kategori' />";
            echo "</form>";
        echo "</div> <!-- create-subCat -->";

        // Om admin, visa skapa kategori knappen
        if($userObj->getAdmin() == 1) {
            echo "<input type='button' id='button-mainCat' value='Skapa Huvudkategori' />";
        }
        // Formulär för att skapa kategori
        echo "<div id = 'form-mainCat' >";
            echo "<!-- Allting läggs i en formulär-->";
            echo "<form method='GET'>";
            echo "<!-- Varje input har en ID som behövs sedan för att behålla värdet som användaren fyller i-->";
            echo "<label>Huvudkategori namn: </label>";
                echo "<input type='text' name='mainCat-name' required>";
                echo "<br/>";
                echo "<br/>";
                echo "<input type='submit' name='create-mainCat' value='Skapa Huvudkategori' />";
            echo "</form>";
        echo "</div> <!-- form-mainCat -->";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
    
    
    
    } 
    // Om en under-kategori är tryckt på
    else if(isset($_REQUEST['subCat'])){
        echo "<h2>Inloggad som: $loggedUsername";
        if($userObj->getAdmin() == 1) {
            echo "<strong> [Adminstrator]</strong>";
        }
        echo "</h2>";
        $_SESSION['subCatId'] = $_REQUEST['subCat'];
        $currentSubCat = findObj($subCatArray, $_REQUEST['subCat']);
        $currentMainCat = findObj($mainCatArray, $currentSubCat->getMainCatId());
        $userArray = getAllUsers();
        $topicArray = getTopics($currentSubCat->getId());
        $currentSubName = $currentSubCat->getName();
        $currentMainName = $currentMainCat->getName();
        echo "<div class = 'main-category'>";
            echo "<div class='main-text'>$currentMainName / $currentSubName</div>";
        echo "</div> <!-- main-category -->";

        try {
            
            // Skriv ut alla trådar som finns i den nuvarande under-kategorin
            foreach($topicArray as $topicObj) {
                $topicId = $topicObj->getId();
                $topicSubId = $topicObj->getSubCatId();
                $subId = $currentSubCat->getId();
                $database = new dbUser();
                $stmt = $database->getUser($topicObj->getUserId());
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = new User($row['ID'], $row['Username'], $row['UserPassword'], $row['Description'], $row['RegDate'], $row['Admin']);
                $username = $user->getUsername();
                if($topicSubId == $subId) {
                    $topicName = $topicObj->getName();
                    echo "<div class = 'topic-container'>";
                    echo "<div class = 'topic-title'><a href='forum.php?topic=$topicId'>$topicName</a></div>";
                    echo "<div class = 'post-line'></div>";
                    echo "<div class = 'topic-user'><strong>Tråd av:</strong> <a href='profil.php?profil=$username'>$username</a></div>";
                    if($topicObj->getUserId() == $userObj->getId() || $userObj->getAdmin() == 1) {
                        echo "<div class = 'topic-delete'><a href='forum.php?delTopic=$topicId'>Radera Tråd</a></div>";
                    }
                    
                    echo "</div> <!-- topic-container-->";
                    
                }
                
        }  

        // Knappen och formuläret för att skapa en tråd
        echo "<input type='button' id='button-input' value='Skapa Tråd' />";
            echo "<div id = 'form-input' >";
                echo "<!-- Allting läggs i en formulär-->";
                echo "<form method='GET'>";
                echo "<!-- Varje input har en ID som behövs sedan för att behålla värdet som användaren fyller i-->";
                echo "<label>Tråd namn: </label>";
                    echo "<input type='text' name='topic-name' required>";
                    echo "<label>Inlägg:</label>";
                    echo "<textarea name = 'message' rows = '10' cols = '60' required></textarea>";
                    echo "<br/>";
                    echo "<br/>";
                    echo "<input type='submit' name='create-topic' value='Skapa Tråd' />";
                echo "</form>";
        echo "</div> <!-- create-topic -->";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";

        } catch(PDOException $e){
            echo $e->getMessage();
        }
            
        
    }


?>

</div> <!-- forum-container -->
</div> <!-- forum-page -->
<?php
include("includes/footer.php");
?>