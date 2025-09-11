<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
require_once 'includes/head.php';
getHead("Trabalhos", '', 'js/js-consulta.js');
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);

    if(isset($_GET['l'])){
        $arrTitulo = buscaTituloLetra($conn,array(':letra' => $_GET['l'].'%'));
        $l = $_GET['l'];
    }
    else if(isset($_GET['b'])){
        $arrTitulo = buscaTituloStr($conn,array(':str' => "%".$_GET['b']."%"));
    }
    else{
        $arrTitulo = buscaTitulo($conn);
    }
    ?>
    <!-- Bloco Página -->
    <div class="container">
        <div class='divConteudo'>
            <br>
            <div class="divGd">
                <fildset>
                    <legend>Consultar Trabalho</legend>
                        <hr>
                        <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
                            <form action="consulta.php">
                                <div class="input-group mb-3">
                                    <input type="text" name="b" class="form-control bordVerde" placeholder="<?=$lang['pesquisa']?>" aria-label="<?=$lang['pesquisa']?>" aria-describedby="btnBusca">
                                    <button class="btn btnVerde" type="submit" id="btnBusca"><img src="../repositorio/img/lupa.png" id="btnLupa"></button>
                                </div>
                            </form>
                        </div>
            
                        <?php
                        include '../repositorio/includes/listaAlfa.php';
                        buscaPor(array('buscaLetra' => 'Buscar por ', 'all' => 'Todas'), $l, 'consulta.php');
                        
                        if (empty($arrTitulo)) {
                            echo 'A busca não encontrou nenhum resultado!';
                        }
                        foreach ($arrTitulo as $dadoTitulo){
                            echo"
                            <form action='alteraTrabalho.php' method=post>
                                <input type='hidden' name='cdTrabalho' value='$dadoTitulo[0]'>
                                <input type='submit' class='btn btn-outline-secondary btn-md divMax' value='".str_replace("'", "&#39;", $dadoTitulo[1])."'>
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