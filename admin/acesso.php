<?php
session_start();
require_once "../db/dbConnection.php";

//Permitido somente se estiver logado e for Nivel administrador
$nivel = $_SESSION['repositorio']['nivel'];
$cdUser = $_SESSION['repositorio']['cdAcesso'];
if ($nivel == 1 || $nivel == 2) {

    include "query/query-acesso.php";
    //pagina backend
    if (isset($_POST['cdUsuario'])) {
        $params = array(':cdAcesso' => $_POST['cdUsuario']);
        $arrAcesso = buscaAcessoCodigo($conn, $params);
        ?>
        <div class="divMd">
            <fildset>
                <legend>Editar Usuário: <strong><?= $arrAcesso[1] ?></strong></legend>
                <form action="acesso.php" method="POST">
                    <input type="hidden" name="updAcesso" value="true">
                    <input type="hidden" name="id" value="<?= $arrAcesso[0] ?>">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" name="senha" id="senha" placeholder="Usuário" value="">
                        <label for="senha">Senha:</label>
                        <div id="senhaHelp" class="form-text">Preencha somente se quiser trocar a senha.</div>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Floating label select example" id="cmb_nivel" name="cmb_nivel">
                            <?php
                            $arrNivel = buscaNivel($conn, $cdUser);
                            foreach ($arrNivel as $linha) {
                                if ($arrAcesso[2] == $linha[0]) {
                                    echo "<option value='" . $linha[0] . "' selected>" . $linha[1] . "</option>";
                                } else {
                                    echo "<option value='" . $linha[0] . "'>" . $linha[1] . "</option>";
                                }
                            }
                            ?>
                        </select>
                        <label for="cmb_nivel">NIvel:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Floating label select example" id="cmb_status" name="cmb_status">
                            <?php
                            if ($arrAcesso[3] == 'AT') {
                                echo "<option value='AT' selected>Ativo</option>";
                                echo "<option value='IN' >Inativo</option>";
                            } else {
                                echo "<option value='AT' >Ativo</option>";
                                echo "<option value='IN' selected>Inativo</option>";
                            }
                            ?>
                        </select>
                        <label for="cmb_nivel">Status:</label>
                    </div>
                    <br>
                    <div class="center">
                        <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="window.location.replace('acesso.php')">
                        <input type="submit" id='btnAlteraAcesso' class="btn btn-success" value="Alterar">
                    </div>
                </form>
            </fildset>
        </div>
        <?php
    }
    //páginas completas
    else {
        require_once 'includes/head.php';
        getHead("Acesso", '', 'js/js-acesso.js');
        require_once 'includes/menu.php';
        getMenu($nivel);
        //Gravar nova area
        if (isset($_POST['newAcesso']) && $_POST['newAcesso'] == 'true') {
            if (isset($_POST['login'], $_POST['senha'], $_POST['cmb_nivel'])) {
                $params = array(':login' => $_POST['login'], ':senha' => md5($_POST['senha']), ':nivel' => $_POST['cmb_nivel'], ':status' => 'AT');
                $retorno = gravaAcesso($conn, $params);
                if ($retorno == 'ok') {
                    echo "<script>okNewPage('Usuário adicionado com sucesso!', 'acesso.php');</script>";
                } else {
                    echo $retorno;
                }
            }
        } 
        else if (isset($_POST['updAcesso']) && $_POST['updAcesso'] == 'true') {
            if (isset($_POST['senha'], $_POST['cmb_nivel'], $_POST['cmb_status'], $_POST['id'])) {
                $params = array(
                    ':id' => $_POST['id'],
                    ':nivel' => $_POST['cmb_nivel'],
                    ':status' => $_POST['cmb_status']
                );
                if ($_POST['senha'] != '') {
                    $params[':senha'] = md5($_POST['senha']);
                }
                $retorno = alteraAcesso($conn, $params, $_POST['senha']);
                if ($retorno == 'ok') {
                    echo "<script>okNewPage('Usuário alterado com sucesso!', 'acesso.php');</script>";
                } else {
                    echo $retorno;
                }
            }
        } 
        else if (isset($_POST['formNovoUsuario']) && $_POST['formNovoUsuario'] == 'novo') {
            ?>
            <div class="container">
                <div class='divConteudo'>
                    <br>
                    <div class="divMd">
                        <fildset>
                            <legend>Novo Usuário</legend>
                            <form action="acesso.php" method="POST">
                                <input type="hidden" name="newAcesso" value="true">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" name="login" id="login" placeholder="Usuário" required>
                                    <label for="login">Usuário:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" name="senha" id="senha" placeholder="Senha" required>
                                    <label for="senha">Senha:</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select class="form-select" aria-label="Floating label select example" id="cmb_nivel" name="cmb_nivel" required>
                                        <option value='' selected>SELECIONE</option>
                                        <?php
                                        $arrNivel = buscaNivel($conn, $cdUser);
                                        foreach ($arrNivel as $linha) {
                                            echo "<option value='" . $linha[0] . "'>" . $linha[1] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="cmb_nivel">NIvel:</label>
                                </div>
                                <br>
                                <div class="center">
                                    <input type="button" id='btnVoltar' class="btn btn-secondary" value="Voltar" onClick="history.go(-1)">
                                    <input type="submit" id='btnGravarLogin' class="btn btn-success" value="Gravar">
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
                    <h1>Acessos</h1>
                    <hr>
                    <div class="center">
                        <?php
                        if ($cdUser <= 2){
                            ?>
                            <form action="acesso.php" method="POST">
                                <input type="hidden" name="formNovoUsuario" value="novo">
                                <input type="submit" class="btn btn-primary btn-lg" value="Novo Usuário">
                            </form>
                            <hr>  
                            <?php
                        }
                        if ($cdUser != 2){
                        ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $arrAcesso = buscaAcesso($conn, $cdUser);
                                foreach ($arrAcesso as $linha) {
                                    echo "
                                    <tr class='trAcesso' data-id='$linha[0]'>
                                        <td> $linha[1] </td>
                                        <td> $linha[2] </td>
                                        <td> $linha[3] </td>
                                    </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
    }
} 
else {
    Header("location:index.php");
}
require_once 'includes/foot.php';