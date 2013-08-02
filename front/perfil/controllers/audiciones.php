<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Audiciones extends Front_Controller {

    protected $user_area = true;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;

        $this->load->model(array('_audiciones/audicion', '_audiciones/audiciones_aplicacion', '_users/user', '_users/talent'));
    }

    // ----------------------------------------------------------------------

    public function index($page = 1) {


        $user = new User;
        $user->get_current();
        
        $aplicaciones = new Audiciones_aplicacion;

        if ($this->_get('order')) {
            $user->audicion->order_by($this->_get('order'), $this->_get('type'));
        }

        $datos = $user->audicion->get_paged($page, 10);

        // Setteando la URL del paginador
        $paginator_url = site_url('perfil/audiciones/pagina/%d/');
        $this->_data['paginator_url'] = $_SERVER['QUERY_STRING'] ? $paginator_url . '?' . $_SERVER['QUERY_STRING'] : $paginator_url;
        $this->_data['aplicaciones'] = $aplicaciones->get_my_aplication($user->id);
        $this->_data['quien_aplico'] = $aplicaciones->get_aplications($datos->id);

        $this->set_title('Mis audiciones');

        return $this->set_datos($datos)->build('mis_audiciones/body');
    }

    // ----------------------------------------------------------------------

    public function pagina($page) {
        return $this->index($page);
    }

    // ----------------------------------------------------------------------

    public function eliminar($id) {
        $datos = new Audicion($id);

        if (!$datos->exists()) {
            return show_404();
        }

        if (!empty($datos->imagen)) {
            $path = UPLOADSFOLDER . $datos->imagen;

            if (is_file($path)) {
                @unlink($path);
            }
        }
        
        

        $ok = $this->db->where('id', $id)->delete('audiciones');
        
        if ($ok) {
            return redirect('perfil/audiciones?delete_success=' . $id);
        }

        return show_error('Hubo un error en la aplicación, intente de nuevo más tarde.');
    }

    // ----------------------------------------------------------------------
    
    public function aceptar_aplicacion() {
      
      $id = $this->_get('id');
      $aceptar = $this->_get('aceptar');
      
      $aplicacion = new \Audiciones_aplicacion;
      $user = new \User;
      $talent = new \Talent;
      
      $aplicacion->where('id', $id);
      
      if($aceptar == 1) {
        $aplicacion->update('estado', true);
      }else{
        $aplicacion->update('estado', false);
      }
      
      
      $this->load->library('email');
      $this->email->clear();
      
      $usuario = $aplicacion->where('id', $id)->get();
      $user->get_by_id($usuario->user_id);

      $this->_data = array(
          'username' => $user->username,
          'audicion' => $usuario->audicion->titulo,
          'fecha' => $usuario->audicion->fecha_audicion,
          'direccion' => $usuario->audicion->direccion_audicion,
          'talento' => $talent->get_talent($usuario->audicion->talents_id),
          'aceptado' => $aceptar
      );

      $html = parent::view('mis_audiciones/email');

      $this->email->from(SITEEMAIL, SITENAME);
      $this->email->to($user->email);

      $this->email->subject('Estado de tu aplicación para la audición '.$usuario->audicion->titulo);
      $this->email->message($html);
      $this->email->send();
 
    }
    
    // ----------------------------------------------------------------------
}