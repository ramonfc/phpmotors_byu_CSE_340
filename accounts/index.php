<?php

/**
 * Accounts Controller
 */

// Create or access a Session
session_start();

// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';
// Get the PHP Motors model for use as needed
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/main-model.php';
// Get the accounts model for use as needed
// require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/model/accounts  -model.php';
require_once '../model/accounts-model.php';
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

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

$clientFirstname = filter_input(INPUT_POST, 'firstName');
echo $clientFirstname;

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
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    //check for existing email:
    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if ($existingEmail) {
      $message = '<p class="message">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      // $message = '<p class="message">Please provide information for all empty form fields.</p>';
      $_SESSION['message'] = "Please provide information for all empty form fields.";
      include '../view/register.php';
      exit;
    }

    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      //ORIGINAL:
      // $message = "<p class='message'>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
      // include '../view/login.php';
      header('Location: /phpmotors/accounts/?action=deliverLoginView');

      exit;
    } else {
      $message = "<p class='message'>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/register.php';
      exit;
    }

    break;

  case 'login':
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    // Check for missing data
    if (empty($clientEmail) || empty($checkPassword)) {
      // $message = '<p class="message">Please provide a valid email address and password.</p>';
      $_SESSION['message'] = "Please provide a valid email address and password.";
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
      // $message = '<p class="message">Please check your password and try again.</p>';
      $_SESSION['message'] = "Please check your password and try again.";
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;

    if(!isset($_SESSION['loggedin'])){
      // do something here if the value is FALSE
      // The exclamation mark is a "negation" operator
      // By adding it the resulting test is reversed
      // This test is now "If Session loggedin value is NOT true"
      $message = '<p class="message">Something was wrong. Try again.</p>';
      include '../view/login.php';
      exit;
     }
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view:
    // include '../view/admin.php';
    header('Location: /phpmotors/accounts'); //using this header because clicking go back on browser 
    exit;                                   //from vehicle-management to admin, appears a Confirm Form Resubmission

  // case "vehiclesView":
  //   // include '../vehicles/index.php';
  //   header('Location: /phpmotors/vehicles');
  //   exit;
 

  case "Logout":
    unset($_SESSION['clientData']);
    session_destroy();
    header('Location: /phpmotors/');
    exit;

  default:
    include '../view/admin.php';
    exit;
    break;
}
