<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
if(isset($_FILES['arqCSV'], $_POST['newCsv'])) {
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
        
        $contNovo = '0';
        /*------$contDuplicado = '0';*/
        $arrErro = array();
        while(($dados = fgetcsv($obj, 10000, ',')) !== FALSE){
            //para garantir que o tipo de trabalho esteja sempre esteja preenchido
            /*if (trim($dados[5]) == ''){
                $tipoTrab = 100;
            }
            else{
                $tipoTrab = trim($dados[5]);
            }*/
            $tipoTrab = trim($dados[4]) == '' ? 100 : trim($dados[4]);
            $paramsTrabalho = array(
                ':titulo'       => trim($dados[3], ' '),
                ':cdTipo'       => $tipoTrab,
                ':revista'      => trim($dados[5], ' '),
                ':anoPublic'    => trim($dados[6], ' '),
                ':volume'       => trim($dados[7], ' '),
                ':pagina'       => trim($dados[8], ' '),
                ':instit'       => trim($dados[9], ' '),
                ':cidade'       => trim($dados[10], ' '),
                ':editora'      => trim($dados[11], ' '),
                ':isbn'         => trim($dados[12], ' '),
                ':dtPublic'     => trim($dados[13], ' '),
                ':dtConsulta'   => trim($dados[14], ' '),
                ':url'          => trim($dados[15], ' '),
                ':doi'          => trim($dados[16], ' '),
                ':nomeArquivo'  => trim($dados[17], ' '),
                ':publico'      => trim($dados[18], ' '),
                ':cdUsuario'    => trim($dados[19], ' '),
                ':status'       => trim($dados[20], ' ')
            );
            /*
            //Verificar se existe erro na busca por duplicado e não grava-lo
            $booErroTrab = true;
            // rotina para verificar duplicidade de trabalhos
            $cdCompara = comparaTitulo($conn, array(':titulo' => trim($dados[2], ' ')));
            if($cdCompara == ''){
                $duplicado = false;
            }
            else if(is_numeric($cdCompara)){
                $duplicado = true;
            }
            else{
                array_push($arrErro, "Não foi possível armazenar o trabalho ".$paramsTrabalho[':titulo']."! Erro: $cdCompara");
                $booErroTrab = false;
            }
            //Se não for duplicado grava no banco
            if(!$duplicado && $booErroTrab){
            */    
                $cdTrabalho = gravaTrabalho ($conn, $paramsTrabalho);
                //se retornar o numero do cdTrabalho dá continuidade ao processo
                if(is_numeric($cdTrabalho) ){
                    
                    //Adiciona ao contador de trabalhos
                    $contNovo++;
                    //arrCdChave para armazenar as novas chaves
                    $arrCdChave = explode (",", trim($dados[1], ' '));
                    for($i = 0; $i < count($arrCdChave); $i++){
                        $gravChavTrab = gravaChaveTrabalho($conn, array(':cdChave' => trim($arrCdChave[$i], ' '), ':cdTrabalho' => $cdTrabalho));
                    }


/*
                    //Adiciona ao contador de trabalhos
                    $contNovo++;
                    //arrCdChave para armazenar as novas chaves
                    $arrCdChave = array();
                    //booAutor para permitir gravar autor
                    $booAutor = true;
                    //booChave para validar o CSV
                    $booChave = true;
                    $arrChave = explode (",", trim($dados[1], ' '));
                    //array para armazenar as chaves adicinadas para evitar chaves iguais no mesmo trabalho
                    $arrValidaChave = array();
                    for($i = 0; $i < count($arrChave); $i++){

                        $gravChavTrab = gravaChaveTrabalho($conn, array(':cdChave' => $cdChave, ':cdTrabalho' => $cdTrabalho));

                        /*
                        $strChave = mb_strtoupper(trim($arrChave[$i], ' '), 'UTF-8');
                        if($strChave != ''){
                            $cdChave = buscaChaveStr($conn, array(':dsChave' => $strChave));
                            //Se não houver a chave, grava e ativa a var booChave
                            if( $cdChave == ''){
                                $cdChave = gravaChave($conn, array(':dsChave' => $strChave));
                                array_push($arrCdChave, $cdChave);
                            }
                            //Rotina para localizar chave duplicada no mesmo trabalho
                            $booValidaChave = true;
                            foreach ( $arrValidaChave as $linhaChave ){
                                if($linhaChave == $strChave){
                                    $booValidaChave = false;
                                }
                            }
                            //se não for duplicado, grava o ralacionamento da chave com o trabalho e  adiciona a chave no array
                            if($booValidaChave){
                                $gravChavTrab = gravaChaveTrabalho($conn, array(':cdChave' => $cdChave, ':cdTrabalho' => $cdTrabalho));
                                array_push($arrValidaChave, $strChave);
                            }

                            /*
                            //se houver erro ao gravar a chave
                            if($gravChavTrab != 0){
                                //primeiro encerrar o for
                                $i = count($arrChave);
                                //seguendo proibir o autor
                                $booAutor = false;
                                //deletar as chaves_trabalhos já inseridas
                                excluiChaveTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                //se foram armazenadas novas chaves, exclui-las
                                if(count($arrCdChave) > 0){
                                    foreach ( $arrCdChave as $cdChave){
                                        excluiChave($conn, array(':cdChave' => $cdChave));
                                    }
                                }
                                //excluir o trabalho
                                excluiTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                //Reduz um do contador de trabalhos
                                $contNovo--;
                                //por fim armazenar o erro
                                array_push($arrErro, "Não foi possível armazenar a chave $strChave, o trabalho ".$paramsTrabalho[':titulo']." não foi armazenado! Erro: $gravChavTrab");
                            }

                            
                        }
                    }*/
             //       if($booAutor){
                        //arrCdAutor para armazenar os novos Autores
                        $arrCdAutor = array();
                        $arrAutor = explode (";", trim($dados[2], ' '));
                        for($i = 0; $i < count($arrAutor); $i++){
                            $strAutor = mb_strtoupper(trim($arrAutor[$i], ' '), 'UTF-8');
                            $cdAutor = buscaAutorStr($conn, array(':dsAutor' => $strAutor));
                            //se retornar um numero continua o processo
                            if(is_numeric($cdAutor) || $cdAutor == '' && $strAutor != ''){
                                if( $cdAutor == ''){
                                    $cdAutor = gravaAutor($conn, array(':dsAutor' => $strAutor));
                                }
                                $gravAutTrab = gravaAutorTrabalho($conn, array(':cdAutor' => $cdAutor, ':cdTrabalho' => $cdTrabalho));
                                /*
                                if($gravAutTrab != 0){
                                    //primeiro encerrar o for
                                    $i = count($arrAutor);
                                    //deletar os autor_trabalhos já inseridas
                                    excluiAutorTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                    //se foram armazenados novos Autores, exclui-los
                                    if(count($arrCdAutor) > 0){
                                        foreach ( $arrCdAutor as $cdAutor){
                                            excluiAutor($conn, array(':cdAutor' => $cdChave));
                                        }
                                    }
                                    //deletar as chaves_trabalhos já inseridas
                                    excluiChaveTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                    //se foram armazenadas novas chaves, exclui-las
                                    if(count($arrCdChave) > 0){
                                        foreach ( $arrCdChave as $cdChave){
                                            excluiChave($conn, array(':cdChave' => $cdChave));
                                        }
                                    }
                                    //excluir o trabalho
                                    excluiTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                    //Reduz um do contador de trabalhos
                                    $contNovo--;
                                    //por fim armazenar o erro
                                    array_push($arrErro, "Não foi possível armazenar o autor $strAutor, o trabalho ".$paramsTrabalho[':titulo']." não foi armazenado! Erro: $cdAutor");   
                                }*/
                            }
                            //senão interrompe e realiza a exclusão dos itens já gravados
                            /*
                            else{
                                //primeiro encerrar o for
                                $i = count($arrAutor);
                                //deletar os autor_trabalhos já inseridas
                                excluiAutorTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                //se foram armazenados novos Autores, exclui-los
                                if(count($arrCdAutor) > 0){
                                    foreach ( $arrCdAutor as $cdAutor){
                                        excluiAutor($conn, array(':cdAutor' => $cdChave));
                                    }
                                }
                                //deletar as chaves_trabalhos já inseridas
                                excluiChaveTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                //se foram armazenadas novas chaves, exclui-las
                                if(count($arrCdChave) > 0){
                                    foreach ( $arrCdChave as $cdChave){
                                        excluiChave($conn, array(':cdChave' => $cdChave));
                                    }
                                }
                                //excluir o trabalho
                                excluiTrabalho($conn, array(':cdTrabalho' => $cdTrabalho));
                                //Reduz um do contador de trabalhos
                                $contNovo--;
                                //por fim armazenar o erro
                                if($strAutor == ''){
                                    array_push($arrErro, "Não foi possível inserir o trabalho ".$paramsTrabalho[':titulo']." pois o nome do autor está em branco!");
                                }
                                else{
                                    array_push($arrErro, "Não foi possível localizar o autor $strAutor, o trabalho ".$paramsTrabalho[':titulo']." não foi armazenado! Erro: $cdAutor");
                                }
                            }*/
                        }
                //    }
                    //se cdTrabalho e cdCsv forem numéricos (não houve erro na gravação. PS: caso haja problemas na chave ou no autor , ele )
                    //if(is_numeric($cdCsv) && is_numeric($cdTrabalho) && $booAutor && $booChave){
                    if(is_numeric($cdCsv) && is_numeric($cdTrabalho)){
                        gravaCsvTrabalho($conn, array(':cdCsv' => $cdCsv, ':cdTrabalho' => $cdTrabalho));
                    }
                }
                //se não armazena no array de erros
                else{
                    array_push($arrErro, "Não foi possível armazenar o trabalho ".$paramsTrabalho[':titulo']."! Erro: $cdTrabalho");
                }
            /*}
            //Se for duplicado enviar para a session para ser consultado em duplicados.php
            else if($booErroTrab){
                $arrDuplicado[$cdCompara] = $paramsTrabalho;
                $contDuplicado++;
            }*/
        }
        //$_SESSION['duplicados'] = $arrDuplicado;
        //gravar os erros no banco
        $gravaErro = array();
        $contErro = 0;
        foreach($arrErro as $dadoErro){
            gravaErro($conn, array(':cdCsv' => $cdCsv, ':dsErro' =>  $dadoErro));
            $contErro++;
        }
        //echo json_encode(array('duplicado' => $contDuplicado, 'novo' => $contNovo, 'erro' =>$contErro));
        echo json_encode(array('novo' => $contNovo, 'erro' =>$contErro));

        //fechando o arquivo CSV
        fclose($obj);

        //armazenar o CSV no servidor
        move_uploaded_file($arq, $dir . $newName);
    }
    else{
        echo 'erroExt';
    }
}
else{
    require_once 'includes/head.php';
    getHead("Trabalhos", '', 'js/js-csv.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        if(isset($_GET['t'])){
            $tipo = $_GET['t'];
        }
        else{
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
                            <!--input type="hidden" name="csv" value="<?=$tipo?>"-->
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
                            <img src="img/load.gif" class="img-responsive" alt="Responsive image" width="75" height="60"/>
                            <p>Carregando os dados</p>
                        </div>
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