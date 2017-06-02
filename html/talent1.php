<?php
include '../php/functions.php'
?>
<!doctype html>
<html>

<head>
    <?php getHead(); ?>
    <title>I1Talent</title>
</head>

<body>
<?php getMenu(); ?>

<div id="panel">
    <?php getHeader(); ?>
    <div id="content">
        <picture>
            <source srcset="../images/doit_mobile.jpg" media="(max-width: 480px)">
            <img src="../images/doit.jpg"/></picture>
        <p>Op deze pagina komen de verslagen van het OLOD I1Talent. Hierin gaan we op zoek naar onze verborgen talenten
            en zwaktes en leren we onszelf beter kennen. Aangezien we later, als we afgestudeerd zijn, allemaal zo goed
            als dezelfde competenties hebben, moeten we elk iets uniek hebben waarmee we kunnen uitblinken tegenover
            andere informatici en dus een werkgever kunnen overtuigen om voor onszelf te kiezen.</p>
        <p>Op deze pagina zullen naarmate de lessen vorderen nieuwe verslagen verschijnen.</p>

        <select id="assSelect">
            <option value="">--Selecteer een opdracht--</option>
            <option value="pop1">POP-gesprek 1</option>
            <option value="pop2">POP-gesprek 2</option>
            <option value="end">Eindevaluatie</option>
        </select>

            <div id="verslag">
            </div>

    </div>

    <?php getFooter(); ?>

</div>
<?php getScripts(); ?>
</body>

</html>