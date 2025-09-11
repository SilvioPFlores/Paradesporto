<?php
    session_start();
    if(!isset($_SESSION['lang']))
        $_SESSION['lang'] = 'pt-br';
    else if(isset($_POST['lang']) && $_SESSION['lang'] != $_POST['lang'] && !empty($_POST['lang'])){
        if ($_POST['lang'] == 'pt-br')
            $_SESSION['lang'] = 'pt-br';
        else if ($_POST['lang'] == 'en')
            $_SESSION['lang'] = 'en';
        else if ($_POST['lang'] == 'es')
            $_SESSION['lang'] = 'es';
    }
    require_once 'config/'.$_SESSION['lang'].'.php';