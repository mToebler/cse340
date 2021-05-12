<?php
   $img_root = "/phpmotors/images";
   $doc_root = "/phpmotors";
   $root = $_SERVER['DOCUMENT_ROOT'];  
?>
<!doctype html>

<html lang="en">
<head>
   <title>Registration | PHPMotors</title>
   <meta charset="utf-8">
   <meta name="description" content="Register for PHP Motors">
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
      <h1>Register</h1>
      <form action="./" id="register" method="POST" onsubmit="return false;">
         <input type="hidden" id="action" name="action" value="registration">
         <fieldset>
            <legend>
               Enter account information
            </legend> 
            <div>
               <label for="firstName">First Name:</label><br><input type="text" id="firstName" name="firstName" required>
            </div>
            <div>
               <label for="lastName">Last Name:</label><br><input type="text" id="lastName" name="lastName" required>
            </div>
            <div>
               <label for="email">Email:</label><br><input type="email" id="email" name="email" required>
            </div>
            <div>
               <label for="password">Password:</label><br><input type="password" id="password" name="password" pattern="/[A-Z]+[a-z]+[0-9]+[\.\+\*\?\^\$\(\)\[\]\{\}\|\\\]+/" required><br>
               <em>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</em>
               <br>
               <button class="tinyButton" onClick="showPass();">Show Password</button>
            </div>
         </fieldset>
         <button type="submit" onCLick="submitMe();">Register</button>
      </form>
   </section>
</main>
<footer>
   <?php include "$root/phpmotors/pages/footer.php";?>
</footer>
</div>
</body>
</html>


