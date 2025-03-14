$(document).ready(function(){

	$(document).on("click", "#btnCodigo", function () {
		$.post('archivo/controlador/mail.php', {
			action: 'mandarcod',
			correo1: $("#correo1").val(),
		}, function(data){ 
			if(data.rspst==0){		 Swal.fire({
			
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
			else	{	
				// Para abrir el modal
				$("#emailSuccessModal").modal("show");
			}
		},  'json');	
	});

	$(document).on("click", "#btnVerificar", function () {
		$.post('archivo/controlador/mail.php', {
			action: 'verificarCod',
			codigo: $("#codigo").val(),
			correo1: $("#correo1").val(),

		}, function(data){ 
			if(data.rspst==0){		 Swal.fire({
			
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
			});	}
			else if(data.rspst=='1')	{	
					$("#crearClave").modal("show");
					// Para ocultar el modal
					$("#emailSuccessModal").modal("hide");
			}
			else if(data.rspst=='2')	{	
				// Para abrir el modal
				$("#entrar").modal("show");
				// Para ocultar el modal
				$("#emailSuccessModal").modal("hide");

			}else{
				alert("Errror")
			}
		}, 'json');	
	});


	$(document).on("click", "#btnEntrarPagina", function () {
		$.post('archivo/controlador/mail.php', {
			action: 'verificarClave',
			clave1: $("#clave1").val(),
			correo1: $("#correo1").val(),
		}, function(data) { 
			if(data.rspst == 0) {         
				Swal.fire({
					title: "Error",
					text: data.msj,
					icon: "error",
					width: 400,
					showConfirmButton: true,
					confirmButtonText: 'OK',
					color: "#000000",
					background: "#D3D3D3",
					backdrop: `
						url("https://i.gifer.com/origin/9c/9c1e6fd886e3130d148b5100a979403f_w200.gif")
						center top
						no-repeat
					`
				});
			} else if (data.rspst == 1) {
				Swal.fire({
					icon: "success",
					title: "Entrando",
					color: "#000000",
					showConfirmButton: false,
					timer: 2000,
					backdrop: `
						url("https://www.gatode5patas.org/wp-content/uploads/2017/03/Nyan-cat.gif")
						center top
						no-repeat
					`        
				});
	
				setTimeout(function() {
					location.href = "menub/aprendiz1.php";  // Redirige a menu.php

				}, 2000);
				
	
				$("#entrar").modal("hide");
			}
			else if (data.rspst == 2) {
				Swal.fire({
					icon: "success",
					title: "Entrando",
					color: "#000000",
					showConfirmButton: false,
					timer: 2000,
					backdrop: `
						url("https://www.gatode5patas.org/wp-content/uploads/2017/03/Nyan-cat.gif")
						center top
						no-repeat
					`        
				});
	
				setTimeout(function() {
					location.href = "menub/instructor.php";  // Redirige a menu.php

				}, 2000);
				
	
				$("#entrar").modal("hide");
			}
			else if (data.rspst == 3) {
				Swal.fire({
					icon: "success",
					title: "Entrando",
					color: "#000000",
					showConfirmButton: false,
					timer: 2000,
					backdrop: `
						url("https://www.gatode5patas.org/wp-content/uploads/2017/03/Nyan-cat.gif")
						center top
						no-repeat
					`        
				});
	
				setTimeout(function() {
					location.href = "menub/admin.php";  // Redirige a menu.php

				}, 2000);
				
	
				$("#entrar").modal("hide");
			}
		}, 'json');
	});
	
	
	$(document).on("click", "#btnCrearClave", function () {
		$.post('archivo/controlador/mail.php', {
			action: 'crearClave',
			claveNew: $("#claveNew").val(),
			claveNew1: $("#claveNew1").val(),
			correo1: $("#correo1").val(),
			newRH: $("#newRH").val(),

		}, function(data){ 
			if(data.rspst==='0'){		 Swal.fire({
			
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
			else	{
				location.reload(); // Refresca la página
				clear();
		} 
			}, 'json');	
	});

	function clear(){
		$("#claveNew").val("");
		$("#claveNew1").val("");
		$("#correo1").val("");
		$("#clave1").val("");
		$("#codigo").val("");
		

        }






		
		

		

	
	

});

