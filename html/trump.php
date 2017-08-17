<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../images/trumpface.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <meta name="theme-color" content="#187ab2">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#187ab2">
    <link href="../build/trump/trump.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
    <title>Trump</title>
</head>

<body>
<div id="center">
            <p><?php echo $translated['p1'] ?></p>
    <img src="../images/sadtrump.jpg" id="trump" alt="Mad Trump"/>
            <audio id="audio" src="" />
        </div>
<script src="../build/trump/trump.js"></script>
</body>
</html>