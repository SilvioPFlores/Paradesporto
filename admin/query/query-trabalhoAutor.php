<?php
function buscaTituloAutor($conn){
    try {
        $comandoSQL = "SELECT cd_trabalho, ds_titulo, ic_status FROM tb_trabalho WHERE cd_usuario <> '' ORDER BY CASE WHEN ic_status = 'IN' THEN 1 WHEN ic_status = 'AT' THEN 2 ELSE 3 END, cd_trabalho DESC";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TITULO- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaUsuario($conn, $params){
    try {
        $comandoSQL = "SELECT ds_usuario, ds_mail, ds_fone, ds_nacionalidade FROM tb_usuario where cd_usuario = (SELECT cd_usuario FROM tb_trabalho WHERE cd_trabalho = :cdTrabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TITULO- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}