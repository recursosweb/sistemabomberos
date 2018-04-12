<?php

class Contribuyente extends CI_Controller {

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

// PAGINA PERSONA
    public function persona() {
        $this->data['persona'] = $this->universal->query('SELECT * FROM persona');
        $this->header();
        $this->load->view('Contribuyente/persona', $this->data);
        $this->footer();
    }
    
    public function add_persona(){
        $post = $this->input->post();
        if($post){
            $cedula = $this->validaridentificacion->validarCedula($post['cedula']);
            // debug($cedula);
            if($cedula){
                $cedula = htmlspecialchars($post['cedula']);
                $sqlCedu = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$cedula.'" ');
                $correo = htmlspecialchars($post['correo']);
                if(!$sqlCedu){
                    $sqlCorre = $this->universal->query('SELECT * FROM persona WHERE correo = "'.$correo.'" ');
                    if(!$sqlCorre){
                        $cedula = htmlspecialchars($post['cedula']);
                        $nombre = htmlspecialchars($post['nombre']);
                        $apellido = htmlspecialchars($post['apellido']);
                        $sexo = htmlspecialchars($post['sexo']);
                        $telefono = htmlspecialchars($post['telefono']);
                        $correo = htmlspecialchars($post['correo']);
                        $direccion = htmlspecialchars($post['direccion']);
                        $datos = array(
                                'cedula'        =>  $cedula,
                                'nombres'       =>  $nombre,
                                'apellidos'     =>  $apellido,
                                'sexo'          =>  $sexo,
                                'telefono'      =>  $telefono,
                                'correo'        =>  $correo,
                                'direccion'     =>  $direccion
                            );
                        $this->universal->insert('persona', $datos);
                        
                        $this->session->set_flashdata('AddPersona','Persona Registrada exitosamente!');
                        header('location:'.base_url().'persona');
                    }else{
                        $this->session->set_flashdata('ErrorCorreoExit','El Correo ya existe!');
                        header('location:'.base_url().'persona');
                    }
                }else{
                    $this->session->set_flashdata('ErrorCedulaExit','La Cedula ya existe!');
                    header('location:'.base_url().'persona');
                }
            }else{
                $this->session->set_flashdata('ErrorCedula','La Cedula no es valida!');
                header('location:'.base_url().'persona');
            }
        }
    }
    
    public function update_persona(){
        $post = $this->input->post();
        if($post){
            $cedula = $this->validaridentificacion->validarCedula($post['cedula']);
            // debug($cedula);
            if($cedula){
                $cedula = htmlspecialchars($post['cedula']);
                $nombre = htmlspecialchars($post['nombre']);
                $apellido = htmlspecialchars($post['apellido']);
                $sexo = htmlspecialchars($post['sexo']);
                $telefono = htmlspecialchars($post['telefono']);
                $correo = htmlspecialchars($post['correo']);
                $direccion = htmlspecialchars($post['direccion']);
                $datos = array(
                        'nombres'       =>  $nombre,
                        'apellidos'     =>  $apellido,
                        'sexo'          =>  $sexo,
                        'telefono'      =>  $telefono,
                        'correo'        =>  $correo,
                        'direccion'     =>  $direccion
                    );
                $this->universal->update('persona',$datos,array('cedula' => $cedula));
                $this->session->set_flashdata('UpdatePersona','Persona Actualizada exitosamente!');
                header('location:'.base_url().'persona');
                    
            }else{
                $this->session->set_flashdata('ErrorCedula','La Cedula no es valida!');
                header('location:'.base_url().'persona');
            }
        }
    }
    
    public function delete_persona(){
        $post = $this->input->post();
        if($post){
        // debug($post);
            $cedula = $this->validaridentificacion->validarCedula($post['cedula']);
            if($cedula){
                $cedula = htmlspecialchars($post['cedula']);
                $this->universal->delete('persona',array('cedula' => $cedula));
                $this->session->set_flashdata('deletePersona','Persona eliminada exitosamente!');
                header('location:'.base_url().'persona');
            }else{
                $this->session->set_flashdata('ErrorCedula','La Cedula no es valida!');
                header('location:'.base_url().'persona');
            }
        }
    }

