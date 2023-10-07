<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Template | PHP Motors</title>
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

    <main>
      <h1>Content Title Here</h1>
    </main>

    <hr>

    <footer>
      <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
    </footer>

  </div>
</body>

</html>