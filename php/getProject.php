<?php
session_start();
ob_start();
include '../locale/' . $_SESSION["lang"] . '/' . 'portfolio.php';

if(isset($_GET['project'])){
    $project = $_GET['project'];
    $text = $translated[$project];
    $res='';
    $title='';
    switch($project){
        case 'BreakingBook': $title='<a href="FeestBoek/index.html" target="_blank">Breaking Book</a>';break;
        case 'dogecoin': $title='<a href="https://github.com/GXGOW/Docker-Dogecoin-fullnode" target="_blank">Dogecoin fullnode</a>';break;
        case 'GoedBezig': $title='<a href="https://imgur.com/a/GK2An" target="_blank">Project Goed Bezig!</a>';break; //TODO: Album met screenshots project maken
        case 'litecoin': $title='<a href="https://github.com/GXGOW/Docker-Litecoin-fullnode" target="_blank">Litecoin fullnode</a>';break;
        case 'RedAlert': $title='<a href="http://www.red-alert.be" target="_blank">Red Alert</a>';break;
        case 'trump': $title='<a href="html/trump.php" target="_blank">Small loan</a>';break; 
        default:break;       
    }
    $res.='<h2>'.$title.'</h2>';
    foreach ($text as $paragraph) {
        $res .= '<p>'.$paragraph.'</p>';
    }
    echo json_encode($res);
}
