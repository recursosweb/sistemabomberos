<?php

class Bienes extends CI_Controller {

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

// PAGINA INMUEBLES
    public function inmuebles(){
        $this->data['inmuebles'] = $this->universal->query('SELECT * FROM inmuebles');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['mantenimientoInmuebles'] = $this->universal->query('SELECT * FROM mantenimiento_inmuebles');
        $this->data['tipoInmuebles'] = $this->universal->query('SELECT * FROM tipo_inmuebles');
        $this->data['subcategoria'] = $this->universal->query('SELECT * FROM subcategoria');
        $this->header();
        $this->load->view('Bienes/inmuebles', $this->data);
        $this->footer();
    }
    
    public function add_inmuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $contribuyente = htmlspecialchars($post['persona']);
            for($x =0 ; $x <= count($_POST) ; $x++){
                if(isset($_POST['clasebien'.$x]) and isset($_POST['tipobien'.$x]) and isset($_POST['clavecatastral'.$x]) and isset($_POST['actividadeconomica'.$x]) and isset($_POST['categoriariesgo'.$x]) and isset($_POST['ubicacion'.$x]) and isset($_POST['limite'.$x]) and isset($_POST['estado'.$x]) and isset($_POST['areapropiedad'.$x]) and isset($_POST['areaconstruccion'.$x]) and isset($_POST['caracteristica'.$x])){
                    $sqlClaveCatastral = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = "'.$_POST["clavecatastral".$x].'" ');
                    if(!$sqlClaveCatastral){
                        $sqlActividadEconomica = $this->universal->query('SELECT * FROM categoria_riesgo WHERE ID = "'.$_POST["actividadeconomica".$x].'" ');
                        if($sqlActividadEconomica){
                            $claseBien = htmlspecialchars($_POST['clasebien'.$x]);
                            $tipoBien = htmlspecialchars($_POST['tipobien'.$x]);
                            $claveCatastral = htmlspecialchars($_POST['clavecatastral'.$x]);
                            $actividadEconomica = $sqlActividadEconomica[0]['nombre_comercial'];
                            $IDactividadEconomica = htmlspecialchars($_POST['actividadeconomica'.$x]);
                            $categoriaRiesgo = htmlspecialchars($_POST['categoriariesgo'.$x]);
                            $ubicacion = htmlspecialchars($_POST['ubicacion'.$x]);
                            $limite = htmlspecialchars($_POST['limite'.$x]);
                            $estado = htmlspecialchars($_POST['estado'.$x]);
                            $areaPropiedad = htmlspecialchars($_POST['areapropiedad'.$x]);
                            $areaConstruccion = htmlspecialchars($_POST['areaconstruccion'.$x]);
                            $caracteristica = htmlspecialchars($_POST['caracteristica'.$x]);
                            $datos = array(
                                    'id_propietario'            =>  $contribuyente,                      
                                    'clase_bien'                =>  $claseBien,                      
                                    'tipo_bien'                 =>  $tipoBien,          
                                    'clave_catastral'           =>  $claveCatastral,                 
                                    'actividad_economica'       =>  $actividadEconomica,                     
                                    'id_actividad_economica'    =>  $IDactividadEconomica,                        
                                    'categoria_riesgo'          =>  $categoriaRiesgo,                 
                                    'ubicacion'                 =>  $ubicacion,           
                                    'limites'                   =>  $limite,                 
                                    'area_propiedad'            =>  $areaPropiedad,   
                                    'area_construccion'         =>  $areaConstruccion,                   
                                    'caracteristicas'           =>  $caracteristica,               
                                    'estado'                    =>  $estado        
                                );
                            $this->universal->insert('inmuebles', $datos);   
                            $this->universal->update('subcategoria',array('status' => 1),array('ID' => $categoriaRiesgo)); 
                        }else{
                            $this->session->set_flashdata('ErrorActividadEconomica','Ocurrio un error por favor contactar con personal autorizado!');
                            header('location:'.base_url().'inmuebles');
                        }
                    }else{
                        $this->session->set_flashdata('ErrorClaveCatastral','La clave catastral ya existe!');
                        header('location:'.base_url().'inmuebles');
                    }
                }
            }
            $this->session->set_flashdata('AddInmuebles','Inmuebles Agregados!');
            header('location:'.base_url().'inmuebles');
        }
    }
    
    public function update_inmuebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
                $claveCatastral = htmlspecialchars($post['clavecatastral']);
                $claseBien = htmlspecialchars($post['claseBien']);
                $tipoBien = htmlspecialchars($post['tipoBien']);
                $actividadEco = htmlspecialchars($post['actividadEco']);
                $categoria_riesgo = htmlspecialchars($post['categoria_riesgo']);
                $ubicacion = htmlspecialchars($post['ubicacion']);
                $limites = htmlspecialchars($post['limites']);
                $area_propiedad = htmlspecialchars($post['area_propiedad']);
                $area_construccion = htmlspecialchars($post['area_construccion']);
                $caracteristica = htmlspecialchars($post['caracteristica']);
                $estado = htmlspecialchars($post['estado']);
                $datos = array(
                        'clase_bien'                =>  $claseBien,
                        'tipo_bien'                 =>  $tipoBien,
                        'actividad_economica'       =>  $actividadEco,
                        'categoria_riesgo'          =>  $categoria_riesgo,
                        'ubicacion'                 =>  $ubicacion,
                        'limites'                   =>  $limites,
                        'area_propiedad'            =>  $area_propiedad,
                        'area_construccion'         =>  $area_construccion,
                        'caracteristicas'           =>  $caracteristica,
                        'estado'                    =>  $estado
                    );
                $this->universal->update('inmuebles',$datos,array('clave_catastral' => $claveCatastral));
                $this->session->set_flashdata('UpdateInmeble','Inmueble Actualizado exitosamente!');
                header('location:'.base_url().'inmuebles');
        }
    }
    
    public function delete_inmuebles(){
        $post = $this->input->post();
        if($post){
        // debug($post);
            $claveCatastral = htmlspecialchars($post['claveCatastral']);
            $this->universal->delete('inmuebles',array('clave_catastral' => $claveCatastral));
            $this->session->set_flashdata('deleteinmueble','Inmueble eliminado exitosamente!');
            header('location:'.base_url().'inmuebles');
        }
    }

