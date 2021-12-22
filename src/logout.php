<?php
    // Anton Wallin 
    // 2021-03-22
    // DT058G, Webbprogrammering
    // Projektuppgift
    // Ett webbforum för diskussion om främst programmering.
    
    session_start();
    session_destroy(); // Ta bort all information om sessionen
    header("Location: login.php");
?>