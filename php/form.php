<?php

$captcha = $_POST['g-recaptcha-response'];

$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfYMSgUAAAAAMWPVAi9lGrBhUA2q8PvI8obYrV6&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
$valid = json_decode($response);
try {
    if ($valid->success == false) {
        throw new InvalidArgumentException('err_captcha');
    }

    $lname = $_POST['naam'];
    $fname = $_POST['voornaam'];
    $email = $_POST['email'];
    $subject = $_POST['onderwerp'];
    $msg = $_POST['bericht'];
    if ($lname == null || $fname == null || $email == null || $subject == null || $msg == null) {
        throw new InvalidArgumentException('err_null');
    }
    if (strpos($email, '@') === false) {
        throw new InvalidArgumentException('err_email');
    }

    $cfile = fopen('../file/contact.txt', 'a') or die('Lap zeg.');
    $error = error_get_last();
    $towrite = "-----MESSAGE BEGIN-----\n\nNaam: " . $lname . " " . $fname . "\nE-mail: " . $email . "\nOnderwerp: " . $subject . "\nBericht: " . $msg . "\n\n-----MESSAGE END-----\n\n\n";
    fwrite($cfile, $towrite);
    fclose($cfile);

    echo 'success';

} catch (Exception $exception) {
    echo $exception->getMessage();
}