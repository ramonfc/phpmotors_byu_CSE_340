<?php

/**
 * Vehicles Controller
 */

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the vehicles model for use as needed
require_once '../model/vehicles-model.php';


// Get the array of classifications
$classifications = getClassifications();

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
$navList = '<nav id="page_nav">';
$navList .= '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';
$navList .= '</nav>';

// echo $navList;
// exit;


$classificationList = '<select id="carClassificationSelect" name="carClassificationSelect">';
$classificationList .= "<option value=''>Choose Car Classification</option>";
foreach ($classifications as $classification) {
  $classificationList .= "<option value=" . $classification['classificationId'] . ">" . $classification['classificationName'] . "</option>";
}
$classificationList .= '</select>';

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
    $classificationName = filter_input(INPUT_POST, 'classificationName');
    // Check for missing data
    if (empty($classificationName)) {
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

    $classificationId= filter_input(INPUT_POST, 'carClassificationSelect');
    $invMake= filter_input(INPUT_POST, 'invMake');
    $invModel= filter_input(INPUT_POST, 'invModel');
    $invDescription= filter_input(INPUT_POST, 'invDescription');
    $invImage= filter_input(INPUT_POST, 'invImage');
    $invThumbnail= filter_input(INPUT_POST, 'invPrice');
    $invPrice= filter_input(INPUT_POST, 'invPrice');
    $invStock= filter_input(INPUT_POST, 'invStock');
    $invColor= filter_input(INPUT_POST, 'invColor');
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


  default:
    include '../view/vehicle-management.php';
    break;
}