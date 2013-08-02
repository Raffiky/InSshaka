<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of artists
 *
 * @author Cristian Rivas
 */
class Artists extends Back_Controller {
  
  protected $admin_area = true;
  
  public function __construct() {
    parent::__construct();
    $this->load->model('_bands/musical_gender');
  }
  
  // ----------------------------------------------------------------------
  
  public function index() {
    $genero = new Musical_gender();
    $datos = new Artist;
    $datos->get();

    $this->set_datos($datos);

    $this->_data['select_genero'] = $genero->get_for_select('Género musical');

    // URL para editar
    $this->_data['delete_url'] = cms_url('artists/artists/delete/%d/');
    $this->_data['edit_url'] = cms_url('artists/artists/editar/%d/');
    $this->_data['save_url'] = cms_url('artists/artists/save');
    $this->_data['upload_url'] = cms_url('artists/upload');

    return $this->build('artistas/body');
  }

  // ----------------------------------------------------------------------

  public function editar($id = null) {
    $datos = new Artist($id);
    $genero = new Musical_gender();

    if (empty($id) OR !$datos->exists()) {
        return show_404();
    }
    $this->_data['select_genero'] = $genero->get_for_select('Género musical');
    $save_url = cms_url('artists/artists/save/' . $id);
    $this->_data['save_url'] = $save_url;
    $this->_data['upload_url'] = cms_url('artists/upload');

    return $this->set_datos($datos)->build('artistas/editar');
  }

  // ----------------------------------------------------------------------

  public function save($id = null) {
    $datos = new Artist($id);

    foreach ($this->_post('images') as $image) {
      if (!empty($image['image']) && !empty($image['thumb'])) {
        $datos->image = $image['image'];
        $datos->thumb = $image['thumb'];
        $datos->var = seo_name($this->_post('name'));

        $ok = $datos->from_array($this->_post(null), null, true);

        if (!$ok) {
          $this->set_message($datos->error->string);
        } else {
          $this->set_message('Guardado exitosamente...');
        }
        $datos->clear();
      }
    }
    // ID del nuevo elemento (si llega a guardar)
    $this->_data['id'] = $datos->id;

    return $this->index();
  }

  // ----------------------------------------------------------------------
  
  public function media(){

    $datos = new Artists_media;
    $artistas = new Artist;
    $categoria = new Media_categoria;
    
    $datos->get();
    
    $this->_data['select_artist'] = $artistas->get_for_select('Seleccione...');
    $this->_data['select_category'] = $categoria->get_for_select('Seleccione...');
    $this->_data['save_url'] = cms_url('artists/artists/save_media');
    $this->_data['edit_url'] = cms_url('artists/artists/editar_media/%d/');
    $this->set_datos($datos);
    
    return $this->build('videos/body');
  }
  
  // ----------------------------------------------------------------------
  
   public function editar_media($id = null) {
    $datos = new Artists_media($id);
    $artistas = new Artist;
    $categoria = new Media_categoria;

    if (empty($id) OR !$datos->exists()) {
        return show_404();
    }
    $this->_data['select_artist'] = $artistas->get_for_select('Seleccione...');
    $this->_data['select_category'] = $categoria->get_for_select('Seleccione...');
    $save_url = cms_url('artists/artists/save_media/' . $id);
    $this->_data['save_url'] = $save_url;

    return $this->set_datos($datos)->build('videos/editar');
  }

  // ----------------------------------------------------------------------

  public function save_media($id = null) {
    $datos = new Artists_media($id);

    $datos->code = $datos->create_code();
    $datos->created_on = datetime_now();

    $ok = $datos->from_array($this->_post(null), null, true);

    if (!$ok) {
      $this->set_message($datos->error->string);
    } else {
      $this->set_message('Guardado exitosamente...');
    }
    // ID del nuevo elemento (si llega a guardar)
    $this->_data['id'] = $datos->id;

    return $this->media();
  }

  // ----------------------------------------------------------------------
}