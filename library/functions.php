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
function checkPassword($clientPassword){
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
   }