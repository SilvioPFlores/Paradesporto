<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';

if(isset($_FILES['trabalhoPDF'], $_POST['upTrabalho'], $_POST['cdTrabalho'], $_POST['titulo'], $_POST['hdnNomeTrab']) && $_POST['upTrabalho'] == 'true') {
    $new_name = $_POST['hdnNomeTrab'];
    $cdTrabalho = $_POST['cdTrabalho'];
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
        if(isset($_POST['publicadoPor'],$_POST['ano'],$_POST['volume'],$_POST['pag'],$_POST['url'],$_POST['isbn'],$_POST['cidade'],$_POST['cmbTipoTrabalho'])){
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
        //rotina para excluir autores e chaves que não possuam trabalhos
        excluiAutorSemTrabalho($conn);
        //excluiChaveSemTrabalho($conn);
        echo "$cdUpTrab$cdUpChave$cdUpAut|$tam";
    }
}
else if(isset($_POST['cdTrabalho'])){
    require_once 'includes/head.php';
    getHead("Trabalhos", '', 'js/js-trabalho.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        include_once 'includes/forms/form-trabalho.php';
        $arrChave = buscaChave($conn);
        $paramsTrabalho = array(':cdTrabalho' => $_POST['cdTrabalho']);
        $arrTrabalho = buscaTrabalhoCod($conn, $paramsTrabalho);
        $arrTpTrab = buscaTipoTrabalho($conn);
        $arrAutor = buscaAutorCod($conn, $paramsTrabalho);
        $strAutor = '';
            foreach ($arrAutor as $dadoAutor){
                $strAutor .= $dadoAutor[0].'; ';
            }
            $arrTrabalho->strAutor = rtrim($strAutor, "; ");
            $arrTrabalho->chaves = buscaChaveTrabCod($conn, $paramsTrabalho);
        ?>
        <!-- Bloco Página -->
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divGd">
                    <fildset>
                        <legend>Alterar Trabalho</legend>
                        <form id="formTrabalho" action="alteraTrabalho.php" method="POST"  enctype="multipart/form-data">
                            <input type="hidden" name="upTrabalho" value="true">
                            <input type="hidden" name="cdTrabalho" id="cdTrabalho" value="<?=$_POST['cdTrabalho']?>">
                            <?php
                            getTrabalho($arrChave, $arrTpTrab, $arrTrabalho);
                            ?>
                            <br>
                            <div class="center">
                                <a class='btn btn-secondary' href='consulta.php'> Voltar </a>
                                <input type="submit" id='btnEnviaForm' class="btn btn-success" value="Alterar">
                                <button type="button" class="btn btn-danger" id="btnExcluir">
                                    Excluir
                                </button>
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
else{
    echo 'Verifique os dados enviados!';
}