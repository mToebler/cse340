<?php
// Client Update View
$img_root = "/phpmotors/images";
$doc_root = "/phpmotors";
$root = $_SERVER['DOCUMENT_ROOT'];

if (!$_SESSION['loggedin']) {
   header("Location: $doc_root/index.php");
   exit;
}

$cliInfo = $_SESSION['clientData'];
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
   <link rel="stylesheet" href="/phpmotors/css/phpmotors.css" media="screen">

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
            <h1>Update Account Information</h1>
            <?php
            if (isset($message)) {
               echo "<div class='err'> $message </div>";
            }
            ?>
            <form action="/phpmotors/accounts/index.php" id="updateClientForm" method="POST">
               <input type="hidden" id="action" name="action" value="updateClient">
               <input type="hidden" name="clientId" value="<?php if (isset($cliInfo['clientId'])) {
                                                            echo $cliInfo['clientId'];
                                                         } ?>">
               <fieldset>
                  <legend>
                     Account information:
                  </legend>
                  <div>
                     <label for="clientFirstname">First Name:</label><br>
                     <input type="text" id="clientFirstname" name="clientFirstname" required <? if(isset($clientFirstname)) echo "value='$clientFirstname'" ; else if(isset($cliInfo['clientFirstname'])) echo "value='$cliInfo[clientFirstname]'" ; ?>
                     >
                     <!-- close element-->
                  </div>
                  <div>
                     <label for="clientLastname">Last Name:</label><br>
                     <input type="text" id="clientLastname" name="clientLastname" required <? if(isset($clientLastname)) echo "value='$clientLastname'" ; else if(isset($cliInfo['clientLastname'])) echo "value='$cliInfo[clientLastname]'" ; ?>
                     >
                  </div>
                  <div>
                     <label for="clientEmail">Email:</label><br>
                     <input type="email" id="clientEmail" name="clientEmail" required <? if(isset($clientEmail)) echo "value='$clientEmail'" ; else if(isset($cliInfo['clientEmail'])) echo "value='$cliInfo[clientEmail]'" ; ?>
                     >
                  </div>
               </fieldset>
               <button type="submit">Update</button>               
            </form>
         </section>
         <section>
            <h1>Update Password</h1>
            <? if (isset($pwMessage)) {
               echo "<div class='err'>$pwMessage</div>";
            }
            ?>
            <form action="/phpmotors/accounts/index.php" id="updatePasswordForm" method="POST">
               <input type="hidden" id="pwaction" name="action" value="updatePassword">
               <input type="hidden" name="clientId" value="<?php if (isset($cliInfo['clientId'])) {
                                                            echo $cliInfo['clientId'];
                                                         } ?>">
               <fieldset>
                  <legend>
                     Enter new credentials
                  </legend>
                  <div>
                     <label for="clientPassword">New Password:</label><br>
                     <input type="password" id="clientPassword" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br>
                     <em>This will replace your current password.</em><p class="updatePasswordForm_p">Remember, passwords must be at least 8 characters and contain at least 1 number, 1 capital letter, and 1 special character.</p>
                  </div>
               </fieldset>
               <button type="submit">Change Password</button>
            </form>
         </section>
         <p><a class="activeLink" href="/phpmotors/accounts/index.php">Back to management</a></p>
      </main>
      <footer>
         <?php include '../pages/footer.php'; ?>
      </footer>
   </div>
</body>

</html>