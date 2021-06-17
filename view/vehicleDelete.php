<?php
$img_root = "/phpmotors/images";
$doc_root = "/phpmotors";
$root = $_SERVER['DOCUMENT_ROOT'];

if ($_SESSION['clientData']['clientLevel'] < 2 || !$_SESSION['loggedin']) {
   header("Location: /phpmotors/index.php ");
   exit;
}

// $classificationList = "";
// $selectedClassification = null;
// if (isset($invInfo['classificationId'])) $selectedClassification = $invInfo['classificationId'];
// // var_dump($invInfo);
// if (!isset($classificationId) && !isset($selectedClassification)) {
//    // echo "Neither set!";
//    // exit;
//    $classificationList = buildClassificationDropdown($classifications, "Select classification...");
// } else if (isset($classificationId)) {
//    // echo $classificationId . " set.";
//    // exit;
//    $classificationList = buildClassificationDropdown($classifications, "Select classification...", $classificationId);
// } else if (isset($selectedClassification)) {
//    // echo $selectedClassification . " set.";
//    // exit;   
//    $classificationList = buildClassificationDropdown($classifications, "Select classification...", $selectedClassification);
// }
// var_dump($classificationId);
// echo '<br>';
// var_dump($classificationList);
?>
<!doctype html>

<html lang="en">

<head>
   <title>
      <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
         echo "Delete $invInfo[invMake] $invInfo[invModel]";
      } elseif (isset($invMake) && isset($invModel)) {
         echo "Delete $invMake $invModel";
      } ?> | PHP Motors
   </title>
   <meta charset="utf-8">
   <meta name="description" content="PHP Motors Delete Inventory Management">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="/phpmotors/css/phpmotors.css" media="screen">

</head>

<body>
   <div>
      <header>
         <?php include "$root/phpmotors/pages/header.php"; ?>
      </header>
      <nav>
         <? echo $navList; ?>
         <?php //include 'pages/nav.php';
         ?>
      </nav>
      <main>
         <section>
            <h1>
               <?php
               if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                  echo "Delete $invInfo[invMake] $invInfo[invModel]";
               } 
               ?>
            </h1>
            <?php
            if (isset($message)) {
               echo "<div class='err'> $message </div>";
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="deleteInventoryForm" method="POST">
               <input type="hidden" id="action" name="action" value="deleteVehicle">
               <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                     echo $invInfo['invId'];
                  } ?>">
               <fieldset>
                  <legend>
                     Delete inventory:
                  </legend>
                  <div>
                     <label for="invMake">Make:</label><br>
                     <input type="text" id="invMake" name="invMake" readonly <? if(isset($invInfo['invMake'])) echo "value='$invInfo[invMake]'"; ?>
                     >
                     <!-- close element-->
                  </div>
                  <div>
                     <label for="invModel">Model:</label><br>
                     <input type="text" id="invModel" name="invModel" readonly <? if(isset($invInfo['invModel'])) echo "value='$invInfo[invModel]'"; ?>
                     >
                  </div>
                  <div>
                     <label for="invDescription">Description:</label><br>
                     <textarea id="invDescription" name="invDescription" readonly><? 
                     if(isset($invInfo['invDescription'])) echo "$invInfo[invDescription]";?></textarea>
                  </div>                                    
               </fieldset>
               <button type="submit">Delete</button>
               <p><a class="activeLink" href="/phpmotors/vehicles/index.php">Back to management</a></p>
            </form>
         </section>
      </main>
      <footer>
         <?php include "$root/phpmotors/pages/footer.php"; ?>
      </footer>
   </div>
</body>

</html>