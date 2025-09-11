<?php
require_once "db/dbConnection.php";
include_once "query/query-busca.php";
include 'config/config.php';
include 'includes/head.php';
getHead($lang['titulo'], $lang, '','css/css-accordion.css');
include '../includes/menu.php';
menu($lang['repositUp']);
?>
<div class="container">
    <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
        <form>
            <div class="input-group mb-3">
                <input type="text" name="b" class="form-control bordLaranja" placeholder="<?=$lang['pesquisa']?>" aria-label="<?=$lang['pesquisa']?>" aria-describedby="btnBusca">
                <button class="btn btnLaranja" type="submit" id="btnBusca"><img src="img/lupa.png" id="btnLupa"></button>
            </div>
        </form>
        <div class="accordion accordion-flush" id="acdTipoTrabalho">
            <?php
            include 'includes/listaAlfa.php';
            if(isset($_GET['l'])){
                buscaPor($lang, $_GET['l'], 'tipos-de-trabalhos.php');
            }
            else{
                buscaPor($lang, '', 'tipos-de-trabalhos.php');
            }
            $arrTpTrab = buscaTipoTrabalho($conn, $lang['lang']);
            foreach($arrTpTrab as $dadoTipo){
                $cdTipo = $dadoTipo[0]
                ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="pnlTipo<?=$cdTipo?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pnlAbertoTipo<?=$cdTipo?>" aria-expanded="false" aria-controls="pnlAbertoTipo<?=$cdTipo?>">
                            <?=$dadoTipo[1]?>
                        </button>
                    </h2>
                    <div id="pnlAbertoTipo<?=$cdTipo?>" class="accordion-collapse collapse" aria-labelledby="pnlTipo<?=$cdTipo?>" data-bs-parent="#acdTipoTrabalho">
                        <div class="accordion-body">
                            <?php
                            if(isset($_GET['l'])){
                                $arrTrabalho = buscaTrabalhoStr($conn,array(':cdTipo' => $cdTipo, ':str' => $_GET['l'].'%'));
                                $l = $_GET['l'];
                            }
                            else if(isset($_GET['b'])){
                                $arrTrabalho = buscaTrabalhoStr($conn,array(':cdTipo' => $cdTipo, ':str' => "%".$_GET['b']."%"));
                            }
                            else{
                                $arrTrabalho = buscaTrabalho($conn, array(':cdTipo' => $cdTipo));
                            }

                            if (empty($arrTrabalho)) {
                                echo $lang['nada'];
                            }
                            foreach ($arrTrabalho as $dadoTrabalho){
                                echo"
                                <form action='trabalho.php' method=get>
                                    <input type='hidden' name='ct' value='$dadoTrabalho[0]'>
                                    <input type='submit' class='btn btnAzul btn-md divMax bordAzul espTop' value='".str_replace("'", "&#39;", $dadoTrabalho[1])."'>
                                </form>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <br>
    <div style="text-align: center;">
        <input type="button" id='btnVoltar' class="btn btnLaranja btn-lg" value="<?= $lang['volta'] ?>" onClick="history.go(-1)">
    </div>
</div>
<?php
include 'includes/foot.php';