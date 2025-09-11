<?php
function buscaVisita($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_visita FROM  tb_visita WHERE ds_ip = :ip AND dt_acesso = :data AND hr_acesso = :hora";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT VISITA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaVisita($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_visita (ds_ip, dt_acesso, hr_acesso, mn_acesso) VALUE (:ip, :data, :hora, :minuto)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return $conn->lastInsertId();
        }
    } catch (PDOException $Exception) {
        echo "INSERT CURSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaDownload($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_download (cd_tipo, cd_subtipo, cd_trabalho, cd_producao, cd_visita) VALUE (:cdTipo, :cdSubtipo, :cdTrabalho, :cdProducao, :cdVisita)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return $conn->lastInsertId();
        }
    } catch (PDOException $Exception) {
        echo "INSERT DOWNLOAD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCdProducao($conn, $iten, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_producao FROM  tb_producao WHERE $iten LIKE :valor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $arr =  $stmt->fetch(PDO::FETCH_BOTH);
        return $arr[0];
    } catch (PDOException $Exception) {
        echo "SELECT CD PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaChave($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_cont_chave (cd_chave, cd_visita) VALUE (:cdChave, :cdVisita)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT DOWNLOAD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}