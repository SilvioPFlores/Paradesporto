<?php
session_start();
require_once 'query/query-trabalho.php';
require_once 'includes/head.php';
getHead("Trabalhos", $lang);
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);
    ?>
    <!-- Bloco Página -->
    <div class="container">
        <div class='divConteudo'>
            <br>
            <div class="divGd">
                <fildset>
                    <legend>Trabalhos Duplicados</legend>
                        <hr>
                        <?php
                        //$arrTitulo = buscaTitulo($conn);
                        foreach ($_SESSION['duplicados'] as $dadoTitulo  => $value){
                            echo"
                            <form action='alteraTrabalho.php' method=post>
                                <input type='hidden' name='cdTrabalho' value='$dadoTitulo'>
                                <input type='submit' class='btn btn-outline-secondary btn-md divMax' value='".$value[':titulo']."'>
                            </form>";
                        }
                    ?>
                </fildset>
            </div>
        </div>
    </div>
    <?php
}
else{
    header("Location: index.php");
}
require_once "includes/foot.php";