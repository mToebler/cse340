<?php
$img_root = "/phpmotors/images";
$doc_root = "/phpmotors";
$root = $_SERVER['DOCUMENT_ROOT'];

if ($_SESSION['clientData']['clientLevel'] < 2 || !$_SESSION['loggedin']) {
   header("Location: /phpmotors/index.php ");
   exit;
}
if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
  }


?>
<!doctype html>

<html lang="en">

<head>
   <title>PHP Motors Temp Vehicles Managment</title>
   <meta charset="utf-8">
   <meta name="description" content="Placeholder for future functionality, I'm thinking">
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
            <h1>Vehicles Management</h1>
            <!--Placeholder for future content<article><h2></h2></article>-->
            <article>
               <h2>Select management option:</h2>
               <p><a href="/phpmotors/vehicles/index.php?action=classification">Add classification</a></p>
               <p><a href="/phpmotors/vehicles/index.php?action=inventory">Add inventory</a></p>
               <?php              
               if (isset($classificationList)) {
                  echo '<h2>Vehicles By Classification</h2>';
                  if (isset($message)) {
                     echo "<div class='err'>$message</div>";
                  }
                  echo '<p>Choose a classification to see those vehicles</p>';
                  echo $classificationList;
               }
               ?>
               <noscript>
                  <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
               </noscript>
               <table id="inventoryDisplay"></table>
            </article>
         </section>
      </main>
      <footer>
         <?php include "$root/phpmotors/pages/footer.php"; ?>
      </footer>
   </div>
   <script src="../js/inventory.js"></script>
</body>

</html>
<?php unset($_SESSION['message']); ?>