<?php
include '../php/functions.php'
?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>I2Talent</title>
</head>

<body>
<?php getMenu(); ?>
<div id="panel">
    <?php getHeader(); ?>
    <div id="main">
        <div id="content">
            <picture>
                <source srcset="../images/doit_mobile.jpg" media="(max-width: 480px)">
                <img src="../images/doit.jpg"/></picture>
            <p>Op deze pagina komen de verslagen van het OLOD I2Talent. Dit bouwt verder op I1Talent (zie hiervoor de
                desbetreffende pagina), maar nu gaan we op zoek naar waar we goed in zijn. </p>

            <select id="assSelect">
                <option value="">--Selecteer een opdracht--</option>
                <option value="ofman">Kernkwadranten van Daniel Ofman</option>
                <option value="competence">Competence Indicator</option>
                <option value="getuigenis">Getuigenis medestudent</option>
                <option value="disc">DISC</option>
                <option value="discrefl">Reflectie DISC-workshop</option>
                <option value="creative">Reflectie workshop Creative Thinking</option>
                <option value="lezing">Verslag lezing 'The Basics of Cyber Security'</option>
                <option value="cebit">Beursverslag: CeBIT</option>
            </select>

                <div id="verslag">
                </div>

        </div>
    </div>
    <?php getFooter(); ?>
</div>
<?php getScripts(); ?>
</body>

</html>