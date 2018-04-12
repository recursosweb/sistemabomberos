    <!--ALEJANDRO SANCHEZ -->
    <!--PROGRAMADOR FULL STACK-->
    <!--Correo: aesh1415.as@gmail.com-->
    <!--Skype: aesh1415.as@gmail.com-->
    
<?php $dataUser = $this->session->all_userdata(); //debug($dataUser,false); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
        <title><?= "Bomberos Balzar" ?></title>
     <!--DESCRIPCION DE LA PAGINA PARA LOS NAVEGADORES-->
    <meta name="description" content="EMPRESA TECNOLOGICA DEDICADA AL DESARROLLO Y DISEÑO DE PAGINAS WEB A NIVEL NACIONAL E INTERNACIONAL">
    <!--LINK PARA EL ICONO EN EL NAVEGADOR-->
    <!--META PARA PERMITIR A DISPOSITIVOS-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, user-scalable=no">-->
    <!--LESS-->
    <link rel="stylesheet/less" type="text/css" href="<?= base_url() ?>less/main.less" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.min.js"></script>
    <!--BOOSTRAP-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!--JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!--JQUERY UI-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <!--SLIMSCROLL-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
    <!--ALERTYFI-->
    <script src="<?= base_url() ?>js/alertify/alertify.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>css/alertify/alertify.css">
    <link rel="stylesheet" href="<?= base_url() ?>css/alertify/default.css">
    <!--multiple select-->
    <link rel="stylesheet" href="<?= base_url() ?>css/chosen.css" />
    <!--js propios-->
    <script src="<?= base_url() ?>js/alejandro.js"></script>
    
    <!--fancibox-->
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="<?= base_url() ?>js/plugins/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>
    
    <!-- Add fancyBox -->
    <link rel="stylesheet" href="<?= base_url() ?>css/plugins/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= base_url() ?>js/plugins/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
    
    <!-- Optionally add helpers - button, thumbnail and/or media -->
    <link rel="stylesheet" href="<?= base_url() ?>css/plugins/fancybox/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= base_url() ?>js/plugins/fancybox/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <script type="text/javascript" src="<?= base_url() ?>js/plugins/fancybox/jquery.fancybox-media.js?v=1.0.6"></script>
    
    <!--datepicker-->
    <link rel="stylesheet" href="<?= base_url() ?>css/datepicker.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="<?= base_url() ?>css/datepicker.less" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= base_url() ?>js/bootstrap-datepicker.js"></script>  
    
    <link rel="stylesheet" href="<?= base_url() ?>css/plugins/fancybox/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
    <script type="text/javascript" src="<?= base_url() ?>js/plugins/fancybox/jquery.fancybox-thumbs.js?v=1.0.7"></script>  
    
    <!--archivos base-->
    <link href="<?= base_url() ?>css/animate.css" rel="stylesheet">
    <link href="<?= base_url() ?>css/style.css" rel="stylesheet">
    <!--datables-->
    <link href="<?= base_url() ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <!--formvalidation-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.formvalidation/0.6.1/css/formValidation.min.css">
    <script src="https://cdn.jsdelivr.net/g/jquery.formvalidation@0.6.1(js/formValidation.min.js+js/framework/bootstrap.min.js+js/framework/foundation.min.js+js/framework/pure.min.js+js/framework/semantic.min.js+js/framework/uikit.min.js+js/language/es_ES.js)"></script>
      
