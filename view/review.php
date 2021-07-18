<?php
$img_root = "/phpmotors/images";

if (!$_SESSION['loggedin']) {
   header("Location: $doc_root/index.php");
   exit;
}

?>
<!doctype html>

<html lang="en">

<head>
   <title>CSE340 Template</title>
   <meta charset="utf-8">
   <meta name="description" content="Review Edit">
   <meta name="author" content="Mark Tobler">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h1>Modify Review for <?=$reviewInfo['make'] . ' ' . $reviewInfo['model'] ?></h1>
            <?php
            if (isset($message)) {
               echo "<div class='err'> $message </div>";
            }
            ?>
            <? if (isset($reviewInfo) && count($reviewInfo) > 0) { ?>
               
               <div class="form_div">
                  <form class="review_form" action="/phpmotors/reviews/" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="action" value="updateReview">
                     <input type="hidden" name="invId" value="<?= $reviewInfo['invId'] ?>">
                     <input type="hidden" name="reviewId" value="<?= $reviewInfo['reviewId'] ?>">
                     <label class="blacktext" for="reviewText">Remember no grease in the showroom, <?= getUserDisplayName() ?>: </label>
                     <textarea id="reviewTextarea" name="reviewText" class="review_text" minLength="2" maxlength="2048"><?= $reviewInfo['reviewText'] ?></textarea>
                     <button id="btnCheck" type="submit">submit</button>
                  </form>
               </div>
            <? } ?>
         </section>
      </main>
      <footer>
         <?php include '../pages/footer.php'; ?>
      </footer>
   </div>
</body>

</html>