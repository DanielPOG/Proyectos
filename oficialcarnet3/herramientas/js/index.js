$(document).ready(function(){ 

    
	function cargarSelect(){  

        $.post("include/select.php", {
            action:'crgrTiposDoc'
            }, function(data){ 
                $("#tipoDocNewReg").html(data.lisTiposD);
            }, 'json');		
            

           
        $.post("include/select.php", {
            action:'crgrRh'
            }, function(data){ 
                $("#newRH").html(data.lisRh);
            }, 'json');		

        $.post("include/select.php", {
            action:'crgrDepto'
            }, function(data){ 
                $("#departamentosNewReg").html(data.listDepto);
            }, 'json');				
                    
        }
        
         $(document).on("change", "#deptoNewReg",function (){
            $.post("include/select.php", {
            action:'crgrMuni',
            deptoNewReg:$("#deptoNewReg").val()
            }, function(data){ 
                $("#municipioNewReg").html(data.listMuni); //codMuniFK
            }, 'json');	
        });	
    
        $(document).on("click", "#btnRegistrar",function (){
            
            
            $.post("include/ctrlindex.php", {
                action:'registrarUsuario',    

                nombreNewReg:$("#nombreNewReg").val(), 
                apellidoNewReg:$("#apellidoNewReg").val(), 
                clave:$("#clave").val(),
                numDocNewReg:$("#numDocNewReg").val(),
                tipoDocNewReg:$("#tipoDocNewReg").val(),
                telefonoNewReg:$("#telefonoNewReg").val(),
                direccionNewReg:$("#direccionNewReg").val(),
                correoNewReg:$("#correoNewReg").val(),
                deptoNewReg:$("#deptoNewReg").val(),
                municipioNewReg:$("#municipioNewReg").val(),

                fechaReg:$("#fechaReg").val()
                
    
    
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
                        
        $("#nombreNewReg").val("");
        $("#apellidoNewReg").val("");
        $("#clave").val("");
        $("#tipoDocNewReg").val("");
        $("#direccionNewReg").val("");
        $("#correoNewReg").val("");
        $("#telefonoNewReg").val("");
        $("#correo").val("");
        $("#deptoNewReg").val("");
        $("#municipioNewReg").val("");
        $("#numDocNewReg").val("");

        jQuery('#newUsuarioReg').trigger('click');
        }
        
    
    
    
        
        // $(document).on("click", "#btnEntrar",function (){
        //     $.post('include/ctrlindex.php',{
        //         action:'inicioSesion',
        //         correoLog:$("#correoLog").val(),
        //         claveLog:$("#claveLog").val()
        //     },function(data){
        //         if(data.rst=='1'){	
        //             Swal.fire({
                    
        //                 icon: "success",
        //                 title: "Entrando",
        //                 color:"#000000",
        //                 showConfirmButton: false,
        //                 timer: 2000,
        //                 backdrop: `
                        
        //                 url("https://www.gatode5patas.org/wp-content/uploads/2017/03/Nyan-cat.gif")
        //                 center top
        //                 no-repeat
        //                 `		
        //               });
        //             setTimeout(function() {
        //                 location.href = "menu.php";
        //             }, 2000); 
                    
        //             setTimeout();
                    
        //         }
        //         else{alert(data.msj)}
        
        //     },'json')
    
        //     });	
            
    
        cargarSelect();



});