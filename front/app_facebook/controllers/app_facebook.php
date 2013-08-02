<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Cristian Rivas
 */
class App_facebook extends Front_Controller {

    public function __construct() {
      parent::__construct();
    }

    // ----------------------------------------------------------------------

    public function index() {
      // Cargando usuarios
      $user_photo = new \Users_photo;
      
      $this->_data['photo_user'] = $user_photo->get_photo(47);
      
      return $this->load->view('body', $this->_data);
    }

    // ----------------------------------------------------------------------

}