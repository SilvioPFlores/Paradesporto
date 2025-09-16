<?php
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
require_once 'includes/head.php';
getHead('Objetivo');
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);
    if (isset($_POST['newObjetivo']) && $_POST['newObjetivo'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':status' => 'AT');
            $retorno = gravaObjetivo($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Objetivo adicionado com sucesso!', 'objetivo.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    if (isset($_POST['editaObjetivo']) && $_POST['editaObjetivo'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'], $_POST['cmb_status'], $_POST['cdObjetivo'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':status' =>  $_POST['cmb_status'], ':cdObjetivo' =>  $_POST['cdObjetivo']);
            $retorno = alteraObjetivo($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Objetivo alterado com sucesso!', 'objetivo.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if(isset($_POST['cdObjetivo'],$_POST['verObjetivo']) && $_POST['verObjetivo'] == 'true'){
        $arrObjetivo = buscaObjetivoCod($conn, array(':cdObjetivo' => $_POST['cdObjetivo']));
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <fildset>
                    <legend>Editar Objetivo</legend>
                    <form action="objetivo.php" method="POST">
                        <input type="hidden" name="cdObjetivo" value="<?=$_POST['cdObjetivo']?>">
                        <input type="hidden" name="editaObjetivo" value="true">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Objetivo em Português" value="<?=$arrObjetivo[0]?>" required>
                            <label for="txtPt">Objetivo em Português</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Objetivo em Inglês" value="<?=$arrObjetivo[1]?>" required>
                            <label for="txtEn">Objetivo em Inglês</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Objetivo em Espanhol" value="<?=$arrObjetivo[2]?>" required>
                            <label for="txtEs">Objetivo em Espanhol</label>
                        </div>
                        <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Floating label select example" id="cmb_status" name="cmb_status">
                            <?php
                            if ($arrObjetivo[3] == 'AT') {
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
        <?php
    }
    else if(isset($_POST['formNovoObjetivo'])){
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <fildset>
                    <legend>Novo Objetivo</legend>
                    <form action="objetivo.php" method="POST">
                        <input type="hidden" name="newObjetivo" value="true">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Objetivo em Português" required>
                            <label for="txtPt">Objetivo em Português</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Objetivo em Inglês" required>
                            <label for="txtEn">Objetivo em Inglês</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Objetivo em Espanhol" required>
                            <label for="txtEs">Objetivo em Espanhol</label>
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
        <?php
    }
    else{
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <h1>Objetivos</h1>
                <hr>
                <div class="text-center">
                    <?php
                    $arrObjetivo = buscaObjetivo($conn);
                    if (!empty($arrObjetivo)) {
                        foreach ($arrObjetivo as $dadoObjetivo){
                            if($dadoObjetivo[2] == 'AT'){
                                $cor = 'btn-outline-secondary';
                            }
                            else{
                                $cor = 'btn-outline-danger';
                            }
                            echo"
                            <form action='objetivo.php' method=post>
                                <input type='hidden' name='verObjetivo' value='true'>
                                <input type='hidden' name='cdObjetivo' value='$dadoObjetivo[0]'>
                                <input type='submit' class='btn $cor btn-md divMax topMarg4' value='$dadoObjetivo[1]'>
                            </form>";
                        }
                    }
                    else{
                        echo "Não foi localizado nenhum Objetivo!";
                    }
                    ?>
                    <hr> 
                    <form action="objetivo.php" method="POST">
                        <input type="hidden" name="formNovoObjetivo" value="novo">
                        <input type="submit" class="btn btn-primary btn-lg" value="Novo Objetivo">
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