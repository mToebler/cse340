<?php
   // echo "<!-- Header.php -->\r";   
   // echo __DIR__;
//    $action = filter_input(INPUT_POST, 'action');
//  if ($action == NULL){
//   $action = filter_input(INPUT_GET, 'action');
//  }
// Check if the firstname cookie exists, get its value
// session_unset();  
// Keeping the legacy code commented here, but replacing this with the session data. The cookie doesn't
// get read in until a new request is sent, it seems.  
if (isset($_SESSION['clientData']['clientFirstname'])) {
   // $cookieFirstname = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);
   $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
}
?>
<div class="container">
   <img src="<?=$img_root?>/site/logo.png" alt="phpmotors logo">
   <p class="login">
      <?php
         // if loggedin is set, then it will be true. Otherwise it will be unset.
         if (isset($cookieFirstname) && isset($_SESSION['loggedin']))  {
            echo "<span><a class='registering' href='/phpmotors/accounts/index.php?action=admin'>Welcome $cookieFirstname!</a></span><br>";            
         } //else if (isset($cookieFirstname)) {
           // echo "<span>Welcome $cookieFirstname</span><br>";
         //} 
          if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
            echo "<a class='registering' href='/phpmotors/accounts/index.php?action=Logout'>Logout</a>";
          }  else {
               if ($action != NULL && ($action == "registration" || $action == "login")) {
      ?>
      <a class="registering" href="/phpmotors/accounts/index.php?action=login">My Account</a>
      <?php 
               } else {
      ?>
      <a href="/phpmotors/index.php?action=login">My Account</a>
      <?php 
               }
         }
      ?>
</p>
</div>
