<?php
function buscaGeral($conn)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_visita), COUNT(DISTINCT(ds_ip)) FROM tb_visita";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPorDias($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_visita), COUNT(DISTINCT(ds_ip)) FROM tb_visita WHERE dt_acesso BETWEEN CURDATE() - INTERVAL :qtdDias DAY AND CURDATE()";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPorMes($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_visita), COUNT(DISTINCT(ds_ip)) FROM tb_visita WHERE MONTH(dt_acesso) = :mes AND YEAR(dt_acesso) = :ano";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPorAno($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_visita), COUNT(DISTINCT(ds_ip)) FROM tb_visita WHERE YEAR(dt_acesso) = :ano";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPeriodo($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_visita), COUNT(DISTINCT(ds_ip)) FROM tb_visita WHERE dt_acesso BETWEEN DATE(:dtInicio) AND DATE(:dtFim)";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPalavras($conn)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_chave, ds_chave FROM tb_chave ORDER BY ds_chave";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTotalTrabalhos($conn)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_trabalho) FROM tb_trabalho ";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arr =  $stmt->fetch(PDO::FETCH_BOTH);
        return $arr[0];
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTotalAutor($conn)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_autor) FROM tb_autor ";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arr =  $stmt->fetch(PDO::FETCH_BOTH);
        return $arr[0];
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTotalPalavras($conn)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT(cd_chave) FROM tb_chave ";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        $arr =  $stmt->fetch(PDO::FETCH_BOTH);
        return $arr[0];
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaMesesPorAno($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT DISTINCT EXTRACT(MONTH FROM `dt_acesso`) AS mes FROM tb_visita  WHERE YEAR(dt_acesso) = :ano ORDER BY mes";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaTotContChaveMes($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT COUNT( DISTINCT cd_chave) FROM tb_cont_chave WHERE cd_visita in ( SELECT cd_visita  FROM tb_visita WHERE MONTH(dt_acesso) = :mes );";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        $arr =  $stmt->fetch(PDO::FETCH_BOTH);
        return $arr[0];
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaQtdPorMes($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT 
	tc.ds_chave, COUNT(tcc.cd_chave) 
FROM 
	tb_cont_chave as tcc, tb_chave as tc
WHERE 
	tcc.cd_chave = tc.cd_chave AND
	tcc.cd_visita in (
		SELECT cd_visita  FROM tb_visita WHERE MONTH(dt_acesso) = :mes ) 
GROUP BY 
	tcc.cd_chave 
ORDER BY 
	2 DESC;";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT ACESSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}

/*SELECT `cd_chave`, COUNT(`cd_chave`) FROM `tb_cont_chave` GROUP BY `cd_chave`;*/
/*SELECT `cd_chave`, COUNT(`cd_chave`) FROM `tb_cont_chave` GROUP BY `cd_chave` HAVING COUNT(`cd_chave`) > 1 ORDER BY 2 DESC;*/
/*SELECT `cd_chave`, COUNT(`cd_chave`) FROM `tb_cont_chave`WHERE `cd_visita` in (275) GROUP BY `cd_chave` HAVING COUNT(`cd_chave`) > 1 ORDER BY 2 DESC;*/
/*SELECT `cd_chave`, COUNT(`cd_chave`) FROM `tb_cont_chave`WHERE `cd_visita` in (
	SELECT cd_visita  FROM tb_visita WHERE dt_acesso BETWEEN DATE('2024-01-01') AND DATE('2024-10-10')
) GROUP BY `cd_chave` HAVING COUNT(`cd_chave`) > 1 ORDER BY 2 DESC;*/

/*
SELECT 
	tc.ds_chave, COUNT(tcc.cd_chave) 
FROM 
	tb_cont_chave as tcc, tb_chave as tc
WHERE 
	tcc.cd_chave = tc.cd_chave AND
	tcc.cd_visita in (
		SELECT cd_visita  FROM tb_visita WHERE dt_acesso BETWEEN DATE('2024-01-01') AND DATE('2024-10-10')) 
GROUP BY 
	tcc.cd_chave 
HAVING 
	COUNT(tcc.cd_chave) > 1
ORDER BY 
	2 DESC;
*/

/*SELECT DISTINCT EXTRACT(YEAR FROM `dt_acesso`) AS ano, EXTRACT(MONTH FROM `dt_acesso`) AS mes
FROM tb_visita 
WHERE YEAR(dt_acesso) = 2024
ORDER BY ano, mes;*/