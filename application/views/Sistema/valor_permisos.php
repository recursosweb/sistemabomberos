<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-3" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>

<?php if($dataUser['PsistemaA']){ ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form action="sistema/addGestionValores" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Gestion de valor</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Periodo</label>
                            <select class="form-control" name="periodo" required>
                                <option></option>
                                <?php foreach ($periodos as $keyP => $valueP) { ?>
                                    <option value="<?= $valueP['ID'] ?>|<?= $valueP['periodo'] ?>"><?= $valueP['periodo'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Categoria</label>
                            <select class="form-control" name="categoria" required >
                                <option></option>
                                <?php foreach ($categoria_riesgo as $keyCA => $valueCA) { ?>
                                    <option value="<?= $valueCA['ID'] ?>|<?= $valueCA['nombre_comercial'] ?>"><?= $valueCA['nombre_comercial'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Permiso</label>
                            <select class="form-control"  name="permiso" required >
                                <option></option>
                                <?php foreach ($código_permisos as $keyCP => $valueCP) { ?>
                                    <option value="<?= $valueCP['ID'] ?>|<?= $valueCP['permiso'] ?>"><?= $valueCP['permiso'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="fecha_vencimiento"><span style="color:red">* </span>SubCategoria</label>
                            <select class="form-control" name="subcategoria" required >
                                <option></option>
                                <?php foreach ($subcategoria as $keySuB => $valueSuB) { ?>
                                    <option value="<?= $valueSuB['ID'] ?>|<?= $valueSuB['subcategoria'] ?>"><?= $valueSuB['subcategoria'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Valor</label>
                            <input type="number" min="0" class="form-control" name="valor" required >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>


<section id="cat_riesgos">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">

                <?php $messageExistGestion = $this->session->flashdata('ExistGestion'); ?>
                <?php if($messageExistGestion){ ?>
                    <div class="alert alert-warning"><h3><?= $messageExistGestion ?></h3></div>
                <?php } ?>

                <?php $messageSuccessAdd = $this->session->flashdata('Success'); ?>
                <?php if($messageSuccessAdd){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessAdd ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessUpdate = $this->session->flashdata('SuccessUpdate'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>

                <?php $messageSuccessDelete = $this->session->flashdata('deleteCat_Riesgos'); ?>
                <?php if($messageSuccessDelete){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessDelete ?></h3></div>
                <?php } ?>
                
                
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Gestión de valores</h2>
                   </div>
                   <div class="col-xs-6 col-sm-6">
                       <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Nuevo</button>
                   </div>
               </div>
    
            </div>
            <div class="ibox-content">
    
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Periodo</th>
                <th class="text-center">Permiso</th>
                <th class="text-center">Categoria</th>
                <th class="text-center">Subcategoria</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($valorPermisos as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['periodo'] ?></td>
                        <td class="text-center"><?= $value['permiso'] ?></td>
                        <td class="text-center"><?= $value['categoria'] ?></td>
                        <td class="text-center"><?= $value['subcategoria'] ?></td>
                        <td class="text-center"><?= $value['valor'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['PsistemaE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#EditValor<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } ?>
                            <?php if($dataUser['PsistemaD'] == "1" and $value['status'] == "0"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal" data-target="#Delete<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-trash"></i></button>
                            <?php } ?>
                        </td>
                    </tr>  
                    <?php if($dataUser['PsistemaE'] == "1"){ ?>
                    <div class="modal fade" id="EditValor<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <form action="sistema/UpdateGestionValores" method="POST">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Nueva Gestion de valor</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Periodo</label>
                                                <input type="text" class="form-control" value="<?= $value['periodo'] ?>" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Categoria</label>
                                                <input type="text" class="form-control" value="<?= $value['categoria'] ?>" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Permiso</label>
                                                <input type="text" class="form-control" value="<?= $value['permiso'] ?>" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="fecha_vencimiento"><span style="color:red">* </span>SubCategoria</label>
                                                <input type="text" class="form-control" value="<?= $value['subcategoria'] ?>" required disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="" for="fecha_vencimiento"><span style="color:red">* </span>Valor</label>
                                                <input type="number" min="0" class="form-control" name="valor" value="<?= $value['valor'] ?>" required >
                                                <input type="hidden"  class="form-control" name="id_valor" value="<?= $value['ID'] ?>" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>

                        <div class="modal fade" id="Delete<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                          <div class="modal-dialog" role="document">
                              <form action="sistema/DeleteGestionValores" method="POST">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Borrar gestion de valores</h4>
                                      </div>
                                      <div class="modal-body">
                                        ¿Seguro desea Borrar esta gestion de valor? 
                                        <input type="hidden"  class="form-control" name="id_valor" value="<?= $value['ID'] ?>" required >
                                        <input type="hidden">
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Borrar</button>
                                      </div>
                                    </div>
                                </form>
                          </div>
                        </div>
        

                <?php } ?>
            </tbody>
            </table>
                </div>
    
            </div>
        </div>
    </div>
</section>