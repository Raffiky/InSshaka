<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$regexp = '[a-zA-Z0-9.-_]+';

$route['(perfil)'] = 'mi_perfil';

$route['(perfil)/(social|audiciones|clasificados|conciertos|build_a_band|directorios|pages|configuracion)'] = '$2/index';
$route['(perfil)/(social|editar|ajax|audiciones|clasificados|conciertos|build_a_band|pages|directorios|actions|configuracion)/(:any)'] = '$2/$3';

// Rutas para el cargue de shows
$route["(perfil)/({$regexp})/(load_shows)"] = 'ajax/$3/$2';
$route["(perfil)/({$regexp})/(load_posts)"] = 'ajax/$3/$2';

// Rutas para las fotos y videos
$route['(perfil)/([a-zA-Z0-9.-_]+)/(fotos|videos)'] = 'album/$3/$2';
$route['(perfil)/([a-zA-Z0-9.-_]+)/(fotos_page|videos_page)'] = 'pages/$3/$2'; 

// Rutas para las páginas
$route['(perfil)/(pagina)/([a-zA-Z0-9.-_]+)'] = 'pages/index/$3';


$route['(perfil)/([a-zA-Z0-9.-_]+)'] = 'index/$2';
$route['(perfil)/([a-zA-Z0-9.-_]+)/(:any)'] = '$3/$2';

// Ruta para las paginas del buscador
$route['(perfil)/(social)/(find_inshaka)/(pagina)/(:any)'] = 'social/$3/$5';

/* End of file routes.php */
/* Location: ./application/config/routes.php */