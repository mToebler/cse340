<?php
   $img_root = "/phpmotors/images";
   $doc_root = "/phpmotors";
   $root = $_SERVER['DOCUMENT_ROOT'];  
?>
<!doctype html>

<html lang="en">
<head>
   <title>Login | PHPMotors</title>
   <meta charset="utf-8">
   <meta name="description" content="Login to PHP Motors">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="/phpmotors/js/phpmotors.js"></script>
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
      <h1>Login</h1>
      <form action="./" id="login" method="POST">
         <input type="hidden" id="action" name="action" value="login">
         <fieldset>
            <legend>
               Enter credientials
            </legend> 
            <div>
               <label for="email">email:</label><br><input type="email" id="email" name="email">
            </div>
            <div>
               <label for="password">password:</label><br><input type="password" id="password" name="password">
            </div>
         </fieldset>
         <button type="submit">Sign-in</button>
         <p><a class="activeLink" href="/phpmotors/accounts/index.php?action=registration">Not a member yet?</a></p>
      </form>
   </section>
   
</main>
<footer>
   <?php include "$root/phpmotors/pages/footer.php";?>
</footer>
</div>
</body>
</html>


