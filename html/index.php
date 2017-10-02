<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] . '/' . basename($_SERVER["PHP_SELF"]);?>
    <?php initSlides('../images/slideshow') ?>
    <div id="content">
        <article>
            <?php
        foreach ($translated as $item) {
            echo '<p style="text-align: center">' . $item . '</p>';
        }
        ?>
        </article>
        <div class="iframe">
            <div class="reddit-embed" data-embed-media="www.redditmedia.com" data-embed-parent="false" data-embed-live="false" data-embed-uuid="5b778ff5-9726-48f9-a4f3-38cc4efcdda5" data-embed-created="2017-09-30T16:33:44.885Z">
                <a href="https://www.reddit.com/r/AskReddit/comments/724wbv/how_do_you_reply_to_how_much_do_you_love_me/dnfsgu5/">Comment</a> from discussion
                <a href="https://www.reddit.com/r/AskReddit/comments/724wbv/how_do_you_reply_to_how_much_do_you_love_me/">How do you reply to &quot;how much do you love me&quot;?</a>.</div>
        </div>
    </div>
    <script async src="https://www.redditstatic.com/comment-embed.js"></script>