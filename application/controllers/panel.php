<?php

class Panel extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
    //    error_reporting(-1);
   //     ini_set('display_errors', '1');
        date_default_timezone_set('America/Guayaquil');
        $this->load->library('M_pdf');
    }

    public function header() {
        $cookie = get_cookie('usuario');
        if($cookie){
            $this->load->view('header', $this->data);
        }else{
            header('location:'.base_url().'web');
        }
    }

    public function index($mensaje = null) {
        $this->data['empresa'] = $this->universal->query('SELECT * FROM empresa');
        $this->data['persona'] = $this->universal->query('SELECT * FROM persona');
        $this->data['inmuebles'] = $this->universal->query('SELECT * FROM inmuebles');
        $this->data['mueble'] = $this->universal->query('SELECT * FROM mueble');
        $this->data['permisos'] = $this->universal->query('SELECT * FROM código_permisos');
        $this->header();
        $this->load->view('index', $this->data);
        $this->footer();
    }

    public function getBienes(){
        $contribuyente = $_POST['contribuyente'];
        $bien = $_POST['tipoBien'];
        if($bien == "I"){
            $query = $this->universal->query('SELECT * FROM inmuebles WHERE id_propietario = "'.$contribuyente.'"');
            if($query){
                $data = $query;
                echo json_encode($data);
            }else{
                $data = "0";
                echo json_encode($data);
            }
        }
        if($bien == "M"){
            $query = $this->universal->query('SELECT * FROM mueble WHERE id_propietario = "'.$contribuyente.'"');
            if($query){
                $data = $query;
                echo json_encode($data);
            }else{
                $data = "0";
                echo json_encode($data);
            }
        }
    }

    public function valorCate(){
        if(isset($_POST['categoria']) and isset($_POST['permiso'])){
            $bien = $_POST['categoria'];
            $porciones = explode("|", $bien);
            $categoria =  $porciones[0]; // categoria
            $subcategoria = $porciones[1]; // subcategoria
            // permiso
            $permiso = $_POST['permiso'];
            $porciones1 = explode("|", $permiso);
            $id_permiso =  $porciones1[0]; // categoria
            $permiso = $porciones1[1]; // subcategoria

            $query = $this->universal->query('SELECT * FROM mantenimiento_rubro WHERE id_permiso = '.$id_permiso.' AND id_categoria = '.$categoria.' AND id_subcategoria = '.$subcategoria.' ');
                if($query){
                    echo json_encode($query[0]);
                }else{
                    echo json_encode('00');
                }

        }else{
            echo json_encode('0');
        }

    }

    public function imprimerTotalPermiso(){
        $porciones = explode("|", $_POST['Permiso']);
        $totalPermiso = $_POST['valor'];
        $nombrePermiso = $porciones[1];
        $contribuyente = $_POST['contribuyente'];
        $ruta = base_url();

            $html = '
            <!DOCTYPE html>
            <html lang="es">
                <head>
                
                </head>
                <body>
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 style="float: left;width: 30.33%;text-align: center;border-bottom: 1px solid;background: #23c6c8;color: white;">Numero de cuenta: 2100068218</h3>
                            <h3 style="float: left;width: 30.33%;text-align: center;border-bottom: 1px solid;background: #23c6c8;color: white;"> Total a pagar: <br> $'.$totalPermiso.'</h3>
                            <h3 style="width: 34.33%;float: left;text-align: center;border-bottom: 1px solid;background: #23c6c8;color: white;">Beneficiario: Cuerpo de bomberos balzar</h3>
                        </div>
                            
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div style="width: 50%;float: left;text-align: center;">Contribuyente: '.$contribuyente.'</div>
                                <div style="width: 50%;float: left;text-align: center;">Tipo de Permiso: '.$nombrePermiso.'</div>
                            </div>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <img src="'.$ruta.'img/logo1.png" style="margin-top: 80px;">
                    </div>

                </body>
            </html>
            ';
            // echo $html;
        $pdfFilePath = "reciboPago".$contribuyente.".pdf";

        // generar pdf en base html
        $this->m_pdf->pdf->WriteHTML($html);
        // descargar pdf
        $this->m_pdf->pdf->Output($pdfFilePath, "D");

    } 


