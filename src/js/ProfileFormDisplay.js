/*
Anton Wallin 
2021-03-22
DT058G, Webbprogrammering
Projektuppgift
Ett webbforum för diskussion om främst programmering.
*/

"use strict";
// Vänta för att DOM att ladda
document.addEventListener("DOMContentLoaded", function(){ 

    var updateBio = document.getElementById("update-form");
    updateBio.style.display = "none";

    var update = document.getElementById("update-button");
    update.addEventListener("click", function(){
        if(updateBio.style.display == "none") {
            updateBio.style.display = "block";
        } else {
            updateBio.style.display = "none";
        }

        
    });


})
