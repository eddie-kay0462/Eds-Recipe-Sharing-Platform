 // Get the modal
 var modal = document.getElementById("recipeModal");

 // Get the button that opens the modal
 var btn = document.getElementById("add-recipe");

 // Get the <span> element that closes the modal
 var span = document.getElementsByClassName("close")[0];

 // When the user clicks the button, open the modal 
 btn.onclick = function() {
     modal.style.display = "block";
 }

 // When the user clicks on <span> (x), close the modal
 span.onclick = function() {
     modal.style.display = "none";
 }

 // When the user clicks anywhere outside of the modal, close it
 window.onclick = function(event) {
     if (event.target == modal) {
         modal.style.display = "none";
     }
 }

 // Form submission
 document.getElementById("recipeForm").onsubmit = function(e) {
     e.preventDefault();
     var formData = new FormData(e.target);
     var recipeData = Object.fromEntries(formData.entries());
     console.log(recipeData);
     // Here you would typically send the data to a server
     // For now, we'll just log it and close the modal
     modal.style.display = "none";
 }