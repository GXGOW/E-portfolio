<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Trump</title>
</head>

<body>
<?php getMenu(); ?>
    <div id="panel">
        <?php getHeader(); ?>
        <div id="main">
        <div id="content">
            <p><?php echo $translated['p1'] ?></p>
            <picture>
                <a href="#"><img src="../images/sadtrump.jpg" id="trump" alt="Mad Trump" /></a>
            </picture>
            <p><?php echo $translated['p2'] ?></p>
            <audio id="audio" src="" />
        </div>
        </div>
        <?php getFooter(); ?>
    </div>
<?php getScripts(); ?>
<script src="../dist/trump.min.js"></script>
</body>

</html>