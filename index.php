<?php
include 'php/functions.php';
include 'locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Home</title>
</head>

<body>
<?php getMenu(); ?>
<div id="panel">
    <?php getHeader(); ?>
    <div id="main">

    </div>
    <?php getFooter() ?>
</div>
<?php getScripts(); ?>
</body>

</html>