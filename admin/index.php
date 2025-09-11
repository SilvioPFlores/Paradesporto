<?php
session_start();
include 'config/config.php';
include 'includes/head.php';
include 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getHead('Administrativo');
    getMenu($nivel);
}
else{
    header("Location: login.php");
}
require_once "includes/foot.php";