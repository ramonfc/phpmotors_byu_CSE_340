<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) {
    header('Location: /phpmotors/');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php';

            // Select list:
            $classificationList = '<select id="carClassificationSelect" name="carClassificationSelect">';
            $classificationList .= "<option value=''>Choose Car Classification</option>";
            foreach ($classifications as $classification) {
                $classificationList .= "<option value='$classification[classificationId]'";
                if (isset($classificationId)) {
                    if ($classification['classificationId'] == $classificationId) {
                        $classificationList .= ' selected ';
                    }
                } elseif (isset($invInfo['classificationId'])) {
                    if ($classification['classificationId'] == $invInfo['classificationId']) {
                        $classificationList .= ' selected ';
                    }
                }
                $classificationList .= ">$classification[classificationName]</option>";
            }
            $classificationList .= '</select>';


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } elseif (isset($invMake) && isset($invModel)) {
                echo "Modify $invMake $invModel";
            } ?> | PHP Motors</title>
    <!-- device-width is the width of the screen in CSS pixels -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- screen is used for computer screens, tablets, smart-phones etc. -->
    <link href="/phpmotors/css/style.css" type="text/css" rel="stylesheet" media="screen">
    <script src="/phpmotors/js/utils.js" defer></script>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
        </header>

        <nav>
            <?php echo $navList; ?>
        </nav>

        <main id="main_update_vehicle">
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Modify $invInfo[invMake] $invInfo[invModel]";
                } elseif (isset($invMake) && isset($invModel)) {
                    echo "Modify$invMake $invModel";
                } ?></h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/vehicles/index.php" method="post" id="form_update_vehicle" class="form_data_car">

                <label for="carClassificationSelect">Car Classification</label>
                <?php
                echo $classificationList;
                ?>

                <label for="invMake">Make</label>
                <input type="text" id="invMake" name="invMake" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?> required>

                <label for="invModel">Model</label>
                <input type="text" id="invModel" name="invModel" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    } elseif (isset($invInfo['invModel'])) {
                                                                        echo "value='$invInfo[invModel]'";
                                                                    } ?> required>

                <label for="invDescription">Description</label>
                <textarea id="invDescription" name="invDescription" required><?php if (isset($invDescription)) {
                                                                                    echo "$invDescription";
                                                                                } elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea>

                <label for="invImage">Image Path</label>
                <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png" <?php if (isset($invImage)) {
                                                                                                            echo "value='$invImage'";
                                                                                                        } elseif (isset($invInfo['invImage'])) {
                                                                                                            echo "value='$invInfo[invImage]'";
                                                                                                        } ?> required>

                <label for="invThumbnail">Thumbnail Path</label>
                <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png" <?php if (isset($invThumbnail)) {
                                                                                                                    echo "value='$invThumbnail'";
                                                                                                                } elseif (isset($invInfo['invThumbnail'])) {
                                                                                                                    echo "value='$invInfo[invThumbnail]'";
                                                                                                                } ?> required>

                <label for="invPrice">Price</label>
                <input type="text" id="invPrice" name="invPrice" <?php if (isset($invPrice)) {
                                                                        echo "value='$invPrice'";
                                                                    } elseif (isset($invInfo['invPrice'])) {
                                                                        echo "value='$invInfo[invPrice]'";
                                                                    } ?> required>

                <label for="invStock">Stock</label>
                <input type="text" id="invStock" name="invStock" <?php if (isset($invStock)) {
                                                                        echo "value='$invStock'";
                                                                    } elseif (isset($invInfo['invStock'])) {
                                                                        echo "value='$invInfo[invStock]'";
                                                                    } ?> required>

                <label for="invColor">Color</label>
                <input type="text" id="invColor" name="invColor" <?php if (isset($invColor)) {
                                                                        echo "value='$invColor'";
                                                                    } elseif (isset($invInfo['invColor'])) {
                                                                        echo "value='$invInfo[invColor]'";
                                                                    } ?> required>

                <input type="submit" name="submit" value="Update Vehicle">

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="updateVehicle">
            </form>


        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>