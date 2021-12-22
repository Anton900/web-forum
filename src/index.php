<?php

$page_title = "Startsida";
include("includes/header.php");
// Anton Wallin 
// 2021-03-22
// DT058G, Webbprogrammering
// Projektuppgift
// Ett webbforum för diskussion om främst programmering.
spl_autoload_register(function ($class) {
    include 'classes/' . $class . '.class.php';
});

session_start();
if($_SESSION['uname'] != null) {
    $username = $_SESSION['uname'];
}

// Om variablen för sessionen är tom finns det ingen som är inloggad just nu - ladda login sidan om inte post 'uname' och 'pwd' stämmer
// Om variablen inte är tom, ladda startsidan för användaren
if(!(isset($_SESSION['uname']))){
    // Om användarnamnet och lösenordet stämmer överens med de hårdkodade variablerna
    if($_POST['uname'] != null && $_POST['pwd'] != null) {
        $database = new dbUser();
        $stmt = $database->getLoginUser($_POST['uname'], $_POST['pwd']);
        if(!$stmt) {
            header("Location: login.php");
        } else {
            if(mysqli_num_rows($stmt) == 0) {
                header("Location: login.php");
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $user = new User($row['ID'], $row['Username'], $row['UserPassword'], $row['Description'], $row['RegDate'], $row['Admin']);
            $username = $user->getUsername();
            $userId = $user->getId();
            $_SESSION['uname'] = $username;
            $_SESSION['ID'] = $userId;
            header("Location: index.php");
        }
    // Om användarnamnet eller lösenordet inte stämmer överens, ladda om login sidan
    } else {
        header("Location: login.php");
    }
}
echo "<div id = 'start-page'>";
echo "<h1>Välkommen $username!</h1>";
?>
<h4>En sida för att diskutera allt och lite till om programmering.</h4>
<p>Som användare kan du skapa nya trådar eller skriva inlägg i trådar.<br/>
Du kan även radera dina egna trådar eller inlägg när du vill. Administratörer kan radera andras trådar och inlägg.<br/>
På profil sidan kan du se din egen information och skriva in en kort beskrivning om dig själv.<br/>
Du kan se andras profil sidor genom att klicka på deras användarnamn på forumet.<br/>
Adminsitratörer kan även lägga till huvud- och underkategorier samt radera kategorier.</p>
</div> <!-- start-page -->
<?php
include("includes/footer.php");
?>