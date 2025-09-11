<?php
require_once "db/dbConnection.php";
include_once "query/query-busca.php";
include 'config/config.php';
include 'includes/head.php';
getHead($lang['titulo'], $lang);
include '../includes/menu.php';
menu($lang['repositUp']);
if(isset($_GET['b'])){
    $arrChave = buscaChaveStr($conn,array(':str' => "%".strtoupper($_GET['b'])."%"));

}
else if(isset($_GET['l'])){
    $arrChave = buscaChaveLetra($conn,array(':letra' => $_GET['l'].'%'));
    $l = $_GET['l'];
}
else{
    $arrChave = buscaChave($conn);
}
?>
<div class="container">
    <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
        <form>
            <div class="input-group mb-3">
                <input type="text" name="b" class="form-control bordLaranja" placeholder="<?=$lang['pesquisa']?>" aria-label="<?=$lang['pesquisa']?>" aria-describedby="btnBusca">
                <button class="btn btnLaranja" type="submit" id="btnBusca"><img src="img/lupa.png" id="btnLupa"></button>
            </div>
        </form>
        <?php
        include 'includes/listaAlfa.php';
        buscaPor($lang, $l, 'palavra-chave.php');

        if (empty($arrChave)) {
            echo $lang['nada'];
        }
        foreach($arrChave as $dadoChave){
            echo "<a class='btn btnAzul bordAzul espTop4 contaChave' href='titulo.php?c=$dadoChave[0]'>$dadoChave[1]</a> ";
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