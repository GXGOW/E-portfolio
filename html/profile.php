<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] .'/'.basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Profiel</title>
</head>

<body>
<?php getMenu(); ?>
<div id="panel">
    <?php getHeader(); ?>
    <div id="main">
        <div id="content">
            <picture>
                <source srcset="../images/profile_full.jpg" media="(min-width: 480px)">
                <img src="../images/profile_mobile.jpg" alt="picture of myself"/></picture>
            <?php
            foreach ($translated as $key => $val) {
                switch ($key) {
                    case strpos($key, 'h'):
                        echo '<h3>' . $val . '</h3>';
                        break;
                    case strpos($key, 'p'):
                        echo '<p>' . $val . '</p>';
                        if ($key == 'p5') {
                            echo '<div class="cat">
                <picture>
                    <source srcset="../images/griffin_full.jpg" media="(min-width: 480px)">
                    <img src="../images/griffin_mobile.jpg" alt="griffin">
                </picture>
                <picture>
                    <source srcset="../images/sacha_full.jpg" media="(min-width: 480px)">
                    <img src="../images/sacha_mobile.jpg" alt="sacha">
                </picture>
            </div>
            <div class="cat">
                <picture>
                    <source srcset="../images/beau_full.jpg" media="(min-width: 480px)">
                    <img src="../images/beau_mobile.jpg" alt="beau">
                </picture>
                <picture>
                    <source srcset="../images/pooky_full.jpg" media="(min-width: 480px)">
                    <img src="../images/pooky_mobile.jpg" alt="pooky">
                </picture>
            </div>';
                        }
                        break;
                }
            }
            ?>
        </div>
    </div>
    <?php getFooter(); ?>
</div>
<?php getScripts(); ?>
</body>

</html>