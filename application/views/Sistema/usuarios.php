<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-1" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<?php if($dataUser['PsistemaA'] == "1"){ ?>
<div class="modal fade" id="AddUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form action="panel/add_usuario" method="POST" id="usuariosAdd">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nuevo Usuario</h4>
                </div>
                <div class="modal-body" style="margin-bottom:70px;">
                    <!--campos de usuarios-->
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="usuario"><span style="color:red">* </span>Nombre de Usuario</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="" for="clave"><span style="color:red">* </span>Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" required />
                                    <div class="input-group-addon see-pass"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                </div>
                                <!--<div class="progress password-progress">-->
                                <!--    <div id="strengthBar" class="progress-bar" role="progressbar" style="width: 0;"></div>-->
                                <!--</div>-->
                            </div>
                        </div>
                        
                            <div class="clearfix"></div>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="correo"><span style="color:red">* </span>Correo Electronico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electronico" required />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="status"><span style="color:red">* </span>Status</label>
                                <select class="form-control" name="status" id="status" required>
                                    <option></option>
                                    <option value="1">Activo</option>
                                    <option value="0">Desactivado</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="" for="rol"><span style="color:red">* </span>Rol</label>
                                <select class="form-control" name="rol" id="rol" required>
                                    <option></option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Usuario">Usuario</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!--permisos-->
                    <div class="col-md-12" style="margin-bottom:15px;">
                        <div class="col-md-2 text-center">Modulos</div>
                        <div class="col-md-2 text-center">Acesso</div>
                        <div class="col-md-2 text-center sin-padding">Permiso de Agregar</div>
                        <div class="col-md-3 ">Permiso de Editar</div>
                        <div class="col-md-3 ">Permisos de Eliminar</div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Contribuyentes</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyente" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyente" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MContribuyenteD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Bienes</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MBienes" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MBienes" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MBienesA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MBienesA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MBienesE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MBienesE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MBienesD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MBienesD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Funcionamiento</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamiento" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamiento" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPFuncionamientoD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Rodaje</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPRodaje" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPRodaje" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPRodajeD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Construccion</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccion" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccion" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPContruccionD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Ocasional</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasional" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasional" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MPOcasionalD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                    <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                        <div class="col-md-2 text-center"><span style="color:red">* </span>Sistema</div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MSistema" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MSistema" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2">
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaA" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaA" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-2 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaE" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaE" value="0" required> No
                            </label>
                        </div>
                        <div class="col-md-3 text-right">
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaD" value="1" required> Si
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="MSistemaD" value="0" required> No
                            </label>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="reset" class="btn btn-warning">Limpiar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
        $(document).ready(function(){
            $('#usuariosAdd').formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    usuario: {
                        validators: {
                            notEmpty: {
                                message: 'El campo es requerido'
                            },
                            stringLength: {
                                min: 5,
                                max: 20,
                                message: 'El usuario debe tener un minimo de 7 caracteres y un maximo de 20'
                            }
                        }
                    },
                    status: {
                        validators: {
                            notEmpty: {
                                message: 'El campo es requerido'
                            }
                        }
                    },
                    rol: {
                        validators: {
                            notEmpty: {
                                message: 'El campo es requerido'
                            }
                        }
                    },
                    correo: {
                        validators: {
                            notEmpty: {
                                message: 'El campo es requerido'
                            },
                            emailAddress: {
                                message: 'No es un correo permitido'
                            }
                        }
                    },
                    clave: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            },
                            different: {
                                field: 'usuario',
                                message: 'La contraseña debe ser diferente al usuario'
                            },
                            stringLength: {
                                min: 6,
                                max: 30,
                                message: 'La contraseña debe tener un minimo de 10 caracteres y un maximo de 30'
                            }
                            // callback: {
                            //     callback: function(value, validator, $field) {
                            //         var password = $field.val();
                            //         if (password == '') {
                            //             return true;
                            //         }
                            //         var result  = zxcvbn(clave),
                            //             score   = result.score,
                            //             message = result.feedback.warning || 'La contraseña es debil';
                                        
                            //         var $bar = $('#strengthBar');
                            //         switch (score) {
                            //             case 0:
                            //                 $bar.attr('class', 'progress-bar progress-bar-danger')
                            //                     .css('width', '1%');
                            //                 break;
                            //             case 1:
                            //                 $bar.attr('class', 'progress-bar progress-bar-danger')
                            //                     .css('width', '25%');
                            //                 break;
                            //             case 2:
                            //                 $bar.attr('class', 'progress-bar progress-bar-danger')
                            //                     .css('width', '50%');
                            //                 break;
                            //             case 3:
                            //                 $bar.attr('class', 'progress-bar progress-bar-warning')
                            //                     .css('width', '75%');
                            //                 break;
                            //             case 4:
                            //                 $bar.attr('class', 'progress-bar progress-bar-success')
                            //                     .css('width', '100%');
                            //                 break;
                            //         }
                            //         if (score < 3) {
                            //             return {
                            //                 valid: false,
                            //                 message: message
                            //             }
                            //         }
                            //         return true;
                            //     }
                            // }
                        }
                    }
                }
            });
        });
        
    </script>
