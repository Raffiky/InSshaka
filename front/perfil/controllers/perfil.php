<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author rigobcastro
 */
class Perfil extends Front_Controller {

    protected $user_area = false;
    private $_datos = null;

    public function __construct() {
        parent::__construct();

        // Mostrar header del perfil del usuario
        $this->show_header_perfil = true;
                
        // Cargando datos
        $this->_datos = new User;
        
        $user_language = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
        
        switch ($user_language) {
          case "en":
            $this->lang->load("perfil/english"); 
            break;
          case "es":
            $this->lang->load("perfil/spanish"); 
            break;
          default:
            $this->lang->load("perfil/spanish"); 
            break;
        }
    }

    // ----------------------------------------------------------------------

    /**
     * Remapeo del método
     */
    public function _remap($method, $params = array()) {
      $categoria = new \Directorio_categoria;
      $profile_photo = new \Users_photo;
      $gender_band = new \Band;
      $musical_gender = new \Musical_gender;
      $follow = new \Users_follow;
      
      // Verificando si es un usuario
      $this->_data['es_usuario'] = $this->is_usuario();
      
      if($this->is_usuario())
        $follow->where('user_id', $this->userinfo->id)->get();
      $profile_photo->where('profile_active', true);    
      
      $this->_data['categoria_provider'] = $categoria->get();
      $this->_data['profile_photo'] = $profile_photo->get();
      $this->_data['band_gender'] = $gender_band;
      $this->_data['genero_banda'] = $musical_gender;
      $this->_data['follow'] = $follow;

      $inshaka_url = null;

        if (!empty($params)) {
            $inshaka_url = end($params);
        } else {
            if ($method === 'mi_perfil') {
                $inshaka_url = $this->userinfo->inshaka_url;

                // Redireccion si es solo "perfil"
                if (!empty($inshaka_url)) {
                    return redirect('perfil/' . $inshaka_url, 'refresh');
                }
            }
        }
        
        $this->_datos->get_by_inshaka_url($inshaka_url);

        if (!empty($inshaka_url) && $this->_datos->exists()) {

            $this->current_username = $this->_datos->username;

            if (method_exists($this, $method)) {
                return call_user_func_array(array($this, $method), $params);
            }
        }

        return show_404();
    }

    // ----------------------------------------------------------------------

    public function index() {
        return $this->set_datos($this->_datos)->set_title('Perfil de ' . $this->_datos->username . ' &ndash; Usuarios de ' . SITENAME, true)->build('mi_shaka_perfil/body');
    }

    // ----------------------------------------------------------------------

    public function editar($seccion) {
        $this->_datos->get_current();

        return $this->set_datos($this->_datos)->set_title('Editar información')->build('mi_shaka_perfil/editar/' . $seccion);
    }

    // ----------------------------------------------------------------------
    
    public function save_directorio() {
      
      $directorio = new \Directorio;
      $this->_datos->get_current();
      $inshaka_url = $this->userinfo->inshaka_url;
      
      // Datos que no vienen del post
      $directorio->created_on = datetime_now();
      $directorio->code = $directorio->create_code();
      $directorio->directorio_categoria_id = $this->_datos->id_categoria_proveedor;
      $directorio->user_id = $this->_datos->id;
      $directorio->empresa = $this->_datos->name_proveedor;

      // Datos del formulario
      $directorio->direccion = $this->_post('direccion_empresa');
      $directorio->telefono = $this->_post('phone_provider');
      $directorio->sitio_web = $this->_post('sitio_web');
      $directorio->logo = $this->_post('logo_provider');
      $directorio->facebook = $this->_post('facebook_provider');
      $directorio->twitter = $this->_post('twitter_provider');
      $directorio->youtube = $this->_post('youtube_provider');
      $directorio->descripcion = $this->_post('description_provider');
      $directorio->active = false;
      $directorio->email = $this->_post('email_provider');

      $ok = $directorio->save();
      
       if (true === $ok) {
          $this->set_alert('¡Su perfil será publicado en el directorio!');
        } else {
          $this->set_alert($directorio->errors->string, 'error');
        }
      
      return $this->index();
    }
    
    // ----------------------------------------------------------------------
}