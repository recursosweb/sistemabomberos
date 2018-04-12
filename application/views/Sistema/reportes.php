<script>
    $( "#lista1" ).last().removeClass( "active" );
    $( "#lista6" ).last().addClass( "active" );
    $( "#lista6-11" ).last().addClass( "active" );
</script>


<div class="panel panel-info" style="margin-top: 30px;">
	<div class="panel-heading">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color: white;">Reportes</a></li>
		</ul>
	</div>

	<div class="panel-body">
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="home">
				<form action="sistema/ImprimirReportes" method="POST">
					<div class="col-md-12">
                        <div class="form-group">
                            <label for="tipomueble"><span style="color:red">* </span>Permiso</label>
                            <select name="permiso" id="permiso" class="form-control" required>
                                <option value="0">Todos</option>
	                            <?php foreach ($código_permisos as $key => $value) { ?>
	                                <option value="<?= $value['ID'] ?>"><?= $value['permiso'] ?></option>
	                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipomueble"><span style="color:red">* </span> Desde</label>
                            <input type="date" value="<?= date("Y-m-d") ?>" name="fechaDesde" id="fechaDesde" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipomueble"><span style="color:red">* </span> Hasta</label>
                            <input type="date" name="fechaHasta" value="<?= date("Y-m-d") ?>" id="fechaHasta" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-12" id="datosReportes">
                    	
                    </div>

                    <button type="button" class="btn btn-primary" id="BuscarReportes">Buscar</button>
                    <button type="submit" class="btn btn-info" id="ImprimirReporte">Imprimir</button>
				</form>
				<div class="col-md-12 text-center">
					<div id="cargando"></div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#ImprimirReporte').hide();
		var permiso = $('#permiso').val();
		var fechaDesde = $('#fechaDesde').val();
		var fechaHasta = $('#fechaHasta').val();

		$('select#permiso').on('change',function(){ //PERMISO
			permiso = $('#permiso').val();
		});

		$('input#fechaDesde').on('change',function(){ // FECHA DESDE 
			fechaDesde = $('#fechaDesde').val();
		});

		$('input#fechaHasta').on('change',function(){ // FECHA HASTA 
			fechaHasta = $('#fechaHasta').val();
		});

		$("#BuscarReportes").click(function(event) {
			var parametros = {'permiso' : permiso, 'fechaDesde' : fechaDesde, 'fechaHasta' : fechaHasta};
			$.ajax({
				data: parametros,
				url: 'sistema/getValorRecaudado',
				type: 'POST',
				beforeSend: function(){
                    $("#cargando").html("<i class='fa fa-refresh fa-spin fa-3x fa-fw'></i>");
                },
                success: function (data) {
                	$("#cargando").html("<i></i>");
                    datos = JSON.parse(data);
                    if(datos == "0"){
                    	$('#datosReportes').empty();
                    	$('#ImprimirReporte').hide('slow');
                    	alertify.error('No existen reportes');
                    }else{
                    	if($('#permiso').val() == "0"){
                    		// console.log(datos);
                    		$('#ImprimirReporte').show('slow');
                    		var html = '<div class="col-md-6 text-center">';
		                    		html += '<strong><h3><input readonly name="nombre1" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['nombre1']+'"><br>$<input readonly name="valor1" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor1']+'"></h3></strong>';
		                    	html += '</div>';

		                    	html += '<div class="col-md-6 text-center">';
		                    		html += '<strong><h3><input readonly name="nombre2" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['nombre2']+'"><br>$<input readonly name="valor2" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor2']+'"></h3></strong>';
		                    	html += '</div>';

		                    	html += '<div class="col-md-4 text-center">';
		                    		html += '<strong><h3><input readonly name="nombre3" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['nombre3']+'"><br>$<input readonly name="valor3" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor3']+'"></h3></strong>';
		                    	html += '</div>';

		                    	html += '<div class="col-md-4 text-center">';
		                    		html += '<strong><h3><input readonly name="nombre4" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['nombre4']+'"><br>$<input readonly name="valor4" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor4']+'"></h3></strong>';
		                    	html += '</div>';

		                    	html += '<div class="col-md-4 text-center">';
		                    		html += '<strong><h3><input readonly name="nombre5" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['nombre5']+'"><br>$<input readonly name="valor5" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor5']+'"></h3></strong>';
		                    	html += '</div>';

		                    	html += '<div class="col-md-12 text-center">';
		                    		html += '<strong><h3>Total<br>$<input name="valor" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['total']+'"></h3></strong>';
		                    	html += '</div>';

		                    	$('#datosReportes').html(html);
                    	}else{
                    		// console.log(datos['nombrePermiso']);
                    		$('#ImprimirReporte').show('slow');
		                    	var html = '<div class="col-md-4 text-center">';
		                    		// html += '<strong><h3>'+datos['nombrePermiso']+': $'+datos['valor']+'</h3></strong>';
		                    		html += '<strong><h3><input value="'+datos['nombrePermiso']+'" readonly name="nombre" type="text" style="background: transparent;border: 0px;text-align: center;width: 100%;" value="'+datos['valor']+'"><br>$<input readonly name="valor" type="text" style="background: transparent;border: 0px;text-align: center;" value="'+datos['valor']+'"></h3></strong>';
		                    	html += '</div>';
		                    $('#datosReportes').html(html);
                    	}
                    }
                }
			});
		});
	});
</script>