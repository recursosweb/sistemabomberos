<div class="panel panel-info" style="margin-top: 40px">
	<div class="panel-heading">
		<h3 class="panel-title">Calculadora de Permisos</h3>
	</div>
	<div class="panel-body">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Persona</a></li>
			<li role="presentation"><a href="#profile" aria-controls="settings" role="tab" data-toggle="tab">Empresa</a></li>
		</ul>

  <!-- Tab panes -->
	<div class="tab-content">
<!-- personas -->
		<div role="tabpanel" class="tab-pane active" id="home">
			<div class="col-md-12">
<form action="panel/imprimerTotalPermiso" method="POST">
				<div class="col-md-6">
	                <div class="form-group">
	                    <label class="" for="persona"><span style="color:red">* </span>Persona: </label>
	                    <select class="form-control" name="contribuyente" id="persona" required>
	                            <option value=""></option>
	                        <?php foreach($persona as $key => $value){ ?>                    
	                            <option value="<?= $value['cedula'] ?>"><?= $value['nombres'] ?> | <?= $value['apellidos'] ?> | <?= $value['cedula'] ?></option>
	                        <?php } ?>
	                    </select>
	                </div>
				</div>
				<div class="col-md-6">
	                <div class="form-group">
	                    <label class="" for="tipoBien"><span style="color:red">* </span>Tipo de Bien: </label>
	                    <select class="form-control" name="tipoBien" id="tipoBien" required>
	                            <option></option>
	                            <option value="I">Inmueble</option>
	                            <option value="M">Mueble</option>
	                    </select>
	                </div>
				</div>

			<div class="col-md-12" id="resto">
				<div id="resto1">
					
				</div>

				<div>
					<div class="col-md-6">
		                <div class="form-group">
		                    <label class="" for="tipoBien"><span style="color:red">* </span>Permisos: </label>
			                    <select class="form-control" name="Permiso" id="Permiso" required>
			                    		<option></option>
		                            <?php foreach($permisos as $keyP => $valueP){ ?>                
			                            <option value="<?= $valueP["ID"] ?>|<?= $valueP["permiso"] ?>"> <?= $valueP["permiso"] ?></option>
			                        <?php } ?>
		                    	</select>
		                </div>
					</div>
				</div>
			</div>
			<div class="col-md-12" id="totalPermiso">
				<div class="form-group">
                    <label class="" for="contribuyente" id="Titulo">Contribuyente</label>
                    <input type="text" readonly class="form-control" id="valor" name="valor" value="" style="background: transparent;border: none;" />
                </div>
			</div>

			<div id="evaluando"></div>

				<button id="buscarBienes" type="button" class="btn btn-primary pull-right">Buscar</button>
				<button id="CalculaBien" type="button" class="btn btn-info">Calcular</button>
				<button id="Enviar" type="submit" class="btn btn-warning text-center">Imprimir</button>
