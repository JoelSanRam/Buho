<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$mail = new PHPMailer(true);

// configure
$from = 'hola@buho-solutions.com';
$subject = 'Búho Solutions | Nuevo mensaje de mi página web';
$fields = array('name' => 'Name', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in the email
$okMessage = '¡Mensaje enviado!, en breve nos pondremos en contacto contigo';
$errorMessage = 'Ocurrió un error, Por favor intente nuevamente más tarde.';


try
{
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.zoho.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'hola@buho-solutions.com';                     // SMTP username
    $mail->Password   = '';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


   

    //Recipients
    $mail->setFrom($from, 'Buho Solutions');
    $mail->addAddress('urielperez9781@gmail.com', 'Buho Solutions');
    /* $mail->addReplyTo('hola@buho-solutions.com', 'Informacion');
    $mail->addCC('joel.sanchez.ramirez10@gmail.com');
    $mail->addCC('samuel.servin@buho-solutions.com');
    $mail->addCC('samservin@hotmail.com');
    $mail->addCC('urielperez9781@gmail.com'); */

    $emailText = "Nueve mensaje de formulario<br>=============================<br>";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value <br>";
        }
    }


    // Content
    $mail->isHTML(true);                                
    $mail->Subject = 'Buho Solutions | Nuevo mensaje de Formulario Contacto';
    $mail->Body    = "<br>".$emailText;
    if($mail->send()){
        $responseArray = array('type' => 'success', 'message' => $okMessage);
    }
    
    
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);

}

var_dump($_SERVER['HTTP_X_REQUESTED_WITH']);
var_dump($_SERVER['HTTP_X_REQUESTED_WITH']);


if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
