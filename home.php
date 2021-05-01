<?php
   $img_root = "/phpmotors/images";
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
   <link rel="stylesheet" href="css/phpmotors.css" media="screen">

</head>
<body>
   <div>
<header>
   <?php include 'pages/header.php';?>
</header>
<nav>
   <?php include 'pages/nav.php';?>
</nav>
<main>
   <section>
      <h1>Welcome to PHP Motors!</h1>
      <article id="delorean">
         <h3>DMC Delorean</h2>
         <p>3 Cup holders<br>Superman doors<br>Fuzzy dice!</p>
         <!-- <img class="hero_img" src="<?=$img_root?>/delorean.jpg" alt="DMC Delorean"> -->
         <!-- <btn src="<?=$img_root?>/site/own_today.png"> -->
         <input type="image" name="own_today" src="<?=$img_root?>/site/own_today.png" alt="Own Today">
      </article>
      <article>
         <h2>DMC Delorean Reviews</h2>
         <ul>
            <li>&quot;So fast, it's almost like traveling in time.&quot; (4/5)</li>
            <li>&quot;Coolest ride on the road.&quot; (4/5)</li>
            <li>&quot;I'm feeling Marty McFly!&quot; (5/5)</li>
            <li>&quot;The most futuristic ride of our day.&quot; (4/5)</li>
            <li>&quot;80's livin, and I love it!&quot; (5/5)</li>            
         </ul>
      </article>
      <article class="upgrades">
         <h2>Delorean Upgrades</h2><br>
         <div class="wrap_container">
         <div><img src="<?=$img_root?>/upgrades/flux-cap.png" alt="flux capacitor upgrade"><br><a href="">Flux Capacitor</a></div>
         <div><img src="<?=$img_root?>/upgrades/flame.jpg" alt="flame decals upgrade"><br><a href="">Flame Decals</a></div>
         <div><img src="<?=$img_root?>/upgrades/bumper_sticker.jpg" alt="Bumper Stickers upgrade"><br><a href="">Bumper Stickers </a></div>
         <div><img src="<?=$img_root?>/upgrades/hub-cap.jpg" alt="hub caps upgrade"><br><a href="">Hub Caps</a></div>         
      </article>
   </section>
</main>
<footer>
   <?php include 'pages/footer.php';?>
</footer>
</div>
</body>
</html>


