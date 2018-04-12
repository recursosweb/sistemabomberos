<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista7" ).last().addClass( "active" );
    $( "#lista7-2" ).last().addClass( "active" );
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
                
                <?php $messageErrorMotor = $this->session->flashdata('ErrorMotor'); ?>
                <?php if($messageErrorMotor){ ?>
                    <div class="alert alert-danger"><h3><?= $messageErrorMotor ?></h3></div>
                <?php } ?>
                
                <?php $messageErrorChasis = $this->session->flashdata('ErrorChasis'); ?>
                <?php if($messageErrorChasis){ ?>
                    <div class="alert alert-danger"><h3><?= $messageErrorChasis ?></h3></div>
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
                       <h2 style=" color: #24544b; font-weight: bold;">Muebles</h2>
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
                <th class="text-center">Placa</th>
                <th class="text-center">Actividad Economica</th>
                <th class="text-center">Numero de Motor</th>
                <th class="text-center">Numero de Chasis</th>
                <th class="text-center">Año de Fabricacion</th>
                <th class="text-center">Opciones</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($muebles as $key => $value){ ?>
                    <tr>
                        <td class="text-center"><?= $value['ID'] ?></td>
                        <td class="text-center"><?= $value['id_propietario'] ?></td>
                        <td class="text-center"><?= $value['clase_bien'] ?></td>
                        <td class="text-center"><?= $value['tipo_bien'] ?></td>
                        <td class="text-center"><?= $value['placa'] ?></td>
                        <td class="text-center"><?= $value['actividad_economica'] ?></td>
                        <td class="text-center"><?= $value['numero_motor'] ?></td>
                        <td class="text-center"><?= $value['numero_chasis'] ?></td>
                        <td class="text-center"><?= $value['fecha_fabricacion'] ?></td>
                        <td class="text-center">
                            <?php if($dataUser['bienesE'] == "1"){ ?>
                            <button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit_mueble<?= $key ?>" title="EDITAR" type="button"><i class="fa fa-pencil-square-o"></i></button>
                            <?php } ?>
                            <?php if($dataUser['bienesD'] == "1"){ ?>
                            <button class="btn btn-danger btn-circle" data-toggle="modal"  data-target="#delete_mueble<?= $key ?>" title="ELIMINAR" type="button"><i class="fa fa fa-trash-o"></i></button>
                            <?php } ?>
                        </td>
                    </tr>  
                    <?php if($dataUser['bienesE'] == "1"){ ?>
                            <div class="modal fade" id="edit_mueble<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <form action="bienes/update_muebles" method="POST">
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
                                                            <label class="" for="clase_bien">Clase del Bien</label>
                                                            <select class="form-control" id="claseBien" name="claseBien" required>
                                                                    <option value="<?= $value['clase_bien'] ?>"><?= $value['clase_bien'] ?></option>
                                                                <?php foreach ($mantenimientomuebles as $keyClaBien => $valueClaBien) { ?>
                                                                    <option value="<?= $valueClaBien['tipo_mueble'] ?>"><?= $valueClaBien['tipo_mueble'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="tipoBien">Tipo del Bien</label>
                                                            <select class="form-control" id="tipoBien" name="tipoBien" required>
                                                                    <option value="<?= $value['tipo_bien'] ?>"><?= $value['tipo_bien'] ?></option>
                                                                <?php foreach ($tipomuebles as $keyTipoBien => $valueTipoBien) { ?>
                                                                    <option value="<?= $valueTipoBien['tipo_mueble'] ?>"><?= $valueTipoBien['tipo_mueble'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="placa">Placa</label>
                                                            <input type="text" readonly class="form-control" id="placa" value="<?= $value['placa'] ?>" disabled/>
                                                            <input type="hidden" readonly class="form-control" id="placa" name="placa" value="<?= $value['placa'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="Nmotor">Numero de Motor</label>
                                                            <input type="text" readonly class="form-control" id="Nmotor" value="<?= $value['numero_motor'] ?>" disabled />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="NChasis">Numero de Chasis</label>
                                                            <input type="text" readonly class="form-control" id="NChasis" value="<?= $value['numero_chasis'] ?>" disabled />
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="categoria_riesgo">Subcategorias:</label>
                                                            <select class="form-control" id="categoria_riesgo" name="categoria_riesgo" required>
                                                            <?php $Sub = $this->universal->query('SELECT * FROM subcategoria WHERE ID='.$value['categoria_riesgo'].' '); ?>
                                                                <option value="<?= $value['categoria_riesgo'] ?>"><?= $Sub[0]['subcategoria'] ?></option>';
                                                                <?php foreach($subcategoria as $keyyS => $valueeS){ ?>             
                                                                   <option value="<?= $valueeS["ID"] ?>"><?= $valueeS["subcategoria"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="" for="ubicacion">Categorias</label>
                                                            <select class="form-control" name="actividadeconomica" id="ActividadEconomica" required >
                                                                <option value="<?= $value['id_actividad_economica'] ?>"><?= $value['actividad_economica'] ?></option>';
                                                                <?php foreach($CatRiesgo as $keyy => $valuee){ ?>             
                                                                   <option value="<?= $valuee["ID"] ?>"><?= $valuee["nombre_comercial"] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="marca">Marca</label>
                                                            <input type="text" class="form-control" id="marca" name="marca" value="<?= $value['marca'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="modelo">Modelo</label>
                                                            <input type="text" class="form-control" id="modelo" name="modelo" value="<?= $value['modelo'] ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="" for="estado">Fecha de Fabricacion</label>
                                                            <input type="date" class="form-control" min="1900-01-01" id="anoFabricacion" name="anoFabricacion" value="<?= $value['fecha_fabricacion'] ?>" required  />
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
                    <?php if($dataUser['bienesD'] == "1"){ ?>
                            <div class="modal fade" id="delete_mueble<?= $key ?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="bienes/delete_muebles" method="POST">
                                        <input type="hidden" readonly name="placa" value="<?= $value['placa'] ?>" required />
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Eliminar Mueble</h4>
                                            </div>
                                            <div class="modal-body">
                                                ¿Seguro de Eliminar el mueble? <strong>Placa: <?= $value['placa'] ?></strong> 
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
        <form action="bienes/add_muebles" method="POST">
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
                                                datos += '<?php foreach($mantenimientomuebles as $keyMM => $valueMM){ ?>';                    
                                                    datos += '<option value="<?= $valueMM["tipo_mueble"] ?>"><?= $valueMM["tipo_mueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="placa'+i+'"><span style="color:red">* </span>Placa: </label>';
                                            datos += '<input type="text" class="form-control" pattern="^([a-zA-Z]{3})([0-9]{4})$" id="placa'+i+'" name="placa'+i+'" placeholder="Placa: xxx1234" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="tipoBien'+i+'"><span style="color:red">* </span>Tipo de Bien: </label>';
                                            // datos += '<input type="text" class="form-control" id="tipoBien'+i+'" name="tipoBien'+i+'" placeholder="Tipo de Bien" required />';
                                            datos += '<select class="form-control" name="tipoBien'+i+'" id="tipoBien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($tipomuebles as $keyTM => $valueTM){ ?>';                    
                                                    datos += '<option value="<?= $valueTM["tipo_mueble"] ?>"><?= $valueTM["tipo_mueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ActividadEconomica"><span style="color:red">* </span>Categoria: </label>';
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
                                            datos += '<label class="" for="CategoriaRiesgo"><span style="color:red">* </span>Subcategoria: </label>';
                                            datos += '<select class="form-control" name="categoriariesgo'+i+'" id="CategoriaRiesgo" required >';
                                                datos += '<option></option>';
                                                datos += '<?php foreach($subcategoria as $keySubC => $valueSubC){ ?>'; 
                                                    datos += '<option value="<?= $valueSubC["ID"] ?>"><?= $valueSubC["subcategoria"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="marca'+i+'"><span style="color:red">* </span>Marca: </label>';
                                            datos += '<input type="text" class="form-control" id="marca'+i+'" name="marca'+i+'" placeholder="Marca" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="modelo'+i+'"><span style="color:red">* </span>Modelo: </label>';
                                            datos += '<input type="text" class="form-control" id="modelo'+i+'" name="modelo'+i+'" placeholder="Modelo" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="anoFabricacion'+i+'"><span style="color:red">* </span>Año de Fabricacion: </label>';
                                            datos += '<input type="date" class="form-control" min="1900-01-01" id="anoFabricacion'+i+'" name="anoFabricacion'+i+'" placeholder="Año de Fabricacion:" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="numeroMotor'+i+'"><span style="color:red">* </span>Numero De Motor: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="numeroMotor'+i+'" name="numeroMotor'+i+'" placeholder="Numero de Motor" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="numeroChasis'+i+'"><span style="color:red">* </span>Numero de Chasis: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="numeroChasis'+i+'" name="numeroChasis'+i+'" placeholder="Numero de Chasis" required />';
                                        datos += '</div>';
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
        <form action="bienes/add_muebles" method="POST">
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
                                            // datos += '<input type="text" class="form-control" id="claseBien" name="clasebien'+i+'" placeholder="Clase del Bien" required />';
                                            datos += '<select class="form-control" name="clasebien'+i+'" id="clasebien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($mantenimientomuebles as $keyMM => $valueMM){ ?>';                    
                                                    datos += '<option value="<?= $valueMM["tipo_mueble"] ?>"><?= $valueMM["tipo_mueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="placa'+i+'"><span style="color:red">* </span>Placa: </label>';
                                            datos += '<input type="text" class="form-control" pattern="^([a-zA-Z]{3})([0-9]{4})$" id="placa'+i+'" name="placa'+i+'" placeholder="Placa: xxx1234" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="tipoBien'+i+'"><span style="color:red">* </span>Tipo de Bien: </label>';
                                            // datos += '<input type="text" class="form-control" id="tipoBien'+i+'" name="tipoBien'+i+'" placeholder="Tipo de Bien" required />';
                                            datos += '<select class="form-control" name="tipoBien'+i+'" id="tipoBien'+i+'" required >';
                                                datos += '<option value=""></option>';
                                                datos += '<?php foreach($tipomuebles as $keyTM => $valueTM){ ?>';                    
                                                    datos += '<option value="<?= $valueTM["tipo_mueble"] ?>"><?= $valueTM["tipo_mueble"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="ActividadEconomica"><span style="color:red">* </span>Categorías: </label>';
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
                                                datos += '<option></option>';
                                                datos += '<?php foreach($subcategoria as $keySubC => $valueSubC){ ?>'; 
                                                    datos += '<option value="<?= $valueSubC["ID"] ?>"><?= $valueSubC["subcategoria"] ?></option>';
                                                datos += '<?php } ?>';
                                            datos += '</select>';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="marca'+i+'"><span style="color:red">* </span>Marca: </label>';
                                            datos += '<input type="text" class="form-control" id="marca'+i+'" name="marca'+i+'" placeholder="Marca" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="modelo'+i+'"><span style="color:red">* </span>Modelo: </label>';
                                            datos += '<input type="text" class="form-control" id="modelo'+i+'" name="modelo'+i+'" placeholder="Modelo" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="anoFabricacion'+i+'"><span style="color:red">* </span>Año de Fabricacion: </label>';
                                            datos += '<input type="date" class="form-control" min="1900-01-01" id="anoFabricacion'+i+'" name="anoFabricacion'+i+'" placeholder="Año de Fabricacion:" required  />';
                                        datos += '</div>';
                                    datos += '</div>';
                                datos += '</div>';
                                
                                
                                datos += '<div class="col-md-12">';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="numeroMotor'+i+'"><span style="color:red">* </span>Numero De Motor: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="numeroMotor'+i+'" name="numeroMotor'+i+'" placeholder="Numero de Motor" required />';
                                        datos += '</div>';
                                    datos += '</div>';
                                    datos += '<div class="col-md-6">';
                                        datos += '<div class="form-group">';
                                            datos += '<label class="" for="numeroChasis'+i+'"><span style="color:red">* </span>Numero de Chasis: </label>';
                                            datos += '<input type="number" min="0" class="form-control" id="numeroChasis'+i+'" name="numeroChasis'+i+'" placeholder="Numero de Chasis" required />';
                                        datos += '</div>';
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
