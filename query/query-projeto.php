<?php
function buscaObjetivo($conn, $lang)
{
    try {
        $comandoSQL = "SELECT $lang FROM tb_objetivo WHERE ic_status = 'AT' ORDER BY cd_objetivo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCoord($conn, $lang)
{
    try {
        $comandoSQL = "SELECT tc.$lang, tp.$lang, te.ds_equipe FROM tb_cargo tc, tb_equipe te, tb_pronome tp WHERE tp.cd_pronome = te.cd_pronome AND te.cd_cargo = tc.cd_cargo AND tc.cd_cargo = 1";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCargo($conn, $lang)
{
    try {
        $comandoSQL = "SELECT cd_cargo, $lang, ds_lider FROM tb_cargo WHERE ic_status = 'AT' AND cd_cargo > 1 ORDER BY nm_ordem";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaEquipe($conn, $lang, $params)
{
    try {
        $comandoSQL = "SELECT tp.$lang, te.ds_equipe FROM tb_equipe te, tb_pronome tp WHERE tp.cd_pronome = te.cd_pronome AND te.cd_cargo = :cdCargo AND te.ic_status = :status ORDER BY te.nm_ordem";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT EQUIPE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}