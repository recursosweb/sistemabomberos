<?php

class Template extends CI_Controller {

    public $data = null;

    public function __construct() {
        parent::__construct();
    //    error_reporting(-1);
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

    public function index($mensaje = null) {
        $this->header();
        $this->load->view('index', $this->data);
        $this->footer();
    }

// BANNERS
    public function banner($mensaje = null) {
        $this->data['banner'] = $this->universal->query('SELECT * FROM banners');
        $this->header();
        $this->load->view('Template/banners', $this->data);
        $this->footer();
    }
    public function addBanner($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $titulo = htmlspecialchars($post['titulo']);
            function getRandomCode(){
                $an = "0123456789abcdefghijklmnopqrstuvwxyz*%#|ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $su = strlen($an) - 1;
                return substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }
            $codigoBanner = getRandomCode();
            $mi_imagen = 'imagen';
            $config['upload_path'] = "./imgTemplates/Banners/";
            $config['file_name'] = "banner-".$codigoBanner."";
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['overwrite'] = TRUE;
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($mi_imagen)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }
            $data['uploadSuccess'] = $this->upload->data();
            $ruta = $data['uploadSuccess'];

            $datos = array(
                    'titulo' => $titulo,
                    'imagen' => $ruta['file_name'],
                    'codigo' => $codigoBanner
                 );

            $this->universal->insert('banners', $datos);
            $this->session->set_flashdata('AddBanner','Banner Agregado!');
            header('location:'.base_url().'banners');
        }
    }

    public function UpdateBanner($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $titulo = htmlspecialchars($post['titulo']);
            $codigoBanner = htmlspecialchars($post['codigo']);
            $img = $_FILES['imagen'];
            if(!empty($img['tmp_name'])){
                $mi_imagen = 'imagen';
                $config['upload_path'] = "./imgTemplates/Banners/";
                $config['file_name'] = "banner-".$codigoBanner."";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['overwrite'] = TRUE;
                $config['max_size'] = "50000";
                $config['max_width'] = "2000";
                $config['max_height'] = "2000";
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($mi_imagen)) {
                    //*** ocurrio un error
                    $data['uploadError'] = $this->upload->display_errors();
                    echo $this->upload->display_errors();
                    return;
                }
                $data['uploadSuccess'] = $this->upload->data();
                $ruta = $data['uploadSuccess'];

                $datos = array(
                        'titulo' => $titulo,
                        'imagen' => $ruta['file_name'],
                     );

                $this->universal->update('banners',$datos,array('codigo' => $codigoBanner));
                $this->session->set_flashdata('UpdateBanner','Banner actualizado!');
                header('location:'.base_url().'banners');
            }else{
                $datos = array(
                        'titulo' => $titulo,
                     );

                $this->universal->update('banners',$datos,array('codigo' => $codigoBanner));
                $this->session->set_flashdata('UpdateBanner','Banner actualizado!');
                header('location:'.base_url().'banners');
            }
        }
    }

    public function DeleteBanner($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $codigoBanner = htmlspecialchars($post['codigo']);
            $this->universal->delete('banners',array('codigo' => $codigoBanner));
            $this->session->set_flashdata('DeleteBanner','Banner Borrado!');
            header('location:'.base_url().'banners');
        }
    }

    public function infoempresa($mensaje = null) {
        $this->data['info'] = $this->universal->query('SELECT * FROM infoempresa');
        $this->header();
        $this->load->view('Template/empresa', $this->data);
        $this->footer();
    }

     public function UpdateinfoEmpresa($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $id = htmlspecialchars($post['codigo']);
            $mision = htmlspecialchars($post['mision']);
            $vision = htmlspecialchars($post['vision']);
            $objetivo = htmlspecialchars($post['objetivo']);
            $datos = array(
                    'mision'    => $mision,
                    'vision'    => $vision,
                    'objetivo'  => $objetivo
                 );
            $this->universal->update('infoEmpresa',$datos,array('ID' => $id));
            $this->session->set_flashdata('UpdateBanner','Informacion actualizada!');
            header('location:'.base_url().'empresa');
        }
    }


