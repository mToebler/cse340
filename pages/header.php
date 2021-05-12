<?php
   // echo "<!-- Header.php -->\r";   
   // echo __DIR__;
//    $action = filter_input(INPUT_POST, 'action');
//  if ($action == NULL){
//   $action = filter_input(INPUT_GET, 'action');
//  }

?>
<div class="container">
   <img src="<?=$img_root?>/site/logo.png" alt="phpmotors logo">
   <p class="login">
      <?php
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
