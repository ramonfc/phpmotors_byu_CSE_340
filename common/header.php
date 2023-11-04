<div id="motors-header">
  <img src="/phpmotors/images/site/logo.png" alt="phpmotors logo" id="logo">
  <?php
  // if (isset($cookieFirstname)) {
  //   echo "<span class='welcome_cookie'>Welcome $cookieFirstname</span>";
  // }
  if (isset($_SESSION['loggedin'])) {
    echo "<a href='/phpmotors/accounts/?action=admin' class='header_link'>Welcome " . $_SESSION['clientData']['clientFirstname'] . "</a>";

    echo  "<a href='/phpmotors/accounts/?action=Logout' title='Logout' class='header_link header_link_right_space'>Logout</a>";
  } else {
    echo "<a href='/phpmotors/accounts/?action=deliverLoginView' title='my account' class='header_link header_link_right_space'>My Account</a>";
  }
  ?>
</div>