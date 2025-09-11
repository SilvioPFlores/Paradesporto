<?php
function buscaTipoProducao($conn, $lang)
{
    try {
        $comandoSQL = "SELECT cd_tipo, $lang FROM tb_tipo_producao WHERE ic_status = 'AT' ORDER BY cd_tipo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TIPO PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaProducaoTipo($conn, $lang, $params)
{
    try {
        $comandoSQL = "SELECT nm_foto, nm_arquivo, nm_epub, nm_audio, ds_alt_$lang, ds_producao, cd_producao FROM  tb_producao WHERE cd_tipo = :cdTipo AND ic_status = :status ORDER BY cd_producao";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRODUCAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}