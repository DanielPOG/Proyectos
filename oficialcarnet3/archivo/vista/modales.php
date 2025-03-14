<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
 <!-- INICIO MODAL Actualizar -->
 <div class="modal fade" id="actualizarcons" name="actualizarcons">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- cabecera del diálogo -->
						<div class="modal-header">
							<h6 class="modal-title">Actualizar</h6>
							<button type="button" id='btnSalirya' name='btnSalirya' class="close" data-bs-dismiss="modal">X</button>
						</div>
						<!-- cuerpo del body o del modal -->
                        <div class="modal-body modal-body-scroll"> <!--MODAL DE SCROLL-->
                            <div style="margin-bottom:8px" class="input-group">
                                <div class="modal-body">
                                    <div class="col-10">
                                
                                        <div class="row mt-1">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text" id="fechaHoy" name="fechaHoy" class="form-control" value="<?php echo $fecha; ?>" readonly/>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text" class="form-control" placeholder="Codigo de Construccion" id="codAct" name="codAct" title="Codigo de Construccion" style="cursor: pointer;">
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                       
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                                </div>
                                                <input type="text"  placeholder="Presupuesto" class="form-control" id="presupuestoAct" name="presupuestoAct" title="Presupuesto" style="cursor: pointer;">
                                            </div>
                                           
                                        </div> 
                                        <div class="row mt-1">
                                                <div class="input-group mb-3">
                                                  <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                                                  </div>
                                                  <input type="date"  placeholder="Fecha Construccion" class="form-control" id="fechaAct" name="fechaAct" title="Fecha Construccion" style="cursor: pointer;">
                                                <input type="hidden" name="id_construccion" id="id_construccion">
                                                </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            </div>		
                        </div>			
						<!-- pie del modal Actualizar-->
						<div class="modal-footer">
							<button type="button" id="btnactualizar" class='btn btn-dark cursor:pointer;' name="btnactualizar"  >Actualizar</button>
						</div>
					</div>
				</div>
			</div>
			

     <!-- FIN MODAL Actualizar-->