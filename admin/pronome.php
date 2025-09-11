<?php
session_start();
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
require_once 'includes/head.php';
getHead('Pronome');
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);
    if (isset($_POST['newPronome']) && $_POST['newPronome'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':status' => 'AT');
            $retorno = gravaPronome($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Pronome adicionado com sucesso!', 'pronome.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if (isset($_POST['editaPronome']) && $_POST['editaPronome'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'], $_POST['cmb_status'], $_POST['cdPronome'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':status' =>  $_POST['cmb_status'], ':cdPronome' =>  $_POST['cdPronome']);
            $retorno = alteraPronome($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Pronome alterado com sucesso!', 'pronome.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if(isset($_POST['cdPronome'],$_POST['verPronome']) && $_POST['verPronome'] == 'true'){
        $arrPronome = buscaPronomeCod($conn, array(':cdPronome' => $_POST['cdPronome']));
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divPq">
                    <fildset>
                        <legend>Editar Pronome</legend>
                        <form action="pronome.php" method="POST">
                            <input type="hidden" name="cdPronome" value="<?=$_POST['cdPronome']?>">
                            <input type="hidden" name="editaPronome" value="true">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Pronome em Português" value="<?=$arrPronome[0]?>" required>
                                <label for="txtPt">Pronome em Português</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Pronome em Inglês" value="<?=$arrPronome[1]?>" required>
                                <label for="txtEn">Pronome em Inglês</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Pronome em Espanhol" value="<?=$arrPronome[2]?>" required>
                                <label for="txtEs">Pronome em Espanhol</label>
                            </div>
                            <div class="form-floating mb-3">
                            <select class="form-select" aria-label="Floating label select example" id="cmb_status" name="cmb_status">
                                <?php
                                if ($arrPronome[3] == 'AT') {
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
    else if(isset($_POST['formNovoPronome'])){
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divPq">
                    <fildset>
                        <legend>Novo Pronome</legend>
                        <form action="pronome.php" method="POST">
                            <input type="hidden" name="newPronome" value="true">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Pronome em Português" required>
                                <label for="txtPt">Pronome em Português</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Pronome em Inglês" required>
                                <label for="txtEn">Pronome em Inglês</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Pronome em Espanhol" required>
                                <label for="txtEs">Pronome em Espanhol</label>
                            </div>
                            <br>
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
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <h1>Pronomes de Tratamento</h1>
                <hr>
                <div class="divPq text-center">
                    <?php
                    $arrPronome = buscaPronome($conn);
                    if (!empty($arrPronome)) {
                        foreach ($arrPronome as $dadoPronome){
                            if($dadoPronome[2] == 'AT'){
                                $cor = 'btn-outline-secondary';
                            }
                            else{
                                $cor = 'btn-outline-danger';
                            }
                            echo"
                            <form action='pronome.php' method=post>
                                <input type='hidden' name='verPronome' value='true'>
                                <input type='hidden' name='cdPronome' value='$dadoPronome[0]'>
                                <input type='submit' class='btn $cor btn-md divMax topMarg4' value='$dadoPronome[1]'>
                            </form>";
                        }
                    }
                    else{
                        echo "Não foi localizado nenhum Pronome!";
                    }
                    ?>
                    <hr> 
                    <form action="pronome.php" method="POST">
                        <input type="hidden" name="formNovoPronome" value="novo">
                        <input type="submit" class="btn btn-primary btn-lg" value="Novo Pronome">
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