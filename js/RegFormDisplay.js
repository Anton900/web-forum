/*
Anton Wallin 
2021-03-22
DT058G, Webbprogrammering
Projektuppgift
Ett webbforum för diskussion om främst programmering.
*/

// Visar login formuläret och gömmer registrering formuläret
// Med knapp tryck visar registrering forumläret istället och gömmer login

"use strict";
// Vänta för att DOM att ladda
document.addEventListener("DOMContentLoaded", function(){ 

    var loginform = document.getElementById("loginform");

    var regform = document.getElementById("regform");
    regform.style.display = "none";

    var memberButton = document.getElementById("medlem");
    memberButton.addEventListener("click", function(){
        regform.style.display = "block";
        loginform.style.display= "none";
        
    });


})