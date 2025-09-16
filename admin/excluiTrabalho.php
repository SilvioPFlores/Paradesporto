<?php
require_once 'db/dbConnection.php';
require_once 'query/query-trabalho.php';
$cdUser = $_SESSION['repositorio']['cdAcesso'];
if(isset($_GET['motivo'], $_GET['cdTrabalho'])){
    //buscando o título do trabalho
    $paramsCdTrabalho = array(':cdTrabalho' => $_GET['cdTrabalho']);
    $dsTitulo = buscaTrabalhoCod($conn, $paramsCdTrabalho);
    //Gravando as informações para excluir o trabalho
    gravaExcluiTrabalho($conn, array(':dsTitulo' => $dsTitulo[0], ':cdUser' => $cdUser, ':dsMotivo' => $_GET['motivo']));
    //excluir o cdTrabalho das tabelas relacionadas
    excluiAutorTrabalho($conn, $paramsCdTrabalho);
    excluiChaveTrabalho($conn, $paramsCdTrabalho);
    excluiLogCsvTrabalho($conn, $paramsCdTrabalho);
    //excluir o trabalho
    $exTrabalho = excluiTrabalho($conn, $paramsCdTrabalho);
    if($exTrabalho == 1){
        excluiAutorSemTrabalho($conn);
        echo json_encode(array('result' => 'ok', 'ok' => 'Trabalho excluido com suvesso!'));
    }
    else{
        echo json_encode(array('result' => 'erro', 'erro' => "Não foi possível excluir o trabalho!", 'detalhe' => $exTrabalho));
    }
}