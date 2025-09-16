<?php
require_once '../db/dbConfig.php';

try {
    //Instancia un novo objeto do tipo PDO
    //Indica que este objeto se conectará ao banco utilizando o drive mysql
    //Acessando a base de dados chamada covid, no servidor indicado como localhost e utilizando as credenciais (user, password)
    //Todas as configurações e parâmetros foram definidas no arquivo dbConfig.php
    $conn = new PDO(DBDRIVER . ':host=' . DBHOSTNAME . ';port=' . DBPORT . ';dbname=' . DBNAME . ';charset=utf8', DBUSERNAME, DBPASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    //Modificando atributos / propriedades do objeto conexão
    //Informando que os erros devem ser tratados utilizando / enviando EXCEPTION
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $Exception) {
    echo "Erro: " . $Exception->getMessage() . " - Código: " . $Exception->getCode();
}
