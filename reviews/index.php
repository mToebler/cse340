<?php
// REVIEWS CONTROLLER
// Create or access a Session
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once "$root/phpmotors/library/connections.php";
require_once "$root/phpmotors/library/functions.php";
require_once "$root/phpmotors/model/main-model.php";
require_once "$root/phpmotors/model/reviews-model.php";
require_once "$root/phpmotors/model/review-entity.php";

// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

$navList = buildNav($classifications);
// echo $navList;
// exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
   $action = filter_input(INPUT_GET, 'action');
}



switch ($action) {
   case 'post':   // create
      // var_dump($_SESSION['clientdata']); exit;
      $invId = trim(filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT));
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_NUMBER_INT));
      $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
      $clientId;
      if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin']) {
         // need to get client id from session rather than form. Also client review name.
         // $clientId = $_SESSION['clientdata']['clientId'];
         $clientData = $_SESSION['clientData'];
         $clientId = $clientData['clientId'];

         if (empty($reviewText) || $clientId == null) {
            $_SESSION['message'] = '<p>Please submit an actual review</p>';
            header("Location: /phpmotors/vehicles/?action=display&vehicleMake=$invMake&vehicleId=$invId&ismessage=1");
            break;
         }
         $review = new Review($reviewText, $invId, $clientId);
         $result = insertReview($review);

         if ($result === 1) {
            $_SESSION['message'] = "<div><p>Review added.</p></div>";
            //clearing out all variables:            
            unset($reviewText);
            header("Location: /phpmotors/vehicles/index.php?action=display&vehicleMake=$invMake&vehicleId=$invId&ismessage=1");
            exit;
         }
      } else {
         $_SESSION['message'] = '<p>You must be <a href="../?action=Login">logged</a> in to submit a review.</p>';
         header("Location: /phpmotors/vehicles/?action=display&vehicleMake=$invMake&vehicleId=$invId&ismessage=1");
         break;
      }
      break;

   case 'manage':   // manage reviews
      if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin']) {
         $clientData = $_SESSION['clientData'];
         $clientId = $clientData['clientId'];

         $userreviews = getUserReviews($clientId);
         $displayReviews = buildReviewsDisplayForUser($userreviews);
         include "$root/phpmotors/view/reviews-management.php";
         break;
      } else {
         error_log('redirecting to vehicles. not logged in');
         $_SESSION['message'] = '<p>You must be <a href="../?action=Login">logged in</a> to manage reviews.</p>';
         header("Location: /phpmotors/vehicles/?action=display&ismessage=1");
         break;
      }
      break;

   case 'del': // delete review
      $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin']) {
         $clientData = $_SESSION['clientData'];
         $clientId = $clientData['clientId'];
         // only the owner or admin can delete review
         $deleteResult = deleteReview($reviewId, $clientId);
         // Check and report the result
         if ($deleteResult === 1) {
            $message = "<div><p>Review deleted.</p></div>";
         } else {
            $message = "<p>Review could not be deleted.</p>";
         }
         $userreviews = getUserReviews($clientId);
         $displayReviews = buildReviewsDisplayForUser($userreviews);
         include "$root/phpmotors/view/reviews-management.php";
         exit;
      } else {
         error_log('redirecting to vehicles. not logged in');
         $_SESSION['message'] = '<p>You must be <a href="../?action=Login">logged in</a> to manage reviews.</p>';
         header("Location: /phpmotors/vehicles/?action=display&ismessage=1");
         exit;
      }
      break;

   case 'mod':
      $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
      $reviewInfo = getReview($reviewId);
      if (count($reviewInfo) < 1) {
         $message = 'Sorry, no review found.';
      }
      include "$root/phpmotors/view/review.php";
      exit;
      break;

   case 'updateReview':
      $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
      $reviewText = trim(filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING));
      if (key_exists('loggedin', $_SESSION) && $_SESSION['loggedin']) {
         $clientData = $_SESSION['clientData'];
         $clientId = $clientData['clientId'];
         // only the owner or admin can delete review
         // echo $reviewId . ' : ' . $clientId . ' : ' . $reviewText; exit;
         $result = updateReview($reviewId, $reviewText, $clientId);
         // Check and report the result
         if ($result === 1) {
            $message = "<div><p>Review modified.</p></div>";
         } else {
            $message = "<p>Review could not be modified.</p>";
         }
         $userreviews = getUserReviews($clientId);
         $displayReviews = buildReviewsDisplayForUser($userreviews);
         include "$root/phpmotors/view/reviews-management.php";
         exit;
      } else {
         error_log('redirecting to vehicles. not logged in');
         $_SESSION['message'] = '<p>You must be <a href="../?action=Login">logged in</a> to manage reviews.</p>';
         header("Location: /phpmotors/vehicles/?action=display&ismessage=1");
         exit;
      }
      break;

      /* * ********************************** 
   * Get vehicles by classificationId 
   * Used for starting Update & Delete process 
   * ********************************** */
   case 'getReview':
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId);
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray);
      break;
   case 'updateReview':
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
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


      if (
         empty($invMake) || empty($invModel) || empty($invDescription) ||
         empty($invImage) || empty($invThumbnail) || empty($invPrice) ||
         empty($invStock) || !$colorMatch || !$classIdMatch
      ) {
         $message = '<p>All fields require valid values</p>';
         include "$root/phpmotors/view/vehicleUpdate.php";
         exit;
      }
      $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
      // Check and report the result

      if ($updateResult === 1) {
         $message = "<div><p>$invMake $invModel updated.</p></div>";
         $_SESSION['message'] =  $message;
         header("Location: /phpmotors/vehicles/");
         exit;
      } else {
         $message = "<p>Sorry, $invMake $invModel was not updated. Please try again.</p>";
         include "$root/phpmotors/view/vehicleUpdate.php";
         exit;
      }
      break;
   case 'delConfirm':
      $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
         $message = 'Sorry, no vehicle information could be found.';
      }
      include "$root/phpmotors/view/vehicleDelete.php";
      exit;
      break;
   case 'deleteReview':
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING));
      $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING));

      //NOTE: Custom validation functions
      $colorMatch = checkColor($invColor);
      $classIdMatch = isPropertyInArray($classificationId, "classificationId", $classifications);

      $deleteResult = deleteVehicle($invId);
      // Check and report the result

      if ($deleteResult === 1) {
         $message = "<div><p>$invMake $invModel deleted.</p></div>";
         $_SESSION['message'] =  $message;
         header("Location: /phpmotors/vehicles/");
         exit;
      } else {
         $message = "<p>$invMake $invModel NOT deleted.</p>";
         $_SESSION['message'] =  $message;
         header("Location: /phpmotors/vehicles/");
         exit;
      }
      break;

   case 'display':
      $invMake = filter_input(INPUT_GET, 'vehicleMake', FILTER_SANITIZE_STRING);
      $invId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
      $vehicle = getVehicleByMakeAndId($invMake, $invId);
      $thumbsArray = getThumbsById($invId);
      // var_dump($vehicle);
      if (!count($vehicle)) {
         $message = "<p class='notice'>Sorry, no $invMake vehicle like that could be found.</p>";
      } else {
         $vehicleDisplay = buildVehicleDisplay($vehicle[0]);

         $thumbsDisplay = buildThumbsDisplay($thumbsArray);
         // echo $thumbsDisplay;
         // exit;
      }

      include '../view/viewInventory.php';
      break;


   default:
      $classificationList = buildClassificationList($classifications);
      include "$root/phpmotors/view/reviews-management.php";
      break;
}
