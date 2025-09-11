<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
require_once 'query/query-trabalhoAutor.php';

//Se o trabalho for recusado e fazer .... e mandar e-mail de recusa
if(isset($_POST['recusarTrabalho'], $_POST['cdTrabalho'])){
    //Alterando o status do trabalho para "Recusado" (RC)
    $validRecusa = alteraStatusTrabalho($conn, array(':cdTrabalho' => $_POST['cdTrabalho'], ':status' => 'RC'));

    if($validRecusa == '0'){
        //buscando nome e email de usuário para enviar o email de trabalho recusado           
        $arrUsuario = buscaUsuario($conn, array(':cdTrabalho' => $_POST['cdTrabalho']));
        include "email/enviaEmail.php";
        $retornoMail = emailRecusa($arrUsuario['ds_usuario'], $arrUsuario['ds_mail'], $_POST['cdTrabalho']);
        echo "$validRecusa|$retornoMail";
    }
    else{
        echo "$validRecusa|1";
    }
}
else{
    require_once 'includes/head.php';
    getHead("Trabalhos", 'css/css-trabalhoAutor.css', 'js/js-trabalhoAutor.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        if(isset($_POST['hdnSalvarTrabalho'], $_POST['cdTrabalho'], $_POST['titulo'], $_POST['hdnNomeTrab']) && $_POST['hdnSalvarTrabalho'] == "salvarTrabalho"){
            $cdTrabalho = $_POST['cdTrabalho'];
            $ext = pathinfo($_POST['hdnNomeTrab'], PATHINFO_EXTENSION);
            $new_name = $cdTrabalho . 'd' . md5($_POST['titulo']) . '.' . $ext;
            $dir = '../repositorio/trabalhos/';
            //define origem e destino
            $origem = '../repositorio/trabalhos/valid/'.$_POST['hdnNomeTrab'];
            $destino = $dir . $new_name;
            
            if(isset($_POST['revista'],$_POST['ano'],$_POST['volume'],$_POST['pag'],$_POST['instit'],$_POST['data'],$_POST['url'],$_POST['doi'],$_POST['editora'],$_POST['isbn'],$_POST['cidade'],$_POST['cmbTipoTrabalho'])){
                $paramsTrabalho = array(
                    ':cdTrabalho'   => $cdTrabalho,
                    ':titulo'       => trim($_POST['titulo']),
                    ':revista'      => trim($_POST['revista']),
                    ':anoPublic'    => trim($_POST['ano']),
                    ':volume'       => trim($_POST['volume']),
                    ':pagina'       => trim($_POST['pag']),
                    ':instit'       => trim($_POST['instit']),
                    ':url'          => trim($_POST['url']),
                    ':doi'          => trim($_POST['doi']),
                    ':editora'      => trim($_POST['editora']),
                    ':isbn'         => trim($_POST['isbn']),
                    ':cidade'       => trim($_POST['cidade']),
                    ':nmArquivo'    => $new_name,
                    ':publico'      => 'S',
                    ':status'       => 'AT',
                    ':cdTipo'       => trim($_POST['cmbTipoTrabalho'])
                );
                //solução para tratar data em branco
                if(trim($_POST['data']) != ''){
                    $paramsTrabalho[':dtPublic'] = trim($_POST['data']);
                }
                $cdUpTrab = alteraTrabalho ($conn, $paramsTrabalho);
            }
            if(isset($_POST['chkChave'])){
                $contDelChave = excluiChaveTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                foreach($_POST['chkChave'] as $dadoChave){
                    $cdUpChave = gravaChaveTrabalho($conn, array(':cdChave' => $dadoChave, ':cdTrabalho' => $cdTrabalho));
                }
            }
            if(isset($_POST['autor'])){
                $contDel = excluiAutorTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                $arrAutor = explode (",", $_POST['autor']);
                for($i = 0; $i < count($arrAutor); $i++){
                    $strAutor = mb_strtoupper(trim($arrAutor[$i], ' '), 'UTF-8');
                    $cdAutor = buscaAutorStr($conn, array(':dsAutor' => $strAutor));
                    if( $cdAutor == ''){
                        $cdAutor = gravaAutor($conn, array(':dsAutor' => $strAutor));
                    }
                    $cdUpAut = gravaAutorTrabalho($conn, array(':cdAutor' => $cdAutor, ':cdTrabalho' => $cdTrabalho));
                }
            }
            //rotina para excluir autores e chaves que não possuam trabalhos
            excluiAutorSemTrabalho($conn);
            excluiChaveSemTrabalho($conn);
            //Movendo o arquivo da base provisória para base de produção
            copy($origem, $destino);
            unlink($origem);
            //buscando nome e email de usuário para enviar o email de trabalho aceito           
            $arrUsuario = buscaUsuario($conn, array(':cdTrabalho' => $cdTrabalho));
            include "email/enviaEmail.php";
            $retornoMail = emailAceita($arrUsuario['ds_usuario'], $arrUsuario['ds_mail'], $cdTrabalho);
            if ($cdUpTrab == '0' && $retornoMail == 'ok') {
                echo "<script>okNewPage('Trabalho aceito com sucesso!', 'trabalhoAutor.php');</script>";
            }
            else if ($cdUpTrab == '0' && $retornoMail != 'ok') {
                echo "<script>alertNewPage('Trabalho aceito com sucesso! Mas não foi possível enviar e-mail! Erro $retornoMail<br>".$arrUsuario['ds_mail']."  ".$arrUsuario['ds_usuario']."', 'trabalhoAutor.php');</script>";
            } 
            else {
                echo "<script>erroNewPage('Erro ao aceitar o trabalho - $cdUpTrab', 'trabalhoAutor.php');</script>";
            }
        }
        else{
            if(isset($_POST['hdnVerTrabalho'])){
                include_once 'includes/forms/form-usuario.php';
                include_once 'includes/forms/form-trabalho2.php';
                $paramsTrabalho = array(':cdTrabalho' => $_POST['cdTrabalho']);
                $arrUsuario = buscaUsuario($conn, $paramsTrabalho);
                $arrChave = buscaChave($conn);
                $arrTrabalho = buscaTrabalhoCod($conn, $paramsTrabalho);
                $arrTpTrab = buscaTipoTrabalho($conn);
                $arrAutor = buscaAutorCod($conn, $paramsTrabalho);
                $strAutor = '';
                foreach ($arrAutor as $dadoAutor){
                    $strAutor .= $dadoAutor[0].', ';
                }
                $arrTrabalho[count($arrTrabalho)] = rtrim($strAutor, ", ");
                $arrTrabalho[count($arrTrabalho)] = buscaChaveTrabCod($conn, $paramsTrabalho);
                ?>
                <!-- Bloco Página -->
                <div class="container">
                    <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
                        <form class="row g-3" method="post" onsubmit="this.enviar.value='Autenticando...'; this.enviar.disabled=true; this.btnRecusar.disabled=true; this.btnVoltar.disabled=true;">
                            <input type="hidden" name="hdnSalvarTrabalho" value="salvarTrabalho">
                            <input type="hidden" name="cdTrabalho" id="cdTrabalho" value="<?=$_POST['cdTrabalho']?>">
                            <h4>Dados de contado</h4>
                            <?php
                            getUsuario($arrUsuario);
                            ?>
                            <h4>Informações do Trabalho</h4>
                            <?php
                            getTrabalho2($arrChave, $arrTpTrab, $arrTrabalho);
                            ?>
                            <br>
                            <div class="text-center">
                                <input type="button" id="btnVoltar" name="btnVoltar" class="btn btn-secondary" value="Voltar" onclick="window.location.href='trabalhoAutor.php';">
                                <?php
                                if($arrTrabalho[16] == 'IN'){
                                    ?>
                                    <input type="button" id="btnRecusar" name="btnRecusar" class="btn btnLaranja" value="Recusar">
                                    <input type="submit" id="btnEnviaForm" name="enviar" class="btn btn-success" value="Aceitar">
                                    <?php
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            else{
                $arrTitulo = buscaTituloAutor($conn);
                ?>
                <!-- Bloco Página -->
                <div class="container">
                    <div class='divConteudo'>
                        <br>
                        <div class="divGd">
                            <fildset>
                                <legend>Consultar trabalhos recebidos de autores</legend>
                                    <hr>
                                    <?php
                                    if (empty($arrTitulo)) {
                                        echo 'A busca não encontrou nenhum resultado!';
                                    }
                                    foreach ($arrTitulo as $dadoTitulo){
                                        if($dadoTitulo['ic_status'] == 'AT'){
                                            $classeStatus = 'btn btn-outline-success btn-md divMax';
                                        }
                                        else if($dadoTitulo['ic_status'] == 'IN'){
                                            $classeStatus = 'btn btn-outline-warning btn-md divMax';
                                        }
                                        else if($dadoTitulo['ic_status'] == 'RC'){
                                            $classeStatus = 'btn btn-outline-danger btn-md divMax';
                                        }
                                        echo"
                                        <form action='trabalhoAutor.php' method=post>
                                        <input type='hidden' name='hdnVerTrabalho' value='true'>
                                        <input type='hidden' name='cdTrabalho' value='$dadoTitulo[0]'>
                                            <input type='submit' class='$classeStatus' value='".str_replace("'", "&#39;", $dadoTitulo[1])."'>
                                        </form>";
                                    }
                                ?>
                            </fildset>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
    else{
        header("Location: index.php");
    }
    require_once "includes/foot.php";
}