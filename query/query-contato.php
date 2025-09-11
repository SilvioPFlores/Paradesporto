<?php
function buscaTipoPcd($conn, $dsPcd)
{
    try {
        $comandoSQL = "SELECT cd_pcd, $dsPcd FROM tb_tipo_pcd WHERE ic_status = 'AT' ORDER BY cd_pcd";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TIPO PCD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTipoPcdCd($conn, $params)
{
    try {
        $comandoSQL = "SELECT ds_pcd_pt FROM tb_tipo_pcd WHERE cd_pcd = :cdPcd";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $arrRetorno = $stmt->fetch(PDO::FETCH_BOTH);
        return $arrRetorno[0];
    } catch (PDOException $Exception) {
        echo "SELECT TIPO PCD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaContato($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_contato (ds_nome, ds_email, ds_fone, ic_pcd, cd_pcd, ds_apoio, ds_assunto, tx_mensagem, dt_contato) VALUE (:dsNome, :dsEmail, :dsFone, :icPcd, :cdPcd, :dsApoio, :dsAssunto, :txMensagem, NOW())";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT CONTATO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}