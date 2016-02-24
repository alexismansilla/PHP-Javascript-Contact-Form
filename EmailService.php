<?php 
ini_set('display_errors', 0); 
//error_reporting(E_ALL);

class EmailService
{
	public $mensaje_ok 			= 'Gracias por contactarnos';
	public $mensaje_error 		= 'Lo Sentimos, Ocurrió un error al enviar su formulario';
	public $mensaje_validacion 	= 'Debe Completar todos los Campos';
	public $destino 			= 'gbarrerasaez.cl@gmail.com';
	public $asunto  			= 'Contacto de Formulario de Sitio Web';	
	//public $formato			= 'text/html' ;	 
	public $formato				= 'text/plain' ;	 

	public function __construct()
	{		
		if ($_SERVER['REMOTE_ADDR']!=$_POST["token"])
		{
			die("Acceso no autorizado");
		}		
	}

	protected function filtrar($data)
	{
		if ( empty($data['nombre']) || empty($data['telefono']) ||
   	 		 empty($data['correo']) || empty($data['comentarios']) )	    	
   	 	{   	 		
			return false;
		}

		// Campos de Texto
		$data_filtrada["nombre"]   = filter_var($data['nombre'], FILTER_SANITIZE_STRING);
		$data_filtrada["telefono"] = filter_var($data['telefono'], FILTER_SANITIZE_STRING);
			
		// Campo de Correo	
		$data_filtrada["correo"] = filter_var($data['correo'], FILTER_VALIDATE_EMAIL);

		// Campos de contenido (textarea)
		$data_filtrada["comentarios"] = filter_var($data['comentarios'], FILTER_SANITIZE_STRING);
		$data_filtrada["comentarios"] = stripslashes(trim(htmlspecialchars($data_filtrada["comentarios"])));

		return $data_filtrada;
	}

	protected function cuerpo($data)
	{
		// Escribo el cuerpo del mensaje
		$cuerpo = "Nombre: ".$data["nombre"]."\n".
				  "Telefono: ".$data["telefono"]."\n".
				  "Correo: ".$data["correo"]."\n".
				  "Comentarios: ".$data["comentarios"]."\n";
		return $cuerpo;
	}

	public function enviar($data)
	{
		// Sanitizo la data
		$data_filtrada = EmailService::filtrar($data);
		if (!$data_filtrada)
		{
			return $this->mensaje_validacion;
		}
		// Creo el cuerpo
		$cuerpo = EmailService::cuerpo($data);
		// Envio el mensaje	
		$cabeceras = "From: ".$data["correo"]." \r\n" .    	
				   "Content-Type: ".$this->formato."; charset=UTF-8".
	    		   "X-Mailer: PHP/" . phpversion();	   
		if (mail($this->destino, utf8_decode($this->asunto), utf8_decode($cuerpo), $cabeceras))
		{
			return $this->mensaje_ok;
		}
		else
		{
			return $this->mensaje_error;
		}
	}

}

$email = new EmailService();
$respuesta = $email->enviar($_POST);

?>