<?php 
$root = $_SERVER['DOCUMENT_ROOT'];  
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/model/main-model.php";
// pretty self evident. Do we really need a comment clarifying the accounts-model is being included below? 
require_once "$root/phpmotors/model/accounts-model.php";

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = '';
$navList .= "<div><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></div>";
foreach ($classifications as $classification) {
 $navList .= "<div><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></div>";
}
$navList .= '';

// echo $navList;
// exit;


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

?>