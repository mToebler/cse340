function showPass() {
   var x = document.getElementById("password");
   if (x.type === "password") {
     x.type = "text";
   } else {
     x.type = "password";
   }
   return false;
}
 
function submitMe() {
  console.log("submitting!"); 
  
  document.querySelector("form").submit();
}