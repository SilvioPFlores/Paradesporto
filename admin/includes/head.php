<?php
function getHead($titulo = '', $css = '', $js = ''){
    ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../img/head/paradesporto-icon.png" sizes="16x16" type="image/png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <!-- SWEETALERT -->
        <script src="js/sweetalert.min.js"></script>
        <!-- CSS e JS para formato de telefone -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
        <!-- LOCAL -->
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
        if (!empty(trim($titulo))) {
            echo "<title>$titulo</title>";
        }
        ?>
    </head>
    <body>
    <?php
}