// NOTICIAS
    public function noticias($mensaje = null) {
        $this->data['noticias'] = $this->universal->query('SELECT * FROM noticias');
        $this->header();
        $this->load->view('Template/noticias', $this->data);
        $this->footer();
    }

     public function addNoticia($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $titulo = htmlspecialchars($post['titulo']);
            $descripcion = htmlspecialchars($post['descripcion']);
            function getRandomCode(){
                $an = "0123456789abcdefghijklmnopqrstuvwxyz*/&%#!|ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $su = strlen($an) - 1;
                return substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }
            $codigoNoticia = getRandomCode();
            $mi_imagen = 'imagen';
            $config['upload_path'] = "./imgTemplates/Noticias/";
            $config['file_name'] = "noticia-".$codigoNoticia."";
            $config['allowed_types'] = "gif|jpg|jpeg|png";
            $config['overwrite'] = TRUE;
            $config['max_size'] = "5000000";
            $config['max_width'] = "200000";
            $config['max_height'] = "200000";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($mi_imagen)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                echo $this->upload->display_errors();
                return;
            }
            $data['uploadSuccess'] = $this->upload->data();
            $ruta = $data['uploadSuccess'];

            $datos = array(
                    'titulo'        => $titulo,
                    'descripcion'   => $descripcion,
                    'imagen'        => $ruta['file_name'],
                    'codigo'        => $codigoNoticia
                 );

            $this->universal->insert('noticias', $datos);
            $this->session->set_flashdata('AddBanner','Notica Agregada!');
            header('location:'.base_url().'noticias');
        }
    }

    public function UpdateNoticia($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $titulo = htmlspecialchars($post['titulo']);
            $descripcion = htmlspecialchars($post['descripcion']);
            $codigoNoticia = htmlspecialchars($post['codigo']);
            $img = $_FILES['imagen'];
            if(!empty($img['tmp_name'])){
                $mi_imagen = 'imagen';
                $config['upload_path'] = "./imgTemplates/Noticias/";
                $config['file_name'] = "banner-".$codigoNoticia."";
                $config['allowed_types'] = "gif|jpg|jpeg|png";
                $config['overwrite'] = TRUE;
                $config['max_size'] = "50000";
                $config['max_width'] = "2000";
                $config['max_height'] = "2000";
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload($mi_imagen)) {
                    //*** ocurrio un error
                    $data['uploadError'] = $this->upload->display_errors();
                    echo $this->upload->display_errors();
                    return;
                }
                $data['uploadSuccess'] = $this->upload->data();
                $ruta = $data['uploadSuccess'];

                $datos = array(
                        'titulo'        => $titulo,
                        'descripcion'   => $descripcion,
                        'imagen'        => $ruta['file_name'],
                     );

                $this->universal->update('noticias',$datos,array('codigo' => $codigoNoticia));
                $this->session->set_flashdata('UpdateBanner','Noticia Actualziada!');
                header('location:'.base_url().'noticias');
            }else{
                $datos = array(
                        'titulo'        => $titulo,
                        'descripcion'   => $descripcion,
                     );

                $this->universal->update('noticias',$datos,array('codigo' => $codigoNoticia));
                $this->session->set_flashdata('UpdateBanner','Noticia Actualziada!');
                header('location:'.base_url().'noticias');
            }
        }
    }
    
    public function DeleteNoticia($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $codigoNotica = htmlspecialchars($post['codigo']);
            $this->universal->delete('noticias',array('codigo' => $codigoNotica));
            $this->session->set_flashdata('DeleteBanner','Noticia Borrada!');
            header('location:'.base_url().'noticias');
        }
    }

    public function footer() {
        $this->load->view('footer', $this->data);
    }

// PDFS
    public function pdfs($mensaje = null) {
        $this->data['pdfs'] = $this->universal->query('SELECT * FROM pdfs');
        $this->header();
        $this->load->view('Template/pdf', $this->data);
        $this->footer();
    }

    public function addPDF($mensaje = null) {
        $post = $this->input->post();
        // if($post){
            $titulo = htmlspecialchars($post['titulo']);
            function getRandomCode(){
                $an = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
                $su = strlen($an) - 1;
                return substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1) .
                        substr($an, rand(0, $su), 1);
            }
            $codigopdf = getRandomCode();
            $mi_imagen = 'imagen';
            $config['upload_path'] = "./imgTemplates/PDFS/";
            $config['file_name'] = "pdf-".$codigopdf."";
            $config['allowed_types'] = "pdf";
            $config['overwrite'] = TRUE;
            $config['max_size'] = "50000000";
            $config['max_width'] = "20000000";
            $config['max_height'] = "20000000";
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload($mi_imagen)) {
                $this->session->set_flashdata('NotPDF','Solamente archivos PDF');
                header('location:'.base_url().'pdfs');
                return;
            }
            $data['uploadSuccess'] = $this->upload->data();
            $ruta = $data['uploadSuccess'];

            $datos = array(
                    'titulo' => $titulo,
                    'imagen' => $ruta['file_name'],
                    'codigo' => $codigopdf
                 );

            $this->universal->insert('pdfs', $datos);
            $this->session->set_flashdata('AddBanner','Pdf Agregado!');
            header('location:'.base_url().'pdfs');
        // }
    }

    public function DeletePDF($mensaje = null) {
        $post = $this->input->post();
        if($post){
            $codigoBanner = htmlspecialchars($post['codigo']);
            $this->universal->delete('pdfs',array('codigo' => $codigoBanner));
            $this->session->set_flashdata('DeleteBanner','Pdf Borrado!');
            header('location:'.base_url().'pdfs');
        }
    }



}

?>