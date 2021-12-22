<?php
declare(strict_types=1);
error_reporting(E_ALL);
$page_title = "Profil";
include("includes/header.php");
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
<script src="js/ProfileFormDisplay.js"></script>
<?php

spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

    // Uppdatera 'description' fältet för användaren
    if(isset($_REQUEST["update-bio"])){
        $bio = $_REQUEST['bio-message'];
        $id = $_SESSION['ID'];
        $database = new dbUser();
        $stmt = $database->updateBio($id, $bio);
        header("Location: profil.php");
    }

    
    //Om profil är satt, om man kom hit genom att klicka på ett användarnamn
    if(isset($_REQUEST["profil"])) {
        $username = $_REQUEST["profil"];
        $database = new dbUser();
        $stmt = $database->getUserFromUsername($username);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = $row['Username'];
        $reg = $row['RegDate'];
        $admin = $row['Admin'];
        $description = $row['Description'];
    } 
    //Annars är användarens egna profilsida
    else {
        $database = new dbUser();
        $stmt = $database->getUser($_SESSION['ID']);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $username = $row['Username'];
        $reg = $row['RegDate'];
        $admin = $row['Admin'];
        $description = $row['Description'];
        
    }
    
    echo "<div id = 'profile-page'>";
    echo "<div id = 'profile-title'><h1>$username</h1></div>";
    echo "<div id = 'profile-container'>";
        echo "<br/>";
        echo "<h4>Användarnamn:</h4><br/>$username <br/>";
        echo "<h4>Datum registrerad:</h4><br/>$reg <br/>";
        echo "<h4>Beskrivning om dig själv:</h4><br />$description <br/><br/><br/>";
        // Visa bara 'Uppdatera beskrivning' om det är användarens egna profil
        if(empty($_REQUEST["profil"])) {
            echo "<input type='button' id='update-button' value='Uppdatera beskrivning' />";
            echo "<br/>";
            echo "<br/>";
            echo "<div id = 'update-form' >";
                echo "<!-- Formulär för att uppdatera användarens beskrivning-->";
                echo "<form method='GET'>";
                echo "<!-- Varje input har en ID som behövs sedan för att behålla värdet som användaren fyller i-->";
                echo "<label>Ny beskrivning: </label>";
                echo "<textarea name = 'bio-message' rows = '10' cols = '50'></textarea>";
                echo "<br/>";
                echo "<br/>";
                echo "<input type='submit' name='update-bio' value='Uppdatera' />";
                echo "</form>";
            echo "</div>";
        }
        if($admin) {
            echo "<h4>Administrator.</h4><br/>";
        }
    echo "</div> <!-- profile-container -->";
    echo "</div> <!-- profile-page -->";
?>
<?php
include("includes/footer.php");
?>