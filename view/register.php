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
                <input type="text" id="firstName" name="clientFirstname" required>

                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="clientLastname" required>

                <label for="emailRegister">Email Address:</label>
                <input type="email" id="emailRegister" name="clientEmail" required placeholder="Enter a valid email address">

                <label for="passwordRegister">Password:
                    <span class="info" 
                    title="Password must meet the following criteria:
                    - At least 8 characters
                    - At least one number
                    - At least one uppercase letter
                    - At least one lowercase letter
                    - At least one special character"
        >i</span>
                </label>
                <input type="password" id="passwordRegister" name="clientPassword" 
                pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
                title="Password must meet the criteria." 
                required>

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