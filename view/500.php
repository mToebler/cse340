<?php
   $img_root = "/phpmotors/images";
   $root = "/phpmotors";
?>
<!doctype html>

<html lang="en">
<?php 
   $header = "Server Error; Database cannot be reached.";
   header($header);
?>

<head>
   <title>Error 500</title>
   <meta charset="utf-8">
   <meta name="description" content="Server Error: 500 ">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="<?=$root?>/css/phpmotors.css" media="screen">
</head>
<body>
   <div>
<header>
   <?php include '../pages/header.php';?>
</header>
<nav>
   <?php include '../pages/nav.php';?>
</nav>
<main>
   <section>
      <h1>Server Error</h1>
      <p>Sorry, our server seems to be experiencing some technical difficulties. =(</p>
   </section>
</main>
<footer>
   <?php include '../pages/footer.php';?>
</footer>
</div>
</body>
</html>


