<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista66" ).last().addClass( "active" );
    $( "#lista66-3" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<?php if($dataUser['PsistemaA'] == "1"){ ?>
<div class="modal fade" id="addCatRiesgo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <form action="template/addNoticia" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nueva Noticia</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input type="text" class="form-control" name="titulo" id="titulo" placeholder="Titulo" required />
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" rows="5" id="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <span class="btn btn-info btn-file">
                                Agregar Imagen <input required type="file" name="imagen">
                            </span>
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
                
                <?php $messageSuccessUpdate = $this->session->flashdata('UpdateBanner'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessAdd = $this->session->flashdata('AddBanner'); ?>
                <?php if($messageSuccessAdd){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessAdd ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessDele = $this->session->flashdata('DeleteBanner'); ?>
                <?php if($messageSuccessDele){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessDele ?></h3></div>
                <?php } ?>
                
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Noticias</h2>
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
                        <th class="text-center">Titulo</th>
                        <th class="text-center">Descripcion</th>
                        <th class="text-center">Imagen</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
                <?php foreach ($noticias as $key => $value) { ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['titulo'] ?></td>
                        <td class="text-center">
                        <div class="des" style="padding-right: 25px;text-align: justify;">
                            <?= $value['descripcion'] ?>
                        </div>
                        </td>
                        <script>
                            $('.des').slimScroll({
                                height: '50px'
                            })
                        </script>
                        <td class="text-center">
                        
                            <a class="fancybox" rel="gallery1" href="<?= base_url(); ?>imgTemplates/Noticias/<?= $value['imagen'] ?>" title="<?= $value['titulo'] ?>">
                                <?= $value['titulo'] ?>
                                <img src="" alt="" />
                            </a>
                        </td>
                        <script>
                        $(document).ready(function() {
                            $(".fancybox").fancybox({
                                openEffect  : 'none',
                                closeEffect : 'none'
                            });
                        });
                    </script>
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
                        <div class="modal fade" id="edit_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <form action="template/UpdateNoticia" method="POST" enctype="multipart/form-data">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Noticia <?= $value['codigo'] ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="titulo">Titulo</label>
                                                    <input type="text" value="<?= $value['titulo'] ?>" class="form-control" name="titulo" id="titulo" placeholder="Titulo" required />
                                                    <input type="hidden" value="<?= $value['codigo'] ?>" class="form-control" name="codigo" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for="descripcion">Descripcion</label>
                                                    <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion" rows="5" id="comment"><?= $value['descripcion'] ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <span class="btn btn-info btn-file">
                                                        Agregar Imagen <input type="file" name="imagen">
                                                    </span>
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

                    <?php if($dataUser['PsistemaD'] == "1"){ ?>
                        <div class="modal fade" id="delete_cat<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <form action="template/DeleteNoticia" method="POST">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Noticia <?= $value['codigo'] ?></h4>
                                            <input type="hidden" readonly class="form-control" name="codigo" value="<?= $value['codigo'] ?>" required />
                                        </div>
                                        <div class="modal-body">
                                            ¿ esta seguro de boorar esta Noticia ?
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