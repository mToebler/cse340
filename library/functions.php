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
      $navList .= "<div><a href='/phpmotors/vehicles/index.php?action=viewClassification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></div>";
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
function getInventoryByClassification($classificationId)
{
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

function buildVehiclesDisplay($vehicles)
{
   $dv = '<ul id="inv-display">';
   foreach ($vehicles as $vehicle) {
      $price =  number_format($vehicle['invPrice']);
      $dv .= '<li>';
      $dv .= "<a href='/phpmotors/vehicles/?action=display&vehicleMake=$vehicle[invMake]&vehicleId=$vehicle[invId]'>";
      $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
      $dv .= "</a>";
      $dv .= '<hr>';
      $dv .= "<a href='/phpmotors/vehicles/?action=display&vehicleMake=$vehicle[invMake]&vehicleId=$vehicle[invId]'>";
      $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
      $dv .= "</a>";
      $dv .= "<span>$$price</span>";
      $dv .= '</li>';
   }
   $dv .= '</ul>';
   return $dv;
}

function buildVehicleDisplay($vehicle)
{
   // there should only be one record in vehicle as supplied
   // formatted price
   $formattedPrice = number_format($vehicle['invPrice']);
   $dv = "";
   $dv .= '<div class="vehicle_display">';
   $dv .= '<div class="vehicle_display_item">';
   $dv .= "<img src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
   $dv .= '</div>';
   $dv .= '<div class="vehicle_display_item">';
   $dv .= "<h2 >$vehicle[invMake] $vehicle[invModel] Details</h2>";
   // $dv .= "<p class='price'>&nbsp;Price: $$formattedPrice</p>";
   $dv .= "<span>$vehicle[invDescription]</span>";
   $dv .= "<div class='space_above'><p>This $vehicle[invModel] is this <span style='color: $vehicle[invColor];font-weight: bolder;'> Color</span>.</p></div>";
   $dv .= "<p class='price'>&nbsp;Price: $$formattedPrice</p>";
   $dv .= "<span># in Stock: $vehicle[invStock]</span>";
   $dv .= '</div>';
   $dv .= '</div>';
   $dv .= '<div class="vehicle_display_item">';

   $dv .= '</div>';

   return $dv;
}

/* * ********************************
*  Functions for working with images
* ********************************* */
// Adds "-tn" designation to file name
function makeThumbnailName($image)
{
   $i = strrpos($image, '.');
   $image_name = substr($image, 0, $i);
   $ext = substr($image, $i);
   $image = $image_name . '-tn' . $ext;
   return $image;
}

// Build images display for image management view
function buildImageDisplay($imageArray)
{
   $id = '<ul id="image-display">';
   foreach ($imageArray as $image) {
      $id .= '<li>';
      $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
      $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
      $id .= '</li>';
   }
   $id .= '</ul>';
   return $id;
}

// Build the vehicles select list
function buildVehiclesSelect($vehicles)
{
   $prodList = '<select name="invId" id="invId">';
   $prodList .= "<option>Choose a Vehicle</option>";
   foreach ($vehicles as $vehicle) {
      $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
   }
   $prodList .= '</select>';
   return $prodList;
}

// Handles the file upload process and returns the path
// The file path is stored into the database
function uploadFile($name)
{
   // Gets the paths, full and local directory
   global $image_dir, $image_dir_path;
   if (isset($_FILES[$name])) {
      // Gets the actual file name
      $filename = $_FILES[$name]['name'];
      if (empty($filename)) {
         return;
      }
      // Get the file from the temp folder on the server
      $source = $_FILES[$name]['tmp_name'];
      // Sets the new path - images folder in this directory
      $target = $image_dir_path . '/' . $filename;
      // Moves the file to the target folder
      move_uploaded_file($source, $target);
      // Send file for further processing
      processImage($image_dir_path, $filename);
      // Sets the path for the image for Database storage
      $filepath = $image_dir . '/' . $filename;
      // Returns the path where the file is stored
      return $filepath;
   }
}

// Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
   // Set up the variables
   $dir = $dir . '/';

   // Set up the image path
   $image_path = $dir . $filename;

   // Set up the thumbnail image path
   $image_path_tn = $dir . makeThumbnailName($filename);

   // Create a thumbnail image that's a maximum of 200 pixels square
   resizeImage($image_path, $image_path_tn, 200, 200);

   // Resize original to a maximum of 500 pixels square
   resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
{

   // Get image type
   $image_info = getimagesize($old_image_path);
   $image_type = $image_info[2];

   // Set up the function names
   switch ($image_type) {
      case IMAGETYPE_JPEG:
         $image_from_file = 'imagecreatefromjpeg';
         $image_to_file = 'imagejpeg';
         break;
      case IMAGETYPE_GIF:
         $image_from_file = 'imagecreatefromgif';
         $image_to_file = 'imagegif';
         break;
      case IMAGETYPE_PNG:
         $image_from_file = 'imagecreatefrompng';
         $image_to_file = 'imagepng';
         break;
      default:
         return;
   } // ends the swith

   // Get the old image and its height and width
   $old_image = $image_from_file($old_image_path);
   $old_width = imagesx($old_image);
   $old_height = imagesy($old_image);

   // Calculate height and width ratios
   $width_ratio = $old_width / $max_width;
   $height_ratio = $old_height / $max_height;

   // If image is larger than specified ratio, create the new image
   if ($width_ratio > 1 || $height_ratio > 1) {

      // Calculate height and width for the new image
      $ratio = max($width_ratio, $height_ratio);
      $new_height = round($old_height / $ratio);
      $new_width = round($old_width / $ratio);

      // Create the new image
      $new_image = imagecreatetruecolor($new_width, $new_height);

      // Set transparency according to image type
      if ($image_type == IMAGETYPE_GIF) {
         $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
         imagecolortransparent($new_image, $alpha);
      }

      if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
         imagealphablending($new_image, false);
         imagesavealpha($new_image, true);
      }

      // Copy old image to new image - this resizes the image
      $new_x = 0;
      $new_y = 0;
      $old_x = 0;
      $old_y = 0;
      imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

      // Write the new image to a new file
      $image_to_file($new_image, $new_image_path);
      // Free any memory associated with the new image
      imagedestroy($new_image);
   } else {
      // Write the old image to a new file
      $image_to_file($old_image, $new_image_path);
   }
   // Free any memory associated with the old image
   imagedestroy($old_image);
} // ends resizeImage function

function buildThumbsDisplay($thumbsArray)
{
   $thumbs = '';
   if ($thumbsArray != null) {
      $thumbs .= '<div class="vehicle_display">';
      foreach ($thumbsArray as $thumb) {
         $thumbs .= '<div class="vehicle_display_item"><img class="rollover_grow" src="' . $thumb["imgPath"] . '" alt=" Image for ' . $thumb["invMake"] . ' ' . $thumb["invModel"] . '"></div>';
      }
      $thumbs .= '</div>';
   }
   return $thumbs;
}
