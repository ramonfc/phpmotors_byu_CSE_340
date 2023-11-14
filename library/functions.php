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
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$vehicle[invPrice]</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}