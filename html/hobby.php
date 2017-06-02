<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Bezigheden</title>
</head>

<body>
<?php getMenu(); ?>

<div id="panel">
    <?php getHeader(); ?>

    <div id="main">
        <div id="content">
            <?php
            foreach ($translated as $key => $value){
                switch($key)
                {
                    case strpos($key, 'p'):
                        echo '<p>'.$value.'</p>';break;
                    case strpos($key, 'h'):
                        echo '<h3 id="'.$value[0].'">'.$value[1].'</h3>';break;
                    case $key === 'ul':
                        echo '<div id="inhoud"><ul>';
                        foreach ($value as $listkey => $listvalue){
                            echo '<li><a href="'.$listkey.'">'.$listvalue.'</a></li>';
                        }
                        echo '</ul></div>';
                        break;
                    case $key === 'video':
                        echo '<div class="iframe">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/5ItHNdrPEh0?list=RD5ItHNdrPEh0"
                        frameborder="0" allowfullscreen></iframe>
            </div>';break;
                    case $key === 'image':
                        echo '<a href="../images/klj_full.jpg" target="_blank">
                <picture>
                    <source srcset="../images/klj_tab.jpg" media="(min-width: 480px)">
                    <img src="../images/klj_mobile.jpg" alt="KLJ">
                </picture>
            </a>';break;

                }
            }
            ?>
        </div>
    </div>
    <?php getFooter(); ?>
</div>

<?php getScripts(); ?>
</body>

</html>