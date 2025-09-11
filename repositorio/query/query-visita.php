<?php
function buscaVisita($conn, $params)
{
    try {
        //SELECT
        $comandoSQL = "SELECT cd_visita FROM  tb_visita WHERE ds_ip = :ip AND dt_acesso = :data AND hr_acesso = :hora";
        $stmt = $conn->prepare($comandoSQL);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_BOTH);
    } catch (PDOException $Exception) {
        echo "SELECT VISITA - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}
function gravaVisita($conn, $params)
{
    try {
        //INSERT
        $comandoSQL = "INSERT INTO tb_visita (ds_ip, dt_acesso, hr_acesso) VALUE (:ip, :data, :hora)";
        $stmt = $conn->prepare($comandoSQL);
        $linhasafetadas = $stmt->execute($params);
        if ($linhasafetadas == 1) {
            return 'ok';
        }
    } catch (PDOException $Exception) {
        echo "INSERT CURSO - Erro: " . $Exception->getMessage() . " . Código" . $Exception->getCode();
    }
}