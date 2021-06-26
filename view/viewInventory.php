<?php
// NOTE: Inventory VIEW not admin inventory.
$img_root = "/phpmotors/images";
// echo $navList;
?>
<!doctype html>

<html lang="en">

<head>
   <title><?php echo $invMake ." ". $invModel; ?> | PHP Motors, Inc.</title>
   <meta charset="utf-8">
   <meta name="description" content="PHP Motors for CSE340">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/phpmotors.css" media="screen">

</head>

<body>
   <div>
      <header>
         <?php include '../pages/header.php'; ?>
      </header>
      <nav>
         <? echo $navList; ?>
         <?php //include 'pages/nav.php';
         ?>
      </nav>
      <main>
         <section>            
            <h1><?php echo $vehicle[0]['invMake']. ' ' . $vehicle[0]['invModel'];?></h1>
            <?php if (isset($message)) {
               echo $message;
            }
            if (isset($vehicleDisplay)) {
               echo $vehicleDisplay;
            }
            ?>
         </section>
      </main>
      <footer>
         <?php include '../pages/footer.php'; ?>
      </footer>
   </div>
</body>

</html>