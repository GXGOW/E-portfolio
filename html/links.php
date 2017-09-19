<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] .'/'.basename($_SERVER["PHP_SELF"]);?>
<div id="content">
    <p><?php echo $translated[0]; ?></p>
    <div id="links">
        <p><a href="http://www.stackoverflow.com" target="_blank">Stack Overflow</a></p>
        <p><a href="http://www.hogent.be" target="_blank">HoGent</a></p>
        <p><a href="http://www.reddit.com" target="_blank">Reddit</a></p>
        <p><a href="http://www.w3schools.com" target="_blank">W3Schools</a></p>
        <p><a href="http://www.demorgen.be" target="_blank">De Morgen</a></p>
        <p><a href="http://www.xda-developers.com" target="_blank">XDA-Developers</a></p>
        <p><a href="http://www.findtheinvisiblecow.com/" target="_blank">Find the invisible cow</a></p>
    </div>
</div>