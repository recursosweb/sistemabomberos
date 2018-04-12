<?php

class Sistema extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
        error_reporting(-1);
   //     ini_set('display_errors', '1');
        date_default_timezone_set('America/Guayaquil');
        $this->load->library('M_pdf');
    }

    public function header() {
        $cookie = get_cookie('usuario');
        if($cookie){
            $this->load->view('header', $this->data);
        }else{
            header('location:'.base_url().'login');
        }
    }

    // categorias de riesgos
    public function categoria_riesgos() {
        $this->data['Cat_riesgos'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->header();
        $this->load->view('Sistema/categoria_riesgos', $this->data);
        $this->footer();
    }
    
    public function update_catRiesgo(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_cat']);
            $codigoPermiso= htmlspecialchars($post['codigoPermiso']);
            $datos = array('id_permiso' => $codigoPermiso);
            $this->universal->update('categoria_riesgo',$datos,array('ID' => $codigo));
            $this->session->set_flashdata('UpdateCat_Riesgos','Actualizacion realiazada con exito!');
            header('location:'.base_url().'categoria_riesgos');
        }
    }
    
    public function addCat_Riesgo(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigoPermiso = htmlspecialchars($post['codigoPermiso']);
            $NombreCate= htmlspecialchars($post['nombreCate']);
            $nombre_comercial = strtoupper($NombreCate);
            $data = $this->universal->query('SELECT * FROM categoria_riesgo WHERE nombre_comercial = "'.$nombre_comercial.'" ');
            if(!$data){
	            $datos = array('nombre_comercial' => $nombre_comercial, 'id_permiso' => $codigoPermiso);
	            $this->universal->insert('categoria_riesgo', $datos);
	            $this->session->set_flashdata('AddCat_Riesgos','Registrada nueva Categoria!');
	            header('location:'.base_url().'categoria_riesgos');
            }else{
            	$this->session->set_flashdata('AddCat_RiesgosExist','La categoria ya existe!');
	            header('location:'.base_url().'categoria_riesgos');
            }
        }
    }
    
    public function delete_catRiesgo(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_cat']);
            $this->universal->delete('categoria_riesgo',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminada la categoria!');
            header('location:'.base_url().'categoria_riesgos');
        }
    }
    
    // mantenimiento de rubros
    public function valor_permisos(){
        $this->data['valorPermisos'] = $this->universal->query('SELECT * FROM mantenimiento_rubro');
        $this->data['código_permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->data['categoria_riesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['subcategoria'] = $this->universal->query('SELECT * FROM subcategoria');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('Sistema/valor_permisos', $this->data);
        $this->footer();
    }
    
    public function addGestionValores(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            // periodo
            $porcionePeriodo = explode('|', $post['periodo']);
            $periodo = $porcionePeriodo[1];
            $id_periodo = $porcionePeriodo[0];
            // categoria
            $porcioneCategoria = explode('|', $post['categoria']);
            $categoria = $porcioneCategoria[1];
            $id_categoria = $porcioneCategoria[0];
            // permiso
            $porcionePermiso = explode('|', $post['permiso']);
            $permiso = $porcionePermiso[1];
            $id_permiso = $porcionePermiso[0];
            // subcategoria
            $porcioneSubCategoria = explode('|', $post['subcategoria']);
            $subcategoria = $porcioneSubCategoria[1];
            $id_subcategoria = $porcioneSubCategoria[0];
            // valor
            $valor = $post['valor'];

            $sql = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' AND id_permiso = '.$id_permiso.' AND id_categoria = '.$id_categoria.' AND id_subcategoria = '.$id_subcategoria.' ');
            if(!$sql){
                $datos = array(
                    'periodo'           => $periodo, 
                    'id_periodo'        => $id_periodo, 
                    'permiso'           => $permiso, 
                    'id_permiso'        => $id_permiso, 
                    'categoria'         => $categoria, 
                    'id_categoria'      => $id_categoria, 
                    'subcategoria'      => $subcategoria, 
                    'id_subcategoria'   => $id_subcategoria, 
                    'valor'             => $valor, 
                );
                $this->universal->update('subcategoria',array('status' => 1),array('ID' => $id_subcategoria));
                $this->universal->update('periodos',array('status' => 1),array('ID' => $id_periodo));
                $this->universal->insert('mantenimiento_rubro', $datos);
                $this->session->set_flashdata('Success','Agregada  nueva gestion de valores!');
                header('location:'.base_url().'valor_permisos');

            }else{
                $this->session->set_flashdata('ExistGestion','Ya ha realizado esta gestion de valores!');
                header('location:'.base_url().'valor_permisos');
            }
        }
    }

    public function UpdateGestionValores(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $id_valor = htmlspecialchars($post['id_valor']);
            $valor = htmlspecialchars($post['valor']);
            $this->universal->update('mantenimiento_rubro',array('valor' => $valor),array('ID' => $id_valor));
            $this->session->set_flashdata('SuccessUpdate','Actualizado el valor!');
            header('location:'.base_url().'valor_permisos');
        }
    }

    public function DeleteGestionValores(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $id_valor = htmlspecialchars($post['id_valor']);
            $this->universal->delete('mantenimiento_rubro',array('ID' => $id_valor));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminada la gestion de valores!');
            header('location:'.base_url().'valor_permisos');
        }
    }

    
    // mantenimiento inmuebles
    public function mantenimiento_inmuebles(){
        $this->data['mantenimiento_inmuebles'] = $this->universal->query('SELECT * FROM mantenimiento_inmuebles');
        $this->header();
        $this->load->view('Sistema/mantenimiento_inmuebles', $this->data);
        $this->footer();
    }

    public function addMantenimiento_Inmueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $tipoInmueble= htmlspecialchars($post['tipoInmueble']);
            $datos = array('tipo_imueble' => $tipoInmueble);
            $this->universal->insert('mantenimiento_inmuebles', $datos);
            $this->session->set_flashdata('AddCat_Riesgos','Registrado nuevo Inmueble!');
            header('location:'.base_url().'mantenimiento_inmuebles');
        }
    }
    
    public function update_Mantenimiento_Inmueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_TipoInmueble']);
            $tipoInmueble= htmlspecialchars($post['tipoInmueble']);
            $datos = array('tipo_imueble' => $tipoInmueble);
            $this->universal->update('mantenimiento_inmuebles',$datos,array('ID' => $codigo));
            $this->session->set_flashdata('UpdateCat_Riesgos','Actualizacion realiazada con exito!');
            header('location:'.base_url().'mantenimiento_inmuebles');
        }
    }
    
    public function delete_TipoInmueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['tipoinmueble']);
            $this->universal->delete('mantenimiento_inmuebles',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminado el tipo de inmueble!');
            header('location:'.base_url().'mantenimiento_inmuebles');
        }
    }
    
    // mantenimiento muebles
    public function mantenimiento_muebles(){
        $this->data['mantenimiento_muebles'] = $this->universal->query('SELECT * FROM mantenimiento_muebles');
        $this->header();
        $this->load->view('Sistema/mantenimiento_muebles', $this->data);
        $this->footer();
    }

    public function addMantenimiento_mueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $tipomueble= htmlspecialchars($post['tipomueble']);
            $datos = array('tipo_mueble' => $tipomueble);
            $this->universal->insert('mantenimiento_muebles', $datos);
            $this->session->set_flashdata('AddCat_Riesgos','Registrado nuevo Mueble!');
            header('location:'.base_url().'mantenimiento_muebles');
        }
    }
    
    public function update_Mantenimiento_mueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_Tipomueble']);
            $tipomueble= htmlspecialchars($post['tipomueble']);
            $datos = array('tipo_mueble' => $tipomueble);
            $this->universal->update('mantenimiento_muebles',$datos,array('ID' => $codigo));
            $this->session->set_flashdata('UpdateCat_Riesgos','Actualizacion realiazada con exito!');
            header('location:'.base_url().'mantenimiento_muebles');
        }
    }
    
    public function delete_Tipomueble(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['tipomueble']);
            $this->universal->delete('mantenimiento_muebles',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminado el tipo de inmueble!');
            header('location:'.base_url().'mantenimiento_muebles');
        }
    }
    
    // mantenimiento de tipos de inmuebles
    public function tipo_inmuebles(){
        $this->data['tipo_inmuebles'] = $this->universal->query('SELECT * FROM tipo_inmuebles');
        $this->header();
        $this->load->view('Sistema/tipo_inmuebles', $this->data);
        $this->footer();
    }

    public function addtipoInmuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $tipoinmueble= htmlspecialchars($post['tipoInmueble']);
            $datos = array('tipo_imueble' => $tipoinmueble);
            $this->universal->insert('tipo_inmuebles', $datos);
            $this->session->set_flashdata('AddCat_Riesgos','Registrado nuevo Tipo de Bien!');
            header('location:'.base_url().'tipo_inmuebles');
        }
    }
    
    public function update_tipoInmuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_TipoInmueble']);
            $tipoinmueble= htmlspecialchars($post['tipoInmueble']);
            $datos = array('tipo_imueble' => $tipoinmueble);
            $this->universal->update('tipo_inmuebles',$datos,array('ID' => $codigo));
            $this->session->set_flashdata('UpdateCat_Riesgos','Actualizacion realiazada con exito!');
            header('location:'.base_url().'tipo_inmuebles');
        }
    }
    
    public function delete_tipoInmuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['tipoinmueble']);
            $this->universal->delete('tipo_inmuebles',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminado el tipo de bien!');
            header('location:'.base_url().'tipo_inmuebles');
        }
    }
    
    // mantenimiento de tipos de muebles
    public function tipo_muebles(){
        $this->data['tipo_muebles'] = $this->universal->query('SELECT * FROM tipo_muebles');
        $this->header();
        $this->load->view('Sistema/tipo_muebles', $this->data);
        $this->footer();
    }

    public function addtipomuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $tipomueble= htmlspecialchars($post['tipomueble']);
            $datos = array('tipo_mueble' => $tipomueble);
            $this->universal->insert('tipo_muebles', $datos);
            $this->session->set_flashdata('AddCat_Riesgos','Registrado nuevo Tipo de Bien!');
            header('location:'.base_url().'tipo_muebles');
        }
    }
    
    public function update_tipomuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['codigo_Tipomueble']);
            $tipomueble= htmlspecialchars($post['tipomueble']);
            $datos = array('tipo_mueble' => $tipomueble);
            $this->universal->update('tipo_muebles',$datos,array('ID' => $codigo));
            $this->session->set_flashdata('UpdateCat_Riesgos','Actualizacion realiazada con exito!');
            header('location:'.base_url().'tipo_muebles');
        }
    }
    
    public function delete_tipomuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['tipomueble']);
            $this->universal->delete('tipo_muebles',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Eliminado el tipo de bien!');
            header('location:'.base_url().'tipo_muebles');
        }
    }

