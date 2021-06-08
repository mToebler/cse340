<?php
   // echo "<!-- Header.php -->\r";   
   // echo __DIR__;
//    $action = filter_input(INPUT_POST, 'action');
//  if ($action == NULL){
//   $action = filter_input(INPUT_GET, 'action');
//  }
// Check if the firstname cookie exists, get its value
// session_unset();  
if (isset($_COOKIE['firstName'])) {
   $cookieFirstname = filter_input(INPUT_COOKIE, 'firstName', FILTER_SANITIZE_STRING);   
}
?>
<div class="container">
   <img src="<?=$img_root?>/site/logo.png" alt="phpmotors logo">
   <p class="login">
      <?php
         if (isset($cookieFirstname))  {
            echo "<span><a href='/phpmotors/accounts/index.php?action=admin'>Welcome $cookieFirstname!</a></span><br>";
         }
            
         if ($action != NULL && ($action == "registration" || $action == "login")) {
      ?>
      <a class="registering" href="/phpmotors/accounts/index.php?action=login">My Account</a>
      <?php 
         } else {
      ?>
      <a href="/phpmotors/index.php?action=login">My Account</a>
      <?php 
         }
      ?>
</p>
</div>
