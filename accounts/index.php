<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/library/functions.php";
require_once "$root/phpmotors/model/main-model.php";
// pretty self evident. Do we really need a comment clarifying the accounts-model is being included below? 
require_once "$root/phpmotors/model/accounts-model.php";


// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

// echo $navList;
// exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
   case 'registration':
      include "$root/phpmotors/view/registration.php";
      break;
   case 'login':
      include "$root/phpmotors/view/login.php";
      break;
   case 'Login':
      $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
      $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

      $email = checkEmail($email);
      $passwordCheck = checkPassword(($password));

      if (empty($email) || empty($passwordCheck)) {
         $message = '<p>Please provide valid, non-empty credentials.</p>';
         include "$root/phpmotors/view/login.php";
         exit;
      }
      break;
   case 'register':
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);
      // if (empty($checkPassword)) {
      //    echo "confusing!";
      //    exit;
      // }

      // Check for missing data
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
         $message = '<p>Please provide information for all empty form fields.</p>';
         include "$root/phpmotors/view/registration.php";
         exit;
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      // Check and report the result
      if ($regOutcome === 1) {
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
