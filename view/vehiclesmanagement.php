<?php
   $img_root = "/phpmotors/images";
   $doc_root = "/phpmotors";
   $root = $_SERVER['DOCUMENT_ROOT'];  
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
<?php include "$root/phpmotors/pages/header.php";?>
</header>
<nav>
   <? echo $navList; ?>
   <?php //include 'pages/nav.php';?>
</nav>
<main>
   <section>
      <h1>Vehicles Management</h1>
      <!--Placeholder for future content<article><h2></h2></article>-->
      <article>
         <h2>Select management option:</h2>
         <p><a href="/phpmotors/vehicles/index.php?action=classification">Add classification</a></p>
         <p><a href="/phpmotors/vehicles/index.php?action=inventory">Add inventory</a></p>
      </article>
   </section>
</main>
<footer>
   <?php include "$root/phpmotors/pages/footer.php"; ?>
</footer>
</div>
</body>
</html>


