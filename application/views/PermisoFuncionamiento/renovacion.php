<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista2" ).last().addClass( "active" );
    $( "#lista2-2" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<section id="RenepermisoFuncionamiento" class="">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageSuccessUpdate = $this->session->flashdata('UpdateRenoPermiso'); ?>
                <?php if($messageSuccessUpdate){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessUpdate ?></h3></div>
                <?php } ?>
                
               <div class="col-xs-12">
                   <div class="col-xs-12">
                       <h2 style=" color: #24544b; font-weight: bold;">Renovacion de Permisos de Funcionamiento</h2>
                   </div>
               </div>
    
            </div>
            <div class="ibox-content">
    
                <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">Numero De Permiso</th>
                <th class="text-center">Codigo de Contribuyente</th>
                <th class="text-center">Bien</th>
                <th class="text-center">Fecha De Creacion</th>
                <th class="text-center">Fecha de Caducidad</th>
                <th class="text-center">Status</th>
                <th class="text-center">Total Del Permiso</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($permisoFuncionamiento as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['n_permiso'] ?></td>
                        <td class="text-center"><?= $value['contribuyente'] ?></td>
                        <td class="text-center"><?= $value['activo'] ?></td>
                        <td class="text-center"><?= $value['fecha_creacion'] ?></td>
                        <td class="text-center"><?= $value['fecha_caducidad'] ?></td>
                        <?php 
                            $fechaActual = date('Y-m-d');
                            if($value['fecha_caducidad'] > $fechaActual){
                        ?>
                            <td class="text-center"><span class="label label-primary">Vigente</span></td>
                        <?php }else{ ?>
                            <td class="text-center"><span class="label label-danger">Caducada</span></td>
                        <?php } ?>
                        <td class="text-center"><?= $value['total_permiso'] ?></td>
                        <td class="text-center">
                    <?php if($dataUser['PfuncionamientoE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_per<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php 
                                $fechaActual = date('Y-m-d');
                                if($value['fecha_caducidad'] > $fechaActual){
                            ?>
                            <form action="pdfs/pdfPermisoFuncionamiento" method="POST">
                            <!-- post -->
                                <input type="hidden" name="contribuyente" value="<?= $value['contribuyente'] ?>" required readonly>
                                <input type="hidden" name="fecha_creacion" value="<?= $value['fecha_creacion'] ?>" required readonly>
                                <input type="hidden" name="fecha_caducidad" value="<?= $value['fecha_caducidad'] ?>" required readonly>
                                <input type="hidden" name="total_permiso" value="<?= $value['total_permiso'] ?>" required readonly>
                                <input type="hidden" name="n_permiso" value="<?= $value['n_permiso'] ?>" required readonly>
                                <input type="hidden" name="id_bien" value="<?= $value['id_bien'] ?>" required readonly>
                                <button class="btn btn-primary btn-circle" title="IMPRIMIR" type="submit"><i class="fa fa-download"></i></button>
                            </form>
                            <?php } ?>
                    <?php } ?>
                            <!--<button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_cat<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>-->
                        </td>
                    </tr>  
                    
                    <!-- Modal -->
                    <?php if($dataUser['PfuncionamientoE'] == "1"){ ?>
                    <div class="modal fade" id="edit_per<?= $key ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                            <form action="permisos/RenovarPermiso" method="POST" enctype="multipart/form-data">
                                <input type="hidden" readonly name="nPermiso" value="<?= $value['n_permiso'] ?>" required />
                                <input type="hidden" readonly name="activo" value="<?= $value['id_cate_riesgo'] ?>" required />
                                <input type="hidden" readonly name="categoria" value="<?= $value['categoria'] ?>" required />
                                <input type="hidden" readonly name="id_periodo" value="<?= $value['id_periodo'] ?>" required />
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php 
                                            $fechaActual = date('Y-m-d');
                                            if($value['fecha_caducidad'] > $fechaActual){
                                        ?>
                                            <h3 class="modal-title">Codigo de Permiso: <strong><?= $value['n_permiso'] ?><span class="label label-primary pull-right">Vigente</span></strong></h3>
                                        <?php }else{ ?>
                                            <h3 class="modal-title">Codigo de Permiso: <strong><?= $value['n_permiso'] ?><span class="label label-danger pull-right">Caducada</span></strong></h3>
                                        <?php } ?>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-md-6">
                                            Cedula O Ruc : <strong><?= $value['contribuyente'] ?></strong>
                                        </div>
                                        <div class="col-md-6">
                                            Fecha de Caducidad : <strong><?= $value['fecha_caducidad'] ?></strong>
                                        </div>
                                            <div class="clearfix" style="margin-bottom: 20px;"></div>
                                        <div class="col-md-8">
                                            Bien: <strong><?= $value['activo'] ?></strong>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            Total del Permiso: <strong><?= $value['total_permiso'] ?></strong>
                                        </div>
                                        
                                            <div class="clearfix" style="margin-bottom: 20px;"></div>
                                        
                                        <!--parte de arriba-->
                                        <div class="col-md-3 text-center">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['informe_inspeccion'] ?>" title="Informe de inspección">
                                            	Informe de inspección
                                            </a>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['ruc_rise'] ?>" title="Copia del RUC o RISE ">
                                            	Copia del RUC o RISE 
                                            </a>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['pago_impuesto'] ?>" title="Copia del pago del Impuesto de los Predios Urbanos/Rústicos vigente. ">
                                            	Copia del pago del Impuesto de los Predios Urbanos/Rústicos vigente. 
                                            </a>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['tasa_bombero'] ?>" title="Copia del pago de la Tasa de Bomberos. ">
                                            	Copia del pago de la Tasa de Bomberos. 
                                            </a>
                                        </div>
                                        
                                        <!--parte de abajo-->
                                        
                                        <div class="col-md-4 text-center" style="margin-top: 40px;">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['cedula'] ?>" title="Copia de la cédula">
                                            	Copia de la cédula
                                            </a>
                                        </div>
                                        <div class="col-md-4 text-center" style="margin-top: 40px;">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['papeleta_votacion'] ?>" title="Copia de la papeleta de votación">
                                            	Copia de la papeleta de votación
                                            </a>
                                        </div>
                                        <div class="col-md-4 text-center" style="margin-top: 40px;">
                                            <a class="fancybox" rel="gallery1" href="<?= base_url() ?>Images/pFuncionamiento/<?= $value['factura_extintor'] ?>" title="Copia de la factura de compra o recarga de extintor a nombre del propietario (anual) de 10 libras mínimo. ">
                                            	Copia de la factura de compra o recarga de extintor a nombre del propietario (anual) de 10 libras mínimo. 
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                    <?php 
                                        $fechaActual = date('Y-m-d');
                                        if($value['fecha_caducidad'] > $fechaActual){
                                    ?>
                                    <?php }else{ ?>
                                       <!--  <div class="col-md-12" style="margin-bottom:30px;">
                                            <div class="col-md-4 text-center">Informe de inspección:</div>
                                            <div class="col-md-4 text-center">Copia del RUC o RISE:</div>
                                            <div class="col-md-4 text-center">Copia de la cédula:</div>
                                            
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="informe">
                                                </span>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="ruc_rise">
                                                </span>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="cedula">
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12" style="margin-bottom:30px;">
                                            <div class="col-md-4 text-center">papeleta de votación:</div>
                                            <div class="col-md-4 text-center">Copia del pago del Impuesto de los Predios Urbanos/Rústicos vigente:</div>
                                            <div class="col-md-4 text-center">Copia del pago de la Tasa de Bomberos:</div>
                                            
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="papeleta_votacion">
                                                </span>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="impusto">
                                                </span>
                                            </div>
                                            <div class="col-md-4 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="tasa_bombero">
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="col-md-12 text-center">Copia de la factura de compra o recarga de extintor a nombre del propietario (anual) de 10 libras mínimo:</div>
                                            
                                            <div class="col-md-12 text-center">
                                                <span class="btn btn-info btn-file">
                                                Agregar Imagen <input type="file" name="factura">
                                                </span>
                                            </div>
                                        </div> -->
                                     <?php } ?>
                                     
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                        <?php 
                                            $fechaActual = date('Y-m-d');
                                            if($value['fecha_caducidad'] > $fechaActual){
                                        ?>
                                        <?php }else{ ?>
                                            <button type="submit" class="btn btn-success">Renovar</button>
                                        <?php } ?>
                                    </div>
                            </form>
                                </div>
                        </div>
                    </div>
                    <script>
                        $(document).ready(function() {
                        	$(".fancybox").fancybox({
                        		openEffect	: 'none',
                        		closeEffect	: 'none'
                        	});
                        });
                    </script>
                    <?php } ?>
                    
                <?php } ?>
            </tbody>
            </table>
                </div>
    
            </div>
        </div>
    </div>
</section>
