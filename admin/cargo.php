<?php
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
require_once 'includes/head.php';
getHead('Cargo');
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);
    if (isset($_POST['newCargo']) && $_POST['newCargo'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':status' => 'AT');
            $retorno = gravaCargo($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Cargo adicionado com sucesso!', 'cargo.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    if (isset($_POST['editaCargo']) && $_POST['editaCargo'] == 'true') {
        if (isset($_POST['txtPt'], $_POST['txtEn'], $_POST['txtEs'], $_POST['txtLider'], $_POST['cmb_ordem'], $_POST['cmb_status'], $_POST['cdCargo'])) {
            $params = array(':strPt' => $_POST['txtPt'], ':strEn' => $_POST['txtEn'], ':strEs' => $_POST['txtEs'], ':lider' => $_POST['txtLider'], ':ordem' =>  $_POST['cmb_ordem'], ':status' =>  $_POST['cmb_status'], ':cdCargo' =>  $_POST['cdCargo']);
            $retorno = alteraCargo($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Cargo alterado com sucesso!', 'cargo.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if(isset($_POST['cdCargo'],$_POST['verCargo']) && $_POST['verCargo'] == 'true'){
        $arrCargo = buscaCargoCod($conn, array(':cdCargo' => $_POST['cdCargo']));
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divMd">
                    <fildset>
                        <legend>Editar Cargo</legend>
                        <form action="cargo.php" method="POST">
                            <input type="hidden" name="cdCargo" value="<?=$_POST['cdCargo']?>">
                            <input type="hidden" name="editaCargo" value="true">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Cargo em Português" value="<?=$arrCargo[0]?>" required>
                                <label for="txtPt">Cargo em Português</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Cargo em Inglês" value="<?=$arrCargo[1]?>" required>
                                <label for="txtEn">Cargo em Inglês</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Cargo em Espanhol" value="<?=$arrCargo[2]?>" required>
                                <label for="txtEs">Cargo em Espanhol</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtLider" id="txtLider" placeholder="Especificação de Lider" value="<?=$arrCargo[3]?>">
                                <label for="txtLider">Especificação de Lider</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Seleção da ordem de exibição" id="cmb_ordem" name="cmb_ordem">
                                    <?php
                                    for($i = 1; $i <= 10; $i++){
                                        if ($arrCargo[3] == $i) {
                                            echo "<option value='$i' selected>$i</option>";
                                        } else {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="cmb_ordem"> Ordem de Exibição:</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Seleção do Status" id="cmb_status" name="cmb_status">
                                    <?php
                                    if ($arrCargo[5] == 'AT') {
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
    else if(isset($_POST['formNovoCargo'])){
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divMd">
                    <fildset>
                        <legend>Novo Cargo</legend>
                        <form action="cargo.php" method="POST">
                            <input type="hidden" name="newCargo" value="true">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtPt" id="txtPt" placeholder="Cargo em Português" required>
                                <label for="txtPt">Cargo em Português</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEn" id="txtEn" placeholder="Cargo em Inglês" required>
                                <label for="txtEn">Cargo em Inglês</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="txtEs" id="txtEs" placeholder="Cargo em Espanhol" required>
                                <label for="txtEs">Cargo em Espanhol</label>
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
                <h1>Cargos</h1>
                <hr>
                <div class="divMd text-center">
                    <?php
                    $arrCargo = buscaCargo($conn);
                    if (!empty($arrCargo)) {
                        foreach ($arrCargo as $dadoCargo){
                            if($dadoCargo[2] == 'AT'){
                                $cor = 'btn-outline-secondary';
                            }
                            else{
                                $cor = 'btn-outline-danger';
                            }
                            echo"
                            <form action='cargo.php' method=post>
                                <input type='hidden' name='verCargo' value='true'>
                                <input type='hidden' name='cdCargo' value='$dadoCargo[0]'>
                                <input type='submit' class='btn $cor btn-md divMax topMarg4' value='$dadoCargo[1]'>
                            </form>";
                        }
                    }
                    else{
                        echo "Não foi localizado nenhum Cargo!";
                    }
                    ?>
                    <hr> 
                    <form action="cargo.php" method="POST">
                        <input type="hidden" name="formNovoCargo" value="novo">
                        <input type="submit" class="btn btn-primary btn-lg" value="Novo Cargo">
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