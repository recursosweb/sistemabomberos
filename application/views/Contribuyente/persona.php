<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista0" ).last().addClass( "active" );
    $( "#lista1-2" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<section id="personas" class="">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageInvalidCedu = $this->session->flashdata('ErrorCedula'); ?>
                <?php if($messageInvalidCedu){ ?>
                    <div class="alert alert-warning"><h3><?= $messageInvalidCedu ?></h3></div>
                <?php } ?>
                
                <?php $messageExitCedu = $this->session->flashdata('ErrorCedulaExit'); ?>
                <?php if($messageExitCedu){ ?>
                    <div class="alert alert-danger"><h3><?= $messageExitCedu ?></h3></div>
                <?php } ?>
                
                <?php $messageExitCorreo = $this->session->flashdata('ErrorCorreoExit'); ?>
                <?php if($messageExitCorreo){ ?>
                    <div class="alert alert-danger"><h3><?= $messageExitCorreo ?></h3></div>
                <?php } ?>
                
                <?php $messageAddPersona= $this->session->flashdata('AddPersona'); ?>
                <?php if($messageAddPersona){ ?>
                    <div class="alert alert-success"><h3><?= $messageAddPersona ?></h3></div>
                <?php } ?>
                
                <?php $messageUpdatePersona= $this->session->flashdata('UpdatePersona'); ?>
                <?php if($messageUpdatePersona){ ?>
                    <div class="alert alert-success"><h3><?= $messageUpdatePersona ?></h3></div>
                <?php } ?>
                
                <?php $messageDeletePersona= $this->session->flashdata('deletePersona'); ?>
                <?php if($messageDeletePersona){ ?>
                    <div class="alert alert-success"><h3><?= $messageDeletePersona ?></h3></div>
                <?php } ?>
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Personas</h2>
                   </div>
                   <?php if($dataUser['contribuyenteA'] == "1"){ ?>
                       <div class="col-xs-6 col-sm-6">
                            <button class="btn btn-info pull-right" id="nuevaPersona">Nuevo</button>
                       </div>
                    <?php } ?>
               </div>
    
            </div>
            <div class="ibox-content">
    
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Cedula</th>
                <th class="text-center">Nombres</th>
                <th class="text-center">Apellidos</th>
                <th class="text-center">Sexo</th>
                <th class="text-center">Telefono</th>
                <th class="text-center">Correo</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($persona as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['cedula'] ?></td>
                        <td class="text-center"><?= $value['nombres'] ?></td>
                        <td class="text-center"><?= $value['apellidos'] ?></td>
                        <td class="text-center"><?= $value['sexo'] ?></td>
                        <td class="text-center"><?= $value['telefono'] ?></td>
                        <td class="text-center"><?= $value['correo'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['contribuyenteE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_persona<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } ?>
                            <?php if($dataUser['contribuyenteD'] == "1"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_persona<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                            <?php } ?>
                        </td>
                    </tr>  
                            <?php if($dataUser['contribuyenteE'] == "1"){ ?>
                            <div class="modal fade" id="edit_persona<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="contribuyente/update_persona" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div class="col-md-12 contentAddPersona">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="cedula"><span style="color:red">* </span>Cedula</label>
                                                            <input type="text" class="form-control" value="<?= $value['cedula'] ?>" readonly id="cedula" name="cedula" placeholder="Cedula" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="nombre"><span style="color:red">* </span>Nombre</label>
                                                            <input type="text" class="form-control" value="<?= $value['nombres'] ?>" id="nombre" name="nombre" placeholder="Nombre" required />
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="clearfix"></div>
                                                        
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="apellido"><span style="color:red">* </span>Apellidos</label>
                                                            <input type="text" class="form-control" value="<?= $value['apellidos'] ?>" id="apellido" name="apellido" placeholder="Apellido" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="sexo"><span style="color:red">* </span>Sexo</label>
                                                                <select class="form-control" name="sexo" id="sexo" required>
                                                                    <?php if($value['sexo'] == "M"){ ?>
                                                                        <option value="M">Masculino</option>
                                                                        <option value="F">Femenino</option>
                                                                    <?php } ?>
                                                                    
                                                                    <?php if($value['sexo'] == "F"){ ?>
                                                                        <option value="F">Femenino</option>
                                                                        <option value="M">Masculino</option>
                                                                    <?php } ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                        
                                                        <div class="clearfix"></div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="correo"><span style="color:red">* </span>Correo</label>
                                                            <input type="email" class="form-control" value="<?= $value['correo'] ?>" id="correo" name="correo" placeholder="Correo" required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="telefono"><span style="color:red">* </span>Telefono</label>
                                                            <input type="text" data-mask="(999) 999-9999" class="form-control" value="<?= $value['telefono'] ?>" id="telefono" name="telefono" placeholder="Telefono" required />
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="clearfix"></div>
                                                        
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="" for="direccion"><span style="color:red">* </span>Direccion</label>
                                                            <textarea class="form-control" id="direccion" name="direccion" required rows="3"><?= $value['direccion'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-success pull-right">Guardar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if($dataUser['contribuyenteD'] == "1"){ ?>
                            <div class="modal fade" id="delete_persona<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="contribuyente/delete_persona" method="POST">
                                        <input type="hidden" readonly name="cedula" value="<?= $value['cedula'] ?>" required />
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Persona: <?= $value['cedula'] ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                ¿Seguro de Eliminar a la persona:  <?= $value['cedula'] ?>? 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php } ?>
                <?php } ?>
            </tbody>
            </table>
                </div>
    
            </div>
        </div>
    </div>
</section>

<?php if($dataUser['contribuyenteA'] == "1"){ ?>
<section id="add_persona">
    <div class="col-md-12">
        <h2 class="titleADD">Agregar Nueva Persona</h2>
    </div>
        <div class="clearfix"></div>
    
    <div class="col-md-12 contentAddPersona">
        <form action="contribuyente/add_persona" id="contribuyentePersona" method="POST">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="cedula"><span style="color:red">* </span>Cedula</label>
                    <input type="number" min="10" class="form-control" id="cedula" name="cedula" placeholder="Cedula" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="nombre"><span style="color:red">* </span>Nombre</label>
                    <input type="text" class="form-control texto" id="nombre" name="nombre" placeholder="Nombre" required />
                </div>
            </div>
            
                <div class="clearfix"></div>
                
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="apellido"><span style="color:red">* </span>Apellidos</label>
                    <input type="text" class="form-control texto" id="apellido" name="apellido" placeholder="Apellido" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="sexo"><span style="color:red">* </span>Sexo</label>
                        <select class="form-control" name="sexo" id="sexo" required>
                            <option></option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                </div>
            </div>
                
                <div class="clearfix"></div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="correo"><span style="color:red">* </span>Correo</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="" for="telefono"><span style="color:red">* </span>Telefono</label>
                    <input type="number" min="9" class="form-control" id="telefono" name="telefono" placeholder="Telefono" required />
                </div>
            </div>
            <!--data-mask="(999) 999-9999"-->
                <div class="clearfix"></div>
                
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="direccion"><span style="color:red">* </span>Direccion</label>
                    <textarea class="form-control" id="direccion" name="direccion" required rows="3"></textarea>
                </div>
            </div>
            
            <div class="col-md-12">
                <button type="reset" class="btn btn-danger" id="CloseAddPersona">Cerrar</button>
                <button type="submit" class="btn btn-success pull-right">Guardar</button>
            </div>
            
        </form>
    </div>
    
    <script>
    	$(document).ready(function() {
    		$(".texto").keypress(function (key) {
	            window.console.log(key.charCode)
	            if ((key.charCode < 97 || key.charCode > 122)//letras mayusculas
	                && (key.charCode < 65 || key.charCode > 90) //letras minusculas
	                && (key.charCode != 45) //retroceso
	                && (key.charCode != 241) //ñ
	                 && (key.charCode != 209) //Ñ
	                 && (key.charCode != 32) //espacio
	                 && (key.charCode != 225) //á
	                 && (key.charCode != 233) //é
	                 && (key.charCode != 237) //í
	                 && (key.charCode != 243) //ó
	                 && (key.charCode != 250) //ú
	                 && (key.charCode != 193) //Á
	                 && (key.charCode != 201) //É
	                 && (key.charCode != 205) //Í
	                 && (key.charCode != 211) //Ó
	                 && (key.charCode != 218) //Ú
	 
	                )
	                return false;
	        });
    	});
    </script>
    
</section>
<?php } ?>
