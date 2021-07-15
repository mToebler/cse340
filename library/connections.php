<?php
function phpmotorsConnect()
{


   $dbUrl = getenv('DATABASE_URL');
   
   if (!empty($dbUrl) || $dbUrl) {
      $server = getenv('DATABASE_SERVER');
      $username = getenv('DATABASE_USER');
      $password = getenv('DATABASE_PW');
      $dbname = getenv('DATABASE_NAME');
      // $active_group = 'default';
      // $query_builder = TRUE;

      // $link = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
   } else {
      // if (empty($dbUrl)) {
         // example localhost configuration URL with postgres username and a database called cs313db
         $dbUrl = "mysql:host=localhost;dbname=phpmotors";
         $server = 'localhost';
         $dbname = 'phpmotors';
         $username = 'iClient';
         $password = 'x7qQFubcGDNx_mz5';
      // }
   }

   $dsn = "mysql:host=$server;dbname=$dbname";
   
   $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

   // Create the actual connection object and assign it to a variable
   try {
      $link = new PDO($dsn, $username, $password, $options);
      return $link;
   } catch (PDOException $e) {
      header('Location: /phpmotors/view/500.php');
      exit;
   }
}

// phpmotorsConnect();
