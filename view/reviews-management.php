<?php
   $img_root = "/phpmotors/images";   

   if (!$_SESSION['loggedin']) {
      header("Location: /phpmotors/index.php ");
      exit;
   }
   
?>
<!doctype html>

<html lang="en">
<head>
   <title>CSE340 Template</title>
   <meta charset="utf-8">
   <meta name="description" content="Template for CSE340 future pages">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/phpmotors.css" media="screen">

</head>
<body>
   <div>
<header>
   <?php include '../pages/header.php';?>
</header>
<nav>
   <? echo $navList; ?>
   <?php //include 'pages/nav.php';?>
</nav>
<main>
   <section>
      <h1>Reviews Management</h1>
      <div class='minor_side_margins'>
      <? if (isset($message)) echo "<span class='err'>$message</span><hr>"; ?>
      <?=$displayReviews?>
      </div>
   </section>
</main>
<footer>
   <?php include '../pages/footer.php';?>
</footer>
</div>
</body>
</html>


