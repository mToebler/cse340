<?php
// Create or access a Session

/// NOTE: HEROKU: need to do environment vars for database connection. 
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
$envTest = getenv('REMOTE');
if(!$envTest) {
   $root = "/Applications/XAMPP/xamppfiles/htdocs/phpmotors";
}
var_dump($root);
var_dump($envTest);
//exit;
require_once "$root/library/connections.php";
require_once "$root/library/functions.php";
require_once "$root/model/main-model.php";
// require_once "$root/phpmotors/library/connections.php";
// require_once "$root/phpmotors/library/functions.php";
// require_once "$root/phpmotors/model/main-model.php";

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
      include 'view/registration.php';
      break;
   case 'login':
      include 'view/login.php';
      break;

   default:
      include 'view/home.php';
}
