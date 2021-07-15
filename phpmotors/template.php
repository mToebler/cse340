<?php
   $img_root = "/phpmotors/images";
   echo $navList;
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
   <link rel="stylesheet" href="css/phpmotors.css" media="screen">

</head>
<body>
   <div>
<header>
   <?php include 'pages/header.php';?>
</header>
<nav>
   <? echo $navList; ?>
   <?php //include 'pages/nav.php';?>
</nav>
<main>
   <section>
      <h1>Content Title Here</h1>
      <!--Placeholder for future content<article><h2></h2></article>-->
   </section>
</main>
<footer>
   <?php include 'pages/footer.php';?>
</footer>
</div>
</body>
</html>


