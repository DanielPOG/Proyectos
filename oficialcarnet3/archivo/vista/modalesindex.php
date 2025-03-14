<?php 
date_default_timezone_set('America/Bogota');
$fecha= date("Y-m-d");

?>
    <!-- INICIO MODAL Registro -->
    <div class="modal fade" id="newUsuarioReg" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="nombreNewReg" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombreNewReg" name="nombreNewReg">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="apellidoNewReg" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellidoNewReg" name="apellidoNewReg" >
                    </div>
                   
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="clave" class="form-label">Password</label>
                        <input type="password" class="form-control" id="clave">
                    </div>
                    <div class="col-6 mb-3">
                        <label for="numDocNewReg" class="form-label">Numero documento</label>
                        <input type="number" class="form-control" id="numDocNewReg" name="numDocNewReg" >
                    </div>
                   
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="tipoDocNewReg" class="form-label">Tipo Documento</label>
                        <div class="input-group-prepend" >
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <select name="tipoDocNewReg" id="tipoDocNewReg" style="cursor: pointer;" class="custom-select"></select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="telefonoNewReg" class="form-label">Telefono</label>
                        <input type="number" class="form-control" id="telefonoNewReg" name="telefonoNewReg" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="direccionNewReg" class="form-label">Direccion</label>

                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-envelope-open" aria-hidden="true"></i></span>
                            <textarea name="direccionNewReg" id="direccionNewReg"  placeholder="Direccion Residencia " class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="correoNewReg" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correoNewReg" name="correoNewReg" >
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6 mb-3">
                        <label for="deptoNewReg" class="form-label">Departamento</label>
                        <div class="input-group-prepend" >
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <select name="deptoNewReg" id="deptoNewReg" style="cursor: pointer;" class="custom-select"></select>
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="municipioNewReg" class="form-label">Municipio</label>
                        <div class="input-group-prepend" >
                            <span class="input-group-text"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                            <select name="municipioNewReg" id="municipioNewReg" style="cursor: pointer;" class="custom-select"></select>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
             
                    <label for="fechaReg" class="form-label">Fecha</label>
                    <input type="text" class="form-control" id="fechaReg" name="fechaReg" value="<?php echo $fecha;?>" readonly>
                </div>

            </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="btnRegistrar" name="btnRegistrar">Registrar</button>
            </div>
            </div>
        </div>
    </div>

    <!-- FIN MODAL Registro-->

    
    <!-- Modal Codigo de Verificacion-->
    <div class="modal fade" id="emailSuccessModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese codigo</h5>
                    <button type="button" id='btnSalirya' name='btnSalirya' class="close" data-bs-dismiss="modal">X</button>
                        
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Codigo de verificacion" name="codigo"  id="codigo">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnVerificar" class='btn btn-dark cursor:pointer;' name="btnVerificar">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CIERRRE MODAL Codigo de Verificacion  -->
    
    <!-- Modal Entrar-->
    <div class="modal fade" id="entrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ingrese clave</h5>
                    <button type="button" id='btnSalirya' name='btnSalirya' class="close" data-bs-dismiss="modal">X</button>
                        
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" placeholder="Clave" name="clave1"  id="clave1">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnEntrarPagina" class='btn btn-dark cursor:pointer;' name="btnEntrarPagina">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- CIERRRE entrar -->

    <!-- Modal crear clave -->
    <div class="modal fade" id="crearClave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Clave</h5>
                    <button type="button" id='btnSalirya' name='btnSalirya' class="close" data-bs-dismiss="modal">X</button>
                        
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row mt-3">
                        <div class="col-12 ">
                            <h6 class="mb-2">Clave</h6>
                            <input type="text" class="form-control" placeholder="Clave" name="claveNew" id="claveNew">
                        </div>
                    </div>
                    <br>
                    <div class="row mt-3">
                        <div class="col-12 ">
                            <h6 class="mb-2">Repita Clave</h6>
                            <input type="text" class="form-control" placeholder="Repita la Clave" name="claveNew1" id="claveNew1">
                        </div>
                    </div>
                    <br>
                    <div class="row mt-3">
                        <div class="col-12 ">
                            <h6 class="mb-2">Rh</h6>
                            <select class="form-control" name="newRh" id="newRH"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="btnCrearClave" class='btn btn-dark cursor:pointer;' name="btnCrearClave">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Cerrrar crear clave --

