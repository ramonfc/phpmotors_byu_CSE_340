<?php

/**
 *  It will be one of two values: 1) The actual email address will be returned 
 * if it is judged to be "valid", or 2) NULL - indicating the email does not 
 * appear to be a valid address.
 */
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}

/**
 * Check the password for at least 8 characters, 
 * at least 1 capital letter, at least 1 number and at least 1 special character.
 * The function returns "1" if the two match or "0" if they don't.
 */
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}

/**
 * Check the classification name length to be up 30 characters.
 * The function returns "1" if the two match or "0" if they don't.
 */
function limitTo30Chars($classificationName)
{
    $pattern = '/^.{1,30}$/';
    return preg_match($pattern, $classificationName);
}

/**
 * Build a navigation bar using the $classifications array
 * Returns a string with the HTML code for navigation bar.
 */
function buildNavigationBar($classifications)
{

    $navList = '<nav id="page_nav">';
    $navList .= '<ul>';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li>
        <a href='/phpmotors/vehicles/?action=classification&classificationName="
        . urlencode($classification['classificationName']) .
            "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a>    
        </li>";
    }
    $navList .= '</ul>';
    $navList .= '</nav>';
    return $navList;
}


// Build the classifications select list 
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


// Wrap vehicles by classification in a list
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicles&invId=".urlencode($vehicle['invId'])."' title='View $vehicle[invModel] car'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='$vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= "</a>";
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicles&invId=".urlencode($vehicle['invId'])."' title='View $vehicle[invModel] car'>";
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "</a>";
        $dv .= "<span>$".number_format($vehicle['invPrice'])."</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

/**
 * take the specific vehicle's information and wrap it up in HTML to deliver to the view
 */
function buildSingleVehicleDisplay($vehicle){
    $sv = '<section id="single-vehicle">';
    $sv .= "<img src='$vehicle[invImage]' alt='$vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $sv .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
    $sv .= "<p>$vehicle[invDescription]</p>";
    $sv .= "<p><b>Color:</b> $vehicle[invColor]</p>";
    $sv .= "<p><b>Quantity in Stock:</b> $vehicle[invStock]</p>";
    $sv .= "<p><b>Price: $".number_format($vehicle['invPrice'])."</b></p>";
    $sv .= '</section>';
    return $sv;
  }

function buildThumbnailDisplay($vehicle, $allThumbnails){
$thd = "<section id='thumbnail-display'><h3>$vehicle[invMake] $vehicle[invModel] images</h3><ul>";
foreach ($allThumbnails as $allThumbnail){
    $thd .= "<li><img src='$allThumbnail[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></li>";
}
$thd .= '</ul></section>';
return $thd;
}
  
/* * ********************************
*  Functions for working with images
* ********************************* */

// Adds "-tn" designation to file name
function makeThumbnailName($image) {
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
   }

// Build images display for image management view
function buildImageDisplay($imageArray) {
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
function buildVehiclesSelect($vehicles) {
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
function uploadFile($name) {
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
function processImage($dir, $filename) {
    // Set up the variables
    $dir = $dir . '/';
   
    // Set up the image path
    $image_path = $dir . $filename;
   
    // Set up the thumbnail image path
    $image_path_tn = $dir.makeThumbnailName($filename);
   
    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);
   
    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
   }


// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
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