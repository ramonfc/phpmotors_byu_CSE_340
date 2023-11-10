<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) {
    header('Location: /phpmotors/');
    exit;
}


?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                echo "Delete $invInfo[invMake] $invInfo[invModel]";
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

        <main id="main_delete_vehicle">
            <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
                    echo "Delete $invInfo[invMake] $invInfo[invModel]";
                }  ?></h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <p>Confirm Vehicle Deletion. The delete is permanent.</p>

            <form action="/phpmotors/vehicles/index.php" method="post" id="form_delete_vehicle" class="form_data_car">

             
                <label for="invMake">Make</label>
                <input type="text" id="invMake" name="invMake" class="field_del" <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                }elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?> readonly>

                <label for="invModel">Model</label>
                <input type="text" id="invModel" name="invModel" class="field_del" <?php if (isset($invModel)) {
                                                                        echo "value='$invModel'";
                                                                    }elseif (isset($invInfo['invModel'])) {
                                                                        echo "value='$invInfo[invModel]'";
                                                                    } ?> readonly>

                <label for="invDescription">Description</label>
                <textarea id="invDescription" name="invDescription" class="field_del" readonly><?php if (isset($invDescription)) {
                                                                                    echo "$invDescription";
                                                                                }elseif (isset($invInfo['invDescription'])) {
                                                                                    echo $invInfo['invDescription'];
                                                                                } ?></textarea>

                <input type="submit" name="submit" value="Delete Vehicle">

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="deleteVehicle">
                <input type="hidden" name="invId" value="<?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                elseif(isset($invId)){ echo $invId; } ?>">
            </form>


        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>