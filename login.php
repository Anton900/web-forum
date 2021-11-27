<?php
declare(strict_types=1);
error_reporting(E_ALL);
$page_title = "Login";
include("includes/headerLogin.php");
// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.
// Hämtar alla klass filer
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});
global $database;
$database = new dbUser();
global $user;

// Om användaren har tryck på registera knappen
if(isset($_POST['register'])){
    if(isset($_POST["username"])) {
        // Hämta användaren från databasen
        $stmt = $database->getUserFromUsername($_POST["username"]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    echo "<div id = 'displayMessageLogin'>";
    // Om det retunerades en användare, sätt variabel user till det namnet
    if($row) {
        $user = $row['Username'];
    }
    // Om user innehåller något, retunera ett felmeddelande
    if($user) {
        echo "Användarnamnet '" . $user . "' finns redan. Försök ett annat.";
    } 
    // Om user INTE innehåller något, skapa användaren i databasen med användarnamn och lösenord från vad användaren skrev in
    else {
        // Skapa användaren i databasen
        $database->addUser($_POST["username"], $_POST['password']);
        // Hämta den nyskapade användaren
        $stmt = $database->getUserFromUsername($_POST["username"]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user = $row['Username'];
        // Om användaren retunerades tillbaka från database, skriv att registrering lyckades. Annars att det misslyckades
        if($user) {
            echo "Du är nu registrerad - " . $user . "!";
        } else {
            echo "Något gick fel med registrering. Försök igen.";
        }
    }

    echo "</div>";
    unset($_POST["register"]);
    unset($_POST['username']);
}

?>
    <div id = 'login-page' >
    <div id="loginform">
        <!-- Login formulär. Gå till index.php -->
        <form action="index.php" method="post">
            <h2>Logga in</h2>
            <label>Användarnamn:</label>
                <input type="text" name="uname" required/>
            <label>Lösenord:</label>
                <input type="password" name="pwd" required/>
            <br>
            <br>
            <input type="submit" name="login" value="Logga in" />
            <br>
            <br>
        </form>
            <input type="button" id="medlem" value="Bli medlem" />
    </div>
    <div id="regform">
        <!-- Registrering formulär -->
        <h2>Registrering</h2>
        <form method="post">
        <label>Användarnamn:</label>
            <input type="text" name="username" required/>
        <label>Lösenord:</label>
            <input type="password" name="password" required/>
        <br />
        <br />
        <input type="submit" name="register" value="Bli medlem" />
        </form>
        <br />
        <form action="login.php">
            <input type="submit" name="back" value="Tillbaka till login" />
        </form>
        
    </div>
</div> <!-- login-page -->
<!-- Javascript för att växla mellan login- och registrering formerna -->
<script src="js/RegFormDisplay.js"></script>
<?php
include("includes/footer.php");
?>