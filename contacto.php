<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Formulario de Contacto</title>	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
	<script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container">

	  <!-- Formulario debe tener un id que sera el que llama a la funcion -->
      <form class="form-signin" id="form-contacto" method="POST"  action="respuesta.php">
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

<style>
	.error
	{
		background-color: #cc6600;
	}	
</style>
	
</body>
</html>