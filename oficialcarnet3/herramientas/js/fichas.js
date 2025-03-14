$(document).ready(function(){ 

    
	function cargarSelect(){  	

        $.post("../../include/select.fichas.php", {
            action:'crgrDepto'
            }, function(data){ 
                $("#deptoFicha").html(data.listDepto);
            }, 'json');		
        
        $.post("../../include/select.fichas.php", {
            action:'crgrNomFicha'
            }, function(data){ 
                $("#selectFicha").html(data.listFicha);
            }, 'json');		
            
            $.post("../../include/select.fichas.php", {
                action:'crgrDepto'
                }, function(data){ 
                    $("#editardeptoFicha").html(data.listDepto);
                }, 'json');		
            
        
        }
        
        




         $(document).on("change", "#deptoFicha",function (){
            $.post("../../include/select.fichas.php", {
            action:'crgrMuni',
            deptoNewReg:$("#deptoFicha").val()
            }, function(data){ 
                $("#muniFicha").html(data.listMuni); //codMuniFK
            }, 'json');	
        });	

        $(document).on("change", "#editardeptoFicha",function (){
            $.post("../../include/select.fichas.php", {
            action:'crgrMuni',
            deptoNewReg:$("#editardeptoFicha").val()
            }, function(data){ 
                $("#editarmuniFicha").html(data.listMuni); //codMuniFK
            }, 'json');	
        });	


        $(document).ready(function () {
            // Cargar opciones del select al cargar la página
            $.post("../../archivo/controlador/ctrlficha.php", 
                { action: 'crgrNomFicha' }, 
                function (data) {
                    if (data.listFicha) {
                        $("#selectFicha").html(data.listFicha); // Llenar el <select> con opciones
                    } else {
                        console.error("Error al cargar las opciones:", data);
                    }
                }, 
                'json'
            );
        
            // Validar si se usa el input de texto o el select
            $(document).on("click", "#btnRegFicha", function () {
                let nuevoNombreFicha = $("#nomFicha").val().trim(); // Nombre ingresado manualmente
                let idFichaSeleccionada = $("#selectFicha").val(); // ID seleccionado del <select>
        
                // Validar que al menos uno de los campos esté lleno
                if (nuevoNombreFicha === "" && idFichaSeleccionada === "0") {
                    Swal.fire({
                        title: "Error",
                        text: "Debe ingresar un nombre o seleccionar uno existente.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                    return;
                }
        
                // Preparar los datos para enviar al servidor
                let dataToSend = {
                    action: 'registrarFicha',
                    fichacrear: $("#fichacrear").val(),
                    inicioFecha: $("#inicioFecha").val(),
                    finalFecha: $("#finalFecha").val(),
                    deptoFicha: $("#deptoFicha").val(),
                    muniFicha: $("#muniFicha").val(),
                    nomFicha: nuevoNombreFicha !== "" ? nuevoNombreFicha : null, // Enviar el nuevo nombre si existe
                    idFichaSeleccionada: idFichaSeleccionada !== "0" ? idFichaSeleccionada : null // Enviar el ID seleccionado si existe
                };
        
                // Enviar la solicitud al servidor
                $.post("../../archivo/controlador/ctrlficha.php", dataToSend, function (data) {
                    if (data.rspst == "1") {
                        Swal.fire({
                            title: "Éxito",
                            text: data.msj,
                            icon: "success",
                            confirmButtonText: "OK"
                        });
                        clear();
                    } else {
                        Swal.fire({
                            title: "Error",
                            text: data.msj,
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                }, 'json');
            });
        });
        


        $(document).on("click", "#btnEditarFicha",function (){
            
            
            $.post("../../archivo/controlador/ctrlficha.php", {
                action:'editarFicha',    

               
                editarFinalFecha:$("#editarFinalFecha").val(),
                deptoNewReg:$("#deptoNewReg").val(),
                municipioNewReg:$("#municipioNewReg").val(),
                
    
    
                }
                , function(data){ 
                   if(data.rspst==0 ){		 Swal.fire({
                    
                        title: "Error",
                        text: data.msj,
                        icon: "error",
                        width: 400,
                        
                        showConfirmButton: true,
                          confirmButtonText:'OK',
                        color:"#000000",
                        background: "#D3D3D3",
                        backdrop: `
                        
                        url("https://i.gifer.com/origin/9c/9c1e6fd886e3130d148b5100a979403f_w200.gif")
                        center top
                        no-repeat
                        `
                    });			} 
                    else 	{	 Swal.fire({
                        title: "Perfecto",
                        text: data.msj,
                        icon: "success",
                        color:"#000000",
                        
                        backdrop: `
                        
                        url("https://www.gatode5patas.org/wp-content/uploads/2017/03/Nyan-cat.gif")
                        center top
                        no-repeat
                        `					
                    }); clear();	}
                }, 'json');	
        });	

        function clear(){
                        
        $("#fichacrear").val("");
        $("#nomFicha").val("");
        $("#inicioFecha").val("");
        $("#finalFecha").val("");
        $("#deptoFicha").val("");
        $("#muniFicha").val("");

        jQuery('#alo').trigger('click');
        }
        cargarSelect();



});