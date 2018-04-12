<?php

class Pdfs extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
    //    error_reporting(-1);
   //     ini_set('display_errors', '1');
        date_default_timezone_set('America/Guayaquil');
        $this->load->library('M_pdf');
    }

    public function pdfPermisoFuncionamiento(){
        // debug($_POST);
        $contribuyente = $_POST['contribuyente'];
        $fecha_creacion = $_POST['fecha_creacion'];
        $fecha_caducidad = $_POST['fecha_caducidad'];
        $total_permiso = $_POST['total_permiso'];
        $n_permiso = $_POST['n_permiso'];
        $id_bien = $_POST['id_bien'];
        $ruta = base_url();
        $fechaActual = date("Y-m-d");
        $sqlM = $this->universal->query('SELECT * FROM mueble WHERE placa = "'.$id_bien.'" ');
            if($sqlM){
                $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
                $bien = $sqlM[0];
                // debug($bien);
                if($sqlP){
                    $persona = $sqlP[0];
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "PFuncionamiento".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
                }else{
                    $sqlE = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlE[0];
                    $html = '<? session_start() ?> 
                            <!DOCTYPE html>
                            <html lang="es">
                                <head>
                                
                                </head>
                                <body style="">
                                    <div style="width: 30%; float: left" >
                                        <img src="'.$ruta.'img/logo1.png">
                                    </div>
                                    <div>
                                        <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                        <h5 style="text-align: center;">DEPARTAMENTO DE TESORERIA</h5>
                                        <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                        <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                        <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <<br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <br>

                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$Empresa["nombres"].' '.$Empresa["apellidos"].' '.$Empresa["ruc"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <br>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>

                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "PFuncionamiento".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                }
        }else{
            $sqlI = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = "'.$id_bien.'" ');
            $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
            $bien = $sqlI[0];
            if($sqlP){
                    $persona = $sqlP[0];
                    // debug($persona);
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "PFuncionamiento".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
            }else{
                $sqlP = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlP[0];
                    // debug($Empresa);S
                    $html = '<? session_start() ?> 
                            <!DOCTYPE html>
                            <html lang="es">
                                <head>
                                
                                </head>
                                <body style="">
                                    <div style="width: 30%; float: left" >
                                        <img src="'.$ruta.'img/logo1.png">
                                    </div>
                                    <div>
                                        <h5 style="text-align: center;">CUERPOS DE BOMBEROS CANTON BALZAR</h5>
                                        <h5 style="text-align: center;">DEPARTAMENTO DE TESORERIA</h5>
                                        <h5 style="text-align: center;">Direccion: 9 de Octubre y Daule</h5>
                                        <h5 style="text-align: center;">Telefono: 2030-133 Emergencia 911</h5>
                                        <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <<br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <br>

                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$Empresa["nombres"].' '.$Empresa["apellidos"].' '.$Empresa["ruc"].'</strong></h5>
                                        <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <br>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>

                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "PFuncionamiento".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
            }
        }


    } 
 
    public function pdfPermisoRodaje(){
            // debug($_POST);
            $contribuyente = $_POST['contribuyente'];
            $fecha_creacion = $_POST['fecha_creacion'];
            $fecha_caducidad = $_POST['fecha_caducidad'];
            $total_permiso = $_POST['total_permiso'];
            $n_permiso = $_POST['n_permiso'];
            $id_bien = $_POST['id_bien'];
            $ruta = base_url();
            $fechaActual = date("Y-m-d");
            $sqlM = $this->universal->query('SELECT * FROM mueble WHERE placa = "'.$id_bien.'" ');
                if($sqlM){
                    $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
                    $bien = $sqlM[0];
                    // debug($bien);
                    if($sqlP){
                        $persona = $sqlP[0];
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
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">PERMISO DE TRANSPORTE</h5>
                                        </div>
                                        <br><br><br><br><br><br><br>
                                        <div>
                                            <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                            <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                            <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                            <h5>PLACA: <strong style="border-bottom: 1px solid;">'.$bien["placa"].'</strong></h5>
                                            <h5>MODELO: <strong style="border-bottom: 1px solid;">'.$bien["modelo"].'</strong></h5>
                                            <h5>MARCA: <strong style="border-bottom: 1px solid;">'.$bien["marca"].'</strong></h5>
                                            <h5>PERMISO DE RODAJE CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                            <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                            <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                            
                                        </div>
                                    </body>
                                </html>
                                ';
                                $pdfFilePath = "PRodaje".$contribuyente.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                                // echo $html;
                    }else{
                        $sqlE = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                        $Empresa = $sqlE[0];
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
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">PERMISO DE TRANSPORTE</h5>
                                        </div>
                                        <br><br><br><br><br><br><br>>
                                        <div>
                                            <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                            <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["ruc"].'</strong></h5>
                                            <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                            <h5>PLACA: <strong style="border-bottom: 1px solid;">'.$bien["placa"].'</strong></h5>
                                            <h5>MODELO: <strong style="border-bottom: 1px solid;">'.$bien["modelo"].'</strong></h5>
                                            <h5>MARCA: <strong style="border-bottom: 1px solid;">'.$bien["marca"].'</strong></h5>
                                            <h5>PERMISO DE RODAJE CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                            <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                            <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                            
                                        </div>
                                    </body>
                                </html>
                                ';
                                // echo $html;
                                $pdfFilePath = "PRodaje".$contribuyente.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                    }
                
            
            }else{
                $sqlI = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = "'.$id_bien.'" ');
                $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
                $bien = $sqlI[0];
                if($sqlP){
                        $persona = $sqlP[0];
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
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">PERMISO DE TRANSPORTE</h5>
                                        </div>
                                        <br><br><br><br><br><br><br>
                                        <div>
                                            <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                            <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                            <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                            <h5>PLACA: <strong style="border-bottom: 1px solid;">'.$bien["placa"].'</strong></h5>
                                            <h5>MODELO: <strong style="border-bottom: 1px solid;">'.$bien["modelo"].'</strong></h5>
                                            <h5>MARCA: <strong style="border-bottom: 1px solid;">'.$bien["marca"].'</strong></h5>
                                            <h5>PERMISO DE RODAJE CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                            <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                            <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                            
                                        </div>
                                    </body>
                                </html>
                                ';
                                $pdfFilePath = "PRodaje".$contribuyente.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                                // echo $html;
                }else{
                    $sqlP = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                        $Empresa = $sqlP[0];
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
                                            <h5 style="text-align: center;">Ruc: 0968577130001</h5>
                                            <h5 style="text-align: center;">PERMISO DE TRANSPORTE</h5>
                                        </div>
                                        <br><br><br><br><br><br><br>
                                        <div>
                                            <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                            <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["ruc"].'</strong></h5>
                                            <h5>COMERCIAL: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                            <h5>PLACA: <strong style="border-bottom: 1px solid;">'.$bien["placa"].'</strong></h5>
                                            <h5>MODELO: <strong style="border-bottom: 1px solid;">'.$bien["modelo"].'</strong></h5>
                                            <h5>MARCA: <strong style="border-bottom: 1px solid;">'.$bien["marca"].'</strong></h5>
                                            <h5>PERMISO DE RODAJE CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                            <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                            <br>
                                            <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                            <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                            
                                        </div>
                                    </body>
                                </html>
                                ';
                                // echo $html;
                                $pdfFilePath = "PRodaje".$contribuyente.".pdf";
                                // generar pdf en base html
                                $this->m_pdf->pdf->WriteHTML($html);
                                // descargar pdf
                                $this->m_pdf->pdf->Output($pdfFilePath, "D");
                }
            }


    } 

    public function pdfPermisoConstruccion(){
        // debug($_POST);
        $contribuyente = $_POST['contribuyente'];
        $fecha_creacion = $_POST['fecha_creacion'];
        $fecha_caducidad = $_POST['fecha_caducidad'];
        $total_permiso = $_POST['total_permiso'];
        $n_permiso = $_POST['n_permiso'];
        $id_bien = $_POST['id_bien'];
        $ruta = base_url();
        $fechaActual = date("Y-m-d");
        $sqlM = $this->universal->query('SELECT * FROM mueble WHERE placa = "'.$id_bien.'" ');
            if($sqlM){
                $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
                $bien = $sqlM[0];
                // debug($bien);
                if($sqlP){
                    $persona = $sqlP[0];
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
                                        <h5 style="text-align: center;">PERMISO DE CONSTRUCCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>CONSTRUCCION DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE CONSTRUCCION CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "PConstruccion".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
                }else{
                    $sqlE = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlE[0];
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
                                        <h5 style="text-align: center;">PERMISO DE CONSTRUCCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["ruc"].'</strong></h5>
                                        <h5>CONSTRUCCION DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE CONSTRUCCION CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "PConstruccion".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                }
            
        
        }else{
            $sqlI = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = "'.$id_bien.'" ');
            $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
            $bien = $sqlI[0];
            if($sqlP){
                    $persona = $sqlP[0];
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
                                        <h5 style="text-align: center;">PERMISO DE CONSTRUCCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>CONSTRUCCION DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE CONSTRUCCION CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "PConstruccion".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
            }else{
                $sqlP = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlP[0];
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
                                        <h5 style="text-align: center;">PERMISO DE CONSTRUCCION</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["ruc"].'</strong></h5>
                                        <h5>CONSTRUCCION DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>ACTIVIDAD ECONOMICA: <strong style="border-bottom: 1px solid;">'.$bien["actividad_economica"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE CONSTRUCCION CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "PConstruccion".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
            }
        }


    } 

    public function pdfPermisoOcasional(){
        // debug($_POST);
        $contribuyente = $_POST['contribuyente'];
        $fecha_creacion = $_POST['fecha_creacion'];
        $fecha_caducidad = $_POST['fecha_caducidad'];
        $total_permiso = $_POST['total_permiso'];
        $n_permiso = $_POST['n_permiso'];
        $id_bien = $_POST['id_bien'];
        $ruta = base_url();
        $fechaActual = date("Y-m-d");
        $sqlM = $this->universal->query('SELECT * FROM mueble WHERE placa = "'.$id_bien.'" ');
            if($sqlM){
                $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
                $bien = $sqlM[0];
                // debug($bien);
                if($sqlP){
                    $persona = $sqlP[0];
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>PERMISO OCACIONAL DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "POcasional".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
                }else{
                    $sqlE = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlE[0];
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["ruc"].'</strong></h5>
                                        <h5>PERMISO OCACIONAL DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "POcasional".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                }
            
        
        }else{
            $sqlI = $this->universal->query('SELECT * FROM inmuebles WHERE clave_catastral = "'.$id_bien.'" ');
            $sqlP = $this->universal->query('SELECT * FROM persona WHERE cedula = "'.$contribuyente.'" ');
            $bien = $sqlI[0];
            if($sqlP){
                    $persona = $sqlP[0];
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$persona["nombres"].' '.$persona["apellidos"].' '.$persona["cedula"].'</strong></h5>
                                        <h5>PERMISO OCACIONAL DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            $pdfFilePath = "POcasional".$contribuyente.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
                            // echo $html;
            }else{
                $sqlP = $this->universal->query('SELECT * FROM empresa WHERE ruc = "'.$contribuyente.'" ');
                    $Empresa = $sqlP[0];
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
                                        <h5 style="text-align: center;">TASA DE FUNCIONAMIENTO</h5>
                                        <h5 style="text-align: center;">De acuerdo al articulo 35 de la LA LEY DE DEFENSA CONTRA INCENDIOS, segun decreto 3109-A <br> publicado en el Registro Oficial N° 747 del 9 de enero de 1979 </h5>
                                    </div>
                                    <div>
                                        <h5>VALOR $: <strong style="border-bottom: 1px solid;">'.$total_permiso.'</strong></h5>
                                        <h5>NOMBRE: <strong style="border-bottom: 1px solid;">'.$Empresa["nombre_empresa"].' '.$persona["ruc"].'</strong></h5>
                                        <h5>PERMISO OCACIONAL DE: <strong style="border-bottom: 1px solid;">'.$bien["clase_bien"].'</strong></h5>
                                        <h5>DIRECCION: <strong style="border-bottom: 1px solid;">'.$bien["ubicacion"].'</strong></h5>
                                        <h5>PERMISO DE FUNCIONAMIENTO CORRESPONDIENTE AL AÑO: <strong style="border-bottom: 1px solid;">'.$fecha_creacion.'</strong></h5>
                                        <h5 style="float: right;">Balzar del <strong style="border-bottom: 1px solid;">'.$fechaActual.'</strong></h5>
                                        <h5 style="">COMANDANTE-PRIMER JEFE: _______________________</h5>
                                        <h5 style="">INSPECTOR: _______________________</h5>
                                        <h5 style="">TESORERIA: _______________________</h5>
                                        <br>
                                        <h5 style="text-align: center">CADUCA: <strong style="border-bottom: 1px solid;">'.$fecha_caducidad.'</strong> RENOVABLE CADA AÑO</h5>

                                        <h5 style="text-align: right">N° Permiso: <strong>'.$n_permiso.'</strong></h5>
                                        
                                    </div>
                                </body>
                            </html>
                            ';
                            // echo $html;
                            $pdfFilePath = "POcasional".$n_permiso.".pdf";
                            // generar pdf en base html
                            $this->m_pdf->pdf->WriteHTML($html);
                            // descargar pdf
                            $this->m_pdf->pdf->Output($pdfFilePath, "D");
            }
        }


    } 

}
?>