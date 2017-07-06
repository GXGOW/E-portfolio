<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] .'/'.basename($_SERVER["PHP_SELF"]);
global $translated; ?>
        <div id="content">
            <?php
            //TODO Functionaliteit achter die knop steken
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
