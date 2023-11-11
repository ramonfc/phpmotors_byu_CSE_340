<?php
if (!isset($_SESSION['loggedin'])) {
  header('Location: /phpmotors/');
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Update Account Information | PHP Motors</title>
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
      <?php
      //include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" 
      echo $navList;
      ?>
    </nav>

    <main id="main_update">
      <h1>Manage Account</h1>

      <h2>Update Account</h2>

      <?php
      if (isset($message)) {
        echo $message;
      }elseif (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    unset($_SESSION['message']);
      ?>

      <form action="/phpmotors/accounts/index.php" method="post" id="form_update_info">
        <label for="firstNameUpdate">First Name: </label>
        <input type="text" id="firstNameUpdate" name="clientFirstname" required <?php if (isset($clientFirstname)) {
                                                                                  echo "value='$clientFirstname'";
                                                                                } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                  echo  "value='" . $_SESSION['clientData']['clientFirstname'] . "'";
                                                                                }
                                                                                ?>>

        <label for="lastNameUpdate">Last Name:</label>
        <input type="text" id="lastNameUpdate" name="clientLastname" required <?php if (isset($clientLastname)) {
                                                                                echo "value='$clientLastname'";
                                                                              } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                                echo "value='" . $_SESSION['clientData']['clientLastname'] . "'";
                                                                              } ?>>

        <label for="emailUpdate">Email Address:</label>
        <input type="email" id="emailUpdate" name="clientEmail" required <?php if (isset($clientEmail)) {
                                                                            echo "value='$clientEmail'";
                                                                          } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                            echo "value='" . $_SESSION['clientData']['clientEmail'] . "'";
                                                                          } ?>>

        <input type="submit" name="submit" value="Update Info">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="updateInfoClient">
        <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                      echo $_SESSION['clientData']['clientId'];
                                                    } elseif (isset($clientId)) {
                                                      echo $clientId;
                                                    } ?>">
      </form>



      <h2>Update Password</h2>

      <?php
      if (isset($messagePass)) {
        echo $messagePass;
      }else  if (isset($_SESSION['messagePass'])) {
        echo $_SESSION['messagePass'];
    }
    unset($_SESSION['messagePass']);
      ?>

      <form action="/phpmotors/accounts/index.php" method="post" id="form_update_pass">

        <label for="passwordUpdate">New Password:
          <span class="info" title="By entering a password it will change the current password.
          Password must meet the following criteria:
                    - At least 8 characters
                    - At least one number
                    - At least one uppercase letter
                    - At least one special character">i</span>
        </label>
        <input type="password" id="passwordUpdate" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z]).*$" title="Password must meet the criteria." required>

        <button type="button" class="showPasswordButton">
          <span class="iconLock">&#x1F513;</span>
        </button>

        <input type="submit" name="submit" value="Update Password">

        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="updatePassword">
        <input type="hidden" name="clientId" value="<?php if (isset($_SESSION['clientData']['clientId'])) {
                                                      echo $_SESSION['clientData']['clientId'];
                                                    } elseif (isset($clientId)) {
                                                      echo $clientId;
                                                    } ?>">
      </form>




    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>
</body>

</html>