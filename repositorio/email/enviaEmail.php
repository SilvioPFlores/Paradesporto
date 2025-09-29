<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../Classes/PHPMailer/src/Exception.php';
require '../Classes/PHPMailer/src/PHPMailer.php';
require '../Classes/PHPMailer/src/SMTP.php';
require 'emailConfig.php';

function smtpmailer($nome, $email, $cdTrabalho)
{
    $mail = new PHPMailer(true);
    $corpo = "Olá $nome!<br><br>Obrigado por nos enviar seu trabalho!<br>Seu numero de protocólo é #$cdTrabalho, logo entraremos em contato para informar sobre a aceitação do seu trabalho.<br><br>Att: Equipe do Paradesporto Brasil + Acessível";
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
        $mail->setFrom(REMET, encodeToIso(REMETENTE));
        $mail->addAddress($email, encodeToIso($nome));
        //$mail->addBCC('ruthcidade@gmail.com', 'Ruth Cidade');
        //$mail->addBCC('silvio.flores@unifesp.br', 'Developer');
        $mail->addBCC('sonicvsticoeteco@gmail.com', 'Developer');

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