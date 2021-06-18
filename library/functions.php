<?php
function checkEmail($clientEmail)
{
   return filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
}

/* 
   Check the password for a minimum of 8 characters,
   at least one 1 capital letter, at least 1 number and
   at least 1 special character
*/
function checkPassword($clientPassword)
{
   $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
   return preg_match($pattern, $clientPassword);
}

/*
   Checks if color is either a word or a hex color value
*/
function checkColor($clientColor)
{
   // self-styled regex for hex color
   $pattern = '/^#([a-fA-F0-9]{3}|[a-fA-F0-9]){6}$/';
   $patternName = '/^\w$/';
   // returns true if either match
   return (preg_match($pattern, $clientColor) || preg_match($patternName, $clientColor));
}

/**
 * Checks for $id membership in an object $array for an attribute of $name
 *    Returns: true if found, false otherwise
 */
function isPropertyInArray($id, $name, $array)
{
   // The array is going to be an array of objects, so let's go through
   // each element object and see if it has a $name property with an $id attribute
   $rValue = false;
   foreach ($array as $object) {
      if ($object[$name] == $id)
         $rValue = true;
   }
   return $rValue;
}

/**
 *   Builds the nav from the provided array 
 */
function buildNav($navArray)
{
   // Build a dropdown list $classifications array
   $navList = '';
   $navList .= "<div><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></div>";
   foreach ($navArray as $classification) {
      $navList .= "<div><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></div>";
   }
   $navList .= '';

   return $navList;
}

function buildClassificationDropdown($navArray, $optionalMessage = 'None', $currentValue = NULL)
{
   // echo "\n\n classificationId is: $currentValue\n\n";
   $classificationList = "";
   $classificationList .= "<select id='classificationId' name='classificationId'>";
   $selected = " selected ";
   $notSelected = "";
   if ($optionalMessage !== 'None')
      $classificationList .= "<option value=''>$optionalMessage</option>";
   if ($currentValue != NULL) {
      foreach ($navArray as $classification) {
         $classificationList .= "<option value='$classification[classificationId]'";
         $classificationList .= $currentValue == $classification['classificationId'] ? $selected : $notSelected;
         $classificationList .= ">$classification[classificationName]</option>";
      }
   } else {
      foreach ($navArray as $classification) {
         $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
      }
   }
   $classificationList .= "</select>";
   return $classificationList;
}


// Get client data based on an email address
function getClient($clientEmail)
{
   $db = phpmotorsConnect();
   $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
   $stmt->execute();
   $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $clientData;
}

// Get client data based on an Id
function getClientById($clientId)
{
   $db = phpmotorsConnect();
   $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientId = :clientId';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
   $stmt->execute();
   $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $clientData;
}

// Build the classifications select list 
// stopped at activity section: getInventoryByClassification() Function 
function buildClassificationList($classifications)
{
   $classificationList = '<select name="classificationId" id="classificationList">';
   $classificationList .= "<option>Choose a Classification</option>";
   foreach ($classifications as $classification) {
      $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
   }
   $classificationList .= '</select>';
   return $classificationList;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId){ 
   $db = phpmotorsConnect(); 
   $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
   $stmt = $db->prepare($sql); 
   $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
   $stmt->execute(); 
   // Requests a multi-dimensional array of the vehicles as an associative array
   $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
   $stmt->closeCursor(); 
   return $inventory; 
  }