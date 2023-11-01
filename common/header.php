<div id="motors-header">
  <img src="/phpmotors/images/site/logo.png" alt="phpmotors logo" id="logo">
  <?php
  if (isset($cookieFirstname)) {
    echo "<span class='welcome_cookie'>Welcome $cookieFirstname</span>";
  }
  ?>
  <a href="/phpmotors/accounts/?action=deliverLoginView" title="my account" id="my-account">
    My Account
  </a>
</div>