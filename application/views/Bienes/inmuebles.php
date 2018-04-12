<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista7" ).last().addClass( "active" );
    $( "#lista7-1" ).last().addClass( "active" );
</script>
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<section id="personas" class="">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title" style="padding: 15px 15px 7px;  min-height: 66px;">
                
                <?php $messageExistClaveCatastral = $this->session->flashdata('ErrorClaveCatastral'); ?>
                <?php if($messageExistClaveCatastral){ ?>
                    <div class="alert alert-warning"><h3><?= $messageExistClaveCatastral ?></h3></div>
                <?php } ?>
                
                <?php $messageSuccessInmueble = $this->session->flashdata('AddInmuebles'); ?>
                <?php if($messageSuccessInmueble){ ?>
                    <div class="alert alert-success"><h3><?= $messageSuccessInmueble ?></h3></div>
                <?php } ?>
                
                <?php $messageErrorGlobal = $this->session->flashdata('ErrorActividadEconomica'); ?>
                <?php if($messageErrorGlobal){ ?>
                    <div class="alert alert-danger"><h3><?= $messageErrorGlobal ?></h3></div>
                <?php } ?>
                
                <?php $messageDeleteInmueble = $this->session->flashdata('deleteinmueble'); ?>
                <?php if($messageDeleteInmueble){ ?>
                    <div class="alert alert-warning"><h3><?= $messageDeleteInmueble ?></h3></div>
                <?php } ?>
                
                <?php $messageUpdateInmueble = $this->session->flashdata('UpdateInmeble'); ?>
                <?php if($messageUpdateInmueble){ ?>
                    <div class="alert alert-success"><h3><?= $messageUpdateInmueble ?></h3></div>
                <?php } ?>
                
               <div class="col-xs-12">
                   <div class="col-xs-6 col-sm-6">
                       <h2 style=" color: #24544b; font-weight: bold;">Inmuebles</h2>
                   </div>
                   
                   <?php if($dataUser['bienesA'] == "1"){ ?>
                   <div class="col-xs-6 col-sm-6">
                        <button class="btn btn-info pull-right" id="nuevaPersona">Persona</button>
                        <button class="btn btn-success " id="nuevaEmpresa">Empresa</button>
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
                <th class="text-center">Contribuyente</th>
                <th class="text-center">Clase del Bien</th>
                <th class="text-center">Tipo de Bien</th>
                <th class="text-center">Clave Catastral</th>
                <th class="text-center">Actividad Economica</th>
                <th class="text-center">estado</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($inmuebles as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['id_propietario'] ?></td>
                        <td class="text-center"><?= $value['clase_bien'] ?></td>
                        <td class="text-center"><?= $value['tipo_bien'] ?></td>
                        <td class="text-center"><?= $value['clave_catastral'] ?></td>
                        <td class="text-center"><?= $value['actividad_economica'] ?></td>
                        <td class="text-center">
                            <?php if($value['estado'] == "0"){ ?>
                                <span class="label label-warning">Cerrado</span>
                            <?php } ?>
                            <?php if($value['estado'] == "1"){ ?>
                                <span class="label label-primary">Activo</span>
                            <?php } ?>
                            <?php if($value['estado'] == "2"){ ?>
                                <span class="label label-danger">Clausurado</span>
                            <?php } ?>
                        </td>
                        <td class="text-center">
                        <?php if($dataUser['bienesE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_inmueble<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                        <?php } ?>
                        <?php if($dataUser['bienesD'] == "1"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_inmueble<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                        <?php } ?>
                        </td>
                    </tr>  
                        <?php if($dataUser['bienesE'] == "1"){ ?>
                            <div class="modal fade" id="edit_inmueble<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="bienes/update_inmuebles" method="POST">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Editar Inmueble</h4>
                                            </div>
                                            
                                            <div class="modal-body">
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="contribuyente">Contribuyente</label>
                                                            <input type="text" readonly class="form-control" id="contribuyente" value="<?= $value['id_propietario'] ?>" disabled/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="clavecatastral">Clave Catastral</label>
                                                            <input type="text" readonly class="form-control" id="clavecatastral" value="<?= $value['clave_catastral'] ?>" disabled />
                                                            <input type="hidden" readonly class="form-control" name="clavecatastral" value="<?= $value['clave_catastral'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="claseBien">Clase del Bien</label>
                                                            <select class="form-control" id="claseBien" name="claseBien" required>
                                                                    <option value="<?= $value['clase_bien'] ?>"><?= $value['clase_bien'] ?></option>
                                                                <?php foreach ($mantenimientoInmuebles as $keyClaBien => $valueClaBien) { ?>
                                                                    <option value="<?= $valueClaBien['tipo_imueble'] ?>"><?= $valueClaBien['tipo_imueble'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="tipoBien">Tipo de Bien</label>
                                                            <select class="form-control" id="tipoBien" name="tipoBien" required>
                                                                    <option value="<?= $value['tipo_bien'] ?>"><?= $value['tipo_bien'] ?></option>
                                                                <?php foreach ($tipoInmuebles as $keyTipoBien => $valueTipoBien) { ?>
                                                                    <option value="<?= $valueTipoBien['tipo_imueble'] ?>"><?= $valueTipoBien['tipo_imueble'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="actividadEco">Categorias: </label>
                                                            <select class="form-control" id="actividadEco" name="actividadEco" required>
                                                                    <option value="<?= $value['actividad_economica'] ?>"><?= $value['actividad_economica'] ?></option>
                                                                <?php foreach ($CatRiesgo as $keyCaRi => $valueCaRi) { ?>
                                                                    <option value="<?= $valueCaRi['nombre_comercial'] ?>"><?= $valueCaRi['nombre_comercial'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="categoria_riesgo">Subcategorias: </label>
                                                            <select class="form-control" id="categoria_riesgo" name="categoria_riesgo" required>
                                                                <?php $Sub = $this->universal->query('SELECT * FROM subcategoria WHERE ID='.$value['categoria_riesgo'].' '); ?>
                                                                <option value="<?= $value['categoria_riesgo'] ?>"><?= $Sub[0]['subcategoria'] ?></option>';
                                                                <?php foreach($subcategoria as $keyyS => $valueeS){ ?>             
                                                                   <option value="<?= $valueeS["ID"] ?>"><?= $valueeS["subcategoria"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="ubicacion">Ubicacion</label>
                                                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?= $value['ubicacion'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="limites">Limites</label>
                                                            <input type="text" class="form-control" id="limites" name="limites" value="<?= $value['limites'] ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="area_propiedad">Area de la Propiedad</label>
                                                            <input type="number" min="0" class="form-control" id="area_propiedad" name="area_propiedad" value="<?= $value['area_propiedad'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="area_construccion">Area Construccion</label>
                                                            <input type="number" min="0" class="form-control" id="area_construccion" name="area_construccion" value="<?= $value['area_construccion'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="estado">Estado</label>
                                                            <select class="form-control" id="estado" name="estado" required>
                                                                <?php if($value['estado'] == "0"){ ?>
                                                                    <option value="0">Cerrado</option>
                                                                    <option value="1">Activo</option>
                                                                    <option value="2">Clausurado</option>
                                                                <?php } ?>
                                                                <?php if($value['estado'] == "1"){ ?>
                                                                    <option value="1">Activo</option>
                                                                    <option value="0">Cerrado</option>
                                                                    <option value="2">Clausurado</option>
                                                                <?php } ?>
                                                                <?php if($value['estado'] == "2"){ ?>
                                                                    <option value="2">Clausurado</option>
                                                                    <option value="0">Cerrado</option>
                                                                    <option value="1">Activo</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="" for="caracteristica">Caracteristicas</label>
                                                        <textarea class="form-control" rows="3" id="caracteristica" name="caracteristica"><?= $value['caracteristicas'] ?></textarea>
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
                        <?php if($dataUser['bienesD'] == "1"){ ?>
                            <div class="modal fade" id="delete_inmueble<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="bienes/delete_inmuebles" method="POST">
                                        <input type="hidden" readonly name="claveCatastral" value="<?= $value['clave_catastral'] ?>" required />
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar inmueble</h4>
                                            </div>
                                            <div class="modal-body">
                                                ¿Seguro de Eliminar el inmueble? <strong>Clave Catastral: <?= $value['clave_catastral'] ?></strong> 
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

<?php if($dataUser['bienesA'] == "1"){ ?>
<section id="add_persona">
    <div class="col-md-12">
        <h2 class="titleADD">Agregar Bien</h2>
        <button type="button" class="btn btn-info pull-right" id="AddBien">Agregar Bien</button>
    </div>
        <div class="clearfix"></div>
    
    <div class="col-md-12 contentAddPersona">
        <form action="bienes/add_inmuebles" method="POST">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="persona"><span style="color:red">* </span>Persona: </label>
                    <select class="form-control" name="persona" id="persona" required>
                            <option value=""></option>
                        <?php foreach($personas as $key => $value){ ?>                    
                            <option value="<?= $value['cedula'] ?>"><?= $value['nombres'] ?> | <?= $value['apellidos'] ?> | <?= $value['cedula'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <script>
            
            $(document).ready(function(){
                var i = 0;
                    
                    $('#AddBien').click(function(){
                            var datos = '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="claseBien"><span style="color:red">* </span>Clase del Bien: </label>';
                                            // datos += '<input type="text" class="form-control" id="claseBien" name="clasebien'+i+'" placeholder="Clase del Bien" required />';
                                            datos += '<select class="form-control" name="clasebien'+i+'" id="clasebien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($mantenimientoInmuebles as $keyMI => $valueMI){ ?>';                    
                                                    datos += '<option value="<?= $valueMI["tipo_imueble"] ?>"><?= $valueMI["tipo_imueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="tipoBien"><span style="color:red">* </span>Tipo del Bien: </label>';
                                            // datos += '<input type="text" class="form-control" id="tipoBien" name="tipobien'+i+'" placeholder="Tipo del Bien" required />';
                                            datos += '<select class="form-control" name="tipobien'+i+'" id="tipobien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($tipoInmuebles as $keyTB => $valueTB){ ?>';                    
                                                    datos += '<option value="<?= $valueTB["tipo_imueble"] ?>"><?= $valueTB["tipo_imueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="claveCatastral"><span style="color:red">* </span>Clave Catastral: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="claveCatastral" name="clavecatastral'+i+'" placeholder="Clave Catastral" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ActividadEconomica"><span style="color:red">* </span>Categorias: </label>';
                                            datos += '<select class="form-control" name="actividadeconomica'+i+'" id="ActividadEconomica" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($CatRiesgo as $key => $value){ ?>';                    
                                                    datos += '<option value="<?= $value["ID"] ?>"><?= $value["nombre_comercial"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="CategoriaRiesgo"><span style="color:red">* </span>Subcategorias: </label>';
                                            datos += '<select class="form-control" name="categoriariesgo'+i+'" id="CategoriaRiesgo" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($subcategoria as $keySubC => $valueSubC){ ?>'; 
                                                    datos += '<option value="<?= $valueSubC["ID"] ?>"><?= $valueSubC["subcategoria"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ubicacion"><span style="color:red">* </span>Ubicación: </label>';
                                            datos += '<input type="text" class="form-control" id="ubicacion" name="ubicacion'+i+'" placeholder="Ubicacion" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="Limite"><span style="color:red">* </span>Limites: </label>';
                                            datos += '<input type="text" class="form-control" id="Limite" name="limite'+i+'" placeholder="Limites" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="estado"><span style="color:red">* </span>Estado: </label>';
                                            datos += '<select class="form-control" name="estado'+i+'" id="estado" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<option value="0">Cerrado</option>';
                                                datos += '<option value="1">Activo</option>';
                                                datos += '<option value="2">Clausurado</option>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="AreaPropiedad"><span style="color:red">* </span>Área Propiedad: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="AreaPropiedad" name="areapropiedad'+i+'" placeholder="Area de la Propiedad" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="AreaConstruccion"><span style="color:red">* </span>Área Construcción: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="AreaConstruccion" name="areaconstruccion'+i+'" placeholder="Area de Construccion" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-12">';
                                        datos += '<label class="" for="caracteristica"><span style="color:red">* </span>Características: </label>';
                                        datos += '<textarea class="form-control" id="caracteristica" name="caracteristica'+i+'" placeholder="Características: " rows="3"></textarea>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                datos += '<div class="clearfix" style="margin-bottom: 20px;border-bottom: 1px;border-bottom-style: dashed;padding-bottom: 10px;"></div>';
    
                            $('#InmueblePersona').append(datos);
                            
                        i++;
                    });
            });
                
            </script>
            
            <div class="col-md-12" id="InmueblePersona">
                
            </div>
            
            <div class="col-md-12" style="margin-top:50px;">
                <button type="reset" class="btn btn-danger" id="CloseAddPersona">Cerrar</button>
                <button type="submit" class="btn btn-success pull-right">Guardar</button>
            </div>
            
        </form>
    </div>
    
</section>

<section id="add_empresa">
    <div class="col-md-12">
        <h2 class="titleADD">Agregar Bien</h2>
        <button type="button" class="btn btn-info pull-right" id="AddBienE">Agregar Bien</button>
    </div>
        <div class="clearfix"></div>
    
    <div class="col-md-12 contentAddPersona">
        <form action="bienes/add_inmuebles" method="POST">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="" for="persona"><span style="color:red">* </span>Empresa: </label>
                    <select class="form-control" name="persona" id="persona" required>
                            <option value=""></option>
                        <?php foreach($empresas as $key => $value){ ?>                    
                            <option value="<?= $value['ruc'] ?>"><?= $value['nombre_empresa'] ?> | <?= $value['ruc'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <script>
            
            $(document).ready(function(){
                var i = 0;
                    
                    $('#AddBienE').click(function(){
                            var datos = '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="claseBien"><span style="color:red">* </span>Clase del Bien: </label>';
                                            datos += '<select class="form-control" name="clasebien'+i+'" id="clasebien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($mantenimientoInmuebles as $keyMI => $valueMI){ ?>';                    
                                                    datos += '<option value="<?= $valueMI["tipo_imueble"] ?>"><?= $valueMI["tipo_imueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="tipoBien"><span style="color:red">* </span>Tipo del Bien: </label>';
                                            // datos += '<input type="text" class="form-control" id="tipoBien" name="tipobien'+i+'" placeholder="Tipo del Bien" required />';
                                            datos += '<select class="form-control" name="tipobien'+i+'" id="tipobien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($tipoInmuebles as $keyTB => $valueTB){ ?>';                    
                                                    datos += '<option value="<?= $valueTB["tipo_imueble"] ?>"><?= $valueTB["tipo_imueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="claveCatastral"><span style="color:red">* </span>Clave Catastral: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="claveCatastral" name="clavecatastral'+i+'" placeholder="Clave Catastral" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ActividadEconomica"><span style="color:red">* </span>Categorias: </label>';
                                            datos += '<select class="form-control" name="actividadeconomica'+i+'" id="ActividadEconomica" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($CatRiesgo as $key => $value){ ?>';                    
                                                    datos += '<option value="<?= $value["ID"] ?>"><?= $value["nombre_comercial"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="CategoriaRiesgo"><span style="color:red">* </span>Subcategorias: </label>';
                                            datos += '<select class="form-control" name="categoriariesgo'+i+'" id="CategoriaRiesgo" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($subcategoria as $keySubC => $valueSubC){ ?>'; 
                                                    datos += '<option value="<?= $valueSubC["ID"] ?>"><?= $valueSubC["subcategoria"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ubicacion"><span style="color:red">* </span>Ubicación: </label>';
                                            datos += '<input type="text" class="form-control" id="ubicacion" name="ubicacion'+i+'" placeholder="Ubicacion" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="Limite"><span style="color:red">* </span>Limites: </label>';
                                            datos += '<input type="text" class="form-control" id="Limite" name="limite'+i+'" placeholder="Limites" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="estado"><span style="color:red">* </span>Estado: </label>';
                                            datos += '<select class="form-control" name="estado'+i+'" id="estado" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<option value="0">Cerrado</option>';
                                                datos += '<option value="1">Activo</option>';
                                                datos += '<option value="2">Clausurado</option>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="AreaPropiedad"><span style="color:red">* </span>Área Propiedad: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="AreaPropiedad" name="areapropiedad'+i+'" placeholder="Area de la Propiedad" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="AreaConstruccion"><span style="color:red">* </span>Área Construcción: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="AreaConstruccion" name="areaconstruccion'+i+'" placeholder="Area de Construccion" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-12">';
                                        datos += '<label class="" for="caracteristica"><span style="color:red">* </span>Características: </label>';
                                        datos += '<textarea class="form-control" id="caracteristica" name="caracteristica'+i+'" placeholder="Características: " rows="3"></textarea>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                datos += '<div class="clearfix" style="margin-bottom: 20px;border-bottom: 1px;border-bottom-style: dashed;padding-bottom: 10px;"></div>';
    
                            $('#InmuebleEmpresa').append(datos);
                            
                        i++;
                    });
            });
                
            </script>
            
            <div class="col-md-12" id="InmuebleEmpresa">
                
            </div>
            
            <div class="col-md-12" style="margin-top:50px;">
                <button type="reset" class="btn btn-danger" id="CloseAddEmpresa">Cerrar</button>
                <button type="submit" class="btn btn-success pull-right">Guardar</button>
            </div>
            
        </form>
    </div>
    
</section>
<?php } ?>
