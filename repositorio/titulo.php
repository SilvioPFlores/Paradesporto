<?php
require_once "db/dbConnection.php";
include_once "query/query-busca.php";
include 'config/config.php';
include 'includes/head.php';
getHead($lang['titulo'], $lang);
include '../includes/menu.php';
menu($lang['repositUp']);
if(isset($_GET['a'])){
    $arrTitulo = buscaTituloAutor($conn,array(':cdAutor' => $_GET['a']));
}
else if(isset($_GET['l'])){
    $arrTitulo = buscaTituloLetra($conn,array(':letra' => $_GET['l'].'%'));
    $l = $_GET['l'];
}
else if(isset($_GET['b'])){
    $arrTitulo = buscaTituloStr($conn,array(':str' => "%".$_GET['b']."%"));
}
else if(isset($_GET['c'])){
    $arrTitulo = buscaTituloChave($conn,array(':cdChave' => $_GET['c']));
}
else{
    $arrTitulo = buscaTitulo($conn);
}
?>
<div class="container">
    <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
        <form action="titulo.php">
            <div class="input-group mb-3">
                <input type="text" name="b" class="form-control bordLaranja" placeholder="<?=$lang['pesquisa']?>" aria-label="<?=$lang['pesquisa']?>" aria-describedby="btnBusca">
                <button class="btn btnLaranja" type="submit" id="btnBusca"><img src="img/lupa.png" id="btnLupa"></button>
            </div>
        </form>
        <?php
        include 'includes/listaAlfa.php';
        buscaPor($lang, $l, 'titulo.php');

        if (empty($arrTitulo)) {
            echo $lang['nada'];
        }
        foreach ($arrTitulo as $dadoTitulo){
            echo"
            <form action='trabalho.php' method=get>
                <input type='hidden' name='ct' value='$dadoTitulo[0]'>
                <input type='submit' class='btn btnAzul btn-md divMax bordAzul espTop4' value='".str_replace("'", "&#39;", $dadoTitulo[1])."'>
            </form>";
        }
        ?>
    </div>
    <br>
    <div style="text-align: center;">
        <input type="button" id='btnVoltar' class="btn btnLaranja btn-lg" value="<?= $lang['volta'] ?>" onClick="history.go(-1)">
    </div>
</div>
<?php
include 'includes/foot.php';