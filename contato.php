<?php
require_once 'db/dbConnection.php';
require_once 'query/query-contato.php';
include 'config/config.php';
include 'includes/head.php';
getHead($lang['contato'], $lang, '', 'css/css-contato.css', 'js/js-contato.js');
include 'includes/menu.php';

if(isset($_POST['hdnEnviaContato']) && $_POST['hdnEnviaContato'] == 'novoContato'){
    if(isset($_POST['txtNome'],$_POST['txtMail'],$_POST['full_number'],$_POST['rdoPcd'],$_POST['cmbPcd'],$_POST['txtApoio'],$_POST['txtAssunto'],$_POST['txtMensagem'])){
        if($_POST['cmbPcd'] != ''){
            $cdPcd = $_POST['cmbPcd'];
        }
        else{
            $cdPcd = 99;
        }
        $dsPcd = buscaTipoPcdCd($conn, array(':cdPcd' => $cdPcd));
        $arrParams = array(
            ':dsNome' => $_POST['txtNome'],
            ':dsEmail' => $_POST['txtMail'],
            ':dsFone' => $_POST['full_number'],
            ':icPcd' => $_POST['rdoPcd'],
            ':cdPcd' => $cdPcd,
            ':dsApoio' => $_POST['txtApoio'],
            ':dsAssunto' => $_POST['txtAssunto'],
            ':txMensagem' => $_POST['txtMensagem']);
        
        $reciboContato = gravaContato($conn, $arrParams);
        if ($reciboContato == 'ok') {
            //Enviar email
            include "email/enviaEmail.php";
            $retornoMail = enviaContato($arrParams, $dsPcd );
            echo "<script>okNewPage('".$lang['msgOk']."', 'index.php');</script>";
        }
        else {
            echo "<script>erroNewPage('".$lang['msgErro']."<br>Erro $retornoMail', 'material.php');</script>";
        }
    }
}
else{
    menu(strtoupper($lang['contato']));
    $arrTipoPcd = buscaTipoPcd($conn, 'ds_pcd_'.$lang['lang']);
    ?>
    <div class="container">
        <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
            <form class="row g-3" method="post" onsubmit="this.enviar.value='<?=$lang['btnEnviando']?>'; this.enviar.disabled=true;">
                <input type="hidden" name="hdnEnviaContato" value="novoContato">
                <div class="col-sm-6"><h4><?=$lang['dados']?></h4></div>
                <div class="col-sm-6 direita">
                    <a href="mailto:paradesporto.acessivel@gmail.com"><img src="img/envelope.png">paradesporto.acessivel@gmail.com</a>
                </div>
                <div class="col-12">
                    <label for="txtNome" class="form-label"><?=$lang['nome']?><span class="req"> *</span></label>
                    <input type="text" class="form-control" name="txtNome" id="txtNome" required>
                </div>
                <div class="col-12">
                    <label for="txtMail" class="form-label"><?=$lang['mail']?><span class="req"> *</span></label>
                    <input type="mail" class="form-control" name="txtMail" id="txtMail" required>
                </div>
                <div class="col-sm-5">
                    <label for="phone" class="form-label"><?=$lang['fone']?></label><br>
                    <input type="tel" class="form-control" name="phone" id="phone">
                </div>
                <div class="col-sm-7">
                    <label class="form-label"><?=$lang['vcPcd']?><span class="req"> *</span></label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdoPcd" id="pcdS" value="S" required>
                        <label class="form-check-label" for="pcdS"><?=$lang['sim']?></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rdoPcd" id="pcdN" value="N" required>
                        <label class="form-check-label" for="pcdN"><?=$lang['nao']?></label>
                    </div>
                </div>
                <div class="classePcd">
                    <div class="container">
                        <div class="col-12">
                            <label for="cmbPcd" class="form-label"><?=$lang['qDef']?><span class="req"> *</span></label>
                            <select class="form-select" id="cmbPcd" name="cmbPcd">
                                <option value="" selected><?=$lang['selecione']?></option>
                                <?php
                                foreach( $arrTipoPcd as $dado){
                                    echo "<option value='$dado[0]'>$dado[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-12 top10">
                            <label for="txtApoio" class="form-label"><?=$lang['vcApoio']?></label>
                            <input type="text" class="form-control" name="txtApoio" id="txtApoio">
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <label for="txtAssunto" class="form-label"><?=$lang['assunto']?></label>
                    <input type="text" class="form-control" name="txtAssunto" id="txtAssunto">
                </div>
                <div class="col-12">
                    <label for="txtMensagem" class="form-label"><?=$lang['msg']?></label>
                    <textarea class="form-control" name="txtMensagem" id="txtMensagem" rows="3"></textarea>
                </div>
                <div style="text-align:center;">
                    <input type="submit" id='btnEnviaForm' class="btn btn-success" name="enviar" value="<?=$lang['btnEnviar']?>">
                </div>
            </form>
        </div>
    </div>
    <?php
    include 'includes/foot.php';
}