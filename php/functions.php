<?php
//Deze lijn is enkel voor Abbatis webserver. Een of andere feature ofzo. Anders werkt session_start() niet vanwege
//permission error
session_save_path(sys_get_temp_dir());
session_start();
ob_start();
//Development of production?
$dev;
if ($_SERVER['SERVER_NAME'] == 'localhost') {
    $dev = true;
}
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
    global $prefix1, $dev;
    $links = ($dev ?
        '<link href="' . $prefix1 . 'node_modules/reset-css/reset.css" rel="stylesheet"/>
        <link href="' . $prefix1 . 'node_modules/font-awesome/css/font-awesome.css" rel="stylesheet"/>
        <link href="' . $prefix1 . 'css/styles.css" rel="stylesheet"/>
        <link href="' . $prefix1 . 'node_modules/css-ripple-effect/dist/ripple.css" rel="stylesheet"/>
        '
        :
        '<link href="' . $prefix1 . 'build/reset.css" rel="stylesheet"/>
    <link href="' . $prefix1 . 'build/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="' . $prefix1 . 'build/styles.min.css" rel="stylesheet"/>');
    echo '<meta charset="UTF-8">
    <link rel="icon" sizes="512x512" href="images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=yes">
    <!-- Android Chrome colored statusbar -->
    <meta name="theme-color" content="#187ab2">
    <!-- iOS colored statusbar -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#187ab2">'
        . $links;
}

function getScripts()
{
    global $prefix1, $dev;
    $scripts = $dev ?
        '<script src="' . $prefix1 . 'node_modules/jquery/dist/jquery.js"></script>
        <script src="' . $prefix1 . 'node_modules/slideout/dist/slideout.js"></script>
        <script src="' . $prefix1 . 'node_modules/jquery-validation/dist/jquery.validate.js"></script>
        <script src="' . $prefix1 . 'js/jquery.slides.js"></script>
        <script src="' . $prefix1 . 'js/functions.js"></script>
        <script src="' . $prefix1 . 'js/form.js"></script>
        <script src="' . $prefix1 . 'js/trump.js"></script>
        '
        :
        '<script src="' . $prefix1 . 'build/functions.min.js"></script>';
    echo $scripts;
}

function getMenu()
{
    global $transmenu;
    include 'locale/' . $_SESSION['lang'] . '/menu.php';
    echo
        '<nav id="menu">
        <ul>
            <li><a href="#index" class="current"><i class="fa fa-home" aria-hidden="true"></i> ' . $transmenu[0] . '</a></li>
            <li><a href="#profile"><i class="fa fa-male" aria-hidden="true"></i> ' . $transmenu[1] . '</a></li>
            <li><a href="#cv"><i class="fa fa-briefcase" aria-hidden="true"></i> ' . $transmenu[2] . '</a></li>
            <li id="list"><a><i class="fa fa-file-o" aria-hidden="true"></i> iTalent</a></li>
            <ul id="sublist">
                <li><a href="#talent1"><i class="fa fa-file-o" aria-hidden="true"></i> i1Talent</a></li>
                <li><a href="#talent2"><i class="fa fa-file-o" aria-hidden="true"></i> i2Talent</a></li>
            </ul>
            <li><a href="#portfolio"><i class="fa fa-book" aria-hidden="true"></i> ' . $transmenu[3] . '</a></li>
            <li><a href="#hobby"><i class="fa fa-headphones" aria-hidden="true"></i> ' . $transmenu[4] . '</a></li>
            <li><a href="#links"><i class="fa fa-external-link" aria-hidden="true"></i> ' . $transmenu[5] . '</a></li>
            <li><a href="#contact" class="here"><i class="fa fa-envelope-o" aria-hidden="true"></i> ' . $transmenu[6] . '</a></li>
        </ul>
    ' . getLangOptions() . '
    </nav>';
}

function getHeader()
{
    global $prefix1;
    echo
    '<header>
        <button class="toggle-button">
        <svg height="32px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/>
        </svg>
        </button>
        <h1 id="title"></h1>
    </header>';
}

function getFooter()
{
    echo
    '<footer>
            <p><i class="fa fa-copyright" aria-hidden="true"></i> Nicolas Loots</p>
            <p><a href="https://www.facebook.com/Loots2.0" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i>
</a> <a href="https://twitter.com/GXGOW" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a> 
            <a href="https://github.com/GXGOW" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
            </p>
    </footer>';
}

function getImages($path, $shuffled)
{
    $images = glob($path . '/*.*');
    $shuffled ? shuffle($images) : '';
    $ret = '';
    foreach ($images as $item) {
        $ret .= '<img src="' . $item . '" alt="' . substr($item, strrpos($item, '/') + 1) . '">';
    };
    return $ret;
}

function initSlides($path)
{
    echo '<div id="slides">' . getImages($path, true) . '</div>';
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