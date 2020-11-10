<?php
$subject = 'Nuevo Mensaje de mi página web | Buho Solutions '; // Subject of your email
$okMessage = '¡Mensaje enviado!, en breve nos pondremos en contacto contigo';
$errorMessage = 'Ocurrió un error, Por favor intente nuevamente más tarde.';
$to = 'urielperez9781@gmail.com';  //Recipient's E-mail
$emailTo = $_REQUEST['email'];

$name = $_REQUEST['name'];
$email = $_REQUEST['email'];

$msg = $_REQUEST['message'];

$email_from = $name.'<'.$email.'>';

$headers = "";
$headers .= "";
$headers .= "De: ".$name.'<'.$email.'>'."\r\n"; // Sender's E-mail
$headers .= "Return-Path:"."De:" . $email;

$message= "";
$message .= 'Nombre : ' . $name . "\n";
$message .= 'E-mail : ' . $email . "\n";

$message .= 'Mensaje : ' . $msg;

if (@mail($to, $subject, $message))
{
	// Transfer the value 'sent' to ajax function for showing success message.
	//echo 'Mensaje Enviado, nos comunicaremos lo antes posible.';
	 $responseArray = array('type' => 'success', 'message' => $okMessage);
	
}
else
{
	// Transfer the value 'failed' to ajax function for showing error message.
	echo 'Ha ocurrido un error, intente más tarde.';
	 $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}



if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
      $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}

?>