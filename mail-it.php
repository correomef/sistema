<?php

/*
Template Name: mailit
*/

$send_to = $_POST['mailDestino'];

$de = $_POST['mailDestino'];/*necesario para servidor windows, tiene que ser una cuenta valida*/
$empresa_nombre = $_POST['nombreEmpresa'];
$send_subject = "CONSULTA via WEB";

if (isset($_POST['suscripcion']))
 {
    $send_subject = "Nueva Suscripción";
}



/*Be careful when editing below this line */
function cleanupentries($entry) {
    $entry = trim($entry); //elimina espacios en blanco al INICIO y FINAL de la cadena
    $entry = stripslashes($entry); // Quita las barras de un string con comillas escapadas
    $entry = htmlspecialchars($entry); // Convierte caracteres especiales en entidades HTML

    return $entry;
}

$i = 1;
foreach ($_POST as $campo => $val) {

	if ($campo != 'suscripcion' && $campo != 'mailDestino' && $campo != 'nombreEmpresa')
       $datos[$i++] = '<p><span style="width:80px; text-align:right; color:#000000"><strong>'.str_replace("_"," ",$campo).'</span </strong>: '.cleanupentries($val).'</p>';
}

$datosHTML = implode(" ", $datos);

$headHTML =' <html>
                <head>
                	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                </head>
                <body>
                	<div style=" font-family: Arial, Helvetica, sans-serif; color:#404040; background: #fff; width:350px; overflow:hidden; padding: 0px  0px  10px 0px;">
	                  <div style=" margin:10px 10px 10px 35px">
	                  <span style=" color:#000000; font-size:30px"><strong>'.$empresa_nombre.'</strong></span><br />
	                  <span style=" color:#404040; font-size:10px"> Mail generado via web </span><br />
	        ';


$footerHTML = '</div>

                </div>

                </body>

                </html>';

$mensaje = $headHTML.$datosHTML.$footerHTML;



if (isset($_POST['Nombre'])) $nombre = $_POST['Nombre'];
else $nombre = 'Solicitante';

$send_subject .= " - {$nombre}";

if (isset($_POST['E_mail'])) $email = $_POST['E_mail'];
else $email = '';

$headers = "From: " . $de . "\r\n" .
    "Reply-To: " . $email . "\r\n" . 'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
    "X-Mailer: PHP/" . phpversion();


if ($_POST['mailDestino'] ==='' || !isset($_POST['mailDestino'])) {
	$send_to = 'correomef@gmail.com';
}
echo 'a: '.$send_to.'<br>';
echo 'de: '.$de.'<br>';
echo 'empresa: '.$empresa_nombre.'<br>';
echo 'asunto: '.$send_subject.'<br>';
echo 'mensafe: '.$mensaje.'<br>';
echo 'cabeceras: '.$headers.'<br>';

mail($send_to, $send_subject, $mensaje, $headers);


?>