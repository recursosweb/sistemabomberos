<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista2" ).last().addClass( "active" );
    $( "#lista2-1" ).last().addClass( "active" );
    // PAGINA PERMISO DE FUNCIONAMIENTO
   
   
    $(document).ready(function(){
        // persona
        $('#AddpermisoFuncionamientoPersonaM').hide();
        $('#AddpermisoFuncionamientoPersonaI').hide();
        // empresa
        $('#AddpermisoFuncionamientoEmpresaM').hide();
        $('#AddpermisoFuncionamientoEmpresaI').hide();
    
        // persona
        $('#AddPerM').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoPersonaM').show('slow');
        });
        
        $('#CloseAddPermisoM').click(function(){
            $('#AddpermisoFuncionamientoPersonaM').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
        
         $('#AddPerI').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoPersonaI').show('slow');
        });
        
        $('#CloseAddPermisoI').click(function(){
            $('#AddpermisoFuncionamientoPersonaI').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
        
        // empresa
        
        $('#AddEmpreM').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoEmpresaM').show('slow');
        });
        
        $('#CloseAddPermisoEmpresaM').click(function(){
            $('#AddpermisoFuncionamientoEmpresaM').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
        
         $('#AddEmpreI').click(function(){
            $('#permisoFuncionamiento').hide('slow');
            $('#AddpermisoFuncionamientoEmpresaI').show('slow');
        });
        
        $('#CloseAddPermisoEmpresaI').click(function(){
            $('#AddpermisoFuncionamientoEmpresaI').hide('slow');
            $('#permisoFuncionamiento').show('slow');
        });
    });
    
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<section id="permisoFuncionamiento" class="">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageSuccess = $this->session->flashdata('AddPermisoFuncionamiento'); ?>
                
                <?php $messageSuccessExitPerido = $this->session->flashdata('ExistPeriodo'); ?>
                <?php if($messageSuccessExitPerido){ ?>
                    <div class="alert alert-warning"><h3><?= $messageSuccessExitPerido ?></h3></div>
                <?php } ?>

                <?php $messageNoExistGestion = $this->session->flashdata('NoExisteGestion'); ?>
                <?php if($messageNoExistGestion){ ?>
                    <div class="alert alert-danger"><h3><?= $messageNoExistGestion ?></h3></div>
                <?php }elseif($messageSuccess){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccess ?></h3></div>
                <?php  } ?>

                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Permisos de Funcionamiento</h2>
                   </div>
               <?php if($dataUser['PfuncionamientoA'] == "1"){ ?>
                   <div class="col-md-6">
                       <div class="col-md-12">
                           <div class="col-md-6 text-center">
                               <h3 class="text-center">Personas</h3>
                               <button class="btn btn-info" id="AddPerI">Inmuebles</button>
                           </div>
                           <div class="col-md-6 text-center">
                                <h3 class="text-center">Empresas</h3>
                                <button class="btn btn-primary " id="AddEmpreI">Inmuebles</button>
                           </div>
                       </div>
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
                        <td class="text-center"><?= $value["activo"] ?></td>
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
                        <?php } ?>
                        </td>
                    </tr>  
                    
                    <!-- Modal -->
                <?php if($dataUser['PfuncionamientoE'] == "1"){ ?>
                    <div class="modal fade" id="edit_per<?= $key ?>" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                        <form action="pdfs/pdfPermisoFuncionamiento" method="POST">
                        <!-- post -->
                            <input type="hidden" name="contribuyente" value="<?= $value['contribuyente'] ?>" required readonly>
                            <input type="hidden" name="fecha_creacion" value="<?= $value['fecha_creacion'] ?>" required readonly>
                            <input type="hidden" name="fecha_caducidad" value="<?= $value['fecha_caducidad'] ?>" required readonly>
                            <input type="hidden" name="total_permiso" value="<?= $value['total_permiso'] ?>" required readonly>
                            <input type="hidden" name="n_permiso" value="<?= $value['n_permiso'] ?>" required readonly>
                            <input type="hidden" name="id_bien" value="<?= $value['id_bien'] ?>" required readonly>
                        <!-- fin de post -->
                            <div class="modal-content">
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-info">Imprimir</button>
                                    <?php 
                                        $fechaActual = date('Y-m-d');
                                        if($value['fecha_caducidad'] > $fechaActual){
                                    ?>
                                    <?php }else{ ?>
                                        <a href="RenovacionPermisoFuncionamiento"><button type="button" class="btn btn-success">Caducado</button></a>
                                    <?php } ?>
                                </div>
                            </div>
                            </form>
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

<?php if($dataUser['PfuncionamientoA'] == "1"){ 
?>
<section id="AddpermisoFuncionamientoPersonaI" class="">
    <div class="col-md-12">
        <form action="permisos/add_permisoFuncionamiento" id="formPermisos" method="POST" enctype="multipart/form-data">
            
            <div class="col-md-12">
                <h3>Permiso de funcionamiento Para Personas</h3>
            </div>
            
             <div class="col-md-12">
                <div class="col-md-6">
                    <button type="button" class="btn btn-info" id="btnAddBienI">Añadir Bien</button>
                    <span class="help-block">Seleccione primero un contribuyente</span>
                </div>
            </div>
            
            <div id="registrandoI"></div>
            
            <div class="col-md-12" id="CamposPermisosAddI">
                <div class="form-group col-md-12">
                    <label class="" for="contribuyenteI"><span style="color:red">* </span>Personas</label>
                    <select class="form-control" name="contribuyente" id="contribuyenteI" required>
                        <option></option>
                        <?php foreach ($personas as $key => $value) { ?>
                        <option value="<?= $value["cedula"] ?>"><?= $value["nombres"] ?> | <?= $value["apellidos"] ?> | <?= $value["cedula"] ?></option> 
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <script>
                $(document).ready(function(){
                    var i = 0;
                    var aux;                    
                         $('select#contribuyenteI').on('change',function(){
                                var valor = $('#contribuyenteI').val();
                                var parametros = { "id_propietario" : valor};
                                	$.ajax({
                                	    data: parametros,
                            			url: "permisos/obtenerbienesI",
                            			type:"POST",
                            			beforeSend: function(){
                                            $("#registrandoI").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
                                        },
                            			success: function(data){
                            			    $("#registrandoI").html("<i></i>");
                            			    dat = JSON.parse(data);
                            			    console.log(dat);
                            			    if(dat == "0"){
                            			        alertify.error('Este contribuyente no posee bienes a que dar permisos');
                            			    }else{
                            			     alertify.success('Ya puede Agregar un bien'); 
                            			    if(dat.length > 0){
    $('#btnAddBienI').click(function(){
        // CONTRIBUYENTE
        var dato = '<div class="permisoN'+i+'">';
            // LISTA DE BIEN
            dato += '<div class="col-md-12">';
                dato += '<div class="form-group col-md-12">';
                    dato += '<label class="" for="selectBien'+i+'"><span style="color:red">* </span>Selecionar Bien</label>';
                        dato += '<select class="form-control" name="selectBien'+i+'" id="selectBien'+i+'" required>';
                                for(var o =0; o < dat.length; o++){
                                    dato += '<option value="'+dat[o]['id_actividad_economica']+'|'+dat[o]['clase_bien']+'|'+dat[o]['clave_catastral']+'|'+dat[o]['categoria_riesgo']+'">'+dat[o]['clase_bien']+'</option>';
                                }
                        dato += '</select>';
                dato += '</div>';
            dato += '</div>';

            dato += '<div class="col-md-12">';
                dato += '<div class="form-group col-md-12">';
                    dato += '<label class="" for="periodo'+i+'"><span style="color:red">* </span>Selecionar Periodo</label>';
                        dato += '<select class="form-control" name="periodo'+i+'" id="periodo'+i+'" required>';
                                dato += '<?php foreach($periodos as $keyPe => $valuePe){ ?>';                    
                                    dato += '<option value="<?= $valuePe["ID"] ?>|<?= $valuePe["periodo"] ?>"><?= $valuePe["periodo"] ?></option>';
                                dato += '<?php } ?>';
                        dato += '</select>';
                dato += '</div>';
            dato += '</div>';
            
            
            dato += '<div class="col-md-12">';
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-3">Informe de inspección: </div>';
                    dato += '<div class="col-md-3">Copia del RUC o RISE: </div>';
                    dato += '<div class="col-md-3">Copia de la cédula: </div>';
                    dato += '<div class="col-md-3">papeleta de votación: </div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                    
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img1|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += ' Agregar Imagen <input required type="file" name="img2|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img3|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img4|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';

                dato += '<div class="col-md-12 text-center" style="border-top: 1px solid;margin-top: 10px;">';
                    dato += '<div class="col-md-6">Copia del pago del Impuesto de los Predios Urbanos/Rústicos vigente: </div>';
                    dato += '<div class="col-md-6">Copia del pago de la Tasa de Bomberos: </div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                    
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-6">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img5|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-6">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img6|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                
                dato += '<div class="col-md-12 text-center" style="border-top: 1px solid;margin-top: 10px;">';
                    dato += '<div class="col-md-12">';
                        dato += 'Copia de la factura de compra o recarga de extintor a nombre del propietario (anual) de 10 libras mínimo: ';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-12">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="factura_extintor'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 50px;"></div>';
            dato += '</div>';                           
            dato += '</div>';                           
            
        $('#CamposPermisosAddI').append(dato);
        i++;
    });
                            			    }else{
                            			        console.log('Disculpe, usted no tienes bienes registrado');
                            			    }
                            			    }
                        				}
                        			});
                         });   
                });
            </script>
            
            
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right" id="procesarr">Procesar Permisos</button>
                <button type="reset" id="CloseAddPermisoI" class="btn btn-danger pull-right" style="margin-right: 20px;">Cerrar</button>
            </div>
        </form>
    </div>
</section>


<!--empresa-->
<section id="AddpermisoFuncionamientoEmpresaI" class="">
    <div class="col-md-12">
        <form action="permisos/add_permisoFuncionamiento" id="formPermisos" method="POST" enctype="multipart/form-data">
            
            <div class="col-md-12">
                <h3>Permiso de funcionamiento Para Empresas(Inmuebles)</h3>
            </div>
            
             <div class="col-md-12">
                <div class="col-md-6">
                    <button type="button" class="btn btn-info" id="btnAddBienEmpresaI">Añadir Bien</button>
                    <span class="help-block">Seleccione primero un contribuyente</span>
                </div>
            </div>
            
            <div id="registrandoEmpresaI"></div>
            
            <div class="col-md-12" id="CamposPermisosAddEmpresaI">
                <div class="form-group col-md-12">
                    <label class="" for="contribuyenteEmpresaI"><span style="color:red">* </span>Personas</label>
                    <select class="form-control" name="contribuyente" id="contribuyenteEmpresaI" required>
                        <option></option>
                        <?php foreach ($empresas as $key => $value) { ?>
                        <option value="<?= $value["ruc"] ?>"><?= $value["nombres"] ?> | <?= $value["apellidos"] ?> | <?= $value["ruc"] ?></option> 
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <script>
                $(document).ready(function(){
                    var i = 0;
                    var aux;                    
                         $('select#contribuyenteEmpresaI').on('change',function(){
                                var valor = $('#contribuyenteEmpresaI').val();
                                var parametros = { "id_propietario" : valor};
                                	$.ajax({
                                	    data: parametros,
                            			url: "permisos/obtenerbienesI",
                            			type:"POST",
                            			beforeSend: function(){
                                            $("#registrandoEmpresaI").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
                                        },
                            			success: function(data){
                            			    $("#registrandoEmpresaI").html("<i></i>");
                            			    dat = JSON.parse(data);
                            			    console.log(dat);
                            			    if(dat == "0"){
                            			        alertify.error('Este contribuyente no posee bienes a que dar permisos');
                            			    }else{
                            			     alertify.success('Ya puede Agregar un bien'); 
                            			    if(dat.length > 0){
    $('#btnAddBienEmpresaI').click(function(){
        // CONTRIBUYENTE
        var dato = '<div class="permisoN'+i+'">';
            // LISTA DE BIEN
            dato += '<div class="col-md-12">';
                dato += '<div class="form-group col-md-12">';
                    dato += '<label class="" for="selectBien'+i+'"><span style="color:red">* </span>Selecionar Bien</label>';
                        dato += '<select class="form-control" name="selectBien'+i+'" id="selectBien'+i+'" required>';
                                for(var o =0; o < dat.length; o++){
                                    dato += '<option value="'+dat[o]['id_actividad_economica']+'|'+dat[o]['clase_bien']+'|'+dat[o]['clave_catastral']+'|'+dat[o]['categoria_riesgo']+'">'+dat[o]['clase_bien']+'</option>';
                                }
                        dato += '</select>';
                dato += '</div>';
            dato += '</div>';
            
            dato += '<div class="col-md-12">';
                dato += '<div class="form-group col-md-12">';
                    dato += '<label class="" for="periodo'+i+'"><span style="color:red">* </span>Selecionar Periodo</label>';
                        dato += '<select class="form-control" name="periodo'+i+'" id="periodo'+i+'" required>';
                                dato += '<?php foreach($periodos as $keyPe => $valuePe){ ?>';                    
                                    dato += '<option value="<?= $valuePe["ID"] ?>|<?= $valuePe["periodo"] ?>"><?= $valuePe["periodo"] ?></option>';
                                dato += '<?php } ?>';
                        dato += '</select>';
                dato += '</div>';
            dato += '</div>';
            
            dato += '<div class="col-md-12">';
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-3">Informe de inspección: </div>';
                    dato += '<div class="col-md-3">Copia del RUC o RISE: </div>';
                    dato += '<div class="col-md-3">Copia de la cédula: </div>';
                    dato += '<div class="col-md-3">papeleta de votación: </div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                    
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img1|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += ' Agregar Imagen <input required type="file" name="img2|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img3|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-3">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img4|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';

                dato += '<div class="col-md-12 text-center" style="border-top: 1px solid;margin-top: 10px;">';
                    dato += '<div class="col-md-6">Copia del pago del Impuesto de los Predios Urbanos/Rústicos vigente: </div>';
                    dato += '<div class="col-md-6">Copia del pago de la Tasa de Bomberos: </div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                    
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-6">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img5|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                    dato += '<div class="col-md-6">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="img6|'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                
                dato += '<div class="col-md-12 text-center" style="border-top: 1px solid;margin-top: 10px;">';
                    dato += '<div class="col-md-12">';
                        dato += 'Copia de la factura de compra o recarga de extintor a nombre del propietario (anual) de 10 libras mínimo: ';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 10px;"></div>';
                
                dato += '<div class="col-md-12 text-center">';
                    dato += '<div class="col-md-12">';
                        dato += '<span class="btn btn-info btn-file">';
                        dato += 'Agregar Imagen <input required type="file" name="factura_extintor'+i+'">';
                        dato += '</span>';
                    dato += '</div>';
                dato += '</div>';
                
                    dato += '<div class="clearfix" style="margin-bottom: 50px;"></div>';
            dato += '</div>';                           
            dato += '</div>';                           
            
        $('#CamposPermisosAddEmpresaI').append(dato);
        i++;
    });
                            			    }else{
                            			        console.log('Disculpe, usted no tienes bienes registrado');
                            			    }
                            			    }
                        				}
                        			});
                         });   
                });
            </script>
            
            
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary pull-right" id="procesarr">Procesar Permisos</button>
                <button type="reset" id="CloseAddPermisoEmpresaI" class="btn btn-danger pull-right" style="margin-right: 20px;">Cerrar</button>
            </div>
        </form>
    </div>
</section>


<?php } ?>

