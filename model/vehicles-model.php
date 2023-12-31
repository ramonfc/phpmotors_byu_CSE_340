<?php
// Get the database connection file
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/library/connections.php';

/**
 * Vehicle PHP Motors Model
 */

/**
 *  Insert a new classification to the carclassifications table
 */
 function addClassification($classificationName)
 {
     // Create a connection object from the phpmotors connection function
     $db = phpmotorsConnect();
     // The SQL statement to be used with the database 
     $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';
     // The next line creates the prepared statement using the phpmotors connection      
     // Create the prepared statement using the phpmotors connection
     $stmt = $db->prepare($sql);
     // The next four lines replace the placeholders in the SQL
     // statement with the actual values in the variables
     // and tells the database the type of data it is
     $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
     // Insert the data
     $stmt->execute();
     // Ask how many rows changed as a result of our insert
     $rowsChanged = $stmt->rowCount();
     // Close the database interaction
     $stmt->closeCursor();
     // Return the indication of success (rows changed)
     return $rowsChanged;
 }


/**
 * Insert a new vehicle to the inventory table
 */
function addVehicle(
    $classificationId,
    $invMake,
    $invModel,
    $invDescription,
    $invImage,
    $invThumbnail,
    $invPrice,
    $invStock,
    $invColor
) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory (classificationId, invMake, invModel, invDescription,
    invImage, invThumbnail, invPrice, invStock, invColor) 
    VALUES (:classificationId, :invMake, :invModel, :invDescription,
    :invImage, :invThumbnail, :invPrice, :invStock, :invColor)';
    // The next line creates the prepared statement using the phpmotors connection      
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    // Insert the data
    $stmt->execute();
    // Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}




/**
 * Get vehicles by classificationId 
 */
function getInventoryByClassification($classificationId){ 
    $db = phpmotorsConnect(); 
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId'; 
    $stmt = $db->prepare($sql); 
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT); 
    $stmt->execute(); 
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    $stmt->closeCursor(); 
    return $inventory; 
   }




/**
 * Get vehicle information by invId
 */
function getInvItemInfo($invId){
    $db = phpmotorsConnect();
    // $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $sql = 'SELECT inv.invId, inv.invMake, inv.invModel, inv.invDescription, img.imgPath AS invImage, 
    inv.invPrice, inv.invStock, inv.invColor, inv.classificationId 
    FROM inventory AS inv 
    INNER JOIN images AS img 
    ON inv.invId = img.invId 
    WHERE inv.invId= :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
   }


/**
 * Update a vehicle in the inventory table
 */
function updateVehicle(
    $classificationId,
    $invMake,
    $invModel,
    $invDescription,
    $invImage,
    $invThumbnail,
    $invPrice,
    $invStock,
    $invColor,
    $invId
) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'UPDATE inventory SET invMake = :invMake, invModel = :invModel, 
	invDescription = :invDescription, invImage = :invImage, 
	invThumbnail = :invThumbnail, invPrice = :invPrice, 
	invStock = :invStock, invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';
    // The next line creates the prepared statement using the phpmotors connection      
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Update the data
    $stmt->execute();
    // Ask how many rows changed as a result of our update
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}


/**
 * Delete a vehicle in the inventory table
 */
function deleteVehicle($invId) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // The next line creates the prepared statement using the phpmotors connection      
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    // The next four lines replace the placeholders in the SQL
    // statement with the actual values in the variables
    // and tells the database the type of data it is   
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    // Update the data
    $stmt->execute();
    // Ask how many rows changed as a result of our update
    $rowsChanged = $stmt->rowCount();
    // Close the database interaction
    $stmt->closeCursor();
    // Return the indication of success (rows changed)
    return $rowsChanged;
}

// Get list of vehicles by classification name
function getVehiclesByClassification($classificationName){
    $db = phpmotorsConnect();
    $sql = 'SELECT inventory.invId, inventory.invMake, inventory.invModel, 
    inventory.invDescription, images.imgPath AS invThumbnail, 
    inventory.invPrice, 
    inventory.invStock, inventory.invColor, 
    inventory.classificationId FROM inventory INNER JOIN images ON inventory.invId = images.invId WHERE classificationId IN 
    (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName) 
    AND images.imgPath LIKE "%-tn%" AND images.imgPrimary = 1';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
   }


   /**
    * the function will obtain information about all vehicles in inventory
    */

    function getVehicles(){
        $db = phpmotorsConnect();
        $sql = 'SELECT invId, invMake, invModel FROM inventory';
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $invInfo;
    }