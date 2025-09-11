<?php
require_once 'db/dbConnection.php';
require_once 'query/query-producao.php';
include 'config/config.php';
include 'includes/head.php';
getHead($lang['producao'], $lang);
include '../includes/menu.php';
menu($lang['producaoUp']);
include 'includes/modal/modal-producao.php';
?>
<div class="container">
    <br>
    <?php
    $arrTipo = buscaTipoProducao($conn, $lang['lang']);
    foreach ($arrTipo as $dadoTipo){
        ?>
        
        <div class="text-center" style="width:100%;">
            <h3><?=$dadoTipo[1]?></h3>
        </div>
        <div class="centro row row-cols-xxl-6 row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-1 g-4">
            <?php
            $arrProducao = buscaProducaoTipo($conn, $lang['lang'], array(':cdTipo' => $dadoTipo[0], ':status' => 'AT'));
            foreach ($arrProducao as $dadoProducao){
                $cont = 0;
                $dado = '';
                $dtToggle = '';
                $modal = '';
                //verifica se tem algum tipo de arquivo
                if($dadoProducao[1] != '' || $dadoProducao[1] != null){
                    $cont++;
                    $dado = 1;
                }
                if($dadoProducao['nm_epub'] != '' || $dadoProducao['nm_epub'] != null){
                    $cont++;
                    $dado = 2;
                }
                if($dadoProducao['nm_audio'] != '' || $dadoProducao['nm_audio'] != null){
                    $cont++;
                    $dado = 3;
                }
                //se não tiver nenhum arquivo vai abrir apenas a foto quando clicada
                if($cont == 0){
                    $conteudo = verIdioma($dadoProducao['nm_foto'], $lang['lang']);
                }
                //se tiver apenas 1, abre ele ao clicar
                else if($cont == 1){
                    $conteudo = verIdioma($dadoProducao[$dado], $lang['lang']);
                    $nmFoto = verIdioma($dadoProducao['nm_foto'], $lang['lang']);
                }
                //se tiver mais de um abre o modal para escolha
                else{
                    $dtToggle = 'modal';
                    $modal = '#mdlProducao';
                    //verificar se existe publicação em outra linguagem
                    $nmFoto = verIdioma($dadoProducao['nm_foto'], $lang['lang']);
                    $nmArquivo = verIdioma($dadoProducao['nm_arquivo'], $lang['lang']);
                    $nmEpub = verIdioma($dadoProducao['nm_epub'], $lang['lang']);
                    $nmAudio = verIdioma($dadoProducao['nm_audio'], $lang['lang']);
                }
                ?>
                <div class="col">
                    <?php
                    if($cont <= 1){
                        if($dado != 3){
                            echo "<a href='conteudo/$conteudo' target='_blank' class='contaDownload'>";
                        }
                        else{
                            echo "<a href='baixarArquivo.php?arquivo='$conteudo' target='_blank' class='contaDownload'>";
                        }
                    }
                        ?>
                        <div class="card text-center cardHome bord-card rounded-4 h-100">
                            <div class="card-body">
                                <img class="card-img-top" src="conteudo/<?=$nmFoto?>" alt='<?=$dadoProducao[4]?>' data-bs-toggle="<?=$dtToggle?>" data-bs-target="<?=$modal?>" data-epub="<?=$nmEpub?>" data-pdf="<?=$nmArquivo?>" data-mp3="<?=$nmAudio?>">
                                <strong class="font-example"><?=$dadoProducao['ds_producao']?></strong>
                            </div>
                        </div>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        <br>
        <hr class="hrCustom">
        <?php
    }
    ?>
    <br>
    <div class=" centro">
        <a href="../congresso/banner.php">
            <button type="button" class="btn btn-azul"><?=$lang['congBtn']?></button>
        </a>
    </div>
    <br>
</div>
<?php
include 'includes/foot.php';
function verIdioma($nome, $lang){
    $ext = pathinfo($nome, PATHINFO_EXTENSION);
    $nomeSemExtencao = explode(".", $nome)[0];
    if(substr($nomeSemExtencao, -1) == ')' && substr($nomeSemExtencao, -4, 1) == '('){
        //nome sem o contador
        $nomeSemParent = str_replace(substr($nomeSemExtencao, -4), '', $nomeSemExtencao);
    }
    else{
        $nomeSemParent = $nomeSemExtencao;
    }
    $novoNome = $nomeSemParent.'_'.$lang.'.'.$ext;
    if (file_exists('conteudo/'.$novoNome)) {
        return $novoNome;
    }
    else{
        return $nome;
    }
}