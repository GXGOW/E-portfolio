<?php
include 'php/functions.php';
include 'locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);
global $translated; ?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>Home</title>
</head>

<body>
<?php getMenu(); ?>
<div id="panel">
    <?php getHeader(); ?>
    <div id="main">
        <div id="slides">
            <?php initSlides()?>
        </div>
        <div id="content">
            <article>
                <?php
                foreach ($translated as $item) {
                    echo '<p>' . $item . '</p>';
                } ?>
            </article>
            <div class="iframe">
            <div class="reddit-embed" data-embed-media="www.redditmedia.com" data-embed-parent="false"
                 data-embed-live="true" data-embed-uuid="30bb254b-4ced-4793-b78c-6aebe321a8d5"
                 data-embed-created="2017-05-25T11:33:08.463Z"><a
                        href="https://www.reddit.com/r/movies/comments/2da3m3/robin_williams_dead_at_63/cjnkwxq/">Comment</a>
                from discussion <a href="https://www.reddit.com/r/movies/comments/2da3m3/robin_williams_dead_at_63/">Robin
                    Williams dead at 63</a>.
            </div>
            </div>
        </div>

    </div>
    <?php getFooter() ?>
</div>
<?php getScripts(); ?>
<script async src="https://www.redditstatic.com/comment-embed.js"></script>
</body>

</html>