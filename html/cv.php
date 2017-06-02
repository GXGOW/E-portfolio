<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>CV</title>
</head>

<body>
<?php getMenu(); ?>
<div id="panel">
    <?php getHeader(); ?>
    <div id="main">
        <div id="cv">
            <?php
            //Die tabellen invoegen was nog wel knap lastig
            foreach ($translated as $item) {
                echo '<div class="tablepart">';
                foreach ($item as $keypart => $part) {
                    if ($keypart == 'h') {
                        echo '<h3>' . $part . '</h3>';
                    } else {
                        echo '<table>';
                        foreach ($part as $tablekey => $table) {
                            echo '<tr>';
                            if (strpos($tablekey, '_r')) {
                                $rowspan = substr($tablekey, -1);
                                echo '<th rowspan="' . $rowspan . '">' . substr($tablekey, 0, -3) . '</th>
                                        <td>' . $table . '</td>';
                            } else if (strpos($tablekey, '_td') === 0) {
                                echo '<td>' . $table . '</td>';
                            } else {
                                echo '<th>' . $tablekey . '</th><td>' . $table . '</td>';
                            }
                            echo '</tr>';
                        }
                    }
                    echo '</table>';
                }
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <?php getFooter(); ?>

</div>
<?php getScripts(); ?>

</body>

</html>