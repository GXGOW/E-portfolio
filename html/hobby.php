<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
<div id="content">
    <?php
    foreach ($translated as $key => $value){
        switch($key)
        {
            case strpos($key, 'p'):
                echo '<p>'.$value.'</p>';break;
            case strpos($key, 'h'):
                echo '<h3>' . $value . '</h3>';
                break;
            case $key === 'video':
                echo '<div class="iframe">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/5ItHNdrPEh0?list=RD5ItHNdrPEh0"
                frameborder="0" allowfullscreen></iframe>
    </div>';break;
            case $key === 'image':
                echo '<picture><img src="../images/klj.jpg" alt="KLJ"></picture>';
                break;
        }
    }
    ?>
</div>