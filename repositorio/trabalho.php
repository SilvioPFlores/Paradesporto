<?php
require_once "db/dbConnection.php";
include_once "query/query-busca.php";
include 'config/config.php';
include 'includes/head.php';
getHead($lang['titulo'], $lang);
include '../includes/menu.php';
menu($lang['repositUp']);
if(isset($_GET['ct'])){
    $arrTrabalho = buscaTrabalhoCodigo($conn,array(':cdTrabalho' => $_GET['ct']));
    $arrAutor = buscaAutorTrabalho($conn, array(':cdTrabalho' => $_GET['ct']));
    $srtAutor = '';
    //Concatenar todos os autores
    if(isset($arrAutor[1])){
        foreach ($arrAutor as $autor){
            $srtAutor .= $autor[0].', ';
        }
        $srtAutor = substr($srtAutor, 0, -2);
    }
    else{
        $srtAutor = $arrAutor[0][0];
    }
    //modificar exibição para datas em branco
    if($arrTrabalho[10] != NULL){
        $dtPublic = $arrTrabalho[10];
    }
    else{
        $dtPublic = 's.d.';
    }
    ?>
    <div class="container">
        <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['tituloTrab']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho[0] ?></label>
                    </div>
                </div>
            </fieldset>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['autorTrab']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $srtAutor ?></label>
                    </div>
                </div>
            </fieldset>
            <?php
            if($arrTrabalho[1] == 3){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['editora']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[2] ?></label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['isbn']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[3] ?></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            else{
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['revista']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[4] ?></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['anoPublic']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho[5] ?></label>
                    </div>
                </div>
            </fieldset>
            <?php
            if($arrTrabalho[1] != 3){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['volume']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[6] ?></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['paginas']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho[7] ?></label>
                    </div>
                </div>
            </fieldset>
            <?php
            if($arrTrabalho[1] == 3){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['cidade']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[8] ?></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            else{
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['instit']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho[9] ?></label>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['dtPublic']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $dtPublic ?></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['url']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check quebraLink ">
                        <label class="form-check-label " ><a target="_blank" href="<?= $arrTrabalho[11] ?>"><?= $arrTrabalho[11] ?></a></label>
                    </div>
                </div>
            </fieldset>
            <?php
            if($arrTrabalho[1] != 3){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['doi']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label quebraLink" ><a target="_blank" href="<?= $arrTrabalho[12] ?>"><?= $arrTrabalho[12] ?></a></label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            if($arrTrabalho[14] == 'S' && $arrTrabalho[13] != NULL){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['arquivo']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                                <a href="trabalhos/<?=$arrTrabalho[13]?>" target="_blank" class="contaDownload">
                                    <img src="img/pdf.png" width="30px" height="30px">
                                </a>
                            </label>
                        </div>
                    </div>
                </fieldset>
                <?php
            }
            ?>
            <div style="text-align: center;">
                <input type="button" id='btnVoltar' class="btn btnLaranja btn-lg" value="<?= $lang['volta']?>" onClick="history.go(-1)">
            </div>
        </div>
    </div>
    <?php
}
include 'includes/foot.php';