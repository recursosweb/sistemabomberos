<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-12" ).last().addClass( "active" );
</script>


<div class="panel panel-info">
	<div class="panel-heading">
		<ul class="nav nav-tabs" role="tablist">
		    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color:white;">Persona</a></li>
		    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="color:white;">Empresa</a></li>
	  	</ul>
	</div>
	<div class="panel-body">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				<form action="sistema/ImprimirSolicitudInpsP" method="POST">
					<div class="col-md-6">
	                <div class="form-group">
		                    <label class="" for="persona"><span style="color:red">* </span>Persona: </label>
		                    <select class="form-control" name="persona" id="persona" required>
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
		                            <!-- <option value="M">Mueble</option> -->
		                    </select>
		                </div>
					</div>

					<div class="col-md-12" id="resto"></div>

					<div class="col-md-12 text-center">
						<button id="buscarBienes" type="button" class="btn btn-primary">Buscar</button>
						<button id="imprimir" type="submit" class="btn btn-info">Imprimir</button>
					</div>
				</form>
					<div class="col-md-12 text-center" id="cargando"></div>

				<!-- SCRIPT PARA PERSONA -->
				<script>
					$(document).ready(function() {
						$('#imprimir').hide();
						var persona = "";
						var tipoBien = "";

						$("select#persona").change(function(){
							persona = $('#persona').val();
						});

						$("select#tipoBien").change(function(){
							tipoBien = $('#tipoBien').val();
						});

						$('#buscarBienes').click(function(event) {
							if($('#persona').val() == ""){
								alertify.error('Selecione una persona');
							}else{
								if($('#tipoBien').val() == ""){
									alertify.error('Selecione un tipo de bien');
								}else{
									parametros = {'persona' : persona, 'tipoBien' : tipoBien};
									// console.log(parametros);
									$.ajax({
										data: parametros,
										url: 'sistema/GetBienesSoliInsP',
										type: 'POST',
										beforeSend: function(){
					                        $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					                    },
					                    success: function(data){
					                    	$("#cargando").html("<i></i>");
		                    				data = JSON.parse(data);
		                    				console.log(data);
		                    				if(data == "0"){
		                    					alertify.error('No existen bienes registrado para esta persona');
		                    					$('#imprimir').hide('slow');
		                    				}else{
		                    					alertify.success('si hay vienes');
		                    					var html = '<div class="col-md-12">';
									                	html += '<div class="form-group">';
										                    html += '<label class="" for="persona"><span style="color:red">* </span>Bien: </label>';
										                    html += '<select class="form-control" name="bien" id="bien" required>';
									                            html += '<option value=""></option>';
									                            for(var o =0; o < data.length; o++){
									                            	html += '<option value="'+data[0]['categoria_riesgo']+'|'+data[0]['id_actividad_economica']+'|'+data[0]['clave_catastral']+'">'+data[0]['clase_bien']+'</option>';
										                    	}
										                    html += '</select>';
										                html += '</div>';
													html += '</div>';
												$('#resto').html(html);
												$("select#bien").change(function(){
													$('#imprimir').show('slow');
													var bien = $('#tipoBien').val();
												});
		                    				}
					                    }
									});
								}
							}
						});

					});
				</script>
			</div>

			<!-- EMPRESA -->
			<div role="tabpanel" class="tab-pane" id="profile">
				<form action="sistema/ImprimirSolicitudInpsE" method="POST">
					<div class="col-md-6">
	                <div class="form-group">
		                    <label class="" for="persona"><span style="color:red">* </span>Empresa: </label>
		                    <select class="form-control" name="persona" id="personaE" required>
		                            <option value=""></option>
		                        <?php foreach($empresa as $key => $value){ ?>                    
		                            <option value="<?= $value['ruc'] ?>"><?= $value['nombre_empresa'] ?> | <?= $value['ruc'] ?></option>
		                        <?php } ?>
		                    </select>
		                </div>
					</div>
					<div class="col-md-6">
		                <div class="form-group">
		                    <label class="" for="tipoBien"><span style="color:red">* </span>Tipo de Bien: </label>
		                    <select class="form-control" name="tipoBien" id="tipoBienE" required>
		                            <option></option>
		                            <option value="I">Inmueble</option>
		                            <!-- <option value="M">Mueble</option> -->
		                    </select>
		                </div>
					</div>

					<div class="col-md-12" id="restoE"></div>

					<div class="col-md-12 text-center">
						<button id="buscarBienesE" type="button" class="btn btn-primary">Buscar</button>
						<button id="imprimirE" type="submit" class="btn btn-info">Imprimir</button>
					</div>
				</form>
					<div class="col-md-12 text-center" id="cargandoE"></div>

				<!-- SCRIPT PARA PERSONA -->
				<script>
					$(document).ready(function() {
						$('#imprimirE').hide();
						var persona = "";
						var tipoBien = "";

						$("select#personaE").change(function(){
							persona = $('#personaE').val();
						});

						$("select#tipoBienE").change(function(){
							tipoBien = $('#tipoBienE').val();
						});

						$('#buscarBienesE').click(function(event) {
							if($('#personaE').val() == ""){
								alertify.error('Selecione una persona');
							}else{
								if($('#tipoBienE').val() == ""){
									alertify.error('Selecione un tipo de bien');
								}else{
									parametros = {'persona' : persona, 'tipoBien' : tipoBien};
									// console.log(parametros);
									$.ajax({
										data: parametros,
										url: 'sistema/GetBienesSoliInsE',
										type: 'POST',
										beforeSend: function(){
					                        $("#cargandoE").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
					                    },
					                    success: function(data){
					                    	$("#cargandoE").html("<i></i>");
		                    				data = JSON.parse(data);
		                    				console.log(data);
		                    				if(data == "0"){
		                    					alertify.error('No existen bienes registrado para esta empresa');
		                    					$('#imprimirE').hide('slow');
		                    				}else{
		                    					alertify.success('si hay vienes');
		                    					var html = '<div class="col-md-12">';
									                	html += '<div class="form-group">';
										                    html += '<label class="" for="persona"><span style="color:red">* </span>Bien: </label>';
										                    html += '<select class="form-control" name="bien" id="bienE" required>';
									                            html += '<option value=""></option>';
									                            for(var o =0; o < data.length; o++){
									                            	html += '<option value="'+data[0]['categoria_riesgo']+'|'+data[0]['id_actividad_economica']+'|'+data[0]['clave_catastral']+'">'+data[0]['clase_bien']+'</option>';
										                    	}
										                    html += '</select>';
										                html += '</div>';
													html += '</div>';
												$('#restoE').html(html);
												$("select#bienE").change(function(){
													$('#imprimirE').show('slow');
													var bien = $('#tipoBienE').val();
												});
		                    				}
					                    }
									});
								}
							}
						});

					});
				</script>
			</div>
		</div>
	</div>
</div>


<?php $GestiionValores = $this->session->flashdata('GestiionValores'); ?>
<?php if($GestiionValores){ ?>
    <div class="alert alert-warning"><h3><?= $GestiionValores ?></h3></div>
<?php } ?>
