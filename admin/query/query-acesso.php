<?php
//EFETUA LOGIN
function login($conn, $login, $senha)
{
    try {
        $params = array(':login' => $login, ':senha' => $senha);
        $comandoSQL = "SELECT cd_nivel, cd_acesso FROM  tb_acesso WHERE ds_login = :login AND ds_senha = :senha";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT LOGIN - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//BUSCA NIVEL
function buscaNivel($conn, $cdUser)
{
    try {
        if($cdUser == 1){
            $comandoSQL = "SELECT cd_nivel, ds_nivel FROM  tb_nivel ORDER BY cd_nivel";
        }
        else{
            $comandoSQL = "SELECT cd_nivel, ds_nivel FROM  tb_nivel WHERE cd_nivel > 1 ORDER BY cd_nivel";
        }
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT NIVEL - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAcesso($conn, $cdUser)
{
    try {
        //SELECT
        if($cdUser == 1){
            $comandoSQL = "SELECT ac.cd_acesso, ac.ds_login, nv.ds_nivel, ac.ic_status FROM  tb_acesso as ac, tb_nivel as nv WHERE ac.cd_nivel = nv.cd_nivel ORDER BY ac.ds_login";
        }
        else{
            $comandoSQL = "SELECT ac.cd_acesso, ac.ds_login, nv.ds_nivel, ac.ic_status FROM  tb_acesso as ac, tb_nivel as nv WHERE ac.cd_nivel = nv.cd_nivel AND ac.cd_acesso = $cdUser";
        }
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAcessoCodigo($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_acesso, ds_login, cd_nivel, ic_status FROM  tb_acesso WHERE cd_acesso = :cdAcesso";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO CODIGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaAcesso($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_acesso (ds_login, ds_senha, cd_nivel, ic_status) VALUE (:login, :senha, :nivel, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraAcesso($conn, $params, $valid)
{
    try {
        //UPDATE
        $comandoSQL = "UPDATE tb_acesso SET ";
        if ($valid != '') {
            $comandoSQL .= " ds_senha = :senha ,";
        }
        $comandoSQL .= "cd_nivel = :nivel, ic_status = :status WHERE cd_acesso = :id";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}