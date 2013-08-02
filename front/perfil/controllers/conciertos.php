<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Conciertos extends Front_Controller {

    protected $user_area = true;
    private $_datos = null;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;

        $this->_datos = new \User;
        $this->_datos->get_current();
    }

    // ----------------------------------------------------------------------

    public function index() {
        $datos = $this->_datos->concierto;

        $this->set_title('Mis Conciertos');

        return $this->set_datos($datos)->build('mis_conciertos/body');
        //return $this->build('mis_conciertos/body');
    }

    // ----------------------------------------------------------------------

    public function eliminar($concierto_id = null) {

        $datos = & $this->_datos->concierto;

        $datos->get_by_id($concierto_id);
        
        if(!$datos->exists()){
            return show_404();
        }
        
        if($this->db->where('id', $datos->id)->delete('conciertos')){
            return redirect('perfil/conciertos?delete='.$concierto_id);
        }
        
        return show_error('Hubo un error en la aplicación, intente de nuevo más tarde.', 500, 'Error al eliminar');
    }

    // ----------------------------------------------------------------------
}