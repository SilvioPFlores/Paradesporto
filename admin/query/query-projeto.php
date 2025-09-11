<?php
function buscaObjetivo($conn)
{
    try {
        $comandoSQL = "SELECT cd_objetivo, pt, ic_status FROM  tb_objetivo ORDER BY cd_objetivo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaObjetivoCod($conn, $params)
{
    try {
        $comandoSQL = "SELECT pt, en, es, ic_status FROM  tb_objetivo WHERE cd_objetivo = :cdObjetivo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaObjetivo($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_objetivo (pt, en, es, ic_status) VALUE (:strPt, :strEn, :strEs, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraObjetivo($conn, $params)
{
    try {
        //UPDATE
        $comandoSQL = "UPDATE tb_objetivo SET pt = :strPt, en = :strEn, es = :strEs, ic_status = :status WHERE cd_objetivo = :cdObjetivo";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE OBJETIVO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPronome($conn)
{
    try {
        $comandoSQL = "SELECT cd_pronome, pt, ic_status FROM  tb_pronome WHERE cd_pronome > 1 ORDER BY pt";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRONOME - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPronomeCod($conn, $params)
{
    try {
        $comandoSQL = "SELECT pt, en, es, ic_status FROM  tb_pronome WHERE cd_pronome = :cdPronome";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRONOME - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaPronome($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_pronome (pt, en, es, ic_status) VALUE (:strPt, :strEn, :strEs, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT PRONOME - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraPronome($conn, $params)
{
    try {
        //UPDATE
        $comandoSQL = "UPDATE tb_pronome SET pt = :strPt, en = :strEn, es = :strEs, ic_status = :status WHERE cd_pronome = :cdPronome";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE PRONOME - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCargo($conn)
{
    try {
        $comandoSQL = "SELECT cd_cargo, pt, ic_status FROM  tb_cargo ORDER BY nm_ordem, pt";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCargoCod($conn, $params)
{
    try {
        $comandoSQL = "SELECT pt, en, es, ds_lider, nm_ordem, ic_status FROM  tb_cargo WHERE cd_cargo = :cdCargo";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaCargo($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_cargo (pt, en, es, ic_status) VALUE (:strPt, :strEn, :strEs, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraCargo($conn, $params)
{
    try {
        //UPDATE
        $comandoSQL = "UPDATE tb_cargo SET pt = :strPt, en = :strEn, es = :strEs, ds_lider = :lider, nm_ordem = :ordem, ic_status = :status WHERE cd_cargo = :cdCargo";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaEquipe($conn, $params)
{
    try {
        $comandoSQL = "SELECT te.cd_equipe, tp.pt, te.ds_equipe FROM tb_equipe te, tb_pronome tp WHERE tp.cd_pronome = te.cd_pronome AND te.cd_cargo = :cdCargo AND te.ic_status = :status ORDER BY te.nm_ordem";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT EQUIPE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaEquipeIn($conn, $params)
{
    try {
        $comandoSQL = "SELECT te.cd_equipe, tp.pt, te.ds_equipe FROM tb_equipe te, tb_pronome tp WHERE tp.cd_pronome = te.cd_pronome AND te.ic_status = :status ORDER BY ds_equipe";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT EQUIPE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaEquipeCod($conn, $params)
{
    try {
        $comandoSQL = "SELECT cd_cargo, cd_pronome, ds_equipe, ic_status FROM tb_equipe WHERE cd_equipe = :cdEquipe";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT EQUIPE - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaCargoAt($conn)
{
    try {
        $comandoSQL = "SELECT cd_cargo, pt FROM  tb_cargo WHERE ic_status = 'AT' ORDER BY nm_ordem";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function buscaPronomeAt($conn)
{
    try {
        $comandoSQL = "SELECT cd_pronome, pt FROM  tb_pronome WHERE ic_status = 'AT' ORDER BY pt";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT PRONOME - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaEquipe($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_equipe (cd_pronome, cd_cargo, ds_equipe, ic_status) VALUE (:cdPronome, :cdCargo, :strNome, :status)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function alteraEquipe($conn, $params)
{
    try {
        //UPDATE
        $comandoSQL = "UPDATE tb_equipe SET cd_pronome = :cdPronome, cd_cargo = :cdCargo, ds_equipe = :strNome, nm_ordem = :ordem, ic_status = :status WHERE cd_equipe = :cdEquipe";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "UPDATE CARGO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}