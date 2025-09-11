<?php
function buscaChaveDesc($conn){
    try {
        $comandoSQL = "SELECT cd_chave, ds_chave FROM tb_chave ORDER BY ds_chave";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arrChave = $stmt->fetchAll(PDO::FETCH_BOTH);
        $arrChave2 = null;
        foreach ($arrChave as $ddChave){
            $arrChave2[$ddChave[0]] = $ddChave[1];
        }
        return $arrChave2;
    } catch (PDOException $Exception) {
        return "SELECT CHAVE DESCRICAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaChaveTrabCod($conn, $params){
    try {
        $comandoSQL = "SELECT cd_chave FROM tb_chave_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT CHAVE TRABALHO COD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorDesc($conn){
    try {
        $comandoSQL = "SELECT cd_autor, ds_autor FROM tb_autor ORDER BY ds_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arrAutor = $stmt->fetchAll(PDO::FETCH_BOTH);
        $arrAutor2 = null;
        foreach ($arrAutor as $ddAutor){
            $arrAutor2[$ddAutor[0]] = $ddAutor[1];
        }
        return $arrAutor2;
    } catch (PDOException $Exception) {
        return "SELECT AUTOR DESCRICAO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorTrabCod($conn, $params){
    try {
        $comandoSQL = "SELECT cd_autor FROM tb_autor_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT AUTOR TRABALHO COD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTipoTrabalhoDesc($conn){
    try {
        $comandoSQL = "SELECT cd_tipo, ds_tipo FROM tb_tipo WHERE ic_status = 'AT' ORDER BY cd_tipo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arrTipo =  $stmt->fetchAll(PDO::FETCH_BOTH);
        $arrTipo2 = null;
        foreach ($arrTipo as $ddTipo){
            $arrTipo2[$ddTipo[0]] = $ddTipo[1];
        }
        return $arrTipo2;
    } catch (PDOException $Exception) {
        return "SELECT TIPO- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTodosTrabalhos($conn){
    try {
        //$comandoSQL = "SELECT cd_trabalho, ds_titulo, cd_tipo, ds_revista, ano_public, ds_volume, ds_pagina, ds_instituicao, ds_cidade, ds_editora, ds_isbn, DATE_FORMAT(dt_public,'%d/%m/%Y'), DATE_FORMAT(dt_consulta,'%d/%m/%Y'), ds_url, ds_doi FROM tb_trabalho ";
        $comandoSQL = "SELECT *, DATE_FORMAT(dt_public,'%d/%m/%Y') AS data_public, DATE_FORMAT(dt_consulta,'%d/%m/%Y') AS data_consulta FROM tb_trabalho";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TODOS TRABALHOs - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}