<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 *
 * @author Cristian Rivas
 */
class Media extends Front_Controller  {
  
  protected $user_area = true;
  private $_datos = null;
  private $_count = 0;
  
  public function __construct() {
    parent::__construct();    
    $this->_datos = new Artist;
  }
  
  // ----------------------------------------------------------------------
  
  public function index(){
    $this->set_title('Media');
    $media = new Artists_media;
    $destacados = $media->get_by_destacado(true);
    $genero = new Musical_gender();
    $datos = null;

    if ($this->_get(null)) {
        $datos = $this->_datos;
        $paginator_url = site_url('media/buscar/pagina/%d/');
        $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
    }
    $this->_data['count'] = $this->_count;
    
    $this->_data['destacados'] = $destacados;
    
    
    $this->_data['select_artistas'] = $this->_datos->get_for_select('Seleccione...');
    $this->_data['select_genero'] = $genero->get_for_select('Género musical');

    return $this->set_datos($datos)->build();
  }
  
  // ----------------------------------------------------------------------
  
  public function buscar($page = 1) {

    if ($this->_get(null)) {
      foreach ($this->_get(null) as $field => $get) {
        if (!empty($get)) {
          switch ($field) {
            case 'artist':
              $this->_datos->where('id', $get);
              break;
            case 'musical_gender':
              $this->_datos->where('musical_gender_id', $get);
              break;
            default:
                $this->_datos->like($field, $get);
                break;
          }
        }
      }
      $this->_datos->get_paged($page, 10);
      $this->_count = $this->_datos->count_distinct();
    }
    return $this->index();
  }
  
  // ----------------------------------------------------------------------
  
  public function detalle($var = null){
    $var = str_replace('_', '-', $var);
    $datos = $this->_datos->get_by_var($var);
    
    $media = new Artists_media;
    $sesion_inshaka = clone $media;
    $contando_historias = clone $media;
    $detras_escena = clone $media;
    
    
    $destacados = $media->get_by_destacado(true);    
    $sesiones = $sesion_inshaka->where(array('artist_id'=>$datos->id, 'media_categoria_id' => 1))->get();
    $contando = $contando_historias->where(array('artist_id'=>$datos->id, 'media_categoria_id' => 2))->get();
    $detras = $detras_escena->where(array('artist_id'=>$datos->id, 'media_categoria_id' => 3))->get();
    
    if($sesiones->exists()){
      $this->_data['sesiones'] = $sesiones;
    }
    
    if($contando->exists()){
      $this->_data['contando_historias'] = $contando;
    }
    
    if($detras->exists()){
      $this->_data['detras_escena'] = $detras;
    }    

    $this->_data['destacados'] = $destacados;
    
    $this->set_title('Entrevistas, videos y más de '.$datos->name);
    $this->set_datos($datos);
    
    return $this->build('detalle');
  }

  // ----------------------------------------------------------------------
}