</head>
<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element">
                                <!--FOTO DE USUARIO-->
                            <span>
                                <!--<img alt="image" style="width: 100%;" class="img-circle" src="<?php base_url() ?>img/user/admin.jpg" />-->
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $dataUser['usuario'] ?></strong>
                                 </span> <span class="text-muted text-xs block"><?= $dataUser['rol'] ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <!--<li><a href="#">Perfil</a></li>-->
                                <li class="divider"></li>
                                <li><a href="panel/successlogout">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            AVA
                        </div>
                    </li>
                    <li id="lista1" class="active"><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> <span class="nav-label">Calculadora de Permisos</a></li>
                    <li id="lista1" class=""><a href="<?= base_url(); ?>web"><i class="fa fa-home"></i> <span class="nav-label">Web</a></li>
                        
                        <?php if($dataUser['contribuyente'] == "1"){ ?>
                        <!--contribuyentes-->
                            <li id="lista0" class="">
                                <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Contribuyentes</span> <span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li id="lista1-1"><a href="empresa"><i class="fa fa-building-o" aria-hidden="true"></i>Empresa</a></li>
                                    <li id="lista1-2"><a href="persona"><i class="fa fa-user" aria-hidden="true"></i>Persona</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['bienes'] == "1"){ ?>
                        <!--bienes-->
                            <li id="lista7">
                                <a href="#"><i class="fa fa-dropbox"></i> <span class="nav-label">Bienes</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista7-1"><a href="inmuebles"><i class="fa fa-building-o" aria-hidden="true"></i>Inmuebles</a></li>
                                    <li id="lista7-2"><a href="muebles"><i class="fa fa-bookmark" aria-hidden="true"></i>Muebles</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['Pfuncionamiento'] == "1"){ ?>
                        <!--permiso funcionamiento-->
                            <li id="lista2">
                                <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Permiso de Funcionamiento</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista2-1"><a href="Npermiso_funcionamiento"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Nuevo</a></li>
                                    <li id="lista2-2"><a href="RenovacionPermisoFuncionamiento"><i class="fa fa-refresh" aria-hidden="true"></i>Renovacion</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['Prodaje'] == "1"){ ?>
                        <!--permiso rodaje-->
                            <li id="lista3">
                                <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Permiso de Rodaje</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista3-1"><a href="Npermiso_Rodaje"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Nuevo</a></li>
                                    <li id="lista3-2"><a href="RenovacionPermisoRodaje"><i class="fa fa-refresh" aria-hidden="true"></i>Renovacion</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['Pconstruccion'] == "1"){ ?>
                        <!--permiso construccion-->
                            <li id="lista4">
                                <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Permiso de Construcción</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista4-1"><a href="Npermiso_Construccion"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Nuevo</a></li>
                                    <li id="lista4-2"><a href="RenovacionPermisoContruccion"><i class="fa fa-refresh" aria-hidden="true"></i>Renovacion</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['Pocasional'] == "1"){ ?>
                        <!--permiso ocasional-->
                            <li id="lista5">
                                <a href="#"><i class="fa fa-check-square-o"></i> <span class="nav-label">Permiso Ocasional</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista5-1"><a href="Npermiso_Ocasional"><i class="fa fa-plus-square-o" aria-hidden="true"></i>Nuevo</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($dataUser['Psistema'] == "1"){ ?>
                        <!--sistema-->
                            <li id="lista6">
                                <a href="#"><i class="fa fa-cog"></i> <span class="nav-label">Sistema</span><span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level collapse">
                                    <li id="lista66">
                                        <a href="#"><i class="fa fa-globe" aria-hidden="true"></i> <span class="nav-label">Configuracion de la pagina</span><span class="fa arrow"></span></a>
                                        <ul class="nav nav-second-level collapse">
                                            <li id="lista66-1"><a href="banners"><i class="fa fa-desktop" aria-hidden="true"></i>Banner</a></li>
                                            <li id="lista66-2"><a href="empresaInfo"><i class="fa fa-info" aria-hidden="true"></i>Empresa</a></li>
                                            <li id="lista66-3"><a href="noticias"><i class="fa fa-newspaper-o" aria-hidden="true"></i>Noticias</a></li>
                                            <li id="lista66-4"><a href="pdfs"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>PDF</a></li>
                                        </ul>
                                    </li>
                                    <li id="lista6-1"><a href="usuarios"><i class="fa fa-users" aria-hidden="true"></i>Usuarios</a></li>
                                    <li id="lista6-2"><a href="categoria_riesgos"><i class="fa fa-cubes" aria-hidden="true"></i>Categorias</a></li>
                                    <li id="lista6-9"><a href="subcategorias"><i class="fa fa-cubes" aria-hidden="true">Subcategorias</i></a></li>
                                    <li id="lista6-8"><a href="periodos"><i class="fa fa-calendar" aria-hidden="true"></i>Periodos</a></li>
                                    <li id="lista6-10"><a href="codigo_permisos"><i class="fa fa-codepen" aria-hidden="true"></i>Codigos de Permisos</a></li>
                                    <li id="lista6-3"><a href="valor_permisos"><i class="fa fa-usd" aria-hidden="true"></i>Gestión de valores</a></li>
                                    <li id="lista6-11"><a href="reportes"><i class="fa fa-file-text" aria-hidden="true"></i>Reportes</a></li>
                                    <li id="lista6-12"><a href="solicitud_inspeccion"><i class="fa fa-file-text" aria-hidden="true"></i>Solicitud de Inspeccion</a></li>
                                    <li id="lista6-4"><a href="mantenimiento_inmuebles"><i class="fa fa-wrench" aria-hidden="true"></i>Mantenimiento de Inmuebles</a></li>
                                    <li id="lista6-6"><a href="tipo_inmuebles"><i class="fa fa-wrench" aria-hidden="true"></i>Mantenimiento de Tipos de Inmuebles</a></li>
                                    <li id="lista6-5"><a href="mantenimiento_muebles"><i class="fa fa-wrench" aria-hidden="true"></i>Mantenimiento de Muebles</a></li>
                                    <li id="lista6-7"><a href="tipo_muebles"><i class="fa fa-wrench" aria-hidden="true"></i>Mantenimiento de Tipos de Muebles</a></li>
                                </ul>
                            </li>
                        <?php } ?>
                </ul>
            </div>
        </nav>

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li>
                        <a href="panel/successlogout">
                            <i class="fa fa-sign-out"></i> Cerrar Sesión
                        </a>
                    </li>
                </ul>
            </nav>
        </div>