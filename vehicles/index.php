<?php 
// VEHICLES CONTROLLER
// Create or access a Session
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];  
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/library/functions.php";
require_once "$root/phpmotors/model/main-model.php";
require_once "$root/phpmotors/model/vehicles-model.php";

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

$navList = buildNav($classifications);
// echo $navList;
// exit;

// just classification drop down with no label
$justClassificationList = buildClassificationDropdown($classifications, "Current classifications...");

// var_dump($classificationList);
// exit;

// <label for="cars">Choose a car:</label>
// <select id="cars" name="cars">
//   <option value="volvo">Volvo</option>
//   <option value="saab">Saab</option>
//   <option value="fiat">Fiat</option>
//   <option value="audi">Audi</option>
// </select>

$action = filter_input(INPUT_POST, 'action');
   if ($action == NULL){
      $action = filter_input(INPUT_GET, 'action');
}



switch ($action){
   case 'classification':
      include "$root/phpmotors/view/classification.php";
   break;

   case 'inventory':
      include "$root/phpmotors/view/inventory.php";
   break;

   case 'creatClassification':
      $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);
      if(empty($classificationName)){
         $message = '<p>Classification names must be an alpha-numeric sequences longer than 0 characters.</p>';
         include "$root/phpmotors/view/classification.php";
         exit; 
      }
      $regOutcome = addClassification($classificationName);
      
      // Check and report the result
      if($regOutcome === 1){
         header('Location: /phpmotors/vehicles/index.php?rice=nice');
         exit;
      } else {
         $message = "<p>Sorry $classificationName creation failed. Please try again.</p>";
         include "$root/phpmotors/view/classification.php";
         exit;
      }
   break;

   case 'createInventory':
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));
      $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING));
      $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING));
      $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING));
      $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_ALLOW_FRACTION));
      $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
      $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING));
      $classificationId = trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT));
   
      //NOTE: Custom validation functions
      $colorMatch = checkColor($invColor);
      $classIdMatch = isPropertyInArray($classificationId, "classificationId", $classifications);      
      
      
      if(empty($invMake) || empty($invModel) || empty($invDescription) || 
         empty($invImage) || empty($invThumbnail) || empty($invPrice) || 
         empty($invStock) || !$colorMatch || !$classIdMatch) {
         $message = '<p>All fields require valid values</p>';
         include "$root/phpmotors/view/inventory.php";
         exit; 
      }
      $invOutcome = addInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);      
      // Check and report the result
     
      if($invOutcome === 1){
         $message = "<div><p>$invMake $invModel added.</p></div>";
         //clearing out all variables:
         unset($invMake); unset($invModel); unset($invDescription); 
         unset($invPrice); unset($invImage); unset($invThumbnail); 
         unset($invStock); unset($invColor); unset($classificationId);
         include "$root/phpmotors/view/inventory.php";
         exit;
      } else {
         $message = "<p>Sorry, $invMake $invModel was not added to inventory. Please try again.</p>";
         include "$root/phpmotors/view/inventory.php";
         exit;
      }
   break;
   
   default:
      include "$root/phpmotors/view/vehiclesmanagement.php";
}

?>