// FIN DE LA CALCULADORA

    public function template(){
        $this->data['banner'] = $this->universal->query('SELECT * FROM banners');
        $this->data['infoEmpresa'] = $this->universal->query('SELECT * FROM infoempresa');
        $this->data['noticias'] = $this->universal->query('SELECT * FROM noticias');
        $this->data['pdfs'] = $this->universal->query('SELECT * FROM pdfs');
        $this->load->view('template', $this->data);
    }

    public function usuarios($mensaje = null) {
        // $hola = $this->session->all_userdata();
        $this->data['usuarios'] = $this->universal->query('SELECT * FROM usuarios');
        $this->header();
        $this->load->view('Sistema/usuarios', $this->data);
        $this->footer();
    }
    
    public function add_usuario(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $sqlUser = $this->universal->query('SELECT * FROM usuarios WHERE usuario = "'.$_POST['usuario'].'" ');
            if(!$sqlUser){
                $sqlCorreo = $this->universal->query('SELECT * FROM usuarios WHERE usuario = "'.$_POST['correo'].'" ');
                if(!$sqlCorreo){
                    function getRandomCode(){
                                $an = "0123456789abcdefghijklmnopqrstuvwxyz*{}[]-_.,:;+()/&%#!|ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                $su = strlen($an) - 1;
                                return substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1) .
                                        substr($an, rand(0, $su), 1);
                            }
                    $var = getRandomCode();
                    // SE CODIFICA EL TOKEN 
                    $token = $this->bcrypt->hash_password($var);
                    $usuario = htmlspecialchars($post['usuario']);
                    $pass = htmlspecialchars($post['clave']);
                    $clave = $this->encrypt->encode($pass);
                    // debug($clave);
                    $correo = htmlspecialchars($post['correo']);
                    $status = htmlspecialchars($post['status']);
                    $rol = htmlspecialchars($post['rol']);
                    // modulo contribuyente
                    $MContribuyente = htmlspecialchars($post['MContribuyente']);
                    $MContribuyenteA = htmlspecialchars($post['MContribuyenteA']);
                    $MContribuyenteE = htmlspecialchars($post['MContribuyenteE']);
                    $MContribuyenteD = htmlspecialchars($post['MContribuyenteD']);
                    // modulo bienes
                    $MBienes = htmlspecialchars($post['MBienes']);
                    $MBienesA = htmlspecialchars($post['MBienesA']);
                    $MBienesE = htmlspecialchars($post['MBienesE']);
                    $MBienesD = htmlspecialchars($post['MBienesD']);
                    // modulo Permiso de funcionamiento
                    $MPFuncionamiento = htmlspecialchars($post['MPFuncionamiento']);
                    $MPFuncionamientoA = htmlspecialchars($post['MPFuncionamientoA']);
                    $MPFuncionamientoE = htmlspecialchars($post['MPFuncionamientoE']);
                    $MPFuncionamientoD = htmlspecialchars($post['MPFuncionamientoD']);
                    // modulo Permiso de rodaje
                    $MPRodaje = htmlspecialchars($post['MPRodaje']);
                    $MPRodajeA = htmlspecialchars($post['MPRodajeA']);
                    $MPRodajeE = htmlspecialchars($post['MPRodajeE']);
                    $MPRodajeD = htmlspecialchars($post['MPRodajeD']);
                    // modulo Permiso de construccion
                    $MPContruccion = htmlspecialchars($post['MPContruccion']);
                    $MPContruccionA = htmlspecialchars($post['MPContruccionA']);
                    $MPContruccionE = htmlspecialchars($post['MPContruccionE']);
                    $MPContruccionD = htmlspecialchars($post['MPContruccionD']);
                    // modulo Permiso de ocasional
                    $MPOcasional = htmlspecialchars($post['MPOcasional']);
                    $MPOcasionalA = htmlspecialchars($post['MPOcasionalA']);
                    $MPOcasionalE = htmlspecialchars($post['MPOcasionalE']);
                    $MPOcasionalD = htmlspecialchars($post['MPOcasionalD']);
                    // modulo Permiso de sistema
                    $MSistema = htmlspecialchars($post['MSistema']);
                    $MSistemaA = htmlspecialchars($post['MSistemaA']);
                    $MSistemaE = htmlspecialchars($post['MSistemaE']);
                    $MSistemaD = htmlspecialchars($post['MSistemaD']);
                    // accesos
                    
                    $datosU = array(
                            'usuario'       =>  $usuario,
                            'clave'         =>  $clave,
                            'correo'        =>  $correo,
                            'activo'        =>  $status,
                            'rol'           =>  $rol,
                            'token'         =>  $token
                        );
                        
                    $datosA = array(
                            'token'                     =>  $token,
                            'MContribuyente'            =>  $MContribuyente,
                            'MContribuyenteA'           =>  $MContribuyenteA,
                            'MContribuyenteE'           =>  $MContribuyenteE,
                            'MContribuyenteD'           =>  $MContribuyenteD,
                            'MBienes'                   =>  $MBienes,
                            'MBienesA'                  =>  $MBienesA,
                            'MBienesE'                  =>  $MBienesE,
                            'MBienesD'                  =>  $MBienesD,
                            'MPFuncionamiento'          =>  $MPFuncionamiento,
                            'MPFuncionamientoA'         =>  $MPFuncionamientoA,
                            'MPFuncionamientoE'         =>  $MPFuncionamientoE,
                            'MPFuncionamientoD'         =>  $MPFuncionamientoD,
                            'MPRodaje'                  =>  $MPRodaje,
                            'MPRodajeA'                 =>  $MPRodajeA,
                            'MPRodajeE'                 =>  $MPRodajeE,
                            'MPRodajeD'                 =>  $MPRodajeD,
                            'MPContruccion'             =>  $MPContruccion,
                            'MPContruccionA'            =>  $MPContruccionA,
                            'MPContruccionE'            =>  $MPContruccionE,
                            'MPContruccionD'            =>  $MPContruccionD,
                            'MPOcasional'               =>  $MPOcasional,
                            'MPOcasionalA'              =>  $MPOcasionalA,
                            'MPOcasionalE'              =>  $MPOcasionalE,
                            'MPOcasionalD'              =>  $MPOcasionalD,
                            'MSistema'                  =>  $MSistema,
                            'MSistemaA'                 =>  $MSistemaA,
                            'MSistemaE'                 =>  $MSistemaE,
                            'MSistemaD'                 =>  $MSistemaD,
                        );
                    
                    $this->universal->insert('usuarios', $datosU);
                    $this->universal->insert('accesos', $datosA);
                    $this->session->set_flashdata('AddUsuario','Usuario Registrado exitosamente!');
                    header('location:'.base_url().'usuarios');
                    
                }else{
                    $this->session->set_flashdata('ExistCorreo','El correo ya existe!');
                    header('location:'.base_url().'usuarios');
                }
            }else{
                $this->session->set_flashdata('ExistUsuario','El usuario ya existe!');
                header('location:'.base_url().'usuarios');
            }
        }
    }
    
    public function Update_usuario(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $token = htmlspecialchars($post['token']);
            $pass = htmlspecialchars($post['clave']);
            $clave = $this->encrypt->encode($pass);;
            // debug($clave);
            $status = htmlspecialchars($post['status']);
            $rol = htmlspecialchars($post['rol']);
            // modulo contribuyente
            $MContribuyente = htmlspecialchars($post['MContribuyente']);
            $MContribuyenteA = htmlspecialchars($post['MContribuyenteA']);
            $MContribuyenteE = htmlspecialchars($post['MContribuyenteE']);
            $MContribuyenteD = htmlspecialchars($post['MContribuyenteD']);
            // modulo bienes
            $MBienes = htmlspecialchars($post['MBienes']);
            $MBienesA = htmlspecialchars($post['MBienesA']);
            $MBienesE = htmlspecialchars($post['MBienesE']);
            $MBienesD = htmlspecialchars($post['MBienesD']);
            // modulo Permiso de funcionamiento
            $MPFuncionamiento = htmlspecialchars($post['MPFuncionamiento']);
            $MPFuncionamientoA = htmlspecialchars($post['MPFuncionamientoA']);
            $MPFuncionamientoE = htmlspecialchars($post['MPFuncionamientoE']);
            $MPFuncionamientoD = htmlspecialchars($post['MPFuncionamientoD']);
            // modulo Permiso de rodaje
            $MPRodaje = htmlspecialchars($post['MPRodaje']);
            $MPRodajeA = htmlspecialchars($post['MPRodajeA']);
            $MPRodajeE = htmlspecialchars($post['MPRodajeE']);
            $MPRodajeD = htmlspecialchars($post['MPRodajeD']);
            // modulo Permiso de construccion
            $MPContruccion = htmlspecialchars($post['MPContruccion']);
            $MPContruccionA = htmlspecialchars($post['MPContruccionA']);
            $MPContruccionE = htmlspecialchars($post['MPContruccionE']);
            $MPContruccionD = htmlspecialchars($post['MPContruccionD']);
            // modulo Permiso de ocasional
            $MPOcasional = htmlspecialchars($post['MPOcasional']);
            $MPOcasionalA = htmlspecialchars($post['MPOcasionalA']);
            $MPOcasionalE = htmlspecialchars($post['MPOcasionalE']);
            $MPOcasionalD = htmlspecialchars($post['MPOcasionalD']);
            // modulo Permiso de sistema
            $MSistema = htmlspecialchars($post['MSistema']);
            $MSistemaA = htmlspecialchars($post['MSistemaA']);
            $MSistemaE = htmlspecialchars($post['MSistemaE']);
            $MSistemaD = htmlspecialchars($post['MSistemaD']);
            // accesos
            
            $datosU = array(
                    'clave'         =>  $clave,
                    'activo'        =>  $status,
                    'rol'           =>  $rol,
                );
                
            $datosA = array(
                    'MContribuyente'            =>  $MContribuyente,
                    'MContribuyenteA'           =>  $MContribuyenteA,
                    'MContribuyenteE'           =>  $MContribuyenteE,
                    'MContribuyenteD'           =>  $MContribuyenteD,
                    'MBienes'                   =>  $MBienes,
                    'MBienesA'                  =>  $MBienesA,
                    'MBienesE'                  =>  $MBienesE,
                    'MBienesD'                  =>  $MBienesD,
                    'MPFuncionamiento'          =>  $MPFuncionamiento,
                    'MPFuncionamientoA'         =>  $MPFuncionamientoA,
                    'MPFuncionamientoE'         =>  $MPFuncionamientoE,
                    'MPFuncionamientoD'         =>  $MPFuncionamientoD,
                    'MPRodaje'                  =>  $MPRodaje,
                    'MPRodajeA'                 =>  $MPRodajeA,
                    'MPRodajeE'                 =>  $MPRodajeE,
                    'MPRodajeD'                 =>  $MPRodajeD,
                    'MPContruccion'             =>  $MPContruccion,
                    'MPContruccionA'            =>  $MPContruccionA,
                    'MPContruccionE'            =>  $MPContruccionE,
                    'MPContruccionD'            =>  $MPContruccionD,
                    'MPOcasional'               =>  $MPOcasional,
                    'MPOcasionalA'              =>  $MPOcasionalA,
                    'MPOcasionalE'              =>  $MPOcasionalE,
                    'MPOcasionalD'              =>  $MPOcasionalD,
                    'MSistema'                  =>  $MSistema,
                    'MSistemaA'                 =>  $MSistemaA,
                    'MSistemaE'                 =>  $MSistemaE,
                    'MSistemaD'                 =>  $MSistemaD,
                );
            $this->universal->update('usuarios',$datosU,array('token' => $token));
            $this->universal->update('accesos',$datosA,array('token' => $token));
            $this->session->set_flashdata('UpdateUsuario','Usuario Modificado exitosamente!');
            header('location:'.base_url().'usuarios');
        }
    }
    
    public function Delete_usuario(){
        $post = $this->input->post();
        if($post){
            // debug($post);
            $token = htmlspecialchars($post['token']);
            $this->universal->delete('usuarios',array('token' => $token));
            $this->universal->delete('accesos',array('token' => $token));
            $this->session->set_flashdata('deleteUsuario','Usuario eliminado exitosamente!');
            header('location:'.base_url().'usuarios');
        }
    }

    // login
    public function login($mensaje = null) {

         $cookie = get_cookie('usuario');
        if($cookie){
            header('location:'.base_url());
        }else{
            $this->load->view('login', $this->data);
        }
    }

    public function SuccessLogin(){
        $post = $this->input->post();
        if($post){
            $user = $this->universal->query('SELECT * FROM usuarios WHERE usuario = "'.$post['usuario'].'" ');
            if($user){
                $pas = $post['clave'];
                $clave = $user[0]['clave'];
                $pass = $clave = $this->encrypt->decode($clave);
                if($pas == $pass){
                    $usuario = htmlspecialchars($post['usuario']);
                    $clave = htmlspecialchars($post['clave']);
                    $datosUser = $this->universal->query('SELECT * FROM usuarios WHERE usuario = "'.$usuario.'"');
                    if($datosUser[0]['activo'] == "1"){
                        $token = $datosUser[0]['token'];
                        $permisos = $this->universal->query('SELECT * FROM accesos WHERE token = "'.$token.'"');
                        $expire = 43200; 
                        $data = array(
                                'is_logued_in' 	                    => 	TRUE,
                                'token' 	                        => 	$token,
                                'usuario' 	                        => 	$datosUser[0]['usuario'],
                                'rol' 	                            => 	$datosUser[0]['rol'],
                                // modulo contribuyente
                                'contribuyente' 	                => 	$permisos[0]['MContribuyente'],
                                'contribuyenteA' 	                => 	$permisos[0]['MContribuyenteA'],
                                'contribuyenteE' 	                => 	$permisos[0]['MContribuyenteE'],
                                'contribuyenteD' 	                => 	$permisos[0]['MContribuyenteD'],
                                // modulo bienes
                                'bienes' 	                        => 	$permisos[0]['MBienes'],
                                'bienesA' 	                        => 	$permisos[0]['MBienesA'],
                                'bienesE' 	                        => 	$permisos[0]['MBienesE'],
                                'bienesD' 	                        => 	$permisos[0]['MBienesD'],
                                // modulo permiso de funcionamiento
                                'Pfuncionamiento' 	                => 	$permisos[0]['MPFuncionamiento'],
                                'PfuncionamientoA' 	                => 	$permisos[0]['MPFuncionamientoA'],
                                'PfuncionamientoE' 	                => 	$permisos[0]['MPFuncionamientoE'],
                                'PfuncionamientoD' 	                => 	$permisos[0]['MPFuncionamientoD'],
                                // modulo permiso de rodaje
                                'Prodaje' 	                        => 	$permisos[0]['MPRodaje'],
                                'ProdajeA' 	                        => 	$permisos[0]['MPRodajeA'],
                                'ProdajeE' 	                        => 	$permisos[0]['MPRodajeE'],
                                'ProdajeD' 	                        => 	$permisos[0]['MPRodajeD'],
                                // modulo permiso de construccion
                                'Pconstruccion' 	                => 	$permisos[0]['MPContruccion'],
                                'PconstruccionA' 	                => 	$permisos[0]['MPContruccionA'],
                                'PconstruccionE' 	                => 	$permisos[0]['MPContruccionE'],
                                'PconstruccionD' 	                => 	$permisos[0]['MPContruccionD'],
                                // modulo permiso ocasional
                                'Pocasional' 	                    => 	$permisos[0]['MPOcasional'],
                                'PocasionalA' 	                    => 	$permisos[0]['MPOcasionalA'],
                                'PocasionalE' 	                    => 	$permisos[0]['MPOcasionalE'],
                                'PocasionalD' 	                    => 	$permisos[0]['MPOcasionalD'],
                                // modulo permiso sistema
                                'Psistema' 	                        => 	$permisos[0]['MSistema'],
                                'PsistemaA' 	                    => 	$permisos[0]['MSistemaA'],
                                'PsistemaE' 	                    => 	$permisos[0]['MSistemaE'],
                                'PsistemaD' 	                    => 	$permisos[0]['MSistemaD'],
                            );
                            
                            $this->session->set_userdata($data);
                            // $this->session->all_userdata();
                            set_cookie('usuario', $token, $expire);
                            header('location:'.base_url());
                            
                    }else if($datosUser[0]['activo'] == "0"){
                        $this->session->set_flashdata('UserNoActivated','Usuario no activado!');
                        header('location:'.base_url().'login');
                    }
                }else{
                    $this->session->set_flashdata('NoExistClave','Contraseña Incorrecta!');
                    header('location:'.base_url().'login');
                }
            }else{
                $this->session->set_flashdata('NoExistUsuario','Usuario Incorrecto!');
                header('location:'.base_url().'login');
            }
        }
    }
    
    public function successlogout(){
        $this->session->unset_userdata('logged_in');
        session_destroy();
        $this->session->sess_destroy();
        delete_cookie('usuario');
        redirect(base_url().'login');
    }

    public function footer() {
        $this->load->view('footer', $this->data);
    }

}

?>