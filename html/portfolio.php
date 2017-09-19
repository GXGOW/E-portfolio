<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
<div id="content">
    <div id="projects">
        <img id="left" src="../images/back.svg" />
        <div id="scroller">
            <?php 
        $projects=glob('../images/projects/*.*');
        $id=1;
        foreach ($projects as $img) {
            $alt = explode('.',explode('/',$img)[3])[0];
            echo '<figure><a id="'.$alt.'"><img src="'.$img.'" alt="'.$alt.'"></a></figure>';
            $id++;                    
        }
        ?>
        </div>
        <img id="right" src="../images/next.svg" />
    </div>
    <div id="description"><?php foreach ($translated['descr'] as $line) {
        echo'<p>'.$line.'</p>';
    }?> </div>
</div>