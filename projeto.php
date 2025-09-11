<?php
session_start();
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
include 'config/config.php';
include 'includes/head.php';
getHead($lang['projeto'], $lang);
include 'includes/menu.php';
menu($lang['projetoUp']);

$arrObjetivo = buscaObjetivo($conn, $lang['lang']);
$arrCoord = buscaCoord($conn, $lang['lang']);
$arrCargo = buscaCargo($conn, $lang['lang']);
?>
<div class="container">
    <div class="text-center">
        <br>
        <h3><?=$lang['objetivo']?></h3>
        <?php
        foreach ($arrObjetivo as $dadoObjetivo){
            echo "
            <p class='h5'>$dadoObjetivo[0]</p>
            <br>";
        }
        ?>
        <p class="h5"><a href="https://fesafa.net/" target="_blank">Fesafa</a></p>
        <p class="h5"><a href="https://www.gov.br/cidadania/pt-br/noticias-e-conteudos/esporte" target="_blank">Ministerio Esporte</a></p>
        <br>
        <h3><?= $arrCoord[0] ?></h3>
        <h5><?= $arrCoord[1] . ' ' . $arrCoord[2]?></h5>
        <br>
        <h3><?=$lang['equipe']?></h3>
    </div>

    <?php
    foreach ($arrCargo as $dadoCargo){
        ?>
        <fieldset class="row mb-3">
            <legend class="col-form-label col-sm-2 pt-0"><strong><?= $dadoCargo[1]?></strong></legend>
            <div class="col-sm-10">
                <?php
                $arrEquipe = buscaEquipe($conn, $lang['lang'], array(':cdCargo' => $dadoCargo[0], ':status' => 'AT'));
                $cont = 1;
                foreach ($arrEquipe as $dadoEquipe){
                    if($cont == 1 && $dadoCargo[2] != ''){
                        ?>
                        <div class="form-check">
                            <label class="form-check-label">
                            <strong><?php echo $dadoCargo[2] ?></strong> - <?php echo $dadoEquipe[0] . ' ' . $dadoEquipe[1]?>
                            </label>
                        </div>
                        <?php
                        $cont++;
                    }
                    else{
                        ?>
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo $dadoEquipe[0] . ' ' . $dadoEquipe[1]?>
                            </label>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </fieldset>
        <?php
    }
    ?>
</div>
<?php
include 'includes/foot.php';