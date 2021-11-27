/*
Anton Wallin 
2021-03-22
DT058G, Webbprogrammering
Projektuppgift
Ett webbforum för diskussion om främst programmering.
*/

// Gömmer skapa inlägg formuläret
// Vid knapp tryck visar formuläret, eller gömmer om den redan visades

"use strict";
// Vänta för att DOM att ladda
document.addEventListener("DOMContentLoaded", function(){ 

    var mainCat =document.getElementById("form-mainCat");
    mainCat.style.display = "none";

    var buttonMainCat = document.getElementById("button-mainCat");
    buttonMainCat.addEventListener("click", function(){
        if(mainCat.style.display == "none") {
            mainCat.style.display = "block";
        } else {
            mainCat.style.display = "none";
        }


        
        var scrollToBottom = document.getElementById("mainfooter");
        scrollToBottom.scrollIntoView(false);

    });

})