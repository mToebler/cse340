<?php
   $img_root = "/phpmotors/images";
   $doc_root = "/phpmotors";
   $root = $_SERVER['DOCUMENT_ROOT'];  
   
   $classificationList = "";
   if (!isset($classificationId)) {
      $classificationList = buildClassificationDropdown($classifications, "Select classification...");
   } else {
      $classificationList = buildClassificationDropdown($classifications, "Select classification...", $classificationId);
   }
   // var_dump($classificationId);
   // echo '<br>';
   // var_dump($classificationList);
?><!doctype html>

<html lang="en">
<head>
   <title>PHP Motors Add Vehicle</title>
   <meta charset="utf-8">
   <meta name="description" content="PHP Motors Add Inventory Management">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="/phpmotors/css/phpmotors.css" media="screen">

</head>
<body>
   <div>
<header>
<?php include "$root/phpmotors/pages/header.php";?>
</header>
<nav>
   <? echo $navList; ?>
   <?php //include 'pages/nav.php';?>
</nav>
<main>
<section>
      <h1>Add a Vehicle</h1>
      <?php
         if (isset($message)) {
            echo "<div class='err'> $message </div>";
         }
      ?>
      <form action="/phpmotors/vehicles/index.php" id="addInventoryForm" method="POST">
         <input type="hidden" id="action" name="action" value="createInventory">
         <fieldset>
            <legend>
               Add inventory:
            </legend> 
            <div>
               <label for="invMake">Make:</label><br>
               <input type="text" id="invMake" name="invMake" required
                  <? 
                     if(isset($invMake)) echo "value='$invMake'"; 
                  ?>
               >
            </div>
            <div>
               <label for="invModel">Model:</label><br>
               <input type="text" id="invModel" name="invModel" required
                  <? 
                     if(isset($invModel)) echo "value='$invModel'"; 
                  ?>
               >
            </div>
            <div>
               <label for="invDescription">Description:</label><br>
               <textarea id="invDescription" name="invDescription" required><? 
                     if(isset($invDescription)) echo "$invDescription"; 
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
               <input type="number" step="any" id="invPrice" name="invPrice" value="1" required
                  <? 
                     if(isset($invPrice)) echo "value='$invPrice'"; 
                  ?>
               >
            </div>
            <div>
               <label for="invStock">Quantity:</label><br>
               <input type="number" id="invStock" name="invStock" value="1" required
                  <? 
                     if(isset($invStock)) echo "value='$invStock'"; 
                  ?>
               >
            </div>
            <div>
               <label for="invColor">Color:</label><br>
               <input type="color" id="invColor" name="invColor" required
                  <? 
                     if(isset($invColor)) echo "value='$invColor'"; 
                  ?>
               >
            </div>
            <div>               
               <label for="classificationId">Classification:</label><br><?=$classificationList?>
            </div>
         </fieldset>
         <button type="submit">Add</button>
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


