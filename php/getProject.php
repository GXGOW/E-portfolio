<?php
session_start();
ob_start();
include '../locale/' . $_SESSION["lang"] . '/' . 'portfolio.php';

$res='';

if(isset($_GET['project'])){
    $project = $_GET['project'];
    $text = $translated[$project];
    foreach ($text as $paragraph) {
        $res .= '<p>'.$paragraph.'</p>';
    }
}
echo json_encode($res);