<?php } ?>
<section id="cat_riesgos">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageSuccessAdd = $this->session->flashdata('AddUsuario'); ?>
                <?php if($messageSuccessAdd){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessAdd ?></h3></div>
                <?php } ?>
                
                <?php $messageExistCorreo = $this->session->flashdata('ExistCorreo'); ?>
                <?php if($messageExistCorreo){ ?>
                    <div class="alert alert-warning"><h3><?= $messageExistCorreo ?></h3></div>
                <?php } ?>
                
                <?php $messageExistUsuario = $this->session->flashdata('ExistUsuario'); ?>
                <?php if($messageExistUsuario){ ?>
                    <div class="alert alert-danger"><h3><?= $messageExistUsuario ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessUpdate = $this->session->flashdata('UpdateUsuario'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessDelete = $this->session->flashdata('deleteUsuario'); ?>
                <?php if($messageSuccessDelete){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessDelete ?></h3></div>
                <?php } ?>
                
                
               <div class="col-xs-12">
                   <div class="col-md-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Usuarios</h2>
                   </div>
                   <?php if($dataUser['PsistemaA'] == "1"){ ?>
                   <div class="col-md-6">
                       <button type="button" class="btn btn-primary pull-right" data-toggle="modal"  data-target="#AddUsuario">Agregar Usuario</button>
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
                <th class="text-center">Nombre de Usuario</th>
                <th class="text-center">Coreo</th>
                <th class="text-center">Status</th>
                <th class="text-center">Rol</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['usuario'] ?></td>
                        <td class="text-center"><?= $value['correo'] ?></td>
                        <td class="text-center">
                            <?php if($value['activo'] == "1"){ ?>
                                <span class="label label-success">Activo</span>
                            <?php } ?>
                            <?php if($value['activo'] == "0"){ ?>
                                <span class="label label-danger">Desactivado</span>
                            <?php } ?>
                        </td>
                        <td class="text-center"><?= $value['rol'] ?></td>
                        <td class="text-center">
                        <?php if($dataUser['PsistemaE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#editUsuaario<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                        <?php } ?>
                        <?php if($dataUser['PsistemaD'] == "1"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#deleteUsuario<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                        <?php } ?>
                        </td>
                    </tr>  
                    <?php if($dataUser['PsistemaE'] == "1"){ ?>
                    <div class="modal fade" id="editUsuaario<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="editUsuaario<?= $key ?>">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="panel/Update_usuario" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 class="modal-title" id="editUsuaario<?= $key ?>">Editar Usuario: <strong><?= $value['usuario'] ?></strong></h3>
                                    </div>
                                    <div class="modal-body" style="margin-bottom:70px;">
                                        <!--campos de usuarios-->
                                    <input type="hidden" readonly class="form-control" name="token" value="<?= $value['token'] ?>" />
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="" for="usuario">Nombre de Usuario</label>
                                                    <input type="text" readonly class="form-control" id="usuario" placeholder="Nombre de Usuario" value="<?= $value['usuario'] ?>" disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <?php $pass= $value['clave']; $clave = $this->encrypt->decode($pass); ?>
                                                    <label class="" for="clave">Contraseña</label>
                                                    <div class="input-group">
                                                        <input type="password" class="form-control" id="clave" name="clave" placeholder="Contraseña" value="<?= $clave ?>" required />
                                                        <div class="input-group-addon see-pass"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                                <div class="clearfix"></div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="" for="correo">Correo Electronico</label>
                                                    <input type="email" readonly class="form-control" id="correo" name="correo" placeholder="Correo Electronico"  disabled/>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="" for="status"><span style="color:red">* </span>Status</label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <?php if($value['activo'] == "1"){ ?>
                                                            <option value="1">Activo</option>
                                                            <option value="0">Desactivado</option>
                                                        <?php } ?>
                                                        <?php if($value['activo'] == "0"){ ?>
                                                            <option value="0">Desactivado</option>
                                                            <option value="1">Activo</option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="" for="rol"><span style="color:red">* </span>Rol</label>
                                                    <select class="form-control" name="rol" id="rol" required>
                                                        <?php if($value['rol'] == "Administrador"){ ?>
                                                            <option value="Administrador">Administrador</option>
                                                            <option value="Usuario">Usuario</option>
                                                        <?php } ?>
                                                        <?php if($value['rol'] == "Usuario"){ ?>
                                                            <option value="Usuario">Usuario</option>
                                                            <option value="Administrador">Administrador</option>
                                                        <?php } ?>
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <!--permisos-->
                                        <div class="col-md-12" style="margin-bottom:15px;">
                                            <div class="col-md-2 text-center">Modulos</div>
                                            <div class="col-md-2 text-center">Acesso</div>
                                            <div class="col-md-2 text-center sin-padding">Permiso de Agregar</div>
                                            <div class="col-md-3 ">Permiso de Editar</div>
                                            <div class="col-md-3 ">Permisos de Eliminar</div>
                                        </div>
                                        <?php $accesos = $this->universal->query('SELECT * FROM accesos WHERE token = "'.$value["token"].'" '); ?>
                                        
                                        <!--rejilla de contribuyentes-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Contribuyentes</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MContribuyente'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyente" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyente" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MContribuyente'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyente" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyente" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MContribuyenteA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MContribuyenteA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteA" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MContribuyenteE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MContribuyenteE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MContribuyenteD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MContribuyenteD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteD" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MContribuyenteD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de bienes-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Bienes</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MBienes'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienes" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienes" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MBienes'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienes" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienes" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MBienesA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MBienesA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesA" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MBienesE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MBienesE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MBienesD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MBienesD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesD" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MBienesD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de permiso de funcionamiento-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Funcionamiento</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPFuncionamiento'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamiento" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamiento" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPFuncionamiento'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamiento" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamiento" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPFuncionamientoA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPFuncionamientoA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoA" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MPFuncionamientoE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPFuncionamientoE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MPFuncionamientoD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPFuncionamientoD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoD" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPFuncionamientoD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de permiso de rodaje-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Rodaje</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPRodaje'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodaje" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodaje" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPRodaje'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodaje" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodaje" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPRodajeA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPRodajeA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeA" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MPRodajeE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPRodajeE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MPRodajeD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPRodajeD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeD" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPRodajeD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de permiso de construccion-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Construccion</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPContruccion'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccion" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccion" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPContruccion'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccion" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccion" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPContruccionA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPContruccionA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionA" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MPContruccionE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPContruccionE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MPContruccionD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPContruccionD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionD" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPContruccionD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de permiso ocasional-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Permiso Ocasional</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPOcasional'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasional" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasional" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPOcasional'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasional" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasional" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MPOcasionalA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPOcasionalA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalA" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MPOcasionalE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPOcasionalE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalE" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MPOcasionalD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MPOcasionalD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalD" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MPOcasionalD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                        <!--rejilla de permiso de sistema-->
                                        <div class="col-md-12" style="margin-bottom:30px; border-bottom: 1px solid;">
                                            <div class="col-md-2 text-center"><span style="color:red">* </span>Sistema</div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MSistema'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistema" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistema" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MSistema'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistema" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistema" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php if($accesos[0]['MSistemaA'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaA" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaA" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MSistemaA'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaA" value="1" required > Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaA" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-2 text-right">
                                                <?php if($accesos[0]['MSistemaE'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaE" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaE" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MSistemaE'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaE" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaE" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-3 text-right">
                                                <?php if($accesos[0]['MSistemaD'] == "1"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaD" value="1" required checked> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaD" value="0" required> No
                                                    </label>
                                                <?php } ?>
                                                <?php if($accesos[0]['MSistemaD'] == "0"){ ?>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaD" value="1" required> Si
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="MSistemaD" value="0" required checked> No
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                        <button type="reset" class="btn btn-warning">Limpiar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($dataUser['PsistemaD'] == "1"){ ?>
                    <div class="modal fade" id="deleteUsuario<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="deleteUsuario<?= $key ?>">
                        <div class="modal-dialog" role="document">
                            <form action="panel/Delete_usuario" method="POST">
                                <input type="hidden" name="token" value="<?= $value['token'] ?>" readonly />
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="deleteUsuario<?= $key ?>">Borrar Usuario: <strong><?= $value['usuario'] ?></strong></h4>
                                    </div>
                                    <div class="modal-body">
                                        ¿Seguro desea Borrar el usuario: <strong><?= $value['usuario'] ?></strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-info">Borrar</button>
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