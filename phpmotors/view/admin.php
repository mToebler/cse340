<?php
// ADMIN VIEW
$img_root = "/phpmotors/images";
$doc_root = "/phpmotors";
$root = $_SERVER['DOCUMENT_ROOT'];

if (!$_SESSION['loggedin']) {
   header("Location: $doc_root/index.php");
   exit;
}

// var_dump($_SESSION);

?>
<!doctype html>

<html lang="en">

<head>
   <title>PHPMotors Admin</title>
   <meta charset="utf-8">
   <meta name="description" content="Admin view for CSE340 PHPMotors account">
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
      </nav>
      <main>
         <section>
            <h1><?=$_SESSION['clientData']['clientFirstname'].' '.$_SESSION['clientData']['clientLastname']?></h1>
            <? if (isset($_SESSION['message']) && $_SESSION['message'] != '') echo "<div class='err'><p>$_SESSION[message]</p></div>";
            ?>
            <p class='info'>You are logged in</p>
            <ul>
               <?php
               $cStr = 'client';
               foreach($_SESSION['clientData'] as $key => $value) {
                  $str = substr($key, strlen($cStr));                  
                  // var_dump($str); exit;
                  // using blacklisting here. Whitelisting would be better if this 
                  // strategy is to be maintained
                  if ($str != 'Id' && $str != 'Level')
                     echo "<li>$str: $value</li>";
               }
               ?>
            </ul>

            <article>
               <h2>Account Management</h2>
               <p class='info'>Update account information using link below. Clearly the link text itself isn't enough to guide you, right?</p>
               <p><a href="/phpmotors/accounts/?action=update">Update Account Management</a></p>
            </article>
            <?php
               if ($_SESSION['clientData']['clientLevel'] > 1) {
            ?>
            <article>
               <h2>Admin controls</h2>
               <p class='info'>Use the link to administer inventory.</p>
               <p><a href="/phpmotors/vehicles/">Vehicle Administration</a></p>
            </article>
            <?php
               }
            ?>
            
         </section>
      </main>
      <footer>
         <?php include "$root/phpmotors/pages/footer.php"; ?>
      </footer>
   </div>
</body>

</html>
<?php 
$_SESSION['message'] = '';
?>