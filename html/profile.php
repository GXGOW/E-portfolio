<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
        <div id="content">
            <picture>
                <img src="../images/profile.jpg" alt="Mezelf"/></picture>
            <?php
            foreach ($translated as $key => $val) {
                switch ($key) {
                    case strpos($key, 'h'):
                        echo '<h3>' . $val . '</h3>';
                        break;
                    case strpos($key, 'p'):
                        echo '<p>' . $val . '</p>';
                        if ($key == 'p5') {
                            echo '<div id="row">' .
                                getImages('../images/cats', false) . '</div>';
                        }
                        break;
                }
            }
            ?>
        </div>