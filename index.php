<?php
include 'php/functions.php';
include 'locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
    <!doctype html>
    <html>

    <head>
        <?php getHead(); ?>
        <title>Home</title>
    </head>

    <body>
        <noscript>Your browser does not support Javascript.
<style>div {
    display: none;
}</style>
</noscript>
        <?php getMenu(); ?>
        <div id="panel">
            <header>
                <button class="toggle-button">
                <svg height="32px" id="Layer_1" style="enable-background:new 0 0 32 32;" version="1.1" viewBox="0 0 32 32" width="32px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <path d="M4,10h24c1.104,0,2-0.896,2-2s-0.896-2-2-2H4C2.896,6,2,6.896,2,8S2.896,10,4,10z M28,14H4c-1.104,0-2,0.896-2,2  s0.896,2,2,2h24c1.104,0,2-0.896,2-2S29.104,14,28,14z M28,22H4c-1.104,0-2,0.896-2,2s0.896,2,2,2h24c1.104,0,2-0.896,2-2  S29.104,22,28,22z"/>
                </svg>
                </button>
                <h1 id="title"></h1>
            </header>
            <div id="main">
            </div>
            <footer>
                <p><i class="fa fa-copyright" aria-hidden="true"></i> Nicolas Loots</p>
                <p><a href="https://www.facebook.com/Loots2.0" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                    <a href="https://twitter.com/GXGOW" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="https://github.com/GXGOW" target="_blank"><i class="fa fa-github" aria-hidden="true"></i></a>
                    <a href="https://www.quora.com/profile/Nicolas-Loots" target="_blank"><i class="fa fa-quora" aria-hidden="true"></i></a>
                </p>
            </footer>
        </div>
        <?php getScripts(); ?>
    </body>

    </html>