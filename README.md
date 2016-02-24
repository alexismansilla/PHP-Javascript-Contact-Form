# PHP-Javascript-Contact-Form

Creación de un formulario de contacto HTML, validaciones Jquery y Envío de correo mediante PHP

> El contenido de este desarrollo esta adaptado para usos personales,
> cualquier modificación es bienvenida.

##### El desarrollo cuenta de los siguientes archivos :

* EmailService.php - Clase para el envío de correos
* contacto.php - Formulario de Contacto HTML
* respuesta.php - Página de respuesta del formulario
* js/validate.js - Funcion JS para validación de formularios

### Configuracion EmailService.php
```
    public $mensaje_ok 			= 'Gracias por contactarnos';
	public $mensaje_error 		= 'Lo Sentimos, Ocurrió un error al enviar su formulario';
	public $mensaje_validacion 	= 'Debe Completar todos los Campos';
	public $destino 			= 'gbarrerasaez.cl@gmail.com';
	public $asunto  			= 'Contacto de Formulario de Sitio Web';	
	//public $formato			= 'text/html' ;	 
	public $formato				= 'text/plain' ;	 
```

### Formulario HTML
```
<!-- Formulario debe tener un id que sera el que llama a la funcion -->
      <form class="form-signin" id="form-contacto" method="POST"  action="respuesta.php">
       <!-- Validacion para evitar ejecución directa -->
        <input type="hidden" name="token" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
        <h2 class="form-signin-heading">Formulario de Contacto</h2>
        <br>
        <!-- Div contenedor del mensaje de error -->
        <div id="mensaje" class="alert alert-danger"></div>       
        <!-- campos de formulario deben tener un name y id iguales -->
        <label for="nombre">Nombre: *</label>
        <input type="text" name="nombre" id="nombre" class="form-control" autofocus>
		<br>
        <label for="correo">Correo: *</label>
        <input type="text" name="correo" id="correo" class="form-control">
		<br>
		<label for="telefono">Teléfono:</label>
        <input type="text" name="telefono" id="telefono" class="form-control">
		<br>
        <label for="comentarios">Comentarios: *</label>
        <textarea class="form-control" name="comentarios" id="comentarios"></textarea>
		<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar!</button>
      </form>
    </div> 
```

### Llamada JS
```
<script src="js/validate.js"></script>
    <script>
    $(function() 
	{
		$("#form-contacto").validate(
        {   
        	// Reglas de validacion             
            reglas: {
            	nombre 			:'text|4|10', // tipo|minimo|maximo
            	correo			:'email',
            	comentarios		:'text',
            },
            // Estilos de errores
            css: { 
            	'class_error'	:'error',    // Class que se aplicará a los campos con reglas
            	'id_msg_error'	:'#mensaje'  // id div del mensaje de error, con #            	
           	}
        }); 
	});
    </script>
```

### Página de Respuesta
```
<?php 
include 'EmailService.php' ;
...
	  <div class="well well-sm"><?php echo $respuesta; ?></div>
...
?>
```