// periodos
    public function periodos(){
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('Sistema/periodos', $this->data);
        $this->footer();
    }

    public function AddPeriodo(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $periodo = htmlspecialchars($post['periodo']);
            $datos = array('periodo' => $periodo);
            $this->universal->insert('periodos', $datos);
            $this->session->set_flashdata('AddCat_Riesgos','Periodo Registrado!');
            header('location:'.base_url().'periodos');
        }
    }

    public function DeletePeriodo(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['ID']);
            $this->universal->delete('periodos',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','Periodo Eliminado!');
            header('location:'.base_url().'periodos');
        }
    }
// subcategorias
    public function subcategorias(){
        $this->data['subcategorias'] = $this->universal->query('SELECT * FROM subcategoria');
        $this->header();
        $this->load->view('Sistema/subcategorias', $this->data);
        $this->footer();
    }

    public function Addsubcategorias(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $subcategoria1 = htmlspecialchars($post['subcategoria']);
            $subcategoria = strtoupper($subcategoria1);
            $sql = $this->universal->query('SELECT * FROM subcategoria WHERE subcategoria = "'.$subcategoria.'"');  
            if(!$sql){
                $datos = array('subcategoria' => $subcategoria);
                $this->universal->insert('subcategoria', $datos);
                $this->session->set_flashdata('AddCat_Riesgos','subcategoria Registrada!');
                header('location:'.base_url().'subcategorias');

            }else{
                $this->session->set_flashdata('ExistSubcategoria','La subcategoria ya existe!');
                header('location:'.base_url().'subcategorias');
            }
        }
    }

    public function Deletesubcategorias(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $codigo = htmlspecialchars($post['ID']);
            $this->universal->delete('subcategoria',array('ID' => $codigo));
            $this->session->set_flashdata('deleteCat_Riesgos','subcategoria Eliminada!');
            header('location:'.base_url().'subcategorias');
        }
    }

