<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
<div id="cv">
    <?php
    //Array opsplitsen in verschillende delen van de tabel
    foreach ($translated as $item) {
        //Begin tablepart
        echo '<div class="tablepart">';
        //Delen van tablepart overlopen
        foreach ($item as $keypart => $part) {
            //Header invoegen
            if ($keypart == 'h') {
                echo '<h3>' . $part . '</h3>';
            } else {
                //Begin tabel
                echo '<table>';
                //Delen tabel overlopen
                foreach ($part as $tablekey => $table) {
                    //Begin tablerow
                    echo '<tr>';
                    //Aangepaste rowspan invoegen volgens naamgeving
                    if (strpos($tablekey, '_r')) {
                        $rowspan = substr($tablekey, -1);
                        echo '<th rowspan="' . $rowspan . '">' . substr($tablekey, 0, -3) . '</th>
                                <td>' . $table . '</td>';
                    //Table definition zonder table header invoegen volgens naamgeving
                    } else if (strpos($tablekey, '_td') === 0) {
                        echo '<td>' . $table . '</td>';
                    //Normale table header + table definition combinatie invoegen
                    } else {
                        echo '<th>' . $tablekey . '</th><td>' . $table . '</td>';
                    }
                    //Einde tablerow
                    echo '</tr>';
                }
            }
            //Einde tabel
            echo '</table>';
        }
        //Einde tablepart
        echo '</div>';
    }
    ?>
</div>