<?php
function buscaProducao($conn)
{
    try {
        $comandoSQL = "SELECT cd_producao, ds_producao, ic_status FROM  tb_producao ORDER BY ds_producao";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTipoProducao($conn)
{
    try {
        $comandoSQL = "SELECT cd_tipo, pt FROM tb_tipo_producao WHERE ic_status = 'AT' ORDER BY cd_tipo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TIPO PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaProducao($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_producao (cd_tipo, ds_producao, nm_arquivo, nm_epub, nm_foto, nm_audio, ds_alt_pt, ds_alt_en, ds_alt_es, ic_status)";
        $comandoSQL .= "VALUE (:cdTipo, :titulo, :arquivo, :epub, :foto, :audio, :altPt, :altEn, :altEs, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        return "INSERT PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaProducaoCod($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_producao, cd_tipo, ds_producao, ds_alt_pt, ds_alt_en, ds_alt_es, ic_status, nm_arquivo, nm_epub, nm_foto, nm_audio FROM  tb_producao Where cd_producao = :cdProducao";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRODUCAO COD- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraProducao($conn, $params)
{
    try {
        $comandoSQL = "UPDATE tb_producao SET cd_tipo = :cdTipo, ds_producao = :titulo, ds_alt_pt = :altPt, ds_alt_en = :altEn, ds_alt_es = :altEs, nm_arquivo = :arquivo, nm_epub = :epub, nm_foto = :foto, nm_audio = :audio, ic_status = :status WHERE cd_producao = :cdProducao";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaSubtipoDownload($conn)
{
    try {
        $comandoSQL = "SELECT cd_subtipo, ds_subtipo FROM tb_subtipo_download";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRODUCAO COD- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaNomeArquivo($conn, $coluna, $params)
{
    try {
        $comandoSQL = "SELECT $coluna FROM tb_producao WHERE cd_producao = :cdProducao";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $returno = $stmt->fetch(PDO::FETCH_BOTH);
        return $returno[0];
    } catch (PDOException $Exception) {
        echo "SELECT PRODUCAO NOME COLUNA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}