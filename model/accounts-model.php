<?php
//  Accounts Model

// regClient handles site registrations
// simple rule of web security is, "Never Trust Incoming Data!
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword){
   // Create a connection object using the phpmotors connection function
   $db = phpmotorsConnect();
   // The SQL statement
   $sql = 'INSERT INTO clients (clientFirstname, clientLastname,clientEmail, clientPassword)
       VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
   // Create the prepared statement using the phpmotors connection
   $stmt = $db->prepare($sql);
   // The next four lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
   $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
  }

  // Duplicate email check
  function isDuplicateEmail($email) {   
    $db = phpmotorsConnect();
    // the database should enforce unique keys here, however, this is a fallback.
    $sql = "SELECT clientEmail FROM `clients` WHERE clientEmail = :clientEmail";
    $stmt = $db->prepare($sql);
    $stmt->bindvalue(':clientEmail', $email, PDO::PARAM_STR);
    // and run
    $stmt->execute();
    //  fetching one record only or 
    $isMatch = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    // go against the grain here. Returning true or false
    // empty array() which evaluates to false and null
    // why not ===? in case null gets returned.    
    return $isMatch != array();

  }

?>