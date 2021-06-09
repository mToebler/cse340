<?php
   $img_root = "/phpmotors/images";
   $doc_root = "/phpmotors";
   $root = $_SERVER['DOCUMENT_ROOT'];  

   // $justClassificationList = "";
   // $justClassificationList .= "<select id='classificationId' name='classificationId'>";
   // foreach ($classificationsWIds as $classification) {
   //    $justClassificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
   // }
   // $justClassificationList .= "</select>";
   
   if ($_SESSION['clientData']['clientLevel'] < 2 || !$_SESSION['loggedin']) {
      header("Location: /phpmotors/index.php ");
      exit;
   }
            
?>
<!doctype html>

<html lang="en">
<head>
   <title>PHP Motors Add Classification</title>
   <meta charset="utf-8">
   <meta name="description" content="Add a car classification">
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
      <h1>Add Classification</h1>
      <?php
         if (isset($message)) {
            echo "<div class='err'> $message </div>";
         }
      ?>
      <form action="/phpmotors/vehicles/index.php" id="classifictionForm" method="POST">
         <input type="hidden" id="action" name="action" value="creatClassification">
         <fieldset>
            <legend>
               Classifications:
            </legend> 
            <div>
               <label for="classificationId">Current:</label><br><?=$justClassificationList?>
            </div>
            <div>
               <label for="classificationName">New:</label><br>
               <input type="text" id="classificationName" name="classificationName" required
                  <? 
                     if (isset($classificationName)) echo "value='$classificationName'";
                  ?>
               >
            </div>
         </fieldset>
         <button type="submit">Create</button>
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


