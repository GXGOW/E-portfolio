<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/04/2017
 * Time: 13:03
 */
session_start();
ob_start();
if (!isset($_SESSION['lang'])) {
    setLang("nl_BE");
}
$prefix1;
$prefix2;
if ((basename($_SERVER["PHP_SELF"])) === "index.php") {
    $prefix1 = "";
    $prefix2 = "html/";
} else {
    $prefix1 = "../";
    $prefix2 = "";
}

function getHead()
{
    global $prefix1;
    echo '<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <!-- Android Chrome colored statusbar -->
    <meta name="theme-color" content="#187ab2">
    <!-- iOS colored statusbar -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#187ab2">

    <link href="' . $prefix1 . 'dist/reset_browser_styles.css" rel="stylesheet"/>
    <link href="' . $prefix1 . 'dist/styles.css" rel="stylesheet"/>
    <link href=\'http://fonts.googleapis.com/css?family=Source+Code+Pro:200,300\' rel=\'stylesheet\' type=\'text/css\'>';
}

function getScripts()
{
    global $prefix1;
    echo '<script src="' . $prefix1 . 'dist/slideout.min.js"></script>
    <script src="'.$prefix1.'node_modules/jquery/dist/jquery.min.js"></script>
    <script src="'.$prefix1.'dist/functions.min.js"></script>';
}

function getMenu()
{
    global $prefix1, $prefix2, $transmenu;
    include $prefix1.'locale/'.$_SESSION['lang'].'/menu.php';
    echo
        '<nav id="menu">
    <header>
        <h2>Index</h2>
        <ul>
            <li><a href="' . $prefix1 . 'index.php"><i class="fa fa-home" aria-hidden="true"></i> '.$transmenu[0].'</a></li>
            <li><a href="' . $prefix2 . 'profile.php"><i class="fa fa-male" aria-hidden="true"></i> '.$transmenu[1].'</a></li>
            <li><a href="' . $prefix2 . 'cv.php"><i class="fa fa-briefcase" aria-hidden="true"></i> '.$transmenu[2].'</a></li>
            <li id="item"><a><i class="fa fa-file-o" aria-hidden="true"></i> iTalent</a></li>
            <ul id="talent">
                <li><a href="' . $prefix2 . 'talent1.php"><i class="fa fa-file-o" aria-hidden="true"></i> i1Talent</a></li>
                <li><a href="' . $prefix2 . 'talent2.php"><i class="fa fa-file-o" aria-hidden="true"></i> i2Talent</a></li>
            </ul>
            <li><a href="' . $prefix2 . 'portfolio.php"><i class="fa fa-book" aria-hidden="true"></i> '.$transmenu[3].'</a></li>
            <li><a href="' . $prefix2 . 'hobby.php"><i class="fa fa-headphones" aria-hidden="true"></i> '.$transmenu[4].'</a></li>
            <li><a href="' . $prefix2 . 'links.php"><i class="fa fa-external-link" aria-hidden="true"></i> '.$transmenu[5].'</a></li>
            <li><a href="' . $prefix2 . 'contact.php" class="here"><i class="fa fa-envelope-o" aria-hidden="true"></i> '.$transmenu[6].'</a></li>
        </ul>
    </header>
    ' .
        getLangOptions()
        . '
    </nav>';
}

function getHeader()
{
    echo
    '<header id="header">
        <button class="toggle-button"></button>
        <h1 id="title"></h1>
    </header>';
}

function getFooter()
{
    echo
    '<footer>
            <p><i class="fa fa-copyright" aria-hidden="true"></i> Nicolas Loots</p>
    </footer>';
}

function initSlides()
{
    $images = glob("images/slideshow/*.*");
    shuffle($images);
    foreach ($images as $item) {
        echo '<img src="' . $item . '" alt="' . substr($item, strrpos($item, '/') + 1) . '">';
    };
}

function getLangOptions()
{
    $values = ['nl_BE' => 'Nederlands', 'en_GB' => 'English', 'fr_FR' => 'Français'];
    $output = '<select id="langswitch">';
    foreach ($values as $key => $value) {
        if ($key == $_SESSION['lang']) {
            $output .= '<option value="' . $key . '" selected>' . $value . '</option>';
        } else {
            $output .= '<option value="' . $key . '">' . $value . '</option>';
        }
    }
    $output .= '</select>';
    return $output;
}

function setLang($locale)
{
    $_SESSION['lang'] = $locale;
    putenv("LANG=" . $_SESSION['lang']);
    setlocale(LC_ALL, $_SESSION['lang']);
    ob_flush();
}