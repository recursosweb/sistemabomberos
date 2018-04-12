<?php

class Permisos extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
        error_reporting(-1);
   //     ini_set('display_errors', '1');
        date_default_timezone_set('America/Guayaquil');
    }

    public function header() {
        $cookie = get_cookie('usuario');
        if($cookie){
            $this->load->view('header', $this->data);
        }else{
            header('location:'.base_url().'login');
        }
    }
    
    public function obtenerValorCat(){
        $id = $_POST['ID'];
        $query = $this->universal->query('SELECT * FROM categoria_riesgo WHERE ID = '.$id.' ');
        if($query){
            $output_string = $query;
            echo json_encode($output_string);
        }
    }
    
    public function obtenerbienesM(){
        $id_propietario = $_POST['id_propietario'];
        $query = $this->universal->query('SELECT * FROM mueble WHERE id_propietario = "'.$id_propietario.'" and status = 0');
        if($query){
            $output_string = $query;
            echo json_encode($output_string);
        }else{
            $output_string = "0";
            echo json_encode($output_string);
        }
    }
    
    public function obtenerbienesI(){
        $id_propietario = $_POST['id_propietario'];
        $query = $this->universal->query('SELECT * FROM inmuebles WHERE id_propietario = "'.$id_propietario.'" and status = 0');
        if($query){
            $output_string = $query;
            echo json_encode($output_string);
        }else{
            $output_string = "0";
            echo json_encode($output_string);
        }
    }
    
    // permiso de funcionamiento

    public function Npermiso_funcionamiento(){
        $this->data['permisoFuncionamiento'] = $this->universal->query('SELECT * FROM permiso_funcionamiento');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoFuncionamiento/NpermisoFuncionamiento', $this->data);
        $this->footer();
    }
    
    public function add_permisoFuncionamiento(){
        // debug($_POST,false);
        // debug($_FILES);
        $datos = array();
        function nPermiso(){
                $an = "0123456789";
                $su = strlen($an) - 1;
                return  substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }

            $codigo = "00001";
            $insertCodigo = 0;
            $codigoPermiso = $this->universal->query('SELECT * FROM permiso_funcionamiento ORDER BY ID DESC LIMIT 1 ');

            if(empty($codigoPermiso)){
                $insertCodigo = $codigo;
            }else{
                $num = $codigoPermiso[0]['ID'];
                $insertCodigo = $codigo + $num;
            }

        for($x =0 ; $x <= count($_POST) ; $x++){
            if(isset($_POST['contribuyente']) and isset($_POST['selectBien'.$x]) and isset($_POST['periodo'.$x])){
                $contribuyente = $_POST['contribuyente'];
                $activoo = $_POST['selectBien'.$x];
                // debug($activoo);
                $porciones = explode("|", $activoo);
                $activo = $porciones[0]; // categoria
                $bien = $porciones[1]; // clase del bien
                $statusBien = $porciones[2]; // clave unica del bien
                $categoria = $porciones[3]; // subcategoria
                $activo2 = $_POST['periodo'.$x];
                $porciones2 = explode("|", $activo2);
                $id_periodo = $porciones2[0]; // id del periodo elegido
                $periodo = $porciones2[1]; // periodo elegido
                $fechaCreacion = date("Y-m-d");
                $fechaCaducidad = date("".$periodo."-12-31");
                $sql111 = $this->universal->query('SELECT * FROM permiso_funcionamiento WHERE id_periodo = '.$id_periodo.' and contribuyente = "'.$contribuyente.'" and id_bien = '.$statusBien.' ');
                if($sql111){
                    $this->session->set_flashdata('ExistPeriodo','No puede agregar el mismo permiso al mismo bien dos veces en el mismo periodo');
                    header('location:'.base_url().'Npermiso_funcionamiento');
                }else{
                    // aqui
                    // debug($fechaCaducidad);

                    $numeroPermiso1 = nPermiso();
                    $costo = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' and id_categoria = '.$activo.' and id_subcategoria = '.$categoria .' ');
                    // AQUI
                    if(empty($costo)){
                        $this->session->set_flashdata('NoExisteGestion','Al parecer no se ha hecho una gestion de valores!');
                        header('location:'.base_url().'Npermiso_funcionamiento');
                    }else{
                        // debug($costo);
                        $TotalPermiso = $costo[0]['valor'];
                        $numeroPermiso = "100-".$activo."-".$categoria."-".$insertCodigo;
                        // debug($TotalPermiso);

                            // BUCLE PARA GUARDAR N CANTIDAD DE IMAGENES
                            foreach ($_FILES as $key => $value){
                                $mi_imagen = $key;
                                $config['upload_path'] = "./Images/pFuncionamiento/";
                                $config['file_name'] = 'img|'.$contribuyente.'|'.''.$numeroPermiso.'';
                                $config['allowed_types'] = "gif|jpg|jpeg|png";
                                $config['max_size'] = "50000";
                                $config['max_width'] = "2000";
                                $config['max_height'] = "2000";
                        
                        	    $this->load->library('upload', $config);
                        
                                if (!$this->upload->do_upload($mi_imagen)){
                                    $data['uploadError'] = $this->upload->display_errors();
                                    echo $this->upload->display_errors();
                                    return;
                                }
                                $data['uploadSuccess'] = $this->upload->data();
                                $ruta = $data['uploadSuccess'];
                                // echo $ruta['file_name'].'<br>';
                                $datos[] = $ruta['file_name'];
                            }
                        
                        // DATOS QUE VAN HACER INTRODUCIDOS EN LA BD
                        $dato = array(
                                'contribuyente'         =>      $contribuyente,
                                'activo'                =>      $bien,
                                'fecha_creacion'        =>      $fechaCreacion,
                                'fecha_caducidad'       =>      $fechaCaducidad,
                                'informe_inspeccion'    =>      $datos[0],
                                'ruc_rise'              =>      $datos[1],
                                'pago_impuesto'         =>      $datos[4],
                                'tasa_bombero'          =>      $datos[5],
                                'cedula'                =>      $datos[2],
                                'papeleta_votacion'     =>      $datos[3],
                                'factura_extintor'      =>      $datos[6],
                                'status'                =>      1,
                                'total_permiso'         =>      $TotalPermiso,
                                'n_permiso'             =>      $numeroPermiso,
                                'categoria'             =>      $categoria,
                                'id_cate_riesgo'        =>      $activo,
                                'id_bien'               =>      $statusBien,
                                'periodo'               =>      $periodo,
                                'id_periodo'            =>      $id_periodo,
                            );
                            
                            $this->universal->insert('permiso_funcionamiento', $dato);
                            $this->universal->update('mueble',array('status' => 1),array('placa' => $statusBien));
                            $this->universal->update('inmuebles',array('status' => 1),array('clave_catastral' => $statusBien));
                            $datoUpdate = array('id_periodo' => $id_periodo, 'id_categoria' => $activo, 'id_subcategoria' => $categoria);
                            $this->universal->update('mantenimiento_rubro',array('status' => 1),$datoUpdate);

                            $datosReportes = array(
                            	'permiso' 			=> 'Permiso de funcionamiento',
                            	'id_permiso' 		=> 100,
                            	'fecha' 			=> $fechaCreacion,
                            	'valor' 			=> $TotalPermiso,
                            );
                            $this->universal->insert('reportes_ingresos', $datosReportes);
                            // debug($dato);
                        // hasta aqui
                    }
                }
            }
        }
        
        $this->session->set_flashdata('AddPermisoFuncionamiento','Permisos Agregados!');
        header('location:'.base_url().'Npermiso_funcionamiento');
    }
    
    public function RenovacionPermisoFuncionamiento(){
        $this->data['permisoFuncionamiento'] = $this->universal->query('SELECT * FROM permiso_funcionamiento');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoFuncionamiento/renovacion', $this->data);
        $this->footer();
    }
    
    public function RenovarPermiso(){
        $post = $this->input->post();
        if($post){
            // debug($post,false);
            $nPermiso = htmlspecialchars($post['nPermiso']);
            $id_periodo = htmlspecialchars($post['id_periodo']);
            $categoria = htmlspecialchars($post['activo']);
            $subcategoria = htmlspecialchars($post['categoria']);

            $fechaCreacion = date("Y-m-d");
            $fechaCaducidad = date("Y-12-31");

            $sql = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' AND  id_permiso = 100 AND id_categoria = '.$categoria.' AND id_subcategoria = '.$subcategoria.' ');
            if($sql){
                // OBTENER EL COSTO DE LA CATEGORIA DE RIESGO
                $TotalPermiso = $sql[0]['valor'];
                // debug($TotalPermiso);
                 $datos = array(
                            'fecha_creacion'            =>      $fechaCreacion, 
                            'fecha_caducidad'           =>      $fechaCaducidad,
                            'total_permiso'             =>      $TotalPermiso,
                        );
                $this->universal->update('permiso_funcionamiento',$datos,array('n_permiso' => $nPermiso));
                
                $this->session->set_flashdata('UpdateRenoPermiso','Renovacion De Permiso Exitosa!');
                header('location:'.base_url().'RenovacionPermisoFuncionamiento');
            }else{
                header('location:'.base_url().'RenovacionPermisoFuncionamiento');
            }
        }
    }
    
    
    // permiso de construccion
    
    public function Npermiso_Construccion(){
        $this->data['permisoConstruccion'] = $this->universal->query('SELECT * FROM permiso_construccion');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoConstruccion/NpermisoConstruccion', $this->data);
        $this->footer();
    }
    
    public function add_permisoConstruccion(){
        // debug($_POST,false);
        // debug($_FILES,false);
        $datos = array();
        function nPermiso(){
                $an = "0123456789";
                $su = strlen($an) - 1;
                return  substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }

            $codigo = "00001";
            $insertCodigo = 0;
            $codigoPermiso = $this->universal->query('SELECT * FROM permiso_construccion ORDER BY ID DESC LIMIT 1 ');

            if(empty($codigoPermiso)){
                $insertCodigo = $codigo;
            }else{
                $num = $codigoPermiso[0]['ID'];
                $insertCodigo = $codigo + $num;
            }

        for($x =0 ; $x <= count($_POST) ; $x++){
            if(isset($_POST['contribuyente']) and isset($_POST['selectBien'.$x])){
                $contribuyente = $_POST['contribuyente'];
                $activoo = $_POST['selectBien'.$x];
                $porciones = explode("|", $activoo);
                $activo = $porciones[0]; // categoria
                $bien = $porciones[1]; // clase del bien
                $statusBien = $porciones[2]; // clave unica del bien
                $categoria = $porciones[3]; // subcategoria

                $activo2 = $_POST['periodo'.$x];
                $porciones2 = explode("|", $activo2);
                $id_periodo = $porciones2[0]; // id del periodo elegido
                $periodo = $porciones2[1]; // periodo elegido
                $fechaCreacion = date("Y-m-d");
                $fechaCaducidad = date("".$periodo."-12-31");

                $sql111 = $this->universal->query('SELECT * FROM permiso_construccion WHERE id_periodo = '.$id_periodo.' and contribuyente = "'.$contribuyente.'" and id_bien = '.$statusBien.' ');
                if($sql111){
                    $this->session->set_flashdata('ExistPeriodo','No puede agregar el mismo permiso al mismo bien dos veces en el mismo periodo');
                    header('location:'.base_url().'Npermiso_Construccion');
                }else{
                    $numeroPermiso1 = nPermiso();
                    $costo = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' and id_categoria = '.$activo.' and id_subcategoria = '.$categoria .' ');
                    if(empty($costo)){
                        $this->session->set_flashdata('NoExisteGestion','Al parecer no se ha hecho una gestion de valores!');
                        header('location:'.base_url().'Npermiso_Construccion');
                    }else{

                        $numeroPermiso1 = nPermiso();
                        $TotalPermiso = $costo[0]['valor'];
                        $numeroPermiso = "200-".$activo."-".$categoria."-".$insertCodigo;
                        // debug($_FILES,false);
                            // BUCLE PARA GUARDAR N CANTIDAD DE IMAGENES
                            foreach ($_FILES as $key => $value){
                                $mi_imagen = $key;
                                $config['upload_path'] = "./Images/pConstruccion/";
                                $config['file_name'] = 'img|'.$contribuyente.'|'.''.$numeroPermiso.'';
                                $config['allowed_types'] = "gif|jpg|jpeg|png";
                                $config['max_size'] = "50000";
                                $config['max_width'] = "2000";
                                $config['max_height'] = "2000";
                        
                        	    $this->load->library('upload', $config);
                        
                                if (!$this->upload->do_upload($mi_imagen)){
                                    $data['uploadError'] = $this->upload->display_errors();
                                    echo $this->upload->display_errors();
                                    return;
                                }
                                $data['uploadSuccess'] = $this->upload->data();
                                $ruta = $data['uploadSuccess'];
                                // echo $ruta['file_name'].'<br>';
                                $datos[] = $ruta['file_name'];
                            }
                        // debug($datos);
                        // DATOS QUE VAN HACER INTRODUCIDOS EN LA BD
                            $dato = array(
                                    'contribuyente'         =>      $contribuyente,
                                    'activo'                =>      $bien,
                                    'fecha_creacion'        =>      $fechaCreacion,
                                    'fecha_caducidad'       =>      $fechaCaducidad,
                                    'informe_inspeccion'    =>      $datos[0],
                                    'pago_impuesto'         =>      $datos[3],
                                    'plan_contigencia'      =>      $datos[5],
                                    'cedula'                =>      $datos[1],
                                    'papeleta_votacion'     =>      $datos[2],
                                    'contrucciones_planos'  =>      $datos[4],
                                    'status'                =>      1,
                                    'total_permiso'         =>      $TotalPermiso,
                                    'n_permiso'             =>      $numeroPermiso,
                                    'categoria'             =>      $categoria,
                                    'id_cate_riesgo'        =>      $activo,
                                    'id_bien'               =>      $statusBien,
                                    'periodo'               =>      $periodo,
                                    'id_periodo'            =>      $id_periodo,
                                );
                            
                            $this->universal->insert('permiso_construccion', $dato);
                            $this->universal->update('mueble',array('status' => 1),array('placa' => $statusBien));
                            $this->universal->update('inmuebles',array('status' => 1),array('clave_catastral' => $statusBien));
                            $datoUpdate = array('id_periodo' => $id_periodo, 'id_categoria' => $activo, 'id_subcategoria' => $categoria);
                            $this->universal->update('mantenimiento_rubro',array('status' => 1),$datoUpdate);

                            $datosReportes = array(
                            	'permiso' 			=> 'Permiso de construcción',
                            	'id_permiso' 		=> 200,
                            	'fecha' 			=> $fechaCreacion,
                            	'valor' 			=> $TotalPermiso,
                            );
                            $this->universal->insert('reportes_ingresos', $datosReportes);
                            // debug($dato);
                    }
                }
            }
        }
        
        $this->session->set_flashdata('AddPermisoFuncionamiento','Permisos Agregados!');
        header('location:'.base_url().'Npermiso_Construccion');
    }
    
    public function RenovacionPermisoContruccion(){
        $this->data['permisoConstruccion'] = $this->universal->query('SELECT * FROM permiso_construccion');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoConstruccion/renovacion', $this->data);
        $this->footer();
    }
    
    public function RenovarPermisoConstruccion(){
        $post = $this->input->post();
        if($post){
            // debug($post,false);
            $nPermiso = htmlspecialchars($post['nPermiso']);
            $id_periodo = htmlspecialchars($post['id_periodo']);
            $categoria = htmlspecialchars($post['activo']);
            $subcategoria = htmlspecialchars($post['categoria']);
            
            $fechaCreacion = date("Y-m-d");
            $fechaCaducidad = date("Y-12-31");

            $sql = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' AND  id_permiso = 200 AND id_categoria = '.$categoria.' AND id_subcategoria = '.$subcategoria.' ');
            // OBTENER EL COSTO DE LA CATEGORIA DE RIESGO
            if($sql){
                $TotalPermiso = $sql[0]['valor'];
                 $datos = array(
                            'fecha_creacion'            =>      $fechaCreacion, 
                            'fecha_caducidad'           =>      $fechaCaducidad,
                            'total_permiso'             =>      $TotalPermiso,
                        );
                $this->universal->update('permiso_construccion',$datos,array('n_permiso' => $nPermiso));
                
                $this->session->set_flashdata('UpdateRenoPermiso','Renovacion De Permiso Exitosa!');
                header('location:'.base_url().'RenovacionPermisoContruccion');
            }else{
                header('location:'.base_url().'RenovacionPermisoContruccion');
            }
        }
    }
    
    // PERMISOS PARA RODAJE
    
    public function Npermiso_Rodaje(){
        $this->data['permisoRodaje'] = $this->universal->query('SELECT * FROM permiso_rodaje');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoRodaje/NpermisoRodaje', $this->data);
        $this->footer();
    }
    
    public function add_permisoRodaje(){
        // debug($_POST,false);
        // debug($_FILES,false);
        $datos = array();
        function nPermiso(){
                $an = "0123456789";
                $su = strlen($an) - 1;
                return  substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }

         $codigo = "00001";
            $insertCodigo = 0;
            $codigoPermiso = $this->universal->query('SELECT * FROM permiso_rodaje ORDER BY ID DESC LIMIT 1 ');

            if(empty($codigoPermiso)){
                $insertCodigo = $codigo;
            }else{
                $num = $codigoPermiso[0]['ID'];
                $insertCodigo = $codigo + $num;
            }

        for($x =0 ; $x <= count($_POST) ; $x++){
            if(isset($_POST['contribuyente']) and isset($_POST['selectBien'.$x])){
                $contribuyente = $_POST['contribuyente'];
                $activoo = $_POST['selectBien'.$x];
                $porciones = explode("|", $activoo);
                $activo = $porciones[0]; // categoria
                $bien = $porciones[1]; // clase del bien
                $statusBien = $porciones[2]; // clave unica del bien
                $categoria = $porciones[3]; // subcategoria

                $activo2 = $_POST['periodo'.$x];
                $porciones2 = explode("|", $activo2);
                $id_periodo = $porciones2[0]; // id del periodo elegido
                $periodo = $porciones2[1]; // periodo elegido

                $fechaCreacion = date("Y-m-d");
                $fechaCaducidad = date("".$periodo."-12-31");
                $numeroPermiso1 = nPermiso();

                $sql111 = $this->universal->query('SELECT * FROM permiso_rodaje WHERE id_periodo = '.$id_periodo.' and contribuyente = "'.$contribuyente.'" and id_bien = "'.$statusBien.'" ');
                if($sql111){
                    $this->session->set_flashdata('ExistPeriodo','No puede agregar el mismo permiso al mismo bien dos veces en el mismo periodo');
                    header('location:'.base_url().'Npermiso_Rodaje');
                }else{
                    $costo = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' and id_categoria = '.$activo.' and id_subcategoria = '.$categoria .' ');
                    if(empty($costo)){
                        $this->session->set_flashdata('NoExisteGestion','Al parecer no se ha hecho una gestion de valores!');
                        header('location:'.base_url().'Npermiso_funcionamiento');
                    }else{
                        $TotalPermiso = $costo[0]['valor'];
                        $numeroPermiso = "300-".$activo."-".$categoria."-".$numeroPermiso1;

                            // BUCLE PARA GUARDAR N CANTIDAD DE IMAGENES
                            foreach ($_FILES as $key => $value){
                                $mi_imagen = $key;
                                $config['upload_path'] = "./Images/pRodaje/";
                                $config['file_name'] = 'img|'.$contribuyente.'|'.''.$insertCodigo.'';
                                $config['allowed_types'] = "gif|jpg|jpeg|png";
                                $config['max_size'] = "50000";
                                $config['max_width'] = "2000";
                                $config['max_height'] = "2000";
                        
                        	    $this->load->library('upload', $config);
                        
                                if (!$this->upload->do_upload($mi_imagen)){
                                    $data['uploadError'] = $this->upload->display_errors();
                                    echo $this->upload->display_errors();
                                    return;
                                }
                                $data['uploadSuccess'] = $this->upload->data();
                                $ruta = $data['uploadSuccess'];
                                // echo $ruta['file_name'].'<br>';
                                $datos[] = $ruta['file_name'];
                            }
                        // debug($datos);
                        // DATOS QUE VAN HACER INTRODUCIDOS EN LA BD
                            $dato = array(
                                'contribuyente'         =>      $contribuyente,
                                'activo'                =>      $bien,
                                'fecha_creacion'        =>      $fechaCreacion,
                                'fecha_caducidad'       =>      $fechaCaducidad,
                                'informe_inspeccion'    =>      $datos[0],
                                'matricula'             =>      $datos[3],
                                'licencia_conducir'     =>      $datos[4],
                                'cedula'                =>      $datos[1],
                                'papeleta_votacion'     =>      $datos[2],
                                'status'                =>      1,
                                'fotovehiculo1'         =>      $datos[5],
                                'fotovehiculo2'         =>      $datos[6],
                                'fotovehiculo3'         =>      $datos[7],
                                'total_permiso'         =>      $TotalPermiso,
                                'n_permiso'             =>      $numeroPermiso,
                                'categoria'             =>      $categoria,
                                'id_cate_riesgo'        =>      $activo,
                                'id_bien'               =>      $statusBien,
                                'periodo'               =>      $periodo,
                                'id_periodo'            =>      $id_periodo,
                            );
                            
                            $this->universal->insert('permiso_rodaje', $dato);
                            $this->universal->update('mueble',array('status' => 1),array('placa' => $statusBien));
                            $this->universal->update('inmuebles',array('status' => 1),array('clave_catastral' => $statusBien));
                            $datoUpdate = array('id_periodo' => $id_periodo, 'id_categoria' => $activo, 'id_subcategoria' => $categoria);
                            $this->universal->update('mantenimiento_rubro',array('status' => 1),$datoUpdate);

                            $datosReportes = array(
                            	'permiso' 			=> 'Permiso de rodaje',
                            	'id_permiso' 		=> 300,
                            	'fecha' 			=> $fechaCreacion,
                            	'valor' 			=> $TotalPermiso,
                            );
                            $this->universal->insert('reportes_ingresos', $datosReportes);
                            // debug($dato);
                    }
                }   
            }
        }
        
        $this->session->set_flashdata('AddPermisoFuncionamiento','Permisos Agregados!');
        header('location:'.base_url().'Npermiso_Rodaje');
    }
    
    public function RenovacionPermisoRodaje(){
        $this->data['permisoRodaje'] = $this->universal->query('SELECT * FROM permiso_rodaje');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoRodaje/renovacion', $this->data);
        $this->footer();
    }
    
    public function RenovarPermisoRodaje(){
        $post = $this->input->post();
        if($post){
            // debug($post,false);
            $nPermiso = htmlspecialchars($post['nPermiso']);
            $id_periodo = htmlspecialchars($post['id_periodo']);
            $categoria = htmlspecialchars($post['activo']);
            $subcategoria = htmlspecialchars($post['categoria']);
            
            $fechaCreacion = date("Y-m-d");
            $fechaCaducidad = date("Y-12-31");
            
            $sql = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' AND  id_permiso = 300 AND id_categoria = '.$categoria.' AND id_subcategoria = '.$subcategoria.' ');

            if($sql){
                $TotalPermiso = $sql[0]['valor'];
                $datos = array(
                            'fecha_creacion'            =>      $fechaCreacion, 
                            'fecha_caducidad'           =>      $fechaCaducidad,
                            'total_permiso'             =>      $TotalPermiso,
                        );
                $this->universal->update('permiso_rodaje',$datos,array('n_permiso' => $nPermiso));
                
                $this->session->set_flashdata('UpdateRenoPermiso','Renovacion De Permiso Exitosa!');
                header('location:'.base_url().'RenovacionPermisoRodaje');
            }else{
                header('location:'.base_url().'RenovacionPermisoRodaje');
            }
        }
    }
    
    public function footer() {
        $this->load->view('footer', $this->data);
    }


    public function Npermiso_Ocasional(){
        $this->data['permisoOcasional'] = $this->universal->query('SELECT * FROM permiso_ocasional');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['periodos'] = $this->universal->query('SELECT * FROM periodos');
        $this->header();
        $this->load->view('PermisoOcasional/NpermisoOcasional', $this->data);
        $this->footer();
    }
    
    public function add_permisoOcasional(){
        // debug($_POST,false);
        // debug($_FILES,false);
        $datos = array();
        function nPermiso(){
            $an = "0123456789";
            $su = strlen($an) - 1;
            return  substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1) .
                    substr($an, rand(0, $su), 1);
        }
        $codigo = "00001";
            $insertCodigo = 0;
            $codigoPermiso = $this->universal->query('SELECT * FROM permiso_ocasional ORDER BY ID DESC LIMIT 1 ');

            if(empty($codigoPermiso)){
                $insertCodigo = $codigo;
            }else{
                $num = $codigoPermiso[0]['ID'];
                $insertCodigo = $codigo + $num;
            }
            
        for($x =0 ; $x <= count($_POST) ; $x++){
            if(isset($_POST['contribuyente']) and isset($_POST['selectBien'.$x]) and isset($_POST['fechaCaducidad'.$x])){
                $fechaCreacion = date("Y-m-d");
                $fechaCaducidad = $_POST['fechaCaducidad'.$x];
                if($fechaCaducidad < $fechaCreacion){
                    $this->session->set_flashdata('ErrorFechaCadu','La fecha no puede ser menor a la actual!');
                    header('location:'.base_url().'Npermiso_Ocasional');
                }else{
                    $contribuyente = $_POST['contribuyente'];
                    $activoo = $_POST['selectBien'.$x];
                    $porciones = explode("|", $activoo);
                    $activo = $porciones[0]; // categoria
                    $bien = $porciones[1]; // clase del bien
                    $statusBien = $porciones[2]; // clave unica del bien
                    $categoria = $porciones[3]; // subcategoria

                    $activo2 = $_POST['periodo'.$x];
                    $porciones2 = explode("|", $activo2);
                    $id_periodo = $porciones2[0]; // id del periodo elegido
                    $periodo = $porciones2[1]; // periodo elegido

                    $fechaCreacion = date("Y-m-d");
                    $fechaCaducidad = date("".$periodo."-12-31");
                    $numeroPermiso1 = nPermiso();
                    
                    $costo = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_periodo = '.$id_periodo.' and id_categoria = '.$activo.' and id_subcategoria = '.$categoria .' ');
                    if(empty($costo)){
                        $this->session->set_flashdata('NoExisteGestion','Al parecer no se ha hecho una gestion de valores!');
                        header('location:'.base_url().'Npermiso_Ocasional');
                    }else{

                    $TotalPermiso = $costo[0]['valor'];
                    $numeroPermiso = "400-".$activo."-".$categoria."-".$insertCodigo;

                        // BUCLE PARA GUARDAR N CANTIDAD DE IMAGENES
                        foreach ($_FILES as $key => $value){
                            $mi_imagen = $key;
                            $config['upload_path'] = "./Images/pOcasional/";
                            $config['file_name'] = 'img|'.$contribuyente.'|'.''.$numeroPermiso.'';
                            $config['allowed_types'] = "gif|jpg|jpeg|png";
                            $config['max_size'] = "50000";
                            $config['max_width'] = "2000";
                            $config['max_height'] = "2000";
                    
                    	    $this->load->library('upload', $config);
                    
                            if (!$this->upload->do_upload($mi_imagen)){
                                $data['uploadError'] = $this->upload->display_errors();
                                echo $this->upload->display_errors();
                                return;
                            }
                            $data['uploadSuccess'] = $this->upload->data();
                            $ruta = $data['uploadSuccess'];
                            // echo $ruta['file_name'].'<br>';
                            $datos[] = $ruta['file_name'];
                        }

                    // DATOS QUE VAN HACER INTRODUCIDOS EN LA BD
                    $dato = array(
                            'contribuyente'         =>      $contribuyente,
                            'activo'                =>      $bien,
                            'fecha_creacion'        =>      $fechaCreacion,
                            'fecha_caducidad'       =>      $fechaCaducidad,
                            'cedula'                =>      $datos[0],
                            'papeleta_votacion'     =>      $datos[1],
                            'plan_contingencia'     =>      $datos[2],
                            'factura_extintor'      =>      $datos[3],
                            'total_permiso'         =>      $TotalPermiso,
                            'n_permiso'             =>      $numeroPermiso,
                            'categoria'             =>      $categoria,
                            'id_cate_riesgo'        =>      $activo,
                            'id_bien'               =>      $statusBien,
                            'periodo'               =>      $periodo,
                            'id_periodo'            =>      $id_periodo,
                        );
                        
                        $this->universal->insert('permiso_ocasional', $dato);
                        $this->universal->update('mueble',array('status' => 1),array('placa' => $statusBien));
                        $this->universal->update('inmuebles',array('status' => 1),array('clave_catastral' => $statusBien));
                        $datoUpdate = array('id_periodo' => $id_periodo, 'id_categoria' => $activo, 'id_subcategoria' => $categoria);
                        $this->universal->update('mantenimiento_rubro',array('status' => 1),$datoUpdate);
                        $datosReportes = array(
                                'permiso'           => 'Permiso Ocasional',
                                'id_permiso'        => 400,
                                'fecha'             => $fechaCreacion,
                                'valor'             => $TotalPermiso,
                        );
                        $this->universal->insert('reportes_ingresos', $datosReportes);
                        $this->session->set_flashdata('AddPermisoFuncionamiento','Permisos Agregados!');
                    } // aqui
                }
            }
        }
        
        header('location:'.base_url().'Npermiso_Ocasional');
    }
}

?>