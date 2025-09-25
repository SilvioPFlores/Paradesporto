<?php
function buscaChave($conn, $lang)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_chave, ds_chave_$lang FROM tb_chave ORDER BY ds_chave_$lang";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaChaveStr($conn, $lang, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_chave, ds_chave_$lang FROM tb_chave WHERE ds_chave_$lang LIKE :str ORDER BY ds_chave_$lang";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CHAVE STR- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}

function buscaChaveLetra($conn, $lang, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_chave, ds_chave_$lang FROM tb_chave WHERE ds_chave_$lang LIKE :letra ORDER BY ds_chave_$lang";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CHAVE STR- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutor($conn){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_autor, ds_autor FROM tb_autor ORDER BY ds_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT AUTOR - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorLetra($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_autor, ds_autor FROM tb_autor WHERE ds_autor LIKE :letra ORDER BY ds_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT AUTOR LETRA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorStr($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_autor, ds_autor FROM tb_autor WHERE ds_autor LIKE :str ORDER BY ds_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT AUTOR LETRA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTitulo($conn){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ic_status = 'AT' ORDER BY replace(replace(replace(ds_titulo,'\'',''),'\"',''),'(','')";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTituloStr($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ds_titulo LIKE :str AND ic_status = 'AT' ORDER BY ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTituloLetra($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ds_titulo LIKE :letra AND ic_status = 'AT' ORDER BY ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTituloAutor($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT tt.cd_trabalho, tt.ds_titulo FROM tb_trabalho tt, tb_autor_trabalho tat WHERE tt.cd_trabalho = tat.cd_trabalho AND tat.cd_autor = :cdAutor AND tt.ic_status = 'AT' ORDER BY tt.ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO AUTOR - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTituloChave($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT tt.cd_trabalho, tt.ds_titulo FROM tb_trabalho tt, tb_chave_trabalho tct WHERE tt.cd_trabalho = tct.cd_trabalho AND tct.cd_chave = :cdChave AND tt.ic_status = 'AT' ORDER BY tt.ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTipoTrabalho($conn, $lang){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_tipo, ds_tipo_$lang FROM tb_tipo WHERE ic_status = 'AT' ORDER BY cd_tipo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TIPO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTrabalho($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE cd_tipo = :cdTipo AND ic_status = 'AT' ORDER BY ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTrabalhoStr($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ds_titulo LIKE :str AND cd_tipo = :cdTipo AND ic_status = 'AT' ORDER BY ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTrabalhoCodigo($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT ds_titulo, cd_tipo, ds_editora, ds_isbn, ds_revista, ano_public, ds_volume, ds_pagina, ds_cidade, ds_instituicao, DATE_FORMAT(dt_public,'%d/%m/%Y'),  ds_url, ds_doi, nm_arquivo, ic_publico FROM tb_trabalho WHERE cd_trabalho = :cdTrabalho AND ic_status = 'AT'";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorTrabalho($conn, $params){
    try {
        //SELECT
        $comandoSQL = "SELECT ta.ds_autor FROM tb_autor as ta, tb_autor_trabalho as tat WHERE tat.cd_trabalho = :cdTrabalho AND tat.cd_autor = ta.cd_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT AUTOR TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}