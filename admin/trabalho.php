<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';

if(isset($_POST['newTrabalho'], $_POST['cmbTipoTrabalho']) && $_POST['newTrabalho'] == 'true'){
    $cdTrabalho = gravaNewTrabalho($conn, array(':cdTipo' => $_POST['cmbTipoTrabalho']));
    if(isset($_FILES['trabalhoPDF'], $_POST['titulo'])) {
        $tam = json_encode($_FILES['trabalhoPDF']);
        if($_FILES['trabalhoPDF']['error'] == 1){
            echo "Falha ao carregar a imagem!";
        }
        else{
            if($_FILES['trabalhoPDF']['error'] == 0){
                $path = $_FILES['trabalhoPDF']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $new_name = $cdTrabalho . 'd' . md5($_POST['titulo']) . '.' . $ext;
                $dir = '../repositorio/trabalhos/';
                move_uploaded_file($_FILES['trabalhoPDF']['tmp_name'], $dir . $new_name);
            }
            if(isset($_POST['publicadoPor'],$_POST['ano'],$_POST['volume'],$_POST['pag'],$_POST['dtAcesso'],$_POST['url'],$_POST['rdPublico'],$_POST['cmbTipoTrabalho'])){
                $paramsTrabalho = array(
                    ':cdTrabalho'   => $cdTrabalho,
                    ':titulo'       => trim($_POST['titulo']),
                    ':publicadoPor' => trim($_POST['publicadoPor']),
                    ':anoPublic'    => trim($_POST['ano']),
                    ':volume'       => trim($_POST['volume']),
                    ':pagina'       => trim($_POST['pag']),
                    ':url'          => trim($_POST['url']),
                    ':isbn'         => trim($_POST['isbn']),
                    ':cidade'       => trim($_POST['cidade']),
                    ':nmArquivo'    => $new_name,
                    ':publico'      => trim($_POST['rdPublico']),
                    ':cdTipo'       => trim($_POST['cmbTipoTrabalho'])
                );
                //solução para tratar data em branco
                if(trim($_POST['dtAcesso']) != ''){
                    $paramsTrabalho[':dtConsulta'] = trim($_POST['dtAcesso']);
                }
                $cdUpTrab = alteraTrabalho ($conn, $paramsTrabalho);
                if($cdUpTrab == 0){
                    alteraStatusTrabalho($conn, array(':cdTrabalho' => $cdTrabalho, ':status' => 'AT'));
                }
                else{
                    excluiTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                }
            }
            if(isset($_POST['chkChave'])){
                $contDelChave = excluiChaveTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                foreach($_POST['chkChave'] as $dadoChave){
                    $cdUpChave = gravaChaveTrabalho($conn, array(':cdChave' => $dadoChave, ':cdTrabalho' => $cdTrabalho));
                }
            }
            if(isset($_POST['autor'])){
                $contDel = excluiAutorTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                $arrAutor = explode (";", $_POST['autor']);
                for($i = 0; $i < count($arrAutor); $i++){
                    $strAutor = mb_strtoupper(trim($arrAutor[$i], ' '), 'UTF-8');
                    $cdAutor = buscaAutorStr($conn, array(':dsAutor' => $strAutor));
                    if( $cdAutor == ''){
                        $cdAutor = gravaAutor($conn, array(':dsAutor' => $strAutor));
                    }
                    $cdUpAut = gravaAutorTrabalho($conn, array(':cdAutor' => $cdAutor, ':cdTrabalho' => $cdTrabalho));
                }
            }
            //rotina para excluir autores que não possuam trabalhos
            excluiAutorSemTrabalho($conn);
            echo "$cdUpTrab$cdUpChave$cdUpAut|$tam";
        }
    }
}
else{
    require_once 'includes/head.php';
    getHead("Trabalhos",  '', 'js/js-trabalho.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        include_once 'includes/forms/form-trabalho.php';
        $arrChave = buscaChave($conn);
        $arrTpTrab = buscaTipoTrabalho($conn);
        ?>
        <!-- Bloco Página -->
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divGd">
                    <fildset>
                        <legend>Cadastrar Trabalho</legend>
                        <form id="formNewTrabalho" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="newTrabalho" value="true">
                            <?php
                            getTrabalho($arrChave, $arrTpTrab);
                            ?>
                            <br>
                            <div class="center">
                                <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                <input type="submit" id='btnEnviaForm' class="btn btn-success" value="Gravar">
                            </div>
                        </form>
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
}