// PAGINA MUEBLES
    public function muebles() {
        $this->data['muebles'] = $this->universal->query('SELECT * FROM mueble');
        $this->data['personas'] = $this->universal->query('SELECT * FROM persona');
        $this->data['empresas'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['CatRiesgo'] = $this->universal->query('SELECT * FROM categoria_riesgo');
        $this->data['mantenimientomuebles'] = $this->universal->query('SELECT * FROM mantenimiento_muebles');
        $this->data['tipomuebles'] = $this->universal->query('SELECT * FROM tipo_muebles');
        $this->data['subcategoria'] = $this->universal->query('SELECT * FROM subcategoria');
        $this->header();
        $this->load->view('Bienes/muebles', $this->data);
        $this->footer();
    }
    
    public function add_muebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $contribuyente = htmlspecialchars($post['persona']);
            for($x =0 ; $x <= count($_POST) ; $x++){
                if(isset($_POST['clasebien'.$x]) and isset($_POST['placa'.$x]) and isset($_POST['tipoBien'.$x]) and isset($_POST['actividadeconomica'.$x]) and isset($_POST['categoriariesgo'.$x]) and isset($_POST['marca'.$x]) and isset($_POST['modelo'.$x]) and isset($_POST['anoFabricacion'.$x]) and isset($_POST['numeroMotor'.$x]) and isset($_POST['numeroChasis'.$x])){
                    $sqlplaca = $this->universal->query('SELECT * FROM mueble WHERE placa = "'.$_POST["placa".$x].'" ');
                    if(!$sqlplaca){
                        $sqlNMotor = $this->universal->query('SELECT * FROM mueble WHERE numero_motor = "'.$_POST["numeroMotor".$x].'" ');
                        if(!$sqlNMotor){
                            $sqlNChasis = $this->universal->query('SELECT * FROM mueble WHERE numero_chasis = "'.$_POST["numeroChasis".$x].'" ');
                            if(!$sqlNChasis){
                                $sqlActividadEconomica = $this->universal->query('SELECT * FROM categoria_riesgo WHERE ID = "'.$_POST["actividadeconomica".$x].'" ');
                                if($sqlActividadEconomica){
                                    $claseBien = htmlspecialchars($_POST['clasebien'.$x]);
                                    $tipoBien = htmlspecialchars($_POST['tipoBien'.$x]);
                                    $placa = htmlspecialchars($_POST['placa'.$x]);
                                    $actividadEconomica = $sqlActividadEconomica[0]['nombre_comercial'];
                                    $IDactividadEconomica = htmlspecialchars($_POST['actividadeconomica'.$x]);
                                    $categoriaRiesgo = htmlspecialchars($_POST['categoriariesgo'.$x]);
                                    $marca = htmlspecialchars($_POST['marca'.$x]);
                                    $modelo = htmlspecialchars($_POST['modelo'.$x]);
                                    $anoFabricacion = htmlspecialchars($_POST['anoFabricacion'.$x]);
                                    $numeroMotor = htmlspecialchars($_POST['numeroMotor'.$x]);
                                    $numeroChasis = htmlspecialchars($_POST['numeroChasis'.$x]);
                                    $datos = array(
                                            'id_propietario'            =>  $contribuyente,                      
                                            'clase_bien'                =>  $claseBien,                      
                                            'placa'                     =>  $placa,          
                                            'tipo_bien'                 =>  $tipoBien,                 
                                            'actividad_economica'       =>  $actividadEconomica,                     
                                            'id_actividad_economica'    =>  $IDactividadEconomica,                        
                                            'categoria_riesgo'          =>  $categoriaRiesgo,                 
                                            'marca'                     =>  $marca,           
                                            'modelo'                    =>  $modelo,                 
                                            'fecha_fabricacion'         =>  $anoFabricacion,   
                                            'numero_motor'              =>  $numeroMotor,                   
                                            'numero_chasis'             =>  $numeroChasis,               
                                        );
                                    $this->universal->insert('mueble', $datos);   
                                    $this->universal->update('subcategoria',array('status' => 1),array('ID' => $categoriaRiesgo));

                                }else{
                                    $this->session->set_flashdata('ErrorActividadEconomica','Ocurrio un error por favor contactar con personal autorizado!');
                                    header('location:'.base_url().'muebles');
                                }
                            }else{
                                $this->session->set_flashdata('ErrorChasis','El numero de chasis ya ha sido registrado!');
                                header('location:'.base_url().'muebles');
                            }
                        }else{
                            $this->session->set_flashdata('ErrorMotor','El numero de motor ya ha sido registrado!');
                            header('location:'.base_url().'muebles');
                        }
                    }else{
                        $this->session->set_flashdata('ErrorClaveCatastral','La Placa ya existe!');
                        header('location:'.base_url().'muebles');
                    }
                }
            }
            $this->session->set_flashdata('AddInmuebles','Muebles Agregados!');
            header('location:'.base_url().'muebles');
        }
    }

    public function update_muebles(){
        $post = $this->input->post();
        if($post){
            // debug($post);
                $placa = htmlspecialchars($post['placa']);
                $claseBien = htmlspecialchars($post['claseBien']);
                $tipoBien = htmlspecialchars($post['tipoBien']);
                $IDactividadEconomica = htmlspecialchars($post['actividadeconomica']);
                $sqlActividadEconomica = $this->universal->query('SELECT * FROM categoria_riesgo WHERE ID = "'.$IDactividadEconomica.'" ');
                $actividadEconomica = $sqlActividadEconomica[0]['nombre_comercial'];
                $categoria_riesgo = htmlspecialchars($post['categoria_riesgo']);
                $marca = htmlspecialchars($post['marca']);
                $modelo = htmlspecialchars($post['modelo']);
                $anoFabricacion = htmlspecialchars($post['anoFabricacion']);
                $datos = array(
                        'clase_bien'                    =>  $claseBien,
                        'tipo_bien'                     =>  $tipoBien,
                        'actividad_economica'           =>  $actividadEconomica,
                        'id_actividad_economica'        =>  $IDactividadEconomica,
                        'categoria_riesgo'              =>  $categoria_riesgo,
                        'marca'                         =>  $marca,
                        'modelo'                        =>  $modelo,
                        'fecha_fabricacion'             =>  $anoFabricacion,
                    );
                $this->universal->update('mueble',$datos,array('placa' => $placa));
                $this->session->set_flashdata('UpdateInmeble','Mueble Actualizado exitosamente!');
                header('location:'.base_url().'muebles');
        }
    }

    public function delete_muebles(){
        $post = $this->input->post();
        if($post){
        // debug($post);
            $placa = htmlspecialchars($post['placa']);
            $this->universal->delete('mueble',array('placa' => $placa));
            $this->session->set_flashdata('deleteinmueble','Mueble eliminado exitosamente!');
            header('location:'.base_url().'muebles');
        }
    }

    public function footer() {
        $this->load->view('footer', $this->data);
    }

}

?>