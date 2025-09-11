<?php
function buscaUsuario($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_usuario FROM tb_usuario WHERE ds_mail = :mail";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $retorno = $stmt->fetch(PDO::FETCH_BOTH);
        return $retorno[0];
    } catch (PDOException $Exception) {
        echo "SELECT USUARIO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaUsuario($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_usuario (ds_usuario, ds_mail, ds_fone, ds_nacionalidade, ic_status) VALUE (:nome, :mail, :fone, :nacio, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        echo "INSERT CURSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaTrabalho ($conn, $params)
{
    try {
        //solução para tratar data de publicação em branco
        if(isset($params[':dtPublic'])){
            $comandoSQL = "INSERT INTO tb_trabalho 
            ( ds_titulo, ds_revista, ano_public, ds_volume, ds_pagina, ds_instituicao, dt_public, ds_url, ds_doi, ds_editora, ds_isbn, ds_cidade, ic_publico, nm_arquivo, cd_tipo, cd_usuario, ic_status ) 
            VALUE 
            ( :titulo, :revista, :anoPublic, :volume, :pagina, :instit, :dtPublic, :url, :doi, :editora, :isbn, :cidade, :publico, :nmArquivo, :cdTipo, :cdUsuario, :status )";
        }
        else{
            $comandoSQL = "INSERT INTO tb_trabalho 
            ( ds_titulo, ds_revista, ano_public, ds_volume, ds_pagina, ds_instituicao, ds_url, ds_doi, ds_editora, ds_isbn, ds_cidade, ic_publico, nm_arquivo, cd_tipo, cd_usuario, ic_status ) 
            VALUE 
            ( :titulo, :revista, :anoPublic, :volume, :pagina, :instit, :url, :doi, :editora, :isbn, :cidade, :publico, :nmArquivo, :cdTipo, :cdUsuario, :status )";
        }
        
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT TRABALHO (dados: ".$params[':titulo']." ) - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaChaveTrabalho($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_chave_trabalho (cd_chave, cd_trabalho) VALUE (:cdChave, :cdTrabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return '0';
        }
        else{
            return '1';
        }
    } catch (PDOException $Exception) {
        return "INSERT CHAVE TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorStr2($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_autor FROM  tb_autor WHERE ds_autor LIKE TRIM(:dsAutor)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $retorno = $stmt->fetch(PDO::FETCH_BOTH);
        return $retorno[0];
    } catch (PDOException $Exception) {
        return "SELECT COD AUTOR - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaAutor($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_autor (ds_autor) VALUE (TRIM(:dsAutor))";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT AUTOR - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaAutorTrabalho($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_autor_trabalho (cd_autor, cd_trabalho) VALUE (:cdAutor, :cdTrabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return '0';
        }
        else{
            return '1';
        }
    } catch (PDOException $Exception) {
        return "INSERT AUTOR TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}