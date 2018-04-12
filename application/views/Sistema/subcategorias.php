<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-9" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<?php if($dataUser['PsistemaA'] == "1"){ ?>
<div class="modal fade" id="addCatRiesgo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="sistema/Addsubcategorias" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Subcategoria</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="subcategoria"><span style="color:red;">* </span>Subcategoria</label>
                            <input type="text" class="form-control" name="subcategoria" id="subcategoria" placeholder="Subcategoria" required />
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
                
                <?php $messageSuccessUpdate = $this->session->flashdata('ExistSubcategoria'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-warning"><h3><?= $messageSuccessUpdate ?></h3></div>
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
                       <h2 style=" color: #24544b; font-weight: bold;">Subcategorias</h2>
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
                <th class="text-center">Subcategoria</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($subcategorias as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['subcategoria'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['PsistemaD'] == "1" AND $value['status'] == "0"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_cat<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                            <?php } ?>
                        </td>
                    </tr>  
                <?php if($dataUser['PsistemaD'] == "1" AND $value['status'] == "0"){ ?>
                    <div class="modal fade edit_catRiesgos" id="delete_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="cat_Riesgos">
                        <form action="sistema/Deletesubcategorias" method="POST">
                            <input type="hidden" name="ID" value="<?= $value['ID'] ?>" requery readonly/>
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h3 class="modal-title" id="tipoinmueble">Periodo: <?= $value['subcategoria'] ?></h3>
                                    </div>
                                    <div class="modal-body">
                                        <h4>¿Seguro que desea eliminar la subcategoria ?</h4>
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