</form>
		
            </div>
		</div>
		<script>
			$(document).ready(function() {
				$('#resto').hide();
				$('#CalculaBien').hide();
				$('#totalPermiso').hide();
				$('#Enviar').hide();


				var contribuyente = "";
				var tipoBien = "";
				var bien = "";
				var ValorPermiso = "";
				var ValorTPer = "";

				$("select#tipoBien").change(function(){
					tipoBien = $('#tipoBien').val();
				});

				$("select#persona").change(function(){
					contribuyente = $('#persona').val();
				});

					$('#buscarBienes').click(function(event) {
						console.log(contribuyente+tipoBien);
						parametros = {'contribuyente' : contribuyente, 'tipoBien' : tipoBien};
						$.ajax({
							data: parametros,
							url: 'panel/getBienes',
							type: 'POST',
							beforeSend: function(){
		                        $("#evaluando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
		                    },
		                    success: function(data){
		                    	$("#evaluando").html("<i></i>");
		                    	dat = JSON.parse(data);
		                    	if(dat == "0"){
		                    		$('.bien').empty();
		                    		$('#resto').hide();
		                    		alertify.error('Este contribuyente no posee bienes registrado');
		                    	}else{
		                    		$('#resto').show();
		                    		$('#CalculaBien').show();
		                    		var datosH = '<div class="col-md-6 bien">';
		                    				datosH += '<div class="form-group">';
		                    					datosH += '<label class="" for="tipoBien"><span style="color:red">* </span>Bienes: </label>';
		                    					datosH += '<select class="form-control" name="bien" id="bien" required>';
													datosH += '<option></option>';
													for(var o =0; o < dat.length; o++){
	                                    				datosH += '<option value="'+dat[o]['id_actividad_economica']+'|'+dat[o]['categoria_riesgo']+'">'+dat[o]['clase_bien']+'</option>';
	                                				}
		                    					datosH += '</select>';
		                    				datosH += '</div>';
		                    			datosH += '</div>';

		                    			$('#resto1').html(datosH);
		        			    			// console.log(dat);

	        			    			$("select#bien").change(function(){
											bien = $('#bien').val();
										});

										$("select#Permiso").change(function(){
											ValorPermiso = $('#Permiso').val();
											// var result = $('#Permiso').val().split('|');
											// ValorTPer = result[0];
										});

										$('#CalculaBien').click(function(event) {
											var para = {'categoria' : bien, 'permiso' : ValorPermiso};
											console.log(para);
											$.ajax({
												data: para,
												url: 'panel/valorCate',
												type: 'POST',
												beforeSend: function(){
							                        $("#evaluando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
							                    },
							                    success: function(data){
							                    	$("#evaluando").html("<i></i>");
							                    	da = JSON.parse(data);
							                    	if(da == "0"){
														alertify.error('Debe selecionar un bien');
							                    	}else{
							                    		if(da == "00"){
							                    			alertify.error('No se encontro valores revise la gestion de valores');
							                    		}else{
								                    		$('#totalPermiso').show();
								                    		$('#Enviar').show();
									                    	$("#Titulo").html("El total del permiso es:");
									                    	$('#valor').val(da['valor']);
							                    		}
							                    	}
							                    }
											});
										});
		                    	}
		                    }
						});
					});
			});
		</script>

<!-- fin persona -->

<!-- empresa -->
		<div role="tabpanel" class="tab-pane" id="profile">
			<div class="col-md-12">
<form action="panel/imprimerTotalPermiso" method="POST">
				<div class="col-md-6">
	                <div class="form-group">
	                    <label class="" for="persona"><span style="color:red">* </span>Empresa: </label>
	                    <select class="form-control" name="contribuyente" id="personaE" required>
	                            <option value=""></option>
	                        <?php foreach($empresa as $keyEm => $valueEm){ ?>                    
	                            <option value="<?= $valueEm['ruc'] ?>"><?= $valueEm['nombres'] ?> | <?= $valueEm['apellidos'] ?> | <?= $valueEm['ruc'] ?></option>
	                        <?php } ?>
	                    </select>
	                </div>
				</div>
				<div class="col-md-6">
	                <div class="form-group">
	                    <label class="" for="tipoBien"><span style="color:red">* </span>Tipo de Bien: </label>
	                    <select class="form-control" name="tipoBienE" id="tipoBienE" required>
	                            <option></option>
	                            <option value="I">Inmueble</option>
	                            <option value="M">Mueble</option>
	                    </select>
	                </div>
				</div>

			<div class="col-md-12" id="restoE">
				<div id="resto1E">
					
				</div>

				<div>
					<div class="col-md-6">
		                <div class="form-group">
		                    <label class="" for="tipoBien"><span style="color:red">* </span>Permisos: </label>
			                    <select class="form-control" name="Permiso" id="PermisoE" required>
			                    		<option></option>
		                            <?php foreach($permisos as $keyP => $valuePP){ ?>                
			                            <option value="<?= $valuePP["ID"] ?>|<?= $valuePP["permiso"] ?>"> <?= $valuePP["permiso"] ?></option>
			                        <?php } ?>
		                    	</select>
		                </div>
					</div>
				</div>
			</div>

			<div class="col-md-12" id="totalPermisoE">
				<div class="form-group">
                    <label class="" for="contribuyente" id="TituloE">Contribuyente</label>
                    <input type="text" readonly class="form-control" id="valorE" name="valor" value="" style="background: transparent;border: none;" />
                </div>
			</div>

			<div id="evaluandoE"></div>

				<button id="buscarBienesE" type="button" class="btn btn-primary pull-right">Buscar</button>
				<button id="CalculaBienE" type="button" class="btn btn-info">Calcular</button>
				<button id="EnviarE" type="submit" class="btn btn-warning text-center">Imprimir</button>

            </div>
</form>
		</div>
		<script>
			$(document).ready(function() {
				$('#restoE').hide();
				$('#CalculaBienE').hide();
				$('#totalPermisoE').hide();
				$('#EnviarE').hide();

				var contribuyente = "";
				var tipoBien = "";
				var bien = "";
				var ValorPermiso = "";

				$("select#tipoBienE").change(function(){
					tipoBien = $('#tipoBienE').val();
				});

				$("select#personaE").change(function(){
					contribuyente = $('#personaE').val();
				});

					$('#buscarBienesE').click(function(event) {
						console.log(contribuyente+tipoBien);
						parametros = {'contribuyente' : contribuyente, 'tipoBien' : tipoBien};
						$.ajax({
							data: parametros,
							url: 'panel/getBienes',
							type: 'POST',
							beforeSend: function(){
		                        $("#evaluandoE").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
		                    },
		                    success: function(data){
		                    	$("#evaluandoE").html("<i></i>");
		                    	dat = JSON.parse(data);
		                    	if(dat == "0"){
		                    		$('.bienE').empty();
		                    		$('#restoE').hide();
		                    		alertify.error('Este contribuyente no posee bienes registrado');
		                    	}else{
		                    		$('#restoE').show();
		                    		$('#CalculaBienE').show();
		                    		var datosH = '<div class="col-md-6 bien">';
		                    				datosH += '<div class="form-group">';
		                    					datosH += '<label class="" for="tipoBien"><span style="color:red">* </span>Bienes: </label>';
		                    					datosH += '<select class="form-control" name="bienE" id="bienE" required>';
													datosH += '<option></option>';
													for(var o =0; o < dat.length; o++){
	                                    				datosH += '<option value="'+dat[o]['id_actividad_economica']+'|'+dat[o]['categoria_riesgo']+'">'+dat[o]['clase_bien']+'</option>';
	                                				}
		                    					datosH += '</select>';
		                    				datosH += '</div>';
		                    			datosH += '</div>';
		                    			$('#resto1E').html(datosH);
		        			    			console.log(dat);

	        			    			$("select#bienE").change(function(){
											bien = $('#bienE').val();
										});

										$("select#PermisoE").change(function(){
											ValorPermiso = $('#PermisoE').val();
											// var result = $('#PermisoE').val().split('|');
											// ValorTPer = result[0];
										});


										$('#CalculaBienE').click(function(event) {
											var para = {'categoria' : bien}
											$.ajax({
												data: para,
												url: 'panel/valorCate',
												type: 'POST',
												beforeSend: function(){
							                        $("#evaluandoE").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
							                    },
							                    success: function(data){
							                    	$("#evaluando").html("<i></i>");
							                    	da = JSON.parse(data);
							                    	if(da == "0"){
														alertify.error('Debe selecionar un bien');
							                    	}else{
							                    		if(da == "00"){
							                    			alertify.error('No se encontro valores revise la gestion de valores');
							                    		}else{
								                    		$('#totalPermisoE').show();
								                    		$('#EnviarE').show();
									                    	$("#TituloE").html("El total del permiso es:");
									                    	$('#valorE').val(da['valor']);
							                    		}
							                    	}
							                    }
											});
										});
		                    	}
		                    }
						});
					});
			});
		</script>

<!-- fin empresa -->

		</div>
	</div>
</div>s