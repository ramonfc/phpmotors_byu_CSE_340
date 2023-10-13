<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Vehicle | PHP Motors</title>
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

        <main id="main_add_vehicle">
            <h1>Add Vehicle</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/vehicles/index.php" method="post" id="form_add_vehicle">

                <label for="carClassificationSelect">Car Classification</label>
                <?php
                echo $classificationList;
                ?>

                <label for="invMake">Make</label>
                <input type="text" id="invMake" name="invMake">

                <label for="invModel">Model</label>
                <input type="text" id="invModel" name="invModel">

                <label for="invDescription">Description</label>
                <textarea id="invDescription" name="invDescription"></textarea>

                <label for="invImage">Image Path</label>
                <input type="text" id="invImage" name="invImage" value="/phpmotors/images/no-image.png">

                <label for="invThumbnail">Thumbnail Path</label>
                <input type="text" id="invThumbnail" name="invThumbnail" value="/phpmotors/images/no-image.png">

                <label for="invPrice">Price</label>
                <input type="text" id="invPrice" name="invPrice">

                <label for="invStock">Stock</label>
                <input type="text" id="invStock" name="invStock">

                <label for="invColor">Color</label>
                <input type="text" id="invColor" name="invColor">

                <input type="submit" value="Add Vehicle">

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="add-vehicle-form">
            </form>


        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>