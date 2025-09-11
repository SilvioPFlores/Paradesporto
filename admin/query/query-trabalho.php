<?php
function gravaCsv($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO log_csv (nm_orig_csv, nm_novo_csv, dt_update, cd_user_update, tp_csv) VALUE (:nmOrig, :nmNovo, NOW(), :cdUser, :tpCsv)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT CSV - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaCsvTrabalho($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO log_csv_trabalho (cd_csv, cd_trabalho) VALUE (:cdCsv, :cdTrabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return '0';
        }
        else{
            return '1';
        }
    } catch (PDOException $Exception) {
        return "INSERT CSV TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
/*--------inativar--------*/
function comparaTitulo($conn, $params){
    try {
        $comandoSQL = "SELECT cd_trabalho FROM tb_trabalho WHERE ds_titulo LIKE :titulo AND ic_status = 'AT'";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        //return $stmt->fetch(PDO::FETCH_BOTH);
        $retorno = $stmt->fetch(PDO::FETCH_BOTH);
        return $retorno[0];
    } catch (PDOException $Exception) {
        return "SELECT COMPARA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
/*--------Modificado--------*/
function buscaChave($conn){
    try {
        $comandoSQL = "SELECT cd_chave, ds_chave_pt FROM tb_chave ORDER BY ds_chave_pt";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaChaveCod($conn, $params){
    try {
        $comandoSQL = "SELECT * FROM tb_chave WHERE cd_chave = :cdChave";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTitulo($conn){
    try {
        //SELECT
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ic_status = 'AT' ORDER BY replace(replace(replace(ds_titulo,'‘',''),'“',''),'(','')";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT TITULO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTipoTrabalho($conn){
    try {
        $comandoSQL = "SELECT cd_tipo, ds_tipo_pt FROM tb_tipo WHERE ic_status = 'AT' ORDER BY cd_tipo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TIPO- Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTrabalhoCod($conn, $params){
    try {
        $comandoSQL = "SELECT ds_titulo, ds_revista, ds_editora, ds_isbn, ano_public, ds_pagina, ds_volume, ds_cidade, ds_instituicao, dt_public, dt_consulta, ds_url, ds_doi, nm_arquivo, ic_publico, cd_tipo, ic_status FROM tb_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TRABALHO COD - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTituloLetra($conn, $params){
    try {
        $comandoSQL = "SELECT cd_trabalho, ds_titulo FROM tb_trabalho WHERE ds_titulo LIKE :letra AND ic_status = 'AT' ORDER BY ds_titulo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT TITULO CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
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
function buscaAutorCod($conn, $params){
    try {
        $comandoSQL = "SELECT ta.ds_autor FROM tb_autor as ta, tb_autor_trabalho as tat WHERE tat.cd_trabalho = :cdTrabalho AND tat.cd_autor = ta.cd_autor";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        return "SELECT COD CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaTrabalho ($conn, $params)
{
    try {
        /*//solução para tratar data de publicação em branco
        if(isset($params[':dtPublic'])){
            $comandoSQL = "INSERT INTO tb_trabalho 
            ( ds_titulo, ds_revista, ano_public, ds_volume, ds_pagina, ds_instituicao, dt_public, dt_consulta, ds_url, ds_doi, ds_cidade, ic_publico, cd_tipo, ic_status ) 
            VALUE 
            ( :titulo, :revista, :anoPublic, :volume, :pagina, :instit, STR_TO_DATE(:dtPublic,'%d/%m/%Y'), STR_TO_DATE(:dtConsulta,'%d/%m/%Y'), :url, :doi, :cidade, :publico, :cdTipo, :status )";
        }
        else{
            $comandoSQL = "INSERT INTO tb_trabalho 
            ( ds_titulo, ds_revista, ano_public, ds_volume, ds_pagina, ds_instituicao, dt_consulta, ds_url, ds_doi, ds_cidade, ic_publico, cd_tipo, ic_status ) 
            VALUE 
            ( :titulo, :revista, :anoPublic, :volume, :pagina, :instit, STR_TO_DATE(:dtConsulta,'%d/%m/%Y'), :url, :doi, :cidade, :publico, :cdTipo, :status )";
        }*/
        $comandoSQL = "INSERT INTO tb_trabalho 
            (`ds_titulo`, `cd_tipo`, `ds_revista`, `ano_public`, `ds_volume`, `ds_pagina`, `ds_instituicao`, `ds_cidade`, `ds_editora`, 
            `ds_isbn`, `dt_public`, `dt_consulta`, `ds_url`, `ds_doi`, `nm_arquivo`, `ic_publico`, `cd_usuario`, `ic_status`)
            VALUE 
            ( :titulo, :cdTipo, :revista, :anoPublic, :volume, :pagina, :instit, :cidade, :editora, :isbn, STR_TO_DATE(:dtPublic,'%d/%m/%Y'),
            STR_TO_DATE(:dtConsulta,'%d/%m/%Y'), :url, :doi, :nomeArquivo, :publico, :cdUsuario, :status )";
        
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT TRABALHO (dados: ".$params[':titulo']." ) - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaNewTrabalho ($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_trabalho ( cd_tipo ) VALUE  ( :cdTipo )";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT NOVO TRABALHO (dados: ".$params[':titulo']." ) - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraTrabalho ($conn, $params)
{
    try {
        $comandoSQL = "UPDATE tb_trabalho SET
            ds_titulo = :titulo, ds_revista = :revista, ano_public = :anoPublic, ds_volume = :volume, ds_pagina = :pagina, ds_instituicao = :instit";
        
        if(isset($params[':dtPublic'])){
            $comandoSQL .= ", dt_public = :dtPublic";
        }
        if(isset($params[':dtConsulta'])){
            $comandoSQL .= ", dt_consulta = :dtConsulta";
        }
        //utilizada na ativação de trabalho enviado pelo autor
        if(isset($params[':status'])){
            $comandoSQL .= ",ic_status = :status, dt_consulta = NOW()";
        }
        $comandoSQL .= ", ds_url = :url, ds_doi = :doi, ds_editora = :editora, ds_isbn = :isbn, ds_cidade = :cidade, nm_arquivo = :nmArquivo, ic_publico = :publico, cd_tipo = :cdTipo
            WHERE cd_trabalho = :cdTrabalho";
        
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return '0';
        }
        else{
            return '1';
        }
    } catch (PDOException $Exception) {
        return "UPDATE TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraStatusTrabalho($conn, $params){
    try {
        $comandoSQL = "UPDATE tb_trabalho SET ic_status = :status WHERE cd_trabalho = :cdTrabalho";
        
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return '0';
        }
        else{
            return '1';
        }
    } catch (PDOException $Exception) {
        return "UPDATE STATUS TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaChaveStr($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_chave FROM  tb_chave WHERE ds_chave LIKE TRIM(:dsChave)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $retorno = $stmt->fetch(PDO::FETCH_BOTH);
        return $retorno[0];
    } catch (PDOException $Exception) {
        return "SELECT COD CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
/*--------Modificado--------*/
function buscaChavePart($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_chave, ds_chave_pt FROM  tb_chave WHERE ds_chave_pt LIKE TRIM(:dsChave)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
        //return $retorno[0];
    } catch (PDOException $Exception) {
        return "SELECT COD CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
/*--------Modificado--------*/
function gravaChave($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO tb_chave (cd_chave, ds_chave_pt, ds_chave_en, ds_chave_es) VALUE (:cdChave, :chavePt, :chaveEn, :chaveEs)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
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
function excluiChaveTrabalho($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM tb_chave_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE CHAVE TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaAutorStr($conn, $params)
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
function excluiAutorTrabalho($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM tb_autor_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE AUTOR TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//rotina para excluir autores que não possuam trabalhos
function excluiAutorSemTrabalho($conn)
{
    try {
        $comandoSQL = "DELETE FROM tb_autor WHERE cd_autor NOT IN (SELECT DISTINCT(cd_autor) FROM tb_autor_trabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute();
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE AUTOR SEM TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//rotina para excluir chaves que não possuam trabalhos
function excluiChaveSemTrabalho($conn)
{
    try {
        $comandoSQL = "DELETE FROM tb_chave WHERE cd_chave NOT IN (SELECT DISTINCT(cd_chave) FROM tb_chave_trabalho)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute();
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE CHAVE SEM TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//funções para excluir dados inconsistentes
function excluiTrabalho($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM tb_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE AUTOR TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function excluiChave($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM tb_chave WHERE cd_chave = :cdChave";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE CHAVE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function excluiAutor($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM tb_autor WHERE cd_autor = :cdAutor";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE AUTOR  - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//gravar os logs de erro
function gravaErro($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO log_erro_trabalho (cd_csv, ds_erro) VALUE (:cdCsv, :dsErro)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT ERRO TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
//Excluir Trabalhos
function gravaExcluiTrabalho($conn, $params)
{
    try {
        $comandoSQL = "INSERT INTO log_exclui_trabalho ( ds_titulo, cd_user, ds_motivo, dt_exclui) VALUE (:dsTitulo, :cdUser, :dsMotivo, NOW())";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $Exception) {
        return "INSERT ERRO TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function excluiLogCsvTrabalho($conn, $params)
{
    try {
        $comandoSQL = "DELETE FROM log_csv_trabalho WHERE cd_trabalho = :cdTrabalho";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        return $linhasafetadas;
    } catch (PDOException $Exception) {
        return "DELETE AUTOR TRABALHO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}