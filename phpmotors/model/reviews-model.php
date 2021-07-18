<?php
/*
Insert a review
o Get reviews for a specific inventory item o Get reviews written by a specific client
o Get a specific review
o Update a specific review
o Delete a specific review
*/
include("review-entity.php");
include_once("../library/connections.php");
// Insert a review
function insertReview($review)
{
   $db = phpmotorsConnect();
   $sql = "insert into reviews (reviewText, invId, clientId) values(:reviewText, :invId, :clientId)";

   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $review->clientId, PDO::PARAM_INT);
   $stmt->bindValue(':reviewText', $review->reviewText, PDO::PARAM_STR);
   $stmt->bindValue(':invId', $review->invId, PDO::PARAM_INT);

   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}

function getReviews($invId)
{
   $db = phpmotorsConnect();

   $sql = "SELECT r.*, c.clientFirstname as firstname, c.clientLastname as lastname "
      . "FROM reviews r, clients c "
      . "WHERE r.clientid = c.clientId AND invId = :invId "
      . "ORDER BY r.reviewDate DESC";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
   $stmt->execute();
   $revData = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $revData;
}

function getUserReviews($clientId)
{
   $db = phpmotorsConnect();

   $sql = "select r.*, i.invMake as make, i.invModel as model from reviews r, inventory i "
      . "where r.invId = i.invId and r.clientid = :clientId "
      . "ORDER BY r.reviewDate DESC";
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $revData = $stmt->fetchAll(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $revData;
}

function getReview($reviewId)
{
   $db = phpmotorsConnect();
   $sql = "select r.*, i.invMake as make, i.invModel as model from reviews r, inventory i "
      . "where r.invId = i.invId and r.reviewId = :reviewId ";      
   // $sql .= 'SELECT * FROM reviews where reviewId = :reviewId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->execute();
   $revData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $revData;
}

// only original user can modify. admins can delete but not modify others' reviews
function updateReview($revId, $revText, $clientId)
{
   $db = phpmotorsConnect();
   $sql = "update reviews set reviewText = :reviewText where reviewId = :revId and clientId = :clientId";

   $stmt = $db->prepare($sql);
   $stmt->bindValue(':reviewText', $revText, PDO::PARAM_STR);
   $stmt->bindValue(':revId', $revId, PDO::PARAM_INT);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}


function deleteReview($reviewId, $clientId)
{
   // Create a connection object using the phpmotors connection function
   $db = phpmotorsConnect();
   $sql = 'DELETE FROM reviews WHERE reviewid = :reviewId AND clientid IN (SELECT clientid FROM clients WHERE clientid = :clientId OR clientLevel = 3)';
   // The SQL statement

   //  $sql = 'DELETE FROM reviews WHERE reviewId = :revId';
   // Create the prepared statement using the phpmotors connection
   $stmt = $db->prepare($sql);
   // The next nine lines replace the placeholders in the SQL
   // statement with the actual values in the variables
   // and tells the database the type of data it is
   $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   // Insert the data
   $stmt->execute();
   // Ask how many rows changed as a result of our insert
   $rowsChanged = $stmt->rowCount();
   // Close the database interaction
   $stmt->closeCursor();
   // Return the indication of success (rows changed)
   return $rowsChanged;
}
