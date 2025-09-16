<?php
function getHead($titulo, $lang,$css = '', $js = ''){
    ?>
    <!DOCTYPE html>
    <html lang="<?=$_SESSION['lang']?>">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/head/paradesporto-icon.png" sizes="16x16" type="image/png">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- RYBENA -->
        <script type="text/javascript" src="../js/rybena.js?positionPlayer=left&positionBar=right"></script>
        <!-- CDN para font tipo Arimo -->
        <link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet'>
        <!-- CSS GERAL PARA MANTER AS CONFIGS DE CABECALHO E RODAPÉ -->
        <link href="../css/css-head-foot.css" rel="stylesheet">
        <!-- CSS e JS LOCAL -->
        <link href="css/css.css" rel="stylesheet">
        <script src="js/js.js"></script>
        <?php
        //CSS personalizado
        if (!empty(trim($css))) {
            echo "<link rel='stylesheet' href='$css'>";
        }
        //JS personalizado
        if (!empty(trim($js))) {
            echo "<script src='$js'></script>";
        }
        //Título  personalizado
        if (!empty(trim($titulo)) && $titulo != '') {
            echo "<title>$titulo</title>";
        }
        else{
            echo "<title>Paradesporto + Acessível</title>";
        }
        ?>
    </head>
    <body>
    <?php
    include 'includes/cabecalho.php';
    getCabecario($lang);
}