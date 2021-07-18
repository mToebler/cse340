<?php
// NOTE: Inventory VIEW not admin inventory.
$img_root = "/phpmotors/images";
// echo $navList;
?>
<!doctype html>

<html lang="en">

<head>
   <title> PHP Motors, Inc.</title>
   <meta charset="utf-8">
   <meta name="description" content="PHP Motors for CSE340">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <script src="/phpmotors/js/phpmotors.js"></script>
   <link rel="preconnect" href="https://fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css2?family=New+Tegomin&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="../css/phpmotors.css" media="screen">   

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
            <h1><?php echo $vehicle[0]['invMake']. ' ' . $vehicle[0]['invModel'];?></h1>
            <?php if (isset($message)) {
               echo "<span class='err'>$message</span>";
            }
            ?>
            <div class='bigContainer'>
            <?
            if (isset($thumbsDisplay)) {
               echo $thumbsDisplay;
            }
            if (isset($vehicleDisplay)) {
               echo $vehicleDisplay;
            }            
            ?>
            </div>
         </section>
         <section id="review_wrapper">            
         <h3>User Reviews and Comments</h3>
         <div class="review_body">
            <? if (array_key_exists('loggedin', $_SESSION) && $_SESSION['loggedin']) {?>               
               <div class="form_div">
               <form class="review_form" action="/phpmotors/reviews/" method="post" enctype="multipart/form-data">
               <input type="hidden" name="action" value="post">
               <input type="hidden" name="invId" value="<?=$vehicle[0]['invId']?>">
               <input type="hidden" name="invMake" value="<?=$vehicle[0]['invMake']?>">
               <? // this is not the way to do it, I'm going to grab the clientID from the session, not a user form!?>
               <input type="hidden" name="clientIdNote" value="getfromsession">               

               <label class="blacktext" for="reviewText">Tell us what you think, <?=getUserDisplayName()?>: <span class="smallmanagetext">(Manage your reviews in <a href="/phpmotors/accounts/?action=admin">profile</a>)</span> </label>
               <textarea id="reviewTextarea" name="reviewText" class="review_text" placeholder="Keep the grease out of the showroom (keep it clean, please!)" minLength="2" maxlength="2048"></textarea>
               <button id="btnCheck" type="submit">submit</button>
               </form>
               </div>
            <?} else {?>
               <span class='info_text'>(<a href='../index.php?action=login'>Login</a> to contribute)</span>
            <?}?>
            <div class="user_review">
               <?=$reviewsDisplay?>
            </div>
         </div>

         </section>
      </main>
      <footer>
         <?php include '../pages/footer.php'; ?>
      </footer>
   </div>
</body>


</html>