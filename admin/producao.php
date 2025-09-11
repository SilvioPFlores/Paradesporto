<?php
session_start();
require_once 'db/dbConnection.php';
require_once 'query/query-producao.php';
if (isset($_POST['newProducao']) && $_POST['newProducao'] == 'true') {
    if(isset($_FILES['arqPdf'], $_FILES['arqEpub'], $_FILES['arqImg'], $_FILES['arqMp3'], $_POST['titulo'])) {
        if($_FILES['arqPdf']['error'] == 1){
            echo "Falha ao carregar a imagem!";
        }
        else{
            if($_FILES['arqPdf']['error'] == 0){
                $path = $_FILES['arqPdf']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nomePdf = limpaStr($_POST['titulo']). '.' . $ext;
                $dir = '../producao/conteudo/';
                move_uploaded_file($_FILES['arqPdf']['tmp_name'], $dir . $nomePdf);
            }
            if($_FILES['arqEpub']['error'] == 0){
                $path = $_FILES['arqEpub']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nomeEpub = 'epub-'.limpaStr($_POST['titulo']). '.' . $ext;
                $dir = '../producao/conteudo/';
                move_uploaded_file($_FILES['arqEpub']['tmp_name'], $dir . $nomeEpub);
            }
            if($_FILES['arqImg']['error'] == 0){
                $path = $_FILES['arqImg']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nomeImg = 'img-'.limpaStr($_POST['titulo']). '.' . $ext;
                $dir = '../producao/conteudo/';
                move_uploaded_file($_FILES['arqImg']['tmp_name'], $dir . $nomeImg);
            }
            if($_FILES['arqMp3']['error'] == 0){
                $path = $_FILES['arqMp3']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nomeMp3 = 'mp3-'.limpaStr($_POST['titulo']). '.' . $ext;
                $dir = '../producao/conteudo/';
                move_uploaded_file($_FILES['arqMp3']['tmp_name'], $dir . $nomeMp3);
            }
            if(isset($_POST['cmbTipo'],$_POST['altPt'],$_POST['altEn'],$_POST['altEs'])){
                $paramsProducao = array(
                    ':cdTipo'       => trim($_POST['cmbTipo']),
                    ':titulo'       => trim($_POST['titulo']),
                    ':altPt'        => trim($_POST['altPt']),
                    ':altEn'        => trim($_POST['altEn']),
                    ':altEs'        => trim($_POST['altEs']),
                    ':arquivo'      => $nomePdf,
                    ':epub'         => $nomeEpub,
                    ':foto'         => $nomeImg,
                    ':audio'        => $nomeMp3,
                    ':status'       => 'AT'
                );
                echo gravaProducao($conn, $paramsProducao);
            }
        }
    }
}
else if (isset($_POST['editaProducao']) && $_POST['editaProducao'] == 'true') {
    if(isset($_POST['cdProducao'],$_POST['hdnNomePdf'], $_POST['hdnNomeImg'], $_FILES['arqPdf'], $_FILES['arqEpub'], $_FILES['arqImg'], $_FILES['arqMp3'], $_POST['titulo'])) {
        $nomePdf = $_POST['hdnNomePdf'];
        $nomeEpub = $_POST['hdnNomeEpub'];
        $nomeImg = $_POST['hdnNomeImg'];
        $nomeMp3 = $_POST['hdnNomeMp3'];
        $cdTrabalho = $_POST['cdTrabalho'];
        if($_FILES['arqPdf']['error'] == 1){
            echo "Falha ao carregar a imagem!";
        }
        else{
            //caminho
            $dir = '../producao/conteudo/';
            //nome para o arquivo
            $tituloLimpo = limpaStr($_POST['titulo']);

            if($_FILES['arqPdf']['error'] == 0){
                $path = $_FILES['arqPdf']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (file_exists($dir.$tituloLimpo.'.'.$ext)) {
                    $cont = 1;
                    while (file_exists(sprintf("%s(%02d)", $dir.$tituloLimpo, $cont).'.'.$ext)) {
                        $cont++;
                    }
                    $tituloLimpo = sprintf("%s(%02d)", $tituloLimpo, $cont);
                }
                $nomePdf = $tituloLimpo.'.'.$ext;
                move_uploaded_file($_FILES['arqPdf']['tmp_name'], $dir . $nomePdf);
            }
            if($_FILES['arqEpub']['error'] == 0){
                $path = $_FILES['arqEpub']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (file_exists($dir.'epub-'.$tituloLimpo.'.'.$ext)) {
                    $cont = 1;
                    while (file_exists(sprintf("%s(%02d)", $dir.'epub-'.$tituloLimpo, $cont).'.'.$ext)) {
                        $cont++;
                    }
                    $tituloLimpo = sprintf("%s(%02d)", $tituloLimpo, $cont);
                }
                $nomeEpub = 'epub-'.$tituloLimpo.'.'.$ext;
                move_uploaded_file($_FILES['arqEpub']['tmp_name'], $dir . $nomeEpub);
            }
            if($_FILES['arqImg']['error'] == 0){
                $path = $_FILES['arqImg']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (file_exists($dir.'img-'.$tituloLimpo.'.'.$ext)) {
                    $cont = 1;
                    while (file_exists(sprintf("%s(%02d)", $dir.'img-'.$tituloLimpo, $cont).'.'.$ext)) {
                        $cont++;
                    }
                    $tituloLimpo = sprintf("%s(%02d)", $tituloLimpo, $cont);
                }
                $nomeImg = 'img-'.$tituloLimpo.'.'.$ext;

                move_uploaded_file($_FILES['arqImg']['tmp_name'], $dir . $nomeImg);
            }
            if($_FILES['arqMp3']['error'] == 0){
                $path = $_FILES['arqMp3']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (file_exists($dir.'mp3-'.$tituloLimpo.'.'.$ext)) {
                    $cont = 1;
                    while (file_exists(sprintf("%s(%02d)", $dir.'mp3-'.$tituloLimpo, $cont).'.'.$ext)) {
                        $cont++;
                    }
                    $tituloLimpo = sprintf("%s(%02d)", $tituloLimpo, $cont);
                }
                $nomeMp3 = 'mp3-'.$tituloLimpo.'.'.$ext;
                move_uploaded_file($_FILES['arqMp3']['tmp_name'], $dir . $nomeMp3);
            }
            if(isset($_POST['cmbTipo'],$_POST['altPt'],$_POST['altEn'],$_POST['altEs'],$_POST['cmb_status'])){
                $paramsProducao = array(
                    ':cdProducao'   => trim($_POST['cdProducao']),
                    ':cdTipo'       => trim($_POST['cmbTipo']),
                    ':titulo'       => trim($_POST['titulo']),
                    ':altPt'        => trim($_POST['altPt']),
                    ':altEn'        => trim($_POST['altEn']),
                    ':altEs'        => trim($_POST['altEs']),
                    ':arquivo'      => $nomePdf,
                    ':epub'         => $nomeEpub,
                    ':foto'         => $nomeImg,
                    ':audio'         => $nomeMp3,
                    ':status'       => $_POST['cmb_status']
                );
                echo alteraProducao($conn, $paramsProducao);
            }
        }
    }
}
else if (isset($_POST['hdnSalvarTrabalho']) && $_POST['hdnSalvarTrabalho'] == 'salvarTrabalho') {
    if(isset($_FILES['arquivo'], $_POST['cmbProducao'], $_POST['cmbTipoArquivo'], $_POST['cmbLingua'])){
        //caminho
        $dir = '../producao/conteudo/';
        //nome para o arquivo
        switch ($_POST['cmbTipoArquivo']){
            case '1': $coluna = 'nm_arquivo'; break;
            case '2': $coluna = 'nm_epub';    break;
            case '3': $coluna = 'nm_foto';    break;
            case '4': $coluna = 'nm_audio';   break;
        }
        $nomeArquivo = buscaNomeArquivo($conn, $coluna, array(':cdProducao' => $_POST['cmbProducao']));
        //nome sem a extenção
        $nome = str_replace('.'.pathinfo($nomeArquivo, PATHINFO_EXTENSION), '', $nomeArquivo);
        if(substr($nome, -1) == ')' && substr($nome, -4, 1) == '('){
            //nome sem o contador
            $nome = str_replace(substr($nome, -4), '', $nome);
        }
        if($_FILES['arquivo']['error'] == 0){
            $ext = pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION);
            $nomeFinal = $nome.'_'.$_POST['cmbLingua'].'.'.$ext;
            if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $nomeFinal)){
                echo 'ok';
            }
            else{
                echo 'Não foi possível mover o arquivo.';
            }
        }
        else{
            echo 'Erro ao carregar o arquivo.';
        }
    }
}
else{
    require_once 'includes/head.php';
    getHead('Produção', '', 'js/js-producao.js');
    require_once 'includes/menu.php';
    $nivel = $_SESSION['repositorio']['nivel'];
    if ($nivel != '') {
        getMenu($nivel);
        if(isset($_POST['formProdEstrangeira'])){
            $arrProducao = buscaProducao($conn);
            $arrTipoArquivo = buscaSubtipoDownload($conn);
            ?>
            <div class="container">
                <div class="col-xl-7 col-lg-9 col-md-11 col-sm-12 divCentro">
                <br>
                <h4>Novo documento em língua estrangeira</h4>
                <form id="docEstrang" class="row g-3" method="post">
                    <input type="hidden" name="hdnSalvarTrabalho" value="salvarTrabalho">
                        <div class="col-12">
                            <label class="form-label" for="cmbProducao">Selecione a Produção</label>
                            <select class="form-select" id="cmbProducao" name="cmbProducao" required>
                                <option selected value=''>Selecione</option>
                                <?php
                                foreach($arrProducao as $dadoProducao){
                                    echo "<option value='$dadoProducao[0]'>$dadoProducao[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="cmbTipoArquivo">Selecione o tipo de arquivo</label>
                            <select class="form-select" id="cmbTipoArquivo" name="cmbTipoArquivo" required>
                                <option selected value=''>Selecione</option>
                                <?php
                                foreach($arrTipoArquivo as $dadoTipo){
                                    echo "<option value='$dadoTipo[0]'>$dadoTipo[1]</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="cmbLingua">Selecione a linguagem</label>
                            <select class="form-select" id="cmbLingua" name="cmbLingua" required>
                                <option selected value=''>Selecione</option>
                                <option value='en'>Inglês</option>
                                <option value='es'>Espanhol</option>
                            </select>
                        </div>
                        <div class="col-9">
                            <input type="hidden" id="hdnTipo" value="">
                            <label for="arquivo" class="form-label">Anexar arquivo</label>
                            <input class="form-control " type="file" id="arquivo" name='arquivo' disabled required>
                            <div id="arquivoFeedback" class="invalid-feedback"> </div>
                            <br>
                            <div class="progress" style="display: none;">
                                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    0%
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <input type="submit" id="btnEnvia" name="enviar" class="btn btn-success" value="Adicionar">
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
        else if(isset($_POST['formNovoProducao'])){
            $arrTipo = buscaTipoProducao($conn);
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divGr">
                        <fildset>
                            <legend>Nova Producao</legend>
                            <form id="newProd" action="producao.php" method="POST">
                                <input type="hidden" name="newProducao" value="true">
                                <div class="form-floating  mb-3">
                                    <select class="form-select" id="cmbTipo" name="cmbTipo" required>
                                        <option value="">Selecione</option>
                                        <?php
                                        foreach ($arrTipo as $dadoTipo){
                                            echo "<option value='$dadoTipo[0]'>$dadoTipo[1]</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="cmbTipo">Tipo de Produção</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título" required>
                                    <label for="titulo">Título</label>
                                </div>
                                <hr>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altPt" id="altPt" placeholder="Descrição da imagem em Português" required style="height: 100px"></textarea>
                                    <label for="altPt">Descrição da imagem em Português</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altEn" id="altEn" placeholder="Descrição da imagem em Inglês" required style="height: 100px"></textarea>
                                    <label for="altEn">Descrição da imagem em Inglês</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altEs" id="altEs" placeholder="Descrição da imagem em Espanhol" required style="height: 100px"></textarea>
                                    <label for="altEs">Descrição da imagem em Espanhol</label>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="arqPdf" class="form-label">Anexar arquivo em PDF</label>
                                    <input class="form-control" type="file" id="arqPdf" name="arqPdf">
                                    <div id="arqPdfFeedback" class="invalid-feedback">
                                        Somente arquivos no formato PDF.
                                    </div>
                                    <div id="arqPdfSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 300M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="arqEpub" class="form-label">Anexar arquivo em ePUB</label>
                                    <input class="form-control" type="file" id="arqEpub" name="arqEpub">
                                    <div id="arqEpubFeedback" class="invalid-feedback">
                                        Somente arquivos no formato ePUB.
                                    </div>
                                    <div id="arqEpubSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 100M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="arqImg" class="form-label">Anexar imagem de exibição</label>
                                    <input class="form-control" type="file" id="arqImg" name="arqImg"  required>
                                    <div id="arqImgFeedback" class="invalid-feedback">
                                        Somente arquivos nos formatos .jpg .jpeg .png .gif.
                                    </div>
                                    <div id="arqImgSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 2M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="arqMp3" class="form-label">Anexar audio descrição</label>
                                    <input class="form-control" type="file" id="arqMp3" name="arqMp3">
                                    <div id="arqMp3Feedback" class="invalid-feedback">
                                        Somente arquivos nos formato MP3.
                                    </div>
                                    <div id="arqMp3Size" class="invalid-feedback">
                                        Tamanho máximo para arquivo 100M.
                                    </div>
                                </div>
                                <div class="progress">
                                    <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        0%
                                    </div>
                                </div>
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
        else if(isset($_POST['cdProducao'],$_POST['verProducao']) && $_POST['verProducao'] == 'true'){
            $arrtipo = buscaTipoProducao($conn);
            $arrProducao = buscaProducaoCod($conn, array(':cdProducao' => $_POST['cdProducao']));
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divGr">
                        <fildset>
                            <legend>Editar Produção</legend>
                            <form id="newProd" action="producao.php" method="POST">
                                <input type="hidden" name="editaProducao" value="true">
                                <input type="hidden" name="cdProducao" value="<?=$_POST['cdProducao']?>">
                                <div class="form-floating  mb-3">
                                    <select class="form-select" id="cmbTipo" name="cmbTipo" required>
                                        <option value="">Selecione</option>
                                        <?php
                                        foreach ($arrtipo as $dadoTipo){
                                            if($dadoTipo[0] == $arrProducao[1]){
                                                echo "<option value='$dadoTipo[0]' selected>$dadoTipo[1]</option>";
                                            }
                                            else{
                                                echo "<option value='$dadoTipo[0]'>$dadoTipo[1]</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <label for="cmbTipo">Tipo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Título em Português" value="<?=$arrProducao[2]?>"required>
                                    <label for="titulo">Título</label>
                                </div>
                                <hr>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altPt" id="altPt" placeholder="Descrição da imagem em Português" required style="height: 100px"><?=$arrProducao[3]?></textarea>
                                    <label for="altPt">Descrição da imagem em Português</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altEn" id="altEn" placeholder="Descrição da imagem em Inglês" required style="height: 100px"><?=$arrProducao[4]?></textarea>
                                    <label for="altEn">Descrição da imagem em Inglês</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" name="altEs" id="altEs" placeholder="Descrição da imagem em Espanhol" required style="height: 100px"><?=$arrProducao[5]?></textarea>
                                    <label for="altEs">Descrição da imagem em Espanhol</label>
                                </div>
                                <div class="form-floating  mb-3 mb-3">
                                    <select class="form-select" aria-label="Floating label select example" id="cmb_status" name="cmb_status">
                                        <?php
                                        if ($arrProducao[6] == 'AT') {
                                            echo "<option value='AT' selected>Ativo</option>";
                                            echo "<option value='IN' >Inativo</option>";
                                        } else {
                                            echo "<option value='AT' >Ativo</option>";
                                            echo "<option value='IN' selected>Inativo</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="cmb_status">Status:</label>
                                </div>
                                <hr>
                                <div class="mb-3">
                                    <label for="arqPdf" class="form-label">Anexar arquivo em PDF</label>
                                    <input class="form-control" type="file" id="arqPdf" name="arqPdf">
                                    <div id="arqPdfFeedback" class="invalid-feedback">
                                        Somente arquivos no formato PDF.
                                    </div>
                                    <div id="arqPdfSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 300M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" id="hdnNomePdf" name="hdnNomePdf" value="<?= $arrProducao[7] ?>">
                                    <?php
                                    if ($arrProducao[7] != ''){
                                        echo "<a href='../producao/conteudo/$arrProducao[7]' target='_blank'><img src='img/pdf.png' width='30px' height='35px'></a>";
                                    }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <label for="arqEpub" class="form-label">Anexar arquivo em ePUB</label>
                                    <input class="form-control" type="file" id="arqEpub" name="arqEpub">
                                    <div id="arqEpubFeedback" class="invalid-feedback">
                                        Somente arquivos no formato ePUB.
                                    </div>
                                    <div id="arqEpubSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 100M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" id="hdnNomeEpub" name="hdnNomeEpub" value="<?= $arrProducao[8] ?>">
                                    <?php
                                    if ($arrProducao[8] != ''){
                                        echo "<a href='../producao/conteudo/$arrProducao[8]' target='_blank'><img src='img/epub.png' width='30px' height='40px'></a>";
                                    }
                                    ?>
                                </div>
                                <?php
                                if ($arrProducao[9] != ''){
                                    $require = 'required';
                                }
                                else{
                                    $require = '';
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="arqImg" class="form-label">Anexar imagem de exibição</label>
                                    <input class="form-control" type="file" id="arqImg" name="arqImg"  value="<?= $require?>">
                                    <div id="arqImgFeedback" class="invalid-feedback">
                                        Somente arquivos nos formatos .jpg .jpeg .png .gif.
                                    </div>
                                    <div id="arqImgSize" class="invalid-feedback">
                                        Tamanho máximo para arquivo 2M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" id="hdnNomeImg" name="hdnNomeImg" value="<?= $arrProducao[9] ?>">
                                    <?php
                                    if ($arrProducao[9] != ''){
                                        echo "<a href='../producao/conteudo/$arrProducao[9]' target='_blank'><img src='../producao/conteudo/$arrProducao[9]' width='100px' height='auto'><a/>";
                                    }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <label for="arqMp3" class="form-label">Anexar arquivo em MP3</label>
                                    <input class="form-control" type="file" id="arqMp3" name="arqMp3">
                                    <div id="arqMp3Feedback" class="invalid-feedback">
                                        Somente arquivos no formato MP3.
                                    </div>
                                    <div id="arqMp3Size" class="invalid-feedback">
                                        Tamanho máximo para arquivo 100M.
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input type="hidden" id="hdnNomeMp3" name="hdnNomeMp3" value="<?= $arrProducao[10] ?>">
                                    <?php
                                    if ($arrProducao[10] != ''){
                                        echo "<a href='../producao/baixarArquivo.php?arquivo=$arrProducao[10]' target='_blank'><img src='img/audio.png' width='30px' height='30px'></a>";
                                    }
                                    ?>
                                </div>
                                <div class="progress">
                                    <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                        0%
                                    </div>
                                </div>
                                <br>
                                <div class="center">
                                    <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                    <input type="submit" id='btnAlterar' class="btn btn-success" value="Alterar">
                                </div>
                            </form>
                        </fildset>
                    </div>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <h1>Produção</h1>
                    <hr>
                    <div class="divMd text-center">
                        <?php
                        $arrProducao = buscaProducao($conn);
                        if (!empty($arrProducao)) {
                            foreach ($arrProducao as $dadoProducao){
                                if($dadoProducao[2] == 'AT'){
                                    $cor = 'btn-outline-secondary';
                                }
                                else{
                                    $cor = 'btn-outline-danger';
                                }
                                echo"
                                <form action='producao.php' method=post>
                                    <input type='hidden' name='verProducao' value='true'>
                                    <input type='hidden' name='cdProducao' value='$dadoProducao[0]'>
                                    <input type='submit' class='btn $cor btn-md divMax topMarg4' value='$dadoProducao[1]'>
                                </form>";
                            }
                        }
                        else{
                            echo "Não foi localizado nenhuma Produção!";
                        }
                        ?>
                        <hr> 
                        <form action="producao.php" method="POST">
                            <input type="hidden" name="formNovoProducao" value="novo">
                            <input type="submit" class="btn btn-primary btn-lg" value="Nova Produção">
                        </form>
                        <br>
                        <form action="producao.php" method="POST">
                            <input type="hidden" name="formProdEstrangeira" value="Estrangeira">
                            <input type="submit" class="btn btnLaranja" value="Adicionar Produção em lingua estrangeira">
                        </form>
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

function limpaStr($str) {
    $str = trim($str);
    $str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[ÁÀÃÂÄ]/ui', 'A', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[ÉÈÊË]/ui', 'E', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[ÍÌÎÏ]/ui', 'I', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[ÓÒÕÔÖ]/ui', 'O', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ÚÙÛÜ]/ui', 'U', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    $str = preg_replace('/[Ç]/ui', 'C', $str);
    $str = preg_replace('/[^a-zA-Z0-9\s]/', '', $str);
    $str = preg_replace('/[ -]+/', '_', $str);
    return $str;
}