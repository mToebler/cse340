<?php
// Create or access a Session
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/model/main-model.php";

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = '';
$navList .= "<div><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></div>";
foreach ($classifications as $classification) {
   $navList .= "<div><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></div>";
}
$navList .= '';

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
