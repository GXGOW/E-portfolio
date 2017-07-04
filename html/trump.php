<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" sizes="512x512" href="images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <!-- Android Chrome colored statusbar -->
    <meta name="theme-color" content="#187ab2">
    <!-- iOS colored statusbar -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#187ab2">
    <link href="../build/trump.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
    <title>Trump</title>
</head>

<body>
<div id="center">
            <p><?php echo $translated['p1'] ?></p>
    <img src="../images/sadtrump.jpg" id="trump" alt="Mad Trump"/>
            <audio id="audio" src="" />
        </div>
<?php getScripts(); ?>
</body>

</html>