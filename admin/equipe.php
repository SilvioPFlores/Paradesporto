<?php
session_start();
require_once 'db/dbConnection.php';
require_once 'query/query-projeto.php';
require_once 'includes/head.php';
getHead('Equipe');
require_once 'includes/menu.php';
$nivel = $_SESSION['repositorio']['nivel'];
if ($nivel != '') {
    getMenu($nivel);
    if (isset($_POST['newEquipe']) && $_POST['newEquipe'] == 'true') {
        if (isset($_POST['cmbCargo'], $_POST['cmbPronome'], $_POST['txtNome'])) {
            $params = array(':cdCargo' => $_POST['cmbCargo'], ':cdPronome' => $_POST['cmbPronome'], ':strNome' => $_POST['txtNome'], ':status' => 'AT');
            $retorno = gravaEquipe($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Novo membro de equipe adicionado com sucesso!', 'equipe.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if (isset($_POST['editaEquipe']) && $_POST['editaEquipe'] == 'true') {
        if (isset($_POST['cmbCargo'], $_POST['cmbPronome'], $_POST['txtNome'], $_POST['cmb_ordem'], $_POST['cmb_status'], $_POST['cdEquipe'])) {
            $params = array(':cdCargo' => $_POST['cmbCargo'], ':cdPronome' => $_POST['cmbPronome'], ':strNome' => $_POST['txtNome'], ':ordem' =>  $_POST['cmb_ordem'], ':status' => $_POST['cmb_status'], ':cdEquipe' =>  $_POST['cdEquipe']);
            $retorno = alteraEquipe($conn, $params);
            if ($retorno == 'ok') {
                echo "<script>okNewPage('Membro de equipe alterado com sucesso!', 'equipe.php');</script>";
            } else {
                echo $retorno;
            }
        }
    }
    else if(isset($_POST['cdEquipe'],$_POST['verEquipe']) && $_POST['verEquipe'] == 'true'){
        $arrCargo = buscaCargoAt($conn);
        $arrPronome = buscaPronomeAt($conn);
        $arrEquipe = buscaEquipeCod($conn, array(':cdEquipe' => $_POST['cdEquipe']));
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divMd">
                    <fildset>
                        <legend>Editar membro de equipe</legend>
                        <form action="equipe.php" method="POST">
                            <input type="hidden" name="editaEquipe" value="true">
                            <input type="hidden" name="cdEquipe" value="<?=$_POST['cdEquipe']?>">
                            <div class="row g-2">
                                <div class="col-md-7">
                                    <div class="form-floating  mb-3">
                                        <select class="form-select" id="cmbCargo" name="cmbCargo" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($arrCargo as $dadoCargo){
                                                if($dadoCargo[0] == $arrEquipe[0]){
                                                    echo "<option value='$dadoCargo[0]' selected>$dadoCargo[1]</option>";
                                                }
                                                else{
                                                    echo "<option value='$dadoCargo[0]'>$dadoCargo[1]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="cmbCargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating  mb-3">
                                        <select class="form-select" id="cmbPronome" name="cmbPronome" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($arrPronome as $dadoPronome){
                                                if($dadoPronome[0] == $arrEquipe[1]){
                                                    echo "<option value='$dadoPronome[0]' selected>$dadoPronome[1]</option>";
                                                }
                                                else{
                                                    echo "<option value='$dadoPronome[0]'>$dadoPronome[1]</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <label for="cmbPronome">Pronome</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating  mb-3">
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome" value="<?=$arrEquipe[2]?>"required>
                                <label for="txtNome">Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" aria-label="Seleção da ordem de exibição" id="cmb_ordem" name="cmb_ordem">
                                    <?php
                                    for($i = 1; $i <= 10; $i++){
                                        if ($arrEquipe[3] == $i) {
                                            echo "<option value='$i' selected>$i</option>";
                                        } else {
                                            echo "<option value='$i'>$i</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <label for="cmb_ordem"> Ordem de Exibição:</label>
                            </div>
                            <div class="form-floating  mb-3 mb-3">
                                <select class="form-select" aria-label="Floating label select example" id="cmb_status" name="cmb_status">
                                    <?php
                                    if ($arrEquipe[3] == 'AT') {
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
    else if (isset($_POST['formNovoEquipe'])) {
        $arrCargo = buscaCargoAt($conn);
        $arrPronome = buscaPronomeAt($conn);
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <div class="divMd">
                    <fildset>
                        <legend>Novo membro de equipe</legend>
                        <form action="equipe.php" method="POST">
                            <input type="hidden" name="newEquipe" value="true">
                            <div class="row g-2">
                                <div class="col-md-7">
                                    <div class="form-floating  mb-3">
                                        <select class="form-select" id="cmbCargo" name="cmbCargo" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($arrCargo as $dadoCargo){
                                                echo "<option value='$dadoCargo[0]'>$dadoCargo[1]</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="cmbCargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-floating  mb-3">
                                        <select class="form-select" id="cmbPronome" name="cmbPronome" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($arrPronome as $dadoPronome){
                                                echo "<option value='$dadoPronome[0]'>$dadoPronome[1]</option>";
                                            }
                                            ?>
                                        </select>
                                        <label for="cmbPronome">Pronome</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating  mb-3 topMarg4">
                                <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome" required>
                                <label for="txtNome">Nome</label>
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

    else {
        ?>
        <div class="container">
            <div class='divConteudo'>
                <br>
                <h1>Membros da Equipe</h1>
                <hr>
                <div class="divMd text-center">
                    <?php
                    $arrCargo = buscaCargoAt($conn);
                    foreach ($arrCargo as $dadoCargo) {
                        echo "
                        <fildset>
                            <legend>$dadoCargo[1]</legend>";
                            $arrEquipeAt = buscaEquipe($conn, array(':cdCargo' => $dadoCargo[0], ':status' => 'AT'));
                            foreach ($arrEquipeAt as $dadoEquipeAt) {
                                echo "
                                <form action='equipe.php' method=post>
                                    <input type='hidden' name='verEquipe' value='true'>
                                    <input type='hidden' name='cdEquipe' value='$dadoEquipeAt[0]'>
                                    <input type='submit' class='btn btn-outline-secondary btn-md divMax topMarg4' value='$dadoEquipeAt[1] $dadoEquipeAt[2]'>
                                </form>";
                            }
                        echo "
                        </fildset>
                        <br>";
                    }
                    ?>
                    <fildset>
                        <legend>Equipe Inativo</legend>
                        <?php
                        $arrEquipeIn = buscaEquipeIn($conn, array(':status' => 'IN'));
                        foreach ($arrEquipeIn as $dadoEquipeIn) {
                            echo "
                            <form action='equipe.php' method=post>
                                <input type='hidden' name='verEquipe' value='true'>
                                <input type='hidden' name='cdEquipe' value='$dadoEquipeIn[0]'>
                                <input type='submit' class='btn btn-outline-danger btn-md divMax topMarg4' value='$dadoEquipeIn[1] $dadoEquipeIn[2]'>
                            </form>";
                        }
                        ?>

                    </fildset>
                    <hr>
                    <form action="equipe.php" method="POST">
                        <input type="hidden" name="formNovoEquipe" value="novo">
                        <input type="submit" class="btn btn-primary btn-lg" value="Novo">
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