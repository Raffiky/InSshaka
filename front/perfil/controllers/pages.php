<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Cristian Rivas
 */
class Pages extends Front_Controller {

    protected $user_area = true;
    private $_datos = null;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;
        
        $this->load->model(array('_bands/pages_photo', '_bands/pages_video', '_bands/bands_instrument', '_bands/bands_instruments_user', '_bands/instrument', '_bands/pages_info', '_bands/pages_song'));
                
        // Cargando datos
        $this->_datos = new Page;
        
    }

    // ----------------------------------------------------------------------
    
    public function index($var = NULL) {
      
      $user = new User;
      $musical_gender = new Musical_gender;
      $sub_musical_gender = clone $musical_gender;
      
      $var = str_replace('_', '-', $var);

      $this->_datos->get_by_var($var);
      $user->get_current();
      
      $sub_gender_one = $musical_gender->get_by_id($this->_datos->band->sub_uno_musical_gender_id);
      $sub_gender_two = $sub_musical_gender->get_by_id($this->_datos->band->sub_dos_musical_gender_id);
      
      $this->set_datos($this->_datos);
      $this->_data['is_owner'] = $this->userinfo->user_id == $this->_datos->band->user_id;
      $this->_data['sub_one_musical_gender'] = $sub_gender_one->name;
      $this->_data['sub_two_musical_gender'] = $sub_gender_two->name;
      
      $this->set_title('Perfil de ' . $this->_datos->band->name . ' &ndash; Usuarios de ' . SITENAME, true);
      
      return $this->build('mis_paginas/body');
    }

    // ----------------------------------------------------------------------
    
    public function fotos_page($var = null) {
      $var = str_replace('_', '-', $var);
      $this->_datos->get_by_var($var);

      $this->_data['is_owner'] = $this->userinfo->user_id == $this->_datos->band->user_id;
      
      return $this->set_datos($this->_datos)->set_title('Fotos de ' . $this->_datos->band->name . ' &ndash; Usuarios de ' . SITENAME, true)->build('mis_paginas/albumes/fotos');
    }

    // ----------------------------------------------------------------------
    
    public function videos_page($var = null) {
      $var = str_replace('_', '-', $var);
      $this->_datos->get_by_var($var);

      $this->_data['is_owner'] = $this->userinfo->user_id == $this->_datos->band->user_id;
      
      return $this->set_datos($this->_datos)->set_title('Videos de ' . $this->_datos->band->name . ' &ndash; Usuarios de ' . SITENAME, true)->build('mis_paginas/albumes/videos');
    }

    // ----------------------------------------------------------------------

}