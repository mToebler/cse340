<?php 
// VEHICLES CONTROLLER
$root = $_SERVER['DOCUMENT_ROOT'];  
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/model/main-model.php";
require_once "$root/phpmotors/model/vehicles-model.php";

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a dropdown list $classifications array
$navList = '';
$navList .= "<div><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></div>";
foreach ($classifications as $classification) {
 $navList .= "<div><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></div>";
}
$navList .= '';

// echo $navList;
// exit;

$classificationsWIds = getClassificationsWIds();
$classificationList = "";
$classificationList .= "<label for='classification'>Choose a car:</label>";
$classificationList .= "<select id='classification' name='classification'>";
foreach ($classificationsWIds as $classification) {
   $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$classificationList .= "</select>";

// just classification drop down with no label
$justClassificationList = "";
$justClassificationList .= "<select id='classificationId' name='classificationId'>";
foreach ($classificationsWIds as $classification) {
   $justClassificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$justClassificationList .= "</select>";

// echo $classificationList;
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
      $classificationName = filter_input(INPUT_POST, 'classificationName');
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
      $invMake = filter_input(INPUT_POST, 'invMake');
      $invModel = filter_input(INPUT_POST, 'invModel');
      $invDescription = filter_input(INPUT_POST, 'invDescription');
      $invImage = filter_input(INPUT_POST, 'invImage');
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
      $invPrice = filter_input(INPUT_POST, 'invPrice');
      $invStock = filter_input(INPUT_POST, 'invStock');
      $invColor = filter_input(INPUT_POST, 'invColor');
      $classificationId = filter_input(INPUT_POST, 'classificationId');
      
      if(empty($invMake) || empty($invModel) || empty($invDescription) || 
         empty($invImage) || empty($invThumbnail) || empty($invPrice) || 
         empty($invStock) || empty($invColor) || empty($classificationId)) {
         $message = '<p>All fields are required</p>';
         include "$root/phpmotors/view/inventory.php";
         exit; 
      }
      $invOutcome = addInventory($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);      
      // Check and report the result
     
      if($invOutcome === 1){
         $message = "<div><p>$invMake added.</p></div>";
         include "$root/phpmotors/view/inventory.php";
         exit;
      } else {
         $message = "<p>Sorry $invMake was not added to inventory. Please try again.</p>";
         include "$root/phpmotors/view/inventory.php";
         exit;
      }
   break;
   
   default:
      include "$root/phpmotors/view/vehiclesmanagement.php";
}

?>