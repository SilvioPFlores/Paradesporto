<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
if (isset($_FILES['arqCSV'], $_POST['newCsv'])) {
    $arq = $_FILES['arqCSV']['tmp_name'];
    //Define os dados para armazenar o CSV no servidor
    $user = $_SESSION['repositorio']['user'];
    $newName = $user . '_' . date("Y-m-d-H.i.s") . '.csv';
    $dir = 'csv/';

    //gravar os dados do CSV no Banco
    $paramsCsv = array(':nmOrig' => $_FILES['arqCSV']['name'], ':nmNovo' => $newName, ':cdUser' => $_SESSION['repositorio']['cdAcesso'], ':tpCsv' => $_POST['tpCsv']);
    $cdCsv = gravaCsv($conn, $paramsCsv);

    //Se a extenção do arquivo for CSV continua
    if (pathinfo($_FILES['arqCSV']['name'], PATHINFO_EXTENSION) == 'csv') {
        //abrindo o arquivo CSV
        $obj = fopen($arq, 'r');

        $contNovo = '0';
        $arrErro = array();
        while (($dados = fgetcsv($obj, 10000, ',')) !== FALSE) {
            $cdUsuario = trim($dados[15]) == '' ? NULL : trim($dados[15]);
            $paramsTrabalho = array(
                ':titulo'       => trim($dados[3], ' '),
                ':cdTipo'       => trim($dados[4], ' '),
                ':publicadoPor' => trim($dados[5], ' '),
                ':anoPublic'    => trim($dados[6], ' '),
                ':volume'       => trim($dados[7], ' '),
                ':pagina'       => trim($dados[8], ' '),
                ':cidade'       => trim($dados[9], ' '),
                ':isbn'         => trim($dados[10], ' '),
                ':dtConsulta'   => trim($dados[11], ' ') != '' ?trim($dados[11], ' ') : date('d/m/Y'),
                ':url'          => trim($dados[12], ' '),
                ':nomeArquivo'  => trim($dados[13], ' '),
                ':publico'      => trim($dados[14], ' ') != '' ?trim($dados[14], ' ') : 'N',
                ':cdUsuario'    => $cdUsuario,
                ':status'       => trim($dados[16], ' ') != '' ?trim($dados[16], ' ') : 'AT'
            );
            $cdTrabalho = gravaTrabalho($conn, $paramsTrabalho);
            //se retornar o numero do cdTrabalho dá continuidade ao processo
            if (is_numeric($cdTrabalho)) {

                //Adiciona ao contador de trabalhos
                $contNovo++;
                //arrCdChave para armazenar as novas chaves
                $arrCdChave = explode(",", trim($dados[1], ' '));
                for ($i = 0; $i < count($arrCdChave); $i++) {
                    $gravChavTrab = gravaChaveTrabalho($conn, array(':cdChave' => trim($arrCdChave[$i], ' '), ':cdTrabalho' => $cdTrabalho));
                }

                $arrCdAutor = array();
                $arrAutor = explode(";", trim($dados[2], ' '));
                for ($i = 0; $i < count($arrAutor); $i++) {
                    $strAutor = mb_strtoupper(trim($arrAutor[$i], ' '), 'UTF-8');
                    $cdAutor = buscaAutorStr($conn, array(':dsAutor' => $strAutor));
                    //se retornar um numero continua o processo
                    if (is_numeric($cdAutor) || $cdAutor == '' && $strAutor != '') {
                        if ($cdAutor == '') {
                            $cdAutor = gravaAutor($conn, array(':dsAutor' => $strAutor));
                        }
                        $gravAutTrab = gravaAutorTrabalho($conn, array(':cdAutor' => $cdAutor, ':cdTrabalho' => $cdTrabalho));
                    }
                }
                if (is_numeric($cdCsv) && is_numeric($cdTrabalho)) {
                    gravaCsvTrabalho($conn, array(':cdCsv' => $cdCsv, ':cdTrabalho' => $cdTrabalho));
                }
            }
            //se não armazena no array de erros
            else {
                array_push($arrErro, "Não foi possível armazenar o trabalho " . $paramsTrabalho[':titulo'] . "! Erro: $cdTrabalho");
            }
        }
        //gravar os erros no banco
        $gravaErro = array();
        $contErro = 0;
        foreach ($arrErro as $dadoErro) {
            gravaErro($conn, array(':cdCsv' => $cdCsv, ':dsErro' =>  $dadoErro));
            $contErro++;
        }
        echo json_encode(array('novo' => $contNovo, 'erro' => $contErro));

        //fechando o arquivo CSV
        fclose($obj);

        //armazenar o CSV no servidor
        move_uploaded_file($arq, $dir . $newName);
    } else {
        echo 'erroExt';
    }
} else {
    require_once 'includes/head.php';
    getHead("Trabalhos", '', 'js/js-csv.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        if (isset($_GET['t'])) {
            $tipo = $_GET['t'];
        } else {
            $tipo = '';
        }
?>
        <!-- Bloco Página -->
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divMd">
                    <fildset>
                        <legend>Cadastrar Trabalho via CSV</legend>
                        <form id="cadCsv" action="csv.php" method="POST">
                            <input type="hidden" name="newCsv" value="true">
                            <!--input type="hidden" name="csv" value="<?= $tipo ?>"-->
                            <input type="hidden" name="tpCsv" value="t">
                            <div class="mb-3">
                                <label for="cadCsv" class="form-label">Somente arquivo no formato CSV</label>
                                <input class="form-control" type="file" id="arqCSV" name='arqCSV' required>
                                <div id="arqCSVFeedback" class="invalid-feedback">
                                    Somente arquivos nos formatos CSV.
                                </div>
                                <div id="arqCSVSize" class="invalid-feedback">
                                    Tamanha máximo para arquivo 100M.
                                </div>
                            </div>
                            <br>
                            <div class="progress">
                                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    0%
                                </div>
                            </div>
                            <br>
                            <div class="center">
                                <input type="button" id="btnVoltar" class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                <input type="submit" id="btnEnviaForm" class="btn btn-success" value="Importar">
                            </div>
                        </form>
                        <br>
                        <div id="divLoad" style="display:none;">
                            <img src="img/load.gif" class="img-responsive" alt="Responsive image" width="75" height="60" />
                            <p>Carregando os dados</p>
                        </div>
                    </fildset>
                </div>
            </div>
        </div>
<?php
    } else {
        header("Location: index.php");
    }
    require_once "includes/foot.php";
}
