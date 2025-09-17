<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
if(isset($_FILES['arqCSV'], $_POST['newChaveCsv'], $_POST['tpCsv'])) {
    $arq = $_FILES['arqCSV']['tmp_name'];
    //Define os dados para armazenar o CSV no servidor
    $user = $_SESSION['repositorio']['user'];
    $newName = $user . '_' . date("Y-m-d-H.i.s") . '.csv';
    $dir = 'csv/';

    //gravar os dados do CSV no Banco
    $paramsCsv = array(':nmOrig' => $_FILES['arqCSV']['name'], ':nmNovo' => $newName, ':cdUser' => $_SESSION['repositorio']['cdAcesso'], ':tpCsv' => $_POST['tpCsv']);
    $cdCsv = gravaCsv($conn, $paramsCsv);
    
    //Se a extenção do arquivo for CSV continua
    if(pathinfo($_FILES['arqCSV']['name'], PATHINFO_EXTENSION) == 'csv'){
        //abrindo o arquivo CSV
        $obj = fopen($arq, 'r');

        $contNovo = 0;
        $arrErro = array();
        while(($dados = fgetcsv($obj, 10000, ',')) !== FALSE){
            
            $paramsChaves = array(
                ':cdChave'  => mb_strtoupper(trim($dados[0], ' '), 'UTF-8'),
                ':chavePt'  => mb_strtoupper(trim($dados[1], ' '), 'UTF-8'),
                ':chaveEn'  => mb_strtoupper(trim($dados[2], ' '), 'UTF-8'),
                ':chaveEs'  => mb_strtoupper(trim($dados[3], ' '), 'UTF-8')
            );
            $cdChave = gravaChave($conn, $paramsChaves);
            if(is_numeric($cdChave)){
                $contNovo++;
            }
            else{
                array_push($arrErro, "Não foi possível armazenar a Palavra-chave ".$paramsChaves[':chavePt']."! Erro: $cdChave");
            }
        }
        $contErro = 0;
        foreach($arrErro as $dadoErro){
            gravaErro($conn, array(':cdCsv' => $cdCsv, ':dsErro' =>  $dadoErro));
            $contErro++;
        }
        echo json_encode(array( 'novo' => $contNovo, 'erro' =>$contErro));

        //fechando o arquivo CSV
        fclose($obj);

        //armazenar o CSV no servidor
        move_uploaded_file($arq, $dir . $newName);
    }        
}
else{
    require_once 'includes/head.php';
    getHead('Palavra Chave', '', 'js/js-chave.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        if (isset($_POST['newChave']) && $_POST['newChave'] == 'true') {
            
        }
        else if (isset($_POST['editaChave']) && $_POST['editaChave'] == 'true') {
            
        }
        else if(isset($_POST['cdChave'],$_POST['verChave']) && $_POST['verChave'] == 'true'){
            $arrChave = buscaChaveCod($conn, array(':cdChave' => $_POST['cdChave']));
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divMd">
                        <fildset>
                            <legend>Editar Palavra Chave</legend>
                            <form action="chaves.php" method="POST">
                                <input type="hidden" name="cdChave" value="<?=$_POST['cdChave']?>">
                                <input type="hidden" name="editaChave" value="true">
                                <p>Código da Palavra Chave <?=$arrChave[0]?></p>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="txtChave" id="txtChave" placeholder="Palavra Chave" value="<?=$arrChave[1]?>" required>
                                    <label for="txtChave">Palavra Chave em Português</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="txtChave" id="txtChave" placeholder="Palavra Chave" value="<?=$arrChave[2]?>" required>
                                    <label for="txtChave">Palavra Chave em Inglês</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="txtChave" id="txtChave" placeholder="Palavra Chave" value="<?=$arrChave[3]?>" required>
                                    <label for="txtChave">Palavra Chave em Espanhol</label>
                                </div>
                                <br>
                                <div class="center">
                                    <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                    <input type="submit" id='btnAlterar' class="btn btn-success" value="Alterar">
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
        else if(isset($_POST['formImportCsv'])){
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divMd">
                        <fildset>
                            <legend>Cadastrar Palavras-Chave via CSV</legend>
                            <form id="cadChaveCsv" action="cheves.php" method="POST">
                                <input type="hidden" name="newChaveCsv" value="true">
                                <input type="hidden" name="tpCsv" value="c">
                                <div class="mb-3">
                                    <label for="arqCSV" class="form-label">Somente arquivo no formato CSV</label>
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
                                <img src="img/load.gif" class="img-responsive" alt="Responsive image" width="75" height="60"/>
                                <p>Carregando os dados</p>
                            </div>
                        </fildset>
                    </div>
                </div>
            </div>
            <?php
        }
        else if(isset($_POST['formNovaChave'])){
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divMd">
                        <fildset>
                            <legend>Nova Palavra Chave</legend>
                            <form action="chave.php" method="POST">
                                <input type="hidden" name="newChave" value="true">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="txtChave" id="txtChave" placeholder="Palavra Chave" required>
                                    <label for="txtChave">Palavra Chave</label>
                                </div>
                                <div class="center">
                                    <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                    <input type="submit" id='btnGravar' class="btn btn-success" value="Gravar">
                                </div>
                            </form>
                        </fildset>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            if(isset($_GET['b'])){
                $arrChave = buscaChavePart($conn,array(':dsChave' => "%".strtoupper($_GET['b'])."%"));
            
            }
            else if(isset($_GET['l'])){
                $arrChave = buscaChavePart($conn,array(':dsChave' => $_GET['l'].'%'));
                $l = $_GET['l'];
            }
            else{
                $arrChave = buscaChave($conn);
            }
            ?>
            <div class="container">
                <div class="col-xl-8 col-lg-10 col-md-11 col-sm-12 divCentro">
                    <br>
                    <h1>Palavras Chave</h1>
                    <hr>
                    <div class="row">
                    <div class="float-right col-6">
                        <form action="chaves.php" method="POST">
                            <input type="hidden" name="formNovaChave" value="novo">
                            <input type="submit" class="btn btn-primary btn-lg" value="Nova Palavra Chave">
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="chaves.php" method="POST">
                            <input type="hidden" name="formImportCsv" value="impCsv">
                            <input type="submit" class="btn btn-primary btn-lg" value="Importar CSV">
                        </form>
                    </div>
                    </div>
                    <br>
                    <form>
                        <div class="input-group mb-3">
                            <input type="text" name="b" class="form-control bordLaranja" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="btnBusca">
                            <button class="btn btnLaranja" type="submit" id="btnBusca"><img src="../repositorio/img/lupa.png" id="btnLupa"></button>
                        </div>
                    </form>
                    <?php
                    include '../repositorio/includes/listaAlfa.php';
                    buscaPor(array('buscaLetra' => 'Buscar por ', 'all' => 'Todas'), $l, 'chaves.php');
            
                    if (empty($arrChave)) {
                        echo "A busca não encontrou nenhum resultado!";
                    }
                        if (!empty($arrChave)) {
                            foreach ($arrChave as $dadoChave){
                                echo"
                                <form action='chaves.php' method=post>
                                    <input type='hidden' name='verChave' value='true'>
                                    <input type='hidden' name='cdChave' value='$dadoChave[0]'>
                                    <input type='submit' class='btn btn-outline-secondary btn-md divMax topMarg4' value='$dadoChave[1]'>
                                </form>";
                            }
                        }
                        else{
                            echo "Não foi localizada nenhuma Chave!";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    else{
        header("Location: index.php");
    }
    require_once "includes/foot.php";
}