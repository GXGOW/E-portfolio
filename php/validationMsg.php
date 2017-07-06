<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 6/07/2017
 * Time: 20:11
 */
session_save_path(sys_get_temp_dir());
session_start();
ob_start();
include '../locale/' . $_SESSION["lang"] . '/errors.php';
echo json_encode($errors);