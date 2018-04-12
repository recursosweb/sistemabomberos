<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-2" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<?php if($dataUser['PsistemaA'] == "1"){ ?>
<div class="modal fade" id="addCatRiesgo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="sistema/addCat_Riesgo" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Categoria</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre_comercial">Nombre de la Categoria</label>
                                <input type="text" class="form-control" name="nombreCate" id="nombreCate" placeholder="Nombre de la Categoria" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cata">Permiso</label>
                                <select name="codigoPermiso" id="" class="form-control">
                                    <option></option>
                                    <?php foreach ($permisos as $keyP => $valueP) { ?>
                                        <option value="<?= $valueP['ID'] ?>"><?= $valueP['permiso'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
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
                
                <?php $messageSuccessUpdate = $this->session->flashdata('UpdateCat_Riesgos'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessAdd = $this->session->flashdata('AddCat_Riesgos'); ?>
                <?php if($messageSuccessAdd){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessAdd ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessDele = $this->session->flashdata('deleteCat_Riesgos'); ?>
                <?php if($messageSuccessDele){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessDele ?></h3></div>
                <?php } ?>
                
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Categorias</h2>
                   </div>
                   <?php if($dataUser['PsistemaA'] == "1"){ ?>
                       <div class="col-xs-6 col-sm-6">
                            <button class="btn btn-info pull-right" data-toggle="modal" data-target="#addCatRiesgo">Nuevo</button>
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
                <th class="text-center">ID de Permiso</th>
                <th class="text-center">ID Categoria</th>
                <th class="text-center">Nombre Comercial</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($Cat_riesgos as $key => $value){ $key = $key + 1;?>
                    <tr>
                        <td class="text-center"><?= $key ?></td>
                        <td class="text-center"><?= $value['id_permiso'] ?></td>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['nombre_comercial'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['PsistemaE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_cat<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } ?>
                            <?php if($dataUser['PsistemaD'] == "1"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_cat<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                            <?php } ?>
                        </td>
                    </tr>  
                <?php if($dataUser['PsistemaE'] == "1"){ ?>    
                    <div class="modal fade edit_catRiesgos" id="edit_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="cat_Riesgos">
                        <form action="sistema/update_catRiesgo" method="POST">
                            <input type="hidden" name="codigo_cat" value="<?= $value['ID'] ?>" requery readonly/>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="cat_Riesgos">Categoria: <?= $value['ID'] ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="nombre_comercial">Nombre de la Categoria</label>
                                                    <input type="text" class="form-control" disabled placeholder="Nombre de la Categoria" required />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cata">Permiso</label>
                                                    <select name="codigoPermiso" id="" class="form-control">
                                                    <?php $data = $this->universal->query('SELECT * FROM código_permisos WHERE ID = "'.$value['id_permiso'].'" '); ?>
                                                        <option value="<?= $data[0]['ID'] ?>"><?= $data[0]['permiso'] ?></option>
                                                        <?php foreach ($permisos as $keyP => $valueP) { ?>
                                                            <option value="<?= $valueP['ID'] ?>"><?= $valueP['permiso'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if($dataUser['PsistemaD'] == "1"){ ?>
                    <div class="modal fade edit_catRiesgos" id="delete_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="cat_Riesgos">
                        <form action="sistema/delete_catRiesgo" method="POST">
                            <input type="hidden" name="codigo_cat" value="<?= $value['ID'] ?>" requery readonly/>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 class="modal-title" id="cat_Riesgos">Categoria: <?= $value['ID'] ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <h4>¿Seguro que desea eliminar la categoria: <?= $value['nombre_comercial'] ?> ?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-warning">Borrar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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