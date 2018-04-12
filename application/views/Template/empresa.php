<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista66" ).last().addClass( "active" );
    $( "#lista66-2" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<section id="cat_riesgos">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageSuccessUpdate = $this->session->flashdata('UpdateBanner'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Informacion de empresa</h2>
                   </div>
               </div>
    
            </div>
            <div class="ibox-content">
    
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Mision</th>
                        <th class="text-center">Vision</th>
                        <th class="text-center">Historia</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <?php foreach ($info as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['mision'] ?></td>
                        <td class="text-center"><?= $value['vision'] ?></td>
                        <td class="text-center"><?= $value['objetivo'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['PsistemaE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_cat<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } ?>
                            
                        </td>
                    </tr> 
                    <?php if($dataUser['PsistemaE'] == "1"){ ?>    
                        <div class="modal fade" id="edit_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <form action="template/UpdateinfoEmpresa" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Informacion de la empresa</h4>
                                            <input type="hidden" readonly class="form-control" name="codigo" value="<?= $value['ID'] ?>" required />
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="" for="mision"><span style="color:red">* </span>Misión:</label>
                                                    <textarea class="form-control" id="mision" name="mision" required rows="3"><?= $value['mision'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="" for="vision"><span style="color:red">* </span>Visión: </label>
                                                    <textarea class="form-control" id="vision" name="vision" required rows="3"><?= $value['vision'] ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="" for="objetivo"><span style="color:red">* </span>Obejtivo: </label>
                                                    <textarea class="form-control" id="objetivo" name="objetivo" required rows="3"><?= $value['objetivo'] ?></textarea>
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
                    
                <?php } ?>
            </tbody>
            </table>
                </div>
    
            </div>
        </div>
    </div>
</section>