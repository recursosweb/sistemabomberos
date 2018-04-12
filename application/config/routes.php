<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

// panel
$route['default_controller'] = "panel";
$route['header'] = "panel/header";
$route['footer'] = "panel/footer";
$route['usuarios'] = "panel/usuarios";
$route['login'] = "panel/login";
$route['web'] = "panel/template";
// sistema
$route['categoria_riesgos'] = "sistema/categoria_riesgos";
$route['valor_permisos'] = "sistema/valor_permisos";
$route['mantenimiento_inmuebles'] = "sistema/mantenimiento_inmuebles";
$route['mantenimiento_muebles'] = "sistema/mantenimiento_muebles";
$route['tipo_inmuebles'] = "sistema/tipo_inmuebles";
$route['tipo_muebles'] = "sistema/tipo_muebles";
$route['periodos'] = "sistema/periodos";
$route['subcategorias'] = "sistema/subcategorias";
$route['codigo_permisos'] = "sistema/codigo_permisos";
$route['reportes'] = "sistema/reportes";
$route['solicitud_inspeccion'] = "sistema/solicitud_inspeccion";
// contribuyente
$route['persona'] = "contribuyente/persona";
$route['empresa'] = "contribuyente/empresa";
// bienes
$route['inmuebles'] = "bienes/inmuebles";
$route['muebles'] = "bienes/muebles";
// permisos
$route['Npermiso_funcionamiento'] = "permisos/Npermiso_funcionamiento";
$route['RenovacionPermisoFuncionamiento'] = "permisos/RenovacionPermisoFuncionamiento";
$route['Npermiso_Construccion'] = "permisos/Npermiso_Construccion";
$route['RenovacionPermisoContruccion'] = "permisos/RenovacionPermisoContruccion";
$route['Npermiso_Rodaje'] = "permisos/Npermiso_Rodaje";
$route['RenovacionPermisoRodaje'] = "permisos/RenovacionPermisoRodaje";
$route['Npermiso_Ocasional'] = "permisos/Npermiso_Ocasional";
// template
$route['banners'] = "template/banner";
$route['empresaInfo'] = "template/infoempresa";
$route['noticias'] = "template/noticias";
$route['pdfs'] = "template/pdfs";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */