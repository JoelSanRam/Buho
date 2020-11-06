<?php

// configure
$from = 'Demo contact form <demo@domain.com>';
$sendTo = 'joel.sanchez.ramirez10@gmail.com'; 
$subject = 'Búho Solutions | Nuevo mensaje de mi página web';
$fields = array('name' => 'Name', 'subject' => 'Subject', 'email' => 'Email', 'message' => 'Message'); // array variable name => Text to appear in the email
$okMessage = '¡Mensaje enviado!, en breve nos pondremos en contacto contigo';
$errorMessage = 'Ocurrió un error, Por favor intente nuevamente más tarde.';

// let's do the sending

try
{
    $emailText = "Nueve mensaje de formulario\n=============================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'De: ' . $from,
        'De: ' . $from,
        'De: ' . $from,
    );
    
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
