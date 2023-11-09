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
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
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