// vista de gestion de codigos de productos

    public function codigo_permisos(){
        $this->data['codigo_permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->header();
        $this->load->view('Sistema/permisos', $this->data);
        $this->footer();
    }

    public function reportes() {
        $this->data['código_permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->header();
        $this->load->view('Sistema/reportes', $this->data);
        $this->footer();
    }

    public function getValorRecaudado(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $permiso = htmlspecialchars($post['permiso']);
            $fechaDesde = htmlspecialchars($post['fechaDesde']);
            $fechaHasta = htmlspecialchars($post['fechaHasta']);
            if($permiso == "0"){
                $sql = $this->universal->query('SELECT * FROM reportes_ingresos WHERE fecha BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'" ');
                // debug($sql);
                $valorPF = 0;//permiso de funcionamiento
                $valorPC = 0;//permiso de construccion
                $valorPR = 0;//permiso de rodaje
                $valorPO = 0;//permiso ocasional
                $valorPI = 0;//permiso de inspeccion
                $valorCA = 0;//certificado de no audeudar

                foreach ($sql as $key => $value) {
                    if($value['id_permiso'] == "100"){ //permiso de funcionamiento
                        $valorPF = $valorPF + $value['valor'];
                    }
                    if($value['id_permiso'] == "200"){//permiso de construccion
                        $valorPC = $valorPC + $value['valor'];
                    }
                    if($value['id_permiso'] == "300"){//permiso de rodaje
                        $valorPR = $valorPR + $value['valor'];
                    }
                    if($value['id_permiso'] == "400"){//permiso ocasional
                        $valorPO = $valorPO + $value['valor'];
                    }
                    if($value['id_permiso'] == "500"){//permiso de inspeccion
                        $valorPI = $valorPI + $value['valor'];
                    }
                    if($value['id_permiso'] == "600"){//certificado de no audeudar
                        $valorCA = $valorCA + $value['valor'];
                    }
                }

                $TotalPermiso = $valorPF + $valorPC + $valorPR + $valorPO + $valorPI + $valorCA;

                $Valores = array(
                    'nombre1'   => 'Permiso de Funcionamiento', 
                    'valor1'    => $valorPF, 

                    'nombre2'   => 'Permiso de Construccion', 
                    'valor2'    => $valorPC, 

                    'nombre3'   => 'Permiso de Rodaje', 
                    'valor3'    => $valorPR, 

                    'nombre4'   => 'Permiso Ocasional', 
                    'valor4'    => $valorPO, 

                    'nombre5'   => 'Solicitud de Inspeccion', 
                    'valor5'    => $valorPI,

                    'nombre6'   => 'Certificado de no audeudar', 
                    'valor6'    => $valorCA,

                    'total'     => $TotalPermiso,    

                );
                echo json_encode($Valores);
            }else{
                $sql = $this->universal->query('SELECT * FROM reportes_ingresos WHERE fecha BETWEEN "'.$fechaDesde.'" AND "'.$fechaHasta.'" AND id_permiso = '.$permiso.' ');
                if($sql){
                    $valor = 0;
                    foreach ($sql as $key => $value) {
                        $valor = $valor + $value['valor'];
                    }
                    $Valores = array(
                        'nombrePermiso'=> $sql[0]['permiso'], 
                        "valor" => $valor, 
                    );

                    echo json_encode($Valores);
                }else{
                    echo json_encode("0");
                }
                
            }
        }
    }

    public function ImprimirReportes(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $ruta = base_url();
            if(isset($post['nombre1']) && isset($post['nombre2']) && isset($post['nombre3']) && isset($post['nombre4']) && isset($post['nombre5'])){
                
                $PFuncionamiento = htmlspecialchars($post['nombre1']);
                $valorPF = htmlspecialchars($post['valor1']);

                $PConstruccion= htmlspecialchars($post['nombre2']);
                $valorPC = htmlspecialchars($post['valor2']);

                $PRodaje = htmlspecialchars($post['nombre3']);
                $valorPR = htmlspecialchars($post['valor3']);

                $POcasional = htmlspecialchars($post['nombre4']);
                $valorPO = htmlspecialchars($post['valor4']);

                $SolicitudInspeccion = htmlspecialchars($post['nombre5']);
                $valorSI = htmlspecialchars($post['valor5']);

                $CertificadoNoAudeudar = htmlspecialchars($post['nombre6']);
                $valorCNA = htmlspecialchars($post['valor6']);
                
                $total = htmlspecialchars($post['valor']);

                $fechaDesde = htmlspecialchars($post['fechaDesde']);
                $fechaHasta = htmlspecialchars($post['fechaHasta']);

                $html = '<? session_start() ?> 
                                <!DOCTYPE html>
                                <html lang="es">
                                    <head>
                                    
                                    </head>
                                    <body>
                                        <div style="width: 30%; float: left" >
                                            <img src="'.$ruta.'img/logo1.png">
                                        </div>
                                        <div>
                                            <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                            <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                            <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">Reporte de Ingreso</h5>
                                        </div>
                                        <br><br><br><br>
                                        <div>
                                            <strong><h5 style="text-align:center;">Reporte de ingresos DESDE: '.$fechaDesde.' HASTA: '.$fechaHasta.'</h5></strong>
                                            <h5>'.$PFuncionamiento.': <strong style="border-bottom: 1px solid;">$'.$valorPF.'</strong></h5>
                                            <h5>'.$PConstruccion.': <strong style="border-bottom: 1px solid;">$'.$valorPC.'</strong></h5>
                                            <h5>'.$PRodaje.': <strong style="border-bottom: 1px solid;">$'.$valorPR.'</strong></h5>
                                            <h5>'.$POcasional.': <strong style="border-bottom: 1px solid;">$'.$valorPO.'</strong></h5>
                                            <h5>'.$SolicitudInspeccion.': <strong style="border-bottom: 1px solid;">$'.$valorSI.'</strong></h5>
                                            <h5 style="text-align:center;">Total : <strong style="border-bottom: 1px solid;">$'.$total.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                        </div>
                                    </body>
                                </html>
                                ';
                                $pdfFilePath = "ReportesIngresos".$fechaDesde."|".$fechaHasta.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                                // echo $html;
            }elseif(isset($post['nombre'])){
                
                $fechaDesde = htmlspecialchars($post['fechaDesde']);
                $fechaHasta = htmlspecialchars($post['fechaHasta']);

                $nombre = htmlspecialchars($post['nombre']);
                $valor = htmlspecialchars($post['valor']);

                $html = '<? session_start() ?> 
                                <!DOCTYPE html>
                                <html lang="es">
                                    <head>
                                    
                                    </head>
                                    <body>
                                        <div style="width: 30%; float: left" >
                                            <img src="'.$ruta.'img/logo1.png">
                                        </div>
                                        <div>
                                            <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                            <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                            <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">Reporte de Ingreso de: '.$nombre.'</h5>
                                        </div>
                                        <br><br><br><br>
                                        <div>
                                            <strong><h5 style="text-align:center;">Reporte de ingresos DESDE: '.$fechaDesde.' HASTA: '.$fechaHasta.'</h5></strong>
                                            <h5>'.$nombre.': <strong style="border-bottom: 1px solid;">$'.$valor.'</strong></h5>
                                            <h5 style="text-align:center;">Total : <strong style="border-bottom: 1px solid;">$'.$valor.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                        </div>
                                    </body>
                                </html>
                                ';
                                $pdfFilePath = "ReportesIngresos".$fechaDesde."|".$fechaHasta.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                                // echo $html;
            }
        }
    }


// Solicitud de inspeccion

    public function solicitud_inspeccion(){
        $this->data['codigo_permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->data['persona'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresa'] = $this->universal->query('SELECT * FROM empresa');
        $this->header();
        $this->load->view('Sistema/solicitud_inspeccion', $this->data);
        $this->footer();
    }

    public function GetBienesSoliInsP(){
        $post = $this->input->post();
        if($post){
            $persona = htmlspecialchars($post['persona']);
            $TipoBien = htmlspecialchars($post['tipoBien']);
            if($TipoBien == "I"){
                $sql = $this->universal->query('SELECT * FROM inmuebles WHERE id_propietario = "'.$persona.'"');
                if($sql){
                    echo json_encode($sql);
                }else{
                    echo json_encode("0");//no hay bienes para esta persona
                }
            }
            if($TipoBien == "M"){
                $sql = $this->universal->query('SELECT * FROM mueble WHERE id_propietario = "'.$persona.'"');
                if($sql){
                    echo json_encode($sql);
                }else{
                    echo json_encode("0");//no hay bienes para esta persona
                }
            }
        }
    }
    
    public function ImprimirSolicitudInpsP(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $persona = htmlspecialchars($post['persona']);
            $tipoBien = htmlspecialchars($post['tipoBien']);
            $porciones = explode('|', $post['bien']);
            $subcategoria = $porciones[0];
            $categoria = $porciones[1];
            $clave_catastral = $porciones[2];

            $sqlV = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_permiso = 500 and id_categoria = '.$categoria.' and id_subcategoria = '.$subcategoria.' ');
            if($sqlV){
                $total_permiso = $sqlV[0]['valor'];
                $sqlB = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = '.$clave_catastral.' ');

                $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = '.$persona.' ');

                $ruta = base_url();
                $fechaActual = date("Y-m-d");
                function nPermiso(){
                    $an = "0123456789";
                    $su = strlen($an) - 1;
                    return  substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1);
                            substr($an, rand(0, $su), 1);
                }
                $n_permiso = nPermiso();
                $html = '<? session_start() ?> 
                            <!DOCTYPE html>
                            <html lang="es">
                                <head>
                                
                                </head>
                                <body>
                                    <div style="width: 30%; float: left" >
                                        <img src="'.$ruta.'img/logo1.png">
                                    </div>
                                    <div>
                                        <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                        <h5 style="text-align: center;">DEPARTAMENTO DE TESORERIA</h5>
                                        <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                        <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                        <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                        <h5 style="text-align: center;">SOLICITUD DE INSPECCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>IDENTIFICACION: <strong style="border-bottom: 1px solid;">'.$sqlP[0]['cedula'].'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$sqlP[0]["nombres"].' '.$sqlP[0]["apellidos"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["ubicacion"].'</strong></h5>
                                        <br><br>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <br><br><br>
                                        <h5 style="">CONTRIBUYENTE: _______________________</h5>
                                        <br>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "SolicitudInspeccion-".$n_permiso.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;

            }else{
                $this->session->set_flashdata('GestiionValores','Revise la gestion de valores!');
                header('location:'.base_url().'solicitud_inspeccion');
            }
        }
    }

    public function GetBienesSoliInsE(){
        $post = $this->input->post();
        if($post){
            $persona = htmlspecialchars($post['persona']);
            $TipoBien = htmlspecialchars($post['tipoBien']);
            if($TipoBien == "I"){
                $sql = $this->universal->query('SELECT * FROM inmuebles WHERE id_propietario = "'.$persona.'"');
                if($sql){
                    echo json_encode($sql);
                }else{
                    echo json_encode("0");//no hay bienes para esta persona
                }
            }
            if($TipoBien == "M"){
                $sql = $this->universal->query('SELECT * FROM mueble WHERE id_propietario = "'.$persona.'"');
                if($sql){
                    echo json_encode($sql);
                }else{
                    echo json_encode("0");//no hay bienes para esta persona
                }
            }
        }
    }
    
    public function ImprimirSolicitudInpsE(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $persona = htmlspecialchars($post['persona']);
            $tipoBien = htmlspecialchars($post['tipoBien']);
            $porciones = explode('|', $post['bien']);
            $subcategoria = $porciones[0];
            $categoria = $porciones[1];
            $clave_catastral = $porciones[2];

            $sqlV = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_permiso = 500 and id_categoria = '.$categoria.' and id_subcategoria = '.$subcategoria.' ');
            // debug($persona);
            if($sqlV){
                $total_permiso = $sqlV[0]['valor'];
                $sqlB = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = '.$clave_catastral.' ');

                $sqlP = $this->universal->query('SELECT * FROM empresa WHERE ruc = '.$persona.' ');

                $ruta = base_url();
                $fechaActual = date("Y-m-d");
                function nPermiso(){
                    $an = "0123456789";
                    $su = strlen($an) - 1;
                    return  substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1) .
                            substr($an, rand(0, $su), 1);
                            substr($an, rand(0, $su), 1);
                }
                $n_permiso = nPermiso();
                $html = '<? session_start() ?> 
                            <!DOCTYPE html>
                            <html lang="es">
                                <head>
                                
                                </head>
                                <body>
                                    <div style="width: 30%; float: left" >
                                        <img src="'.$ruta.'img/logo1.png">
                                    </div>
                                    <div>
                                        <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                        <h5 style="text-align: center;">DEPARTAMENTO DE TESORERIA</h5>
                                        <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                        <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                        <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                        <h5 style="text-align: center;">SOLICITUD DE INSPECCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>IDENTIFICACION: <strong style="border-bottom: 1px solid;">'.$sqlP[0]['ruc'].'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$sqlP[0]["nombre_empresa"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$sqlB[0]["ubicacion"].'</strong></h5>
                                        <br><br>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <br><br><br>
                                        <h5 style="">CONTRIBUYENTE: _______________________</h5>
                                        <br>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "SolicitudInspeccion-".$n_permiso.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;

            }else{
                // echo "como estas";
                $this->session->set_flashdata('GestiionValores','Revise la gestion de valores!');
                header('location:'.base_url().'solicitud_inspeccion');
            }
        }
    }

    public function footer() {
        $this->load->view('footer', $this->data);
    }

    

}

?>