<?php
include 'config/config.php';
include 'includes/head.php';
include 'includes/menu.php';

$nivel = isset($_SESSION['repositorio']['nivel']) ?? '';
if ($nivel != '') {
    getHead('Administrativo');
    getMenu($nivel);
}
else{
    header("Location: login.php");
}
require_once "includes/foot.php";