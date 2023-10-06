-- Query 1:
INSERT INTO clients (clientFirstName, clientLastName, clientEmail, clientPassword, comment) 
VALUES ("Tony", "Stark", "tony@starkent.com", "Iam1ronM@n", "I am the real Ironman");

-- Query 2:
UPDATE clients SET clientLevel= 3 WHERE clientId= 1;

-- Query 3:
UPDATE inventory SET invDescription= REPLACE(invDescription, "small interiors", "spacious interior") 
WHERE invDescription LIKE "%small interiors%";

-- Query 4:
SELECT inventory.invModel, carclassification.classificationName FROM inventory 
INNER JOIN carclassification ON carclassification.classificationId= inventory.classificationId 
AND carclassification.classificationId = 1;

-- Query 5:
DELETE FROM inventory WHERE invId=1;

-- Query 6:
UPDATE inventory SET invImage= concat("/phpmotors", invImage), invThumbnail= concat("/phpmotors", invImage);