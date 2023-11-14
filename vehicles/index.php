<?php

/**
 * Vehicles Controller
 */

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the vehicles model for use as needed
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';


// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
// $navList = '<nav id="page_nav">';
// $navList .= '<ul>';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//   $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';
// $navList .= '</nav>';
$navList = buildNavigationBar($classifications);

// echo $navList;
// exit;

// // Select list:
// $classificationList = '<select id="carClassificationSelect" name="carClassificationSelect">';
// $classificationList .= "<option value=''>Choose Car Classification</option>";
// foreach ($classifications as $classification) {
//   $classificationList .= "<option value=" . $classification['classificationId'] . ">" . $classification['classificationName'] . "</option>";
// }
// $classificationList .= '</select>';

// echo $classificationList;
// exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
  case 'deliverLoginView':
    // echo $action;
    // exit;
    include '../view/login.php';
    break;

  case 'deliverRegistrationView':
    include '../view/register.php';
    break;

  case 'register':
    // echo 'You are in the register case statement.';
    // Filter and store the data
    $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
    $clientLastname = filter_input(INPUT_POST, 'clientLastname');
    $clientEmail = filter_input(INPUT_POST, 'clientEmail');
    $clientPassword = filter_input(INPUT_POST, 'clientPassword');

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      $message = '<p class"message">Please provide information for all empty form fields.</p>';
      include '../view/register.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      $message = "<p class='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      include '../view/login.php';
      exit;
    } else {
      $message = "<p class='message'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
    }

    break;


  case 'deliverAddClassification': // add car classification
    include '../view/add-classification.php';
    exit;
    break;


  case 'deliverAddVehicle': // add vehicle
    include '../view/add-vehicle.php';
    exit;
    break;

  case 'add-class-form':
    // echo 'You are in the register case statement.';
    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $checkClassificationNameLength= limitTo30Chars($classificationName);
    // Check for missing data
    if (empty($classificationName) || empty($checkClassificationNameLength)) {
      $message = '<p class="message">Please provide information for all empty form fields.</p>';
      include '../view/add-classification.php';
      exit;
    }

    // Send the data to the model
    $regOutcome = addClassification($classificationName);

    // Check and report the result
    if ($regOutcome === 1) {
      header('Location: /phpmotors/vehicles');
      exit;
    } else {
      $message = "<p class='message'>Sorry, but the inserting failed. Please try again.</p>";
      include '../view/add-classification.php';
      exit;
    }
    break;


  case 'add-vehicle-form':
    // echo 'You are in the register case statement.';
    // Filter and store the data
    //$classificationName = filter_input(INPUT_POST, 'classificationName');

    $classificationId= trim(filter_input(INPUT_POST, 'carClassificationSelect', FILTER_SANITIZE_NUMBER_INT));
    $invMake= trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel= trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription= trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage= trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail= trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice= trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock= trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor= trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    // Check for missing data
    if (empty($classificationId )|| empty($invMake) || empty($invModel) || empty($invDescription)
    || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock)
    || empty($invColor)) {
      $message = '<p class="message">Please provide information for all empty form fields.</p>';
      include '../view/add-vehicle.php';
      exit;
    }

    // Send the data to the model
    $regOutcome =addVehicle(
      $classificationId,
      $invMake,
      $invModel,
      $invDescription,
      $invImage,
      $invThumbnail,
      $invPrice,
      $invStock,
      $invColor
  );

    // Check and report the result
    if ($regOutcome === 1) {
      $message = "<p class='message'>The $invMake $invModel was added successfully!</p>";
      include '../view/add-vehicle.php';
      exit;
    } else {
      $message = "<p class='message'>Sorry, but the inserting failed. Please try again.</p>";
      include '../view/add-classification.php';
      exit;
    }

    break;

    /* * ********************************** 
* Get vehicles by classificationId 
* Used for starting Update & Delete process 
* ********************************** */
  case 'getInventoryItems':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray);
    break;

  case 'mod':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    // print_r($invInfo);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    exit;
    break;

  case 'updateVehicle':
    $classificationId= trim(filter_input(INPUT_POST, 'carClassificationSelect', FILTER_SANITIZE_NUMBER_INT));
    $invMake= trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel= trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription= trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage= trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invThumbnail= trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invPrice= trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock= trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT));
    $invColor= trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || 
    empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<p class="message">Please complete all information for updating the item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
    }
    $updateResult = updateVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, 
    $invPrice, $invStock, $invColor, $invId);
    if ($updateResult) {
      $message = "<p class='message'>Congratulations, the $invMake $invModel was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
     } else {
      $message = "<p class='message'>Error. The $invMake $invModel vehicle was not updated.</p>";
      include '../view/vehicle-update.php';
      exit;
    }

    break;


  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    // print_r($invInfo);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-delete.php';
    exit;
    break;


  case 'deleteVehicle':
    $invMake= trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel= trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<p class='message'>Congratulations, the $invMake $invModel was successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
     } else {
      $message = "<p class='message'>Error. $invMake $invModel was not deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
    break;


  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    //$classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
    $vehicles = getVehiclesByClassification($classificationName);
    if (!count($vehicles)) {
      $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }
    // echo $vehicleDisplay;
    // exit;
    include '../view/classification.php';
    break;


  default:
  $classificationList = buildClassificationList($classifications);

    include '../view/vehicle-management.php';
    break;
}
