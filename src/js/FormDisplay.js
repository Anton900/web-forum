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

    var form = document.getElementById("form-input");
    form.style.display = "none";
    
    var buttonForm = document.getElementById("button-input");
    buttonForm.addEventListener("click", function(){
        if(form.style.display == "none") {
            form.style.display = "block";
        } else {
            form.style.display = "none";
        }
        
        var scrollToBottom = document.getElementById("mainfooter");
        scrollToBottom.scrollIntoView(false);

    });
})