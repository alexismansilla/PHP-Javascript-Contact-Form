$(function(){

    $.fn.validate = function( options ) {
        // parametros       
        var id_msg_error = options.css.id_msg_error; 
        var class_error = options.css.class_error; 
        var msg_error = '';
        
        // Defino el ID del formulario
        var frmId = "#"+$(this).attr("id");  
        
        // Oculto el div de error        
        $(id_msg_error).css("display","none");

        // ejecuto las reglas
        $(frmId).submit(function(event){

            // Elimino las clases de error
            $(frmId+' *').removeClass(class_error);

            // Obtengo las reglas
            reglas = options.reglas;

            // Ejecuto las reglas
            for (var key in reglas) 
            {   
                var arr = reglas[key];          // regla y parametros            
                var regla = arr.split('|');     // Array de parametros
                var obj = $("#"+key);           // Campo actual

                // Campos de texto  
                if (regla[0]=='text')
                {                      
                    if ($.trim(obj.val())=='')
                    {
                        msg_error = "El campo "+key+" no puede estar vacio. <br>";
                        obj.focus();
                        obj.addClass(class_error);
                        $(id_msg_error).css("display","block");
                        $(id_msg_error).html(msg_error);
                        return false;
                    }

                    // Valido largo minimo
                    if (regla[1])
                    {                   
                        if (obj.val().length < regla[1])
                        {
                            msg_error = "El campo "+key+" debe tener minimo "+regla[1]+ " caracteres. <br>";
                            obj.focus();
                            obj.addClass(class_error);
                            $(id_msg_error).css("display","block");
                            $(id_msg_error).html(msg_error);
                            return false;
                        }
                    }

                    // Valido largo maximo
                    if (regla[2])
                    {                   
                        if (obj.val().length > regla[2])
                        {
                            msg_error = "El campo "+key+" debe tener máximo "+regla[2]+ " caracteres. <br>";
                            obj.focus();
                            obj.addClass(class_error);
                            $(id_msg_error).css("display","block");
                            $(id_msg_error).html(msg_error);
                            return false;
                        }
                    }
                }

                // Campos de email  
                if (regla[0]=='email')
                {                 

                    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                    if (!pattern.test(obj.val()))
                    {
                        msg_error = "El campo "+key+" debe ser un correo válido. <br>";
                        obj.focus();
                        obj.addClass(class_error);
                        $(id_msg_error).css("display","block");
                        $(id_msg_error).html(msg_error);
                        return false;
                    }
                }

            }     

        return true;

        });
    }
})