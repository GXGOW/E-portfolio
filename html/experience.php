<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
    <div id="content">
        <?php foreach ($translated as $p) {
            echo '<p>'.$p.'</p>';
        } ?>
        <ul id="expList">
            <li><a id="disc">DISC-test</a></li>
            <li><a id="cyber">Lezing: The basics of Cyber Security</a></li>
            <li><a id="myers">Myers-Briggs type indicator</a></li>
            <li><a id="enneagram">Enneagram-test</a></li>
            <li><a id="cebit">CeBIT: beursverslag</a></li>
        </ul>

        <div id="loader">

        </div>
    </div>