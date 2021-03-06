<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Clasificados extends Front_Controller {

    protected $user_area = true;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;

        $this->load->model(array('_clasificados/clasificado', '_clasificados/clasificados_aplicacion'));
    }

    // ----------------------------------------------------------------------

    public function index($page = 1) {

        $favorito = new \Users_clasificado;
        $user = new User;
        $user->get_current();
        
        $favorito->where('user_id', $user->id);
        $favorito->get_paged($favorito->page, 10);

        if ($this->_get('order')) {
            $user->clasificado->order_by($this->_get('order'), $this->_get('type'));
        }

        $datos = $user->clasificado->get_paged($page, 10);

        // Setteando la URL del paginador
        $paginator_url = site_url('perfil/clasificados/pagina/%d/');
        $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
        
        $this->_data['favoritos'] = $favorito;
        $this->_data["user"] = $user;

        $this->set_title('Mis clasificados');

        return $this->set_datos($datos)->build('mis_clasificados/body');
    }

    // ----------------------------------------------------------------------

    public function pagina($page) {
        return $this->index($page);
    }

    // ----------------------------------------------------------------------

    public function eliminar($id) {
        $datos = new Clasificado($id);

        if (!$datos->exists()) {
            return show_404();
        }

        if (!empty($datos->imagen)) {
            $path = UPLOADSFOLDER . $datos->imagen;

            if (is_file($path)) {
                @unlink($path);
            }
        }
        
        

        $ok = $this->db->where('id', $id)->delete('clasificados');
        
        if ($ok) {
            return redirect('perfil/clasificados?delete_success=' . $id);
        }

        return show_error('Hubo un error en la aplicación, intente de nuevo más tarde.');
    }

    // ----------------------------------------------------------------------
    
    public function eliminar_favorito($id = NULL){
      $favorito = new \Users_clasificado;
      $favorito->where('id', $id)->get();
      
      $ok = false;
      
      if($favorito->exists()){        
        $ok = $favorito->delete();
        $this->set_alert('El registro fué borrado satisfactoriamente!.', 'success');
      }else {
        $this->set_alert('Hubo un error al eliminar el registro. Inténtelo más tarde', 'error');
      }
      
      return $this->index();
    } 
    
    // ----------------------------------------------------------------------
}