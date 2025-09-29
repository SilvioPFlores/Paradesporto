<?php
require_once "db/dbConnection.php";
include_once "query/query-busca.php";
if(isset($_POST['hdnEnviaMaterial']) && $_POST['hdnEnviaMaterial'] == 'novoMaterial'){
    include 'config/config.php';
    include 'includes/head.php';
    getHead($lang['titulo'], $lang);
    include '../includes/menu.php';
    menu($lang['repositUp']);
    include_once "query/query-material.php";
    if(isset($_POST['txtNome'], $_POST['txtMail'], $_POST['full_number'], $_POST['txtNacio'])){
        $cdUsuario = buscaUsuario($conn, array(':mail' => $_POST['txtMail']));
        if($cdUsuario == ''){
            $cdUsuario = gravaUsuario($conn, array(':nome' => $_POST['txtNome'], ':mail' => $_POST['txtMail'], ':fone' => $_POST['full_number'], ':nacio' => $_POST['txtNacio'], ':status' => 'AT'));
        }
        if(isset($_POST['cmbTipoTrabalho'],$_POST['titulo'],$_POST['publicadoPor'],$_POST['isbn'],$_POST['ano'],$_POST['pag'],$_POST['volume'],$_POST['cidade'],$_POST['url'],$_POST['hdnNameTrabalho'])){
            $paramsTrabalho = array(
                ':titulo'       => trim($_POST['titulo']),
                ':publicadoPor' => trim($_POST['publicadoPor']),
                ':anoPublic'    => trim($_POST['ano']),
                ':volume'       => trim($_POST['volume']),
                ':pagina'       => trim($_POST['pag']),
                ':url'          => trim($_POST['url']),
                ':isbn'         => trim($_POST['isbn']),
                ':cidade'       => trim($_POST['cidade']),
                ':publico'      => 'S',
                ':nmArquivo'    => trim($_POST['hdnNameTrabalho']),
                ':cdTipo'       => trim($_POST['cmbTipoTrabalho']),
                ':cdUsuario'    => $cdUsuario,
                ':status'       => 'IN'
            );
            $cdTrabalho = gravaTrabalho ($conn, $paramsTrabalho);
            if(is_numeric($cdTrabalho)){
                if(isset($_POST['chkChave'])){
                    foreach($_POST['chkChave'] as $dadoChave){
                        $cdUpChave = gravaChaveTrabalho($conn, array(':cdChave' => $dadoChave, ':cdTrabalho' => $cdTrabalho));
                    }
                }
                if(isset($_POST['autor'])){
                    $arrAutor = explode (";", $_POST['autor']);
                    for($i = 0; $i < count($arrAutor); $i++){
                        $strAutor = mb_strtoupper(trim($arrAutor[$i], ' '), 'UTF-8');
                        $cdAutor = buscaAutorStr2($conn, array(':dsAutor' => $strAutor));
                        if( $cdAutor == ''){
                            $cdAutor = gravaAutor($conn, array(':dsAutor' => $strAutor));
                        }
                        $cdUpAut = gravaAutorTrabalho($conn, array(':cdAutor' => $cdAutor, ':cdTrabalho' => $cdTrabalho));
                    }
                }
                //mover o arquivo para pasta valid
                $origem = 'trabalhos/temp/'.$_POST['hdnNameTrabalho'];
                $destino = 'trabalhos/valid/'.$_POST['hdnNameTrabalho'];
                copy($origem, $destino);
                unlink($origem);
                //Enviar email
                include "email/enviaEmail.php";
                $retornoMail = smtpmailer($_POST['txtNome'], $_POST['txtMail'], $cdTrabalho);
                if ($retornoMail == 'ok') {
                    echo "<script>okNewPage('".$lang['enviadoSucesso']."', 'index.php');</script>";
                } else {
                    echo "<script>erroNewPage('".$lang['enviadoErro']."<br>Erro $retornoMail', 'material.php');</script>";
                }
            } else {
                echo "<script>erroNewPage('".$lang['enviadoErro']."<br>Erro $cdTrabalho', 'material.php');</script>";
            }
        } else {
            echo "<script>erroNewPage('".$lang['enviadoErro']."<br>Erro de parâmetros do trabalho', 'material.php');</script>";
        }
    } else {
        echo "<script>erroNewPage('".$lang['enviadoErro']."<br>Erro de parâmetros de contato', 'material.php');</script>";
    }
}
else{
    include 'config/config.php';
    include 'includes/head.php';
    getHead($lang['titulo'], $lang, '', 'css/css-material.css', 'js/js-material.js');
    include '../includes/menu.php';
    menu($lang['repositUp']);
    $arrChave = buscaChave($conn, $lang['lang']);
    $arrTpTrab = buscaTipoTrabalho($conn, $lang['lang']);
    ?>
    <div class="container">
        <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
            <form class="row g-3" method="post" onsubmit="this.enviar.value='<?=$lang['btnEnviando']?>'; this.enviar.disabled=true;">
                <input type="hidden" name="hdnEnviaMaterial" value="novoMaterial">
                <h4><?=$lang['dados']?></h4>
                <div class="col-12">
                    <label for="txtNome" class="form-label"><?=$lang['nome']?><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="txtNome" id="txtNome" required>
                </div>
                <div class="col-12">
                    <label for="txtMail" class="form-label"><?=$lang['mail']?><span class="req"> *</span></label>
                    <input type="mail" class="form-control" name="txtMail" id="txtMail" required>
                </div>
                <div class="col-md-4 col-sm-8">
                    <label for="phone" class="form-label"><?=$lang['fone']?><span class="req"> *</span></label><br>
                    <input type="tel" class="form-control" name="phone" id="phone" required>
                </div>
                <div class="col-md-8">
                    <label for="txtNacio" class="form-label"><?=$lang['nacio']?><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="txtNacio" id="txtNacio" required>
                </div>
                <h4><?=$lang['infoTrab']?></h4>
                <div class="col-md-12">
                    <div class="mb-3" id="divChkChave"> </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="cmbNaoSelec"><?=$lang['escolher']?></label>
                    <select class="form-select" id="cmbNaoSelec">
                        <option selected value='0'><?=$lang['selecione']?></option>
                        <?php
                        foreach($arrChave as $dadoNaoSelec){
                            echo "<option value='$dadoNaoSelec[0]'>$dadoNaoSelec[1]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="cmbTipoTrabalho"><?=$lang['tipoTrab']?><span class="req"> *</span></label>
                    <select class="form-select" id="cmbTipoTrabalho" name="cmbTipoTrabalho" required>
                        <option selected value=''><?=$lang['selecione']?></option>
                        <?php
                        foreach($arrTpTrab as $dadoTpTrab){
                            echo "<option value='$dadoTpTrab[0]'>$dadoTpTrab[1]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="autor"><?=$lang['autorTrab']?><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="autor" id="autor" placeholder="Alves, C.; Prado, D.T." maxlength="50" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="titulo"><?=$lang['pTitulo']?><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="titulo" id="titulo" maxlength="500" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="publicadoPor"><?=$lang['publicPor']?> <i class="bi bi-info-circle-fill" title="<?= $lang['publicPorInfo']?>"></i><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="publicadoPor" id="publicadoPor" maxlength="100">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="isbn"><?=$lang['isbn']?></label>
                    <input type="text" class="form-control" name="isbn" id="isbn" maxlength="20">
                </div>
                <div class="col-md-6">
                    <label class="form-label" for="cidade"><?=$lang['cidade']?></label>
                    <input type="text" class="form-control" name="cidade" id="cidade" maxlength="100">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="ano"><?=$lang['anoPublic']?></label>
                    <input type="number" class="form-control" name="ano" id="ano" maxlength="4">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="pag"><?=$lang['paginas']?></label>
                    <input type="text" class="form-control" name="pag" id="pag" placeholder="145-223" maxlength="15">
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="volume"><?=$lang['volume']?></label>
                    <input type="number" class="form-control" name="volume" id="volume" maxlength="5">
                </div>
                <div class="col-md-12">
                    <label class="form-label" for="url"><?=$lang['url']?><span class="req"> *</span></label>
                    <input type="url" class="form-control" name="url" id="url" maxlength="2000" required>
                </div>
                <div class="col-md-9">
                    <label for="trabalhoPDF" class="form-label"><?=$lang['trabalhoPdf']?><span class="req"> *</span></label>
                    <input class="form-control" type="file" id="trabalhoPDF" name='trabalhoPDF'>
                    <div id="trabalhoFeedback" class="invalid-feedback"> </div>
                    <br>
                    <div class="progress" style="display: none;">
                        <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                            0%
                        </div>
                    </div>
                    <div id="divNomeTrabalho" style="display: none;">
                        <input type="hidden" name="hdnNameTrabalho" id="hdnNameTrabalho">
                        <div class="row" id="divUpado">
                            <div id="txtUpado" class="col-11 text-truncate"></div>
                            <div class="col-1" style="text-align:right;">
                                <button type="button" id="btnExclui" class="btn-close" aria-label="Excluir"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="top20"  style="text-align:center;">
                    <input type="submit" id='btnEnviaForm' class="btn btn-success" name="enviar" value="<?=$lang['btnEnviar']?>">
                </div>
            </form>
        </div>
    </div>
    <?php
    include 'includes/foot.php';
}