// PAGINA EMPRESA
    public function empresa() {
        $this->data['empresa'] = $this->universal->query('SELECT * FROM empresa');
        $this->header();
        $this->load->view('Contribuyente/empresa', $this->data);
        $this->footer();
    }
    
    public function add_empresa(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $ruc = $this->validaridentificacion->validarRucPersonaNatural($post['ruc']);
            if($ruc){
                $cedu = $this->validaridentificacion->validarCedula($post['cedulaR']);
                if($cedu){
                    $sqlCedu = $this->universal->query('SELECT * FROM empresa WHERE cedula = "'.$cedu.'" ');
                    if(!$sqlCedu){
                        $corre = $post['correo'];
                        $sqlCorre = $this->universal->query('SELECT * FROM empresa WHERE correo = "'.$corre.'" ');
                        if(!$sqlCorre){
                            $ruc = htmlspecialchars($post['ruc']);
                            $nombreEmpresa = htmlspecialchars($post['nombreEmpresa']);
                            $cedulaR = htmlspecialchars($post['cedulaR']);
                            $nombre = htmlspecialchars($post['nombre']);
                            $apellido = htmlspecialchars($post['apellido']);
                            $telefono = htmlspecialchars($post['telefono']);
                            $correo = htmlspecialchars($post['correo']);
                            $direccion = htmlspecialchars($post['direccion']);
                            $datos = array(
                                    'ruc'                   =>  $ruc,
                                    'nombre_empresa'        =>  $nombreEmpresa,
                                    'cedula'                =>  $cedulaR,
                                    'nombres'               =>  $nombre,
                                    'apellidos'             =>  $apellido,
                                    'telefono'              =>  $telefono,
                                    'correo'                =>  $correo,
                                    'direccion'             =>  $direccion
                                );
                            $this->universal->insert('empresa', $datos);
                            
                            $this->session->set_flashdata('AddEmpresa','Empresa Registrada exitosamente!');
                            header('location:'.base_url().'empresa');
                        }else{
                            $this->session->set_flashdata('ErrorCorreoExit','El Correo ya existe!');
                            header('location:'.base_url().'empresa');
                        }
                    }else{
                        $this->session->set_flashdata('ErrorCedulaExit','La Cedula ya existe!');
                        header('location:'.base_url().'empresa');
                    }
                }else{
                    $this->session->set_flashdata('ErrorCedula','La Cedula no es valida!');
                    header('location:'.base_url().'empresa');
                }
            }else{
                $this->session->set_flashdata('ErrorRuc','El ruc introducido es invalido!');
                header('location:'.base_url().'empresa');
            }
        }
    }

    public function update_empresa(){
        $post = $this->input->post();
        if($post){
            $ruc = $this->validaridentificacion->validarRucPersonaNatural($post['ruc']);
            if($ruc){
                $ruc = htmlspecialchars($post['ruc']);
                $nombreEmpresa = htmlspecialchars($post['nombreEmpresa']);
                $cedulaR = htmlspecialchars($post['cedulaR']);
                $nombre = htmlspecialchars($post['nombre']);
                $apellido = htmlspecialchars($post['apellido']);
                $telefono = htmlspecialchars($post['telefono']);
                $correo = htmlspecialchars($post['correo']);
                $direccion = htmlspecialchars($post['direccion']);
                $datos = array(
                        'cedula'                =>  $cedulaR,
                        'nombres'               =>  $nombre,
                        'apellidos'             =>  $apellido,
                        'telefono'              =>  $telefono,
                        'correo'                =>  $correo,
                        'direccion'             =>  $direccion
                    );
                $this->universal->update('empresa',$datos,array('ruc' => $ruc));
                $this->session->set_flashdata('UpdateEmpresa','Empresa Actualizada exitosamente!');
                header('location:'.base_url().'empresa');
            }else{
                $this->session->set_flashdata('ErrorRuc','El ruc introducido es invalido!');
                header('location:'.base_url().'empresa');
            }
        }
    }

    public function delete_empresa(){
        $post = $this->input->post();
        if($post){
        // debug($post);
            $ruc = $ruc = $this->validaridentificacion->validarRucPersonaNatural($post['ruc']);
            if($ruc){
                $ruc = htmlspecialchars($post['ruc']);
                $this->universal->delete('empresa',array('ruc' => $ruc));
                $this->session->set_flashdata('deleteEmpresa','Empresa eliminada exitosamente!');
                header('location:'.base_url().'empresa');
            }else{
                $this->session->set_flashdata('ErrorRuc','El ruc introducido es invalido!');
                header('location:'.base_url().'empresa');
            }
        }
    }
    

    public function footer() {
        $this->load->view('footer', $this->data);
    }




}

?>