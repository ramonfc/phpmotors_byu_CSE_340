<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/accounts/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registration | PHP Motors</title>
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

        <main id="main_register">
            <h1>Register</h1>

            <?php
            if (isset($message)) {
                echo $message;
            }
            ?>

            <form action="/phpmotors/accounts/index.php" method="post" id="form_register">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="clientFirstname" >

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="clientLastname" >

                <label for="emailRegister">Email Address:</label>
                <input type="email" id="emailRegister" name="clientEmail" >

                <label for="passwordRegister">Password:</label>
                <input type="password" id="passwordRegister" name="clientPassword" >

                <button type="button" class="showPasswordButton">
                    <span class="iconLock">&#x1F513;</span>
                </button>

                <input type="submit" name="submit" value="Register">

                <!-- Add the action name - value pair -->
                <input type="hidden" name="action" value="register">
            </form>

        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>