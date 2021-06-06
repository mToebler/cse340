<?php
// Create or access a Session
session_start();
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
      $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
      $clientEmail = checkEmail($clientEmail);
      $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
      $passwordCheck = checkPassword($clientPassword);

      // Run basic checks, return if errors
      if (empty($clientEmail) || empty($passwordCheck)) {
         $message = '<p class="notice">Please provide a valid email address and password.</p>';
         include '../view/login.php';
         exit;
      }

      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if (!$hashCheck) {
         $message = '<p class="notice">Please check your password and try again.</p>';
         include '../view/login.php';
         exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;
   case 'register':
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      // check for duplicate email first
      $duplicateEmail = isDuplicateEmail($clientEmail);
      if ($duplicateEmail) {
         $message = "<p>An account with $clientEmail already exists. Try logging in or resetting your password. <span class='whoa'>(Normally would not confirm or deny existance of an email account!)</span></p>";
         include "$root/phpmotors/view/login.php";
         exit;
      }

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
         //cookie time!
         setcookie("firstName", $clientFirstname, strtotime("+1 year"), "/");

         $_SESSION['message'] = "<div>Thanks for registering $clientFirstname. Please use your email and password to login.</div>";

         header('Location: /phpmotors/accounts/?action=login');
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
