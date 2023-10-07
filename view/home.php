<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/index.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home | PHP Motors</title>
    <!-- device-width is the width of the screen in CSS pixels -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- screen is used for computer screens, tablets, smart-phones etc. -->
    <link href="./css/style.css" type="text/css" rel="stylesheet" media="screen">
    <script src="./js/utils.js" defer></script>
</head>

<body>
    <div id="wrapper">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/header.php" ?>
        </header>

        <nav aria-label="Menu">        
            <?php 
            // include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/nav.php" 
            echo $navList; 
            ?>
        </nav>

        <main id="main_home">
            <h1>Welcome to PHP Motors!</h1>

            <article id="article_dmc_delorean">
                <div>
                    <h2>DMC Delorean</h2>
                    <p>3 Cup holders</p>
                    <p>Superman doors</p>
                    <p>Fuzzy dice!</p>
                </div>

                <img src="/phpmotors/images/delorean.jpg" alt="delorean" id="delorean">

                <button id="btn_own">Own Today</button>
            </article>



            <article id="article_delorean_reviews">
                <h2>DMC Delorean Reviews</h2>
                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly." (5/5)</li>
                    <li>"The most futuristic ride of our day." (4.5/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </article>


            <section id="section_delorean_upgrades">
                <h2>Delorean Upgrades</h2>
                <div id="figures">
                    <figure>
                        <img src="/phpmotors/images/upgrades/flux-cap.png" alt="flux capacitor" id="flux_cap">
                        <figcaption> <a href="#">Flux Capacitor</a></figcaption>
                    </figure>

                    <figure>
                        <img src="/phpmotors/images/upgrades/flame.jpg" alt="flame decals" id="flame">
                        <figcaption><a href="#">Flame Decals</a></figcaption>
                    </figure>

                    <figure>
                        <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper stickers" id="bumper_sticker">
                        <figcaption><a href="#">Bumper Stickers</a></figcaption>
                    </figure>

                    <figure>
                        <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub caps" id="hub_cap">
                        <figcaption><a href="#">Hub Caps</a></figcaption>
                    </figure>
                </div>
            </section>
        </main>

        <hr>

        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . "/phpmotors/common/footer.php" ?>
        </footer>

    </div>
</body>

</html>
