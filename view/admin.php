<?php

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header('Location: /phpmotors/');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | PHP Motors</title>
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

        <main id="admin">
            <p>You are logged in.</p>

            <h1>
                <?php

                echo $_SESSION['clientData']['clientFirstname'] . " " . $_SESSION['clientData']['clientLastname'];

                ?>
            </h1>

            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }
            unset($_SESSION['message']);

            //messages about changing password:
            if (isset($messagePass)) {
                echo $messagePass;
            } else  if (isset($_SESSION['messagePass'])) {
                echo $_SESSION['messagePass'];
            }
            unset($_SESSION['messagePass']);
            ?>

         
            <ul>
                <?php

                echo "<li><b>First Name: </b>" . $_SESSION['clientData']['clientFirstname'] . "</li>";
                echo "<li><b>Last Name: </b>" . $_SESSION['clientData']['clientLastname'] . "</li>";
                echo "<li><b>Email: </b>" . $_SESSION['clientData']['clientEmail'] . "</li>";

                ?>

            </ul>


            <h2>Account Management</h2>
            <p>Use the following link to update account information.</p>
            <p>
                <a href='/phpmotors/accounts/?action=update' id='update_account_link' class="manage_btn_lk">
                    Update Account Information</a>
            </p>

            <?php

            if ($_SESSION['clientData']['clientLevel'] > 1) {
            ?>
                <h2>Inventory Management</h2>
                <p>Use the following link to manage the inventory.</p>
                <p>
                    <a href='/phpmotors/vehicles/' id='view_vechicles_link' class="manage_btn_lk">View Vehicle Management</a>
                </p>
            <?php
            }
            ?>




        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>