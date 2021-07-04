<?php
$img_root = "/phpmotors/images";

if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
}
?>
<!doctype html>

<html lang="en">

<head>
   <title>Image Administration</title>
   <meta charset="utf-8">
   <meta name="description" content="Upload (create) and Delete Images">
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
      </nav>
      <main>
         <section>
            <h1>Welcome to Image Management</h1>
            <p>Please one of the options presented below:</p>
            <!--Placeholder for future content<article><h2></h2></article>-->
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($message)) {
               echo $message;
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
               <label for="invItem">Vehicle</label>
               <?php echo $prodSelect; ?>
               <fieldset>
                  <label>Is this the main image for the vehicle?</label>
                  <label for="priYes" class="pImage">Yes</label>
                  <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                  <label for="priNo" class="pImage">No</label>
                  <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
               </fieldset>
               <label>Upload Image:</label>
               <input type="file" name="file1">
               <input type="submit" class="regbtn" value="Upload">
               <input type="hidden" name="action" value="upload">
            </form>
            <hr>
            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
               echo $imageDisplay;
            } ?>
         </section>
      </main>
      <footer>
         <?php include '../pages/footer.php'; ?>
      </footer>
   </div>
</body>

</html>
<?php unset($_SESSION['message']); ?>