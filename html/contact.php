<?php
include '../php/functions.php';
include '../locale/' . $_SESSION["lang"] .'/'.basename($_SERVER["PHP_SELF"]);?>
<div id="content">
    <div id="err" class="error"></div>
    <?php
        echo '<form id="form" action="">
                <label for="naam">' . $translated[0] . '</label>
                <input type="text" name="naam" placeholder="&#xf007;">

                <label for="voornaam">'.$translated[1].'</label>
                <input type="text" name="voornaam" placeholder="&#xf007;">

                <label for="email">'.$translated[2].'</label>
                <input type="email" name="email" placeholder="&#xf1fa;">

                <label for="onderwerp">'.$translated[3].'</label>
                <input type="text" name="onderwerp" placeholder="&#xf059;">

                <label for="bericht">'.$translated[4].'</label>
                <textarea name="bericht" placeholder="&#xf086;"></textarea>
                
                <div id="recaptcha"></div>
                <input type="submit" value="'.$translated[5].'">

        </form>';
        ?>
</div>
<?php
$lang;
switch($_SESSION["lang"]){
        case 'en_GB': $lang= 'en';break;
        case 'fr_FR': $lang= 'fr';break;
        case 'nl_BE':$lang= 'nl';break;
    }
    echo '<script src="https://www.google.com/recaptcha/api.js?onload=callback&render=explicit&hl='.$lang.'" async defer>
    </script>
    <script>
    var callback = function() {
        grecaptcha.render("recaptcha", {
            sitekey: "6LfYMSgUAAAAALcc3671CX_4qKW-nPTqACdgDgr2"
        });
    }
    </script>'
?>