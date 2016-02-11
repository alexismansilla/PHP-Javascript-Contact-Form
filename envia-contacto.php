<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

// Configuraciones
$destino			 = "cliente@paginaweb.com";
$subjet 			 = "Contacto desde sitio web";
$respuesta			 = "Gracias por contactarnos";

if (isset($_POST['correo'])) {

	// Campos de Texto
	$nombre   = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
	$telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
		
	// Campos de Correo
	$correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
	$correo = filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL);

	// Campos de contenido (textarea)
	$comentarios = filter_var($_POST['comentarios'], FILTER_SANITIZE_STRING);
	$comentarios = htmlspecialchars($comentarios);
	$comentarios = trim($comentarios);
	$comentarios = stripslashes($comentarios);
	
	// Escribo el cuerpo del mensaje
	$mensaje = "Nombre: $nombre\n".
			   "Telefono: $telefono\n".
			   "Correo: $correo\n".
			   "Comentarios: $comentarios\n";

	// Envio el mensaje	
	if ($correo) 
	{		
		$headers = "From: $correo \r\n" .    	
				   "Content-Type: text/plain; charset=UTF-8".
    			   "X-Mailer: PHP/" . phpversion();
		mail($destino, utf8_decode($subjet), utf8_decode($mensaje), $headers);
	}

}

?>