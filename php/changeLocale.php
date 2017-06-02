<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 16/04/2017
 * Time: 15:13
 */
include 'functions.php';
if(isset($_POST['newLang']))
{
    setLang($_POST['newLang']);
}