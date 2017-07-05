<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
        <div id="content">
            <?php
            foreach ($translated as $portfolio) {
                echo '<div class="portfolio">';
                foreach ($portfolio as $key => $value) {
                    switch($key){
                        case ($key === 'description'):
                            echo '<div>';
                            foreach ($value as $paragraph){
                                echo '<p>' . $paragraph . '</p>';
                            }
                            echo '</div>';
                            break;
                        case ($key === 'figure1'):  echo '<figure><img src="../FeestBoek/images/logo_s.png" alt="Breaking Book logo"/>
                    <figcaption><a href="../FeestBoek/index.html" target="_blank">Breaking Book</a></figcaption></figure>';
                            break;
                        case ($key === 'figure2'):
                            echo '<figure><img src="../images/trump.png" alt="Our Lord and Führer Donald Trump"/>
                    <figcaption><a href="html/trump.php" target="_blank">Small loan of a million dollars</a></figcaption></figure>';
                            break;
                        case ($key === 'figure3'): echo '<figure><img src="../images/RedAlert.png" alt="Red Alert KLJ Hamme"/>
                    <figcaption><a href="http://www.red-alert.be" target="_blank">Red Alert</a></figcaption></figure>';
                            break;
                    }
                }
                echo '</div>';
            }
            ?>
        </div>