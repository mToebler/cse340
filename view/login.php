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
         <?php include "$root/phpmotors/pages/header.php"; ?>
      </header>
      <nav>
         <? echo $navList; ?>
         <?php //include 'pages/nav.php';
         ?>
      </nav>
      <main>
         <section>
            <h1>Login</h1>
            <?php
            // needed to rework this just a touch.
            if (isset($message)) {
               echo "<div class='err'>$message</div>";
            } else if (isset($_SESSION['message'])) {
               $msg = "<div class='err'>";
               $msg .= $_SESSION['message'];
               $msg .= "</div>";
               echo $msg;
            }
            ?>
            <form action="/phpmotors/accounts/index.php" id="login" method="POST">
               <input type="hidden" id="action" name="action" value="Login">
               <fieldset>
                  <legend>
                     Enter credientials
                  </legend>
                  <div>
                     <label for="email">email:</label><br><input type="email" id="email" name="clientEmail" <? if(isset($clientEmail)) echo "value='$clientEmail'" ; ?>
                     required>
                  </div>
                  <div>
                     <label for="password">password:</label><br><input type="password" id="password" name="password" required> <br>
                     <em>Not repeating password requirements or pattern matching here as these weaken password integrity.</em>
                  </div>
               </fieldset>
               <button type="submit">Sign-in</button>
               <p><a class="activeLink" href="/phpmotors/accounts/index.php?action=registration">Not a member yet?</a></p>
            </form>
         </section>

      </main>
      <footer>
         <?php include "$root/phpmotors/pages/footer.php"; ?>
      </footer>
   </div>
</body>

</html>