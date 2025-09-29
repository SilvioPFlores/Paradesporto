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
            $srtAutor .= $autor[0].' | ';
        }
        $srtAutor = substr($srtAutor, 0, -2);
    }
    else{
        $srtAutor = $arrAutor[0][0];
    }
    ?>
    <div class="container">
        <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['tituloTrab']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho->ds_titulo ?></label>
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
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['publicPor']?>: <i class="bi bi-info-circle-fill" title="<?= $lang['publicPorInfo']?>"></i></legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho->ds_publicado_por ?></label>
                    </div>
                </div>
            </fieldset>
            <?php if ($arrTrabalho->ds_isbn != ''){ ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['isbn']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho->ds_isbn ?></label>
                        </div>
                    </div>
                </fieldset>
            <?php } ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['anoPublic']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho->ano_public ?></label>
                    </div>
                </div>
            </fieldset>
            <?php if($arrTrabalho->ds_volume != ''){ ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['volume']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho->ds_volume ?></label>
                        </div>
                    </div>
                </fieldset>
            <?php } ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['paginas']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label"><?= $arrTrabalho->ds_pagina ?></label>
                    </div>
                </div>
            </fieldset>
            <?php if($arrTrabalho->ds_cidade != ''){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['cidade']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label"><?= $arrTrabalho->ds_cidade ?></label>
                        </div>
                    </div>
                </fieldset>
            <?php } ?>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0"><?= $lang['url']?>:</legend>
                <div class="col-sm-10">
                    <div class="form-check quebraLink ">
                        <label class="form-check-label " ><a target="_blank" href="<?= $arrTrabalho->ds_url ?>"><?= $arrTrabalho->ds_url ?></a></label>
                    </div>
                </div>
            </fieldset>
            <?php
            
            if($arrTrabalho->ic_publico == 'S' && $arrTrabalho->nm_arquivo != NULL){
                ?>
                <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-2 pt-0"><?= $lang['arquivo']?>:</legend>
                    <div class="col-sm-10">
                        <div class="form-check">
                            <label class="form-check-label">
                                <a href="trabalhos/<?=$arrTrabalho->nm_arquivo?>" target="_blank" class="contaDownload">
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