<?php 
// VEHICLES CONTROLLER
$root = $_SERVER['DOCUMENT_ROOT'];  
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/model/main-model.php";
// require_once "$root/phpmotors/model/accounts-model.php";

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

// var_dump($classificationList);
// exit;

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
   case 'registration':
      include "$root/phpmotors/view/registration.php";
      break;
   case 'login':
      include "$root/phpmotors/view/login.php";
      break;

   case 'register':
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
      $clientLastname = filter_input(INPUT_POST, 'clientLastname');
      $clientEmail = filter_input(INPUT_POST, 'clientEmail');
      $clientPassword = filter_input(INPUT_POST, 'clientPassword');

      // Check for missing data
      if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)){
         $message = '<p>Please provide information for all empty form fields.</p>';
         include "$root/phpmotors/view/registration.php";
         exit; 
      }
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);
      
      // Check and report the result
      if($regOutcome === 1){
         $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
         include '../view/login.php';
         exit;
      } else {
         $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
         include '../view/registration.php';
         exit;
      }
      break;
        

   default:
      include "$root/phpmotors/view/home.php";
}

// array(5) { 
//    [0]=> array(4) { 
//       ["classificationId"]=> string(1) "2" [0]=> string(1) "2" ["classificationName"]=> string(7) "Classic" [1]=> string(7) "Classic" 
//    } 
//    [1]=> array(4) { ["classificationId"]=> string(1) "3" [0]=> string(1) "3" ["classificationName"]=> string(6) "Sports" [1]=> string(6) "Sports" } 
//    [2]=> array(4) { ["classificationId"]=> string(1) "1" [0]=> string(1) "1" ["classificationName"]=> string(3) "SUV" [1]=> string(3) "SUV" } 
//    [3]=> array(4) { ["classificationId"]=> string(1) "4" [0]=> string(1) "4" ["classificationName"]=> string(6) "Trucks" [1]=> string(6) "Trucks" } 
//    [4]=> array(4) { ["classificationId"]=> string(1) "5" [0]=> string(1) "5" ["classificationName"]=> string(4) "Used" [1]=> string(4) "Used" } 
// }

?>