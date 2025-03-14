$(document).ready(function(){  
    // Evento para el botón de búsqueda
    $(document).on("click", "#btn_buscar", function() {      
        $.post("../controlador/listar.php", {
            action: 'listar',
            buscar_ficha: $('#buscar_ficha').val()
        }, function(data){             
            $("#cuerpo_table").html(data.listar);
        }, 'json');  
    });

    // Evento para abrir el modal y cargar el valor de la ficha
    $(document).on('click', '#btncrear', function(){
        $('#alo').modal('show');
        $('#fichacrear').val($('#buscar_ficha').val());
    });

    $(document).on('click', '#btnEditarFicha', function(){
        
        let ficha = $(this).data("editarficha2");
        let nombreFicha = $(this).data("nomficha");
        let fechainicio = $(this).data("fechainicio");
        let fechafinal = $(this).data("fechafinal");

        let depto = $(this).data("depto");
        let muni = $(this).data("muni");

        console.log("DEPTO", depto);
        console.log("MUNI", muni);
        let formattedDate = new Date(fechainicio);
        let formattedDate2 = new Date(fechafinal);
        // Si no es una fecha válida, intenta convertirla
        if (isNaN(formattedDate && formattedDate2)) {
            // Aquí podrías hacer una conversión manual si sabes el formato
            console.log("Fecha inválida:", fechainicio);
            console.log("Fecha inválida:", fechafinal);

        } else {

            let formattedfechainicio = (fechainicio);
            console.log(formattedfechainicio);
            // Asignar el valor al campo de fecha (si es necesario)
            $("#editarInicioFecha").val(formattedfechainicio);
            let formattedfechafinal = (fechafinal);
            console.log(formattedfechafinal);
            // Asignar el valor al campo de fecha (si es necesario)
            $("#editarFinalFecha").val(formattedfechafinal);
        
            
        }
        
        $('#inputFicha').val(ficha);
        $('#editarNomFicha').val(nombreFicha);

        $('#deptoFicha').val(depto);
        $('#muniFicha').val(muni);
    });
    
    $(document).on("click", ".btnVerUsuarios", function() {
        let ficha = $(this).data("ficha");
        let $tablaUsuarios = $("#tablaUsuarios");  // Seleccionamos el contenedor de la tabla de usuarios
        
        // Si la tabla de usuarios está visible, la ocultamos
        if ($tablaUsuarios.is(":visible")) {
            $tablaUsuarios.slideUp();  // Desaparecer la tabla con animación
        } else {
            // Si está oculta, hacer la solicitud AJAX para cargar los usuarios
            $.post("../controlador/listar.php", {
                action: 'listarUsuarios',
                ficha: ficha
            }, function(data) {
                if (data.result === "1") {
                    // Limpiar los usuarios actuales en la tabla
                    $("#tablaUsuarios tbody").empty();
            
                    // Añadir los usuarios de la ficha en la tabla
                    data.usuarios.forEach(function(usuario) {
                        $("#tablaUsuarios tbody").append("<tr><td>" + usuario + "</td></tr>");
                    });
                    // Mostrar la tabla de usuarios
                    $tablaUsuarios.slideDown();
                } else {
                    // Si no hay usuarios o hay un error, mostrar un mensaje en la tabla
                    $("#tablaUsuarios tbody").html("<tr><td colspan='1'>" + data.msj + "</td></tr>");
                    $tablaUsuarios.slideDown(); // Asegurarnos de que la tabla se muestre, aunque no haya usuarios
                }
            }, 'json');
        }
    });
    



    // Evento para el envío del formulario con imágenes
    $(document).on("submit", "#formA", function (e) {   
        e.preventDefault(); // Evita el envío normal del formulario
    
        var formData = new FormData(this);
    
        // Añadir imágenes seleccionadas al FormData solo si se han seleccionado imágenes
        var input = document.getElementById("imageFile");
        var len = input.files.length;
    
        // Solo validamos las imágenes si se seleccionaron
        if (len > 0) {
            for (var i = 0; i < len; i++) {
                var img = input.files[i];
        
                // Validar que sean archivos de imagen
                if (img.type.match(/image.*/)) {
                    formData.append("img_extra[]", img); // Agregar cada imagen al FormData
                } else {
                    alert("El archivo " + img.name + " no es una imagen válida.");
                    return; // Detenemos la ejecución si se detecta un archivo no válido
                }
            }
        }
    
        // Añadir el valor de 'ficha' al FormData
        formData.append("ficha", $("#buscar_ficha").val());
    
        // Enviar datos con AJAX
        $.ajax({
            url: "../../archivo/controlador/cargar.php", // URL de tu backend
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                console.log(data); // Ver lo que se devuelve antes de intentar parsearlo
                try {
                    if (typeof data === 'string') {
                        data = JSON.parse(data);
                    }
            
                    if (data.result === 0) {
                        alert("No se procesó correctamente.");
                    } else if (data.result === 1) {
                        alert(data.insertados + " Aprendices insertados y " + data.imagenes_subidas + " imágenes subidas correctamente.");
                    } else {
                        alert("Resultado inesperado.");
                    }
                } catch (error) {
                    // Muestra el error en la consola
                    console.error("Error al procesar la respuesta del servidor:", error);
                    
                    // Mostrar detalles del error al usuario
                    if (error.message) {
                        alert("Hubo un problema con la respuesta del servidor: " + error.message);
                    } else {
                        alert("Error desconocido: " + JSON.stringify(error));
                    }
                }
                
            },
            
        });
    });
    
});
