<?php

if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Image Management | PHP Motors</title>
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
      echo $navList;
      ?>
    </nav>

    <main id="main_image_admin">
      <h1>Image Management</h1>

      <p>Choose one of the options below:</p>

      <h2>Add New Vehicle Image</h2>

      <?php
      if (isset($message)) {
        echo $message;
      } ?>

      <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
        <label for="invId">Vehicle</label>
        <?php echo $prodSelect; ?>
        <fieldset>
          <legend>Main image</legend>
          <span>Is this the main image for the vehicle?</span>
          <label for="priYes" class="pImage">Yes</label>
          <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
          <label for="priNo" class="pImage">No</label>
          <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
        </fieldset>
        <label for="file1">Upload Image:</label>
        <input type="file" name="file1" id="file1">
        <input type="submit" class="regbtn" value="Upload">
        <input type="hidden" name="action" value="upload">
      </form>

      <hr>

      <h2>Existing Images</h2>
      <p class="notification">If deleting an image, delete the thumbnail too and vice versa.</p>
      <?php
        if (isset($imageDisplay)) {
          echo $imageDisplay;
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
<?php unset($_SESSION['message']); ?>