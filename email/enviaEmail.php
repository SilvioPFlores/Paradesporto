<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Classes/PHPMailer/src/Exception.php';
require 'Classes/PHPMailer/src/PHPMailer.php';
require 'Classes/PHPMailer/src/SMTP.php';
require 'emailConfig.php';

function enviaContato($arrParams, $dsPcd)
{
    $mail = new PHPMailer(true);
    if($arrParams[':dsFone'] != ''){
        $dsTel = $arrParams[':dsFone'];
    }
    else{
        $dsTel = 'não informado';
    }
    $corpo = "Mensagem enviada por ". $arrParams[':dsNome'].", email: ".$arrParams[':dsEmail'].", telefone $dsTel.<br>";
    if($arrParams[':icPcd'] == 'N'){
        $corpo .= "Não possui deficiência.";
    }
    else if($arrParams[':icPcd'] == 'S'){
        $corpo .= "Possui deficiência ($dsPcd)";
    }
    if($arrParams[':dsApoio'] != ''){
        $corpo .= " e utiliza como apoio para navegar na internet ".$arrParams[':dsApoio'].".";
    }
    if($arrParams[':dsAssunto'] != ''){
        $corpo .= "<br>Assunto: ".$arrParams[':dsAssunto'].".";
    }
    if($arrParams[':txMensagem'] != ''){
        $corpo .= "<br>Mensagem: ".$arrParams[':txMensagem'].".";
    }
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = HOST;
        $mail->SMTPAuth = true;
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //SMTPSecure = 'ssl';
        $mail->Port = PORTA;
       //Recipients
        $mail->setFrom($arrParams[':dsEmail'], encodeToIso($arrParams[':dsNome']));
        $mail->addAddress('sonicvsticoeteco@gmail.com', 'Developer');
        //$mail->addAddress('ciro.winckler@unifesp.br', 'Ciro Winckler');
        //$mail->addCC('ruthcidade@gmail.com', 'Ruth Cidade');
        //$mail->addCC('silvio.flores@unifesp.br', 'Developer');

        //Content
        $mail->isHTML(true);    //Set email format to HTML
        $mail->Subject = encodeToIso(ASSUNTO);
        $mail->Body    = encodeToIso($corpo);
        $mail->AltBody = encodeToIso($corpo);

        $mail->send();
        
        return 'ok';
    } catch (Exception $e) {
        return "Mensagem não enviada. Mailer Error: {$mail->ErrorInfo}";
    }
}
/**
 * Converte texto de  UTF-8,ISO-8859-15 		PARA ISO-8859-1
 * @autor --
 * @ param {String} - texto qualquer
 * @ return {String} - texto convertido PARA ISO-8859-1
 */
function encodeToIso($string)
{
    return mb_convert_encoding($string, "ISO-8859-1", mb_detect_encoding($string, "UTF-8, ISO-8859-1, ISO-8859-15", true));
}