<?php
$img_root = "/phpmotors/images";
$doc_root = "/phpmotors";
$root = $_SERVER['DOCUMENT_ROOT'];

if ($_SESSION['clientData']['clientLevel'] < 2 || !$_SESSION['loggedin']) {
   header("Location: /phpmotors/index.php ");
   exit;
}

$classificationList = "";
$selectedClassification = null;
if (isset($invInfo['classificationId'])) $selectedClassification = $invInfo['classificationId'];
// var_dump($invInfo);
if (!isset($classificationId) && !isset($selectedClassification)) {
   // echo "Neither set!";
   // exit;
   $classificationList = buildClassificationDropdown($classifications, "Select classification...");
} else if (isset($classificationId)) {
   // echo $classificationId . " set.";
   // exit;
   $classificationList = buildClassificationDropdown($classifications, "Select classification...", $classificationId);
} else if (isset($selectedClassification)) {
   // echo $selectedClassification . " set.";
   // exit;   
   $classificationList = buildClassificationDropdown($classifications, "Select classification...", $selectedClassification);
}
// var_dump($classificationId);
// echo '<br>';
// var_dump($classificationList);
?>
<!doctype html>

<html lang="en">

<head>
   <title>
      <?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
         echo "Modify $invInfo[invMake] $invInfo[invModel]";
      } elseif (isset($invMake) && isset($invModel)) {
         echo "Modify $invMake $invModel";
      } ?> | PHP Motors
   </title>
   <meta charset="utf-8">
   <meta name="description" content="PHP Motors Update Inventory Management">
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
                  echo "Modify $invInfo[invMake] $invInfo[invModel]";
               } elseif (isset($invMake) && isset($invModel)) {
                  echo "Modify$invMake $invModel";
               }
               ?>
            </h1>
            <?php
            if (isset($message)) {
               echo "<div class='err'> $message </div>";
            }
            ?>
            <form action="/phpmotors/vehicles/index.php" id="modifyInventoryForm" method="POST">
               <input type="hidden" id="action" name="action" value="updateVehicle">
               <fieldset>
                  <legend>
                     Modify inventory:
                  </legend>
                  <div>
                     <label for="invMake">Make:</label><br>
                     <input type="text" id="invMake" name="invMake" required 
                     <? 
                     if(isset($invMake)) echo "value='$invMake'";  
                     else if(isset($invInfo['invMake'])) echo "value='$invInfo[invMake]'";  
                     ?>
                     > <!-- close element-->
                  </div>
                  <div>
                     <label for="invModel">Model:</label><br>
                     <input type="text" id="invModel" name="invModel" required <? 
                     if(isset($invModel)) echo "value='$invModel'" ; 
                     else if(isset($invInfo['invModel'])) echo "value='$invInfo[invModel]'";  
                     ?>
                     >
                  </div>
                  <div>
                     <label for="invDescription">Description:</label><br>
                     <textarea id="invDescription" name="invDescription" required><? 
                     if(isset($invDescription)) echo "$invDescription"; 
                     else if(isset($invInfo['invDescription'])) echo $invInfo['invDescription'];  
                  ?></textarea>
                  </div>
                  <div>
                     <label for="invImage">Image:</label><br>
                     <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" required>
                  </div>
                  <div>
                     <label for="invThumbnail">Thumbnail:</label><br>
                     <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" required>
                  </div>
                  <div>
                     <label for="invPrice">Price:</label><br>
                     <input type="number" step="any" id="invPrice" name="invPrice" required 
                     <? 
                     if(isset($invPrice)) echo "value='$invPrice'" ; 
                     else if(isset($invInfo['invPrice'])) echo "value='$invInfo[invPrice]'";  
                     else echo 'value="1"' ; ?>
                     >
                  </div>
                  <div>
                     <label for="invStock">Quantity:</label><br>
                     <input type="number" id="invStock" name="invStock" required 
                     <? 
                     if(isset($invStock)) echo "value='$invStock'" ; 
                     else if(isset($invInfo['invStock'])) echo "value='$invInfo[invStock]'";  
                     else echo 'value="1"' ; 
                     ?>
                     >
                  </div>
                  <div>
                     <label for="invColor">Color:</label><br>
                     <input type="color" id="invColor" name="invColor" 
                     <? 
                     if(isset($invColor)) echo "value='$invColor'" ; 
                     else if(isset($invInfo['invColor'])) echo "value='$invInfo[invColor]'";  
                     ?>
                     >
                  </div>
                  <div>
                     <label for="classificationId">Classification:</label><br><?= $classificationList ?>
                  </div>
               </fieldset>
               <button type="submit">Update</button>
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