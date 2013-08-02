<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Categoria extends Front_Controller {

     protected $user_area = false;
    
    public function __construct() {
        parent::__construct();
    }

    // ----------------------------------------------------------------------
    
    public function index($var = null, $page = 1) {
        
        $datos = new Directorio_categoria;
        $user = new \User;
        $favorite_user = new \Users_directorio;
        
        $datos->get_by_var($var);
        
        if(!$datos->exists()){
            return show_404();
        }
       
        $datos->anuncios = $datos->get_active_anuncios($page);
        
        $this->_data['datos'] = $datos;
        $this->_data['user'] = $user;
        $this->_data['favorito'] = $favorite_user;
        $this->_data['es_usuario'] = $this->is_usuario();
        
        return $this->set_title('Directorio')->build('detalle_categoria');
    }

    // ----------------------------------------------------------------------
}