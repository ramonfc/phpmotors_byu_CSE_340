<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['clientData']['clientLevel'] == 1) {
    header('Location: /phpmotors/');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vehicle Management | PHP Motors</title>
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

        <main id="main_vehicle_management">
            <h1>Vehicle Management</h1>


            <div id="main_manage_btns">

                <a href="/phpmotors/vehicles/?action=deliverAddClassification" title="add car classification" class="btn_link">
                    Add Classification
                </a>


                <a href="/phpmotors/vehicles/?action=deliverAddVehicle" title="add vehicle" class="btn_link">
                    Add Vehicle
                </a>


            </div>

            <div id="modify_delete_car">
                <?php
                if (isset($message)) {
                    echo $message;
                }

                if (isset($classificationList)) {
                    echo '<h2>Vehicles By Classification</h2>';
                    echo '<label for="classificationList">Choose a classification to see those vehicles</label>';
                    echo $classificationList;
                }
                ?>

                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>

                <table id="inventoryDisplay"></table>
            </div>
        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
    <script src="../js/inventory.js"></script>
</body>

</html>