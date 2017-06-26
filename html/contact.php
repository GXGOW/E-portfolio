<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] .'/'.basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Contact</title>
</head>

<body>
<?php getMenu(); ?>
    <div id="panel">
        <?php getHeader(); ?>
        <div id="content">
            <?php
                echo '<form id="form" action="">
                        <label for="naam">'.$translated[0].'</label>
                        <input type="text" name="naam" placeholder="&#xf007;">

                        <label for="voornaam">'.$translated[1].'</label>
                        <input type="text" name="voornaam" placeholder="&#xf007;">

                        <label for="email">'.$translated[2].'</label>
                        <input type="email" name="email" placeholder="&#xf1fa;">

                        <label for="onderwerp">'.$translated[3].'</label>
                        <input type="text" name="onderwerp" placeholder="&#xf059;">

                        <label for="bericht">'.$translated[4].'</label>
                        <textarea name="bericht" placeholder="&#xf086;"></textarea>

                        <input type="submit" value="'.$translated[5].'">

                </form>';
              ?>
        </div>
        <?php getFooter(); ?>
    </div>
<?php getScripts(); ?>
</body>

</html>