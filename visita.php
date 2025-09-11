<?php
session_start();
require_once "db/dbConnection.php";
include_once "query/query-visita.php";
date_default_timezone_set('America/Fortaleza');

if(isset($_POST['visita'])){
    $ip = $_SERVER['REMOTE_ADDR'];
    $data = date('Y-m-d');
    $hora = date('H');
    $minuto = date('i');
    $params = array(':ip' => $ip, ':data' => $data, ':hora' => $hora);
    $visita = buscaVisita($conn, $params);
    $params[':minuto'] = $minuto;
    if($visita == ''){
        $idVisita .= gravaVisita($conn, $params);
        $_SESSION['prdpt']['idVisita'] = $idVisita;
    }
    else{
        $_SESSION['prdpt']['idVisita'] = $visita[0];
    }
}
else if(isset($_POST['download'])){
    $idVisita = $_SESSION['prdpt']['idVisita'];
    $tipo1 = explode("/", $_POST['download'])[0];
    $tipo2 = explode("/", $_POST['download'])[1];
    $tipo2 = str_replace('_en.'.pathinfo($tipo2, PATHINFO_EXTENSION), '.'.pathinfo($tipo2, PATHINFO_EXTENSION) ,$tipo2);
    $tipo2 = str_replace('_es.'.pathinfo($tipo2, PATHINFO_EXTENSION), '.'.pathinfo($tipo2, PATHINFO_EXTENSION) ,$tipo2);
    if($tipo1 == 'trabalhos'){
        $retorno = gravaDownload($conn, array(':cdTipo' => 1, ':cdSubtipo' => null, ':cdTrabalho' => explode("d", $tipo2)[0], ':cdProducao' => null, ':cdVisita' => $idVisita));
    }
    else if($tipo1 == 'conteudo'){
        $params = array(':valor' => $tipo2);
        switch (explode("-", $tipo2)[0]){
            case 'epub': 
                $cdSubtipo = 2;
                $cdProd = buscaCdProducao($conn, 'nm_epub', $params);
                break;
            case 'img':
                $cdSubtipo = 3; 
                $cdProd = buscaCdProducao($conn, 'nm_foto', $params);
                break;
            default: 
                $cdSubtipo = 1;
                $cdProd = buscaCdProducao($conn, 'nm_arquivo', $params);
        }
        $retorno = gravaDownload($conn, array(':cdTipo' => 2, ':cdSubtipo' => $cdSubtipo, ':cdTrabalho' => null, ':cdProducao' => $cdProd, ':cdVisita' => $idVisita));
    }
    else{
        $cdSubtipo = 4;
        echo $_POST['download'].'<br>';
        $tipoMp3 = explode("=", $_POST['download'])[1];
        $tipoMp3 = str_replace('_en.'.pathinfo($tipoMp3, PATHINFO_EXTENSION), '.'.pathinfo($tipoMp3, PATHINFO_EXTENSION) ,$tipoMp3);
        $tipoMp3 = str_replace('_es.'.pathinfo($tipoMp3, PATHINFO_EXTENSION), '.'.pathinfo($tipoMp3, PATHINFO_EXTENSION) ,$tipoMp3);
        $cdProd = buscaCdProducao($conn, 'nm_audio', array(':valor' => $tipoMp3));
        $retorno = gravaDownload($conn, array(':cdTipo' => 2, ':cdSubtipo' => $cdSubtipo, ':cdTrabalho' => null, ':cdProducao' => $cdProd, ':cdVisita' => $idVisita));
    }
}
else if(isset($_POST['palavraChave'])){
    $idVisita = $_SESSION['prdpt']['idVisita'];
    $cdChave = explode("?c=", $_POST['palavraChave'])[1];
    $retorno = gravaChave($conn, array(':cdChave' => $cdChave, ':cdVisita' => $idVisita));
}