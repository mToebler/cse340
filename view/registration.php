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
      
      <?php
         if (isset($message)) {
            echo "<div class='err'> $message </div>";
         }
      ?>
      <!-- NOTE: I've done this a bit differently that the activity onsubmit does a whole false thing so that the password will show. I submit using javascript.-->
      <form action="/phpmotors/accounts/index.php" id="register" method="POST" onsubmit="return false;">
         <input type="hidden" id="action" name="action" value="register">
         <fieldset>
            <legend>
               Enter account information
            </legend> 
            <div>
               <label for="firstName">First Name:</label><br>
               <input type="text" id="fname" name="clientFirstname" required>
            </div>
            <div>
               <label for="lastName">Last Name:</label><br>
               <input type="text" id="lname" name="clientLastname" required>
            </div>
            <div>
               <label for="email">Email:</label><br>
               <input type="email" id="email" name="clientEmail" required>
            </div>
            <div>
               <label for="password">Password:</label><br>
               <input type="password" id="password" name="clientPassword" pattern="/[A-Z]+[a-z]+[0-9]+[\.\+\*\?\^\$\(\)\[\]\{\}\|\\\]+/" required><br>
               <em>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</em>
               <br>
               <button class="tinyButton" onClick="showPass();">Show Password</button>
            </div>
         </fieldset>
         <!-- <input type="submit" name="submit" id="regbtn" value="Register"> -->
         <!-- NOTE: I'm doing something different than what's prescribed in the "activity. In order to get the password to change between text and password type, I think I need this. -->
         <!-- NOTE: Changed the name submit to submitBtn so that the submit js would work.  -->
         <button type="submit" name="submitBtn" id="regbtn" onCLick="submitMe();">Register</button>
         <!-- Add the action name - value pair -->
         <!-- I had already done a form of this above. It's a bit tedious that we have to be told to do this (yawn) -->
         <!-- <input type="hidden" name="action" value="register"> -->
      </form>
   </section>
</main>
<footer>
   <?php include "$root/phpmotors/pages/footer.php";?>
</footer>
</div>
</body>
</html>


